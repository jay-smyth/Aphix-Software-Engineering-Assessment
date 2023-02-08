<?php

namespace App\Shop;

class Product
{
    private $productId;
    private $productName;
    private $unitPrice;
    private $unitQty;
    private $id;
    private $netTotal;
    private $vatTotal;
    private $total;

    //instantiate product object 
    public function __construct($productId, $productName, $unitPrice, $unitQty, $netTotal, $vatTotal, $total, $id){
        $this->productId = $productId;
        $this->productName = $productName;
        $this->unitPrice = $unitPrice;
        $this->unitQty = $unitQty;
        $this->id = $id;
        $this->netTotal = $netTotal;
        $this->vatTotal = $vatTotal;
        $this->total = $total;
    }

    public function getProdId(){
        return $this->productId;
    }

    public function getProdName(){
        return $this->productName;
    }
    
    public function getUnitPrice(){
        return $this->unitPrice;
    }

    public function getUnitQty(){
        return $this->unitQty;
    }

    public function getId(){
        return $this->id;
    }

    public function setNet($netTotal){
        $this->netTotal = $netTotal;
    }

    public function getNet(){
        return $this->netTotal;
    }

    public function setVat($vatTotal){
        $this->vatTotal = $vatTotal;
    }

    public function getVat(){
        return $this->vatTotal;
    }

    public function setTotal($total){
        $this->total = $total;
    }

    public function getTotal(){
        return $this->total;
    }


}