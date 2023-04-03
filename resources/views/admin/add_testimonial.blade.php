@include('admin.include.header')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Testimonial</strong>
                                        <!-- <small> Form</small> -->
                                    </div>
                                <form method="post" id="product_form">
                          <input type="hidden" class="token" name="_token" value="<?php echo csrf_token(); ?>">
                          <div class="card-body card-block">
                        <div class="form-group">
                          <label>Name:</label>
                          <input type="text" name="heading" class="form-control heading" placeholder="Name" value="<?php if(isset($_GET['key'])){ echo $testimonial->name; }?>">
                        </div>
                        <div class="form-group">
                          <label>Designation:</label>
                          <input type="text" name="designation" class="form-control designation" placeholder="Designation" value="<?php if(isset($_GET['key'])){ echo $testimonial->designation; }?>">
                        </div>
                        
                        <div class="form-group">
                          <label>Message:</label>
                          <textarea class="form-control content_text" name="content_text" rows="10" placeholder="Message"><?php if(isset($_GET['key'])){ echo $testimonial->text; }?></textarea>
                        </div>
                        <!-- <div class="form-group">
                          <label>Image:</label>
                          <input type="file" name="blog_image" class="form-control blog_image fileUpload">
                          <img src="<?php if(isset($_GET['key'])){ echo url('public/upload/testimonial_image/'.$testimonial->image);} ?>" class="preview" width="100px" height="100px" />
                        </div> -->
                        

                        <div class="form-group text-center">
                          <?php if(isset($_GET['key'])){ ?>
                            <input type="hidden" name="blog_id" class="blog_id" value="{{$testimonial->id}}">
                            <input type="hidden" name="blogimg" class="blogimg" value="{{$testimonial->image}}">
                            <input type="button" name="" class="btn btn-success update_blog" value="Update">
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
    $.fn.checkFileType = function (options) {
    var defaults = {
        allowedExtensions: [],
        preview: "",
        success: function () {},
        error: function () {}
    };
    options = $.extend(defaults, options);
    $previews = $(options.preview);
    return this.each(function (i) {

        $(this).on('change', function () {
            var value = $(this).val(),
                file = value.toLowerCase(),
                extension = file.substring(file.lastIndexOf('.') + 1),
                $preview = $previews.eq(i);

            if ($.inArray(extension, options.allowedExtensions) == -1) {
                options.error();
                $(this).focus();
            } else {
                if (this.files && this.files[0] && $preview) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $preview.show().attr('src', e.target.result);
                        options.success();
                    };

                    reader.readAsDataURL(this.files[0]);
                } else {
                    options.error();
                }

            }

        });

    });
};

$('.fileUpload').checkFileType({
    allowedExtensions: ['jpg', 'jpeg', "gif", 'png'],
    preview: ".preview",
    success: function () {
        //alert('success')
    },
    error: function () {
        alert('Plese select JPG, JPEG, GIF image only.');
    }
});
  </script>
  
  <script type="text/javascript">
    $('.submit_blog').click(function(){
      var heading = $('.heading').val();
      var content = $('.content_text').val();
      
      var blog_image = $('.blog_image').val();
      if(!heading){
        $('.heading').css('border','1px solid red');
      }else if(!content){
        $('.heading').css('border','');
        $('.content_text').css('border','1px solid red');
      }else{
        $('.heading').css('border','');
        $('.content_text').css('border','');        
        $.ajax({
          type:'POST',
          url:'{{url("admin/insert_testimonial")}}',
          data  :new FormData( $("#product_form")[0] ),
          async   : false,
          cache   : false,
          contentType : false,
          processData : false,
          success:function(data){
            if($.trim(data)=="done"){
              $('.hide1').css('display','block');
              $('.msg_success').text("Successfully Added");
              $(".alert-success").show('slow' , 'linear').delay(4000).fadeOut(function(){
                window.location.href="{{URL::to('admin/testimonial')}}";
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
  <script type="text/javascript">
    $('.update_blog').click(function(){
      var heading = $('.heading').val();
      var content = $('.content_text').val();     
      
      if(!heading){
        $('.heading').css('border','1px solid red');
      }else if(!content){
        $('.heading').css('border','');
        $('.content_text').css('border','1px solid red');
      }else{
        $('.heading').css('border','');
        $('.content_text').css('border','');        
        $.ajax({
          type:'POST',
          url:'{{url("admin/update_testimonial")}}',
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
                window.location.href="{{URL::to('admin/testimonial')}}";
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
  CKEDITOR.replace('description');
</script>
@include('admin.include.footer')