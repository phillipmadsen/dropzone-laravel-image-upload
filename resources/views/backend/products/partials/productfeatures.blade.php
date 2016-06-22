

 
<div class="form-group">
    {!! Form::label('features', trans('product.features'), array('class' => 'control-label')) !!}
    <div class="panel-content">

        <table class="table">
            <thead>
            <tr>
                <th>{{trans('product.feature_name')}}</th>
               
                <th>{{trans('product.options')}}</th>
            </tr>
            </thead>
            <tbody id="FeatureInputsWrapper">
            @if(isset($product) && $product->features->count()>0)
                @foreach($product->features as $features)
                    <tr>
                        <td><input type="text" class="form-control" value="{{$features->feature_name}}"name="feature_name[]"></td>
                        <td><a data-target="#modal-basic" data-toggle="modal"class="delete removeclass" href="javascript:void(0)"> <i class="fa fa-fw fa-times text-danger"></i> </a> </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td><input type="text" class="form-control" value="" name="feature_name[]"></td>
                    <td><a data-target="#modal-basic" data-toggle="modal"class="delete removeclass" href="javascript:void(0)"> <i class="fa fa-fw fa-times text-danger"></i> </a> </td>
                </tr>
            @endif
            </tbody>
        </table>
        <a id="AddMoreFeatureBox" href="#">
            <button class="btn btn-sm btn-primary" type="button"><i
                        class="fa fa-plus"></i> {{trans('product.add_item')}}
            </button>
        </a>
    </div>
</div>
 
    <script>
        $(document).ready(function () {

            var MaxInputs = 50; //maximum input boxes allowed
            var FeatureInputsWrapper = $("#FeatureInputsWrapper"); //Input boxes wrapper ID
            var AddButton = $("#AddMoreFeatureBox"); //Add button ID

            var x = FeatureInputsWrapper.length; //initlal text box count
            var FieldCount = 1; //to keep track of text box added

            $(AddButton).click(function (e)  //on add input button click
            {
                if (x <= MaxInputs) //max input box allowed
                {
                    FieldCount++; //text box added increment
                    //add input box
                    $(FeatureInputsWrapper).append('<tr><td><input type="text" name="feature_name[]" value="" class="form-control"></td><td><a href="javascript:void(0)" class="delete removeclass" data-toggle="modal" data-target="#modal-basic"><i class="fa fa-fw fa-times text-danger"></i></a></td></tr>');
                    x++; //text box increment
                }
                return false;
            });

            $("#FeatureInputsWrapper").on("click", ".removeclass", function (e) { //user click on remove text
                @if(!isset($product))
                if (x > 1) {
                    $(this).parent().parent().remove(); //remove text box
                    x--; //decrement textbox
                }
                @else
                    $(this).parent().parent().remove(); //remove text box
                x--; //decrement textbox
                @endif
                        return false;
            })

        });
    </script>
