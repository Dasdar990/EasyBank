<?php

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;



class TestController extends BaseController {
    public function test1(){
        $symbols = ['AAPL', 'MSFT','NKE', 'SBUX'];
        $response = array();
        foreach($symbols as $sym){
            $res = Http::get("https://cloud.iexapis.com/stable/stock/".$sym."/quote", [
                'token' => env('STOCK_API_KEY')
            ])->json();
            
            $view_data = [
                'favorite' => $sym === 'AAPL' ? 'true' : 'false',
                'name' => $res['companyName'],
                'symbol' => $res['symbol'],
                'price' => $res['latestPrice'],
                'trend' => $res['change'] > 0 ? 'true' : 'false',
                'change' => $res['change'],
                'changePercent' => number_format( ($res['changePercent'] * 100), 0, '','.'),
                'high' => $res['high'],
                'low' => $res['low'],
                'pe' => $res['peRatio'],
                'week52High' => $res['week52High'],
                'week52Low' => $res['week52Low'],
                'volume' => $res['volume'],
                'cap' => ''
            ];
            $response[$sym] = array(
                'card' => view('stock_card')->with($view_data)->render(),
                'info' => view('stock_info')->with($view_data)->render(),
            );
            
        }
        print_r($response);
       }
}