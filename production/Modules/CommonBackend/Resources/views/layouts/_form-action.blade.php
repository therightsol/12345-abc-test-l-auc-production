<div class="card-actionbar">
    <div class="card-actionbar-row">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                   <a href="{{ route(Helper::route('index')) }}" class="btn btn-flat btn-primary ink-reaction pull-left">Go Back</a>
                @endif
            @endforeach
        </div>
        <button type="submit" class="btn btn-flat btn-primary ink-reaction">{{ $buttonText }}</button>
    </div>
</div>