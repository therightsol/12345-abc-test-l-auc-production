@extends('commonbackend::layouts.admin_app')
@include('media::layoutfiles.embedd')


@section('content')
    <div id="content">
        <section class="">
            <div class="section-header">
                <h2 class="text-primary">Update Car</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('commonbackend::layouts._alert-response')
                    </div><!--end .col -->
                    <div class="col-lg-10 col-lg-offset-1">
                        {!! Form::model($car,['route' => [Helper::route('update'), $car->id], 'method'=>'put', 'class' => 'form']) !!}

                        @include('cars::_form', [
                        'buttonText' => 'Submit',
                        'title' => 'Update Car',
                        ])
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
