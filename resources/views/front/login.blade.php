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
            <li class="active"><a href="#">Login</a></li>
        </ul>
        <h2 class="inner-banner__title">Login</h2>
    </div>
</section>



<section class="about-two">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-3 wow fadeInDown" data-wow-duration="2s" data-wow-delay=".5s">
                        <div class="form-signup">
                            <div class="alert alert-danger text-center hide"><span class="login_error"></span></div>
                        <form id="client_frm" method="post" autocomplete="off">
                            @csrf
                            
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="username" class="form-control username" onkeypress="return runScript(event)" placeholder="Email Address">
                            </div>
                            
                            <div class="form-group">
                                <label>Password</label><span class="pull-right"><a href="{{url('/forgot_password')}}" >Forgot Password?</a></span>
                                <input type="password" name="password" class="form-control password" onkeypress="return runScript(event)" placeholder="Password">
                            </div>
                            <div class="form-group text-center">
                                <input type="button" name="" class="btn btn-success user_login" onkeypress="return runScript(event)" value="Login">
                                <span class="pull-right"><a href="{{url('/create_account')}}">Register</a></span>
                            </div>
                            <!-- <div class="alert alert-success text-center hide"><span class="success_msg"></span></div> -->
                        </form>
                    </div>
                    </div>
                    
                </div>
            </div>
        </section>
        
<script type="text/javascript">
    $('.user_login').click(function(){
        var username = $('.username').val();
        var password = $('.password').val();
        var token = "<?php echo csrf_token(); ?>";
        if(!username){
            $('.username').css('border','1px solid red');
        }else if(!password){
            $('.username').css('border','');
            $('.password').css('border','1px solid red');
        }else{
            $('.username').css('border','');
            $('.password').css('border','');
            $.ajax({
                type:'Post',
                url:"{{url('home/user_login')}}",
                data:{username:username,password:password,_token:token},
                success:function(data){
                    //alert(data);
                    if($.trim(data)=='done'){
                        window.location.href="{{url('/')}}";
                    }

                    if($.trim(data)=='error'){
                        $('.hide').css('display','block');
                        $('.login_error').text("Login Failed!");
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
            var username = $('.username').val();
            var password = $('.password').val();
            var token = "<?php echo csrf_token(); ?>";
            if(!username){
                $('.username').css('border','1px solid red');
            }else if(!password){
                $('.username').css('border','');
                $('.password').css('border','1px solid red');
            }else{
                $('.username').css('border','');
                $('.password').css('border','');
                $.ajax({
                    type:'Post',
                    url:"{{url('home/user_login')}}",
                    data:{username:username,password:password,_token:token},
                    success:function(data){
                        //alert(data);
                        if($.trim(data)=='done'){
                            window.location.href="{{url('/')}}";
                        }

                        if($.trim(data)=='error'){
                            $('.hide').css('display','block');
                            $('.login_error').text("Login Failed!");
                        }
                    }

                });
            }
            
        }
    }
</script>

       









<!-- ***************************************Start the Footer************************************************ -->
@include('front.incliude.footer')
