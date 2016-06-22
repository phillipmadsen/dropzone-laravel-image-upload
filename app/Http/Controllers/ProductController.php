<?php

namespace App\Http\Controllers;

use App\Helpers\Thumbnail;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Logic\Image\ImageRepository;
use App\Models\Product;
use App\Models\ProductFeature;
use App\Models\ProductVariant;
use App\Repositories\ProductRepository;
use App\User;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProductController extends controller
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var mixed
     */
    private $model;
    /**
     * @var mixed
     */
    private $user;
    /**
     * @var mixed
     */
    protected $img;

    /**
     * @param ProductRepository $productRepo
     * @param Product $model
     * @param User $user
     * @param ImageRepository $imageRepository
     */
    public function __construct(ProductRepository $productRepo, Product $model, User $user, ImageRepository $imageRepository)
    {
        $this->productRepository = $productRepo;
        $this->model             = $model;
        $this->user              = $user;
        $this->image             = $imageRepository;
    }

    /**
     * Display a listing of the Product.
     *
     * @param  Request    $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productRepository->pushCriteria(new RequestCriteria($request));
        $products = $this->productRepository->all();

        return view('backend.products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.products.create');
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param  CreateProductRequest $request
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('product_image_file'))
        {
            $file = $request->file('product_image_file');
            $file = $this->productRepository->uploadProductImage($file);

            $request->merge(['product_image' => $file->getFileInfo()->getFilename()]);

            $this->generateProductThumbnail($file);
        }

        $product = $this->productRepository->create($input, $request->except('attribute_name', 'product_attribute_value', 'product_image_file'));

        if (!empty($request->attribute_name))
        {
            foreach ($request->attribute_name as $key => $item)
            {
                $productVariant                          = new ProductVariant();
                $productVariant->attribute_name          = $item;
                $productVariant->product_attribute_value = $request->product_attribute_value[$key];
                $product->productVariants()->save($productVariant);
            }
        }

        if (!empty($request->feature_name))
        {
            foreach ($request->feature_name as $feature)
            {
                $productFeature               = new ProductFeature();
                $productFeature->feature_name = $feature;
                $product->productFeatures()->save($productFeature);

            }
        }

        Flash::success('Product saved successfully.');

        return redirect(route('admin.products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param  int        $id
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product))
        {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        return view('backend.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param  int        $id
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product))
        {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        return view('backend.products.edit')->with('product', $product);
    }

    /**
     * Update the specified Product in storage.
     *
     * @param  int                  $id
     * @param  UpdateProductRequest $request
     * @return Response
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->findWithoutFail($id);
        if ($request->hasFile('product_image_file'))
        {
            $file = $request->file('product_image_file');
            $file = $this->productRepository->uploadProductImage($file);
            $request->merge([
                'product_image' => $file->getFileInfo()->getFilename()
            ]);
            $this->generateProductThumbnail($file);
        }
        if (empty($product))
        {
            Flash::error('Product not found');
            return redirect(route('admin.products.index'));
        }
        $product->update($request->except('attribute_name', 'product_attribute_value', 'product_image_file', 'feature_name'));
        if (!empty($request->attribute_name))
        {
            foreach ($request->attribute_name as $key => $item)
            {
                $productVariant                          = new ProductVariant();
                $productVariant->attribute_name          = $item;
                $productVariant->product_attribute_value = $request->product_attribute_value[$key];
                $product->productVariants()->save($productVariant);
            }
        }
        if (!empty($request->feature_name))
        {
            foreach ($request->feature_name as $feature)
            {
                $productFeature               = new ProductFeature();
                $productFeature->feature_name = $feature;
                $product->productFeatures()->save($productFeature);
            }
        }
        $product = $this->productRepository->update($request->all(), $id);
        //ProductVariant::where('product_id', $product->id)->delete();
        Flash::success('Product updated successfully.');
        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  int        $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->findWithoutFail($id);

        if (empty($product))
        {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('admin.products.index'));
    }

    /**
     * @param array $variants
     * @return mixed
     */
    private function getProductVariants($variants = [])
    {
        if (isset($variants))
        {
            $variants = array_map(
                function ($v)
                {
                    return explode(':', $v);
                },
                explode(',', $variants)
            );
        }
        return $variants;
    }

    /**
     * @param array $features
     * @return mixed
     */
    private function getProductFeatures($features = [])
    {
        if (isset($features))
        {
            $features = array_map(
                function ($v)
                {
                    return explode(':', $v);
                },
                explode(',', $features)
            );
        }
        return $features;
    }

    /**
     * @param $file
     */
    private function generateProductThumbnail($file)
    {
        $sourcePath = $file->getPath() . '/' . $file->getFilename();
        $thumbPath  = $file->getPath() . '/thumb_' . $file->getFilename();
        Thumbnail::generate_image_thumbnail($sourcePath, $thumbPath);
    }
}
