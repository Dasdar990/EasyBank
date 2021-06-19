<?php
use Illuminate\Database\Eloquent\Model;

Class SafeDepositBox extends Model{
    protected $table = 'SafeDepositBox';   
    
    public function branches(){
        return $this->belongsTo("Branch", "Branch_ID", "Branch_ID");
    }

};

?>