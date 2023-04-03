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

    .form-signup {
        border: 1px solid #8e8585;
        padding: 27px;
    }
</style>

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="active"><a href="#">Signup</a></li>
        </ul>
        <h2 class="inner-banner__title">Signup</h2>
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
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control fname" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control lname" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label>Date of birth</label>
                            <input type="text" id="dateofbirth" name="date_of_birth"
                                class="form-control date_of_birth" placeholder="Date of birth">
                        </div>
                        <div class="form-group">
                            <label>Email Address <span class="email_error error"></span></label>
                            <input type="text" name="email" class="form-control email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label>Mobile No <span class="phone_error error"></span></label>
                            <input type="text" name="phone_number" class="form-control phone_number"
                                onkeypress="return isNumber(event)" placeholder="Mobile No">
                        </div>
                        <div class="form-group">
                            <label>Choose a password</label>
                            <input type="password" name="password" class="form-control password" placeholder="Password">
                        </div>
                        <div class="form-group">

                            <input type="checkbox" id="vehicle1" name="subscription" value="1">
                            <label for="vehicle1"> I agree to receive instructional and promotional emails</label>

                        </div>
                        <div class="form-group">

                            <input type="checkbox" class="agreement" id="vehicle2" name="terms" value="1">
                            <label for="vehicle2"> I agree to Teachable's <a href="{{ url('/terms') }}">Terms of Use</a>
                                & <a href="{{ url('/privacy_policy') }}">Privacy Policy</a></label><br>
                            <span class="checkbox_error error"></span>

                        </div>
                        <div class="form-group text-center" >
                            <input type="button" name="" class="btn btn-success create_account"
                                value="Register" >
                        </div>
                        <div class="alert alert-success text-center hide"><span class="success_msg"></span></div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    $(function() {

        $("#dateofbirth").datepicker({
            dateFormat: 'dd-mm-yy',
            maxDate: 0,
            changeMonth: true,
            changeYear: true,
            yearRange: '1945:' + (new Date).getFullYear()
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
    $('.create_account').click(function() {

        var fname = $('.fname').val();
        var lname = $('.lname').val();
        var date_of_birth = $('.date_of_birth').val();
        var email = $('.email').val();
        var phone_number = $('.phone_number').val();
        var password = $('.password').val();
        if (!fname) {

            $('.fname').css('border', '1px solid red');
        } else if (!lname) {

            $('.fname').css('border', '');
            $('.lname').css('border', '1px solid red');
        } else if (!date_of_birth) {

            $('.fname').css('border', '');
            $('.lname').css('border', '');
            $('.date_of_birth').css('border', '1px solid red');
        } else if (!email) {

            $('.fname').css('border', '');
            $('.lname').css('border', '');
            $('.date_of_birth').css('border', '');

            $('.email').css('border', '1px solid red');
        } else if (!$('.email').val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {

            $('.fname').css('border', '');
            $('.lname').css('border', '');
            $('.date_of_birth').css('border', '');

            $('.email').css('border', '1px solid red');
            $('.email_error').text('Please enter valid email');
        } else if (!phone_number) {

            $('.fname').css('border', '');
            $('.lname').css('border', '');
            $('.date_of_birth').css('border', '');

            $('.email').css('border', '');
            $('.email_error').text('');
            $('.phone_number').css('border', '1px solid red');
        } else if (!$('.phone_number').val().match(/^\d{11}$/)) {

            $('.fname').css('border', '');
            $('.lname').css('border', '');
            $('.date_of_birth').css('border', '');

            $('.email').css('border', '');
            $('.email_error').text('');
            $('.phone_number').css('border', '1px solid red');
            $('.phone_error').text('Invalid number, must be 11 digits');
        } else if (!password) {

            $('.fname').css('border', '');
            $('.lname').css('border', '');
            $('.date_of_birth').css('border', '');

            $('.email').css('border', '');
            $('.phone_number').css('border', '');
            $('.email_error').text('');
            $('.phone_error').text('');
            $('.password').css('border', '1px solid red');
        } else if ($('input[name="terms"]').prop("checked") == false) {
            $('.fname').css('border', '');
            $('.lname').css('border', '');
            $('.date_of_birth').css('border', '');

            $('.email').css('border', '');
            $('.phone_number').css('border', '');
            $('.email_error').text('');
            $('.phone_error').text('');
            $('.password').css('border', '');
            $('.checkbox_error').text('Please indicate that you accept the Terms and Conditions');

        }
        else {

            $('.fname').css('border', '');
            $('.lname').css('border', '');
            $('.date_of_birth').css('border', '');

            $('.email').css('border', '');
            $('.phone_number').css('border', '');
            $('.password').css('border', '');
            $('.email_error').text('');
            $('.phone_error').text('');
            $('.checkbox_error').text('');
            $.ajax({
                type: 'POST',
                url: "{{ url('home/registration') }}",
                data: new FormData($("#client_frm")[0]),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if ($.trim(data) == "done") {
                        $(".success_msg").text("Successfully registered.Please verify your email");
                        $(".alert-success").show('slow', 'linear').delay(4000).fadeOut(function() {
                            window.location.href ="<?=url('/')?>";
                        });
                    }
                    if ($.trim(data) == "email_error") {
                        $('.email_error').text("Sorry! Email already exist!");
                    }

                }

            });
        }
    });
</script>











<!-- ***************************************Start the Footer************************************************ -->
@include('front.incliude.footer')
