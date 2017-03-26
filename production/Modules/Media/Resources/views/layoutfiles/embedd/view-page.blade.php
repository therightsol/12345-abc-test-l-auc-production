{{-- THIS FILE IS USED TO DISPLAY MEDIA IMAGES VIA AJAX ONLY. (ROUTE: route('media')) --}}

<section class="style-default-bright">
    <div class="section-header">
        <h2 class="text-primary">Choose Image</h2>
    </div>
    <div class="section-body">
        <div class="row no-margin">
            <div class="media-action">
                <div>
                    <button id="bulk-selection" class="btn btn-default">Bulk Select</button>
                </div>
                <div class="hidden">
                    <button class="btn btn-default" id="cancel-bulk">Cancel Selection</button>
                    <button class="btn btn-default" disabled id="delete-bulk">Delete Selected</button>
                    <button style="display: none" class="btn btn-default" disabled id="insert-bulk">Insert Selected</button>
                </div>
                <div class="img-src-container">
                    <strong id="url">URL:</strong> <input type="text" readonly class="form-control img-src"
                                                          name="img-src" id="img-src">
                    <button class="btn btn-primary" id="add-img">Insert Image</button>
                    <input type="hidden" id="db_image_path" value="">
                </div>
            </div>

            {{-- start writing from here--}}
            @if(isset($selected_files) && ( sizeof($selected_files) > 0 ) )

                <div class="media-container row no-margin" id="media-container">
                    @foreach($selected_files as $file_name)
                        @php($url = url('/') . '/' . $file_name->content)

                        <div class="image-div col-md-1 col-xs-4 col-sm-3">

                            <img  src="{{ $url }}" data-source="{{ $url }}" data-type="{{$file_name->mime_type}}" width="90" height="90"/>


                            <i class="fa fa-check"></i>
                            <div class="hidden">
                                <div class="file-name">{{ $file_name->content }}</div>
                                <div class="id">{{ $file_name->id }}</div>
                                {{--<div class="file-type">{{ image_type_to_mime_type(exif_imagetype($url)) }}</div>--}}
                            </div>
                        </div>

                    @endforeach
                </div>
                {{--{{$selected_files->links()}}
                {{"Count: " . $selected_files->count()}}
                {{"Total: " . $selected_files->total()}}
                {{"CP :" . $selected_files->currentPage()}}
                {{"HMP: " . $selected_files->hasMorePages()}}
                {{"LP: " . $selected_files->lastPage()}}--}}
                <ul class="pagination">
                    <li @if($selected_files->currentPage() == 1) class="disabled" @endif>
                        @if($selected_files->currentPage() == 1)
                            <span>«</span>
                        @else
                            <a href="#"  class="ajax_page"
                               data-page="1" rel="next">«</a>
                        @endif
                    </li>

                    @for($i = 1; $i <=  $selected_files->lastPage(); $i++)

                        <li
                         @if($selected_files->currentPage() == $i)
                             class="active"
                         @endif>
                            <a href="#" class="ajax_page" data-page="{{$i}}">{{$i}}</a>
                        </li>

                    @endfor

                    <li @if($selected_files->currentPage() == $selected_files->lastPage()) class="disabled" @endif>
                        @if($selected_files->currentPage() == $selected_files->lastPage())
                            <span>»</span>
                        @else
                            <a href="#"  class="ajax_page"
                               data-page="{{$selected_files->lastPage()}}" rel="next">»</a>
                        @endif
                    </li>
                </ul>


@endif
</div>
</div>
</section>
