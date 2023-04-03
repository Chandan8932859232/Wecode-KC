<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Online Courses | {{ $title }}</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,500i,600,700,800%7CSatisfy&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front') }}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front') }}/css/custom.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front') }}/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front') }}/css/animate.css">
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <style type="text/css">
        .hide {
            display: none;
        }

        .error {
            color: red;
        }

        .user_log ul li a {
            color: #59524b !important;
        }

        sub,
        sup {
            position: relative;
            font-size: 100%;
            line-height: 0;
            vertical-align: baseline;
            color: #f56b02;
            font-weight: 700;
        }

        .inner-banner__title {
            margin: 0;
            text-transform: uppercase;
            font-size: 70px;
            font-weight: 700;
            letter-spacing: -0.04em;
            color: #fff;
            margin-top: 5px;
            margin-bottom: -18px;
        }
    </style>

</head>

<body>
<?php $contact = DB::table('tbl_contact')->where(['id'=>1])->first(); ?>
    <header>
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="left-social-top">
                            <ul class="nav top-social-media">
                                <li><a href="{{url($contact->facebook)}}" data-toggle="_blank" data-toggle="tooltip" data-placement="bottom" title="facebook!"  target="_blank"><i
                                            class="fa fa-facebook"></i></a></li>

                                <li><a href="{{url($contact->twitter)}}" data-toggle="tooltip" data-placement="bottom" title="twitter!"  target="_blank"><i
                                            class="fa fa-twitter" data-toggle="_blank"></i></a></li>

                                            <li><a href="{{url($contact->youtube)}}" target="_blank"><i class="fa fa-youtube" data-toggle="tooltip" data-placement="bottom" title="youtube!" data-toggle="_blank" >
                                                </i></a></li>


                                <li><a href="{{url($contact->instagram)}}" data-toggle="tooltip" data-placement="bottom"
                                        title="instagram!"  target="_blank"><i class="fa fa-instagram" data-toggle="_blank"></i></a></li>
                                <li><a href="{{url($contact->linkedin)}}" data-toggle="tooltip" data-placement="bottom" title="linkedin!"  target="_blank"><i
                                            class="fa fa-linkedin" data-toggle="_blank"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8  col-sm-6">
                        <div class="right-top-request">
                            <ul class="nav">
                                <?php if(session('drphllip_user_id')==''){ ?>
                                <li><a href="{{ url('/login') }}">Login</a></li>
                                <li><a href="{{ url('/create_account') }}">SignUp</a></li>
                                <?php }else{
                    $user = DB::table('tbl_user')->where(['id'=>session('drphllip_user_id')])->first();
                    $cart_count = DB::table('tbl_cart')->where(['user_id'=>session('drphllip_user_id')])->count();
                 ?>
                                <li><a href="{{ url('/cart_list') }}"><i
                                            class="fa fa-shopping-cart"></i><sup>{{ $cart_count }}</sup></a></li>
                                <li>
                                    <div class="dropdown user_log">
                                        <a href="#" class="dropdown-toggle user_log_click"
                                            data-toggle="dropdown">{{ $user->fname . ' ' . $user->lname }}
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ url('/profile') }}"><i class="fa fa-user"></i> My
                                                    Profile</a></li>
                                            <li><a href="{{ url('/my_order') }}"><i class="fa fa-list"></i> My
                                                    Orders</a></li>
                                            <li><a href="{{ url('/my_order?course=' . base64_encode('1')) }}"><i
                                                        class="fa fa-book"></i> My Courses</a></li>
                                            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>
                                                    Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <?php } ?>
                                <script type="text/javascript">
                                    $('.user_log_click').click(function() {
                                        $('.dropdown-menu').toggle();
                                    });
                                </script>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nab-bg-color">
            <div class="container">
                <nav class="navbar navbar-expand-md ">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{-- <h2>Dr.Philip<strong>Hickman</strong></h2><!-- <img src="images/logo.png"> --> --}}
                        <img src="{{ url('public/images_logo/logo_main2.jpg') }}" alt="logo"
                            style="width:210px ; height:56px">


                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarsExampleDefault" style="margin-right:22%">
                        <ul class="navbar-nav ml-auto navigation">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/') }}">Home <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/about') }}">About Us</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/course') }}">Courses</a>
                                <!-- <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Courses</a> -->
                                <!-- <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>

        </div> -->
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/blog') }}">Blog</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ url('/contact') }}">Contact Us</a>
                            </li>
                        </ul>

{{--
                        <form class="form-inline my-2 my-lg-0" action="#!">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                        </form> --}}



                        <!-- <div class="right-side-box">
          <a class="header__search-btn search-popup__toggler" href="#"><i class="kipso-icon-magnifying-glass"></i></a>
      </div> -->
                    </div>
                </nav>

            </div>
        </div>
        <!-- <div class="container-fluid">
  <div class="row">
  <div class="col-md-4">
    <span class="color-first"></span>
  </div>
  <div class="col-md-4">
    <span class="color-secend"></span>
  </div>
  <div class="col-md-4">
    <span class="color-third"></span>
  </div>
 </div>
</div> -->
        <!-- modal -->

        <div id="myModaladdcart" class="modal fade" role="dialog">

            <div class="modal-dialog">



                <!-- Modal content-->

                <div class="modal-content">

                    <div class="modal-header">



                        <h4 class="modal-title">Added to cart successfully!</h4>



                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary" onclick="location.reload()">OK</button>

                    </div>





                </div>



            </div>

        </div>

        <!-- modal -->
        <!-- modal -->

        <div id="myModaldeletecart" class="modal fade" role="dialog">

            <div class="modal-dialog">



                <!-- Modal content-->

                <div class="modal-content">

                    <div class="modal-header">



                        <h4 class="modal-title">Item deleted successfully!</h4>



                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary" onclick="location.reload()">OK</button>

                    </div>





                </div>



            </div>

        </div>

        <!-- modal -->
    </header>
