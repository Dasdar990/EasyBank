<?php
use Illuminate\Database\Eloquent\Model;

Class User extends Model{
    protected $primaryKey = 'CF';
    protected $keyType = 'string';
    
    protected $fillable = [
        'CF','Email','Name','Surname','Residence','Phone','Passwd','Dob'
    ];

    public function subscription(){
        return $this->hasOne("Subscription", "CF");
    }
};

?>
