@include('front.incliude.header')
<style type="text/css">
    .how-udemy-works__sub-title p {
        color: #fff;
        font-size: 13px;
    }

    .course-one__image>img {
        width: 370px;
        height: 250px;
    }

    .course-one__title {
        font-size: 24px;
        font-weight: 600;
        color: #012237;
        margin: 0;
        margin-bottom: 5px;
        height: 49px;
    }

    .course-one__admin {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        font-size: 14px;
        font-weight: 500;
        color: #81868a;
        margin: 0;
        line-height: 1em;
        margin-bottom: 20px;
        height: 31px;
    }

    .blog_style1 .blog_content,
    .blog_style2 .blog_content {
        padding: 15px;
        height: 182px;
    }
</style>

<div class="main-banner">
    <div class="mai-banner">
        <?php foreach($slider as $slider_value){ ?>
        <div class="banner-img">
            <img src="{{ url('public/upload/slider_image/' . $slider_value->slider_image) }}">
        </div>
        <div class="">
            <div class="bannerUpcontant  wow fadeInDown" data-wow-duration="2s" data-wow-delay=".5s">
                <h2 class="banner-one__title">{{ $slider_value->heading }}</h2>
                <p class="banner-tex"><?= $slider_value->text ?></p>
                <p class="banner-one__tag-line">are you read to learn ?</p>
                <?php if(session('drphllip_user_id')==''){ ?>
                <a href="{{ url('/create_account') }}" class="thm-btn">Enroll Now</a>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!-- banner bottom section -->
<div class="banner-bottom-color">
    <div class=" how-udemy-works-container">
        <div class="how-udemy-works carousel-fullscreen-sidebar container" data-purpose="how-udemy-works">
            <div class="how-udemy-works__col fx-lt">
                <span class="how-udemy-works__icon udi udi-signup_temp"><img
                        src="{{ url('public/upload/about_image/' . $sec_one->image) }}" alt="icon"></span>
                <div class="how-udemy-works__text">
                    <b><?= $sec_one->heading ?></b>
                    <div class="how-udemy-works__sub-title"> <?= $sec_one->content ?> </div>
                </div>
            </div>
            <div class="how-udemy-works__col fx-ct">
                <span class="how-udemy-works__icon udi udi-right_talk"><img
                        src="{{ url('public/upload/about_image/' . $sec_two->image) }}" alt="icon"></span>
                <div class="how-udemy-works__text">
                    <b><?= $sec_two->heading ?></b>
                    <div class="how-udemy-works__sub-title"> <?= $sec_two->content ?> </div>
                </div>
            </div>
            <div class="how-udemy-works__col fx-rt">
                <span class="how-udemy-works__icon udi udi-timeless"><img
                        src="{{ url('public/upload/about_image/' . $sec_three->image) }}" alt="icon"></span>
                <div class="how-udemy-works__text">
                    <b><?= $sec_three->heading ?></b>
                    <div class="how-udemy-works__sub-title"> <?= $sec_three->content ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***************************End off Header section************************************** -->

<section class="about-two">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 wow fadeInDown" data-wow-duration="2s" data-wow-delay=".5s">
                <div class="about-two__content">
                    <div class="block-title text-left">
                        <h2 class="block-title__title"><?= $sec_four->heading ?></h2>
                    </div>
                    <p class="about-two__text"><?= $sec_four->content ?></p>
                    <div class="about-two__single-wrap">
                        <div class="about-two__single">
                            <div class="about-two__single-icon">
                                <i class="fa fa-user-secret" aria-hidden="true"></i>
                            </div>
                            <div class="about-two__single-content">
                                <p class="about-two__single-text">Start learning from
                                    our experts</p>
                            </div>
                        </div>
                        <div class="about-two__single">
                            <div class="about-two__single-icon">
                                <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
                            </div>
                            <div class="about-two__single-content">
                                <p class="about-two__single-text">Enhance your skills
                                    with us now</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/about') }}" class="thm-btn">Learn More</a>
                </div>
            </div>
            <div class="col-xl-6 d-flex justify-content-xl-end justify-content-sm-center">
                <div class="about-two__image wow fadeInRight" data-wow-duration="2s" data-wow-delay=".5s">
                    <span class="about-two__image-dots"></span>
                    <img src="{{ url('public/upload/about_image/' . $sec_four->image) }}" alt="">
                    <div class="about-two__count">
                        <div class="about-two__count-text">Trusted by
                            <span class="counter">4890</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ***********************************End about section********************************* -->


<section class="course-one__top-title home-one wow fadeInDown" data-wow-duration="2s" data-wow-delay=".5s">
    <div class="container">
        <div class="block-title mb-0">
            <h2 class="block-title__title">Explore our <br>
                popular courses</h2>
        </div>
    </div>
    <div class="course-one__top-title__curve"></div>
</section>

<section class="course-one course-page">
    <div class="container">
        <div class="row">
            <?php $user_id = session('drphllip_user_id'); foreach($course as $value){

                        $instructor = DB::table('tbl_instructor')->where(['id'=>$value->instructor_id])->first();
                        // echo "<pre>";print_r($instructor);die();
                        $lecture_count = DB::table('tbl_curriculum')->where(['course_id'=>$value->id,'status'=>1])->count();
                        $purchase = DB::table('tbl_order')->where(['user_id'=>$user_id,'course_id'=>$value->id])->count();

                     ?>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="course-one__single">
                    <a href="{{ url('/course_details?key=' . base64_encode($value->id)) }}">
                        <div class="course-one__image">
                            <img src="{{ url('public/upload/course_image/' . $value->image) }}" alt="">
                            <!-- <i class="fa fa-heart"></i> -->
                        </div>
                    </a>
                    <div class="course-one__content">
                        <!-- <a href="#" class="course-one__category">development</a> -->


                        <div class="course-one__admin">
                            <img src="{{ url('public/upload/instructor_image/'.$instructor->image) }}"   alt="">
                            by <a href="{{url('/course_details?key='. base64_encode($value->id))}}">{{($instructor->name)}}</a>
                        </div>




                        <h2 class="course-one__title"><a
                                href="{{ url('/course_details?key=' . base64_encode($value->id)) }}">{{ $value->course_title }}</a>
                        </h2>


                        <div class="course-one__meta">
                            <!-- <a href="#!"><i class="fa fa-clock"></i> 10 Hours</a> -->
                            {{-- <a href="#!"><i class="fa fa-folder-open"></i> <?= $lecture_count ?> Lectures</a> --}}
                            <a href="#!"><i class="fa fa-folder-open"></i>{{ $value->class_level }} </a>

                            <a href="#!">${{ $value->price }}</a>
                        </div>



                        <div class="course-one__meta"><a href="#!">{{ $value->tools }}</a>


                            <a href="#!" ><i class="fa-regular fa-clock"></i>{{ $value->class_duration }}</a>
                        </div>


                        <?php if($purchase==0){?>
                        <?php if(session('drphllip_user_id')==''){ ?>
                        <a href="{{ url('/create_account') }}" class="course-one__link">Enroll Now</a>



                        <?php }else{
                                $user_id = session('drphllip_user_id');
                                $check = DB::table('tbl_cart')->where(['user_id'=>$user_id,'course_id'=>$value->id])->count();
                                if($check=='0'){
                                ?>
                        <a class="course-one__link" data-id="{{ $value->id }}" data-price="{{ $value->price }}"
                            onclick="add_cart(this)">Add to cart</a>
                        <?php }else{ ?>
                        <a class="course-one__link" data-id="{{ $value->id }}"
                            data-price="{{ $value->price }}">Added to cart</a>
                        <?php } } }else{ ?>
                        <a class="course-one__link"
                            href="{{ url('/course_details?key=' . base64_encode($value->id)) }}">Purchased</a>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <?php } ?>
            <script type="text/javascript">
                function add_cart(th) {
                    var course_id = $(th).data('id');
                    var price = $(th).data('price');
                    var token = "<?php echo csrf_token(); ?>";
                    $.ajax({
                        type: 'Post',
                        url: "{{ url('home/add_to_cart') }}",
                        data: {
                            course_id: course_id,
                            price: price,
                            _token: token
                        },
                        success: function(data) {
                            //alert(data);
                            if ($.trim(data) == 'done') {
                                $('#myModaladdcart').modal('show');
                            }

                        }
                    });


                }
            </script>

            <!-- <div class="col-lg-4">
                        <div class="course-one__single">
                            <div class="course-one__image">
                                <img src="{{ asset('assets/front') }}/images/course-1-2.jpg" alt="">
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="course-one__content">
                                <a href="#" class="course-one__category">It &amp; Software</a>
                                <div class="course-one__admin">
                                    <img src="{{ asset('assets/front') }}/images/team-1-2.jpg" alt="">
                                    by <a href="teacher-details.html">Cora Diaz</a>
                                </div>
                                <h2 class="course-one__title"><a href="#!">Improve editing skills</a></h2>

                                <div class="course-one__stars">
                                    <span class="course-one__stars-wrap">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="course-one__count">4.8</span>
                                    <span class="course-one__stars-count">250</span>
                                </div>
                                <div class="course-one__meta">
                                    <a href="#!"><i class="fa fa-clock"></i> 10 Hours</a>
                                    <a href="#!"><i class="fa fa-folder-open"></i> 6 Lectures</a>
                                    <a href="#!">$18</a>
                                </div>
                                <a href="#" class="course-one__link">See Preview</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="course-one__single">
                            <div class="course-one__image">
                                <img src="{{ asset('assets/front') }}/images/course-1-3.jpg" alt="">
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="course-one__content">
                                <a href="#" class="course-one__category">marketing</a>
                                <div class="course-one__admin">
                                    <img src="{{ asset('assets/front') }}/images/team-1-3.jpg" alt="">
                                    by <a href="teacher-details.html">Ruth Becker</a>
                                </div>
                                <h2 class="course-one__title"><a href="course-details.html">Marketing strategies</a></h2>

                                <div class="course-one__stars">
                                    <span class="course-one__stars-wrap">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="course-one__count">4.8</span>
                                    <span class="course-one__stars-count">250</span>
                                </div>
                                <div class="course-one__meta">
                                    <a href="#!"><i class="fa fa-clock"></i> 10 Hours</a>
                                    <a href="#!"><i class="fa fa-folder-open"></i> 6 Lectures</a>
                                    <a href="#!">$18</a>
                                </div>
                                <a href="#" class="course-one__link">See Preview</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="course-one__single">
                            <div class="course-one__image">
                                <img src="{{ asset('assets/front') }}/images/course-1-4.jpg" alt="">
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="course-one__content">
                                <a href="#" class="course-one__category">Photography</a>
                                <div class="course-one__admin">
                                    <img src="{{ asset('assets/front') }}/images/team-1-4.jpg" alt="">
                                    by <a href="#!">Ernest Rodriquez</a>
                                </div>
                                <h2 class="course-one__title"><a href="course-details.html">Basics of photography</a></h2>

                                <div class="course-one__stars">
                                    <span class="course-one__stars-wrap">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="course-one__count">4.8</span>
                                    <span class="course-one__stars-count">250</span>
                                </div>
                                <div class="course-one__meta">
                                    <a href="#!"><i class="fa fa-clock"></i> 10 Hours</a>
                                    <a href="#!"><i class="fa fa-folder-open"></i> 6 Lectures</a>
                                    <a href="#!">$18</a>
                                </div>
                                <a href="#" class="course-one__link">See Preview</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="course-one__single">
                            <div class="course-one__image">
                                <img src="{{ asset('assets/front') }}/images/course-1-5.jpg" alt="">
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="course-one__content">
                                <a href="#" class="course-one__category">marketing</a>
                                <div class="course-one__admin">
                                    <img src="{{ asset('assets/front') }}/images/team-1-5.jpg" alt="">
                                    by <a href="#!">Isabella Stanley</a>
                                </div>
                                <h2 class="course-one__title"><a href="#!">Affiliate bootcamp</a>
                                </h2>

                                <div class="course-one__stars">
                                    <span class="course-one__stars-wrap">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="course-one__count">4.8</span>
                                    <span class="course-one__stars-count">250</span>
                                </div>
                                <div class="course-one__meta">
                                    <a href="#!"><i class="fa fa-clock"></i> 10 Hours</a>
                                    <a href="#!"><i class="fa fa-folder-open"></i> 6 Lectures</a>
                                    <a href="#!">$18</a>
                                </div>
                                <a href="#" class="course-one__link">See Preview</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="course-one__single">
                            <div class="course-one__image">
                                <img src="{{ asset('assets/front') }}/images/course-1-6.jpg" alt="">
                                <i class="fa fa-heart"></i>
                            </div>
                            <div class="course-one__content">
                                <a href="#" class="course-one__category">Health &amp; Fitness</a>
                                <div class="course-one__admin">
                                    <img src="{{ asset('assets/front') }}/images/team-1-6.jpg" alt="">
                                    by <a href="#!">Katherine Collins</a>
                                </div>
                                <h2 class="course-one__title"><a href="#!">Healthy workout tips </a></h2>

                                <div class="course-one__stars">
                                    <span class="course-one__stars-wrap">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <span class="course-one__count">4.8</span>
                                    <span class="course-one__stars-count">250</span>
                                </div>
                                <div class="course-one__meta">
                                    <a href="#!"><i class="fa fa-clock"></i> 10 Hours</a>
                                    <a href="#!"><i class="fa fa-folder-open"></i> 6 Lectures</a>
                                    <a href="#!">$18</a>
                                </div>
                                <a href="#" class="course-one__link">See Preview</a>
                            </div>
                        </div>
                    </div> -->
        </div>
    </div>
</section>
<!-- ****************************************End Courses section**************************************************** -->


<section class="video-two">
    <div class="container">
        <img src="{{ asset('assets/front') }}/images/scratch-1-1.png" class="video-two__scratch" alt="">
        <div class="row">
            <div class="col-lg-7 col-md-8 col-sm-9">
                <div class="video-two__content  wow fadeInLeft" data-wow-duration="2s" data-wow-delay=".5s">
                    <h2 class="video-two__title">Kipso one &amp; only <br>
                        mission is to extend <br>
                        your knowledge base</h2>
                    <a href="#" class="thm-btn">Learn More</a>
                </div>
            </div>
            <div class="col-lg-5 col-md-4 col-sm-3 d-flex justify-content-lg-end justify-content-sm-start">
                <div class="my-auto">
                    <a href="#" class="video-two__popup"><i class="fa fa-play"></i></a>

                </div>
            </div>
        </div>
    </div>
</section>


<!-- ***************************************Start the Blogs************************************************ -->


<div class="section pb_70">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 animation animated fadeInUp" data-animation="fadeInUp"
                data-animation-delay="0.2s" style="animation-delay: 0.2s; opacity: 1;">
                <div class="heading_s1 text-center">
                    <h2>Latest Blogs</h2>
                    <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore.</p>
                </div>

            </div>
        </div>
        <div class="row justify-content-center">
            <?php foreach($blog as $b_value){
            $created_date = date('M-d-Y',strtotime($b_value->created_at));
            $date = explode("-", $created_date);
            //print_r($date);
         ?>
            <div class="col-lg-4 col-md-6 animation animated fadeInUp" data-animation="fadeInUp"
                data-animation-delay="0.2s" style="animation-delay: 0.2s; opacity: 1;">
                <div class="blog_post blog_style1 box_shadow1">
                    <div class="blog_img">
                        <a href="#"> <img src="{{ url('public/upload/blog_image/' . $b_value->blog_image) }}"
                                alt="blog_small_img1" height="250px"> </a>
                        <div class="post_date radius_all_5">
                            <h5><span>{{ $date[0] }}, {{ $date[1] }}</span> {{ $date[2] }}</h5>
                        </div>
                    </div>
                    <div class="blog_content">
                        <div class="blog_text">
                            <ul class="list_none blog_meta">
                                <!-- <li><a href="#"><i class="fa fa-user-o"></i> <span>By Admin</span></a></li> -->
                                <!-- <li><a href="#"><i class="fa fa-commenting-o"></i> <span>2 Comment</span></a></li> -->
                            </ul>
                            <h5 class="blog_title"><a href="#"><?= $b_value->blog_heading ?></a></h5>
                            <p><?= substr($b_value->content, 0, 149) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- <div class="col-lg-4 col-md-6 animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.3s" style="animation-delay: 0.3s; opacity: 1;">
          <div class="blog_post blog_style1 box_shadow1">
            <div class="blog_img">
                      <a href="#"> <img src="{{ asset('assets/front') }}/images/blog_small_img2.jpg" alt="blog_small_img2"> </a>
                        <div class="post_date radius_all_5">
                          <h5><span>Jan, 02</span> 2020</h5>
                        </div>
                    </div>
            <div class="blog_content">
              <div class="blog_text">
                            <ul class="list_none blog_meta">
                                <li><a href="#"><i class="fa fa-user-o"></i> <span>By Admin</span></a></li>
                                <li><a href="#"><i class="fa fa-commenting-o"></i> <span>2 Comment</span></a></li>
                            </ul>
                <h5 class="blog_title"><a href="#">I Must Explain To This Mistaken</a></h5>
                <p>Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this generator on the Internet.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 animation animated fadeInUp" data-animation="fadeInUp" data-animation-delay="0.4s" style="animation-delay: 0.4s; opacity: 1;">
          <div class="blog_post blog_style1 box_shadow1">
            <div class="blog_img">
                      <a href="#"> <img src="{{ asset('assets/front') }}/images/blog_small_img3.jpg" alt="blog_small_img3"> </a>
                        <div class="post_date radius_all_5">
                          <h5><span>Aug, 02</span> 2020</h5>
                        </div>
                    </div>
            <div class="blog_content">
              <div class="blog_text">
                            <ul class="list_none blog_meta">
                                <li><a href="#"><i class="fa fa-user-o"></i> <span>By Admin</span></a></li>
                                <li><a href="#"><i class="fa fa-commenting-o"></i> <span>2 Comment</span></a></li>
                            </ul>
                            <h5 class="blog_title"><a href="#">There Anyone Who Loves Hims</a></h5>
                            <p>Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this generator on the Internet.</p>
                        </div>
            </div>
          </div>
        </div> -->
        </div>
    </div>
</div>

<!-- *******************************************Testimonials************************************************************* -->
<section class="testimonials-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div id="testimonial-slider" class="owl-carousel">
                    <?php foreach($testimonial as $tvalue){ ?>
                    <div class="testimonial">
                        <div class="">
                            <h3>{{ $tvalue->name }}</h3>
                            <!--  <img src="images/img-1.jpg" alt=""> -->
                        </div>
                        <p class="description">
                            {{ $tvalue->text }}
                        </p>
                        <div class="testimonial-prof">
                            <!-- <span class="title">williamson</span> -->
                            <small>{{ $tvalue->designation }}</small>
                        </div>
                    </div>
                    <?php } ?>



                    {{-- <div class="testimonial">
                    <div class="">
                      <h3>Lorem ipsum dolor sit amet</h3>
                       <img src="images/img-2.jpg" alt="">
                    </div>
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis odio ac eros sollicitudin consequat. Proin a tortor tortor. Nullam consequat dictum metus in vulputate. Pellentesque congue lectus justo, et.
                    </p>
                    <div class="testimonial-prof">
                        <span class="title">kristiana</span>
                        <small>Web Designer</small>
                    </div>
                </div>
                <div class="testimonial">
                    <div class="">
                      <h3>Lorem ipsum dolor sit amet</h3>
                   <img src="images/img-3.jpg" alt="">
                    </div>
                    <p class="description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis odio ac eros sollicitudin consequat. Proin a tortor tortor. Nullam consequat dictum metus in vulputate. Pellentesque congue lectus justo, et.
                    </p>
                    <div class="testimonial-prof">
                        <span class="title">kristiana</span>
                        <small>Web Designer</small>
                    </div>
                </div> --}}


                </div>
            </div>
        </div>
    </div>
</section>

<!-- ***************************************Start the Footer************************************************ -->
@include('front.incliude.footer')
