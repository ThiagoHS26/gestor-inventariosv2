<?php

namespace App\Observers;

use App\Models\Movement;
use App\Models\Product;

class MovementObserver
{
    public function created(Movement $movement)
    {
        $product = $movement->product;

        if ($movement->type === 'ingreso') {
            $product->quantity += $movement->quantity;
        } elseif ($movement->type === 'egreso') {
            $product->quantity -= $movement->quantity;
        }

        $product->save();
    }

    public function updated(Movement $movement)
    {
        $product = $movement->product;

        if ($movement->type === 'ingreso') {
            $product->quantity += 0;
        } elseif ($movement->type === 'egreso') {
            $product->quantity -= 0;
        }
        $product->save();
    }
}
