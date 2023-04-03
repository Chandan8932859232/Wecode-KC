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
            <li class="active"><a href="#">Reset Password</a></li>
        </ul>
        <h2 class="inner-banner__title">Reset Password</h2>
    </div>
</section>



<section class="about-two">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-3 wow fadeInDown" data-wow-duration="2s" data-wow-delay=".5s">
                        <div class="form-signup">
                        <form id="client_frm" method="post" autocomplete="off">
                            @csrf
                            
                            <div class="form-group">
                                <label for="bfname"><b>New Password <span>*</span></b></label>
                                <input type="password" placeholder="New Password" class="form-control password" name="password" value="" autocomplete="off" onkeypress="return runScript(event)" required>
                            </div>
                            <div class="form-group">
                                <label for="bfname"><b>Confirm Password <span>*</span></b></label>
                                <input type="password" placeholder="Confirm Password" class="form-control cnf_pass" name="cnf_pass" value="" autocomplete="off" onkeypress="return runScript(event)" required>
                            </div>
                            
                            
                            <div class="form-group text-center">
                              <input type="hidden" name="email" value="<?=$email?>">
                              <input type="hidden" name="hash_key" value="<?=$hash_key?>">
                                <input type="button" name="" class="btn btn-success forgot submit_address" onkeypress="return runScript(event)" value="Submit">
                                
                            </div>
                            <div class="alert alert-success text-center hide"><span class="success_msg"></span></div>
                        </form>
                    </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <script type="text/javascript">
            $('.submit_address').click(function(){
              var password = $('.password').val();
              var cnf_pass = $('.cnf_pass').val();

              if(!password){
                $('.password').css('border','1px solid red');
              }else if(!cnf_pass){
                $('.password').css('border','');                
                $('.cnf_pass').css('border','1px solid red');
              }else if(cnf_pass!=password){
               $('.password').css('border','');                
                $('.cnf_pass').css('border','1px solid red');
              }else{
                $('.password').css('border','');                
                $('.cnf_pass').css('border','');
                
                $.ajax({
                  type:'POST',
                  url:"{{url('/resetpassword')}}",
                  data :new FormData( $("#client_frm")[0] ),
                  async : false,
                  cache : false,
                  contentType : false,
                  processData : false,
                  success: function(data) 
                  {
                    console.log(data);
                    if($.trim(data)=="done"){
                      //location.reload();
                      $('.hide').css('display','block');
                      $('.success_msg').text('Password Changed Successfully');
                      $(".alert-success").show('slow' , 'linear').delay(4000).fadeOut(function(){
                        window.location.href="{{url('/')}}";
                      });
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
                    var password = $('.password').val();
                    var cnf_pass = $('.cnf_pass').val();

                    if(!password){
                      $('.password').css('border','1px solid red');
                    }else if(!cnf_pass){
                      $('.password').css('border','');                
                      $('.cnf_pass').css('border','1px solid red');
                    }else if(cnf_pass!=password){
                     $('.password').css('border','');                
                      $('.cnf_pass').css('border','1px solid red');
                    }else{
                      $('.password').css('border','');                
                      $('.cnf_pass').css('border','');
                      
                      $.ajax({
                        type:'POST',
                        url:"{{url('/resetpassword')}}",
                        data :new FormData( $("#client_frm")[0] ),
                        async : false,
                        cache : false,
                        contentType : false,
                        processData : false,
                        success: function(data) 
                        {
                          console.log(data);
                          if($.trim(data)=="done"){
                            //location.reload();
                            $('.hide').css('display','block');
                            $('.success_msg').text('Password Changed Successfully');
                            $(".alert-success").show('slow' , 'linear').delay(4000).fadeOut(function(){
                              window.location.href="{{url('/')}}";
                            });
                          }
                        }
                      });
                    }  
                      
                  }
              }
          </script>

        


       









<!-- ***************************************Start the Footer************************************************ -->
@include('front.incliude.footer')






