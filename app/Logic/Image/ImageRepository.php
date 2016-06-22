<?php

namespace App\Logic\Image;

use App\Models\Img;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class ImageRepository
{
    public function upload( $form_data )
    {

        $validator = Validator::make($form_data, Img::$rules, Img::$messages);

        if ($validator->fails()) {

            return Response::json([
                'error' => true,
                'message' => $validator->messages()->first(),
                'code' => 400
            ], 400);

        }

        $photo = $form_data['file'];

        $originalName = $photo->getClientOriginalName();
        $originalNameWithoutExt = substr($originalName, 0, - 4);

        $filename = $this->sanitize($originalNameWithoutExt);
        $allowed_filename = $this->createUniqueFilename( $filename );

        $filenameExt = $allowed_filename .'.jpg';

        $uploadSuccess1 = $this->original( $photo, $filenameExt );
        $uploadSuccess2 = $this->icon( $photo, $filenameExt );
	    $uploadSuccess3 = $this->catalog( $photo, $filenameExt );
	    $uploadSuccess4 = $this->grid( $photo, $filenameExt );
	    $uploadSuccess5 = $this->blogheader( $photo, $filenameExt );
	    $uploadSuccess6 = $this->productthumb( $photo, $filenameExt );
	    $uploadSuccess7 = $this->thumb( $photo, $filenameExt );
	    $uploadSuccess8 = $this->postimage( $photo, $filenameExt );

        if( !$uploadSuccess1 || !$uploadSuccess2 || !$uploadSuccess3 || !$uploadSuccess4 || !$uploadSuccess5 || !$uploadSuccess6 || !$uploadSuccess7 || !$uploadSuccess8 ) {

            return Response::json([
                'error' => true,
                'message' => 'Server error while uploading',
                'code' => 500
            ], 500);

        }

	   // Flash::success('Product Image Uploaded Successfully.');


        $sessionImg = new Img;
        $sessionImg->filename      = $allowed_filename;
        $sessionImg->original_name = $originalName;
        $sessionImg->save();

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);

    }

    public function createUniqueFilename( $filename )
    {
        $full_size_dir = Config::get('images.full_size');
        $full_image_path = $full_size_dir . $filename . '.jpg';

        if ( File::exists( $full_image_path ) )
        {
            // Generate token for image
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken;
        }

        return $filename;
    }

    /**
     * Optimize Original Image
     */
    public function original( $photo, $filename )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->encode('jpg')->save(Config::get('images.full_size') . $filename );

        return $image;
    }

    /**
     * Create Icon From Original
     */
    public function icon( $photo, $filename )
    {
        $manager = new ImageManager();
        $image = $manager->make( $photo )->encode('jpg')->resize(200, null, function($constraint){
	        $constraint->aspectRatio();
        })->save( Config::get('images.icon_size')  . $filename );

        return $image;
    }

    /**
     * Create Catalog image From Original  //'width'  => 440, 'height' => 586
     */
	public function catalog( $photo, $filename )
	{
		$manager = new ImageManager();
		$image = $manager->make( $photo )->encode('jpg')->resize(440, 586, function($constraint){
			$constraint->aspectRatio();
		})->save( Config::get('images.catalog_size') . $filename );

		return $image;
	}


	

    /**
     * Create Grid image From Original  //'width'  => 270, 'height' => 360
     */
	public function grid( $photo, $filename )
	{
		$manager = new ImageManager();
		$image = $manager->make( $photo )->encode('jpg')->resize(intval(270), 360, function($constraint){
			$constraint->aspectRatio();
		})->save( Config::get('images.grid_size')  . $filename );

		return $image;
	}

	/**
	 * Create blog_header From Original  860 x 400 pixels
	 */
	public function blogheader( $photo, $filename )
	{
		$manager = new ImageManager();
		$image = $manager->make( $photo )->encode('jpg')->resize(860, null, function($constraint){
			$constraint->aspectRatio();
		})->save( Config::get('images.blog_header_size')  . $filename );

		return $image;
	}
    
      /**
     * Create Product Thumb image From Original  //  100 x 75 pixels
     */ 
	public function productthumb( $photo, $filename )
	{
		$manager = new ImageManager();
		$image = $manager->make( $photo )->encode('jpg')->resize(100, null, function($constraint){
			$constraint->aspectRatio();
		})->save( Config::get('images.product_thumb')  . $filename );

		return $image;
	}

    /**
     * Create Thumb image From Original  //'width'  => 64, 'height' => 64
     */
	public function thumb( $photo, $filename )
	{
		$manager = new ImageManager();
		$image = $manager->make( $photo )->encode('jpg')->resize(64, null, function($constraint){
			$constraint->aspectRatio();
		})->save( Config::get('images.thumb_size')  . $filename );

		return $image;
	}

	/**
	 * Create post_size From Original  2000 x 1326 pixels  860 x 570 pixels
	 */
	public function postimage( $photo, $filename )
	{
		$manager = new ImageManager();
		$image = $manager->make( $photo )->encode('jpg')->resize(860, null, function($constraint){
			$constraint->aspectRatio();
		})->save( Config::get('images.post_size')  . $filename );

		return $image;
	}

    /**
     * Delete Image From Session folder, based on original filename
     */
    public function delete( $originalFilename)
    {

        $full_size_dir = Config::get('images.full_size');
        $icon_size_dir = Config::get('images.icon_size');
	    $post_size_dir = Config::get('images.post_size');
	    $blog_header_size_dir = Config::get('images.blog_header_size');
	    $grid_size_dir = Config::get('images.grid_size');
	    $catalog_size_dir = Config::get('images.catalog_size');
	    $product_thumb_dir = Config::get('images.product_thumb');
	    $thumb_size_dir = Config::get('images.thumb_size');

	    $sessionImg = Img::where('original_name', 'like', $originalFilename)->first();

        if(empty($sessionImg))
        {
            return Response::json([
                'error' => true,
                'code'  => 400
            ], 400);

        }

        $full_path1 = $full_size_dir . $sessionImg->filename . '.jpg';
        $full_path2 = $icon_size_dir . $sessionImg->filename . '.jpg';
	    $full_path3 = $post_size_dir . $sessionImg->filename . '.jpg';
	    $full_path4 = $grid_size_dir . $sessionImg->filename . '.jpg';
	    $full_path5 = $blog_header_size_dir . $sessionImg->filename . '.jpg';
	    $full_path6 = $catalog_size_dir . $sessionImg->filename . '.jpg';
	    $full_path7 = $product_thumb_dir . $sessionImg->filename . '.jpg';
	    $full_path8 = $thumb_size_dir . $sessionImg->filename . '.jpg';

	    if ( File::exists( $full_path1 ) ) {File::delete( $full_path1 ); }
	    if ( File::exists( $full_path2 ) ) {File::delete( $full_path2 ); }
	    if ( File::exists( $full_path3 ) ) {File::delete( $full_path3 ); }
	    if ( File::exists( $full_path4 ) ) {File::delete( $full_path4 ); }
	    if ( File::exists( $full_path5 ) ) {File::delete( $full_path5 ); }
	    if ( File::exists( $full_path6 ) ) {File::delete( $full_path6 ); }
	    if ( File::exists( $full_path7 ) ) {File::delete( $full_path7 ); }
	    if ( File::exists( $full_path8 ) ) {File::delete( $full_path8 ); }

        if( !empty($sessionImg))
        {
            $sessionImg->delete();
        }

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);
    }

    function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }
}
