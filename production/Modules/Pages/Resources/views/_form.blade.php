<div class="card">
    <div class="card-head style-primary">
        <header>{{ $title }}</header>
    </div>
    <div class="card-body floating-label">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {{ Form::text('title', ($page['title'])?:null ,['class' => 'form-control']) }}
                    {{ Form::label('title', 'Title:') }}
                    @if ($errors->has('title'))
                        <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('post_status_id') ? ' has-error' : '' }}">
                    {{ Form::label('post_status_id', 'Enable:') }}
                    {{ Form::select('post_status_id', $postStatuses, ($page['post_status_id'])?:null ,['class' => 'form-control']) }}
                    @if ($errors->has('post_status_id'))
                        <span class="help-block">
                    <strong>{{ $errors->first('post_status_id') }}</strong>
                </span>
                    @endif
                </div>

        <div style="text-align: center;" class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
            {{ Form::label('', 'Content', ['style' => '    top: -6px;']) }}

            {!! Form::textarea('content', ($page['content'])?:null ,['class' => 'form-control']) !!}
            @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
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

@section('js')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.5/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    <script src="{{Module::asset("media:js/custom-functions.js")}}"></script>

@endsection