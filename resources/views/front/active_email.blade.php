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
</style>

  <section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active"><a href="#">Success</a></li>
        </ul>
        <h2 class="inner-banner__title">Success</h2>
    </div>
</section>

<section class="about-two">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-3 wow fadeInDown" data-wow-duration="2s" data-wow-delay=".5s">
                        <div class="form-signup text-center">
                          <?php if($valid==1){ ?>
                          <h2 class="text-center">Thank You. Your account is Active.</h2>
                        <?php }else{ ?>
                          <h2 class="text-center">Your account is already activated</h2>
                        <?php } ?>
                        <a href="{{url('/login')}}" class="btn btn-success">Login</a>

                        </div>
                    </div>

                </div>
            </div>
        </section>












<!-- ***************************************Start the Footer************************************************ -->
@include('front.incliude.footer')
