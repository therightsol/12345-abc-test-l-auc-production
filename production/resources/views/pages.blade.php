@extends('layout.app')
@section('content')


    <section id="secondary-banner" class="dynamic-image-1"><!--for other images just change the class name of this section block like, class="dynamic-image-2" and add css for the changed class-->
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12">
                    <h2>{{ $page->title }}</h2>
                </div>
            </div>
        </div>
    </section>
    <!--#secondary-banner ends-->
    <div class="message-shadow"></div>
    <div class="clearfix"></div>

    <section class="content">
        <div class="container">
            <div class="inner-page">
              {!! $page->content !!}
            </div>
        </div>
        <!--container ends-->
    </section>
    @endsection

@section('js')
    <script>
        $('#listingForm').find('select').change(function () {
            $('#listingForm').submit();
        });
    </script>
    @endsection