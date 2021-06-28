<?php
use Illuminate\Database\Eloquent\Model;

Class Card extends Model{
    protected $primaryKey = 'Number';
    public $timestamps = false;
    protected $fillable = [
        'Status',
        'Number',
        'Month',
        'Year',
        'CVV',
        'PIN',
        'Balance',
        'Payment_Date',
        'Card_ID' ,
        'Account_ID',
        'ActivationDate',
        'Favorite'
    ];
    
    public function card_types(){
        return $this->belongsTo("CardTypes", "Card_ID" ,"ID");
    }
    public function transactions(){
        return $this->hasMany("Transaction", "Number");
    }
};

?>