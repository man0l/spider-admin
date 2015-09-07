<?php

namespace Ebay\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ebay\AdminBundle\Entity\AmazonItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Imagine\Imagick\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Ebay\AdminBundle\Entity\AmazonItemImages;

/**
 * AmazonItem controller.
 *
 * @Route("/admin/amazon_item")
 */
class AmazonItemController extends Controller
{

    /**
     * Lists all AmazonItem entities.
     *
     * @Route("/", name="admin_amazon_item")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $conn = $em->getConnection();        
       
        $sql = "
                SELECT ai.*, count(distinct iis.id) AS sold, group_concat(DISTINCT REPLACE(aii.path, 'full/', '')) AS images_list, ROUND((i.price - (i.price * 0.144) - 0.3) - ai.price, 2) AS profit
                FROM amazon_item ai
                LEFT JOIN amazon_item_images aii ON ai.id = aii.amazon_id
                INNER JOIN item i ON ai.asin = i.main_asin
                LEFT JOIN item_sold iis ON i.id = iis.item_id               
            ";
        
        $sql .= " GROUP BY  ai.id";
        
        if($request->query->has('sort'))            
        {
            $sql .= sprintf(" ORDER BY %s ", $request->query->get('sort'));
            $sql .= ($request->query->get('direction') == 'asc' ? 'ASC' : 'DESC');
        }
        
        
        
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();

        $results = $stmt->fetchAll();
        
        $itemsPerPage = 20;
        
        if($request->query->get('show_items'))
        {
            $itemsPerPage = $request->query->get('show_items');
        }
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $results,
            $request->query->getInt('page', 1)/*page number*/,
            $itemsPerPage
        );

        $timestamp = time();
        return array('pagination' => $pagination, 'timestamp' => $timestamp, 'hash' => 'unique_salt' . $timestamp);
    }
    
    /**
     * @Route("/upload-image", name="upload_image_amazon")
     */
    function uploadImageAction(Request $request) {
        
        
        $file = $request->files->get('Filedata');
        $rootDir = $this->container->getParameter('kernel.root_dir') . "/../web/";
        $ext = $file->getExtension();
        
        if(!$ext)
        {
            $ext = $file->guessExtension();
        }
        
        
        $uploadPath = sprintf("%simages/full/", $rootDir);
        $thumbPath = sprintf("%simages/thumbs/small/", $rootDir);
        $fileName   = sprintf("%s.%s",  md5(time()), $ext);
        
        if($file->move($uploadPath, $fileName))
        {
            $imageine = new Imagine();
            $image = $imageine->open($uploadPath.$fileName);
            $image->resize(new Box(100, 100))->save($thumbPath.$fileName);
     
            
        } else 
        {
            throw new FileException("The file could not be uploaded");
        }
        
        
        return new Response($fileName);
    }
    
    
    /**
     * @Route("/save-images/", name="save_images")
     */
    function saveImagesAction(Request $request) 
    {
       
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('EbayAdminBundle:AmazonItemImages');
        $repItem = $em->getRepository('EbayAdminBundle:AmazonItem');
        
        $amazonID = $request->request->get('item_id');
        $item = $repItem->find($amazonID);
        
        $images = $rep->findBy(array('amazonId' => $amazonID ));
        if($images)
        {
            foreach($images as $image)
            {
                $em->remove($image);
                $em->flush();
            }
        }
        
        $newImages = $request->request->get('order');
        
        foreach($newImages as $order => $image)
        {
            $image = sprintf("full/%s", $image);
            
            $im = new AmazonItemImages();
            $im->setAmazonId($amazonID);
            $im->setAsin($item->getAsin());
            $im->setPath($image);
            $im->setDisplayOrder($order);
            $im->setUpdatedAt(new \Datetime('now'));
            $im->setCreatedAt(new \Datetime('now'));
            
            
            $em->persist($im);
        }
        
        $em->flush();
        
        
        return new Response();
    }
    
    
    /**
     * @Route("/save-description", name="save_description")
     */
    function saveAction(Request $request) 
    {
        $html = $request->request->get('html');
        $id   = $request->request->get('id');
        
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('EbayAdminBundle:AmazonItem');
        
        $entity = $rep->find($id);
        if($entity)
        {
            $entity->setDescription($html);
            $em->persist($entity);
            $em->flush();
        }
        
        
        return new Response;
    }
    
    /**
     * @Route("/save-title", name="save_title")
     */
    function saveTitleAction(Request $request) 
    {
        $html = $request->request->get('value');
        $id   = $request->request->get('pk');
        
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('EbayAdminBundle:AmazonItem');
        
        $entity = $rep->find($id);
        if($entity)
        {
            $entity->setTitle($html);
            $em->persist($entity);
            $em->flush();
        }
        
        
        return new Response($html);
    }

   
}
