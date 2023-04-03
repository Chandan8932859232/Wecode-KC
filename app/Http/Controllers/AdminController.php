<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AdminModel;
use Session;
use App;
use File;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Cookie;
use Illuminate\Support\Facades\DB;
// use DB;




class AdminController extends Controller
{
	public function __construct(Request $request)
	{
		//$language =$request->session()->get('language');
		//echo $language;
		//App::setLocale('je');
	}
	public function index(Request $request)
	{
		$data = array();
		$data['title'] = "Admin Login";
        $data['drphilipuser_name'] = $request->cookie('drphilipuser_name');
        $data['drphilippassword'] = $request->cookie('drphilippassword');
        $data['drphiliprem'] = $request->cookie('drphiliprem');
		return view('admin/login',$data);
	}
	public function adminLogin(Request $request)
	{
		$user = new AdminModel();
		//print_r($request->input('username'));
		$validateArguement = array(
									'username' => 'required',
								    'password' => 'required',
								);
		$request->validate($validateArguement);

		$username = $request->input('username');
		$password = $request->input('password');
		$password = md5($password);
        $remember_me = $request->remember_me;

        //echo $remember_me;
        //die;
        //$remember_me = $request->has('remember_me') ? true : false;
		$result = $user->adminlogin($username,$password);
		//echo "<pre>";print_r($result->count());
		if($result->count()>0)
		{
            if($remember_me==1){

                 $minutes = "360";
                 Cookie::queue(Cookie::make('drphilipuser_name', $username, $minutes));
                 Cookie::queue(Cookie::make('drphilippassword', $request->input('password'), $minutes));
                 Cookie::queue(Cookie::make('drphiliprem', $remember_me, $minutes));

            }else{
                Cookie::queue(Cookie::forget('drphilipuser_name'));
                Cookie::queue(Cookie::forget('drphilippassword'));
                Cookie::queue(Cookie::forget('drphiliprem'));
            }
			//echo "<pre>"; print_r($result->first());
			$row = $result->first();
			$adminUser =  $row->email;
			$adminPassword =  $row->password;
			$adminFirstName = $row->name;

			$adminProfile = $row->profile_image;
			//echo $adminPassword;

			$request->session()->put('adminUser', $adminUser);
			$request->session()->put('adminPassword', $adminPassword);
			$request->session()->put('adminFirstName', $adminFirstName);
			$request->session()->put('drph_admin_id',$row->id);
			return redirect('admin/dashboard');
		}
		else
		{
			Session::flash('message', 'Invalid Credentials');
    		return redirect('/admin');
		}

	}

