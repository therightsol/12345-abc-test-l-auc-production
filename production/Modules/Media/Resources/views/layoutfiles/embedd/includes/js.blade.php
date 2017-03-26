<script src="{{Module::asset('media:dropzone/dist/min/dropzone.min.js')}}"></script>
<script>
    var modal;
    jQuery( document ).ready( function ( $ ) {

        if ( $('#media-container').length > 0){
            initDropZone();
        }



        modal = $( '#myModal' );

        var bulk_selection = [],
                ajax = true ;
        var gallery_images = [];

        $( document ).on( 'click', '#picture-btn', function ( e ){

            e.preventDefault();
            $('#media-button-styles').text('#insert-bulk{display: none;} .img-src-container{display: flex}');

            $('.ajax-loader.single-img').css('display', 'inline-block');
            load_images(36, 1);

        });

        (function($){
            $.fn.available = function(expr,callback) {
                var evtType = 'DOMSubtreeModified';
                return this.each(function(){
                    var $this = $(this),
                            found = $this.find(expr)[0];
                    if(found) return callback(found);

                    var handler = function(e) {
                        found = $this.find(expr)[0];
                        if(found) {
                            $this.unbind(evtType,handler);
                            callback(found);
                        }
                    };
                    $this.bind(evtType, handler);
                });
            };
        })(jQuery);


        $( document ).on( 'click', '#gallery_pictures-btn', function ( e ){
            e.preventDefault();

            $('#media-button-styles').text('#insert-bulk{display: inline-block !important;} .img-src-container{display: none}');

            // Triggering Bulk Selection button, so that it will show hidden buttons.
            // Problem: first time works only. second time not working.
            jQuery(document).available('#bulk-selection',function(el){
                //alert( "first search result: "+ jQuery(el).text() );
                $(el).click();
            });



            $('.ajax-loader.gallery').css({'display':'block', 'margin': '0 auto'});
            load_images(36, 1);

        });



        function load_images(paginate, page){
            jQuery.ajax({
                url: "{{route('admin.media')}}/" + paginate + '/' + page,
                dataType: 'html'
            }).success(function( data ) {

                //console.log(data);

                $('#images-container').html(data);

                jQuery.ajax({
                    url: "{{route('admin.add-media')}}",
                    dataType: 'html'
                }).success( function (data) {
                    //console.log(data);
                    $('#upload-media-container').html(data);

                    initDropZone();

                    openModal(modal);
                    $('.ajax-loader').css('display', 'none');
                });


            });
        }



        //console.log( img_ext );

        function bulk_selection_clik_handler(a){
            a.parent().addClass( 'hidden' ).next().removeClass( 'hidden' );
            $( '#media-container' ).toggleClass( 'media-container bulk-container' );
            $( '.image-div.selected' ).removeClass( 'selected' );
            $('#add-img').attr('disabled', true);
        }

        $( document ).on( 'click', '#delete-bulk',function () {

            if ( bulk_selection.length < 1 ) {
                return false;
            }
            var $this = $( this );
            $this.attr( 'disabled', true );

            var myJsonString = JSON.stringify( bulk_selection );

            $.ajax( {
                url: '{{ route('admin.media-bulk-delete') }}',
                type: 'post',
                data: { 'files': myJsonString },
                success: function ( data ) {
                    if ( data === 'deleted' ) {
                        bulk_selection = [];
                        $this.attr( 'disabled', false );
                        $( '.image-div.selected' ).fadeOut();
                    }

                }
            } );

        } );

        $( document ).on( 'click', '.media-container .image-div', function ( e ) {
            //console.log("image clicked");

            $('.media-container').find('.selected').removeClass('selected');

            var $this = $( this );
            $this.addClass( 'selected' );

            $('#img-src').val( $this.find('img').attr('src') );

            $('#db_image_path').val( $this.find( '.file-name' ).text() );

        } );

        $( document ).on( 'click', '#bulk-selection', function () {
            bulk_selection_clik_handler($(this));
        } );

        $( document ).on( 'click', '#cancel-bulk', function () {
            $( this ).parent().addClass( 'hidden' ).prev().removeClass( 'hidden' );
            $( '#media-container' ).toggleClass( 'bulk-container media-container' );
            $( '.image-div.selected' ).removeClass( 'selected' );

            $('#add-img').attr('disabled', false);


            bulk_selection = [];

        } );


        $(document).on('click', '.gallery_img_remove', function (){
            var $this = $(this);
            var img_id = $this.prev().attr('data-id');

            var ids = $('#gallery_images_ids').val();

            ids = ids.split(",");

            var new_ids = [];

            for(var i = 0; i < ids.length; i++){
                if (ids[i] != img_id){
                    new_ids.push(ids[i]);
                }
            }


            $('#gallery_images_ids').val(new_ids);


            $this.parent().remove();


            // Remove from Database
            /*$.ajax({
                url: '' + '/' + img_id,
                type: 'DELETE',
                data: {
                    'file_id': img_id
                },
                success: function ( data ){
                    console.log(data);
                }
            });*/



        });



        $( document ).on( 'click', '#insert-bulk',function () {



            if ( bulk_selection.length < 1 ) {
                return false;
            }
            var $this = $( this );
            $this.attr( 'disabled', true );

            var parent_elem = $('#image_gallery_container');


            for(var i = 0; i < bulk_selection.length; i++){


                var html = '<div class="img gallery-img img-thumbnail">' +
                        '<img data-id="'+ bulk_selection[i]['id'] +'" class="picture id-'+bulk_selection[i]['id']+'" src="{{url("/") . "/"}}' + bulk_selection[i]['file_name'] + '" ' +
                        'style="height: 80px;max-width: 80px; width: 80px" alt="gallery-images" />' +
                        '<i class="fa gallery_img_remove fa-close"></i></div>';

                gallery_images.push(bulk_selection[i]['id']);
                parent_elem.prepend(html);
            }

            var ids = $('#gallery_images_ids').val();
            if (ids.length > 0)
                ids = ids + ',';


            $('#gallery_images_ids').val( ids + gallery_images );
            closeModal("#myModal");
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

                var file = {'file_name': file_name, 'id': $this.find( '.id' ).text() };

                bulk_selection.push( file );

                //console.log(bulk_selection);
            }

            if ( bulk_selection.length > 0 ) {
                $( '#delete-bulk' ).attr( 'disabled', false );
                $( '#insert-bulk' ).attr( 'disabled', false );
            } else {
                $( '#delete-bulk' ).attr( 'disabled', true );
                $( '#insert-bulk' ).attr( 'disabled', true );
            }

        } );

        $( document ).on( 'click', '#add-img', function () {

            closeModal(modal);

            var imgsrc = $('#db_image_path').val();

            if (imgsrc.length > 0){

                /*var port = '';
                if (location.port !== '')
                    port = ':' + location.port;


                var fullimgsrc = location.protocol + '//' + location.hostname + port + '/' + imgsrc;*/

                var fullimgsrc = $('#img-src').val();

                $('#picture').attr({'src': fullimgsrc, 'data-picture': fullimgsrc});
                $('#picture-val').val(imgsrc);
            }

        });


        $(document).on('click', '.ajax_page', function (e){
            e.preventDefault();

            var page = $(this).attr('data-page');

            load_images(36, page);

        });

        $(document).find()



    } );


    function initDropZone(){

        //Dropzone.options.mediaUploader = false;

        var fileList = new Array;
        var i =0;

        var myDropzone = new Dropzone("#mediaUploader", {
            parallelUploads: 1,
            maxFilesize: "{{$maxFileSize}}",
            paramName: 'dzFiles',
            addRemoveLinks: true,
            acceptedFiles: "image/*, .pdf, .txt, .doc, .docx, .xls, .xlsx",
            init: function (){
                // Hack: Add the dropzone class to the element
                $(this.element).addClass("dropzone");

                this.on("success", function(file, serverFileName) {

                    serverFileName = $.parseJSON(serverFileName);

                    if (serverFileName.status === 'success'){
                        fileList[i] = {"serverFileName" : serverFileName[0].filename, 'mime_type': serverFileName[0].mime_type, 'db_id': serverFileName[0].id, "fileName" : file.name,"fileId" : i };
                        //console.log(fileList);
                        i++;

                        if ( $('#media-container').length > 0){
                            var html = '<div class="image-div col-md-1 col-xs-4 col-sm-3">';
                            html    +=  '<img src="' + "{{asset('/')}}" + serverFileName[0].filename
                                    + '" data-source="' + serverFileName[0].filename + '" data-type="' + serverFileName[0].mime_type + '" width="100" height="100">'
                                    + '<i class="fa fa-check"></i>'
                                    + '<div class="hidden"><div class="file-name">' + serverFileName[0].filename + '</div>'
                                    + '<div class="id">' + serverFileName[0].id + '</div></div></div>';


                            $('#media-container').prepend(html);


                            myDropzone.removeFile(file);
                        }


                    }

                });


                this.on("complete", function(file) {

                    var pendingUpload = myDropzone.getAcceptedFiles().length;

                    if (pendingUpload == 0){

                        $('#media-container div').removeClass('selected');

                        $('#media-container div:first-child').addClass('');

                        $('#upload-li').removeClass('active');
                        $('#media-li').addClass('active');

                        $('#upload-media').removeClass('active');
                        $('#model-media').addClass('active');




                        $('#img-src').val( $('#media-container div:first-child').find('img').attr('src') );
                        $('#db_image_path').val( $('#media-container div:first-child').find('.file-name').text() );
                    }

                });


                this.on("removedfile", function(file) {

                    if ( $('#media-container').length > 0){
                        return; // do nothing. only remove from preview. but not delete
                    }


                    var rmvFile = false;
                    var db_id = false;

                    for(f=0;f<fileList.length;f++){
                        console.log(fileList[f]);

                        if(fileList[f].fileName == file.name)
                        {

                            rmvFile = fileList[f].serverFileName;
                            db_id = fileList[f].db_id;
                        }

                    }

                    if (rmvFile){
                        //console.log(rmvFile);
                        $.ajax({
                            url: "{{route('admin.destroy-media')}}",
                            type: "POST",
                            data: { "fileName" : rmvFile, 'id': db_id }
                        });
                    }
                });


            }
        });
    }

</script>