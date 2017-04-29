@extends('admin/layouts.admin_app')


@section('style')

    <style>


        .selected {
            border: 2px solid #3499ff;
        }

        .tick:after {
            content: '\f00c';
            position: absolute;
            z-index: 9;
            right: -8px;
            font-size: 2em;
            top: -22px;
            font-weight: bold;
            color: #3499ff;
        }

        .fa-check {
            font-size: 2.5em;
            color: white;
            position: absolute;
            top: 0px;
            right: 0px;
        }

        .close span {
            font-size: 2.4em;
        }

        #content{background: white;}

        #upload-img-container #content{
            padding: 0;
            height: auto;
            min-height: initial;
        }

        #upload-img-container .dz-message{
            margin: 0;
        }
        .media-action{
            display: flex;
            justify-content: space-between;
        }

    </style>

    @include('media::layoutfiles.embedd.includes.styles')
    @endsection

@section('content')
    <div id="content">

        <section class="style-default-bright">
            <div class="section-header">
                <h2 class="text-primary">Media</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="media-action">
                        <div>
                            <button id="bulk-selection" class="btn btn-default">Bulk Select</button>
                        </div>
                        <div class="hidden">
                            <button class="btn btn-default" id="cancel-bulk">Cancel Selection</button>
                            <button class="btn btn-default" disabled id="delete-bulk">Delete Selected</button>
                        </div>
                        <div>
                            <button id="add-media" class="btn btn-primary ink-reaction">Add Media</button>
                        </div>
                    </div>

                    <section id="upload-img-container" style="display: none">
                        @include('media::layoutfiles.embedd.add-media')
                    </section>

                    {{-- start writing from here--}}
                    @if(isset($selected_files) && ( sizeof($selected_files) > 0 ) )

                        <div class="media-container" id="media-container">
                            @foreach($selected_files as $file_name)
                                @php($url = url('/') . '/' . $file_name->content)
                                @php( $mime = explode('/', $file_name->mime_type)  )


                                <div  class="image-div col-md-1 col-xs-4 col-sm-3">
                                    @if ($mime[0] == 'image')
                                    <img  src="{{ $url }}" data-source="{{ $url }}" data-type="{{$file_name->mime_type}}" width="90" height="90"/>

                                    @elseif ($mime[0] == 'audio')
                                        <div class="file_icons file_icons-audio" data-icon="audio" data-source="{{$url}}" style="width: 90px; height: 90px;"></div>

                                    @elseif ($mime[0] == 'video')
                                        <div class="file_icons file_icons-video" data-icon="video" data-source="{{$url}}" style="width: 90px; height: 90px;"></div>

                                    @elseif ($file_name->mime_type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' ||
                                        $file_name->mime_type == 'application/vnd.ms-excel'
                                    )
                                        <div class="file_icons file_icons-excel" data-icon="excel" data-source="{{$url}}" style="width: 90px; height: 90px;"></div>


                                    @elseif ($file_name->mime_type == 'application/vnd.openxmlformats-officedocument.presentationml.presentation' ||
                                        $file_name->mime_type == 'application/vnd.ms-powerpoint'
                                    )
                                        <div class="file_icons file_icons-ppt" data-icon="ppt" data-source="{{$url}}" style="width: 90px; height: 90px;"></div>



                                    @elseif ($file_name->mime_type == 'application/zip')
                                        <div class="file_icons file_icons-zip" data-icon="zip" style="width: 90px; height: 90px;"></div>

                                    @elseif ($file_name->mime_type == 'application/pdf')
                                        <div class="file_icons file_icons-pdf" data-icon="pdf" data-source="{{$url}}" style="width: 90px; height: 90px;"></div>


                                    @elseif ($file_name->mime_type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
                                            $file_name->mime_type == 'application/msword'
                                    )
                                        <div class="file_icons file_icons-ms-word" data-icon="ms-word" data-source="{{$url}}" style="width: 90px; height: 90px;"></div>

                                    @else
                                        <div class="file_icons file_icons-file" data-icon="file" data-source="{{$url}}" style="width: 90px; height: 90px;"></div>


                                    @endif



                                    <i class="fa fa-check"></i>
                                    <div class="hidden">
                                        <div class="file-name">{{ $file_name->content }}</div>
                                        <div class="id">{{ $file_name->id }}</div>
                                        {{--<div class="file-type">{{ image_type_to_mime_type(exif_imagetype($url)) }}</div>--}}
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            {{$selected_files->links()}}
        </section>



    </div>



    <div class="modal fade media-viewer " id="myModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="simpleModalLabel">Attachment Details</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="attachment-media-view portrait">
                                <div class="thumbnail thumbnail-image">

                                    <img class="details-image" src="#" id="modal-image"
                                         class="img img-thumbnail img-responsive"/>

                                </div>
                            </div>
                            <div class="attachment-info">


                                <div class="settings form-horizontal">

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="col-sm-10">
                                                <input id="image-path" type="text" class="form-control" readonly value="">
                                                <div class="form-control-line"></div>
                                            </div>
                                            <div class="col sm-2">
                                                <div class="actions">
                                                    <input type="hidden" id="single_img_id" value="">

                                                    <button type="button" id="delete-permanently" class="btn btn-danger">Delete
                                                        Permanently
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>



                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    @include('media::layoutfiles.embedd.delete')

    @endsection
