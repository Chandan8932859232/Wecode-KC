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
            <li class="active"><a href="#">Blog Detail</a></li>
        </ul>
        <h2 class="inner-banner__title">Blog Detail</h2>
    </div>
</section>



<section class="about-two">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12  wow fadeInDown" data-wow-duration="2s" data-wow-delay=".5s">
                        <h1 class="text-center">{{$blog->blog_heading}}</h1>
                        <div class="blog-image">
                            <img src="{{url('public/upload/blog_image/'.$blog->blog_image)}}" width="100%" height="300px" >
                        </div>
                        <p><?=$blog->content?></p>
                    </div>
                      
                        
                        
                    
                </div>
            </div>
        </section>
        
        

       









<!-- ***************************************Start the Footer************************************************ -->
@include('front.incliude.footer')
