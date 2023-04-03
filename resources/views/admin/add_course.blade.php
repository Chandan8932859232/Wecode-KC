@include('admin.include.header')
<style type="text/css">
    .error {
        color: red;
    }
</style>

<div class="main-content">

    <div class="section__content section__content--p30">

        <div class="container-fluid">

            <div class="row">



                <div class="col-lg-8">

                    <div class="card">

                        <div class="card-header">

                            <strong>Course</strong>

                            <!-- <small> Form</small> -->

                        </div>

                        <form  id="sub-frm" >

                            @csrf

                            <div class="card-body card-block">

                                <div class="form-group">

                                    <label for="instructor" class="form-control-label">Instructor</label>

                                    <select class="form-control instructor_id" id="instructor" name="instructor_id">

                                        <option value="">Select Instructor</option>

                                        @foreach ($instructor as $value)
                                            <option <?php if (isset($_GET['key'])) {
                                                if ($course->instructor_id == $value->id) {
                                                    echo 'Selected';
                                                }
                                            } ?> value="{{ $value->id }}">{{ $value->name }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>

                                <div class="form-group">

                                    <label for="company" class="form-control-label">Title</label>

                                    <input type="text" id="company" name="course_title" placeholder="Title"
                                        class="form-control course_title" value="<?php if (isset($_GET['key'])) {
                                            echo $course->course_title;
                                        } ?>">

                                </div>


                                <div class="form-group">

                                    <label for="duration" class="form-control-label">Class Duration </label>

                                    <input type="text" id="duration" name="class_duration" placeholder="Duration"
                                        class="form-control course_title" value="<?php if (isset($_GET['key'])) {
                                            echo $course->class_duration;
                                        } ?>">

                                </div>



                                <div class="form-group">

                                    <label for="tools" class="form-control-label">Tools</label>

                                    <input type="text" id="tools" name="tools" placeholder="Tools"
                                        class="form-control course_title" value="<?php if (isset($_GET['key'])) {
                                            echo $course->tools;
                                        } ?>">

                                </div>


                                <div class="form-group">

                                    <label for="price" class="form-control-label">Price</label>

                                    <input type="text" id="price" name="price" placeholder="Price"
                                        class="form-control price" value="<?php if (isset($_GET['key'])) {
                                            echo $course->price;
                                        } ?>">

                                </div>

                                <div class="form-group">

                                    <label for="description" class=" form-control-label">Description</label>

                                    <textarea name="description" id="description" class="form-control description" placeholder="Enter Description" rows="10"><?php if (isset($_GET['key'])) {
                                        echo $course->description;
                                    } ?></textarea>

                                </div>

                                <div class="form-group">

                                    <label for="Achivement" class=" form-control-label">Achivement</label>

                                    <textarea name="achivement" id="Achivement" class="form-control description" placeholder="Enter Achivement" rows="10"><?php if (isset($_GET['key'])) {
                                        echo strip_tags($course->achivement);
                                    } ?></textarea>

                                </div>





                                <div class="form-group">

                                    <label for="course_level" class="form-control-label">Course Level</label>

                                    <select class="form-control instructor_id"  id="course_level" name="class_level" value="<?php if (isset($_GET['key'])) {
                                        echo $course->class_level;  } ?>" >




                                        <option value="All" name="class_level" value="All" >All</option>


                                        <option name="class_level" value="Beginner"  >Beginner</option>
                                        <option name="class_level" value="Intermediate"   >Intermediate</option>
                                        <option name="class_level" value="Advance"  >Advance</option>



                                    </select>

                                </div>



                                <div class="form-group">

                                    <label for="imagefile" class=" form-control-label">Image
                                        <span  class="image-error error"></span>
                                    </label>


                                    <input type="file" id="imagefile" name="image" placeholder="image" class="form-control image">

                                    <?php if(isset($_GET['key'])){ ?>

                                    <img src="{{ url('public/upload/course_image/' . $course->image) }}" width="100px"
                                        height="100px">

                                    <?php } ?>

                                </div>

                                <div class="form-group text-center">

                                    <?php if(isset($_GET['key'])){ ?>

                                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                                    <input type="hidden" name="course_image" value="{{ $course->image }}">

                                    <button type="button" class="btn btn-success update">Update</button>

                                    <?php }else{ ?>

                                    <button type="button" class="btn btn-success submit">Submit</button>

                                    <?php } ?>



                                </div>

                                <div class="alert alert-success text-center hide"><span class="msg_success"></span>
                                </div>

                                <div class="alert alert-danger text-center hide"><span class="msg_danger"></span></div>



                            </div>

                        </form>



                    </div>

                </div>

            </div>

        </div>

        <script type="text/javascript">
            $('.submit').click(function() {

                var desc = CKEDITOR.instances['description'].getData();

                $('.description').text(desc);
                var instructor_id = $('.instructor_id').val();
                var course_title = $('.course_title').val();

                var price = $('.price').val();
                var image = $('#imagefile').val();
                // alert(price)
                // alert(image)

                if (!instructor_id) {
                    $('.instructor_id').css('border', '1px solid red');
                }


                else if (!course_title) {
                    $('.instructor_id').css('border', '');
                    $('.course_title').css('border', '1px solid red');
                }


                else if (!price) {
                    $('.instructor_id').css('border', '');
                    $('.course_title').css('border', '');
                    $('.price').css('border', '1px solid red');
                }

                else if (!image) {
                    $('.instructor_id').css('border', '');
                    $('.course_title').css('border', '');
                    $('.price').css('border', '');
                    $('.image').css('border', '1px solid red');
                    //  alert('message4');
                }

                else {

                    $('.instructor_id').css('border', '');
                    $('.course_title').css('border', '');
                    $('.price').css('border', '');
                    $('.image').css('border', '');

                    $.ajax({

                        type: 'POST',

                        url: '{{ url('admin/insert_course') }}',

                        data: new FormData($("#sub-frm")[0]),

                        async: false,

                        cache: false,

                        contentType: false,

                        processData: false,

                        success: function(data) {
                            if ($.trim(data) == "done") {

                                $('.hide1').css('display', 'block');

                                $('.msg_success').text("Successfully Added");

                                $(".alert-success").show('slow', 'linear').delay(4000).fadeOut(function() {

                                    window.location.href = "{{ URL::to('admin/course') }}";

                                });



                            }

                            if ($.trim(data) == "name_err") {

                                $('.hide').css('display', 'block');

                                $('.msg_danger').text("Name already exist");

                                $(".alert-danger").show('slow', 'linear').delay(4000).fadeOut();



                            }

                        }

                    });
                }

            });
        </script>

        <script type="text/javascript">
            $('.update').click(function() {

                var desc = CKEDITOR.instances['description'].getData();

                $('.description').text(desc);
                var instructor_id = $('.instructor_id').val();
                var course_title = $('.course_title').val();
                var price = $('.price').val();

                var image = $('.image').val();
                if (!instructor_id) {
                    $('.instructor_id').css('border', '1px solid red');
                } else if (!course_title) {
                    $('.instructor_id').css('border', '');
                    $('.course_title').css('border', '1px solid red');
                } else if (!price) {
                    $('.instructor_id').css('border', '');
                    $('.course_title').css('border', '');
                    $('.price').css('border', '1px solid red');
                } else {

                    $('.instructor_id').css('border', '');
                    $('.course_title').css('border', '');
                    $('.price').css('border', '');
                    $('.image').css('border', '');


                    $.ajax({

                        type: 'POST',

                        url: '{{ url('admin/update_course') }}',

                        data: new FormData($("#sub-frm")[0]),

                        async: false,

                        cache: false,

                        contentType: false,

                        processData: false,

                        success: function(data) {

                            if ($.trim(data) == "done") {

                                $('.hide1').css('display', 'block');

                                $('.msg_success').text("Successfully Updated");

                                $(".alert-success").show('slow', 'linear').delay(4000).fadeOut(function() {

                                    window.location.href = "{{ URL::to('admin/course') }}";

                                });



                            }

                            if ($.trim(data) == "name_err") {

                                $('.hide2').css('display', 'block');

                                $('.msg_danger').text("Name already exist");

                                $(".alert-danger").show('slow', 'linear').delay(4000).fadeOut();



                            }

                        }

                    });
                }

            });
        </script>
        <script type="text/javascript">
            $(".image").change(function() {
                var val = $(this).val();
                var a = (this.files[0].size);
                switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
                    case 'jpeg':
                    case 'jpg':
                    case 'png':
                        break;
                    default:
                        $(this).val('');
                        // error message here
                        $('.image-error').text("Select Only JPG, JPEG and PNG File");

                        //alert("Select Only JPG, JPEG and PNG File");
                        break;
                }
                if (a > 2000000) {
                    $(this).val('');
                    alert('Your Image is too large!');
                }
            });
        </script>

        <script>
            CKEDITOR.replace('description');
        </script>

        @include('admin.include.footer')
