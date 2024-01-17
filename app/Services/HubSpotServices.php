<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HubSpotServices
{   
    private $token;
    private $endpoint = 'https://api.hubapi.com/crm/v3/objects/contacts';


    public function setTable($table){
        $this->endpoint = 'https://api.hubapi.com/crm/v3/objects/'.$table;
        return $this;
    }

    public function setToken($token){
        $this->token = $token;
        return $this;
    }

    public function read(){

        $data = Http::withToken($this->token)->get($this->endpoint);
        return $data;
    }

    public function create($data){

        $create = Http::acceptJson()->withToken($this->token)->post($this->endpoint, $data);
        return $create;
    }

    public function update($id, $data){
        
        $update = Http::acceptJson()->withToken($this->token)->patch($this->endpoint.'/'.$id, $data);

        return $update;
    }

    public function delete($id){

        $delete = Http::withToken($this->token)->delete($this->endpoint.'/'.$id);

        return $delete;
    }
}