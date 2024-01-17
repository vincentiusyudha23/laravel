<?php

namespace App\Services;

use Google\Client;
use Illuminate\Support\Facades\Http;

class GoogleShoppingServices {

    private $endpoint = 'https://shoppingcontent.googleapis.com/content/v2.1';
    private $token;
    private $merchantId;



    //Your Merchant ID
    public function setMerchantId($data){
        $this->merchantId = $data;
        return $this;
    }

    //For fetch Access Token
    public function setCredential($credential){
        $client = new Client();
        $client->setAuthConfig($credential);
        $client->addScope('https://www.googleapis.com/auth/content');
        $client->fetchAccessTokenWithAssertion();
        $AuthClient = $client->getAccessToken();
        // $this->token = $AuthClient['access_token'];
        return $AuthClient['access_token'];
    }

    //Set For Feed ID
    public function setFeed($id){
        $this->endpoint = $this->endpoint.'/'.$this->merchantId.'/products?feedId='.$id;
        return $this;
    }

    public function getAllProducts(){
        $product = Http::withToken($this->token)->get($this->endpoint.'/'.$this->merchantId.'/products');
        return $product;
    }

    public function create($data){
        $create = Http::acceptJson()->withToken($this->token)->post($this->endpoint.'/'.$this->merchantId.'/products', $data);
        return $create;
    }

    public function getProduct($product_id){
        $product = Http::withToken($this->token)->get($this->endpoint.'/'.$this->merchantId.'/products/'.$product_id);
        return $product;
    }

    public function update($product_id,$data){
        
        $update = Http::acceptJson()->withToken($this->token)->patch($this->endpoint.'/'.$this->merchantId.'/products/'.$product_id, $data);

        return $update;
    }

    public function delete($product_id){
        $product = Http::withToken($this->token)->delete($this->endpoint.'/'.$this->merchantId.'/products/'.$product_id);
        return $product;
    }

    
}