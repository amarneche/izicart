<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'new-order'               => 'New Order',
        'processing'              => 'Processing',
        'canceled-by-client'      => 'Canceled by client',
        'confirmed-by-client'     => 'Confirmed by client',
        'on-hold'                 => 'On hold',
        'processing-by-warehouse' => 'Processing by warehouse',
        'shipped'                 => 'Shipped',
        'Delivery failed'         => 'Delivery failed',
        'completed'               => 'completed',
    ];

    public $table = 'orders';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'order_number',
        'customer_id',
        'wilaya_id',
        'commune_id',
        'shipping_cost',
        'sub_total',
        'total',
        'status',
        'payment_method_id',
        
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function orderOrderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function ship_to_wilaya()
    {
        return $this->belongsTo(Wilaya::class, 'ship_to_wilaya_id');
    }

    public function shipt_to_commune()
    {
        return $this->belongsTo(Commune::class, 'shipt_to_commune_id');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
