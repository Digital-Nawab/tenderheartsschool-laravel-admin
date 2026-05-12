<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="language" content="english">
    <meta property="og:type" content="website">
    <meta property="og:url" content="about-us">
    <meta property="og:site_name" content="Darpan By Pooja">
    <meta property="og:title" content="Darpan By Pooja">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Darpan By Pooja">
    <meta name="twitter:description" content="Darpan By Pooja is a luxury salon and academy that offers a wide range of beauty services.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<meta name="viewport" content="width=device-width, initial-scale=0">-->
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="author" content="unosaleem@gmail.com">
    <!-- Global site shotcut --->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon/png">
    <link rel="apple-touch-icon image_src" href="{{asset('assets/images/favicon.png')}}">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon/png">
    <!-- Outhor and keyword -->
    <meta name="og_site_name" property="og:site_name" content="{!! $_SERVER['SERVER_NAME']; !!}"/>
    <link rel="canonical" href="{{url()->current()}}" />
    <title>{{ isset($title) ? $title : "Darpan By Pooja" }}</title>
    <meta name="description" content="{{ (isset($description) ? $description :'Darpan By Pooja is a luxury salon and academy that offers a wide range of beauty services.') }}"/>
    <meta name="keywords" content="{{ (isset($keywords) ? $keywords : 'Salon, Makeup Academy, Beauty Services, Hair Services, Skin Services, Bridal Makeup, Luxury Salon, Beauty Academy, Top Knot Salon, Beauty Training') }}"/>
    <!-- Bootstrap -->

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Lustria&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="{!! asset('assets-web') !!}/css/bootstrap.min.css" rel="stylesheet">

    <!-- FONT ICONS -->
    <link href="https://use.fontawesome.com/releases/v5.11.0/css/all.css" rel="stylesheet" crossorigin="anonymous">
    <link href="{!! asset('assets-web') !!}/css/flaticon.css" rel="stylesheet">

    <!-- PLUGINS STYLESHEET -->
    <link href="{!! asset('assets-web') !!}/css/menu.css" rel="stylesheet">
    <link id="effect" href="{!! asset('assets-web') !!}/css/dropdown-effects/fade-down.css" media="all" rel="stylesheet">
    <link href="{!! asset('assets-web') !!}/css/tweenmax.css" rel="stylesheet">
    <link href="{!! asset('assets-web') !!}/css/magnific-popup.css" rel="stylesheet">
    <link href="{!! asset('assets-web') !!}/css/owl.carousel.min.css" rel="stylesheet">
    <link href="{!! asset('assets-web') !!}/css/flexslider.css" rel="stylesheet">
    <link href="{!! asset('assets-web') !!}/css/owl.theme.default.min.css" rel="stylesheet">


    <!-- TEMPLATE CSS -->
    <!-- <link href="css/gold-theme.css" rel="stylesheet"> -->
    <link href="{!! asset('assets-web') !!}/css/pink-theme.css" rel="stylesheet">
    <!-- <link href="css/rose-theme.css" rel="stylesheet"> -->
    <!-- <link href="css/silk-theme.css" rel="stylesheet"> -->

    <!-- RESPONSIVE CSS -->
    <link href="{!! asset('assets-web') !!}/css/responsive.css" rel="stylesheet">

    <style>
        /*section{border-bottom:4px solid #035}*/
        .btn-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%; /* Circular shape */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-circle:hover {
            transform: scale(1.2);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        /* Optional Bounce Animation */
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .animated-bounce {
            animation: bounce 2s infinite;
        }

        .rise-shake {
            animation: jump-shaking 1s infinite;
        }
        @keyframes jump-shaking {
            0% { transform: translateX(0) }
            25% { transform: translateY(-9px) }
            35% { transform: translateY(-9px) rotate(17deg) }
            55% { transform: translateY(-9px) rotate(-17deg) }
            65% { transform: translateY(-9px) rotate(17deg) }
            75% { transform: translateY(-9px) rotate(-17deg) }
            100% { transform: translateY(0) rotate(0) }
        }

    </style>

    @yield('css')


</head>
<body class="">
<!-- PRELOADER SPINNER
    ============================================= -->
<div id="loader-wrapper">
    <div id="loading">
        <div class="cssload-loader">
            <div class="fancy-spinner">
                <div class="ring"></div>
                <div class="ring"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>
</div>



<!-- HEADER
        ============================================= -->
<header id="header" class="header tra-menu navbar-light">
    <div class="header-wrapper">


        <!-- MOBILE HEADER -->
        <div class="wsmobileheader clearfix">
            <span class="smllogo"><img src="{!! asset('assets-web') !!}/images/logo-01.png" width="170" height="" alt="mobile-logo"/></span>
            <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
        </div>


        <!-- NAVIGATION MENU -->
        <div class="wsmainfull menu clearfix">
            <div class="wsmainwp clearfix">
                <!-- LOGO IMAGE -->
                <!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 340 x 100 pixels) -->
                <div class="desktoplogo"><a href="#hero-5" class="logo-black"><img src="{!! asset('assets-web') !!}/images/logo-01.png" width="170" height="" alt="header-logo"></a></div>
                <div class="desktoplogo"><a href="#hero-5" class="logo-white"><img src="{!! asset('assets-web') !!}/images/logo-01.png" width="170" height="" alt="header-logo"></a></div>
                <!-- MAIN MENU -->
                <nav class="wsmenu clearfix">
                    <ul class="wsmenu-list">


                        {{-- <!-- MEGAMENU -->
                         <li aria-haspopup="true"><a href="#">Services <span class="wsarrow"></span></a>
                             <div class="wsmegamenu w-70 clearfix">
                                 <div class="container">
                                     <div class="row">

                                         <!-- MEGAMENU LINKS -->
                                         <ul class="col-md-12 col-lg-4 link-list">
                                             <li class="title txt-color-01"><p>Massages</p></li>
                                             <li class="fst-li"><a href="#">Hot Stone Massage</a></li>
                                             <li><a href="#">Traditional Thai Massage</a></li>
                                             <li><a href="#">Aromatherapy Massage</a></li>
                                             <li><a href="#">Deep Tissue Massage</a></li>
                                         </ul>

                                         <!-- MEGAMENU LINKS -->
                                         <ul class="col-md-12 col-lg-4 link-list">
                                             <li class="title txt-color-01"><p>Therapies</p></li>
                                             <li class="fst-li"><a href="#">Physiotherapy</a></li>
                                             <li><a href="#">Skin & Beauty Care</a></li>
                                             <li><a href="#">Executive Reflexology</a></li>
                                             <li><a href="#">Aroma & Jet Hydro Therapy</a></li>
                                         </ul>

                                         <!-- MEGAMENU LINKS -->
                                         <ul class="col-md-12 col-lg-4 link-list">
                                             <li class="title txt-color-01"><p>Treatments</p></li>
                                             <li class="fst-li"><a href="#">Spa Ritual Body Scrub</a></li>
                                             <li><a href="#">Deluxe Korean Scrub</a></li>
                                             <li><a href="#">Soothing Skin Body Wrap</a></li>
                                             <li><a href="#">Teatox Mud Body Treatment</a></li>
                                         </ul>

                                     </div>  <!-- End row -->
                                 </div>  <!-- End container -->
                             </div>  <!-- End wsmegamenu -->
                         </li>	<!-- END MEGAMENU -->
--}}

                        <!-- SIMPLE NAVIGATION LINK -->
                        <li class="nl-simple" aria-haspopup="true"><a href="#">Home</a></li>
                        <li class="nl-simple" aria-haspopup="true"><a href="#">About</a></li>


                        <!-- DROPDOWN MENU -->
                        <li aria-haspopup="true"><a href="#">Our Service <span class="wsarrow"></span></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="#">Nails</a></li>
                                <li aria-haspopup="true"><a href="#">Hair</a></li>
                                <li aria-haspopup="true"><a href="#">Beauty</a></li>
                                <li aria-haspopup="true"><a href="#">MAkeup</a></li>
                                <li aria-haspopup="true"><a href="#">Men's Grooming</a></li>
                            </ul>
                        </li>	<!-- END DROPDOWN MENU -->


                        <!-- DROPDOWN MENU -->
                        <li aria-haspopup="true"><a href="#">Academy <span class="wsarrow"></span></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="#">Our Academy</a></li>
                                <li aria-haspopup="true"><a href="#">Academy Courses</a></li>

                            </ul>
                        </li>	<!-- END DROPDOWN MENU -->


                        <!-- SIMPLE NAVIGATION LINK -->
                        <li class="nl-simple" aria-haspopup="true"><a href="#">Gallery</a></li>
                        <li class="nl-simple" aria-haspopup="true"><a href="#">Offers</a></li>
                        <li class="nl-simple" aria-haspopup="true"><a href="#">Contacts</a></li>


                        <!-- HEADER CALL BUTTON -->
                        {{--  <li class="nl-simple header-phone" aria-haspopup="true">
                              <a href="tel:123456789"><span class="bg-color-09 white-color"><i class="fas fa-phone"></i></span>+12 9 8765 4321</a>
                          </li>--}}


