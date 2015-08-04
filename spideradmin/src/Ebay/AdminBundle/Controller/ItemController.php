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
            ";
        
        $where = array('i.ASIN != ""');
        $having = array(); 
       
        $params = array();
        
        if($request->query->get('price'))
        {
            $where['price'] = " i.price > :price";
            $params["price"] = $request->query->get('price');
        }
        
        if($request->query->get('sold'))
        {
            $having['sold'] = " sold > :sold";
            $params["sold"] = $request->query->get('sold');
        }
        
        
        if(count($where) > 0)
        {
            $sql .=  sprintf(" WHERE %s",implode(" AND ", $where));
        }
        
        $sql .= " GROUP BY iss.item_id";
        
         if(count($having))
        {
            $sql .= sprintf(" HAVING %s", implode(" AND ", $having));
        }
        
        if($request->query->has('sort'))            
        {
            $sql .= sprintf(" ORDER BY %s ", $request->query->get('sort'));
            $sql .= ($request->query->get('direction') == 'asc' ? 'ASC' : 'DESC');
        }  
        
       
        $stmt = $conn->prepare($sql);
          
         
        //$stmt->bindValue("offset", $itemsPerPage * $page);
        //$stmt->bindValue("limit", $itemsPerPage);        
        
        if(count($params))
        {
            foreach($params as $name => $value)
            {
                $stmt->bindValue($name, $value);
            }
        }
        
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
    
    
    /**
     * @Route("/sold-modal/{id}", name="sold_modal")
     * @Template()
     */
    public function modalAction($id) {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('EbayAdminBundle:ItemSold');
        $results = $rep->findBy(array('itemId' => $id), array('dateAt' => 'desc'));
        
        return array('results' => $results);
    }
}
