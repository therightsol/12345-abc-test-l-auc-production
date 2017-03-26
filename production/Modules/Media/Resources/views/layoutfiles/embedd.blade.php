@php(   $maxFileSize = ini_get('upload_max_filesize'))
@php(   $maxFileSize = str_replace('M', '', $maxFileSize))
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

    <div class="img img-thumbnail" id="picture-btn">
        <i class="ajax-loader single-img medium animate-spin" style="display: none"></i>

        <img class="picture" data-picture="@if(!empty(old('picture'))){{asset(old('picture'))}}@elseif(isset($featured_img)){{url('/') . '/' . $featured_img}} @else{{Module::asset('media:images/image-not-found-100x100.png')}}@endif" id="picture"
             src="@if(!empty(old('picture'))){{asset(old('picture'))}}@elseif(isset($featured_img)){{url('/') . '/' . $featured_img}}@else{{Module::asset('media:images/image-not-found-100x100.png')}}@endif" style="    height: 200px;max-width: 290px" alt="profile-image" />
    </div>
    <input type="hidden" name="picture" id="picture-val" value="@if(!empty(old('picture'))){{(old('picture'))}}@elseif(isset($featured_img)){{$featured_img}} @else{{Module::asset('media:images/image-not-found-100x100.png')}}@endif">

    <p class="text-center no-margin" >Click the image to edit or update</p>


@endsection


@section('insert-image-gallery')
    <div class="image_gallery_container" id="image_gallery_container">
        @if(isset($imagesArr) and !empty($imagesArr))
            @php($img_ids = [])
            @foreach($imagesArr as $id => $path)
                <div class="img gallery-img img-thumbnail">
                    <img data-id="{{$id}}" class="picture id-{{$id}}"
                         src="{{url('/') . '/' . $path}}"
                         style="height: 80px;max-width: 80px; width: 80px" alt="gallery-images" />
                    <i class="fa gallery_img_remove fa-close"></i>
                </div>
                @php($img_ids[] = $id)
            @endforeach
            @php($img_ids = implode(",", $img_ids))

            <div class='hidden'>
                <input type='hidden' name="gallery_images_ids" id='gallery_images_ids' value='{{$img_ids}}' />
            </div>
        @else
            <div class='hidden'>
                <input type='hidden' name="gallery_images_ids" id='gallery_images_ids' value='' />
            </div>
        @endif
    </div>
    <div style="text-align: center; margin-top: 10px;">
        <i class="ajax-loader gallery medium animate-spin" style="display: none;"></i>
        <input type="button" class="btn btn-sm btn-primary" value="Click to add Images" id="gallery_pictures-btn">
    </div>
@endsection

