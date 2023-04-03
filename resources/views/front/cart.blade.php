@include('front.incliude.header')

<style type="text/css">

    

.bannerUpcontant {

    position: absolute;

    top: 33%;

    left: 10%;

    width: 80%;

}

.page-main-banner {

    width: 100%;

    float: left;

    height: auto;

    overflow: hidden;

}

.page-main-banner img {

    width: 100%;

    height: 250px;

}

.form-signup{border: 1px solid #8e8585;

    padding: 27px;}

.total-amount{font-size: 20px;

    font-weight: 600;}

    .price-total{font-size: 20px;

    font-weight: 600;}

</style>



  <section class="inner-banner">

    <div class="container">

        <ul class="list-unstyled thm-breadcrumb">

            <li><a href="{{url('/')}}">Home</a></li>

            <li class="active"><a href="#">Cart List</a></li>

        </ul>

        <h2 class="inner-banner__title">Cart List</h2>

    </div>

</section>







<section class="about-two">

            <div class="container">

                <div class="row">

                    <div class="col-xl-12  wow fadeInDown" data-wow-duration="2s" data-wow-delay=".5s">

                      <div class="form-signup">

                        <?php if(count($my_cart)!=0){ ?>

                        <table class="table table-bordered table-responsive">

                          <thead>

                            <tr>

                              <th>#</th>

                              <th>Image</th>

                              <th>Course</th>

                              <th>Price</th>

                              <th></th>

                            </tr>

                          </thead>

                          <tbody>

                            <?php $total_price = 0; $i =1; foreach($my_cart as $value){

                              $course_title = DB::table('tbl_course')->where(['id'=>$value->course_id])->first();

                              $total_price=$total_price+$course_title->price;

                            ?>

                            <tr>

                              <td>{{$i}}</td>

                              <td><img src="{{url('public/upload/course_image/'.$course_title->image)}}" width="100px" height="100px"></td>

                              <td>{{$course_title->course_title}}</td>

                              <td>${{$course_title->price}}</td>

                              <td class="pull-center"><a data-cartid="{{$value->id}}" onclick="delete_cart(this)" href="#" class="remove"><i class="fa fa-trash"></i></a></td>

                            </tr>

                            <?php $i++; } ?>



                          </tbody>

                        </table>



                        <table class="table table-responsive">

                          <tr>

                            <td><a href="{{url('/')}}" class="btn btn-primary">Continue Shopping</a></td>

                            <td></td>

                            <td></td>

                            <td class="pull-right"><span class="total-amount">Total Amount</span></td>

                            <td><span class="price-total">${{$total_price}}</span></td>

                          </tr>

                          <tr>

                            <td></td>

                            <td></td>

                            <td></td>

                            <td class="pull-right"><a href="{{url('/check_out')}}" class="btn btn-success">Checkout</a></td>

                            

                          </tr>

                          

                        </table>

                      <?php }else{ ?>

                        <a href="{{url('/')}}" class="btn btn-primary">Continue Shopping</a>

                      <?php } ?>

                        

                      </div>

                    </div>

                    

                </div>

            </div>

        </section>

        <script type="text/javascript">

      function delete_cart(th){

        var id = $(th).data('cartid');

        var token = "<?php echo csrf_token(); ?>";

        if(confirm('Are you Sure?')){

          $.ajax({

            type:'Post',

            url:"{{url('/delete_cart')}}",

            data:{id:id,_token:token},

            success:function(data){

              $('#myModaldeletecart').modal('show')

            }

          });

        }

      }

    </script>

        



       



















<!-- ***************************************Start the Footer************************************************ -->

@include('front.incliude.footer')

