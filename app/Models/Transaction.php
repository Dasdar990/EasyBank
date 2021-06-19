<?php
use Illuminate\Database\Eloquent\Model;

Class Transaction extends Model{

    protected $primaryKey = 'Transaction_ID';
    public $timestamps = false;

    public function card(){
        return $this->belongsTo("Card", "Number");
    }


};

?>
