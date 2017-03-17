@extends('commonbackend::layouts.admin_app')

@section('content')
    <div id="content">
        <section class="">
            <div class="section-header">
                <h2 class="text-primary">Edit Engine Type</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('commonbackend::layouts._alert-response')
                    </div><!--end .col -->
                    <div class="col-lg-6 col-lg-offset-3">
                        {!! Form::model($engineType, ['route' => [Helper::route('update'), $engineType->id], 'method'=>'PUT', 'class' => 'form']) !!}

                        @include('enginetypes::_form', [
                        'buttonText' => 'Update',
                        'title' => 'Edit Engine Type',
                        ])
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