	function dashboard()
	{
		$data = array();
        $record_array = array();
		$data['title'] = 'Home';
        $data['active'] = "home";
        $current_date = date('Y-m-d');
        $data['total_member'] = DB::table('tbl_user')->where(['status'=>1])->count();
        $data['total_course'] = DB::table('tbl_course')->where(['status'=>1])->count();
        $data['total_amount_month'] = DB::select("SELECT sum(total_amount) as total_price from tbl_order where MONTH('$current_date')");
        $data['total_amount'] = DB::select("SELECT sum(total_amount) as total_price from tbl_order ");
        //print_r($data['total_amount_month'][0]->total_price);
        //die;
        return view('admin/dashboard',$data);
	}
    function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/admin');
    }

    /*instructor*/
    function instructor(){
        $data['title'] = 'Instructor';
        $data['active'] = "instructor";
        $data['instructor'] = DB::table('tbl_instructor')->get();
        return view('admin/instructor',$data);
    }
    function add_instruction(Request $request){
        $data['title'] = 'Instructor';
        $data['active'] = "instructor";
        $key = base64_decode($request->key);
        $data['instructor'] = DB::table('tbl_instructor')->where(['id'=>$key])->first();

        return view('admin/add_instruction',$data);
    }
    function insert_instructor(Request $request){
        $name = $request->name;
        $password = $request->password;
        $description = $request->description;
        //$image = $request->image;
        $created_at = date('Y-m-d H:s:i');

        $check_name = DB::table('tbl_instructor')->where(['name'=>$name])->count();
        if($check_name == 0){
            if($request->hasFile('image')){
                $image = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/instructor_image'), $image);
            }else{
                $image = "";
            }
            $insert = array(
                'name'=>$name,
                'password'=>$password,

                'description'=>$description,
                'image'=>$image,
                'created_at'=>$created_at,
            );
            DB::table('tbl_instructor')->insert($insert);
            echo "done";
        }else{
            echo "name_err";
        }

    }

    function update_instructor(Request $request){
        $name = $request->name;
        $password = $request->password;
        $description = $request->description;
        $instructor_id = $request->instructor_id;
        $instructor_image = $request->instructor_image;
        $created_at = date('Y-m-d H:s:i');
        $check_name = DB::table('tbl_instructor')
        ->where('name','=',$name)
        ->where('id','!=',$instructor_id)
        ->count();
        if($check_name == 0){
            if($request->hasFile('image')){
                $image = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/instructor_image'), $image);
            }else{
                $image = $instructor_image;
            }
            $insert = array(
                'name'=>$name,
                'password'=>$password,
                'description'=>$description,
                'image'=>$image,
                'created_at'=>$created_at,
            );
            DB::table('tbl_instructor')->where('id',$instructor_id)->update($insert);
            echo "done";
        }else{
            echo "name_err";
        }
    }

    function delete_instructor(Request $request){
        $id = $request->id;
        $update = array(
            'status'=>0,
        );

        DB::table('tbl_instructor')->where('id',$id)->delete();

        DB::table('tbl_instructor')->where('id',$id)->update($update);
        echo "done";
    }

    /*instructor*/
    /*course*/
    function course(){
        $data['title'] = 'course';
        $data['active'] = "course";
         $data['course'] = DB::table('tbl_course')->where(['status'=>1])->get();
        return view('admin/course',$data);
    }

    function add_course(Request $request){
        $data['title'] = 'Add Course';
        $data['active'] = "course";
        $key = base64_decode($request->key);



        $data['course'] = DB::table('tbl_course')->where(['id'=>$key])->first();
        $data['instructor'] = DB::table('tbl_instructor')->where(['status'=>1])->get();

        return view('admin/add_course',$data);
        // return redirect('admin/dashboard');


    }

    function insert_course(Request $request){
       $instructor_id = $request->instructor_id;
       $course_title = $request->course_title;
       $class_duration = $request->class_duration;
       $tools = $request->tools;
       $class_level = $request->class_level;
       $description = $request->description;
       $achivement = $request->achivement;



       $price = $request->price;
       $created_at = date('Y-m-d H:s:i');
       $check_name = DB::table('tbl_course')->where(['course_title'=>$course_title])->count();
       if($check_name==0){
            if($request->hasFile('image'))
            {

               $image = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/course_image'), $image);
            }
            else
            {
                $image = "";
            }
        $insert = array(
            'instructor_id'=>$instructor_id,
            'course_title'=>$course_title,

            'class_duration'=>$class_duration,
            'tools'=>$tools,
            'class_level'=>$class_level,
            'achivement'=>$achivement,

            'description'=>$description,
            'price'=>$price,
            'image'=>$image,
            'status'=>1,
            'created_at'=>$created_at,
        );
        DB::table('tbl_course')->insert($insert);
        echo "done";
       }else{
        echo "name_err";
       }
    }

    function update_course(Request $request){
        $instructor_id = $request->instructor_id;
        $course_title = $request->course_title;

        $class_duration = $request->class_duration;
        $tools = $request->tools;

        $class_level = $request->class_level;
        $achivement = $request->achivement;


        $description = $request->description;
        $price = $request->price;
        $course_id = $request->course_id;
        $course_image = $request->course_image;
        $created_at = date('Y-m-d H:s:i');
        $check_name = DB::table('tbl_course')
        ->where('course_title','=',$course_title)
        ->where('id','!=',$course_id)
        ->count();
       if($check_name==0){
            if($request->hasFile('image')){
                $image = time().'.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/course_image'), $image);
            }else{
                $image = $course_image;
            }
        $insert = array(
            'instructor_id'=>$instructor_id,
            'course_title'=>$course_title,

            'class_duration'=>$class_duration,
            'tools'=>$tools,
            'class_level'=>$class_level,

            'achivement'=>$achivement,

            'description'=>$description,
            'price'=>$price,
            'image'=>$image,
            'created_at'=>$created_at,
        );
        DB::table('tbl_course')->where('id',$course_id)->update($insert);
        echo "done";
       }else{
        echo "name_err";
       }
    }

    function delete_course(Request $request){
        $id = $request->id;
        $update = array(
            'status'=>0,

        );
        echo "done";



        DB::table('tbl_course')->where('id',$id)->update($update);

    }

    function curriculum(){
        $data['title'] = 'curriculum';
        $data['active'] = "curriculum";
         $data['curriculum'] = DB::table('tbl_curriculum')->where(['status'=>1])->get();
        return view('admin/curriculum',$data);
    }

    function add_curriculum(Request $request){
        $data['title'] = 'Add curriculum';
        $data['active'] = "course";
        if(isset($_GET['id'])){
            $id = base64_decode($request->id);
            $data['heading'] = DB::table('tbl_curriculum')->where('id','=',$id)->first()->heading;

        }
        if(isset($_GET['lecture'])){
            $lecture_id = base64_decode($request->lecture);
            $data['lecture'] = DB::table('tbl_lecture')->where('id','=',$lecture_id)->first();
        }
        if(isset($_GET['key'])){
            $key = base64_decode($request->key);
            $data['curriculum'] = DB::table('tbl_curriculum')->where('id','=',$key)->first();
        }
        //$key = base64_decode($request->key);
        /*$data['course'] = DB::table('tbl_course')->where(['id'=>$key])->first();
        $data['instructor'] = DB::table('tbl_instructor')->where(['status'=>1])->get();*/
        return view('admin/add_curriculum',$data);
    }

    function insert_curriculum(Request $request){
        $course_id = base64_decode($request->course_id);
        $curriculum_id = base64_decode($request->curriculum_id);
        $heading = $request->heading;
        $title = $request->title;
        $time_duration = $request->time_duration;


        $preview = $request->preview;
        $content = $request->contents;
        $created_at = date('Y-m-d H:s:i');
        // $check_name = DB::table('tbl_curriculum')->where('heading','=',$heading)->count();
        if($curriculum_id==''){
            $insert = array(
                'course_id'=>$course_id,
                'heading'=>$heading,
                'status'=>1,
                'time_duration'=>$time_duration,

                'created_at'=>$created_at,
            );
           $last_id = DB::table('tbl_curriculum')->insertGetId($insert);

            $insert_lecture = array(
                'curriculum_id'=>$last_id,
                'title'=>$title,
                'time_duration'=>$time_duration,


                'content'=>$content,
                'preview'=>$preview,
                'created_at'=>$created_at,
            );



            DB::table('tbl_lecture')->insert($insert_lecture);
            echo "done";
        }else{
            $insert_lecture = array(
                'curriculum_id'=>$curriculum_id,
                'title'=>$title,
                'time_duration'=>$time_duration,


                'content'=>$content,
                'preview'=>$preview,
                'created_at'=>$created_at,
            );
            DB::table('tbl_lecture')->insert($insert_lecture);
            echo "done";

        }



    }
    function lecture_detail(Request $request){
        $data['title'] = 'Lecture Detail';
        $data['active'] = "course";

        $key = base64_decode($request->key);
        $data['lecture'] = DB::table('tbl_lecture')->where(['curriculum_id'=>$key,'status'=>1])->get();
        $data['heading'] = DB::table('tbl_curriculum')->where(['id'=>$key])->first()->heading;

        return view('admin/lecture_detail',$data);
    }
    function detail(Request $request){
        $data['title'] = 'Lecture Detail';
        $data['active'] = "course";

        $key = base64_decode($request->key);
        $data['lecture'] = DB::table('tbl_lecture')->where(['id'=>$key])->first();
        $c_id = $data['lecture']->curriculum_id;
        $data['heading'] = DB::table('tbl_curriculum')->where(['id'=>$c_id])->first()->heading;

        return view('admin/detail',$data);
    }

    function update_lecture(Request $request){
        $title = $request->title;
        $preview = $request->preview;
        $content = $request->contents;
        $lecture_id = $request->lecture_id;

        $insert = array(
            'title'=>$title,
            'content'=>$content,
            'preview'=>$preview,
        );
        DB::table('tbl_lecture')->where('id',$lecture_id)->update($insert);
        echo "done";

    }

    function delete_lecture(Request $request){
        $id = $request->id;
        $insert = array(
            'status'=>0,
        );
        echo "done";
        DB::table('tbl_lecture')->where('id',$id)->update($insert);
    }

    function update_curriculum_heading(Request $request){
        $heading = $request->heading;
        $c_id = $request->c_id;
        $update = array(
            'heading'=>$heading,
        );
        DB::table('tbl_curriculum')->where('id',$c_id)->update($update);
        echo "done";
    }

    function delete_curriculum(Request $request){
        $id = $request->id;
        $insert = array(
            'status'=>0,
        );
        echo "done";
        DB::table('tbl_curriculum')->where('id',$id)->update($insert);
        DB::table('tbl_lecture')->where('curriculum_id',$id)->update($insert);
    }

    /*course*/

    /*product*/
    function product(){
        $data['title'] = 'Product';
        $data['active'] = "product";
        $data['product'] = DB::table('tbl_product')->where(['status'=>1])->get();

        /*$key = base64_decode($request->key);
        $data['sub_category'] = DB::table('tbl_sub_category')->where(['id'=>$key])->first();
        $data['category'] = DB::table('tbl_category')->where(['status'=>1])->get();*/
        return view('admin/product',$data);
    }

    function add_product(Request $request){
        $data['title'] = 'Product';
        $data['active'] = "product";
        $key = base64_decode($request->key);
        $data['product'] = DB::table('tbl_product')->where(['id'=>$key])->first();
        $data['product_image'] = DB::table('tbl_product_image')->where(['product_id'=>$key])->get();
        $data['sub_category'] = DB::table('tbl_sub_category')->where(['status'=>1])->get();
        $data['category'] = DB::table('tbl_category')->where(['status'=>1])->get();
        return view('admin/add_product',$data);
    }
    function insert_product(Request $request){
        /*$category_id = $request->category_id;
        $sub_category_id = $request->sub_category_id;*/
        $product_name = $request->product_name;
        $product_price = $request->product_price;
        $product_quantity = $request->product_quantity;
        $product_description = $request->product_description;
        $product_size = $request->product_size;
        $created_at = date('Y-m-d H:s:i');
        $check_name = DB::table('tbl_product')->where(['product_name'=>$product_name])->count();
        if($check_name=="0"){
            $insert = array(
                'category_id'=>0,
                'sub_category_id'=>0,
                'product_name'=>$product_name,
                'product_size'=>$product_size,
                'product_price'=>$product_price,
                'product_quantity'=>$product_quantity,
                'product_remaining_quantity'=>$product_quantity,
                'product_description'=>$product_description,
                'status'=>1,
                'created_at'=>$created_at,
            );
            $last_id = DB::table('tbl_product')->insertGetId($insert);
            /*image upload*/
            $images=array();

            if($files=$request->file('product_image')){

                foreach($files as $file){

                    $name=time().'.'.$file->getClientOriginalName();

                    $file->move(public_path('upload/product_image'),$name);

                    $images[]=$name;

                    /*Insert your data*/

                    $insert_image = array(

                        'product_id'=>$last_id,
                        'product_image'=>$name,
                        'created_at'=>$created_at,

                    );

                    DB::table('tbl_product_image')->insert($insert_image);


                }

            }
            /*image upload*/
            echo "done";
        }else{
            echo "name_err";
        }

    }

    function update_product(Request $request){
        $product_id = $request->product_id;
        /*$category_id = $request->category_id;
        $sub_category_id = $request->sub_category_id;*/
        $product_name = $request->product_name;
        $product_price = $request->product_price;
        $product_quantity = $request->product_quantity;
        $product_description = $request->product_description;
        $product_size = $request->product_size;
        $created_at = date('Y-m-d H:s:i');
        $check_name = DB::table('tbl_product')->where(['product_name'=>$product_name])->count();
        //if($check_name=="0"){
            $insert = array(
                /*'category_id'=>$category_id,
                'sub_category_id'=>$sub_category_id,*/
                'product_name'=>$product_name,
                'product_size'=>$product_size,
                'product_price'=>$product_price,
                'product_quantity'=>$product_quantity,
                'product_remaining_quantity'=>$product_quantity,
                'product_description'=>$product_description,
                'status'=>1,
                'created_at'=>$created_at,
            );
            DB::table('tbl_product')->where('id',$product_id)->update($insert);
            /*image upload*/
            $images=array();

            if($files=$request->file('product_image')){

                foreach($files as $file){

                    $name=time().'.'.$file->getClientOriginalName();

                    $file->move(public_path('upload/product_image'),$name);

                    $images[]=$name;

                    /*Insert your data*/

                    $insert_image = array(

                        'product_id'=>$product_id,
                        'product_image'=>$name,
                        'created_at'=>$created_at,

                    );

                    DB::table('tbl_product_image')->insert($insert_image);


                }

            }
            /*image upload*/
            echo "done";
        /*}else{
            echo "name_err";
        }*/
    }

    function product_detail(Request $request){
        $data['title'] = 'Product';
        $data['active'] = "product";
        $key = base64_decode($request->key);
        $data['product'] = DB::table('tbl_product')->where(['id'=>$key])->first();
        $data['product_image'] = DB::table('tbl_product_image')->where(['product_id'=>$key])->get();

        return view('admin/product_detail',$data);
    }

    function delete_product(Request $request){
        $id = $request->id;
        $update = array(
            'status'=>2
        );
        DB::table('tbl_product')->where('id',$id)->update($update);

    }

    /*product*/

    /*user list*/
    function get_subcategory(Request $request){
        $id = $request->category_id;
        $query = DB::table('tbl_sub_category')->where(['category_id'=>$id,'status'=>1])->get();
        foreach($query as $value){
            echo "<option value='".$value->id."'>".$value->name."</option>";
        }
    }

    function users_list(Request $request){
        $data['title'] = 'User List';
        $data['active'] = "user_list";
        $data['users'] = DB::table('tbl_user')->where('status','!=',0)->get();
        return view('admin/user_list',$data);
    }

    function change_user_status(Request $request){
        $id = $request->id;
        $status = $request->status;
        $update = array(
            'status'=>$status,
        );
        DB::table('tbl_user')->where('id',$id)->update($update);

    }
    /*user list*/

    /*about*/
    function about(Request $request){
        $data['title'] = 'About';
        $data['active'] = "page";
        $data['about'] = DB::table('tbl_about')->get();
        return view('admin/about',$data);
    }
    function update_about(Request $request){
        $data['title'] = 'About';
        $data['active'] = "page";
        $key = base64_decode($request->key);
        $data['about'] = DB::table('tbl_about')->where(['id'=>$key])->first();
        return view('admin/update_about',$data);
    }
    function updateabout(Request $request){
        $heading = $request->heading;
        $content = $request->content_text;
        $blogimg = $request->blogimg;
        $blog_id = $request->blog_id;
        $blog_video = $request->blog_video;
        if($request->hasFile('blog_image')){
            $blog_image = time().'.'.request()->blog_image->getClientOriginalExtension();
            request()->blog_image->move(public_path('upload/about_image'), $blog_image);

        }else{
            $blog_image = $blogimg;
        }

        $insert = array(
            'heading'=>$heading,
            'content'=>$content,
            'image'=>$blog_image,
            'video'=>$blog_video,
        );
        DB::table('tbl_about')->where('id',$blog_id)->update($insert);
        echo "done";
    }
    function about_detail(Request $request){
        $data['title'] = 'About';
        $data['active'] = "about";
        $key = base64_decode($request->key);
        $data['about'] = DB::table('tbl_about')->where(['id'=>$key])->first();
        return view('admin/about_detail',$data);
    }

    /*about*/

    /*blog*/
    function blog(Request $request){
        $data['title'] = 'Blog';
        $data['active'] = "page";
        $data['blog'] = DB::table('tbl_blog')->get();
        return view('admin/blog',$data);
    }

    function add_blog(Request $request){
        $data['title'] = 'Blog';
        $data['active'] = "page";
        $id = base64_decode($request->key);
        $data['blog'] = DB::table('tbl_blog')->where(['id'=>$id])->first();
        return view('admin/add_blog',$data);
    }
    function insert_blog(Request $request){
        $heading = $request->heading;
        $content = $request->content_text;
        //$blog_image = $request->blog_image;
        if($request->hasFile('blog_image')){
            $blog_image = time().'.'.request()->blog_image->getClientOriginalExtension();
            request()->blog_image->move(public_path('upload/blog_image'), $blog_image);

        }else{
            $blog_image="";
        }
        $insert = array(
            'blog_heading'=>$heading,
            'content'=>$content,
            'blog_image'=>$blog_image,
            'created_at'=>date('Y-m-d H:s:i'),
        );
        DB::table('tbl_blog')->insert($insert);
        echo "done";
    }

    function update_blog(Request $request){
        $heading = $request->heading;
        $content = $request->content_text;
        $blogimg = $request->blogimg;
        $blog_id = $request->blog_id;
        if($request->hasFile('blog_image')){
            $blog_image = time().'.'.request()->blog_image->getClientOriginalExtension();
            request()->blog_image->move(public_path('upload/blog_image'), $blog_image);

        }else{
            $blog_image = $blogimg;
        }
        $insert = array(
            'blog_heading'=>$heading,
            'content'=>$content,
            'blog_image'=>$blog_image,

        );
        DB::table('tbl_blog')->where('id',$blog_id)->update($insert);
        echo "done";
    }

    function delete_blog(Request $request){
        $id = $request->id;
        DB::table('tbl_blog')->where('id',$id)->delete();

        echo "done";
    }

    function blog_detail(Request $request){
        $data['title'] = 'Blog Detail';
        $data['active'] = "page";
        $id = base64_decode($request->key);
        $data['blog'] = DB::table('tbl_blog')->where(['id'=>$id])->first();
        return view('admin/blog_detail',$data);
    }

    /*blog*/

    /*team*/
    function team(Request $request){
        $data['title'] = 'Team';
        $data['active'] = "team";
        $data['team'] = DB::table('tbl_team')->get();
        return view('admin/team',$data);
    }
    function add_team(Request $request){
        $data['title'] = 'Team';
        $data['active'] = "team";
        $key = base64_decode($request->key);
        $data['team'] = DB::table('tbl_team')->where('id',$key)->first();
        return view('admin/add_team',$data);
    }
    function insert_team(Request $request){
        $name = $request->name;
        $designation = $request->designation;
        $facebook_link = $request->facebook_link;
        $google_link = $request->google_link;
        $twitter_link = $request->twitter_link;
        $linkedin_link = $request->linkedin_link;
        if($request->hasFile('image')){
            $image = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/team_image'), $image);

        }else{
            $image = "";
        }

        $insert = array(
            'name'=>$name,
            'designation'=>$designation,
            'facebook_link'=>$facebook_link,
            'google_link'=>$google_link,
            'twitter_link'=>$twitter_link,
            'linkedin_link'=>$linkedin_link,
            'image'=>$image,
        );
        DB::table('tbl_team')->insert($insert);
        echo "done";
    }

    function update_team(Request $request){
        $name = $request->name;
        $designation = $request->designation;
        $facebook_link = $request->facebook_link;
        $google_link = $request->google_link;
        $twitter_link = $request->twitter_link;
        $linkedin_link = $request->linkedin_link;
        $team_id = $request->team_id;
        $team_image = $request->team_image;
        if($request->hasFile('image')){
            $image = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/team_image'), $image);

        }else{
            $image = $team_image;
        }

        $insert = array(
            'name'=>$name,
            'designation'=>$designation,
            'facebook_link'=>$facebook_link,
            'google_link'=>$google_link,
            'twitter_link'=>$twitter_link,
            'linkedin_link'=>$linkedin_link,
            'image'=>$image,
        );
        DB::table('tbl_team')->where('id',$team_id)->update($insert);
        echo "done";
    }

    function delete_team(Request $request){
        $id = $request->id;
        DB::table('tbl_team')->where('id',$id)->delete();

    }

    /*team*/

    /*FAQ*/
    function faq(Request $request){
        $data['title'] = 'FAQ';
        $data['active'] = "faq";
        $data['faq'] = DB::table('tbl_faq')->get();
        return view('admin/faq',$data);
    }

    function add_faq(Request $request){
        $data['title'] = 'FAQ';
        $data['active'] = "faq";
        $key = base64_decode($request->key);
        $data['faq'] = DB::table('tbl_faq')->where(['id'=>$key])->first();
        return view('admin/add_faq',$data);
    }

    function insert_faq(Request $request){
        $heading = $request->heading;
        $content = $request->content_text;

        $insert = array(
            'question'=>$heading,
            'answer'=>$content,
            'created_at'=>date('Y-m-d H:s:i'),
        );
        DB::table('tbl_faq')->insert($insert);
        echo "done";
    }

    function update_faq(Request $request){
        $heading = $request->heading;
        $content = $request->content_text;
        $faq_id = $request->faq_id;

        $insert = array(
            'question'=>$heading,
            'answer'=>$content,
            'created_at'=>date('Y-m-d H:s:i'),
        );
        DB::table('tbl_faq')->where('id', $faq_id)->update($insert);
        echo "done";
    }
    function delete_faq(Request $request){
        $id = $request->id;
        DB::table('tbl_faq')->where('id',$id)->delete();
    }

    /*FAQ*/

    /*slider*/
     function slider(Request $request){
        $data['title'] = 'Slider';
        $data['active'] = "slider";
        $data['slider'] = DB::table('tbl_slider')->get();
        return view('admin/slider',$data);
    }

    function add_slider(Request $request){
        $data['title'] = 'Slider';
        $data['active'] = "slider";
        $key = base64_decode($request->key);
        $data['slider'] = DB::table('tbl_slider')->where(['id'=>$key])->first();
        return view('admin/add_slider',$data);
    }

    function insert_slider(Request $request){
        $heading = $request->heading;
        $sub_heading = $request->sub_heading;

        if($request->hasFile('slider_image')){
            $slider_image = time().'.'.request()->slider_image->getClientOriginalExtension();
            request()->slider_image->move(public_path('upload/slider_image'), $slider_image);

        }
        $insert = array(
            'text'=>$sub_heading,
            'slider_image'=>$slider_image,
            'heading'=>$heading,
            'created_at'=>date('Y-m-d H:s:i'),
        );
        DB::table('tbl_slider')->insert($insert);
        echo "done";
    }

    function update_slider(Request $request){
        $heading = $request->heading;
        $sub_heading = $request->sub_heading;
        $slider_id = $request->slider_id;

        if($request->hasFile('slider_image')){
            $slider_image = time().'.'.request()->slider_image->getClientOriginalExtension();
            request()->slider_image->move(public_path('upload/slider_image'), $slider_image);

        }else{
            $slider_image = $request->slideimg;
        }
        $insert = array(
            'text'=>$sub_heading,
            'slider_image'=>$slider_image,
            'heading'=>$heading,
        );
        DB::table('tbl_slider')->where('id',$slider_id)->update($insert);
        echo "done";
    }

    function delete_slider(Request $request){
        $id = $request->id;
        DB::table('tbl_slider')->where('id',$id)->delete();
    }

    /*slider*/

    /*section*/
    function section_one(Request $request){
        $data['title'] = 'Section';
        $data['active'] = "slider";
        $data['web'] = DB::table('tbl_web')->get();
        return view('admin/section_one',$data);
    }

    function update_section(Request $request){
        $data['title'] = 'Section';
        $data['active'] = "slider";
        $key = base64_decode($request->key);
        $data['web'] = DB::table('tbl_web')->where(['id'=>$key])->first();
        return view('admin/update_section',$data);
    }

    function updatesection(Request $request){
        $heading = $request->heading;
        $sub_heading = $request->sub_heading;
        $slider_id = $request->slider_id;
        if($request->hasFile('background_image')){
            $background_image = time().'.'.request()->background_image->getClientOriginalExtension();
            request()->background_image->move(public_path('upload/web_image'), $background_image);

        }else{
            $background_image = $request->backimg;
        }

        $insert = array(
            'text'=>$sub_heading,
            'image'=>$background_image,
            'heading'=>$heading,
        );
        DB::table('tbl_web')->where('id',$slider_id)->update($insert);
        echo "done";
    }
    /*section*/

    /*testimonial*/
    function testimonial(Request $request){
        $data['title'] = 'Testimonial';
        $data['active'] = "testimonial";
        $data['testimonial'] = DB::table('tbl_testimonial')->get();
        return view('admin/testimonial',$data);
    }

    function add_testimonial(Request $request){
        $data['title'] = 'Testimonial';
        $data['active'] = "testimonial";
        $key = base64_decode($request->key);
        $data['testimonial'] = DB::table('tbl_testimonial')->where(['id'=>$key])->first();
        return view('admin/add_testimonial',$data);
    }

    function insert_testimonial(Request $request){
        $heading = $request->heading;
        $content = $request->content_text;
        $designation = $request->designation;

        $insert = array(
            'name'=>$heading,
            'text'=>$content,
            'designation'=>$designation,
            'image'=>0,
            'created_at'=>date('Y-m-d H:s:i'),
        );
        DB::table('tbl_testimonial')->insert($insert);
        echo "done";
    }

    function delete_testimonial(Request $request){
        $id = $request->id;

        DB::table('tbl_testimonial')->where('id',$id)->delete();
        echo "done";
    }

    function update_testimonial(Request $request){
        $heading = $request->heading;
        $content = $request->content_text;
        $blogimg = $request->blogimg;
        $blog_id = $request->blog_id;
        $designation = $request->designation;

        $insert = array(
            'name'=>$heading,
            'text'=>$content,
            'designation'=>$designation,
            'image'=>0,
        );

        DB::table('tbl_testimonial')->where('id',$blog_id)->update($insert);
        echo "done";
    }
    /*testimonial*/

    /*Contact Page*/
    function contact_page(Request $request){
        $data['title'] = 'Contact';
        $data['active'] = "page";
        $data['contact'] = DB::table('tbl_contact')->get();
        return view('admin/contact_page',$data);
    }

    function update_contact(Request $request){
        $data['title'] = 'Contact';
        $data['active'] = "page";
        $data['contact'] = DB::table('tbl_contact')->where(['id'=>1])->first();
        return view('admin/update_contact',$data);
    }

    function updatecontact(Request $request){
       $address = $request->address;
       $email = $request->email;
       $phone_number = $request->phone_number;
       $receiveremail = $request->receiveremail;
       $facebook = $request->facebook;
       $twitter = $request->twitter;
       $youtube = $request->youtube;
       $instagram = $request->instagram;
       $linkedin = $request->linkedin;
       $start_day = 0;
       $end_day = 0;
       $start_time = 0;
       $end_time = 0;
       $update = array(
            'address'=>$address,
            'email'=>$email,
            'phone_no'=>$phone_number,
            'receive_email'=>$receiveremail,
            'facebook'=>$facebook,
            'twitter'=>$twitter,
            'youtube'=>$youtube,
            'instagram'=>$instagram,
            'linkedin'=>$linkedin,
            'start_day'=>$start_day,
            'end_day'=>$end_day,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
       );
       DB::table('tbl_contact')->where('id',1)->update($update);
       echo "done";
    }

    /*how it works*/
     function how_it_works(Request $request){
        $data['title'] = 'How it works';
        $data['active'] = "how_it_works";
        $data['how_it_works'] = DB::table('tbl_how_it_works')->orderBy('id', 'ASC')->get();
        return view('admin/how_it_works',$data);
    }

    function how_it_works_detail(Request $request){
        $data['title'] = 'How it works';
        $data['active'] = "how_it_works";
        $key = base64_decode($request->key);
        $data['how_it_works'] = DB::table('tbl_how_it_works')->where(['id'=>$key])->first();
        return view('admin/how_it_works_detail',$data);
    }

    function update_how_it_works(Request $request){
        $data['title'] = 'How it works';
        $data['active'] = "how_it_works";
        $key = base64_decode($request->key);
        $data['how_it_works'] = DB::table('tbl_how_it_works')->where(['id'=>$key])->first();
        return view('admin/update_how_it_works',$data);
    }

    function updatehow_it_works(Request $request){
        $heading = $request->heading;
        $content_text = $request->content_text;
        $blog_id = $request->blog_id;

        $update = array(
            'heading'=>$heading,
            'content'=>$content_text,
            'created_at'=>date('Y-m-d H:s:i'),
        );
        DB::table('tbl_how_it_works')->where('id',$blog_id)->update($update);
        echo "done";


    }

    /*how it works*/

    /*heading*/
    function heading(Request $request){
        $data['title'] = 'Heading';
        $data['active'] = "heading";
        $data['heading'] = DB::table('tbl_heading')->orderBy('id', 'ASC')->get();
        return view('admin/heading',$data);
    }

    function update_heading(Request $request){
        $data['title'] = 'Heading';
        $data['active'] = "heading";
        $key = base64_decode($request->key);
        $data['heading'] = DB::table('tbl_heading')->where(['id'=>$key])->first();
        return view('admin/update_heading',$data);
    }

    function updateheading(Request $request){
        $heading = $request->heading;
        $subheading = $request->subheading;
        $content_text = $request->content_text;
        $blog_id = $request->blog_id;

        $update = array(
            'main_heading'=>$heading,
            'sub_heading'=>$subheading,
            'detail'=>$content_text,
        );
        DB::table('tbl_heading')->where('id',$blog_id)->update($update);
        echo "done";
    }

    /*heading*/

    /*Gallery*/
    function gallery(Request $request){
        $data['title'] = 'Gallery';
        $data['active'] = "gallery";
        $data['gallery'] = DB::table('tbl_gallery')->get();
        return view('admin/gallery',$data);
    }

    function add_gallery(Request $request){
        $data['title'] = 'Gallery';
        $data['active'] = "gallery";
        $data['gallery'] = DB::table('tbl_gallery')->get();
        return view('admin/add_gallery',$data);
    }

    function insert_gallery(Request $request){
        if($request->hasFile('slider_image')){
            $slider_image = time().'.'.request()->slider_image->getClientOriginalExtension();
            request()->slider_image->move(public_path('upload/gallery'), $slider_image);

        }
        $insert = array(
            'photo'=>$slider_image,
            'created_at'=>date('Y-m-d H:s:i'),
        );
        DB::table('tbl_gallery')->insert($insert);
        echo "done";
    }

    function delete_gallery(Request $request){
        $id = $request->id;
        DB::table('tbl_gallery')->where('id',$id)->delete();
    }

    /*Gallery*/

    /*enroll history*/
    function enroll_history(Request $request){
        $data['title'] = 'Enroll';
        $data['active'] = "enroll_history";
        $data['enroll_history'] = DB::table('tbl_order')->where(['payment_status'=>1])->distinct('user_id')->get();

        // echo "<pre>";print_r($data);die();

        return view('admin/enroll_history',$data);
    }
    /*enroll history*/

 /*Contact Page*/
    /*contact list*/

    function contact_list(Request $request){
        $data['title'] = 'Contact List';
        $data['active'] = "contactlist";
        $data['contact'] = DB::table('tbl_contact_list')->get();
        return view('admin/contact_list',$data);
    }

    function delete_contact_list(Request $request){
        $id = $request->id;
        DB::table('tbl_contact_list')->where('id',$id)->delete();
echo "done";
    }



public function active_inactive(Request $request,$id){
	$product = DB::table('tbl_instructor')
				->select('status')
				->where('id',$id)
				->first();
	//Check user status
	if($product->status == '1'){
		$status = '0';
	}else{
		$status = '1';
	}

	//update product status
	$values = array('status' => $status );
	DB::table('tbl_instructor')->where('id',$id)->update($values);

	return back();
}



}
