@extends('layouts.app')

@section('content')
	<div class="container">
	<!-- /.container -->
    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Create New Product</h1>
        </div>
    </div>

    @include('core-templates::common.errors')

    <div class="row">
        {!! Form::open(['route' => 'admin.products.store', 'method' => 'post', 'novalidate' => 'novalidate',  'files'=> true]) !!}

            @include('backend.products.fields')
            @include('backend.products.partials.productvariants')

            @include('backend.products.partials.productfeatures')



			    <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{!! route('admin.products.index') !!}" class="btn btn-default">Cancel</a>
            </div>


        {!! Form::close() !!}

	    <br style="clear:both" />
	    <br style="clear:both" />

	    {!! Form::open(['url' => route('upload-post'), 'class' => 'dropzone', 'files'=>true, 'id'=>'real-dropzone']) !!}

	    <div class="dz-message">

	    </div>

	    <div class="fallback">
		    <input name="file" type="file" multiple />
	    </div>

	    <div class="dropzone-previews" id="dropzonePreview"></div>


	    <h4 style="text-align: center;color:#428bca;">Drop images in this area  <span class="glyphicon glyphicon-hand-down"></span></h4>

	    {!! Form::close() !!}



	    <br style="clear:both" />


	    {{--@include('dropzoner::dropzone')--}}
    </div>
	</div>
@endsection
