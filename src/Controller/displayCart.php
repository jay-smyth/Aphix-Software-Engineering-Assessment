<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Shop\Cart;
use App\User\User;

class displayCart extends AbstractController
{    
    private $cart;
    private $user;

    public function __construct(Cart $cart, User $user)
    {
        $this->cart = $cart;
        $this->user = $user;
    }
    /* 
    * Gather the data and display the page 
    */
    public function index(): Response
    {   
        //populate the cart from the API, program beginning
        $this->cart->cartProcessing();
        
        //cart outputs
        $this->cart->cartProductList();
        

        return $this->render('cart.html.twig', [
        ]);
    }

    

}