<?php

class Product {
    private $price;
    private $weight;
    private $freeShipping = false;


    public function __construct($price, $weight)
    {
        $this->price = $price;
        $this->weight = $weight;
    }

    public function getWeight(){
        return $this->weight;
    }

    public function setFreeShipping(){
        $this->freeShipping = true;
    }

    public function getFreeShipping(){
        return $this->freeShipping;
    }
}

class Shipping {
    private $totalShipping;
    private $products = [] ;
    private $pricePerKilogram;

    public function calculateTotalShipping(){
        foreach($this->products as $product){
            if($product->getFreeShipping()){
                $this->totalShipping += $product->getWeight() * $this->pricePerKilogram;
            }
        }
    }

    public function addProduct(Product $product){
        $this->products[] = $product;
    }

    public function getTotalShippingPrice(){
        return $this->totalShipping;
    }

    public function setPricePerKilogram($pricePerKilogram){
       return $this->pricePerKilogram = $pricePerKilogram;
    }

}

$product = new Product(5, 4);
$product->setFreeShipping();

$shipping = new Shipping();
$shipping->addProduct($product);
$shipping->setPricePerKilogram(5);
$shipping->calculateTotalShipping();
$getTotal = $shipping->getTotalShippingPrice();

var_dump($getTotal);