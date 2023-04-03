@include('admin.include.header')

<style type="text/css">

    .overview-wrap{color:#fff;}
    .delete{    cursor: pointer;
    color: #ff0000 !important;}

</style>

<!-- MAIN CONTENT-->

            <div class="main-content">

                <div class="section__content section__content--p30">

                    <div class="container-fluid">



                        <div class="overview-wrap">

                            <a href="{{url('admin/add_curriculum?keys='.$_GET['key'])}}" class="btn btn-success">Add Curriculum</a>

                        </div>



                        <div class="row m-t-30">





                            <div class="col-md-12">



                                <!-- DATA TABLE-->

                                <div class="table-responsive m-b-40">

                                    <table id="myTable" class="table table-borderless table-data3">

                                        <thead>

                                          <tr>

                                            <th>Heading</th>

                                            <th>Details</th>

                                            <th>Lecture</th>

                                            <th>Action</th>

                                          </tr>

                                        </thead>

                                        <tbody>

                                           @foreach($curriculum as $value)

                                            <tr>


                                                <td>{{$value->heading}}</td>

                                                <td><a href="{{url('admin/lecture_detail?key='.base64_encode($value->id))}}"><i class="fa fa-eye"><?=$total_lecture=DB::table('tbl_lecture')->where(['curriculum_id'=>$value->id,'status'=>1])->count()?></i></a></td>

                                                <td><a href="{{url('admin/add_curriculum?id='.base64_encode($value->id).'&keys='.$_GET['key'])}}" class="btn btn-success" style="color: #fff">Add Lecture</a></td>

                                                <td><a href="{{url('admin/add_curriculum?key='.base64_encode($value->id))}}"><i class="fa fa-edit"></i></a> | <a  data-id="{{$value->id}}" class="delete" onclick="delete_ins(this)" id="alert-success"><i class="fa fa-trash"></i></a></td>

                                            </tr>

                                            @endforeach



                                        </tbody>

                                    </table>

                                </div>

                                <!-- END DATA TABLE-->

                            </div>

                        </div>

                        <script type="text/javascript">

                        function delete_ins(th){

                          var id = $(th).data('id');

                          var token = "<?php echo csrf_token(); ?>";

                          if(confirm('Are you sure?')){

                            $.ajax({

                              type:'POST',

                              url:'{{url("admin/delete_curriculum")}}',

                              data:{id:id,_token:token},

                              success:function(data){

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



                            })



                          }



                        }



                      </script>

@include('admin.include.footer')
