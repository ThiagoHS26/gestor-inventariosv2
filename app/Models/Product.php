<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    use HasFactory;

    protected $fillable = ['name', 'description','category_id', 'warehouse_id', 'quantity',
                            'min_stock','max_stock','price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
}