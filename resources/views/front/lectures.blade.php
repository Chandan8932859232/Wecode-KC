@include('front.incliude.header')
  <div class="header-line"></div>


<style type="text/css">
  .progresss{margin-top: 15px;}
  .progress{width: 100%;}
  .bg-success{background-color: #f16101!important}
</style>

<section class="lectures-section">
    <div class="">
        <div class="tabs">
  <div class="tab-button-outer">
    <ul id="tab-button">
      <li class="list-heading-one">{{$course->course_title}}</li>
      <?php if(session('drphllip_user_id')!=''){
        if($purchase!=0){
          $user_id = session('drphllip_user_id');
          $total_read =0;
          foreach($curriculum as $value){
            $lecture = DB::table('tbl_lecture')->where(['curriculum_id'=>$value->id])->get();
            foreach($lecture as $lec_value) {
              $lect_value = DB::table('tbl_lecture_study')->where(['lecture_id'=>$lec_value->id,'user_id'=>$user_id]);
              if($lect_value->count()!=0){
                $val = $lect_value->first()->read_value;
                $total_read = $total_read+$val;
              }else{
                $total_read = 0;
              }
            }

          }

       ?>
      <li>

        <div class="progresss">
          <progress class="progress-bar bg-success progress" value="{{$total_read}}" max="100" id=p1>0%</progress>
          <p class="text-center"><span class="read_value">{{$total_read}}</span>% COMPLETE</p>
            
          </div>
        </li>
      <?php } } ?>

      <?php $user_id = session('drphllip_user_id'); $i=1; $total_lec = 0; foreach($curriculum as $value){
        $lecture = DB::table('tbl_lecture')->where(['curriculum_id'=>$value->id])->get();
        $lecture_count = DB::table('tbl_lecture')->where(['curriculum_id'=>$value->id])->count();
        $total_lec = $total_lec+$lecture_count;


       ?>
      <li class="gry-heading">{{$value->heading}}</li>
      <?php  foreach($lecture as $lec_value) {
        $check_read = DB::table('tbl_lecture_study')->where(['lecture_id'=>$lec_value->id,'user_id'=>$user_id])->count();
        ?>
      <li><a href="#tab{{$i}}" <?php if($purchase!=0){ ?>data-id="{{$lec_value->id}}" onclick="read_lecture(this)"<?php } ?>><span class="circal-icon"><i class=" <?php if($check_read==0){ echo"fa fa-circle-o";}else{ echo"fa fa-circle"; } ?> " aria-hidden="true"></i></span> <span class="lecture-icon"> <i class="fa fa-file-text"></i> </span> {{$lec_value->title}}</a></li>
      <?php $i++; } } ?>      
    </ul>
  </div>
  <?php //echo round(100/$total_lec); ?>

  <script type="text/javascript">
    function read_lecture(th){
      var total_lec = <?php echo round(100/$total_lec); ?>;
      var v1=document.getElementById('p1').value;
      //document.getElementById("p1").value= v1 + total_lec;
      var lecture_id = $(th).data('id');
      //alert(lecture_id);
      var token = "<?php echo csrf_token(); ?>";
      $.ajax({
        type:'POST',
        url:'{{url("/read_lecture")}}',
        data:{lecture_id:lecture_id,total_lec:total_lec,_token:token},
        success:function(data){
          if($.trim(data)=='done'){
          var v1=document.getElementById('p1').value;
          document.getElementById("p1").value= v1 + total_lec;            
          $('.read_value').text(v1 + total_lec);
          }

        }
      });
    }
  </script>

  <div class="tab-select-outer">
    <select id="tab-select">
      <?php $j=1; foreach($curriculum as $value){
        $lecture = DB::table('tbl_lecture')->where(['curriculum_id'=>$value->id])->get();
         foreach($lecture as $lec_value) {
       ?>
      <option value="#tab{{$j}}">Tab 1</option>
      <?php $j++; } } ?>
      <!-- <option value="#tab02">Tab 2</option>
      <option value="#tab03">Tab 3</option>
      <option value="#tab04">Tab 4</option>
      <option value="#tab05">Tab 5</option>
      <option value="#tab06">Tab 6</option>
      <option value="#tab07">Tab 7</option>
      <option value="#tab08">Tab 8</option>
      <option value="#tab09">Tab 9</option> -->
    </select>
  </div>
      <?php $z=1; foreach($curriculum as $value){
        $lecture = DB::table('tbl_lecture')->where(['curriculum_id'=>$value->id])->get();
         foreach($lecture as $lec_value) {
       ?>
  <div id="tab{{$z}}" class="tab-contents">
    <!-- not preview -->
    <?php if($purchase==0){ ?>
    <?php if($lec_value->preview==0){ ?>
    <div class="Lecture-Overview">
       <ul>
           <li> <span class="lecture-icon"> <i class="fa fa-file-text"></i> </span> {{$lec_value->title}}</li>
       </ul>
    </div>
    <div class="lecture-content">
        <div class="well locked">
          <center>
              <div class="lecture-contents-locked">
                <div class="locked-icon">
                   <div class="lecture-lock-seal">
                      <div class="lecture-lock-seal-lock-icon">
                        <div class="main"></div>
                      </div>
                    </div>
                </div>
                Lecture content locked
                <?php if(session('drphllip_user_id')==''){ ?>
                <div class="already-enrolled">If you're already enrolled,  <a href="{{url('/login')}}">you'll need to login</a>.</div>
                <a class="btn btn-md btn-primary btn-md" href="{{url('/login')}}" id="lecture-locked" title="Education Leadership Master Class">Enroll in Course to Unlock</a>
                <?php }else{ ?>
                <div class="already-enrolled">
                <a class="btn btn-md btn-primary btn-md" id="lecture-locked" title="Education Leadership Master Class" data-id="{{$course->id}}" data-price="{{$course->price}}" onclick="add_cart(this)">Enroll in Course to Unlock</a>
                <?php } ?>
              </div>
          </center>
        </div>
    </div>
    <!-- not preview -->
    <?php } ?>
    <?php if($lec_value->preview==1){ ?>
    <!-- preview -->
    <div class="Lecture-Overview">
       <ul>
           <li> <span class="lecture-icon"> <i class="fa fa-file-text"></i> </span>  {{$lec_value->title}}</li>
       </ul>
    </div>
    <div class="lecture-content">
         <article class="pera-cont">
             <?=$lec_value->content?>
         </article>
    </div>
    <?php } }else{?>
    <!-- preview -->
    <!-- preview1 -->
    <div class="Lecture-Overview">
       <ul>
           <li> <span class="lecture-icon"> <i class="fa fa-file-text"></i> </span>  {{$lec_value->title}}</li>
       </ul>
    </div>
    <div class="lecture-content">
         <article class="pera-cont">
             <?=$lec_value->content?>
         </article>
    </div>
    <!-- preview1 -->
    <?php } ?>

  </div><!-- End Tab One -->
  <?php $z++; } } ?>
  <!-- <div id="tab02" class="tab-contents">
   <div class="Lecture-Overview">
       <ul>
           <li> <span class="lecture-icon"> <i class="fa fa-file-text"></i> </span> Lecture Overview</li>
       </ul>
    </div>
     <div class="lecture-content">
          <div class="well locked">
          <center>
              <div class="lecture-contents-locked">
                <div class="locked-icon">
                   <div class="lecture-lock-seal">
                      <div class="lecture-lock-seal-lock-icon">
                        <div class="main"></div>
                      </div>
                    </div>
                </div>
                Lecture content locked
                <div class="already-enrolled">If you're already enrolled,  <a href="#!">you'll need to login</a>.</div>
                <a class="btn btn-md btn-primary btn-md" href="#!" id="lecture-locked" title="Education Leadership Master Class">Enroll in Course to Unlock</a>
              </div>
          </center>
        </div>
     </div>
  </div> --><!-- End Tab two -->
  <!-- <div id="tab03" class="tab-contents">
    <div class="Lecture-Overview">
       <ul>
           <li> <span class="lecture-icon"> <i class="fa fa-file-text"></i> </span>  Lecture One: Leadership styles</li>
       </ul>
    </div>
    <div class="lecture-content">
         <article class="pera-cont">
             <p><strong>Leadership Style:</strong></p>
             <p>As a principal, you will take on a certain style of leadership. We will discuss various leadership styles of principals. You may notice some characteristics from various styles when you think about your own style of leadership. Robert Schulze (2014) completed a research study in which he explored the various types of leadership styles.</p>
         </article>
         <article class="pera-cont">
             <p><strong>Laissez-fair Leadership:</strong> This type of leader is not active in managing the school. The leader is non-confrontational, which often leads to lack of motivation and effort from faculty and students. Laissez-faire leadership offers little or no feedback, confrontation, or direction for the school or instruction (Webb, 2007).  There is no purposeful leadership given. The school and teachers lead themselves. This type of leader is not able to provide direction for the school or cause any type of significant progress or improvement. </p>
         </article>
         <article class="pera-cont">
             <p><strong>Transactional Leadership: </strong>  Think of the word transaction in the banking world. When you deposit or withdraw money, it is considered a transaction. Also, when you go to the store to purchase something, you give the cashier money for whatever you are purchasing. This is also a transaction. This is the same in transactional leadership. The leader rewards or punishes based on the actions of those he/she supervises.   Everything is reactionary. There is no proactive or long-term decisions in place.  The leaders’ actions are only in response to the actions of others. This type of leadership does little to motivate, but does not stimulate any type of improvements (Leithwood, 1992). There are times when those you supervise need to understand consequences and rewards for their actions. However, there should be other components of leadership. Transactional leadership can only be effective when combined with other leadership styles (Pepper, 2010).otivate, but does not stimulate any type of improvements (Leithwood, 1992). There are times when those you supervise need to understand consequences and rewards for their actions. However, there should be other components of leadership. Transactional leadership can only be effective when combined with other leadership styles (Pepper, 2010).otivate, but does not stimulate any type of improvements (Leithwood, 1992). There are times when those you supervise need to understand consequences and rewards for their actions. However, there should be other components of leadership. Transactional leadership can only be effective when combined with other leadership styles (Pepper, 2010).otivate, but does not stimulate any type of improvements (Leithwood, 1992). There are times when those you supervise need to understand consequences and rewards for their actions. However, there should be other components of leadership. Transactional leadership can only be effective when combined with other leadership styles (Pepper, 2010).  </p>
         </article>
    </div>
  </div><!-- End Tab three --
  <div id="tab04" class="tab-contents">
    <h2>Page 4</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quos aliquam consequuntur, esse provident impedit minima porro! Laudantium laboriosam culpa quis fugiat ea, architecto velit ab, deserunt rem quibusdam voluptatum.</p>
  </div>
  <div id="tab05" class="tab-contents">
    <h2>Page 5</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quos aliquam consequuntur, esse provident impedit minima porro! Laudantium laboriosam culpa quis fugiat ea, architecto velit ab, deserunt rem quibusdam voluptatum.</p>
  </div>
  <div id="tab06" class="tab-contents">
    <h2>Page 6</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quos aliquam consequuntur, esse provident impedit minima porro! Laudantium laboriosam culpa quis fugiat ea, architecto velit ab, deserunt rem quibusdam voluptatum.</p>
  </div>
  <div id="tab07" class="tab-contents">
    <h2>Page 7</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quos aliquam consequuntur, esse provident impedit minima porro! Laudantium laboriosam culpa quis fugiat ea, architecto velit ab, deserunt rem quibusdam voluptatum.</p>
  </div>
  <div id="tab08" class="tab-contents">
    <h2>Page 7</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quos aliquam consequuntur, esse provident impedit minima porro! Laudantium laboriosam culpa quis fugiat ea, architecto velit ab, deserunt rem quibusdam voluptatum.</p>
  </div>
  <div id="tab09" class="tab-contents">
    <h2>Page 7</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quos aliquam consequuntur, esse provident impedit minima porro! Laudantium laboriosam culpa quis fugiat ea, architecto velit ab, deserunt rem quibusdam voluptatum.</p>
  </div> -->
</div>
    </div>
</section>
<script type="text/javascript">
    function add_cart(th){
        var course_id = $(th).data('id');
        var price = $(th).data('price');
        var token = "<?php echo csrf_token(); ?>";
        $.ajax({
            type:'Post',
            url:"{{url('home/add_to_cart')}}",
            data:{course_id:course_id,price:price,_token:token},
            success:function(data){
                //alert(data);
                if($.trim(data)=='done'){
                  window.location.href="{{url('/cart_list')}}";
                    //$('#myModaladdcart').modal('show');
                }

            }
        });


    }
</script>
<script type="text/javascript">

  
  $(function() {
  var $tabButtonItem = $('#tab-button li'),
      $tabSelect = $('#tab-select'),
      $tabContents = $('.tab-contents'),
      activeClass = 'is-active';

  $tabButtonItem.first().addClass(activeClass);
  $tabContents.not(':first').hide();

  $tabButtonItem.find('a').on('click', function(e) {
    var target = $(this).attr('href');

    $tabButtonItem.removeClass(activeClass);
    $(this).parent().addClass(activeClass);
    $tabSelect.val(target);
    $tabContents.hide();
    $(target).show();
    e.preventDefault();
  });

  $tabSelect.on('change', function() {
    var target = $(this).val(),
        targetSelectNum = $(this).prop('selectedIndex');

    $tabButtonItem.removeClass(activeClass);
    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
    $tabContents.hide();
    $(target).show();
  });
});





/*Wow Js animation*/
  new WOW().init();
</script>



<!-- ***************************************Start the Footer************************************************ -->

@include('front.incliude.footer')