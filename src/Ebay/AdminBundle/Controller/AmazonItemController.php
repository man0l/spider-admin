<?php

namespace Ebay\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ebay\AdminBundle\Entity\AmazonItem;

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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $conn = $em->getConnection();
        
        $sql = "
            SELECT ai.*, group_concat(aii.path ) as images_list FROM amazon_item ai
            LEFT JOIN amazon_item_images aii ON ai.id = aii.amazon_id
            INNER JOIN item i ON ai.asin = i.main_asin
            
            GROUP BY ai.id
                ";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();

        $results = $stmt->fetchAll();
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $results,
            $request->query->getInt('page', 1)/*page number*/,
            $itemsPerPage
        );

            
        return array('pagination' => $pagination);
    }

   
}
