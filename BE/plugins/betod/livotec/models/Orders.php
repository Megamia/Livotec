<?php
namespace Betod\Livotec\Models;

use Model;

/**
 * Model
 */
class Orders extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'betod_livotec_orders';
    public $jsonable = ['property'];
    protected $fillable = [
        'user_id',
        'property',
    ];

    public function getStateLabelAttribute()
    {
        $statuses = [
            0 => 'Chưa chuyển',
            1 => 'Đang vận chuyển',
            2 => 'Đã giao'
        ];

        return $statuses[$this->state_id] ?? 'Không xác định';
    }
    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

}
