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

                                <th>User Name</th>

                                <th>Email</th>

                                <th>Course</th>

                                <th>Total Amount</th>



                            </tr>

                        </thead>

                        <tbody>

                          @foreach($enroll_history as $value)
                          <?php
                          $user = DB::table('tbl_user')->where('id','=',$value->user_id)->first();

                            // echo "<pre>"; print_r($user);die();

                          $course = DB::table('tbl_order')->where('user_id','=',$value->user_id)->get();
                          $course_title = DB::table('tbl_course')->where('instructor_id','=',$value->course_id)->get();

                          $total_amount = 0;
                          $total_amount=$total_amount+$value->total_amount;

                            for ($i=0;$i<count($course_title);$i++)
                            {
                                $a = $course_title[$i]->course_title;
                          ?>
                          <tr>

                            <td>{{$user->fname.' '.$user->lname}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$a}}</td>
                            <td>${{$total_amount}}</td>

                          </tr>
                          <?php }?>
                          @endforeach



                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>

@include('admin.include.footer')
