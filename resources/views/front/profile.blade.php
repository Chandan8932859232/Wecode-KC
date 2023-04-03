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

            <li class="active"><a href="#">Profile</a></li>

        </ul>

        <h2 class="inner-banner__title">Profile</h2>

    </div>

</section>



<div class="divider-line"></div>


<section class="about-two">

    <div class="container">

        <div class="row">

        	<div class="col-xl-6 offset-3">

                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item">

                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"

                          aria-selected="true">Profile</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"

                      aria-selected="false">Change Password</a>

                    </li>  

                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="form-signup">

                            <form id="client_frm" method="post" autocomplete="off">

                                @csrf

                                <div class="form-group">

                                    <label>First Name</label>

                                    <input type="text" name="fname" class="form-control fname" placeholder="First Name" value="{{$user->fname}}">

                                </div>

                                <div class="form-group">

                                    <label>Last Name</label>

                                    <input type="text" name="lname" class="form-control lname" placeholder="Last Name" value="{{$user->lname}}">

                                </div>

                                <div class="form-group">

                                    <label>Date of birth</label>

                                    <input type="text" id="dateofbirth" name="date_of_birth" class="form-control date_of_birth" placeholder="Date of birth" value="{{$user->date_of_birth}}">

                                </div>

                                <div class="form-group">

                                    <label>Email Address <span class="email_error error"></span></label>

                                    <input type="text" name="email" class="form-control email" placeholder="Email Address" value="{{$user->email}}">

                                </div>

                                <div class="form-group">

                                    <label>Mobile No <span class="phone_error error"></span></label>

                                    <input type="text" name="phone_number" class="form-control phone_number" onkeypress="return isNumber(event)" placeholder="Mobile No" value="{{$user->phone_number}}">

                                </div>

                                

                                <div class="form-group text-center">

                                    <input type="button" name="" class="btn btn-success create_account" value="Update">

                                </div>

                                <div class="alert alert-success text-center hide"><span class="success_msg"></span></div>

                            </form>

                        </div>

                            <script>

                             $(function() {

                                

                                $("#dateofbirth").datepicker({

                                  dateFormat: 'dd-mm-yy',

                                  maxDate: 0,

                                  changeMonth: true,

                                  changeYear: true,

                                  yearRange: '1945:'+(new Date).getFullYear()

                                 });

                                

                             });

                            </script>

                            <script type="text/javascript">

                              function isNumber(evt) {

                                evt = (evt) ? evt : window.event;

                                var charCode = (evt.which) ? evt.which : evt.keyCode;

                                if (charCode > 31 && (charCode < 48 || charCode > 57)) {

                                  /*alert("Please enter only Numbers.");*/

                                  return false;

                                }



                                return true;

                              }

                            </script>

                        <script type="text/javascript">

                          $('.create_account').click(function(){

                            

                            var fname = $('.fname').val();

                            var lname = $('.lname').val();

                            var date_of_birth = $('.date_of_birth').val();

                            var email = $('.email').val();

                            var phone_number = $('.phone_number').val();

                            //var password = $('.password').val();

                            if(!fname){

                              

                              $('.fname').css('border','1px solid red');

                            }else if(!lname){

                              

                              $('.fname').css('border','');

                              $('.lname').css('border','1px solid red');

                            }else if(!date_of_birth){

                              

                              $('.fname').css('border','');

                              $('.lname').css('border','');

                              $('.date_of_birth').css('border','1px solid red');

                            }else if(!email){

                             

                              $('.fname').css('border','');

                              $('.lname').css('border','');

                              $('.date_of_birth').css('border','');

                              

                              $('.email').css('border','1px solid red');

                            }else if(!$('.email').val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){

                              

                              $('.fname').css('border','');

                              $('.lname').css('border','');

                              $('.date_of_birth').css('border','');

                              

                              $('.email').css('border','1px solid red');

                              $('.email_error').text('Please Enter valid email');

                            }else if(!phone_number){

                              

                              $('.fname').css('border','');

                              $('.lname').css('border','');

                              $('.date_of_birth').css('border','');

                              

                              $('.email').css('border','');

                              $('.email_error').text('');

                              $('.phone_number').css('border','1px solid red');

                            }else if(!$('.phone_number').val().match(/^\d{11}$/)){

                              

                              $('.fname').css('border','');

                              $('.lname').css('border','');

                              $('.date_of_birth').css('border','');

                              

                              $('.email').css('border','');

                              $('.email_error').text('');

                              $('.phone_number').css('border','1px solid red');

                              $('.phone_error').text('Invalid number, must be 11 digits');

                            }else{

                             

                              $('.fname').css('border','');

                              $('.lname').css('border','');

                              $('.date_of_birth').css('border','');

                              

                              $('.email').css('border','');

                              $('.phone_number').css('border','');

                              /*$('.password').css('border','');*/

                              $('.email_error').text('');

                              $('.phone_error').text('');

                              $.ajax({

                                type : 'POST',

                                url  : "{{url('/profile_edit')}}",

                                data :new FormData( $("#client_frm")[0] ),

                                async : false,

                                cache : false,

                                contentType : false,

                                processData : false,

                                success: function(data) 

                                {

                                  if($.trim(data)=="done"){

                                    $(".success_msg").text("Successfully Updated");

                                      $(".alert-success").show('slow' , 'linear').delay(4000).fadeOut(function(){

                                      //window.location.href="{{url('/')}}";

                                      location.reload();

                                    });

                                  }

                                  if($.trim(data)=="email_error"){

                                    $('.email_error').text("Sorry! Email already exist!");

                                  }

                                }



                              });

                            }

                          });

                        </script>

                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="form-signup">

                        <form id="pass_frm" method="post" autocomplete="off">

                            @csrf

                            

                            <div class="form-group">

                                <label>Old Password <span class="old_pass_err error"></span></label>

                                <input type="password" name="old_password" class="form-control old_password" placeholder="Old Password">

                            </div>

                            <div class="form-group">

                                <label>New Password</label>

                                <input type="password" name="password" class="form-control password" placeholder="New Password">

                            </div>

                            <div class="form-group">

                                <label>Confirm Password <span class="cnfpassword_text error"></span></label>

                                <input type="password" name="cnfpassword" class="form-control cnfpassword" placeholder="Confirm Password">

                            </div>

                            <div class="form-group text-center">

                                <input type="button" name="" class="btn btn-success change_password" value="Change Password">

                            </div>

                            <div class="alert alert-success text-center hide"><span class="success_msg_change"></span></div>

                        </form>

                    </div>

                    <script type="text/javascript">

                        $('.change_password').click(function(){

                            var password = $('.password').val();

                            var cnfpassword = $('.cnfpassword').val();

                            var old_password = $('.old_password').val();

                            if(!old_password){

                                $('.old_password').css('border','1px solid red');

                            }else if(!password){

                                $('.password').css('border','1px solid red');

                                $('.old_password').css('border','');

                            }else if(!cnfpassword){

                                $('.old_password').css('border','');

                                $('.password').css('border','');

                                $('.cnfpassword').css('border','1px solid red');

                            }else if(cnfpassword !=password){

                                $('.old_password').css('border','');

                                $('.password').css('border','');

                                $('.cnfpassword').css('border','1px solid red');

                                $('.cnfpassword_text').text('Password does not match');

                            }else{

                                $('.password').css('border','');

                                $('.old_password').css('border','');

                                $('.cnfpassword').css('border','');

                                $('.cnfpassword_text').text('');

                                $.ajax({

                                    type : 'POST',

                                url  : "{{url('/change_password')}}",

                                data :new FormData( $("#pass_frm")[0] ),

                                async : false,

                                cache : false,

                                contentType : false,

                                processData : false,

                                success: function(data) 

                                {

                                  if($.trim(data)=="done"){

                                    $(".success_msg_change").text("Successfully Changed");

                                      $(".alert-success").show('slow' , 'linear').delay(4000).fadeOut(function(){

                                      //window.location.href="{{url('/')}}";

                                      location.reload();

                                    });

                                  }

                                  if($.trim(data)=="email_error"){

                                    $('.old_pass_err').text("Sorry! Please enter correct old password");

                                  }

                                }

                                });



                            }

                        });

                    </script>

  </div>

  

</div>

        		

        	</div>

        	

        </div>

    </div>

</section>



<!-- ***************************************Start the Footer************************************************ -->

@include('front.incliude.footer')

