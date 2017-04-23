@section('style')
    @parent
    <link href="{{Module::asset('commonbackend:admin_assets/bootstrap3-editable/css/bootstrap-editable.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ Module::asset('commonbackend:admin_assets/css/theme-default/libs/multi-select/multi-select.css?1424887857') }}" />

    <style>
        .ms-selection .ms-elem-selection{
            color:#0aa89e !important;
        }
    </style>
@endsection

<div class="card">
    <div class="card-head style-primary">
        <header>{{ $title }}</header>
    </div>
    <div class="card-body floating-label">
        <div class="row">


            <div class="col-sm-6">
                <div style="text-align: center;" class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
                    @yield('insert-image-code')
                    {{ Form::label('', '') }}
                    @if ($errors->has('picture'))
                        <span class="help-block">
                    <strong>{{ $errors->first('picture') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('gallery') ? ' has-error' : '' }}">
                    @yield('insert-image-gallery')
                    {{ Form::label('gallery', 'Image Gallery') }}
                    @if ($errors->has('gallery'))
                        <span class="help-block">
                    <strong>{{ $errors->first('gallery') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {{ Form::text('title', null ,['class' => 'form-control']) }}
                    {{ Form::label('title', 'Title') }}
                    @if ($errors->has('title'))
                        <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('manufacturing_year') ? ' has-error' : '' }}">
                    {{ Form::text('manufacturing_year', null ,['class' => 'date form-control']) }}
                    {{ Form::label('manufacturing_year', 'Manufacturing Year') }}
                    @if ($errors->has('manufacturing_year'))
                        <span class="help-block">
                    <strong>{{ $errors->first('manufacturing_year') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('company_id') ? ' has-error' : '' }}">
                    {{ Form::label('company_id', 'Company') }}
                    {{ Form::select('company_id', $carCompanies, isset($car)?$car->carModel->carCompany->id:null,['class' => 'form-control','placeholder' => 'Select Company']) }}
                    @if ($errors->has('company_id'))
                        <span class="help-block">
                    <strong>{{ $errors->first('company_id') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('car_model_id') ? ' has-error' : '' }}">
                    {{ Form::label('car_model_id', 'Model') }}
                    {{ Form::select('car_model_id', isset($car)?$carCompanyModels:[], null,['class' => 'form-control','placeholder' => 'Select Model']) }}
                @if ($errors->has('car_model_id'))
                        <span class="help-block">
                    <strong>{{ $errors->first('car_model_id') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('engine_type_id') ? ' has-error' : '' }}">
                    {{ Form::label('engine_type_id', 'Engine Type') }}
                    {{ Form::select('engine_type_id', $engine_types, isset($car->engineType->title)?$car->engineType->title:null,['class' => 'form-control','placeholder' => 'Select Engine Type']) }}
                    @if ($errors->has('engine_type_id'))
                        <span class="help-block">
                    <strong>{{ $errors->first('engine_type_id') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('trim') ? ' has-error' : '' }}">
                    {{ Form::text('trim', null ,['class' => 'form-control']) }}
                    {{ Form::label('trim', 'Trim') }}
                    @if ($errors->has('trim'))
                        <span class="help-block">
                    <strong>{{ $errors->first('trim') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('exterior_color') ? ' has-error' : '' }}">
                    {{ Form::label('exterior_color', 'Exterior Color') }}
                    {{ Form::color('exterior_color', null ,['class' => 'form-control']) }}
                    @if ($errors->has('exterior_color'))
                        <span class="help-block">
                    <strong>{{ $errors->first('exterior_color') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('interior_color') ? ' has-error' : '' }}">
                    {{ Form::color('interior_color', null ,['class' => 'form-control']) }}
                    {{ Form::label('interior_color', 'Interror Color') }}
                    @if ($errors->has('interior_color'))
                        <span class="help-block">
                    <strong>{{ $errors->first('interior_color') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('grade') ? ' has-error' : '' }}">
                    {{ Form::label('grade', 'Grade') }}
                    {{ Form::select('grade', ['A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'], isset($car)?$car->grade:null,['class' => 'form-control','placeholder' => 'Select Car Grade']) }}

                @if ($errors->has('grade'))
                        <span class="help-block">
                    <strong>{{ $errors->first('grade') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('engine_number') ? ' has-error' : '' }}">
                    {{ Form::text('engine_number', null ,['class' => 'form-control']) }}
                    {{ Form::label('engine_number', 'Engine Number') }}
                    @if ($errors->has('engine_number'))
                        <span class="help-block">
                    <strong>{{ $errors->first('engine_number') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('kilometers') ? ' has-error' : '' }}">
                    {{ Form::number('kilometers', null ,['min' => 0, 'class' => 'form-control']) }}
                    {{ Form::label('kilometers', 'Kilometer') }}
                    @if ($errors->has('kilometers'))
                        <span class="help-block">
                    <strong>{{ $errors->first('kilometers') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('chassis_number') ? ' has-error' : '' }}">
                    {{ Form::text('chassis_number', null ,['class' => 'form-control']) }}
                    {{ Form::label('chassis_number', 'Chassis Number') }}
                    @if ($errors->has('chassis_number'))
                        <span class="help-block">
                    <strong>{{ $errors->first('chassis_number') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('number_plate') ? ' has-error' : '' }}">
                    {{ Form::text('number_plate', null ,['class' => 'form-control']) }}
                    {{ Form::label('number_plate', 'Number Plate') }}
                    @if ($errors->has('number_plate'))
                        <span class="help-block">
                    <strong>{{ $errors->first('number_plate') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('transmission') ? ' has-error' : '' }}">
                    {{ Form::label('transmission', 'Transmission') }}
                    {{ Form::select('transmission', ['automatic' => 'Automatic', 'manual' => 'Manual'], isset($car)?$car->transmission:null,['class' => 'form-control','placeholder' => 'Select Engine Type']) }}

                @if ($errors->has('transmission'))
                        <span class="help-block">
                    <strong>{{ $errors->first('transmission') }}</strong>
                </span>
                    @endif
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('city_of_registration') ? ' has-error' : '' }}">
                    {{ Form::text('city_of_registration', null ,['class' => 'form-control']) }}
                    {{ Form::label('city_of_registration', 'City of registration') }}
                    @if ($errors->has('city_of_registration'))
                        <span class="help-block">
                    <strong>{{ $errors->first('city_of_registration') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('body_type') ? ' has-error' : '' }}">
                    {{ Form::text('body_type', null ,['class' => 'form-control']) }}
                    {{ Form::label('body_type', 'Body Type') }}
                    @if ($errors->has('body_type'))
                        <span class="help-block">
                    <strong>{{ $errors->first('body_type') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group{{ $errors->has('drivetrain') ? ' has-error' : '' }}">
                    {{ Form::text('drivetrain', null ,['class' => 'form-control']) }}
                    {{ Form::label('drivetrain', 'Drivetrain') }}
                    @if ($errors->has('drivetrain'))
                        <span class="help-block">
                    <strong>{{ $errors->first('drivetrain') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group{{ $errors->has('categories') ? ' has-error' : '' }}">
                    {{ Form::select('categories[]', $categories, isset($car->categories)?$car->categories->pluck('id')->toArray():null, ['multiple' => true, 'class' => 'form-control', 'id' => 'allCategories']) }}
                    @if ($errors->has('categories'))
                        <span class="help-block">
                    <strong>{{ $errors->first('categories') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group{{ $errors->has('features') ? ' has-error' : '' }}">
                    {{ Form::select('features[]', $features , isset($car->features)?$car->features->pluck('id')->toArray():null, ['multiple' => true, 'class' => 'form-control', 'id' => 'allFeatures']) }}
                    @if ($errors->has('features'))
                        <span class="help-block">
                    <strong>{{ $errors->first('features') }}</strong>
                </span>
                    @endif
                </div>
            </div>
        </div>



    </div><!--end .card-body -->

    @include('commonbackend::layouts._form-action')

    <div class="spinnerLoader">
        <i class="ajax-loader medium animate-spin"></i>
    </div>

</div>

@section('js')
    @parent

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
                        .append(render_options(data, {{ old('car_model_id')?:isset($car)?$car->carModel->id: "undefined" }}));

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