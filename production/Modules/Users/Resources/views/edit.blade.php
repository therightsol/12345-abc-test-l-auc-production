@extends( Module::get('commonbackend') != NULL ? 'commonbackend::layouts.admin_app': 'users::layouts.master', ['pageTitle' => 'Users', 'obj' => $user] )

@include('media::layoutfiles.embedd')

@section('style')
    <style>
        .nopadding{
            padding: 0 !important;
            margin: 0 !important;
        }

        .no-left-padding{
            padding-left: 0 !important;
            margin-left: 0 !important;
        }

        .no-right-padding{
            padding-right: 0 !important;
            margin-right: 0 !important;
        }
    </style>
@endsection

@section('form-title')
    <header>Update User - {{ $user['full_name']}}</header>
@endsection


@section('password')
    <div class="row" id="toggle-stock">
        <div class="col-sm-12">
            <div class="checkbox checkbox-styled">
                <label class="checkbox-primary" data-toggle="collapse" data-target="#update_password_row">
                    <input  id="change_password" type="checkbox" name="isPasswordUpdate" value="1"
                           @if( old('isPasswordUpdate') == 1) checked @endif >Update Password?
                </label>
            </div>
        </div>
    </div>
    <div class="panel-collapse collapse row @if( old('isPasswordUpdate') == 1) in @endif" id="update_password_row">
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                <input  tabindex="6" type="password" class="form-control" value="{{old('password')}}" name="password"
                       id="password">
                <label for="password">Password</label>
                {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : ''}}">
                <input  tabindex="7" type="password" class="form-control" value="{{old('confirm_password')}}"
                       name="confirm_password" id="confirm_password">
                <label for="confirm-password">Confirm Password</label>
                {!! $errors->first('confirm_password', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>
@endsection


@section('form-submit-buttons')
    <button type="submit" id="savebtn" class="btn btn-primary">Update</button>
@endsection


@section('form-open')
    <form class="form" action="{{route('admin.users.update', ['id' => $user->id])}}" enctype="multipart/form-data" data-uid="" method="post" >
        <input name="_method" type="hidden" value="PUT">
@endsection

        @if (Session::has('isUpdated') && ( Session::get('isUpdated') == 'update' ) )
        @section('form-alerts')
            <div class="alert alert-success">
                User successfully updated.
            </div>
        @endsection
        @elseif(Session::has('isUpdated')))
        @section('form-alerts')
            <div class="alert alert-danger">
                Sorry! There is an error while updating. <br />
                Please try again. If problem persists then please contact to developer.
            </div>
        @endsection
        @endif

        @section('content')
            <div id="content">
                <section class="">

                    <div class="section-body">
                        <div class="row">
                            <!-- BEGIN ALERT - REVENUE -->
                            <div class="col-sm-12">
                                @include('users::includes.add-user-form')
                            </div>

                        </div>
                    </div>
                </section>
            </div>


        @endsection

        @section('js')
            <script>

                jQuery('#lastname').blur(function (){
                    var firstname = jQuery('#firstname').val();
                    var lastname = $(this).val();

                    var display_name = firstname + ' ' + lastname;

                    jQuery('#display_name').val(display_name).addClass('dirty');
                });
            </script>
            <script src="{{Module::asset("media:js/custom-functions.js")}}"></script>

        @endsection