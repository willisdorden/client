<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model
{
    //Attributes that are mass assignable
    protected $fillable =['id','user_id', 'Ad_Campaign'];
    //defines relationship to user class
    public function Campaigns() {
        //Profile Model belongs to User Model
        return $this->belongsTo(User::class);
    }
}
