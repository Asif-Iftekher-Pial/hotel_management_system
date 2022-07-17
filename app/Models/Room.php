<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable=[
        'title','size','capacity','bed_types','bed_count','room_number','category_id',
        'description','facilities','price','availability','status','room_image'
    ];
   
}
