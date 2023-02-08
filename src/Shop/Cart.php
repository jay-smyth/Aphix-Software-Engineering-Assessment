<?php

namespace App\Shop;

class Cart extends Product
{
    private $filePath = "https://63187261f6b281877c6c9805.mockapi.io/api/v1/cart";

    public $cartObjArray = [];

    //cart object vars
    private $cartNet;
    private $cartVat;
    private $cartTotal;

     //instantiate cart object 
     public function __construct($cartNet, $cartVat, $cartTotal){
        $this->cartNet = $cartNet;
        $this->cartVat = $cartVat;
        $this->cartTotal = $cartTotal;
    }

    public function getCartNet(){
        return $this->cartNet;
    }

    public function setCartNet($cartNet){
        $this->cartNet = $cartNet;
    }

    public function getCartVat(){
        return $this->cartVat;
    }

    public function setCartVat($cartVat){
        $this->cartVat = $cartVat;
    }

    public function getCartTotal(){
        return $this->cartTotal;
    }

    public function setCartTotal($cartTotal){
        $this->$cartTotal = $cartTotal;
    }
    

    /* Fetch the API and decode to array */
    public function cartProcessing(){

        $data = file_get_contents($this->filePath);
        $productList =  json_decode($data, true);
                
        $this->createProductObject($productList);
        $this->unitNetCost();
        $this->unitVatCost();
        $this->unitTotal();
        $this->cartNet();
        $this->cartVat();
        $this->cartTotal();
    }
    
    /* Creating an array of objects will alow accessing certain variables easier */
    public function createProductObject($productList){
        //make some vars for passing data into object array
        $pId = ''; 
        $pName = ''; 
        $pCost = '';
        $pQty = '';
        $itemId = '';
        $netTotal = '';
        $vatTotal = '';
        $total = '';
        
        //loop through our product list to create an array of objects
        foreach($productList as $obj => $x){

            foreach($x as $key => $value){
                
                switch ($key){
                    case 'productId':
                        $pId = $value;
                    break;
                    case 'productName':
                        $pName = $value;
                    break;
                    case 'unitPrice':
                        $pCost = $value;
                        break;
                    case 'qty':
                        $pQty = $value;
                    break;
                    case 'id':
                        $itemId = $value;
                        break;
                }

                //maybe could have used the id here but it's as broad as it is long and the id is probably better suited to ORM
                $this->cartObjArray[$obj] = new Product($pId, $pName, $pCost, $pQty, $itemId, $netTotal, $vatTotal, $total);

            }
        }

        
    }


    /* 
     * unit net cost of each product in the cart and pushed back to each product obj
    */
    public function unitNetCost(){
        
        $arr = $this->cartObjArray;
        $unitTotal = 0;
        
        foreach($arr as $obj => $x){
            
            $unitTotal = $x->getUnitPrice() * $x->getUnitQty();

            $x->setNet(number_format((float)$unitTotal, 2, '.', ''));
            
        }

    }


    /* 
     * unit vat cost of each product in the cart and pushed back to each product obj
    */
    public function unitVatCost(){
        
        $arr = $this->cartObjArray;
        $unitTotal = 0;
        
        foreach($arr as $obj => $x){
            
            $vatTotal = $x->getNet() * (23/100);

            $x->setVat(number_format((float)$vatTotal, 2, '.', ''));
            
        }
        
    }

    /* 
     * unit total cost of each product in the cart and pushed back to each product obj
    */
    public function unitTotal(){
        
        $arr = $this->cartObjArray;
        $unitTotal = 0;
        
        foreach($arr as $obj => $x){
            
            $unitTotal = $x->getNet() + $x->getVat();

            $x->setTotal(number_format((float)$unitTotal, 2, '.', ''));
            
        }
        
    }

    /* 
     * cart net cost of all product and pushed back to the cart obj
    */
    public function cartNet(){
        
        $arr = $this->cartObjArray;
        $cartNet = 0;
        
        foreach($arr as $obj => $x){
            
            $cartNet += $x->getNet();
            
        }
        
        $this->setCartNet(number_format((float)$cartNet, 2, '.', ''));
        echo '<br/>Cart net = ' . $this->getCartNet() . '<br/>';
        
    }

    /* 
     * cart net cost of all product and pushed back to the cart obj
    */
    public function cartVat(){
        
        $arr = $this->cartObjArray;
        $cartVat = 0;
        
        foreach($arr as $obj => $x){
            
            $cartVat += $x->getVat();
            
        }
        
        $this->setCartVat(number_format((float)$cartVat, 2, '.', ''));
        echo '<br/>Cart vat = ' . $this->getCartVat() . '<br/>';
        
    }

    /* 
     * cart net cost of all product and pushed back to the cart obj - 
     * Seems to be an error in this somehow and I'm not sure why it throws back the object property name??
    */
    public function cartTotal(){
        
        $arr = $this->cartObjArray;
        $cartTotal = 0;
        
        foreach($arr as $obj => $x){
            
            $cartTotal += $x->getTotal();
            
        }
        
        $this->setCartTotal(number_format((float)$cartTotal, 2, '.', ''));
        echo '<br/>Cart Total = ' . $this->getCartTotal() . '<br/><br/><br/>';
    }

    /* 
     * Display data to page
     */
    public function cartProductList(){
        $arr = $this->cartObjArray;
        echo '<table>
                    <tr>
                        <th>Product Name</th><th>Quantity</th><th>Net Price</th><th>Vat</th><th>Subtotal</th></tr>';
        foreach($arr as $obj => $x){
            
            echo '<tr><td>' . $x->getProdName() . '</td><td>' . $x->getUnitQty() . '</td><td>' . $x->getNet() . '</td><td>' . $x->getVat() . '</td><td>' . $x->getTotal() .'</td></tr>';
        }
        echo '</table>';
    }

}