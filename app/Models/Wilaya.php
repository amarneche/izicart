<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wilaya extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'wilayas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'wilaya',
        'wilaya_ar',
        'is_available',
        'default_cost',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function wilayaCommunes()
    {
        return $this->belongsToMany(Commune::class);
    }

    public function wilayaPaymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class);
    }

    public function shipToWilayasDeliveryCompanies()
    {
        return $this->belongsToMany(DeliveryCompany::class);
    }

    public function payment_methods()
    {
        return $this->belongsToMany(PaymentMethod::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
