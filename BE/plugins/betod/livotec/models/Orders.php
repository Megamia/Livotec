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
    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

}
