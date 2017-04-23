<div class="card">
    <div class="card-head style-primary">
        <header>{{ $title }}</header>
    </div>
    <div class="card-body floating-label">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {{ Form::text('title', null ,['class' => 'form-control']) }}
                    {{ Form::label('title', 'Title:') }}
                    @if ($errors->has('title'))
                        <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>

        <div style="text-align: center;" class="form-group{{ $errors->has('picture') ? ' has-error' : '' }}">
            @yield('insert-image-code')
            {{ Form::label('', 'Icon') }}
            @if ($errors->has('picture'))
                <span class="help-block">
                    <strong>{{ $errors->first('picture') }}</strong>
                </span>
            @endif
        </div>



    </div><!--end .card-body -->
    @include('commonbackend::layouts._form-action')

    <div class="spinnerLoader">
        <i class="ajax-loader medium animate-spin"></i>
    </div>

</div>

@section('js')
    @parent
    <script src="{{Module::asset("media:js/custom-functions.js")}}"></script>

@endsection