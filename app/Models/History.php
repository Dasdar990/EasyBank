<?php
use Illuminate\Database\Eloquent\Model;

Class History extends Model{
    protected $primaryKey = 'ID';
    protected $table = 'history'; 

    
    public function card_types(){
        return $this->belongsTo("Account", "Account_ID");
    }
};

?>