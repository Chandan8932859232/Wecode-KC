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
                <a href="{{ url('admin/add_instruction') }}" class="btn btn-success">Add Instructor</a>
            </div>

            <div class="row m-t-30">


                <div class="col-md-12">

                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table id="myTable" class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Account</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instructor as $value)
                                    <tr>
                                        <td><img src="{{ url('public/upload/instructor_image/' . $value->image) }}"
                                                width="100px" height="100px"></td>
                                        <td>{{ $value->name }}</td>
                                        <td><?= substr($value->description, 0, 100) ?></td>


                                        <td>

                                            <?php if($value->status == '1'){ ?>


                                                <a href="{{ url('admin/status-update', [$value->id]) }} "class="btn btn-success">Active</a>
                                            <?php }
                                             else { ?>

                                            <a href="{{ url('admin/status-update', [$value->id]) }}" class="btn btn-danger">Inactive</a>


                                            <?php } ?>

                                        </td>


                                        <td><a
                                                href="{{ url('admin/add_instruction?key=' . base64_encode($value->id)) }}"><i
                                                    class="fa fa-edit"></i></a> | <a href="#"
                                                data-id="{{ $value->id }}" class="delete" onclick="delete_ins(this)"
                                                style="color:red" id="alert-success"><i class="fa fa-trash"></i></a>
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
                function delete_ins(th) {

                    var id = $(th).data('id');



                    var token = "<?php echo csrf_token(); ?>";

                    if (confirm('Are you sure?')) {

                        $.ajax({

                            type: 'POST',

                            url: '{{ url('admin/delete_instructor') }}',

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
