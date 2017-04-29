<div class="card">

    <div class="card-head style-primary">
        <header>{{ $title }}</header>
    </div>
    <div class="card-body form-horizontal">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group {{ $errors->has('logo') ? ' has-error' : '' }}">
                    {{ Form::label('logo', 'Logo:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-6">
                        @yield('insert-image-code')
                    </div>
                </div>
                <div class="form-group{{ $errors->has('max_allowed_bids') ? ' has-error' : '' }}">
                    {{ Form::label('max_allowed_bids', 'Max Allowed Bids:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::text('max_allowed_bids', isset($settings['max_allowed_bids'])? $settings['max_allowed_bids']: null,['class' => 'form-control']) }}
                    @if ($errors->has('max_allowed_bids'))
                            <span class="help-block">
                    <strong>{{ $errors->first('max_allowed_bids') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('max_allowed_days') ? ' has-error' : '' }}">
                    {{ Form::label('max_allowed_days', 'Max Allowed Days:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::text('max_allowed_days', isset($settings['max_allowed_days'])? $settings['max_allowed_days']: null ,['class' => 'form-control']) }}

                    @if ($errors->has('max_allowed_days'))
                            <span class="help-block">
                    <strong>{{ $errors->first('max_allowed_days') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('inspection_unique_id') ? ' has-error' : '' }}">
                    {{ Form::label('inspection_unique_id', 'Inspection Unique ID:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::text('inspection_unique_id', isset($settings['inspection_unique_id'])? $settings['inspection_unique_id']: null ,['class' => 'form-control']) }}

                    @if ($errors->has('inspection_unique_id'))
                            <span class="help-block">
                    <strong>{{ $errors->first('inspection_unique_id') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
                    {{ Form::label('currency', 'Currency:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::text('currency', isset($settings['currency'])? $settings['currency']: null ,['class' => 'form-control']) }}

                    @if ($errors->has('currency'))
                            <span class="help-block">
                    <strong>{{ $errors->first('currency') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('currency_symbol') ? ' has-error' : '' }}">
                    {{ Form::label('currency_symbol', 'Currency Symbol:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::text('currency_symbol', isset($settings['currency_symbol'])? $settings['currency_symbol']: null ,['class' => 'form-control']) }}

                    @if ($errors->has('currency_symbol'))
                            <span class="help-block">
                    <strong>{{ $errors->first('currency_symbol') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                    {{ Form::label('phone_number', 'Company Phone Number:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::text('phone_number', isset($settings['phone_number'])? $settings['phone_number']: null ,['class' => 'form-control']) }}

                    @if ($errors->has('phone_number'))
                            <span class="help-block">
                    <strong>{{ $errors->first('phone_number') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {{ Form::label('email', 'Company Email Address:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::text('email', isset($settings['email'])? $settings['email']: null ,['class' => 'form-control']) }}

                    @if ($errors->has('email'))
                            <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    {{ Form::label('address', 'Company Address:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::text('address', isset($settings['address'])? $settings['address']: null ,['class' => 'form-control']) }}

                    @if ($errors->has('address'))
                            <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('map_latitude') ? ' has-error' : '' }}">
                    {{ Form::label('map_latitude', 'Map Latitude:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::text('map_latitude', isset($settings['map_latitude'])? $settings['map_latitude']: null ,['class' => 'form-control']) }}

                        @if ($errors->has('map_latitude'))
                            <span class="help-block">
                    <strong>{{ $errors->first('map_latitude') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('map_longitude') ? ' has-error' : '' }}">
                    {{ Form::label('map_longitude', 'Map Longitude:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::text('map_longitude', isset($settings['map_longitude'])? $settings['map_longitude']: null ,['class' => 'form-control']) }}

                    @if ($errors->has('map_longitude'))
                            <span class="help-block">
                    <strong>{{ $errors->first('map_longitude') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('map_zoom') ? ' has-error' : '' }}">
                    {{ Form::label('map_zoom', 'Map Zoom:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::text('map_zoom', isset($settings['map_zoom'])? $settings['map_zoom']: null ,['class' => 'form-control']) }}

                    @if ($errors->has('map_zoom'))
                            <span class="help-block">
                    <strong>{{ $errors->first('map_zoom') }}</strong>
                </span>
                        @endif
                    </div>
                </div>


                <div class="form-group{{ $errors->has('copyright') ? ' has-error' : '' }}">
                    {{ Form::label('copyright', 'Copyright Text:', ['class' => 'control-label col-sm-4']) }}
                    <div class="col-sm-8">
                        {{ Form::textarea('copyright', isset($settings['copyright'])? $settings['copyright']: null ,['class' => 'form-control', 'rows' => 3]) }}

                    @if ($errors->has('copyright'))
                            <span class="help-block">
                    <strong>{{ $errors->first('copyright') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
            </div>
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