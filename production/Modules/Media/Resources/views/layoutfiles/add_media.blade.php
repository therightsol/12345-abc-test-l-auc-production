@extends('admin/layouts.admin_app')


@section('style')
    <link href="{{Module::asset('media:dropzone/dist/min/dropzone.min.css')}}" type="text/css" rel="stylesheet" />


    <style>

        form{
            background-color: #ececec !important;
            border: 2px dashed #4b88dc;
        }

        .dz-message{
            font-size: 2.8em !important;
        }

        .note{
            font-size: 24px !important;
        }
    </style>

@endsection

@section('content')
    <div id="content">
        <section class="style-default-bright">
            <div class="section-header">
                <h2 class="text-primary">Upload Media</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div id="dropzone">
                        <form action="{{route('store-media')}}" class="dropzone dz-clickable" id="mediaUploader">
                            <div class="dz-message">Drop files here or click to upload.
                                <br> <span class="note">(You can upload any text, pdf, image, video, doc, xls file etc)</span>

                            </div>
                            {{csrf_field()}}
                        </form>
                    </div>
                    <div>
                        <strong>You can upload maximum : </strong> {{ini_get('upload_max_filesize')}}
                        <?php

                        ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('js')
    <script src="{{Module::asset('media:dropzone/dist/min/dropzone.min.js')}}"></script>>

    <script>

        Dropzone.autoDiscover = false;
        $(document).ready(function (){


            //Dropzone.options.mediaUploader = false;
            Dropzone.autoDiscover = false;

            var fileList = new Array;
            var i =0;

            var myDropzone = new Dropzone("#mediaUploader", {
                parallelUploads: 3,
                maxFilesize: "{{$maxFileSize}}",
                paramName: 'dzFiles',
                addRemoveLinks: true,
                acceptedFiles: "image/*, .pdf, .txt, .doc, .docx, .xls, .xlsx, .zip, audio/*, video/*, .xlsx, .xla, .ppt, .pptx",
                init: function (){
                    // Hack: Add the dropzone class to the element
                    $(this.element).addClass("dropzone");


                    this.on("success", function(file, serverFileName) {

                        serverFileName = $.parseJSON(serverFileName);

                        if (serverFileName.status === 'success'){
                            fileList[i] = {"serverFileName" : serverFileName[0].filename, 'db_id': serverFileName[0].id, "fileName" : file.name,"fileId" : i };
                            //console.log(fileList);
                            i++;
                        }

                    });


                    this.on("removedfile", function(file) {
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
                            console.log(rmvFile);
                            $.ajax({
                                url: "{{route('destroy-media')}}",
                                type: "POST",
                                data: { "fileName" : rmvFile, 'id': db_id }
                            });
                        }
                    });


                }
            });


        });
    </script>
    {{--<script src="{{url("admin_assets/js/includes/custom-functions.js")}}"></script>--}}
@endsection