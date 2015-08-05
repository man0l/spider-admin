<?php

namespace Ebay\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ebay\AdminBundle\Entity\Item;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Item controller.
 *
 * @Route("/admin/item", name="admin_item")
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
        
        $where = array();
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
        
        if($request->query->get('has_main_asin'))
        {
            $where['main_asin'] = "i.main_asin != ''";
        }
        
        if($request->query->get('has_asin'))
        {
            $where['has_asin'] ='i.ASIN != ""';
        }
        
        if(count($where) > 0)
        {
            $sql .=  sprintf(" WHERE %s",implode(" AND ", $where));
        }
        
        $sql .= " GROUP BY i.id";
        
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
        
        if($request->query->get('show_items'))
        {
            $itemsPerPage = $request->query->get('show_items');
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
    
    /**
     * @Route("/preview/{id}", name="item_preview")
     * @Template()
     */
    public function previewAction($id) 
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('EbayAdminBundle:Item');
        
        $item = $rep->find($id);
        
        return array('item' => $item);
    }
    
    /**
     * @Route("/main-asin", name="main_asin")
     * 
     */
    public function mainASIN(Request $request)
    {
        
        $id = $request->request->get('id');
        $asin = $request->request->get('asin');
        
        $em = $this->container->get('doctrine.orm.entity_manager');
        $rep = $em->getRepository('EbayAdminBundle:Item');
        
        $item = $rep->find($id);
        
        $item->setMainAsin($asin);
        
        $em->persist($item);
        $em->flush();

        return new Response('[{"updated": true }]');
    }
    
}
