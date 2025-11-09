<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesitem extends Model
{
    /** @use HasFactory<\Database\Factories\SalesitemFactory> */
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'item_id',
        'quantity',
        'unit_price',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
