<?php


namespace GroceryStore\PreOrderManagement\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CommonTrait
{

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "updated_by", "id")->withDefault();
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "deleted_by", "id")->withDefault();
    }

    public static function booted(): void
    {
        static::creating(function ($model): void 
        {
            if (auth('api')->check()) {
                if (in_array('created_by', $model->getFillable())) {
                    $model->created_by = auth('api')->user()->id;
                }
            }
        });

        static::updating(function ($model): void
        {
            if (auth('api')->check()) {
                if (in_array('updated_by', $model->getFillable())) {
                    $model->updated_by = auth('api')->user()->id;
                }
            }
        });

        static::deleting(function ($model): void 
        {
            if (auth('api')->check()) {
                if (!$model->deleted_by && in_array('deleted_by', $model->getFillable())) {
                    $model->deleted_by = auth('api')->user()->id;
                }
                $model->save();
            }
        });
    }
}
