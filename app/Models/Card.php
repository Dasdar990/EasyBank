<?php
use Illuminate\Database\Eloquent\Model;

Class Card extends Model{
    protected $primaryKey = 'Number';
    
    public function card_types(){
        return $this->belongsTo("CardTypes", "Card_ID" ,"ID" );
    }
    public function transactions(){
        return $this->hasMany("Transaction", "Number");
    }
};

?>