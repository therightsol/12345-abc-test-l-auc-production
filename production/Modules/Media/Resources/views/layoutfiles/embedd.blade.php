@php(   $maxFileSize = ini_get('upload_max_filesize'))
@php(   $maxFileSize = str_replace('M', '', $maxFileSize))
@if(! isset($gallery_images))
    @php($gallery_images = '')
@endif
@section('style')
    @parent
    <link type="text/css" rel="stylesheet" href="{{ Module::asset('media:css/bootstrap-datepicker/datepicker3.css') }}" />
    @include('media::layoutfiles.embedd.includes.styles')
@endsection
@section('js')
    @parent
    @include('media::layoutfiles.embedd.includes.js')
@endsection
@section('content')
    @parent
    @include('media::layoutfiles.embedd.media-modal-viewer')
@endsection

@section('insert-image-code')

    <div class="img img-thumbnail" id="picture-btn" style="position: relative;">
        <i class="ajax-loader single-img medium animate-spin" style="display: none"></i>

        <img class="picture" data-picture="@if(!empty(old('picture'))){{asset(old('picture'))}}@elseif(isset($featured_img)){{url('/') . '/' . $featured_img}} @else{{asset('images/image-not-found-100x100.png')}}@endif" id="picture"
             src="@if(!empty(old('picture'))){{asset(old('picture'))}}@elseif(isset($featured_img)){{url('/') . '/' . $featured_img}}@else{{asset('images/image-not-found-100x100.png')}}@endif" style="    height: 200px;max-width: 290px" alt="profile-image" />
    </div>
    <input type="hidden" name="picture" id="picture-val" value="@if(!empty(old('picture'))){{(old('picture'))}}@elseif(isset($featured_img)){{$featured_img}} @else{{'images/image-not-found-100x100.png'}}@endif">

    <p class="text-center no-margin" >Click the image to edit or update</p>


@endsection

@section('insert-product-variation-code')



    <div class="img img-thumbnail" id="picture-btn" style="position: relative;">
        <i class="ajax-loader single-img medium animate-spin" style="display: none"></i>

        <img class="picture" data-picture="@if(!empty(old('picture'))){{asset(old('picture'))}}@elseif(isset($featured_img)){{url('/') . '/' . $featured_img}} @else{{asset('images/image-not-found-100x100.png')}}@endif" id="picture"
             src="@if(!empty(old('picture'))){{asset(old('picture'))}}@elseif(isset($featured_img)){{url('/') . '/' . $featured_img}}@else{{asset('images/image-not-found-100x100.png')}}@endif" style="    height: 200px;max-width: 290px" alt="profile-image" />
    </div>
    <input type="hidden" name="picture" id="picture-val" value="@if(!empty(old('picture'))){{(old('picture'))}}@elseif(isset($featured_img)){{$featured_img}} @else{{'images/image-not-found-100x100.png'}}@endif">

    <p class="text-center no-margin" >Click the image to edit or update</p>


@endsection



@section('insert-image-gallery')

    <div class="image_gallery_container" id="image_gallery_container">
         <div class='hidden'>
            <input type='hidden' name="gallery_images_ids" id='gallery_images_ids' value='' />
        </div>
    </div>
    <div style="text-align: center; margin-top: 10px;">
        <i class="ajax-loader gallery medium animate-spin" style="display: none;"></i>
        <input type="button" class="btn btn-sm btn-primary" value="Click to add Images" id="gallery_pictures-btn">
    </div>
@endsection

