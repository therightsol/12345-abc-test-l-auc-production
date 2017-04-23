<div class="card">
    <div class="card-head style-primary">
        <header>{{ $title }}</header>
    </div>
    <div class="card-body floating-label">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {{ Form::text('title', null ,['class' => 'form-control']) }}
                    {{ Form::label('title', 'Model Name:') }}
                    @if ($errors->has('title'))
                        <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>



    </div><!--end .card-body -->
    @include('commonbackend::layouts._form-action')

    <div class="spinnerLoader">
        <i class="ajax-loader medium animate-spin"></i>
    </div>

</div>