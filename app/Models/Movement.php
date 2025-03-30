<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Movement extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    use HasFactory;

    protected $fillable = [
    'type', 
    'product_id', 
    'description',
    'warehouse_id', 
    'user_id', 
    'quantity', 
    'date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}