@include('front.incliude.header')

<style type="text/css">
    .bannerUpcontant {

        position: absolute;

        top: 33%;

        left: 10%;

        width: 80%;

    }

    .page-main-banner {

        width: 100%;

        float: left;

        height: auto;

        overflow: hidden;

    }

    .page-main-banner img {

        width: 100%;

        height: 250px;

    }

    .form-signup {
        border: 1px solid #8e8585;

        padding: 27px;
    }

    .total-amount {
        font-size: 20px;

        font-weight: 600;
    }

    .price-total {
        font-size: 20px;

        font-weight: 600;
    }
</style>



<section class="inner-banner">

    <div class="container">

        <ul class="list-unstyled thm-breadcrumb">

            <li><a href="{{ url('/') }}">Home</a></li>

            <li class="active"><a href="#">Blog</a></li>

        </ul>

        <h2 class="inner-banner__title">Blog</h2>

    </div>

</section>





<div class="divider-line"></div>

<section class="about-two">

    <div class="container">

        <div class="row">

            <!-- <div class="col-xl-12  wow fadeInDown" data-wow-duration="2s" data-wow-delay=".5s"> -->

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

                            <h5 class="blog_title"><a
                                    href="{{ url('/blog_detail?key=' . base64_encode($b_value->id)) }}"><?= $b_value->blog_heading ?></a>
                            </h5>

                            <p><?= substr($b_value->content, 0, 149) ?></p>

                        </div>

                    </div>

                </div>

            </div>

            <?php } ?>







        </div>

    </div>

</section>

<!-- ***************************************Start the Footer************************************************ -->

@include('front.incliude.footer')
