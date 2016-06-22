<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Img
 * @package App\Models
 */
class Img extends Model
{


	public $table = 'images';

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';


	protected $dates = ['deleted_at'];


	public $fillable = [
		'original_name',
		'filename'
	];

	/**
	 * The attributes that should be casted to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'id' => 'integer',
		'original_name' => 'string',
		'filename' => 'string'
	];

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public static $rules = [

	];


	public function product()
	{
		return $this->belongsTo(Product::class, 'image_product', 'image_id', 'product_id');
	}


}
