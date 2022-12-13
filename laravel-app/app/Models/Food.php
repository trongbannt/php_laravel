<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = "foods";
    protected $primaryKey = "id";
    protected  $fillable =["name","count", "description","image_path","category_id","created_at","updated_at"];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
}
