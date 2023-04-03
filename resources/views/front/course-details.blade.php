@include('front.incliude.header')
<style type="text/css">
    .disable_btn {
        background: #a5a3a1;
    }

    .btn_click {
        cursor: pointer;
    }

    .block-title__title {

        font-size: 43px;

    }
</style>

<section class="inner-banner">
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li class="active"><a href="#">Course details</a></li>
        </ul>
        <h2 class="inner-banner__title">Course Details</h2>
    </div>
</section>


<!-- ***************************************Start the course Details************************************************ -->
<section class="course-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="course-details__content">
                    <p class="course-details__author">
                        <img src="{{ url('public/upload/instructor_image/' . $instructor->image) }}" alt="">
                        by <a href="#content">{{ $instructor->name }}</a>
                    </p>

                    <div class="course-details__top">
                        <div class="course-details__top-left">
                            <h2 class="course-details__title">{{ $course->course_title }}</h2>

                            <!-- <div class="course-one__stars">
                                        <span class="course-one__stars-wrap">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <span class="course-one__count">4.8</span>
                                        <span class="course-one__stars-count">250</span>
                                    </div> -->
                        </div>
                        <!-- <div class="course-details__top-right">
                                    <a href="#" class="course-one__category">marketing</a>
                                </div> -->
                    </div>
                    <div class="course-one__image">
                        <img src="{{ url('public/upload/course_image/' . $course->image) }}" alt="">
                        <i class="far fa-heart"></i>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="course-details__price">
                    <p class="course-details__price-text">Course price </p>
                    <p class="course-details__price-amount">${{ $course->price }}</p>
                    <?php if($purchase==0){ ?>
                    <?php if(session('drphllip_user_id')==''){ ?>
                    <a href="{{ url('/login') }}" class="thm-btn course-details__price-btn">Buy This Course</a>
                    <?php }else{ ?>
                    <a class="thm-btn course-details__price-btn btn_click" data-id="{{ $course->id }}"
                        data-price="{{ $course->price }}" onclick="add_cart(this)">Buy This Course</a>
                    <?php } } ?>
                </div>

                <div class="course-details__meta">
                    <!-- <a href="#" class="course-details__meta-link">
                                <span class="course-details__meta-icon">
                                    <i class="far fa-clock"></i>
                                </span>
                                Durations: <span>10 hours</span>
                            </a> -->
                    <a href="#" class="course-details__meta-link">
                        <span class="course-details__meta-icon">
                            <i class="far fa-folder-open"></i>
                        </span>
                        Lectures: <span>{{ $lecture_count }}</span>
                    </a>

                    <!-- <a href="#" class="course-details__meta-link">
                                <span class="course-details__meta-icon">
                                    <i class="far fa-user-circle"></i>
                                </span>
                                Students: <span>Max 4</span>
                            </a> -->

                </div>

            </div><!-- /.col-lg-4 -->






            <div class="course-details__meta col-lg-12">
                <h2>Description</h2>
                <p>{{ strip_tags($course->description) }}</p>


                <div class="col-lg-6">
                    <h2>Achivement</h2>
                    <p>{{ strip_tags($course->achivement) }}</p>

                </div>

            </div>




        </div><!-- /.row -->

    </div><!-- /.container -->
</section>


<section class="your-Instructor-sec" id="content">
    <div class="container" id="content2">
        <div class="row">
            <div class="col-md-4">
                <div class="dr-philip-img">
                    <div class="philipHickman-circal">
                        <img src="{{ url('public/upload/instructor_image/' . $instructor->image) }}">
                    </div>
                    <div class="dr-philip-name text-center">
                        <h6>{{ $instructor->name }}</h6>
                    </div>
                </div>
            </div>





            <div class="col-md-8">
                <div class="block-title text-center">
                    <h2 class="block-title__title">Your Instructor</h2>
                </div>
                <div class="instructor-cont">
                    <p><?= $instructor->description ?></p>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="Course-Curriculum-section">

    <div class="container">
        <div class="row">

            <div class="course-head-title text-center">
                <h2>Course Curriculum</h2>
            </div>
            <div style="margin-left:76%;    margin-bottom: -20px; ">
                <h6>Time Duration</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="Course-Curriculum">
                    <ul class="course-curr-list">
                        <?php foreach($curriculum as $value){
                      $lecture = DB::table('tbl_lecture')->where(['curriculum_id'=>$value->id])->get();


                     ?>
                        <li class="heading-list">
                            <b>{{ $value->heading }}</b>
                            {{-- <b style="float:right">{{$value->time_duration}}</b> --}}


                        </li>
                        <?php foreach($lecture as $lec_value) {?>




                        <li>

                            <a href="{{ url('/lectures?key=' . $_GET['key']) }}" class="left-side-text">

                                <span class="lecture-icon">
                                    <i class="fa fa-file-text"></i>
                                </span>

                                {{ $lec_value->title }}


                                <span style="margin-left: 70%"> {{ $lec_value->time_duration }} </span>


                                <?php if($purchase==0){ ?>

                                <?php if($lec_value->preview==1){ ?>
                                <button class="breview-btn">Preview</button>

                                <?php }else{ ?>
                                <button class="breview-btn disable_btn" disabled="">Start</button><?php } }else{ ?>

                                <button class="breview-btn">Preview</button>
                                <?php } ?>

                            </a>
                        </li>
                        <?php } } ?>



                        {{-- <li class="heading-list"><b>sfasesddfs</b></li>
                      <li><a href="lectures.html" class="left-side-text"> <span class="lecture-icon"> <i class="fa fa-file-text"></i> </span> --}}


                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>
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
                    window.location.href = "{{ url('/cart_list') }}";
                    //$('#myModaladdcart').modal('show');
                }

            }
        });


    }
</script>



<!-- ***************************************Start the Footer************************************************ -->

@include('front.incliude.footer')
