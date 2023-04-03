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

                                <th>Heading</th>
                                <th>Text</th>
                                
                                <th>slider Image</th>
                                <th>Action</th>                                

                            </tr>

                        </thead>

                        <tbody>

                          @foreach($slider as $value)
                          <tr>
                            <td><?=$value->heading?></td>
                            <td><?=$value->text?></td>
                            
                            <td><img src="{{url('public/upload/slider_image/'.$value->slider_image)}}" width="100px" height="100px"></td>
                            <td>
                              <a href="{{url('admin/add_slider?key='.base64_encode($value->id))}}"><i class="fa fa-edit"></i></a><!--  | <a href="#" data_id="{{$value->id}}" onclick="delete_slider(this)"><i class="fa fa-trash"></i></a> -->
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

                        function delete_ins(th){

                          var id = $(th).data('id');

                         

                          var token = "<?php echo csrf_token(); ?>";

                          if(confirm('Are you sure?')){

                            $.ajax({

                              type:'POST',

                              url:'{{url("admin/delete_course")}}',

                              data:{id:id,_token:token},

                              success:function(data){

                                location.reload();

                              }

                            })

                          }

                        }

                      </script>
@include('admin.include.footer')