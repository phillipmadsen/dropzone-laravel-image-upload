<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductFeature extends Model
{

    protected $dates = ['deleted_at'];
    protected $guarded  = array('id');
    protected $table = 'product_features';
}

