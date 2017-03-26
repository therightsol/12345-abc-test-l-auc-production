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
    <div class="card-actionbar">
        <div class="card-actionbar-row">
          {{--  @if(url()->current() !== url()->previous())
                <a href="{{ url()->previous() }}" class="btn btn-flat btn-primary ink-reaction pull-left">Go Back</a>
            @endif--}}
            <button type="submit" class="btn btn-flat btn-primary ink-reaction">{{ $buttonText }}</button>
        </div>
    </div>
    <div class="spinnerLoader">
        <i class="ajax-loader medium animate-spin"></i>
    </div>

</div>