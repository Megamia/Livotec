<?php
namespace Betod\Livotec\Models;

use Model;

/**
 * Model
 */
class Product extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string table in the database used by the model.
     */
    public $table = 'betod_livotec_product';

    protected $jsonable = ['thongso'];
    /**Relations */
    public $belongsTo = [
        'category' => 'Betod\Livotec\Models\Category'
    ];
    /* image preview*/
    public $attachOne = [
        'image' => 'System\Models\File'
    ];
    public $attachMany = [
        'gallery' => 'System\Models\File'
    ];

    /**
     * @var array rules for validation.
     */
    public $rules = [
    ];

}
