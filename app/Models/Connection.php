<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;

    Use Uuid;

    public $incrementing = false;

    protected $keyType = 'uuid';


    protected  $guarded=[];

    public function customer(){
        return $this->hasOne(Customer::class,"id","customer_id");
    }

    public function pakage(){
        return $this->hasOne(pakages::class,"id","pakage_id");
    }
}