{{--                         HEADER BUTTON--}}
                            <li class="nl-simple" aria-haspopup="true">
                                <a href="#">
                                    <img class="rise-shake" width="64" style="position: relative;top: -8px;" height="64" src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/external-gift-card-black-friday-cyber-monday-flaticons-flat-flat-icons-2.png" alt="external-gift-card-black-friday-cyber-monday-flaticons-flat-flat-icons-2"/>
                                </a>
                            </li>


                        <!-- HEADER SOCIAL LINKS
                        <li class="nl-simple txt-color-03 header-socials clearfix" aria-haspopup="true">
                            <span><a href="#" class="ico-facebook"><i class="fab fa-facebook-f"></i></a></span>
                            <span><a href="#" class="ico-twitter"><i class="fab fa-twitter"></i></a></span>
                            <span><a href="#" class="ico-instagram"><i class="fab fa-instagram"></i></a></span>
                            <span><a href="#" class="ico-dribbble"><i class="fab fa-yelp"></i></a></span>
                        </li> -->


                    </ul>
                </nav>	<!-- END MAIN MENU -->

            </div>
        </div>	<!-- END NAVIGATION MENU -->


    </div>     <!-- End header-wrapper -->
</header>	<!-- END HEADER -->



@yield('body')



<!-- FOOTER-4
			============================================= -->