@section('js')
    @include('media::layoutfiles.embedd.includes.js')
    <script>

    $( document ).ready( function () {
        Dropzone.autoDiscover = false;


            $('#add-media').click(function () {
               $('#upload-img-container').slideToggle(500);
            });


            var modal = $( '#myModal' ),
                bulk_selection = [],
                ajax = true,
                post_img_dir_path = "{{ asset('images/posts') }}",
                img_dir_path = "{{ asset('images') }}";


            $( document ).on( 'click', '.media-container .image-div', function ( e ) {
                var $this = $( this );

                var source = $(this).find('img').attr('src');


                if ( source === undefined){
                    var elem = $(this).find('div.file_icons');
                    var icon = elem.attr('data-icon');
                    source = "{{url('/')}}" + "/images/file_icons/" + icon + '.png';

                    $( '#image-path' ).val( elem.attr( 'data-source' ) );

                }else {
                    $( '#image-path' ).val( $this.find( 'img' ).attr( 'src' ) );
                }

                $( '#modal-image' ).attr( 'src', source );

                $('#single_img_id').val($this.find('.hidden .id').text());
                $this.addClass( 'selected' );
                openModal( modal );
            } );
            modal.on( 'hidden.bs.modal', function () {
                $( '.image-div.selected' ).removeClass( 'selected' );
            } );
        /*$( '.media-bulk-container' ).find( '.img-div' ).click( function () {

            } );


            $( '#bulk-selection' ).on( 'click', function () {
                $( this ).parent().addClass( 'hidden' ).next().removeClass( 'hidden' );
                $( '#media-container' ).toggleClass( 'media-container bulk-container' );
            } );

            $( '#cancel-bulk' ).on( 'click', function () {
                $( this ).parent().addClass( 'hidden' ).prev().removeClass( 'hidden' );
                $( '#media-container' ).toggleClass( 'bulk-container media-container' );
                $( '.image-div.selected' ).removeClass( 'selected' );

            } );

            $( document ).on( 'click', '.bulk-container .image-div', function ( e ) {
                var $this = $( this ),
                    file_name = $this.find( '.file-name' ).text();

                if ( $this.hasClass( 'selected' ) ) {


                    if (bulk_selection.length > 0){

                        for ( var i = 0; i < bulk_selection.length; i++ ){
                            if (bulk_selection[i]['file_name'] === file_name){
                                bulk_selection.splice( i, 1 );
                            }
                        }

                        //console.log(bulk_selection);

                    }

                    $this.removeClass( 'selected' );
                } else {
                    $this.addClass( 'selected' );

                    var file = {'file_name': file_name, 'id': $this.find( '.id' ).text() }

                    bulk_selection.push( file );

                    //console.log(bulk_selection);
                }

                if ( bulk_selection.length > 0 ) {
                    $( '#delete-bulk' ).attr( 'disabled', false );
                } else {
                    $( '#delete-bulk' ).attr( 'disabled', true );
                }

            } );*/

        $('.modal').on('hidden.bs.modal', function (e) {
            if($('.modal').hasClass('in')) {
                $('body').addClass('modal-open');
            }
        });


            $( '#delete-permanently' ).on( 'click', function () {
                var fileID = $('#single_img_id').val();

                var $this = $( this );
                $this.attr( 'disabled', true );


                openModal('#delete-confirm-modal');

                $('#yes-delete').click( function () {
                    $.ajax( {
                        url: "{{ route('media-delete',"") }}" + "/" + fileID,
                        type: 'DELETE',
                        success: function ( data ) {
                            $this.attr( 'disabled', false );
                            $( 'div.image-div.selected' ).fadeOut();
                            closeModal('#delete-confirm-modal');
                            if ( data === 'deleted' ) {
                                modal.modal( 'hide' );
                            }
                        }
                    } );
                });


                $('#no-delete').click( function () {
                    $this.attr( 'disabled', false );
                    closeModal('#delete-confirm-modal');
                });


            } );
            /*var offset = 60,
                quantity = 20;
            $( window ).scroll( function () {
                if ( $( window ).scrollTop() + $( window ).height() == $( document ).height() ) {

                    if ( $( this ).scrollTop() > 100 && ajax === true ) {

                        ajax = false;


                        $.get( '/' + offset + '/' + quantity, function ( data ) {

                            if ( data.length > 0 ) {
                                var img_div = '';
                                $.each( data, function ( i, val ) {

                                    var val_ext = val.substr( val.lastIndexOf( '.' ) + 1 );

                                    if ( $.inArray( val_ext, img_ext ) !== -1 ) {
                                        img_div += '<div class="image-div">' +
                                            ' <img class="img img-thumbnail" src="' + post_img_dir_path + '/' + val + '" data-type="image" width="100" height="100"> ' +
                                            '<i class="fa fa-check"></i> ' +
                                            '</div>';
                                    } else {
                                        img_div += ' <div class="image-div">' +
                                            '<img class="img img-thumbnail" src="' + img_dir_path + '/file-document.png' + '" data-type="file" data-source="' + post_img_dir_path + '/' + val + '" width="100" height="100"/>' +
                                            '</div>';
                                    }
                                } );

                                $( '#media-container' ).append( img_div );

                                offset = offset + quantity;
                                ajax = true;
                            }
                        }, 'json' );
                    }


                }
            } );*/
        } );
    </script>
    <script src="{{Module::asset('media:js/custom-functions.js')}}"></script>
    @endsection