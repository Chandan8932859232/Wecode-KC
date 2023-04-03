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
            <li class="active"><a href="#">Terms</a></li>
        </ul>
        <h2 class="inner-banner__title">Terms</h2>
    </div>
</section>



<style type="text/css">
	h4{width: 100%}
</style>
<section class="about-two">
    <div class="container">
        <div class="row text-center">
        	
			<h4>{{$about->heading}}</h4>
		</div>
			<?=$about->content?>
        	
        
    </div>
</section>

<!-- ***************************************Start the Footer************************************************ -->
@include('front.incliude.footer')




