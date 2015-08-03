<?php

namespace Ebay\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ebay\AdminBundle\Entity\Item;
use Symfony\Component\HttpFoundation\Request;

/**
 * Item controller.
 *
 * @Route("/admin/item")
 */
class ItemController extends Controller
{

    /**
     * Lists all Item entities.
     *
     * @Route("/", name="admin_item")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $conn = $em->getConnection();
        $itemsPerPage = 20;
        
        $sql = "           
                SELECT i.*, COUNT(iss.id) as sold FROM item i 
                LEFT JOIN item_sold iss ON i.id = iss.item_id
                
                WHERE i.ASIN != ''
                GROUP BY iss.item_id
                

            ";
        
        
        if($request->query->has('sort'))            
        {
            $sql .= " ORDER BY i.".$request->query->get('sort'). "+0 ";
            $sql .= ($request->query->get('direction') == 'asc' ? 'ASC' : 'DESC');
        }
        
        $stmt = $conn->prepare($sql);
          
         
        //$stmt->bindValue("offset", $itemsPerPage * $page);
        //$stmt->bindValue("limit", $itemsPerPage);        
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

    /**
     * Finds and displays a Item entity.
     *
     * @Route("/{id}", name="admin_item_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EbayAdminBundle:Item')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Item entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
