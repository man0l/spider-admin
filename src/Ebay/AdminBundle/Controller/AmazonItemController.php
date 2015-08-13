<?php

namespace Ebay\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ebay\AdminBundle\Entity\AmazonItem;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("upload-image", name="upload_image")
     */
    function uploadImageAction() {
        
    }
    
    
    /**
     * @Route("amazon-gallery/{id}", name="amazon_gallery")
     */
    function galleryAction(Request $request, $id) 
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('EbayAdminBundle:AmazonItemImages');
        $images = $repo->findBy(array('id' => $id));
        
    }

   
}
