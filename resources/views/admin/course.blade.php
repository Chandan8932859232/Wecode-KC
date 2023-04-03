@include('admin.include.header')
<style type="text/css">
    .overview-wrap {
        color: #fff;
    }

    h2 {
        font-size: 20px;
    }
</style>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="overview-wrap">
                <a href="{{ url('admin/add_course') }}" class="btn btn-success">Add Course</a>
            </div>

            <div class="row m-t-30">


                <div class="col-md-14">

                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-30">
                        <table id="myTable" class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Instructor Name</th>
                                    <th>Title</th>
                                    <th>Class_Level</th>

                                    <th>Tools</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course as $value)
                                    <tr>
                                        <td><img src="{{ url('public/upload/course_image/' . $value->image) }}"
                                                width="100px" height="100px"></td>

                                        <td>
                                            <?php echo $name = DB::table('tbl_instructor')
                                                ->where(['id' => $value->instructor_id])
                                                ->first()->name;
                                            ?>
                                        </td>

                                        <td>{{ $value->course_title }}</td>
                                        <td>{{ $value->class_level }}</td>
                                        <td>{{ $value->tools }}</td>


                                        <td>
                                            <a
                                                title="<?= $value->description ?>"><?= substr($value->description, 0, 50) ?>...</a>
                                        </td>
                                        <td>${{ $value->price }}</td>

                                        <td><a href="{{ url('admin/curriculum?key=' . base64_encode($value->id)) }}"
                                                class="btn btn-primary">Curriculum</a></td>


                                        <td><a href="{{ url('admin/add_course?key=' . base64_encode($value->id)) }}"><i
                                                    class="fa fa-edit"></i></a> | <a href="#"
                                                data-id="{{ $value->id }}" class="delete"
                                                onclick="delete_ins(this)" style="color:red" id="alert-success"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
            <script type="text/javascript">
                function delete_ins(th) {

                    var id = $(th).data('id');



                    var token = "<?php echo csrf_token(); ?>";

                    if (confirm('Are you sure?')) {

                        $.ajax({

                            type: 'POST',

                            url: '{{ url('admin/delete_course') }}',

                            data: {
                                id: id,
                                _token: token
                            },

                            success: function(data) {


                                if ($.trim(data) == "done") {
                                    swal({
                                        text: "Data Delete Successful.",
                                        icon: "success",
                                        button: false,
                                    });
                                    $("#alert-success").delay(2000).fadeOut(function() {
                                        location.reload();
                                    });
                                }


                            }

                        })

                    }

                }
            </script>
            @include('admin.include.footer')
