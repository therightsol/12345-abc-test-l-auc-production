@extends('commonbackend::layouts.admin_app')
@include('media::layoutfiles.embedd')

@section('content')
    <div id="content">
        <section class="">
            <div class="section-header">
                <h2 class="text-primary">Add Inspection Request</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('commonbackend::layouts._alert-response')
                    </div><!--end .col -->
                    <div class="col-lg-10 col-lg-offset-1">
                        @if(session('auctioneer.car'))
                            {!! Form::open(['route' => Helper::route('store'), 'method'=>'post', 'class' => 'form']) !!}

                            @include('inspectionrequests::_form', [
                            'buttonText' => 'Submit',
                            'title' => 'Add Inspection Request for ('.$car->title.')',
                            ])
                            {!! Form::close() !!}

                        @else

                            {!! Form::open(['route' => 'auctioneer.storeCar', 'method'=>'post', 'class' => 'form']) !!}
                            @include('cars::_form', [
                            'buttonText' => 'Submit',
                            'title' => 'Add Inspection Request',
                            ])
                            {!! Form::close() !!}

                        @endif


                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
