<?php

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;



class TestController extends BaseController {
    public function test1(){
        /*
       $res = Card::where("Account_ID", 3)->get();
       foreach($res as $key){
           $detail = $key->transactions()->orderBy('Number')->get();
           /*
           foreach ($detail as $key1)
           echo "<br>".$key1."<br>";
           */
        //}  
        $loan = Loan::where("Loan_ID",2)->get();   ;
        echo $loan."  |   ";
        
    }
}