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
                                        <strong>Update About</strong>
                                        <!-- <small> Form</small> -->
                                    </div>
                                <form method="post" id="product_form">
                                  <input type="hidden" class="token" name="_token" value="<?php echo csrf_token(); ?>">
                                  <div class="card-body card-block">
                                  <div class="form-group">
                                    <label>About Heading:</label>
                                    <input type="text" name="heading" class="form-control heading" placeholder="Blog Heading" value="<?php if(isset($_GET['key'])){ echo $about->heading; }?>">
                                  </div>
                        
                                  <div class="form-group">
                                    <label>Content:</label>
                                    <textarea class="form-control content_text" name="content_text" id="content_text" rows="10" placeholder="Content"><?php if(isset($_GET['key'])){ echo $about->content; }?></textarea>
                                  </div>
                                  <div class="form-group">
                                    <label>About Image: <span class="image-error error"></span></label>
                                    <input type="file" name="blog_image" class="form-control blog_image" placeholder="Blog Image">
                                  </div>
                                  <?php if(isset($_GET['key'])){ ?>
                                  <div class="form-group">
                                    
                                      <img src="{{url('public/upload/about_image/'.$about->image)}}" width="100px" height="100px">
                                    
                                  </div>
                                <?php } ?>

                                <div class="form-group text-center">
                                  <?php if(isset($_GET['key'])){ ?>
                                    <input type="hidden" name="blog_id" class="blog_id" value="{{$about->id}}">
                                    <input type="hidden" name="blogimg" class="blogimg" value="{{$about->image}}">
                                    <input type="button" name="" class="btn btn-success update_about" value="Update">
                                  <?php }else{ ?>
                                  <input type="button" name="" class="btn btn-success submit_blog" value="Submit">
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
     $(".blog_image").change(function() {  
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
                        <script type="text/javascript">
    $('.update_about').click(function(){
      var heading = $('.heading').val();
      var content = $('.content_text').val();
      var desc = CKEDITOR.instances['content_text'].getData();
      $('.content_text').val(desc);     
      
      if(!heading){
        $('.heading').css('border','1px solid red');
      }else if(!content){
        $('.heading').css('border','');
        $('.content').css('border','1px solid red');
      }else{
        $('.heading').css('border','');
        $('.content').css('border','');        
        $.ajax({
          type:'POST',
          url:'{{url("admin/updateabout")}}',
          data  :new FormData( $("#product_form")[0] ),
          async   : false,
          cache   : false,
          contentType : false,
          processData : false,
          success:function(data){
            if($.trim(data)=="done"){
              $('.hide1').css('display','block');
              $('.msg_success').text("Successfully Updated");
              $(".alert-success").show('slow' , 'linear').delay(4000).fadeOut(function(){
                window.location.href="{{URL::to('admin/about')}}";
              });

            }
            if($.trim(data)=="name_err"){
              $('.hide2').css('display','block');
              $('.msg_danger').text("Name already exist");
              $(".alert-danger").show('slow' , 'linear').delay(4000).fadeOut();

            }
          }

        });

      }
    });
  </script>
                        
  
<script>
  CKEDITOR.replace('content_text');
</script>
@include('admin.include.footer')