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
</style>



<section class="inner-banner">

    <div class="container">

        <ul class="list-unstyled thm-breadcrumb">

            <li><a href="{{ url('/') }}">Home</a></li>

            <li class="active"><a href="#">Course</a></li>

        </ul>

        <h2 class="inner-banner__title">Course</h2>

    </div>

</section>




<div class="divider-line"></div>


<section class="about-two">

    <div class="container">

        <div class="row">

            <!-- <div class="col-xl-12  wow fadeInDown" data-wow-duration="2s" data-wow-delay=".5s"> -->

            <?php $user_id = session('drphllip_user_id'); foreach($course as $value){

                        $instructor = DB::table('tbl_instructor')->where(['id'=>$value->instructor_id])->first();

                        $lecture_count = DB::table('tbl_curriculum')->where(['course_id'=>$value->id,'status'=>1])->count();

                         $purchase = DB::table('tbl_order')->where(['user_id'=>$user_id,'course_id'=>$value->id])->count();



                      ?>

            <div class="col-lg-4">

                <div class="course-one__single">

                    <div class="course-one__image" style="margin-bottom: -25px">

                        <img src="{{ url('public/upload/course_image/' . $value->image) }}" alt="">



                    </div>

                    <div class="course-one__content">

                        <!-- <a href="#" class="course-one__category">development</a> -->



                        <div class="course-one__admin " style="margin-top: -41px">

                            <img src="{{ url('public/upload/instructor_image/' . $instructor->image) }}" alt="">

                            by <a href="#">{{ $instructor->name }}</a>


                        </div>






                        <h2 class="course-one__title"><a
                                href="{{ url('/course_details?key=' . base64_encode($value->id)) }}">{{ $value->course_title }}</a>
                        </h2>





                        <div class="course-one__meta" style="margin-top: -12px">


                            {{-- <a href="#!"><i class="fa fa-folder-open"></i> <?= $lecture_count ?> Lectures</a> --}}

                            <a href="#!"><i class="fa fa-folder-open"></i>{{ $value->class_level }} </a>



                            <a href="#!">${{ $value->price }}</a>
                        </div>

                        <div class="course-one__meta"><a href="#!">{{ $value->tools }}</a>


                            <a href="#!" ><i class="fa-regular fa-clock"></i>{{ $value->class_duration }}</a>
                        </div>


                        <?php if($purchase==0){?>

                        <?php if(session('drphllip_user_id')==''){ ?>

                        <a href="{{ url('/create_account') }}" class="course-one__link" style="margin-bottom: -15px;">Enroll Now</a>



                        <?php }else{

                                    $user_id = session('drphllip_user_id');

                                    $check = DB::table('tbl_cart')->where(['user_id'=>$user_id,'course_id'=>$value->id])->count();

                                    if($check=='0'){

                                    ?>

                        <a class="course-one__link" data-id="{{ $value->id }}" data-price="{{ $value->price }}"
                            onclick="add_cart(this)">Add to cart</a>

                        <?php }else{ ?>

                        <a class="course-one__link" data-id="{{ $value->id }}"
                            data-price="{{ $value->price }}">Added to cart</a>

                        <?php } } }else{ ?>

                        <a class="course-one__link"
                            href="{{ url('/course_details?key=' . base64_encode($value->id)) }}">Purchased</a>

                        <?php } ?>

                    </div>

                </div>

            </div>

            <?php } ?>

            <script type="text/javascript">
                function add_cart(th) {

                    var course_id = $(th).data('id');

                    var price = $(th).data('price');

                    var token = "<?php echo csrf_token(); ?>";

                    $.ajax({

                        type: 'Post',

                        url: "{{ url('home/add_to_cart') }}",

                        data: {
                            course_id: course_id,
                            price: price,
                            _token: token
                        },

                        success: function(data) {

                            //alert(data);

                            if ($.trim(data) == 'done') {

                                $('#myModaladdcart').modal('show');

                            }



                        }

                    });





                }
            </script>

            <!-- </div> -->



        </div>

    </div>

</section>



























<!-- ***************************************Start the Footer************************************************ -->

@include('front.incliude.footer')
