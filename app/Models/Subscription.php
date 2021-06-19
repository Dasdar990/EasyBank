<?php
use Illuminate\Database\Eloquent\Model;

Class Subscription extends Model{

    protected $fillable = ['CF', 'Account_ID', 'StartDate'];
    public $timestamps = false;


    public function user(){
        return $this->belongsTo("User", "CF");
    }

    public function account(){
        return $this->belongsTo("Account", "Account_ID");
    }
};

?>
