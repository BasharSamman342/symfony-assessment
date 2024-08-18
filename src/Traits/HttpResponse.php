<?php 

namespace App\Traits;

trait HttpResponse 
{
    public function success($data,$msg,$code=200){
        $response = [
            "message"=>$msg,
            "data"=>$data,
            "code"=>$code
        ];
        return $this->json($response);
    }

    public function failure($msg,$code=400){
        $response = [
            "message"=>$msg,
            "code"=>$code
        ];
        return $this->json($response);
    }
}