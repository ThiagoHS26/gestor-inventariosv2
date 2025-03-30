<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at']; 
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone'];

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }
}