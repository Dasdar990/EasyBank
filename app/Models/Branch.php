<?php
use Illuminate\Database\Eloquent\Model;

Class Branch extends Model{
    protected $table = 'branch';   
    
    public function safe_boxes(){
        return $this->hasMany("SafeDepositBox", "Branch_ID", "Branch_ID");
    }

};

?>