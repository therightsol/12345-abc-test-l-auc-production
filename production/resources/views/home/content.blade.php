<section class="message-wrap">
    <div class="container">
        <div class="row">
            <h2 class="col-lg-9 col-md-8 col-sm-12 col-xs-12 xs-padding-left-15">Discover a website for car dealers that converts visitors to <span class="alternate-font">customers</span></h2>

            <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 xs-padding-right-15">
                @if(isset($helpPage->post_status->status_title) and $helpPage->post_status->status_title == 'published')
                <a href="{{ url($helpPage->slug) }}" style="display: inline-block;    clear: none;" class="default-btn pull-right action_button lg-button">
                    Help
                </a>
                @endif
                    @if(isset($rulesPage->post_status->status_title) and $rulesPage->post_status->status_title == 'published')

                    <a href="{{ url($rulesPage->slug) }}" style="display: inline-block;     clear: none; margin-right: 10px" class="default-btn pull-right action_button lg-button">
                    Rules
                </a>
                    @endif

            </div>

        </div>
    </div>
    <div class="message-shadow"></div>
</section>
<!--message-wrap ends-->
<section class="content">
    <div class="container">
        <div class="inner-page homepage margin-bottom-none">
            <!--car-info-wrap ends-->
            <section class="welcome-wrap padding-top-30 sm-horizontal-15">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 welcome padding-left-none padding-bottom-40 scroll_effect fadeInUp">
                        <h4 class="margin-bottom-25 margin-top-none"><strong>WELCOME</strong> TO PAK AUCTION</h4>
                        <p>Lorem ipsum dolor sit amet, falli tollit cetero te eos. Ea ullum liber aperiri mi, impetus
                            ate philosophia ad duo, quem regione ne ius. Vis quis lobortis dissentias ex, in du aft
                            philosophia, malis necessitatibus no mei. Volumus sensibus qui ex, eum duis doming
                            ad. Modo liberavisse eu mel, no viris prompta sit. Pro labore sadipscing et. Ne peax
                            egat usu te mel <span class="alternate-font">vivendo scriptorem</span>. Pro labore sadipscing et. Ne pertinax egat usu te
                            mel vivendo scriptorem.</p>
                        <p>Cum ut tractatos imperdiet, no tamquam facilisi qui. Eum tibique consectetuer in, an
                            referrentur vis, vocent deseruisse ex mel. Sed te <span class="alternate-font">idque graecis</span>. Vel ne libris dolores,
                            mel graece mel vivendo scriptorem dolorum.</p>
                    </div>
                    <!--welcome ends-->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-right-none sm-padding-left-none md-padding-left-15 xs-padding-left-none padding-bottom-40 scroll_effect fadeInUp" data-wow-delay='.2s' style="z-index:100">
                        <h4 class="margin-bottom-25 margin-top-none"><strong>SEARCH</strong></h4>

                        @include('home.searchForm')
                    </div>
                    <!--invetory ends-->
                </div>
                <div class="row parallax_parent design_2 margin-bottom-40 margin-top-30">
                    <div class="parallax_scroll clearfix" data-velocity="-.5" data-offset="-200" data-image="{{ asset('images/1.jpg') }}">
                        <div class="overlay">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding-left-none xs-margin-bottom-none xs-padding-top-30 scroll_effect bounceInLeft"> <span class="align-center"><i class="fa fa-6x fa-car"></i></span>
                                        <h3>Top Cars</h3>
                                        <p>Sed ut perspiciatis unde om nis
                                            natus error sit volup atem accusant
                                            dolorem que laudantium. Totam
                                            aperiam, eaque ipsa quae ai.</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 xs-margin-bottom-none xs-padding-top-30 scroll_effect bounceInLeft" data-wow-delay=".2s"> <span class="align-center"><i class="fa fa-6x fa-road"></i></span>
                                        <h3>Proven Technology</h3>
                                        <p>Sed ut perspiciatis unde om nis
                                            natus error sit volup atem accusant
                                            dolorem que laudantium. Totam
                                            aperiam, eaque ipsa quae ai.</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 xs-margin-bottom-none xs-padding-top-30 scroll_effect bounceInRight" data-wow-delay=".2s"> <span class="align-center"><i class="fa fa-6x fa-credit-card"></i></span>
                                        <h3>Online Payment</h3>
                                        <p>Sed ut perspiciatis unde om nis
                                            natus error sit volup atem accusant
                                            dolorem que laudantium. Totam
                                            aperiam, eaque ipsa quae ai.</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 xs-margin-bottom-none xs-padding-top-30 padding-right-none scroll_effect bounceInRight"> <span class="align-center"><i class="fa fa-6x fa-apple"></i></span>
                                        <h3>Perspiciatis unde</h3>
                                        <p>Sed ut perspiciatis unde om nis
                                            natus error sit volup atem accusant
                                            dolorem que laudantium. Totam
                                            aperiam, eaque ipsa quae ai.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="car-block-wrap padding-bottom-40">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bottom-none">
                                <div class="flip margin-bottom-30">
                                    <div class="card">
                                        <div class="face front"><img class="img-responsive" src="{{ asset('images/car1.jpg') }}" alt=""></div>
                                        <div class="face back">
                                            <div class='hover_title'>Race Ready</div>
                                            <a href="#."><i class="fa fa-link button_icon"></i></a> <a href="{{ asset('images/car1.jpg') }}" class="fancybox"><i class="fa fa-arrows-alt button_icon"></i></a> </div>
                                    </div>
                                </div>
                                <h4><a href="#">FACTORY READY FOR TRACK DAY</a></h4>
                                <p class="margin-bottom-none">Sea veniam lucilius neglegentur ad, an per sumo volum
                                    voluptatibus. Qui cu everti repudiare. Eam ut cibo nobis
                                    aperiam, elit qualisque at cum. Possit antiopam id est.
                                    Illud delicata ea mel, sed novum mucius id. Nullam qua.</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bottom-none">
                                <div class="flip horizontal margin-bottom-30">
                                    <div class="card">
                                        <div class="face front"><img class="img-responsive" src="{{ asset('images/car2.jpg') }}" alt=""></div>
                                        <div class="face back">
                                            <div class='hover_title'>Family Oriented</div>
                                            <a href="#."><i class="fa fa-link button_icon"></i></a> <a href="{{ asset('images/car2.jpg') }}" class="fancybox"><i class="fa fa-arrows-alt button_icon"></i></a> </div>
                                    </div>
                                </div>
                                <h4><a href="#">A SPORT UTILITY FOR THE FAMILY</a></h4>
                                <p class="margin-bottom-none">Cum ut tractatos imperdiet, no tamquam facilisi qui.
                                    Eum tibique consectetuer in, an legimus referrentur vis,
                                    vocent deseruisse ex mel. Sed te idque graecis. Vel ne
                                    libris dolores, in mel graece dolorum.</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 margin-bottom-none">
                                <div class="flip margin-bottom-30">
                                    <div class="card">
                                        <div class="face front"><img class="img-responsive" src="{{ asset('images/car3.jpg') }}" alt=""></div>
                                        <div class="face back">
                                            <div class='hover_title'>World Class</div>
                                            <a href="#."><i class="fa fa-link button_icon"></i></a> <a href="{{ asset('images/car3.jpg') }}" class="fancybox"><i class="fa fa-arrows-alt button_icon"></i></a> </div>
                                    </div>
                                </div>
                                <h4><a href="#">MAKE AN EXECUTIVE STATEMENT</a></h4>
                                <p class="margin-bottom-none">Te inermis cotidieque cum, sed ea utroque atomorum
                                    sadipscing. Qui id oratio everti scaevola, vim ea augue
                                    ponderum vituperatoribus, quo adhuc abhorreant
                                    omittantur ad. No his fierent perpetua consequat, et nis.</p>
                            </div>
                        </div>
                    </div>
                </section>
                <div class='fullwidth_element_parent margin-top-30 padding-bottom-40'>
                    <div id='google-map-listing' class='fullwidth_element' data-longitude='{{ isset($settings['map_longitude'])?$settings['map_longitude']: '-79.38' }}' data-latitude='{{ isset($settings['map_latitude'])?$settings['map_latitude']: '43.65' }}' data-zoom='{{ isset($settings['map_zoom'])?$settings['map_zoom']: '12' }}' style='height: 390px;' data-scroll='false' data-style='[{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#F0F0F0"},{"saturation":-100},{"gamma":2.15},{"lightness":12}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":24}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57}]}]'></div>
                </div>
                @include('home.listing')
            </section>

            <div class="row parallax_parent margin-top-30">
                <div class="parallax_scroll clearfix" data-velocity="-.5" data-offset="-300" data-no-repeat="true" data-image="{{ asset('images/car4.jpg') }}">
                    <div class="overlay">
                        <div class="container">

                            <div class="row">

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding-left-none margin-vertical-60">
                                    <i class="fa fa-car"></i>

                                    <span class="animate_number margin-vertical-15">
                                        <span class="number">2,000</span>
                                    </span>

                                    Cars Sold
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 margin-vertical-60">
                                    <i class="fa fa-money"></i>

                                    <span class="animate_number margin-vertical-15">
                                        $<span class="number">750,000</span>
                                    </span>

                                    Amount Sold
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 margin-vertical-60">
                                    <i class="fa fa-users"></i>

                                    <span class="animate_number margin-vertical-15">
                                        <span class="number">100</span>%
                                    </span>

                                    Customer Satisfaction
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 padding-right-none margin-vertical-60">
                                    <i class="fa fa-tint"></i>

                                    <span class="animate_number margin-vertical-15">
                                        <span class="number">3,600</span>
                                    </span>

                                    Oil Changes
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>