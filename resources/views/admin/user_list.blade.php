@include('admin.include.header')
<style type="text/css">
    .overview-wrap{color:#fff;}
</style>
<!-- MAIN CONTENT-->
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

                                <th>User Name</th>

                                <th>Email</th>

                                <th>Phone Number</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                          @foreach($users as $value)

                          <tr>

                            <td>{{$value->fname.' '.$value->lname}}</td>

                            <td>{{$value->email}}</td>

                            <td>{{$value->phone_number}}</td>

                            <td><?php if($value->status==2){ echo "Disable"; }else{ echo "Active"; }?></td>

                            <td><?php if($value->status==2){ echo "<a href='#' class='btn btn-success' data-id='".$value->id."' data-status='1' onclick='change_status(this)'>Active</a>"; }else{ echo "<a href='#' class='btn btn-danger' data-id='".$value->id."' data-status='2' onclick='change_status(this)'>Disable</a>"; } ?></td>

                          </tr>

                          @endforeach



                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                        <script type="text/javascript">

                          function change_status(th){

                            var id = $(th).data('id');
                            var status = $(th).data('status');

                            var token = "<?php echo csrf_token(); ?>";

                            if(confirm('Are you sure?')){

                              $.ajax({

                                type:'POST',

                                url:'{{url("admin/change_user_status")}}',

                                data:{id:id,status:status,_token:token},

                                success:function(data){

                                  location.reload();

                                }

                              })

                            }

                          }

                        </script>
@include('admin.include.footer')
