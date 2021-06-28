<?php
use Illuminate\Database\Eloquent\Model;

Class AccessLog extends Model{
    protected $table = 'access_logs';

    protected $fillable = [
        'ip', 'Account_ID'
    ];
    
};
?>