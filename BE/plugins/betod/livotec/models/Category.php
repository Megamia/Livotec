<?php namespace Betod\Livotec\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'betod_livotec_category';
    public $hasMany = [
        'products' => 'Betod\Livotec\Models\Product',
    ];
    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

}