<!-- Fixed Buttons -->
<div class="position-fixed fixed-bottom translate-middle-y z-index-2">
    <!-- Call Button -->
    <a
        target="_blank" href="tel:+91 95559 81212"
        class="btn btn-circle animated-bounce text-white m-2" style="background:#3DEC55"
        title="Call Us"
    >
        <i class="fas fa-phone"></i>
    </a>

    <!-- WhatsApp Button -->
    <a
        target="_blank"
        href="https://wa.me/9195559 81212"
        class="btn btn-success bg-success text-white btn-circle animated-bounce m-2"
        target="_blank"
        title="Chat on WhatsApp"
    >
        <i class="fab fa-whatsapp"></i>
    </a>
</div>

<!-- FOOTER-4
        ============================================= -->
<footer id="footer-4" class="bg-color-01 footer division">
    <div class="container">
        <!-- FOOTER CONTENT -->
        <div class="row">
            <!-- FOOTER INFO -->
            <div class="col-md-5 col-lg-4">
                <div class="footer-info mb-40">
                    <!-- For Retina Ready displays take a image with double the amount of pixels that your image will be
                    displayed (e.g 408 x 120  pixels) -->
                    <img src="{!! asset('assets-web') !!}/images/logo-01.png" width="204" height="" alt="footer-logo">
                    <!-- Text -->
                    <p class="txt-color-05 mt-20">Aliquam nullam tempor sapien at gravida donec congue ipsum a porta magna and
                        justo velna auctor sapien and augue
                    </p>
                </div>
            </div>

            <!-- FOOTER CONTACTS -->
            <div class="col-md-4 col-lg-3 col-xl-3">
                <div class="footer-contacts mb-40">
                    <!-- Title -->
                    <h6 class="h6-lg txt-color-01">Let's Talk</h6>
                    <!-- Address -->
                    <p class="txt-color-05">Vastu Khand, Gomti Nagar, </p>
                    <p class="txt-color-05">Lucknow</p>
                    <!-- Footer Contacts -->
                    <div class="txt-color-05 mt-15">
                        <!-- Email -->
                        <p class="foo-email">E: <a href="mailto:yourdomain@mail.com">hello@darpanbypooja.com</a></p>
                        <!-- Phone -->
                        <p>Phone: + 0522-3649812</p>
                        <p>Mobile : <a href="tel: 95559 81212">95559 81212</a></p>
                    </div>
                </div>
            </div>

            <!-- FOOTER LINKS -->
            <div class="col-md-3 col-lg-2">
                <div class="footer-links mb-40">
                    <!-- Title -->
                    <h6 class="h6-lg txt-color-01">Quick Links</h6>
                    <!-- Footer Links -->
                    <ul class="txt-color-05 clearfix">
                        <li><p><a href="#">About Us</a></p></li>
                        <li><p><a href="#">Advertising</a></p></li>
                        <li><p><a href="#">Help & FAQs</a></p></li>
                        <li><p><a href="#">Appointments</a></p></li>
                        <li><p><a href="#">Gift Cards</a></p></li>
                    </ul>
                </div>
            </div>

            <!-- FOOTER IMAGES -->
            <div class="col-md-12 col-lg-3">
                <div class="footer-img mb-40">
                    <!-- Title -->
                    <!-- Title -->
                    <h6 class="h6-lg txt-color-01">Our Services</h6>
                    <!-- Instagram Images -->

                    <ul class="txt-color-05 clearfix">
                        <li><p><a href="#">Makeup Service</a></p></li>
                        <li><p><a href="#">HAir Service</a></p></li>
                        <li><p><a href="#">Nail Service</a></p></li>
                        <li><p><a href="#">Beauty Service</a></p></li>
                    </ul>
                </div>
            </div>	<!-- END FOOTER IMAGES -->
        </div>	  <!-- END FOOTER CONTENT -->

        <!-- BOTTOM FOOTER -->
        <div class="bottom-footer txt-color-05">
            <div class="row d-flex align-items-center">
                <!-- FOOTER COPYRIGHT -->
                <div class="col-lg-6">
                    <div class="footer-copyright">
                        <p>&copy; 2020 Darpan By Pooja. All Rights Reserved</p>
                    </div>
                </div>
                <!-- BOTTOM FOOTER LINKS -->
                <div class="col-lg-6">
                    <ul class="bottom-footer-list text-right clearfix">
                        <li><p class="first-list-link"><a target="_blank"  href="https://www.facebook.com/darpanbypooja"><i class="fab fa-facebook-f"></i> Facebook</a></p></li>
                        <li><p><a target="_blank"  href="https://www.instagram.com/darpan_by_pooja/"><i class="fab fa-instagram"></i> Instagram</a></p></li>
                        <li><p class="last-li"><a target="_blank"  href="#"><i class="fab fa-youtube"></i> Youtube</a></p></li>
                        <!--<li><p><a target="_blank"  href="#"><i class="fab fa-twitter"></i> Twitter</a></p></li>-->
                    </ul>
                </div>
            </div>  <!-- End row -->
        </div>	<!-- END BOTTOM FOOTER -->
    </div>	   <!-- End container -->
