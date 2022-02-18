<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'abandoned'          => 'Abandoned',
        'recovered-by-store' => 'Recovered by store',
        'converted-to-order' => 'Converted to order',
        'canceled-by-client' => 'Canceled by client',
    ];

    public $table = 'carts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'cart_number',
        'cart_total',
        'status',
        'customer_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function cartCartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
