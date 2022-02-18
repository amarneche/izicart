<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'cart_items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'cart_id',
        'product_id',
        'quanitty',
        'product_price',
        'color_id',
        'size_id',
        'variation_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(ColorAttribute::class, 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(SizeAttribute::class, 'size_id');
    }

    public function variation()
    {
        return $this->belongsTo(VariationAttribute::class, 'variation_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
