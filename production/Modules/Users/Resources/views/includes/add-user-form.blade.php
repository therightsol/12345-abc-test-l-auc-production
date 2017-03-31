@yield('form-open', '<form class="form"  id="modal-form" data-uid="" method="post" >')
{{csrf_field()}}
@yield('form-alerts', '')
<div class="card">
    @if(!isset($user_saved))
    <div class="card-head style-primary">
        @yield('form-title')
    </div>


    <div class="card-body floating-label">

        <div class="row">
            <div class="col-sm-7">
                <div class="form-group {{ $errors->has('full_name') ? 'has-error' : ''}}">
                    <input autofocus type="text" class="form-control"  tabindex="1"
                           value="@if(!empty(old('full_name'))){{old('full_name')}}@elseif(isset($user->full_name)){{$user->full_name}}@endif" id="full_name"
                           name="full_name">
                    <label for="full_name">Full Name</label>
                    {!! $errors->first('full_name', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
                    <input type="text" class="form-control"  tabindex="2"
                           value="@if(!empty(old('username'))){{old('username')}}@elseif(isset($user->username)){{$user->username}}@endif"
                           name="username" id="username">
                    <label for="username">Username</label>
                    {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    <input type="email" class="form-control"  tabindex="3"
                           value="@if(!empty(old('email'))){{old('email')}}@elseif(isset($user->email)){{$user->email}}@endif"
                           name="email" id="email">
                    <label for="email">Email</label>
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-12 nopadding">
                    <div class="col-sm-6 no-left-padding">
                        <div class="form-group {{ $errors->has('cnic') ? 'has-error' : ''}}">
                            <input type="text" class="form-control"  tabindex="4"
                                   value="@if(!empty(old('cnic'))){{old('cnic')}}@elseif(isset($user->cnic)){{$user->cnic}}@endif"
                                   name="cnic" id="cnic">
                            <label for="cnic">CNIC</label>
                            {!! $errors->first('cnic', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="col-sm-6 no-right-padding">
                        <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : ''}}">
                            <input type="text" class="form-control"  tabindex="5"
                                   value="@if(!empty(old('contact_number'))){{old('contact_number')}}@elseif(isset($user->contact_number)){{$user->contact_number}}@endif"
                                   name="contact_number" id="contact_number">
                            <label for="contact_number">Contact Number</label>
                            {!! $errors->first('contact_number', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 text-center">

                @yield('insert-image-code')


            </div>

        </div>

        @yield('password')

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group {{ $errors->has('url') ? 'has-error' : ''}}">
                    <input type="text"  tabindex="8" class="form-control" value="@if(!empty(old('url'))){{old('url')}}@elseif(isset($user->url)){{$user->url}}@endif" name="url" id="url">
                    <label for="url">URL</label>
                    {!! $errors->first('url', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group {{ $errors->has('user_role') ? 'has-error' : ''}}">

                    <label for="user_role">User Role</label>

                    <select  tabindex="9" class="form-control select2-list" name="user_role" id="user_role"
                            data-placeholder="Select Role">
                        <option selected value="">Choose Role</option>
                        <optgroup label="User Roles">
                            @foreach($userroles as $userrole)
                                <option value="{{$userrole}}" {!! old('user_role') || ( isset($user->user_role) ? $user->user_role : '' ) == strtolower($userrole) ? 'selected' : '' !!}>
                                    {{$userrole}}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                    {!! $errors->first('user_role', '<p class="help-block">:message</p>') !!}


                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">

                    <label for="status">User Status</label>

                    <select  tabindex="10" class="form-control select2-list" name="status" id="status"
                            data-placeholder="status Role">
                        <option selected value="">Choose Status</option>
                        <optgroup label="User Status">
                            @foreach($statuses as $status)
                                <option value="{{$status}}" {!! old('status') || ( isset($user->status) ? $user->status : '' ) == strtolower($status) ? 'selected' : '' !!}>
                                    {{$status}}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}

                </div>
            </div>

        </div>
    </div>








    <div class="card-actionbar">
        <div class="card-actionbar-row">
            @yield('form-submit-buttons')
        </div>
    </div>
    @endif
</div>
</div>
</form>
