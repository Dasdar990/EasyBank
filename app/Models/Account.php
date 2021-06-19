<?php
use Illuminate\Database\Eloquent\Model;

Class Account extends Model{
    protected $primaryKey = 'Account_ID';
    
    protected $fillable = ['Fee', 'Type'];
    public $timestamps = false;

    
    public function subscription(){
        return $this->hasOne("Subscription", "Account_ID");
    }
    public function cards(){
        return $this->hasMany("Card", "Account_ID");
    }
    public function history(){
        return $this->hasMany("History", "Account_ID");
    }
    
};

?>