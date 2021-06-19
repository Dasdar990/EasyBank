<?php
use Illuminate\Database\Eloquent\Model;

Class CardTypes extends Model{    
    protected $table = 'card_types';     
    
    public function cards(){
        return $this->hasMany("Card", "Card_ID");
    }
};

?>