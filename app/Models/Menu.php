<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const PLACEMENT_SELECT = [
        'header'        => 'Header',
        'footer'        => 'Footer',
        'header-mobile' => 'Mobile Header',
        'footer-mobile' => 'Footer Mobile',
    ];

    public $table = 'menus';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'placement',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function menuMenuItems()
    {
        return $this->hasMany(MenuItem::class, 'menu_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