</footer>	<!-- END FOOTER-4 -->
</div>	<!-- END PAGE CONTENT -->





<!-- EXTERNAL SCRIPTS
    ============================================= -->
<script src="{!! asset('assets-web') !!}/js/jquery-3.4.1.min.js"></script>
<script src="{!! asset('assets-web') !!}/js/bootstrap.min.js"></script>
<script src="{!! asset('assets-web') !!}/js/modernizr.custom.js"></script>
<script src="{!! asset('assets-web') !!}/js/jquery.easing.js"></script>
<script src="{!! asset('assets-web') !!}/js/jquery.appear.js"></script>
<script src="{!! asset('assets-web') !!}/js/jquery.scrollto.js"></script>
<script src="{!! asset('assets-web') !!}/js/menu.js"></script>
<script src="{!! asset('assets-web') !!}/js/materialize.js"></script>
<script src="{!! asset('assets-web') !!}/js/tweenmax.min.js"></script>
<script src="{!! asset('assets-web') !!}/js/slideshow.js"></script>
<script src="{!! asset('assets-web') !!}/js/jquery.vide.min.js"></script>
<script src="{!! asset('assets-web') !!}/js/imagesloaded.pkgd.min.js"></script>
<script src="{!! asset('assets-web') !!}/js/isotope.pkgd.min.js"></script>
<script src="{!! asset('assets-web') !!}/js/jquery.flexslider.js"></script>
<script src="{!! asset('assets-web') !!}/js/owl.carousel.min.js"></script>
<script src="{!! asset('assets-web') !!}/js/jquery.magnific-popup.min.js"></script>


<!-- Custom Script -->
<script src="{!! asset('assets-web') !!}/js/custom.js"></script>

<script>
    $('.video-play').vide("{!! asset('assets-web') !!}/images/video/video", {
        posterType: "jpg"
    });
</script>
@yield('js')
</body>
</html>
