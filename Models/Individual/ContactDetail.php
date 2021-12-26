<?php

namespace Modules\Contact\Models\Individual;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use Modules\Contact\Models\Setting\BloodGroup;
use Modules\Contact\Models\Setting\Gender;
use Modules\Contact\Models\Setting\Occupation;
use Modules\Contact\Models\Setting\Relation;
use Modules\Contact\Models\Setting\Religion;
use Modules\Core\Models\Setting\User;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @class ContactDetail
 * @package Modules\Contact\Models\Individual
 */
class ContactDetail extends Model implements Auditable
{
    use AuditableTrait, HasFactory, SoftDeletes, Sortable;

    /**
     * @var string $table
     */
    protected $table = 'contact_details';

    /**
     * @var string $primaryKey
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * 'enabled' => to handle status,
     * ['created_by', 'updated_by', 'deleted_by'] => for audit
     *
     * @var array
     */
    protected $fillable = ['contact_id', 'birth', 'anniversary', 'location', 'mileage',
        'hobby', 'sensitivity', 'priority', 'language', 'website', 'gender_id',
        'blood_group_id', 'religion_id', 'relation_id', 'occupation_id',
        'group_id', 'enabled', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birth' => 'date',
        'anniversary' => 'date',

    ];

    /**
     * The model's default values for attributes when new instance created.
     *
     * @var array
     */
    protected $attributes = [
        'enabled' => 'yes'
    ];

    /************************ Static Factory ************************/

    /*
    protected static function newFactory()
    {
        return \Modules\Contact\Database\Factories\Individual/ContactDetailFactory::new();
    }
    */

    /************************ Audit Relations ************************/

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * @return BelongsTo
     */
    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    /************************ Audit Relations ************************/

    /**
     * @return BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function bloodGroup(): BelongsTo
    {
        return $this->belongsTo(BloodGroup::class, 'blood_group_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religion::class, 'religion_id', 'id');
    }

        /**
     * @return BelongsTo
     */
    public function relation(): BelongsTo
    {
        return $this->belongsTo(Relation::class, 'relation_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class, 'occupation_id', 'id');
    }
}
