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

            <!-- <div class="overview-wrap">
                            <a href="{{ url('admin/add_curriculum?keys=' . $_GET['key']) }}" class="btn btn-success">Add Curriculum</a>
                        </div> -->
            <h2 class="text-center">{{ $heading }}</h2>

            <div class="row m-t-30">


                <div class="col-md-12">

                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <!-- <th>Content</th> -->
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lecture as $value)
                                    <tr>
                                        <td>{{ $value->title }}</td>
                                        <!-- <td><?//=substr($value->content,0,100)?></td> -->
                                        <td><a href="{{ url('admin/detail?key=' . base64_encode($value->id)) }}"><i
                                                    class="fa fa-eye"></i></a></td>
                                        <td><a
                                                href="{{ url('admin/add_curriculum?lecture=' . base64_encode($value->id)) }}"><i
                                                    class="fa fa-edit"></i></a> |
                                            <a href="#" data-id="{{ $value->id }}" class="delete"
                                                onclick="delete_ins(this)" style="color:red" id="alert-success"><i
                                                    class="fa fa-trash"></i></a>
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

                            url: '{{ url('admin/delete_lecture') }}',

                            data: {
                                id: id,
                                _token: token
                            },

                            success: function(data) {

                                if ($.trim(data) == "done") {
                                    swal({
                                        text: "Data Deleted Successfully..!!",
                                        icon: "success",
                                        button: false,

                                    });
                                    $("#alert-success").delay(2000).fadeOut(function() {
                                        location.reload();
                                    });
                                }


                            }

                        });

                    }

                }
            </script>
            @include('admin.include.footer')
