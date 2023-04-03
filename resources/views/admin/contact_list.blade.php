@include('admin.include.header')
<style type="text/css">
    .overview-wrap {
        color: #fff;
    }
</style>
<!-- MAIN CONTENT-->


{{-- {{Session::get('success')}} --}}



{{-- @if (session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif --}}
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">



            <div class="row m-t-30">


                <div class="col-md-12">

                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table id="myTable" class="table table-borderless table-data3">
                            <thead>

                                <tr>

                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($contact as $value)
                                    <tr>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->subject }}</td>
                                        <td>{{ $value->message }}</td>
                                        <td><a data-id="{{ $value->id }}" href="#"
                                                onclick="delete_contact_list(this)" style="color:red;"
                                                id="alert-success">

                                                <i class="fa fa-trash"></i> </a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>
            <script type="text/javascript">
                function delete_contact_list(th)

                {

                    var id = $(th).data('id');

                    var token = "<?php echo csrf_token(); ?>";

                    if (confirm('Are you sure?')) {

                        $.ajax({

                            type: 'POST',

                            url: '{{ url('admin/delete_contact_list') }}',
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
