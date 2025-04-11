<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'description',
        'image',
        'stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public static function getAllProducts()
    {
        return DB::select('SELECT * FROM products');
    }
}
