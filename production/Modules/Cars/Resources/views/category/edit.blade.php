@extends('commonbackend::layouts.admin_app')

@section('content')
    <div id="content">
        <section class="">
            <div class="section-header">
                <h2 class="text-primary">Edit Courier Method</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('commonbackend::layouts._alert-response')
                    </div><!--end .col -->
                    <div class="col-lg-6 col-lg-offset-3">
                        {!! Form::model($category, ['route' => [Helper::route('update'), $category->id], 'method'=>'PUT', 'class' => 'form']) !!}

                        @include('cars::category._form', [
                        'buttonText' => 'Update',
                        'title' => 'Edit Category Method',
                        ])
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
