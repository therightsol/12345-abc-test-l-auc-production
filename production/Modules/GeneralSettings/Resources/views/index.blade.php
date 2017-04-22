@extends('commonbackend::layouts.admin_app')
@include('media::layoutfiles.embedd')

@section('style')
    <style>
        .picture{
            height: auto !important;
        }
    </style>
@endsection

@section('content')
    <div id="content">
        <section class="">
            <div class="section-header">
                <h2 class="text-primary">General Settings</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('commonbackend::layouts._alert-response')
                    </div><!--end .col -->
                    <div class="col-lg-8 col-lg-offset-2">
                        {!! Form::open(['route' => 'admin.settings.save', 'method'=>'post', 'class' => '']) !!}

                        @include('generalsettings::_form', [
                        'buttonText' => 'Update',
                        'title' => 'General Settings',
                        ])
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </section>
    </div>



    <ul id="response">

    </ul>
@endsection


@section('js')

    <script src="{{Module::asset("media:js/custom-functions.js")}}"></script>

@endsection

 {{--   <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        var socket = io('http://127.0.0.1:3000');

        $('form#tess').on('submit', function(e){
            e.preventDefault();
            socket.emit('notification-chanel:test', $('#message').val());
        });

        $(document).ready(function(){
            socket.on('notification-chanel:test', function(message){
                $('#message').val('');
                $('#response').append('<li>'+message+'</li>');
            });
        });

    </script>
        @endsection--}}

