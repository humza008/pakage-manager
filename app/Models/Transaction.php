<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pakages;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;
    Use Uuid;

    public $incrementing = false;

    protected $keyType = 'uuid';


    protected  $guarded=[];

    public function pakage(){
        return $this->hasOne(pakages::class,"id","pakage_id");
    }

    public function user()
    {
        return $this->hasOne(User::class,"id",'user_id');
    }
}
