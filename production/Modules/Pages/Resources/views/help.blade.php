@extends('commonbackend::layouts.admin_app')

@section('content')
    <div id="content">
        <section class="">
            <div class="section-header">
                <h2 class="text-primary">Help Page</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('commonbackend::layouts._alert-response')
                    </div><!--end .col -->
                    <div class="col-lg-10 col-lg-offset-1">
                        {!! Form::open(['route' => 'admin.helpPage.store', 'method'=>'post', 'class' => 'form']) !!}

                        @include('pages::_form', [
                        'buttonText' => 'Submit',
                        'title' => 'Help Page',
                        ])
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
