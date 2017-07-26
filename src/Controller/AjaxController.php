<?php

/*
 * This file is part of the Blast Project package.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Librinfo\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author Romain SANCHEZ <romain.sanchez@libre-informatique.fr>
 */
class AjaxController extends Controller
{
    /**
     * Edit order field
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function orderInlineEditAction(Request $request)
    {
        $value = $request->get('value');
        $setter = 'set' . ucfirst($request->get('field'));
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository('LibrinfoEcommerceBundle:Order');
        
        $order = $repo->find($request->get('id'));
        
        $order->$setter($value);
        
        $manager->persist($order);
        $manager->flush();
        
        return new JsonResponse($value);
    }
    
    /**
     * Increase order item quantity
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function addToOrderAction(Request $request)
    {
        return new JsonResponse($this->container->get('librinfo_ecommerce.order.item_updater')->updateItemCount($request->get('order'), $request->get('item'), true));
    }
    
    /**
     * Decrease order item quantity
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function removeFromOrderAction(Request $request)
    {
        return new JsonResponse($this->container->get('librinfo_ecommerce.order.item_updater')->updateItemCount($request->get('order'), $request->get('item'), false));
    }
}
