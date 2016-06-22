@extends('layouts.app')

@section('content')
    @include('backend.products.show_fields')

    <div class="form-group">
           <a href="{!! route('admin.products.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
