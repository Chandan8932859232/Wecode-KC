<footer class="site-footer">
    <style type="text/css">
        .footer-widget__about p{color: #94a3ac}
    </style>
            <div class="site-footer__upper wow fadeInDown" data-wow-duration="2s" data-wow-delay=".5s">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer-widget footer-widget__about">
                                <h2 class="footer-widget__title">About</h2>
                                <p class="footer-widget__text"><?php $about = DB::table('tbl_about')->where(['id'=>1])->first()->content;
                                echo substr($about,0,150);?></p>
                                <div class="footer-widget__btn-block">
                                   <!--  <a href="#" class="thm-btn">Contact</a> -->
                                    <a href="{{url('/course')}}" class="thm-btn">Courses</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer-widget footer-widget__link">
                                <h2 class="footer-widget__title">Explore</h2>
                                <div class="footer-widget__link-wrap">
                                    <ul class="list-unstyled footer-widget__link-list">
                                        <li><a href="{{url('/')}}">Home</a></li>
                                        <li><a href="{{url('/about')}}">About US</a></li>
                                        <li><a href="{{url('/blog')}}">Blogs</a></li>
                                        <li><a href="{{url('/contact')}}">Contact Us</a></li>
                                    </ul>
                                    <ul class="list-unstyled footer-widget__link-list">
                                        <li><a href="{{url('/privacy_policy')}}">Privacy Policy </a></li>
                                        <li><a href="{{url('/terms')}}">Terms & Condition</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer-widget footer-widget__gallery">
                                <h2 class="footer-widget__title">Blogs</h2>
                                <ul class="list-unstyled footer-widget__gallery-list">
                                    <?php $blog = DB::table('tbl_blog')->limit(6)->get();
                                        foreach($blog as $value){
                                      ?>
                                    <li><a href="#"><img src="{{url('public/upload/blog_image/'.$value->blog_image)}}" alt=""></a></li>
                                <?php } ?>
                                    <!-- <li><a href="#"><img src="{{asset('assets/front')}}/images/footer-1-2.png" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('assets/front')}}/images/footer-1-3.png" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('assets/front')}}/images/footer-1-4.png" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('assets/front')}}/images/footer-1-5.png" alt=""></a></li>
                                    <li><a href="#"><img src="{{asset('assets/front')}}/images/footer-1-6.png" alt=""></a></li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                            <div class="footer-widget footer-widget__contact">
                                <h2 class="footer-widget__title">Contact Us</h2>
                                <ul class="list-unstyled footer-widget__course-list">
                                    <?php $contact = DB::table('tbl_contact')->where(['id'=>1])->first(); ?>
                                  <li>

                                        <p>Address : <?=$contact->address?></p>
                                    </li>
                                    <li>
                                       <!--  <h2><a href="course-details.html">Introduction Web Design</a></h2> -->
                                        <p>Email :  <?=$contact->email?></p>
                                    </li>
                                    <li>
                                        <!-- <h2><a href="course-details.html"> Learning MBA Management </a></h2> -->
                                        <p>Phone : <?=$contact->phone_no?></p>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="site-footer__bottom">
                <div class="container">
                    <p class="site-footer__copy">© Copyright 2022 by WeCode/KC</p>
                    <div class="site-footer__social">


                        <ul class="nav top-social-media">
                            <li><a href="{{url($contact->facebook)}}" data-toggle="_blank" data-toggle="tooltip" data-placement="bottom" title="facebook!"><i
                                        class="fa fa-facebook"></i></a></li>

                            <li><a href="{{url($contact->twitter)}}" data-toggle="tooltip" data-placement="bottom" title="twitter!"><i
                                        class="fa fa-twitter" data-toggle="_blank"></i></a></li>

                                        <li><a href="{{url($contact->youtube)}}" target="_blank"><i class="fa fa-youtube" data-toggle="tooltip" data-placement="bottom" title="youtube!" data-toggle="_blank" >
                                            </i></a></li>


                            <li><a href="{{url($contact->instagram)}}" data-toggle="tooltip" data-placement="bottom"
                                    title="instagram!"><i class="fa fa-instagram" data-toggle="_blank"></i></a></li>
                            <li><a href="{{url($contact->linkedin)}}" data-toggle="tooltip" data-placement="bottom" title="linkedin!"><i
                                        class="fa fa-linkedin" data-toggle="_blank"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>







<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
<script type="text/javascript" src="{{asset('assets/front')}}/js/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script type="text/javascript" src="{{asset('assets/front')}}/js/wow.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#testimonial-slider").owlCarousel({
        items:1,
        itemsDesktop:[1199,1],
        itemsDesktopSmall:[979,1],
        itemsTablet:[768,1],
        pagination: false,
        navigation:true,
        navigationText:["",""],
        autoPlay:true
    });
});

/*Wow Js animation*/
  new WOW().init();
</script>

</body>
</html>
