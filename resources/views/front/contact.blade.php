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

    .total-amount {
        font-size: 20px;
        font-weight: 600;
    }

    .price-total {
        font-size: 20px;
        font-weight: 600;
    }

    .contact-details p {
        font-size: 20px;
        /* padding: 33px; */
        /*padding-left: 43px;*/
        color: gray;
    }

    .contact-details a {
        font-size: 20px;
        /* padding: 33px; */
        /* padding-left: 43px;*/
        color: gray;
    }

    .social-links-contact ul {
        list-style: none;
        display: flex;
        /* margin-right: -67px; */
        padding: 0;
    }

    .social-links-contact ul li {
        padding-right: 15px
    }

    .contacts-info {
        padding-left: 50px
    }
</style>

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="active"><a href="#">Contact</a></li>
        </ul>
        <h2 class="inner-banner__title">Contact</h2>
    </div>
</section>



<div class="divider-line"></div>

<section class="about-two">
    <div class="container">
        <div class="row">
            <div class="col-xl-7">
                <h3>Get in touch</h3>
                <form id="form" method="post" name="form" action="contact_insert">
                    <input type="hidden" class="token" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Your Name" name="u_name"
                                    class="form-control u_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" placeholder="Email Address" name="u_email"
                                    class="form-control u_email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" placeholder="Subject" name="u_subject"
                                    class="form-control u_subject">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="number" placeholder="Phone Number" name="phone_no"
                                    class="form-control phone_no">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea placeholder="Write here your message" name="message" class="form-control message" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-contact-field">
                                <button type="button" class="btn btn-success contact_mail"><i
                                        class="fa fa-paper-plane"></i> Send Message</button>
                            </div>
                        </div>

                    </div>
                    <div class="alert alert-success text-center hide"><span class="msg_success"></span></div>
                </form>


                <script type="text/javascript">
                    $('.contact_mail').click(function() {

                                    var u_name = $('.u_name').val();
                                    var u_email = $('.u_email').val();
                                    var u_subject = $('.u_subject').val();
                                    var message = $('.message').val();


                                    if (!u_name) {
                                        $('.u_name').css('border', '1px solid red');
                                    } else if (!u_email) {
                                        $('.u_name').css('border', '');
                                        $('.u_email').css('border', '1px solid red');
                                    } else if (!$('.u_email').val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
                                        $('.u_name').css('border', '');
                                        $('.u_email').css('border', '1px solid red');
                                    } else if (!u_subject) {
                                        $('.u_name').css('border', '');
                                        $('.u_email').css('border', '');
                                        $('.u_subject').css('border', '1px solid red');
                                    } else if (!message) {
                                        $('.u_name').css('border', '');
                                        $('.u_email').css('border', '');
                                        $('.u_subject').css('border', '');
                                        $('.message').css('border', '1px solid red');
                                    } else {
                                        $('.u_name').css('border', '');
                                        $('.u_email').css('border', '');
                                        $('.u_subject').css('border', '');
                                        $('.message').css('border', '');
                                        $.ajax({
                                            type: 'POST',
                                            url: "{{ url('home/insert_contact') }}",
                                            data: new FormData($("#form")[0]),
                                            async: false,
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function(data) {
                                                console.log(data);
                                                if ($.trim(data) == "done") {

                                                    $('.msg_success').text("Thank You!");
                                                    $(".alert-success").show('slow', 'linear').delay(4000).fadeOut(
                                                        function() {
                                                            window.location.href = "<?= url('/') ?>";


                                                        });

                                                }

                                            }

                                        });
                                    }
                                });
                </script>
            </div>
            <div class="col-xl-4 contacts-info">
                <h3>Contact information</h3>
                <div class="contact-details">
                    <p><i class="fa fa-map-marker"></i> {{ $contact->address }}</p>
                    <div class="single-contact-btn">
                        <h4>Email Us</h4>
                        <a href="mailto:{{ $contact->email }}"><i class="fa fa-envelope"> </i> {{ $contact->email }}</a>
                    </div>
                    <div class="single-contact-btn">
                        <h4>Call Us</h4>
                        <a href="tel:{{ $contact->phone_no }}"><i class="fa fa-phone"></i> {{ $contact->phone_no }}</a>
                    </div>
                    <div class="social-links-contact">
                        <h4>Follow Us:</h4>
                        <ul>
                            <li><a href="{{url($contact->facebook)}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{url($contact->twitter)}}" data-toggle="_blank" data-placement="bottom" title="twitter!"><i
                                class="fa fa-twitter"></i></a></li>
                            <li><a href="{{url($contact->youtube)}}" target="_blank"><i class="fa fa-youtube"></i></a></li>

                            <li><a href="{{url($contact->instagram)}}"><i class="fa fa-instagram" target="_blank"></i></a></li>
                            <!-- <li><a href="#"><i class="fa fa-linkedin"></i></a></li> -->

                            <li><a href="{{url($contact->linkedin)}}" data-toggle="tooltip" data-placement="bottom" title="linkedin!"><i
                                class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="map-info">
    <div class="map-contacts-info">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d396368.68565794016!2d-94.85591314251239!3d39.092116709321544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87c0f75eafe99997%3A0x558525e66aaa51a2!2sKansas%20City%2C%20MO%2C%20USA!5e0!3m2!1sen!2sin!4v1587744390969!5m2!1sen!2sin"
            width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
            tabindex="0"></iframe>
    </div>
</section>













<!-- ***************************************Start the Footer************************************************ -->
@include('front.incliude.footer')
