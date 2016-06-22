<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use \Venturecraft\Revisionable\RevisionableTrait;

class ProductFeature extends Model
{
    use RevisionableTrait;

    protected $dates = ['deleted_at'];
    protected $guarded  = array('id');
    protected $table = 'product_features';
}

