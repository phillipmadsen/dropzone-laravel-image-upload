<!-- Name Field -->
<div class="form-group col-sm-6 col-md-6 col-lg-6">
    {!! Form::label('name', trans('products.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
{{-- AddToLang 'name' => 'Name', --}}


<!-- Short Description Field -->
<div class="form-group col-sm-12 col-md-12 col-lg-12">
    {!! Form::label('short_description', trans('products.short_description')) !!}
    {!! Form::textarea('short_description', null, ['class' => 'form-control summernote', 'rows' => '5']) !!}
</div>
{{-- AddToLang 'short_description' => 'Short Description', --}}


<!-- Description Field -->
<div class="form-group col-sm-12 col-md-12 col-lg-12">
    {!! Form::label('description', trans('products.description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'rows' => '5']) !!}
</div>
{{-- AddToLang 'description' => 'Description', --}}


<!-- Price Field -->
<div class="form-group col-md-2">
    {!! Form::label('price', trans('products.price')) !!} <small class="text-success">0.00</small>
    {!! Form::number('price', null, ['class' => 'form-control currency']) !!}
</div>
{{-- AddToLang 'price' => 'Price', --}}


<br style="clear:both" />
<!-- Product Name Image Field -->
<div class="form-group col-sm-6">
	<div class="col-sm-12">
 		{!! Form::label('product_name', trans('products.product_name')) !!}
    
		<div class="fileupload fileupload-new control-group {!! $errors->has('product_image_file') ? 'has-error' : '' !!}" data-provides="fileinput">
			@if(isset($product->product_image) && $product->product_image !="")
      <div class="fileupload-new thumbnail"> 
			{!! BootImage::thumbnail(  url('/uploads/products'.$product->product_image) , $alt = '$product->product_name')->responsive() !!}
			</div>
      @else 
        {!! BootImage::thumbnail('http://www.placehold.it/400x400/00268A/AAAAAA?text=add+image')->responsive() !!}
      @endif
           
             
			{{-- <div class="fileupload-preview fileupload-exists thumbnail" style="width: 400px; height: 400px; line-height: 20px;min-width: 200px; min-height: 200px; max-width: 500px; max-height: 400px;"></div> --}}
			<div>
				<span class="btn btn-light-grey btn-file">
				<span class="fileupload-new"><i class="fa fa-picture-o"></i>{{trans('dashboard.select_image')}}</span>
				<span class="fileupload-exists"><i class="fa fa-picture-o"></i> {{trans('dashboard.change')}}</span>
					{!! Form::file('product_image', null, ['class'=>'form-control', 'id' => 'product_image', 'value'=>Input::old('product_image')]) !!}
					        @if ($errors->first('product_image'))
						        <span class="help-block">{!! $errors->first('product_image_file') !!}</span>
					        @endif
				</span>
				<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload"><i class="fa fa-times"></i> Remove</a>
			</div>
		</div>
	</div>
</div>
<br style="clear:both" />
 
 
{{-- AddToLang 'product_name' => 'Product Name', --}}


 
    
 
 
{{-- AddToLang 'product_image' => 'Product Image', --}}


<!-- Pubished At Field -->
<div class="form-group col-md-3">
    {!! Form::label('pubished_at', trans('products.pubished_at')) !!}
    {!! Form::date('pubished_at', null, ['class' => 'form-control']) !!}
</div>
{{-- AddToLang 'pubished_at' => 'Pubished At', --}}

