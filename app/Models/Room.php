<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable=[
        'title','size','capacity','bed_types','bed_count','room_number','category_id',
        'description','facilities','price','availability','status','room_image'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
   
}
