<?php

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;



class TestController extends BaseController {
    public function test1(){
       
        $cards = Card::where("Account_ID", 3)
        ->join('card_types', 'cards.Card_ID', '=', 'card_types.ID')
        ->get();
        $bancomat = $cards->where('Type', 'Bancomat')->first();
        echo($bancomat->Balance);
    }
}