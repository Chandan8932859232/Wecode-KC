@include('admin.include.header')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Contact Page</strong>
                                        <!-- <small> Form</small> -->
                                    </div>
                                <form method="post" id="product_form">
                                  <div class="card-body card-block">
                          <input type="hidden" class="token" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                          <label for="Address">Address:</label>
                          <textarea  id="Address" class="form-control address" name="address" rows="5" placeholder="Address"><?php if(isset($_GET['key'])){ echo $contact->address; }?></textarea>
                        </div>

                        <div class="form-group">
                          <label for="Email">Email:</label>
                          <input type="text" id="Email" class="form-control email" name="email" placeholder="Email" value="<?php if(isset($_GET['key'])){ echo $contact->email; }?>">
                        </div>
                        <div class="form-group">
                          <label for="phone_number">Phone Number:</label>
                          <input type="text" id="phone_number" name="phone_number" class="form-control phone_number" placeholder="Phone Number" value="<?php if(isset($_GET['key'])){ echo $contact->phone_no; }?>">
                        </div>
                        <div class="form-group">
                          <label for="receiveremail">Contact mail receiver email:</label>
                          <input type="text" id="receiveremail" name="receiveremail" class="form-control receiveremail" placeholder="Contact mail reciver email" value="<?php if(isset($_GET['key'])){ echo $contact->receive_email; }?>">
                        </div>

                        <div class="form-group">
                            <label for="Facebook">Facebook Link:</label>
                            <input type="text" id="Facebook" name="facebook" class="form-control receiveremail" placeholder="Facebook" value="<?php if(isset($_GET['key'])){ echo $contact->facebook; }?>">
                          </div>

                          <div class="form-group">
                            <label for="twitter">Twitter Link:</label>
                            <input type="text" id="twitter" name="twitter" class="form-control receiveremail" placeholder="Twitter" value="<?php if(isset($_GET['key'])){ echo $contact->twitter; }?>">
                          </div>

                          <div class="form-group">
                            <label for="Youtube">Youtube Link:</label>
                            <input type="text" id="Youtube" name="youtube" class="form-control receiveremail" placeholder="Youtube" value="<?php if(isset($_GET['key'])){ echo $contact->youtube; }?>">
                          </div>

                          <div class="form-group">
                            <label for="instagram">Instagram Link:</label>
                            <input type="text" id="instagram" name="instagram" class="form-control receiveremail" placeholder="instagram" value="<?php if(isset($_GET['key'])){ echo $contact->instagram; }?>">
                          </div>

                          <div class="form-group">
                            <label for="linkedin">Linkedin Link</label>
                            <input type="text" id="linkedin" name="linkedin" class="form-control receiveremail" placeholder="Linkedin" value="<?php if(isset($_GET['key'])){ echo $contact->linkedin; }?>">
                          </div>

                        <div class="form-group text-center">
                          <?php if(isset($_GET['key'])){ ?>
                            <input type="button" name="" class="btn btn-success update_contact" value="Update">
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
    $('.update_contact').click(function(){
      var address = $('.address').val();
      //var email = $('.email').val();
      var email = "example@gmail.com";
      var phone_number = $('.phone_number').val();
      var receiveremail = $('.receiveremail').val();


      if(!address){
        $('.address').css('border','1px solid red');
      }else if(!email){

        $('.address').css('border','');
        $('.email').css('border','1px solid red');
      }else if(!$('.email').val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){
        $('.address').css('border','');
        $('.email').css('border','1px solid red');
      }else if(!phone_number){
        $('.address').css('border','');
        $('.email').css('border','');
        $('.phone_number').css('border','1px solid red');
      }else if(!receiveremail){
        $('.address').css('border','');
        $('.email').css('border','');
        $('.phone_number').css('border','');
        $('.receiveremail').css('border','1px solid red');
      }else if(!$('.receiveremail').val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){
        $('.address').css('border','');
        $('.email').css('border','');
        $('.phone_number').css('border','');
        $('.receiveremail').css('border','1px solid red');
      }else{
        $('.address').css('border','');
        $('.email').css('border','');
        $('.phone_number').css('border','');
        $('.receiveremail').css('border','');
        $.ajax({
          type:'POST',
          url:'{{url("admin/updatecontact")}}',
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
                window.location.href="{{URL::to('admin/contact_page')}}";
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
