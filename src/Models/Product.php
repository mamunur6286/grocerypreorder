<?php

namespace GroceryStore\PreOrderManagement\Models;

use GroceryStore\PreOrderManagement\Traits\CommonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, CommonTrait;


    protected $table = 'pre_orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'unique_id',
        'name',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    const PENDING = 1, APPROVED = 2;

    const STATUS = [
        1 => 'Pending',
        2 => 'Approved'
    ];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->unique_id = generateUniqueID('PREO-', $model->id, 8);
            $model->save();
        });
    }
}
