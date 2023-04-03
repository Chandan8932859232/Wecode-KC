@include('admin.include.header')
<style type="text/css">
    .overview-wrap {
        color: #fff;
    }
</style>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="overview-wrap">
                <a href="{{ url('admin/add_testimonial') }}" class="btn btn-success">Add Testimonial</a>
            </div>

            <div class="row m-t-30">


                <div class="col-md-12">

                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table id="myTable" class="table table-borderless table-data3">
                            <thead>

                                <tr>

                                    <!-- <th>Image</th> -->
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Designation</th>

                                    <th>Text</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>





                                @foreach ($testimonial as $value)
                                    <tr>

                                        <!-- <td><img src="{{ url('public/upload/testimonial_image/' . $value->image) }}" width="100px" height="100px"></td> -->
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->designation }}</td>

                                        <td>{{ $value->text }}</td>

                                        <td>
                                            <a
                                                href="{{ url('admin/add_testimonial?key=' . base64_encode($value->id)) }}"><i
                                                    class="fa fa-edit"></i>
                                            </a> |

                                            <a href="#" data-id="{{ $value->id }}"
                                                onclick="delete_testimonial(this)" id="alert-success">

                                                <i class="fa fa-trash" style="color:red"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach



                            </tbody>

                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
            <script type="text/javascript">
                function delete_testimonial(th) {

                    var id = $(th).data('id');
                    // alert(id);



                    var token = "<?php echo csrf_token(); ?>";

                    if (confirm('Are you sure?')) {

                        $.ajax({

                            type: 'POST',

                            url: '{{ url('/admin/delete_testimonial') }}',

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
