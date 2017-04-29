<link href="<?php echo e(Module::asset('media:dropzone/dist/min/dropzone.min.css')); ?>" type="text/css" rel="stylesheet" />


<style>

    .changePasswordRow{
        display: none;
    }

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

    .media-action {
        display: flex;

    }


    .img-src-container{
        display: flex;
        min-width: 200px;
        width: 53%;
        margin-left: auto;
        align-items: center;
    }

    .img-src-container input, .img-src-container button{
        display: inline;
    }

    #url{
        margin-right: 8px;
    }

    /* - Embedded Page Style -*/
    #media-images .section-header {
        padding: 0;
        height: auto;
    }

    #media-images .card-body{
        padding-top: 10px;
    }

    #media-images #content{
        padding-top: 0;
    }

    #myModal #content{

        min-height: inherit ;

    }

    /*#media-container{
        overflow-y: scroll;
        overflow-x: hidden;
        height: 400px;
    }*/

    form.dropzone{
        background-color: #ececec !important;
        border: 2px dashed #4b88dc;
    }

    .image-div{
        overflow: hidden;
    }

    .dz-message{
        font-size: 2.8em !important;
    }

    .note{
        font-size: 24px !important;
    }


    .gallery_img_remove{
        position: absolute;
        top: 0;
        right: 0;
        background: rgba(70, 53, 53, 0.62);
        width: 16px;
        height: 16px;
        font-size: 15px;
        color: #ececec;
        border-radius: 18px;
        text-align: center;
        vertical-align: initial;
        cursor: pointer;
    }

    .gallery_img_remove:hover{
        color: red;
    }

    .gallery-img{
        position: relative;
    }
</style>

<style id="media-button-styles"></style>