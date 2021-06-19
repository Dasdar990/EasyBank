<?php

use Illuminate\Routing\Controller as BaseController;


class ErrorController extends BaseController {
    public function returnError(){
        return ['error' => view('error')->with('error_text', 'Please fill this field!')->render()];
    }
}