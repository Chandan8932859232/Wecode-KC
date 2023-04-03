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
            <li class="active"><a href="#">CheckOut</a></li>
        </ul>
        <h2 class="inner-banner__title">CheckOut</h2>
    </div>
</section>
<?php $cart = $my_cart->get();

                            $total = 0;

                            foreach($cart as $value){

                              $total=$total+$value->total_price;

                            }

                            

                            $order_total = $total+0;

                            

                            $product_array = array();

                            foreach($cart as $valuess){

                              $course_id = $valuess->course_id;

                              array_push($product_array, $course_id);

                            }

                            $pr_id = implode(",", $product_array);



                          ?>


<section class="about-two">
    <div class="container">
        <div class="row">
        	<div class="col-xl-6 card-payment">
                <h3 class="text-center">Payment</h3>
                
                <form role="form" action="{{url('/stripePost')}}" method="post" class="require-validation Billing_forms" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">

                                  @csrf

                                  <input type="hidden" name="amount" value="{{number_format((float)$order_total, 2, '.', '')}}">

                                  <input type="hidden" name="totalamount" value="{{$total}}">

                                  <input type="hidden" name="totalproduct" value="{{$pr_id}}">

                                  <div class="form-group">

                                    <label for="psw-repeat">Card number <span>*</span></label>

                                    <input type="text" placeholder="Card number" class="form-control card-number" name="card-number" size='20'autocomplete='off' required>

                                  </div>

                                  <div class="form-group">

                                    <label for="psw-repeat">Expiry <span>*</span></label>



                                    <input type="text" placeholder="MM" class="form-control col-md-2 card-expiry-month" name="card-expiry-month" autocomplete='off' required>



                                    <input type="text" placeholder="YYYY" name="card-expiry-year" class="form-control col-md-2 card-expiry-year" autocomplete='off' required>

                                  </div>

                                  <div class="form-group">

                                    <label for="psw-repeat">Cardholder's name <span>*</span></label>

                                    <input type="text" placeholder="Cardholder's name" class="form-control card-holder-name" name="card-holder-name" autocomplete='off' required>

                                  </div>

                                  <div class="form-group">

                                    <label for="email">CVV/CVC <span>*</span></label>

                                    <input type="text" placeholder="CVV/CVC" class="form-control card-cvc" name="card_cvc" required>

                                    <span class="what-is-cvv">What is CVV/CVC</span>

                                  </div>

                                  <div class="form-group text-center">

                                    <button class="on-click-continue-btn billing-continue card-continue btn btn-success" type="submit">Pay ${{$order_total}}</button>

                                    

                                  </div>

                                </form>
        		
        	</div>
            <div class="col-xl-6">
                <h3 class="text-center">ITEMS IN YOUR ORDER</h3>
                <table class="table">
                    <tbody>
                        <?php foreach($cart as $values){

                          $course_title = DB::table('tbl_course')->where(['id'=>$value->course_id])->first();

                        ?>
                    <tr>
                        <td>{{$course_title->course_title}}</td>
                        <td>${{$course_title->price}}</td>
                    </tr>
                <?php } ?>
                    <tr>

                      <td>Order Total </td>

                      <td class="summry-price"> ${{$order_total}}</td>

                    </tr> 
                    </tbody>
                    
                </table>

            </div>
        	
        </div>
    </div>
</section>
<!-- payment -->

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">

$(function() {

  

    var $form         = $(".require-validation");

  $('form.require-validation').bind('submit', function(e) {

    

    

    var $form         = $(".require-validation"),

        inputSelector = ['input[type=email]', 'input[type=password]',

                         'input[type=text]', 'input[type=file]',

                         'textarea'].join(', '),

        $inputs       = $form.find('.required').find(inputSelector),

        $errorMessage = $form.find('div.error'),

        valid         = true;

        $errorMessage.addClass('hide');

 

        $('.has-error').removeClass('has-error');

    $inputs.each(function(i, el) {

      var $input = $(el);

      if ($input.val() === '') {

        $input.parent().addClass('has-error');

        $errorMessage.removeClass('hide');

        e.preventDefault();

      }

    });

  

    if (!$form.data('cc-on-file')) {

      e.preventDefault();

      Stripe.setPublishableKey($form.data('stripe-publishable-key'));

      Stripe.createToken({

        number: $('.card-number').val(),

        cvc: $('.card-cvc').val(),

        exp_month: $('.card-expiry-month').val(),

        exp_year: $('.card-expiry-year').val()

      }, stripeResponseHandler);

    }

  



  

  });



  

  function stripeResponseHandler(status, response) {

        if (response.error) {

            $('.error')

                .removeClass('hide')

                .find('.alert')

                .text(response.error.message);

        } else {

            // token contains id, last4, and card type

            var token = response['id'];

            // insert the token into the form so it gets submitted to the server

            $form.find('input[type=text]').empty();

            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");

            $form.get(0).submit();

        }

    }



  

});



</script>

<!-- ***************************************Start the Footer************************************************ -->
@include('front.incliude.footer')
