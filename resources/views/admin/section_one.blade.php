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
                                <th>Image</th>
                                <th>Action</th>                                

                            </tr>

                        </thead>

                        <tbody>

                          @foreach($web as $value)
                          <tr>
                            <td><?=$value->heading?></td>
                            <td><?=$value->text?></td>
                            <td><?php if($value->id==1){ echo "No image";}else{ ?>
                              <img src="{{url('public/upload/web_image/'.$value->image)}}" width="100px" height="100px">
                            <?php } ?>
                            </td>
                            <td>                            
                              <a href="{{url('admin/update_section?key='.base64_encode($value->id))}}"><i class="fa fa-edit"></i></a> 
                            </td>
                          </tr>
                          @endforeach
                          

                                                      

                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                        
@include('admin.include.footer')

