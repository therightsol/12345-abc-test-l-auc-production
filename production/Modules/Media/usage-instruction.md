Installation Instructions:
Media Module
---------------------------


In Blade:

Step 1:
    @include('media::layoutfiles.embedd')


Step 2:
    Where you want to display (single / gallery) image(s):
    ------------------------------------------------------
    @yield('insert-image-code')
    @yield('insert-image-gallery')
    @yield('insert-product-variation-code') // only for product variations
    

Step 3:
    For Single Image:
    Your controller should passed a variable ($featured_img) to display img
     
    
    
    // to display gallery images - your controller should pass a variable ($gallery_images)
    // find post and fetch images column value
    $post = Post::find($product->post_id);
    $gallery_images = $post->images;
    
    
    // to save gallery images
    $gallery_images = $request->has('gallery_images_ids') ? $request->input('gallery_images_ids') : '';
    
    phr es $gallery_images ko 'images' k column mai save krva dena.