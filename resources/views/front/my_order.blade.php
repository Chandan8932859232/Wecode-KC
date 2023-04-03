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
            <?php if(isset($_GET['course'])){ ?>
            <li class="active"><a href="#">My Courses</a></li>
        <?php }else{ ?>
            <li class="active"><a href="#">My Orders</a></li>
        <?php } ?>
        </ul>
        <?php if(isset($_GET['course'])){ ?>
        <h2 class="inner-banner__title">My Courses</h2>
    <?php }else{ ?>
        <h2 class="inner-banner__title">My Orders</h2>
    <?php } ?>
    </div>
</section>


<div class="divider-line"></div>


<section class="about-two">

    <div class="container">

        <div class="row">

        	<div class="col-xl-12">
                <?php if(isset($_GET['course'])){ ?>
                <!-- my course -->
                <table class="table table-bordered table-responsive">

                    <thead>
                        <th>Course</th>
                        <th>Title</th>
                        <th>Order Date</th>
                    </thead>

                    <tbody>

                        <?php foreach($my_order as $value){

                        $course_title = DB::table('tbl_course')->where(['id'=>$value->course_id])->first();

                       ?>

                        <tr>

                            <td><img src="{{url('public/upload/course_image/'.$course_title->image)}}" width="100px" height="100px"></td>

                            <td><a href="{{url('/course_details?key='.base64_encode($value->course_id))}}">{{$course_title->course_title}}</a></td>
                            <td>{{$value->created_at}}</td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

                <!-- my course -->
                <?php }else{ ?>

                <table class="table table-bordered table-responsive">

                    <thead>

                        <th>Order Id</th>

                        <th>Course</th>

                        <th>Title</th>

                        <th>Price</th>

                        <th>Order Date</th>

                        <th>Payment Status</th>

                    </thead>

                    <tbody>

                        <?php foreach($my_order as $value){

                        $course_title = DB::table('tbl_course')->where(['id'=>$value->course_id])->first();

                       ?>

                        <tr>

                            <td>{{$value->order_id}}</td>

                            <td><img src="{{url('public/upload/course_image/'.$course_title->image)}}" width="100px" height="100px"></td>

                            <td><a href="{{url('/course_details?key='.base64_encode($value->course_id))}}">{{$course_title->course_title}}</a></td>

                            <td>${{$value->total_amount}}</td>

                            <td>{{$value->created_at}}</td>

                            <td><?php if($value->payment_status==1){ echo "Paid"; }else{ echo "Failed";} ?></td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>
            <?php } ?>

        		

        	</div>

        	

        </div>

    </div>

</section>



<!-- ***************************************Start the Footer************************************************ -->

@include('front.incliude.footer')

