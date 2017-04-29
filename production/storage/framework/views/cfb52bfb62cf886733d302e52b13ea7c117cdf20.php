
<!--Footer Start-->
<footer class="design_2">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding-left-none md-padding-left-none sm-padding-left-15 xs-padding-left-15">
                <h4>newsletter</h4>
                <p>By subscribing to our company newsletter
                    you will always be up-to-date on our latest
                    promotions, deals and vehicle inventory!</p>
                <form method="post" action="" class="form_contact">
                    <input type="text" value="" name="MERGE0" placeholder="Email Address">
                    <input type="submit" value="Subscribe" class="md-button">
                    <input type="hidden" name="u" value="">
                    <input type="hidden" name="id" value="">
                </form>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <h4>Latest tweets</h4>
                <div class="latest-tweet">
                    <div><i class="fa fa-twitter"></i>
                        <p>Put your tweet message here.  Make it
                            compelling to attract other <a href="#">@people</a> to
                            read and click on your <a href="#">http://links</a> to
                            your site. <a href="#">#hashtag</a></p>
                    </div>
                    <div><i class="fa fa-twitter"></i>
                        <p>Put your tweet message here.  Make it
                            compelling to attract other <a href="#">@people</a> to
                            read and click on your <a href="#">http://links</a> to
                            your site. <a href="#">#hashtag</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding-right-none md-padding-right-none sm-padding-right-15 xs-padding-right-15">
                <h4>Contact us</h4>
                <div class="footer-contact">
                    <ul>
                        <li><i class="fa fa-map-marker"></i> <strong>Address:</strong> <?php echo e(isset($settings['address'])?$settings['address']: '107 Sunset Blvd., Beverly Hills, CA  90210'); ?></li>
                        <li><i class="fa fa-phone"></i> <strong>Phone:</strong><?php echo e(isset($settings['phone_number'])?$settings['phone_number']: '1-800-567-0123'); ?></li>
                        <li><i class="fa fa-envelope-o"></i> <strong>Email:</strong><a href="#"><?php echo e(isset($settings['email'])?$settings['email']: 'sales@company.com'); ?></a></li>
                    </ul>

                    <i class="fa fa-location-arrow back_icon"></i>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="clearfix"></div>
<section class="copyright-wrap padding-bottom-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="logo-footer margin-bottom-20 md-margin-bottom-20 sm-margin-bottom-10 xs-margin-bottom-20"><a href="#">
                        <h1>PakAuction</h1>
                        <span>Company Slogan</span></a>
                </div>
                <p><?php echo isset($settings['copyright'])?$settings['copyright']: 'Copyright &copy; 2017 pakauction.  All rights reserved'; ?> </p>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <ul class="social margin-bottom-25 md-margin-bottom-25 sm-margin-bottom-20 xs-margin-bottom-20 xs-padding-top-10 clearfix">
                    <li><a class="sc-1" href="#"></a></li>
                    <li><a class="sc-2" href="#"></a></li>
                    <li><a class="sc-3" href="#"></a></li>
                    <li><a class="sc-4" href="#"></a></li>
                    <li><a class="sc-5" href="#"></a></li>
                    <li><a class="sc-6" href="#"></a></li>
                    <li><a class="sc-7" href="#"></a></li>
                    <li><a class="sc-8" href="#"></a></li>
                    <li><a class="sc-9" href="#"></a></li>
                    <li><a class="sc-10" href="#"></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="back_to_top"> <img src="<?php echo e(url('images/2017/default-images/arrow-up.png')); ?>" alt="scroll up" /> </div>
