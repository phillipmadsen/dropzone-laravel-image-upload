<?php

namespace App\Repositories;

use App\Models\Product;

use App\User;
use App\Models\Img;
use Illuminate\Support\Str;
use File;
use Input;
use InfyOm\Generator\Common\BaseRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductRepository extends BaseRepository
{

  protected $model;
  protected $user;

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
	public function model()
	{
        return Product::class;
	}

	//public function create(array $data)
	//{
	//	$model = $this->user->products()->create($data);
	//	return $model;
	//}

	public function uploadProductImage(UploadedFile $file)
  {
    $extension = $file->getClientOriginalExtension();
    $filename = $file->getClientOriginalName();
    $slug = pathinfo($filename, 0, strrpos($filename, PATHINFO_FILENAME));
    $destinationPath = public_path() . '/uploads/products/'. $slug;
    if(!file_exists($destinationPath)) File::makeDirectory($destinationPath);
    $picture = Str::slug(substr($filename, 0, strrpos($filename, "."))) . '_' . time() . '.' . $extension;
    //$picture = $slug . "." . $extension;
    return $file->move($destinationPath, $picture);
  }


}
