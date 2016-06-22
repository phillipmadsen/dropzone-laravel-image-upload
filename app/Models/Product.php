<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{

    public $table = 'products';
     protected $guarded = ['id'];



    public $fillable = [
        'name',
        'short_description',
        'description',
        'price',
        'product_name',
        'product_image',
        'pubished_at',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'short_description' => 'string',
        'description' => 'string',
        'price' => 'float',
        'product_name' => 'string',
        'product_image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];












    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function features()
    {
        return $this->hasMany(ProductFeature::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function productFeatures()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function invoiceProduct()
    {
        return $this->hasMany(InvoiceProduct::class, 'product_id');
    }

    public function quotationProduct()
    {
        return $this->hasMany(QuotationProduct::class, 'product_id');
    }

    public function qtemplateProduct()
    {
        return $this->hasMany(QtemplateProduct::class, 'product_id');
    }

    public function salesOrderProduct()
    {
        return $this->hasMany(SaleorderProduct::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }
    
    public function productImages()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

}
