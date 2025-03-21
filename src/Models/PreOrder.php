<?php

namespace GroceryStore\PreOrderManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GroceryStore\PreOrderManagement\Traits\CommonTrait;

class PreOrder extends Model
{
    use SoftDeletes, CommonTrait;


    protected $table = 'pre_orders';
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'phone',
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
}
