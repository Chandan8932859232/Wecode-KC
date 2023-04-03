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

.form-signup{border: 1px solid #8e8585;

    padding: 27px;}

.total-amount{font-size: 20px;

    font-weight: 600;}

    .price-total{font-size: 20px;

    font-weight: 600;}





</style>



  <section class="inner-banner">

    <div class="container">

        <ul class="list-unstyled thm-breadcrumb">

            <li><a href="{{url('/')}}">Home</a></li>

            <li class="active"><a href="#">About</a></li>

        </ul>

        <h2 class="inner-banner__title">About</h2>

    </div>

</section>



<section class="about-two">

    <div class="container">

        <div class="row">

        	<div class="col-xl-6">


        		<h2 class="abt-heading"><?=$about->heading?></h2>

        		<p><?=$about->content?></p>

        	</div>

        	<div class="col-xl-6">

        		<img src="{{url('public/upload/about_image/'.$about->image)}}">



        	</div>

        </div>

    </div>

</section>

<section class="testimonials-section">

  <div class="container">

    <div class="row">

        <div class="col-md-10 offset-md-1">

            <div id="testimonial-slider" class="owl-carousel">

                <?php foreach($testimonial as $tvalue){ ?>

                <div class="testimonial">

                    <div class="">

                      <h3>{{$tvalue->name}}</h3>

                       <!--  <img src="images/img-1.jpg" alt=""> -->

                    </div>

                    <p class="description">

                        {{$tvalue->text}}

                    </p>

                    <div class="testimonial-prof">

                        <!-- <span class="title">williamson</span> -->

                        <small>{{$tvalue->designation}}</small>

                    </div>

                </div>

            <?php } ?>





            </div>

        </div>

    </div>

</div>

</section>

<!-- ***************************************Start the Footer************************************************ -->

@include('front.incliude.footer')

