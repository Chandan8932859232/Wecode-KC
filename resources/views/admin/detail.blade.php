@include('admin.include.header')
<style type="text/css">
    .overview-wrap{color:#fff;}
    .lecture_title{border: 1px solid gray;
    background-color: lightsteelblue;
    padding: 6px;}
</style>
<!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                        <!-- <div class="overview-wrap">
                            <a href="{{url('admin/add_curriculum?keys='.$_GET['key'])}}" class="btn btn-success">Add Curriculum</a>
                        </div> -->
                        <h2 class="text-center">{{$heading}}</h2>
                        
                        <div class="row m-t-30">
                            
                            
                            <div class="col-md-12">
                              <h3 class="lecture_title text-center">{{$lecture->title}}</h3>
                              <p style="padding-top: 25px"><?=$lecture->content?></p>

                                
                            </div>
                        </div>
                        
@include('admin.include.footer')