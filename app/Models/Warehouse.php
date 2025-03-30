<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    use HasFactory;

    protected $fillable = ['name', 'branch_id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function movements()
    {
        return $this->hasMany(Movement::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
