<div id="content">
    <section class="style-default-bright">

        <div class="section-body">
            <div class="row">
                <div id="dropzone">
                    <form action="{{route('admin.store-media')}}" class="dropzone dz-clickable" id="mediaUploader">
                        <div class="dz-message">Drop files here or click to upload.
                            <br> <span class="note">(You can upload any text, pdf, image, video, doc, xls file etc)</span>

                        </div>
                        {{csrf_field()}}
                    </form>
                </div>
                <div>
                    <strong>You can upload maximum : </strong> {{$maxFileSize . ' M'}}
                </div>
            </div>
        </div>
    </section>
</div>