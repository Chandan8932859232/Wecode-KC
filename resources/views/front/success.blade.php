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
<style type="text/css">

  .card-expiry-year{margin-left: 113px;



    margin-top: -38px;}
    .card-payment{    border: 1px solid #d4cfcf;
    padding: 25px;}

</style>

  <section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><a href="#">Success</a></li>
        </ul>
        <h2 class="inner-banner__title">Success</h2>
    </div>
</section>



<section class="about-two">
    <div class="container">
        <div class="row">
        	<div class="col-xl-6 offset-3">
            <div class="form-group text-center" style="width: 100%">
                    <h1>Thank You. Successfully Submited your order</h1>
            </div><br>
            <div class="form-group text-center" style="width: 100%">
                    <a href="{{url('/')}}" class="btn btn-primary">Home</a>
            </div>
                
        		
        	</div>
            
        	
        </div>
    </div>
</section>




<!-- ***************************************Start the Footer************************************************ -->
@include('front.incliude.footer')
