@include('admin.include.header')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<style type="text/css">
  .modal-backdrop {
    position: relative;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1040;
    background-color: #000;
}
.note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable {
    padding: 10px;
    overflow: auto;
    word-wrap: break-word;
    height: 250px;
}
.modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: .3rem;
    outline: 0;
    margin-top: 96px;
}
.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
    position: absolute;
}

</style>
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                      <?php if(isset($_GET['lecture'])){ ?>
                                        <strong>Lecture</strong>
                                      <?php }else{ ?>

                                      <?php if(isset($_GET['id'])){ ?>
                                        <strong>Lecture</strong>
                                      <?php }else{ ?>
                                        <strong>Curriculum</strong>
                                      <?php } }?>
                                        <!-- <small> Form</small> -->
                                    </div>
                                <form method="post" id="sub-frm">
                                    @csrf
                                    <div class="card-body card-block">
                                      <input type="hidden" class="course_id" name="course_id" value="<?php if(isset($_GET['keys'])){ echo $_GET['keys']; } ?>">
                                      <input type="hidden" class="curriculum_id" name="curriculum_id" value="<?php if(isset($_GET['id'])){ echo $_GET['id']; } ?>"  >
                                      <?php if(isset($_GET['lecture'])){}else{ ?>
                                        <div class="form-group">
                                            <label for="Heading" class="form-control-label">Heading</label>
                                            <input type="text" id="Heading" name="heading" placeholder="Heading" class="form-control heading" value="<?php if(isset($_GET['id'])){ echo $heading; } ?><?php if(isset($_GET['key'])){ echo $curriculum->heading; } ?>" <?php if(isset($_GET['id'])){ echo "readonly"; } ?>>
                                        </div>
                                      <?php } ?>
                                      <?php if(isset($_GET['key'])){}else{ ?>
                                        <div class="form-group">
                                            <label for="title" class="form-control-label">Title</label>
                                            <input type="text" id="title" name="title" placeholder="Title" class="form-control title" value="<?php if(isset($_GET['lecture'])){ echo $lecture->title; } ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="time_duration" class="form-control-label"> Total Time Duration</label>
                                            <input type="text" id="time_duration" name="time_duration" placeholder="Total Time Duration" class="form-control title" value="<?php if(isset($_GET['lecture'])){ echo $lecture->title; } ?>">
                                        </div>


                                        <div class="row form-group">
                                                <div class="col col-md-2">
                                                    <label class=" form-control-label">Preview</label>
                                                </div>
                                                <div class="col col-md-9">
                                                    <div class="form-check-inline form-check">
                                                        <label for="inline-radio1" class="form-check-label ">
                                                            <input type="radio" id="inline-radio1" name="preview" class="form-check-input" value="1" <?php if(isset($_GET['lecture'])){ if($lecture->preview==1){ echo "checked"; } } ?>>Yes
                                                        </label>
&nbsp; &nbsp;
                                                        <label for="inline-radio2" class="form-check-label ">
                                                            <input type="radio" id="inline-radio2" name="preview" class="form-check-input" value="0"<?php if(isset($_GET['lecture'])){ if($lecture->preview==0){ echo "checked"; } }else{ echo "checked"; } ?> checked>No
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>

                                        <div class="form-group">
                                            <label for="contents" class=" form-control-label">Content</label>
                                            <textarea name="contents" id="contents" class="form-control contents" placeholder="Content" rows="10"><?php if(isset($_GET['lecture'])){ echo $lecture->content; } ?></textarea>
                                        </div>


                                        <div class="form-group text-center">
                                            <?php if(isset($_GET['lecture'])){ ?>
                                                <input type="hidden" name="lecture_id" value="{{$lecture->id}}">
                                                <input type="hidden" class="curriculum_lec_id" name="curriculum_id" value="{{base64_encode($lecture->curriculum_id)}}">

                                            <button type="button" class="btn btn-success update">Update</button>
                                        <?php }else{ ?>
                                            <button type="button" class="btn btn-success submit">Submit</button>
                                        <?php } ?>

                                        </div>
                                      <?php } ?>
                                      <?php if(isset($_GET['key'])){?>
                                      <div class="form-group text-center">
                                        <input type="hidden" name="c_id" value="{{$curriculum->id}}">
                                        <input type="hidden" class="cl_id" name="cl_id" value="{{base64_encode($curriculum->course_id)}}">
                                        <button type="button" class="btn btn-success update_heading">Update</button>
                                      </div>
                                      <?php } ?>
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
                              var course_id = $('.course_id').val();
                              var heading = $('.heading').val();
                              var title = $('.title').val();
                              var contents = $('.contents').val();
                              //var desc = CKEDITOR.instances['contents'].getData();
                              //$('.contents').text(desc);
                              if(!heading){
                                $('.heading').css('border','1px solid red');
                              }else if(!title){
                                $('.heading').css('border','');
                                $('.title').css('border','1px solid red');
                              }else if(!contents){
                                $('.heading').css('border','');
                                $('.title').css('border','');
                                $('.contents').css('border','1px solid red');
                              }else{
                                $('.heading').css('border','');
                                $('.title').css('border','');
                                $('.contents').css('border','');

                                $.ajax({
                                     type:'POST',
                                      url:'{{url("admin/insert_curriculum")}}',
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
                                            window.location.href="{{URL::to('admin/curriculum?key=')}}"+course_id;
                                          });

                                        }
                                        if($.trim(data)=="name_err"){
                                          $('.hide').css('display','block');
                                          $('.msg_danger').text("Name already exist");
                                          $(".alert-danger").show('slow' , 'linear').delay(4000).fadeOut();

                                        }
                                      }
                                });
                              }



                            });
                        </script>
                        <script type="text/javascript">
                            $('.update').click(function(){
                               var curriculum_id = $('.curriculum_lec_id').val();
                               /*var desc = CKEDITOR.instances['contents'].getData();
                              $('.contents').text(desc);*/

                                $.ajax({
                                     type:'POST',
                                      url:'{{url("admin/update_lecture")}}',
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
                                            window.location.href="{{URL::to('admin/lecture_detail?key=')}}"+curriculum_id;
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
                          $('.update_heading').click(function(){
                            var course_id = $('.cl_id').val();
                            var heading = $('.heading').val();
                            if(!heading){
                              $('.heading').css('border','1px solid red');
                            }else{
                              $('.heading').css('border','');
                              $.ajax({
                                   type:'POST',
                                    url:'{{url("admin/update_curriculum_heading")}}',
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
                                          window.location.href="{{URL::to('admin/curriculum?key=')}}"+course_id;
                                        });

                                      }
                                      if($.trim(data)=="name_err"){
                                        $('.hide').css('display','block');
                                        $('.msg_danger').text("Name already exist");
                                        $(".alert-danger").show('slow' , 'linear').delay(4000).fadeOut();

                                      }
                                    }
                              });
                            }

                          });
                        </script>
<!-- <script>
  CKEDITOR.replace('contents');
</script> -->
<script type="text/javascript">
  $(document).ready(function() {
  $('#contents').summernote();
});
</script>
@include('admin.include.footer')
