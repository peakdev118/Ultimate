@extends('layouts.app')
@section('title', __('Product stock history'))

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>@lang('Product stock history')</h1>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
    @component('components.widget', ['title' => $product->name])
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('tank_id',  __('Tank') . ':') !!}
                <select class="select2 form-control tank-id" name="tank_id" style="width:100%">
                    @foreach($tanks as $tank)
                        <option value="{{ $tank->id }}">{{ $tank->fuel_tank_number }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}">
       
    @endcomponent
    @component('components.widget')
        <div id="product_stock_history" style="display: none;"></div>
    @endcomponent
    </div>
</div>

</section>
<!-- /.content -->
@endsection

@section('javascript')
   <script type="text/javascript">
        $(document).ready( function(){
            load_stock_history($('#product_id').val(), $('#location_id').val());
            changeTank($('#product_id').val(), $('#location_id').val());
        });

       function load_stock_history(product_id, location_id) {
            $('#product_stock_history').fadeOut();
            $.ajax({
                url: '/products/tank-stock-history/' + product_id + "?location_id=" + location_id + "&tank_id=" + $('.tank-id').val(),
                dataType: 'html',
                success: function(result) {
                    $('#product_stock_history')
                        .html(result)
                        .fadeIn();

                    __currency_convert_recursively($('#product_stock_history'));

                    $('#stock_history_table').DataTable({
                        searching: false,
                        ordering: false
                    });
                },
            });
       }
       
       function changeTank(product_id, location_id)
       {
           $.ajax({
                url: '/products/stock-history/get-tanks/'+product_id+ "?location_id=" + location_id,
                dataType: 'json',
                success: function(result) {
                    if(result.success == 1){
                        $('.tank-id').empty();
                        result.data.map(function (v, i){
                            $('.tank-id').append(`
                                <option value="${v.id}">${v.fuel_tank_number}</option>
                            `); 
                        });
                    }
                },
            });
       }

       $(document).on('change', '#product_id, .tank-id', function(){
            load_stock_history($('#product_id').val(), $('#location_id').val());
       });

       $(document).on('change', '#location_id', function(){
    	   changeTank($('#product_id').val(), $('#location_id').val());
           load_stock_history($('#product_id').val(), $('#location_id').val());
      });
   </script>
@endsection