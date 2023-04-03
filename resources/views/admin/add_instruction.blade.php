@include('admin.include.header')
<style type="text/css">
  .error{ color: red;  }
</style>

<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Instructor</strong>
                                        <!-- <small> Form</small> -->
                                    </div>
                                <form method="post" id="sub-frm">
                                    @csrf
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="company" class="form-control-label">Name</label>
                                            <input type="text" id="company" name="name" placeholder="Name" class="form-control name" value="<?php if(isset($_GET['key'])){ echo $instructor->name; } ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="Password" class="form-control-label">Password</label>
                                            <input type="text" id="Password" name="password" placeholder="Password" class="form-control name" value="<?php if(isset($_GET['key'])){ echo $instructor->password; } ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">Description</label>
                                            <textarea name="description" id="description" class="form-control description" placeholder="Description" rows="10"><?php if(isset($_GET['key'])){ echo $instructor->description; } ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="street" class=" form-control-label">Image <span class="image-error error"></span></label>
                                            <input type="file" id="street" name="image" placeholder="image" class="form-control image">
                                            <?php if(isset($_GET['key'])){ ?>
                                                <img src="{{url('public/upload/instructor_image/'.$instructor->image)}}" width="100px" height="100px">
                                            <?php } ?>
                                        </div>
                                        <div class="form-group text-center">
                                            <?php if(isset($_GET['key'])){ ?>
                                                <input type="hidden" name="instructor_id" value="{{$instructor->id}}">
                                                <input type="hidden" name="instructor_image" value="{{$instructor->image}}">
                                            <button type="button" class="btn btn-success update">Update</button>
                                        <?php }else{ ?>
                                            <button type="button" class="btn btn-success submit">Submit</button>
                                        <?php } ?>

                                        </div>
                                        <div class="alert alert-success text-center hide"><span class="msg_success"></span></div>
                                        <div class="alert alert-danger text-center hide"><span class="msg_danger"></span></div>

                                    </div>
                                </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $('.submit').click(function(){
                              var desc = CKEDITOR.instances['description'].getData();
                              $('.description').text(desc);

                                $.ajax({
                                     type:'POST',
                                      url:'{{url("admin/insert_instructor")}}',
                                      data  :new FormData( $("#sub-frm")[0] ),
                                      async   : false,
                                      cache   : false,
                                      contentType : false,
                                      processData : false,
                                      success:function(data){
                                        if($.trim(data)=="done"){
                                          $('.hide1').css('display','block');
                                          $('.msg_success').text("Successfully Added");
                                          $(".alert-success").show('slow' , 'linear').delay(4000).fadeOut(function(){
                                            window.location.href="{{URL::to('admin/instructor')}}";
                                          });

                                        }
                                        if($.trim(data)=="name_err"){
                                          $('.hide').css('display','block');
                                          $('.msg_danger').text("Name already exist");
                                          $(".alert-danger").show('slow' , 'linear').delay(4000).fadeOut();

                                        }
                                      }
                                });
                            });
                        </script>
                        <script type="text/javascript">
                            $('.update').click(function(){
                              var desc = CKEDITOR.instances['description'].getData();
                              $('.description').text(desc);
                                $.ajax({
                                     type:'POST',
                                      url:'{{url("admin/update_instructor")}}',
                                      data  :new FormData( $("#sub-frm")[0] ),
                                      async   : false,
                                      cache   : false,
                                      contentType : false,
                                      processData : false,
                                      success:function(data){
                                        if($.trim(data)=="done"){
                                          $('.hide1').css('display','block');
                                          $('.msg_success').text("Successfully Updated");
                                          $(".alert-success").show('slow' , 'linear').delay(4000).fadeOut(function(){
                                            window.location.href="{{URL::to('admin/instructor')}}";
                                          });

                                        }
                                        if($.trim(data)=="name_err"){
                                          $('.hide2').css('display','block');
                                          $('.msg_danger').text("Name already exist");
                                          $(".alert-danger").show('slow' , 'linear').delay(4000).fadeOut();

                                        }
                                      }
                                });
                            });
                        </script>
    <script type="text/javascript">
     $(".image").change(function() {
     var val = $(this).val(); var a=(this.files[0].size);
     switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
     case 'jpeg':
     case 'jpg':
     case 'png':
     break;
     default:
     $(this).val('');
     // error message here
     $('.image-error').text("Select Only JPG, JPEG and PNG File");

     //alert("Select Only JPG, JPEG and PNG File");
     break;
     }
     if(a > 2000000)
     {
      $(this).val('');
      alert('Your Image is too large!');
     }
     });
   </script>


<script>
  CKEDITOR.replace('description');
</script>
@include('admin.include.footer')
