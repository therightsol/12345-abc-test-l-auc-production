<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pak Auction') }}</title>


    <!-- BEGIN STYLESHEETS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
    <link type="text/css" rel="stylesheet" href="{{ Module::asset('commonbackend:admin_assets/css/theme-default/bootstrap.css?1422792965') }}" />
    <link type="text/css" rel="stylesheet" href="{{ Module::asset('commonbackend:admin_assets/css/theme-default/materialadmin.css?1425466319') }}" />
    <link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link type="text/css" rel="stylesheet" href="{{ Module::asset('commonbackend:admin_assets/css/theme-default/material-design-iconic-font.min.css?1421434286') }}" />
    <link type="text/css" rel="stylesheet" href="{{ Module::asset('commonbackend:admin_assets/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989') }}" />
    <link type="text/css" rel="stylesheet" href="{{ Module::asset('commonbackend:admin_assets/css/theme-default/libs/DataTables/extensions/dataTables.colVis.css?1423553990') }}" />
    <link type="text/css" rel="stylesheet" href="{{ Module::asset('commonbackend:admin_assets/css/theme-default/libs/DataTables/extensions/dataTables.tableTools.css?1423553990') }}" />
    <link type="text/css" rel="stylesheet" href="{{ Module::asset('commonbackend:admin_assets/css/style.css') }}" />
    <!-- END STYLESHEETS -->




    <!-- END STYLESHEETS -->
    @yield('style')

    <script>
        window.Laravel =<?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>;
    </script>
</head>
<body class="menubar-hoverable header-fixed menubar-first menubar-pin">
<!-- BEGIN BASE-->







    <section class="section-account">
        <div class="spacer"></div>
        <div class="card contain-sm style-transparent">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 style="text-align: center;">PakAuction <small>Administration Panel</small></h2>
                    <div class="card-body style-default-bright">

                        <br>
                        <span class="text-lg text-bold text-primary">Login to Manage</span>
                        <br><br>

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form floating-label" action="{{route('do-login')}}" accept-charset="utf-8" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username">
                                <label for="username">Username</label>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password">
                                <label for="password">Password</label>

                                <p class="help-block"><a href="{{route('reset-password')}}">Forgotten?</a></p>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <div class="checkbox checkbox-inline checkbox-styled">
                                        <label>
                                            <input type="checkbox" > <span  class="rememberme">Remember me</span>
                                        </label>
                                    </div>
                                    <input type="hidden" value="false" name="remember_me" id="remember_me">

                                </div><!--end .col -->
                                <div class="col-xs-6 text-right">
                                    <button class="btn btn-primary btn-raised" type="submit">Login</button>
                                </div><!--end .col -->
                            </div><!--end .row -->
                        </form>
                    </div><!--end .col -->
                </div><!--end .card -->
            </div>
        </div>
    </section>


<!-- BEGIN JAVASCRIPT -->
<script src="{{ Module::asset('commonbackend:admin_assets/js/libs/jquery/jquery-1.11.2.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    });
</script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/libs/jquery/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/libs/spin.js/spin.min.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/libs/autosize/jquery.autosize.min.js') }}"></script>

<script src="{{ Module::asset('commonbackend:admin_assets/js/libs/DataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/by-team/dataTables.buttons.min.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>


<script src="{{ Module::asset('commonbackend:admin_assets/js/libs/nanoscroller/jquery.nanoscroller.min.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/core/source/App.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/core/source/AppNavigation.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/core/source/AppOffcanvas.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/core/source/AppCard.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/core/source/AppForm.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/core/source/AppNavSearch.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/core/source/AppVendor.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/core/demo/Demo.js') }}"></script>
<script src="{{ Module::asset('commonbackend:admin_assets/js/core/demo/DemoTableDynamic.js') }}"></script>

<script>
    $('#main-menu').find('a.active').closest('li').addClass('active expanded').closest('li.gui-folder').addClass('active expanded')
</script>
<script>
    $(document).ready(function (){
        $('.rememberme').click(function (){

            if ($('#remember_me').val().length > 0 &&  $('#remember_me').val() == 'true'){
                $('#remember_me').val('false');
            }else {
                $('#remember_me').val('true');

            }
        })
    });
</script>


<!-- END JAVASCRIPT -->
@yield('js')
@yield('after-js')
<div class="pull-right">
    This page took {{ (microtime(true) - LARAVEL_START) }} seconds to render
</div>

</body>
</html>
