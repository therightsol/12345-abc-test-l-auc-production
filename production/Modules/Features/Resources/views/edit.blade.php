@extends('commonbackend::layouts.admin_app')

@section('content')
    <div id="content">
        <section class="">
            <div class="section-header">
                <h2 class="text-primary">Edit Feature</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('commonbackend::layouts._alert-response')
                    </div><!--end .col -->
                    <div class="col-lg-6 col-lg-offset-3">
                        {!! Form::model($feature, ['route' => [Helper::route('update'), $feature->id], 'method'=>'PUT', 'class' => 'form']) !!}

                        @include('features::_form', [
                        'buttonText' => 'Update',
                        'title' => 'Edit Feature',
                        ])
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
