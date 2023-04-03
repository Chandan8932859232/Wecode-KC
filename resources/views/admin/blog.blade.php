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
                <a href="{{ url('admin/add_blog') }}" class="btn btn-success">Add blog</a>
            </div>

            <div class="row m-t-30">


                <div class="col-md-12">

                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table id="myTable" class="table table-borderless table-data3">
                            <thead>

                                <tr>

                                    <th>Image</th>

                                    <th>Heading</th>

                                    <th>Content</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($blog as $value)
                                    <tr>

                                        <td><img src="{{ url('public/upload/blog_image/' . $value->blog_image) }}"
                                                width="100px" height="100px"></td>

                                        <td>{{ $value->blog_heading }}</td>

                                        <td><?= substr($value->content, 0, 80) ?>...</td>

                                        <td><a href="{{ url('admin/blog_detail?key=' . base64_encode($value->id)) }}"><i
                                                    class="fa fa-eye"></i></a> |
                                            <a href="{{ url('admin/add_blog?key=' . base64_encode($value->id)) }}"><i
                                                    class="fa fa-edit"></i></a>|
                                            <a class="delete_blog" data-id="{{ $value->id }}"
                                                onclick="delete_blog(this)" style="color:red" id="alert-success" href="#"><i
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
                function delete_blog(th) {

                    var id = $(th).data('id');



                    var token = "<?php echo csrf_token(); ?>";

                    if (confirm('Are you sure?')) {

                        $.ajax({

                            type: 'POST',

                            url: '{{ url('admin/delete_blog') }}',

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
