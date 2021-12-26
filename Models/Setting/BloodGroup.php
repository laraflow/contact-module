<?php

namespace Modules\Contact\Models\Setting;

use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Models\Setting\Catalog;

/**
 * @class BloodGroup
 * @package Modules\Contact\Models\Setting
 */
class BloodGroup extends Catalog
{
    /**
     * The attributes that are mass assignable.
     * 'enabled' => to handle status,
     * ['created_by', 'updated_by', 'deleted_by'] => for audit
     *
     * @var array
     */
    protected $fillable = [ 'name', 'remarks', 'additional_info', 'enabled', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['model_type'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'model_type' => BloodGroup::class,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('bloodGroup', function (Builder $builder) {
            $builder->where('model_type', '=', BloodGroup::class);
        });
    }

}
