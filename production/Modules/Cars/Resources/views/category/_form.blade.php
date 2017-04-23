<div class="card">
    <div class="card-head style-primary">
        <header>{{ $title }}</header>
    </div>
    <div class="card-body floating-label">

                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    {{ Form::text('category', null ,['class' => 'form-control']) }}
                    {{ Form::label('category', 'Category Name:') }}
                    @if ($errors->has('category'))
                        <span class="help-block">
                    <strong>{{ $errors->first('category') }}</strong>
                </span>
                    @endif
                </div>
    </div><!--end .card-body -->
    @include('commonbackend::layouts._form-action')

    <div class="spinnerLoader">
        <i class="ajax-loader medium animate-spin"></i>
    </div>

</div>