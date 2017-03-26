@extends('commonbackend::layouts.admin_app')
@include('media::layoutfiles.embedd')

@section('style')
    <link href="{{Module::asset('commonbackend:admin_assets/bootstrap3-editable/css/bootstrap-editable.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ Module::asset('commonbackend:admin_assets/css/theme-default/libs/multi-select/multi-select.css?1424887857') }}" />

    <style>
        .ms-selection .ms-elem-selection{
            color:#0aa89e !important;
        }
    </style>
@endsection
@section('content')
    <div id="content">
        <section class="">
            <div class="section-header">
                <h2 class="text-primary">Update Car</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('commonbackend::layouts._alert-response')
                    </div><!--end .col -->
                    <div class="col-lg-10 col-lg-offset-1">
                        {!! Form::model($car,['route' => [Helper::route('update'), $car->id], 'method'=>'put', 'class' => 'form']) !!}

                        @include('cars::_form', [
                        'buttonText' => 'Submit',
                        'title' => 'Update Car',
                        ])
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script src="{{ Module::asset('commonbackend:admin_assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ Module::asset('commonbackend:admin_assets/js/libs/multi-select/jquery.multi-select.js') }}"></script>
    <script src="{{Module::asset("media:js/custom-functions.js")}}"></script>

    <script>
        $('#allCategories').multiSelect({
            selectableHeader: "<div class='custom-header'>All Categories</div>",
            selectionHeader: "<div class='text-primary'><strong>Selected Currencies</strong></div>",
        });
        $('#allFeatures').multiSelect({
            selectableHeader: "<div class='custom-header'>All Features</div>",
            selectionHeader: "<div class='text-primary'><strong>Selected Features</strong></div>",
        });

        var spinner = $('.spinnerLoader');
        $('.date').datepicker({
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        }).on('changeDate', function(e){
            $(this).datepicker('hide');
        });

        $('select[name=company_id]').change(function () {
            var val = $(this).val();
            if(!val){
                $('select[name=car_model_id]').find('option')
                        .remove()
                        .end()
                        .append(render_options([]));
                return;
            }
            $.ajax( {
                url: "{{ route('admin.getModels') }}",
                type: 'POST',
                data: { 'id': val },
                success: function ( data ) {
                    $('select[name=car_model_id]').find('option')
                            .remove()
                            .end()
                            .append(render_options(data, {{ old('car_model_id')?:$car->carModel->id }}));

                },
                beforeSend: function () {
                    spinner.css('display', 'flex')
                },
                complete: function () {
                    spinner.hide();
                }
            }  );
        }).trigger('change');

        function render_options ( arr , model_id ) {
            console.log(arr);
            var strOptions,selected;
            if ( arr.length < 1 ) {
                strOptions = "<option value=''>No Model Found</option>"
                return strOptions;
            }
            strOptions = '<option value="">Select Model</option>';

            $.each( arr, function ( i, returnedData ) {

                (arr[ i ][ 'id' ] === model_id) ? selected = 'selected' : selected = false;
                strOptions += '<option '+ selected +' value="' + arr[ i ][ 'id' ] + '">' + arr[ i ][ 'model_name' ] + '</option>';
            } );

            return strOptions;
        }
    </script>




@endsection