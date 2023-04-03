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
            <li class="active"><a href="#">Forgot Password</a></li>
        </ul>
        <h2 class="inner-banner__title">Forgot Password</h2>
    </div>
</section>



<section class="about-two">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-3 wow fadeInDown">
                        <div class="form-signup">
                        <form id="client_frm" method="post" action="{{url('home/userforgotpassword')}}" onsubmit="return myFunction()" autocomplete="off">
                            @csrf
                            
                            <div class="form-group">
                                <label>Email <span class="email_error error"> @if ($errmessage = Session::get('error')){!! $errmessage !!}<?php Session::forget('error');?>
                            @endif</span></label>
                                <input type="text" name="email" class="form-control email" placeholder="Email Address" value="@if ($emailerr = Session::get('emailerr')){!! $emailerr !!}<?php Session::forget('emailerr');?>
                            @endif">
                            </div>
                            
                            
                            <div class="form-group text-center">
                                <input type="submit" name="" class="btn btn-success forgot" value="Submit">
                                
                            </div>
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success text-center"><span class="success_msg">{!! $message !!}</span></div>
                           
                            <?php Session::forget('success');?>
                            @endif
                            <!-- <div class="alert alert-success text-center hide"><span class="success_msg"></span></div> -->
                        </form>
                    </div>
                    </div>
                    
                </div>
            </div>
        </section>

        <script type="text/javascript">
            function myFunction(){
                var email = $('.email').val();
                if(!email){
                    $('.email').css('border','1px solid red');
                    return false;
                }else if(!$('.email').val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){
                    $('.email').css('border','1px solid red');
                    $('.email_error').text('Please enter valid email');
                    return false;
                }else{
                    return true;
                }
            }
            
        </script>
        <script type="text/javascript">
            $(".alert-success").show('slow' , 'linear').delay(4000).fadeOut(function(){
                window.location.href="{{url('/login')}}";
            });
        </script>
        
<!-- <script type="text/javascript">
    $('.forgot').click(function(){
        var email = $('.email').val();
        var token = "<?php echo csrf_token(); ?>";
        if(!email){
            $('.email').css('border','1px solid red');
        }else if(!$('.email').val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){
            $('.email').css('border','1px solid red');
            $('.email_error').text('Please enter valid email');
        }else{
            $('.email').css('border','');
            $('.email_error').text('');
            $.ajax({
                type:'Post',
                url:"{{url('home/userforgotpassword')}}",
                data:{email:email,_token:token},
                success:function(data){
                    //alert(data);
                    if($.trim(data)=='done'){
                        //window.location.href="{{url('/login')}}";
                        $('.success_msg').text('Email sent successfully.Please check your mail.');
                        $(".alert-success").show('slow' , 'linear').delay(4000).fadeOut(function(){
                            window.location.href="{{url('/login')}}";
                        });
                    }
                    if($.trim(data)=="email_error"){
                        $('.email_error').text('This email is not registerd with us.');
                    }

                    
                }

            });
        }
    });
</script>
<script type="text/javascript">
    function runScript(e) {
        //See notes about 'which' and 'key'
        if(e.keyCode == 13) {
            var email = $('.email').val();
            var token = "<?php echo csrf_token(); ?>";
            if(!email){
                $('.email').css('border','1px solid red');
            }else if(!$('.email').val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){
                $('.email').css('border','1px solid red');
                $('.email_error').text('Please enter valid email');
            }else{
                $('.email').css('border','');
                $('.email_error').text('');
                $.ajax({
                    type:'Post',
                    url:"{{url('home/userforgotpassword')}}",
                    data:{email:email,_token:token},
                    success:function(data){
                        //alert(data);
                        if($.trim(data)=='done'){
                            //window.location.href="{{url('/login')}}";
                            $('.success_msg').text('Email sent successfully.Please check your mail.');
                            $(".alert-success").show('slow' , 'linear').delay(4000).fadeOut(function(){
                                window.location.href="{{url('/login')}}";
                            });
                        }
                        if($.trim(data)=="email_error"){
                            $('.email_error').text('This email is not registerd with us.');
                        }

                        
                    }

                });
            } 
            
        }
    }
</script> -->

       









<!-- ***************************************Start the Footer************************************************ -->
@include('front.incliude.footer')
