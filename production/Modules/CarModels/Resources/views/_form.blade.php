<div class="card">
    <div class="card-head style-primary">
        <header>{{ $title }}</header>
    </div>
    <div class="card-body floating-label">

                <div class="form-group{{ $errors->has('car_company_id') ? ' has-error' : '' }}">
                    {{ Form::label('car_company_id', 'Company Name:') }}
                    {{ Form::select('car_company_id', $carCompanies, isset($carModel)?$carModel->carCompany->car_company_id:null,['class' => 'form-control']) }}
                    @if ($errors->has('car_company_id'))
                        <span class="help-block">
                    <strong>{{ $errors->first('car_company_id') }}</strong>
                </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('model_name') ? ' has-error' : '' }}">
                    {{ Form::text('model_name', null ,['class' => 'form-control']) }}
                    {{ Form::label('model_name', 'Model Name:') }}
                    @if ($errors->has('model_name'))
                        <span class="help-block">
                    <strong>{{ $errors->first('model_name') }}</strong>
                </span>
                    @endif
                </div>



    </div><!--end .card-body -->
    @include('commonbackend::layouts._form-action')

    <div class="spinnerLoader">
        <i class="ajax-loader medium animate-spin"></i>
    </div>

</div>