@include('admin.include.header')
<style type="text/css">
    .overview-wrap {
        color: #fff;
    }

    .dataTables_info {
        display: none;
    }

    .dataTables_paginate {
        display: none;
    }

    .table-responsive {
        padding-bottom: 3rem;
    }

    .dataTables_filter {
        display: none;
    }





    .table.dataTable {

        border-spacing: 2px;
    }
</style>
<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- <div class="overview-wrap">
                            <a href="{{ url('admin/add_course') }}" class="btn btn-success">Add Course</a>
                        </div> -->

            <div class="row m-t-30">


                <div class="col-md-12">

                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40" style="width: 100%;">
                        <table id="" class="table table-borderless table-data3" height="auto">
                            <thead>

                                <tr>

                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Email Receiver</th>
                                    <th>Facebook</th>
                                    <th>Twitter</th>
                                    <th>Youtube</th>
                                    <th>Instagram</th>
                                    <th>Linkedin</th>
                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody style="border:2px">

                                @foreach ($contact as $value)
                                    <tr>
                                        <td>{{ $value->address }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->phone_no }}</td>
                                        <td>{{ $value->receive_email }}</td>
                                        <td><input type="text" value="{{ $value->facebook }}"readonly></td>
                                        {{-- <td>{{$value->facebook}}</td> --}}

                                        <td><input type="text" value="{{ $value->twitter }}" readonly></td>
                                        <td><input type="text" value="{{ $value->youtube }}"readonly></td>
                                        <td><input type="text" value="{{ $value->instagram }}"readonly></td>
                                        <td><input type="text" value="{{ $value->linkedin }}"readonly></td>
                                        <td><a href="{{ url('admin/update_contact?key=' . base64_encode($value->id)) }}"><i
                                                    class="fa fa-edit"></i></a></td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE-->
                </div>
            </div>

            @include('admin.include.footer')
