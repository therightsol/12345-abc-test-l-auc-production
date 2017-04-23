<div class="card">
    <div class="card-head style-primary">
        <header>{{ $title }}</header>
    </div>
    <div class="card-body floating-label">

                <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                    {{ Form::text('company_name', null ,['class' => 'form-control']) }}
                    {{ Form::label('company_name', 'Category Name:') }}
                    @if ($errors->has('company_name'))
                        <span class="help-block">
                    <strong>{{ $errors->first('company_name') }}</strong>
                </span>
                    @endif
                </div>



    </div><!--end .card-body -->
    @include('commonbackend::layouts._form-action')

    <div class="spinnerLoader">
        <i class="ajax-loader medium animate-spin"></i>
    </div>

</div>