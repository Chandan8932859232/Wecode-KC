<?php







namespace App\Http\Controllers;






use Illuminate\Http\Request;



use App\AdminModel;


use Session;



use App;


use File;




use Stripe;



use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
// use DB;







use Illuminate\Support\Facades\Hash;







// use Illuminate\Support\Facades\Validator;
use Stripe\Terminal\Location;

class HomeController extends Controller



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



		$data['title'] = "Home";



        $data['course'] = DB::table('tbl_course')->where(['status'=>1])->limit(6)->get();



        $data['blog'] = DB::table('tbl_blog')->limit(3)->get();

        $data['slider'] = DB::table('tbl_slider')->get();

        $data['testimonial'] = DB::table('tbl_testimonial')->get();

        $data['section_one'] = DB::table('tbl_web')->where(['id'=>1])->first();

        $data['section_two'] = DB::table('tbl_web')->where(['id'=>2])->first();

        $data['product_heading'] = DB::table('tbl_heading')->where(['id'=>1])->first();

        $data['blog_heading'] = DB::table('tbl_heading')->where(['id'=>2])->first();

        $data['testionial_heading'] = DB::table('tbl_heading')->where(['id'=>3])->first();

        $data['sec_one'] = DB::table('tbl_about')->where(['id'=>2])->first();

        $data['sec_two'] = DB::table('tbl_about')->where(['id'=>3])->first();

        $data['sec_three'] = DB::table('tbl_about')->where(['id'=>4])->first();

        $data['sec_four'] = DB::table('tbl_about')->where(['id'=>5])->first();



		return view('front/index',$data);



	}







	function about(Request $request){



		$data = array();



		$data['title'] = "About";




        $data['about'] = DB::table('tbl_about')->first();

        $data['testimonial'] = DB::table('tbl_testimonial')->get();

        $data['testionial_heading'] = DB::table('tbl_heading')->where(['id'=>3])->first();



		return view('front/about',$data);



	}

	function privacy_policy(Request $request){



		$data = array();



		$data['title'] = "Privacy Policy";



        $data['about'] = DB::table('tbl_privacy_poilcy_and_terms')->where(['id'=>1])->first();





		return view('front/privacy_policy',$data);



	}

	function terms(Request $request){



		$data = array();



		$data['title'] = "Terms";



        $data['about'] = DB::table('tbl_privacy_poilcy_and_terms')->where(['id'=>2])->first();


		return view('front/terms',$data);



	}

	function contact(Request $request){


        $request = $request->validate(
            [
            'phone_no' => 'numeric|digits:10',

            ]
            );


		$data = array();



		$data['title'] = "Contact";



        $data['product'] = DB::table('tbl_product')->where(['status'=>1])->limit(6)->get();

        $data['contact'] = DB::table('tbl_contact')->where(['id'=>1])->first();

        $data['contact_heading'] = DB::table('tbl_heading')->where(['id'=>4])->first();



		return view('front/contact',$data);



	}



	function insert_contact(Request $request ) {


		$u_name = $request->u_name;

		$u_email = $request->u_email;

		$u_subject = $request->u_subject;

		$message = $request->message;

		$phone_no = $request->phone_no;



		$insert = array(

			'name'=>$u_name,

			'email'=>$u_email,

			'subject'=>$u_subject,

			'message'=>$message,

			'phone_no'=>$phone_no,

			'created_at'=>date('Y-m-d H:s:i'),

		);

		DB::table('tbl_contact_list')->insert($insert);

		// /*mail*/

		$insert['msg']=$message;

			Mail::send('email.contact', $insert, function($message) use ($insert) {

				$message->to('mobappssolutions128@gmail.com','Contact Us')

				->subject('Contact Details');

				$message->from('no-reply@itdevelopmentservices.com', 'WeCode/KC');
			});



		/*mail*/
   echo "done";

	}







	function faq(Request $request){



		$data = array();



		$data['title'] = "FAQ";



        $data['faq'] = DB::table('tbl_faq')->get();

        $data['faq_heading'] = DB::table('tbl_heading')->where(['id'=>5])->first();



		return view('front/faq',$data);



	}



	function blog(Request $request){



		$data = array();



		$data['title'] = "Blog";



        $data['blog'] = DB::table('tbl_blog')->get();



		return view('front/blog',$data);



	}



	function blog_detail(Request $request){



		$data = array();



		$data['title'] = "Blog";

		$key = base64_decode($request->key);



        $data['blog'] = DB::table('tbl_blog')->where(['id'=>$key])->first();



		return view('front/blog_detail',$data);



	}



	function course(Request $request){

		$data = array();

		$data['title'] = "Course";

        $data['course'] = DB::table('tbl_course')->where(['status'=>1])->get();

		return view('front/course',$data);

	}

	function course_details(Request $request){

		$data = array();



		$data['title'] = "Course Details";

		$user_id = session('drphllip_user_id');

        $key = base64_decode($request->key);

        $data['course'] = DB::table('tbl_course')->where(['id'=>$key,'status'=>1])->first();

        $instructor_id = $data['course']->instructor_id;

        $data['instructor'] = DB::table('tbl_instructor')->where(['id'=>$instructor_id])->first();

        $data['lecture_count'] = DB::table('tbl_curriculum')->where(['course_id'=>$key,'status'=>1])->count();

        $data['curriculum'] = DB::table('tbl_curriculum')->where(['course_id'=>$key,'status'=>1])->get();





		$data['cart_count'] = DB::table('tbl_cart')->where(['user_id'=>$user_id,'course_id'=>$key])->count();

		$data['purchase'] = DB::table('tbl_order')->where(['user_id'=>$user_id,'course_id'=>$key])->count();



		return view('front/course-details',$data);

	}



	function lectures(Request $request){

		$data = array();



		$data['title'] = "Course Details";

		$user_id = session('drphllip_user_id');

        $key = base64_decode($request->key);

        $data['course'] = DB::table('tbl_course')->where(['id'=>$key,'status'=>1])->first();

        $instructor_id = $data['course']->instructor_id;

        $data['instructor'] = DB::table('tbl_instructor')->where(['id'=>$instructor_id])->first();

        $data['lecture_count'] = DB::table('tbl_curriculum')->where(['course_id'=>$key,'status'=>1])->count();

        $data['curriculum'] = DB::table('tbl_curriculum')->where(['course_id'=>$key,'status'=>1])->get();





		$data['cart_count'] = DB::table('tbl_cart')->where(['user_id'=>$user_id,'course_id'=>$key])->count();

		$data['purchase'] = DB::table('tbl_order')->where(['user_id'=>$user_id,'course_id'=>$key,'payment_status'=>1])->count();



		return view('front/lectures',$data);

	}

	function read_lecture(Request $request){
		$lecture_id = $request->lecture_id;
		$read_value = $request->total_lec;
		$user_id = session('drphllip_user_id');
		$create_date = date('Y-m-d H:s:i');

		$check_read = DB::table('tbl_lecture_study')->where(['user_id'=>$user_id,'lecture_id'=>$lecture_id])->count();
		if($check_read==0){
			$insert = array(
				'user_id'=>$user_id,
				'lecture_id'=>$lecture_id,
				'read_value'=>$read_value,
				'create_date'=>$create_date,
			);
			DB::table('tbl_lecture_study')->insert($insert);
			echo "done";
		}else{
			echo "error_lec";
		}
	}



	function create_account(Request $request){



		$data = array();



		$data['title'] = "Create Account";







		return view('front/create_account',$data);



	}







	function registration(Request $request){



		$title = 0;



		$fname = $request->fname;



		$lname = $request->lname;



		$date_of_birth = $request->date_of_birth;

		$email = $request->email;



		$phone_number = $request->phone_number;



		$password = $request->password;



		$date_ofbirth = $date_of_birth;



		$subscription=1;



		$privacy_policy=1;

		$hash_key = uniqid();



		$check_email = DB::table("tbl_user")->where(['email'=>$email,'status'=>1])->count();



		if($check_email==0){



			$insert = array(



				'title'=>$title,



				'fname'=>$fname,



				'lname'=>$lname,



				'date_of_birth'=>$date_ofbirth,



				'email'=>$email,



				'phone_number'=>$phone_number,



				'password'=>md5($password),



				'subscription'=>$subscription,



				'privacy_policy'=>$privacy_policy,



				'status'=>0,

				'hash_key'=>$hash_key,



				'created_at'=>date('Y-m-d H:i:s'),



			);



			DB::table('tbl_user')->insertGetId($insert);

			/*mail*/

			$insert['url']=url('/email_active?key='.base64_encode($email).'&hash_key='.base64_encode($hash_key));

			Mail::send('email.activate', $insert, function($message) use ($insert) {

				$message->to($insert['email'],'Email Verification')

				->subject('Email Verification');

				$message->from('no-reply@itdevelopmentservices.com', 'WeCode/KC');


			});

			/*mail*/


            echo "done";



		}
        else{



			echo "email_error";




		}







	}



	function email_active(Request $request){

		$data['title'] = "Success";

		$email = base64_decode($request->key);

		$hash_key = base64_decode($request->hash_key);

		$validate = DB::table('tbl_user')->where(['email'=>$email,'status'=>1]);

		//return view('front/active_email');

		if($validate->count()==1)

		{

			$data['valid'] ="0";

			return view('front/active_email',$data);



		}else{

			$data['valid'] ="1";

			$update = array('status'=>1);

			DB::table('tbl_user')->where(['email'=>$email,'hash_key'=>$hash_key])->update($update);

			return view('front/active_email',$data);

		}



	}







	function login(Request $request){

		$data = array();

		$data['title'] = "Login";

		return view('front/login',$data);

	}



	function user_login(Request $request){

		$username = $request->username;

		$password = $request->password;

		$check = DB::table('tbl_user')->where(['email'=>$username,'password'=>md5($password),'status'=>1]);

		if($check->count()!=0){

			$result = $check->first();

			$Useremail =  $result->email;

			$userPassword =  $result->password;

			$userName = $result->fname;



			$request->session()->put('useremail', $Useremail);

			$request->session()->put('userPassword', $userPassword);

			$request->session()->put('drphllip_user_id',$result->id);

			//redirect('/');

			echo "done";

		}else{

			echo "error";

		}

	}



	function logout(Request $request)

    {

        $request->session()->flush();

        return redirect('/');

    }



	function how_it_work(Request $request){



		$data = array();



		$data['title'] = "How It Works";



        $data['how_it_work_main'] = DB::table('tbl_how_it_works')->where(['id'=>1])->first();

        $data['how_it_work'] = DB::table('tbl_how_it_works')->get();



		return view('front/how_it_work',$data);



	}







	function add_to_cart(Request $request){

		$course_id = $request->course_id;

		$price = $request->price;

		$user_id = session('drphllip_user_id');

		$check = DB::table('tbl_cart')->where(['user_id'=>$user_id,'course_id'=>$course_id])->count();

		if($check==0){

				$insert = array(

					'user_id'=>$user_id,

					'course_id'=>$course_id,

					'unit_price'=>$price,

					'total_price'=>$price,

					'created_at'=>date('Y-m-d H:s:i'),

				);

				DB::table('tbl_cart')->insert($insert);

				echo "done";





		}



	}



	function cart_list(Request $request){

		$data = array();



		$data['title'] = "Cart List";



        $user_id = session('drphllip_user_id');

        $data['my_cart'] = DB::table('tbl_cart')->where(['user_id'=>$user_id])->get();

		return view('front/cart',$data);

	}



	function delete_cart(Request $request){

		$id = $request->id;

		DB::table('tbl_cart')->where('id',$id)->delete();

	}



	function my_order(Request $request){

		$data = array();



		$data['title'] = "My Order";



        $user_id = session('drphllip_user_id');

        $data['my_order'] = DB::table('tbl_order')->where(['user_id'=>$user_id])->get();

		return view('front/my_order',$data);

	}



	function update_cart(Request $request){

		$user_id = session('drphllip_user_id');

		$remaining_limit = DB::table('tbl_credit_limit')->where(['user_id'=>$user_id])->orderby('id','desc')->limit(1)->first();

		$remaining = $remaining_limit->remaning;

		$limit_id = $remaining_limit->id;



			$th = $request->th;

			$total = $request->total;

			$price = $request->price;

			//echo $total;

			//die;

			$plusresult = $request->plusresult;

		if($price<=$remaining){

			$update = array(

				'quantity'=>$plusresult,

				'total_price'=>$total,

			);

			DB::table('tbl_cart')->where('id',$th)->update($update);

			/*update limit*/

				$balance_remianing = $remaining-$price;

				$update_limit = array('remaning'=>$balance_remianing);

				DB::table('tbl_credit_limit')->where('id',$limit_id)->update($update_limit);

				/*update limit*/



		}

	}



	function check_out(Request $request){

		$data = array();

		$data['title'] = "Check Out";

        $user_id = session('drphllip_user_id');

        $data['email'] = DB::table('tbl_user')->where('id',$user_id)->first()->email;

        $data['count_address'] = DB::table('tbl_billing_address')->where('user_id',$user_id)->count();

        $data['bill_address'] = DB::table('tbl_billing_address')->where('user_id',$user_id)->first();

        $data['ship_address'] = DB::table('tbl_shipping_address')->where('user_id',$user_id)->first();

        $data['my_cart'] = DB::table('tbl_cart')->where(['user_id'=>$user_id]);

		return view('front/checkout',$data);

	}



	function submit_address(Request $request){

		$user_id = session('drphllip_user_id');

		$bfname = $request->bfname;

		$blname = $request->blname;

		$bemail = $request->bemail;

		$bphone = $request->bphone;

		$baddress = $request->baddress;

		$baddress2 = $request->baddress2;

		$bcity = $request->bcity;

		$bcountry = $request->bcountry;

		$bcounty = $request->bcounty;

		$bpostcode = $request->bpostcode;

		$ship_add_bill = $request->ship_add_bill;



		$sfname = $request->sfname;

		$slname = $request->slname;

		$semail = $request->semail;

		$sphone = $request->sphone ;

		$saddress = $request->saddress;

		$saddress2 = $request->saddress2;

		$scity = $request->scity;

		$scountry = $request->scountry;

		$scounty = $request->scounty;

		$spostcode = $request->spostcode;

		$check_address = DB::table('tbl_billing_address')->where('user_id',$user_id)->count();

		if($check_address==0){

			if($ship_add_bill==1){

				$insert_bill = array(

					'user_id'=>$user_id,

					'fname'=>$bfname,

					'lname'=>$blname,

					'email'=>$bemail,

					'phone_no'=>$bphone,

					'address'=>$baddress,

					'address2'=>$baddress2,

					'city'=>$bcity,

					'country'=>$bcountry,

					'county'=>$bcounty,

					'pincode'=>$bpostcode,

					'same_address'=>$ship_add_bill,

				);

				DB::table('tbl_billing_address')->insert($insert_bill);



				$insert_shipping = array(

					'user_id'=>$user_id,

					'fname'=>$bfname,

					'lname'=>$blname,

					'email'=>$bemail,

					'phone_no'=>$bphone,

					'address'=>$baddress,

					'address2'=>$baddress2,

					'city'=>$bcity,

					'country'=>$bcountry,

					'county'=>$bcounty,

					'pincode'=>$bpostcode,

				);

				DB::table('tbl_shipping_address')->insert($insert_shipping);

				echo "done";



			}else{

				$insert_bill = array(

					'user_id'=>$user_id,

					'fname'=>$bfname,

					'lname'=>$blname,

					'email'=>$bemail,

					'phone_no'=>$bphone,

					'address'=>$baddress,

					'address2'=>$baddress2,

					'city'=>$bcity,

					'country'=>$bcountry,

					'county'=>$bcounty,

					'pincode'=>$bpostcode,

					'same_address'=>$ship_add_bill,

				);

				DB::table('tbl_billing_address')->insert($insert_bill);



				$insert_shipping = array(

					'user_id'=>$user_id,

					'fname'=>$sfname,

					'lname'=>$slname,

					'email'=>$semail,

					'phone_no'=>$sphone,

					'address'=>$saddress,

					'address2'=>$saddress2,

					'city'=>$scity,

					'country'=>$scountry,

					'county'=>$scounty,

					'pincode'=>$spostcode,

				);

				DB::table('tbl_shipping_address')->insert($insert_shipping);

				echo "done";

			}

		}else{

			if($ship_add_bill==1){

				$insert_bill = array(

					'user_id'=>$user_id,

					'fname'=>$bfname,

					'lname'=>$blname,

					'email'=>$bemail,

					'phone_no'=>$bphone,

					'address'=>$baddress,

					'address2'=>$baddress2,

					'city'=>$bcity,

					'country'=>$bcountry,

					'county'=>$bcounty,

					'pincode'=>$bpostcode,

					'same_address'=>$ship_add_bill,

				);

				DB::table('tbl_billing_address')->where('user_id',$user_id)->update($insert_bill);



				$insert_shipping = array(

					'user_id'=>$user_id,

					'fname'=>$bfname,

					'lname'=>$blname,

					'email'=>$bemail,

					'phone_no'=>$bphone,

					'address'=>$baddress,

					'address2'=>$baddress2,

					'city'=>$bcity,

					'country'=>$bcountry,

					'county'=>$bcounty,

					'pincode'=>$bpostcode,

				);

				DB::table('tbl_shipping_address')->where('user_id',$user_id)->update($insert_shipping);

				echo "done";



			}else{

				$insert_bill = array(

					'user_id'=>$user_id,

					'fname'=>$bfname,

					'lname'=>$blname,

					'email'=>$bemail,

					'phone_no'=>$bphone,

					'address'=>$baddress,

					'address2'=>$baddress2,

					'city'=>$bcity,

					'country'=>$bcountry,

					'county'=>$bcounty,

					'pincode'=>$bpostcode,

					'same_address'=>$ship_add_bill,

				);

				DB::table('tbl_billing_address')->where('user_id',$user_id)->update($insert_bill);



				$insert_shipping = array(

					'user_id'=>$user_id,

					'fname'=>$sfname,

					'lname'=>$slname,

					'email'=>$semail,

					'phone_no'=>$sphone,

					'address'=>$saddress,

					'address2'=>$saddress2,

					'city'=>$scity,

					'country'=>$scountry,

					'county'=>$scounty,

					'pincode'=>$spostcode,

				);

				DB::table('tbl_shipping_address')->where('user_id',$user_id)->update($insert_shipping);

				echo "done";

			}

		}





	}



	public function stripePost(Request $request)

    {

    	$start_date = date('Y-m-d');



    	$amount = $request->amount*100;



    	$totalamount = $request->totalamount;



    	$totalproduct = $request->totalproduct;

    	$user_id = session('drphllip_user_id');

    	$today = date("Ymd");

		$rand = strtoupper(substr(uniqid(sha1(time())),0,4));

		//echo $unique = $today . $rand;

			/*tbl_order*/

    	$order_id = $today . $rand;



    	$product_id = explode(",", $totalproduct);

    	foreach($product_id as $val){

    		$cart = DB::table('tbl_cart')->where(['course_id'=>$val,'user_id'=>$user_id])->first();

    		$total_amount =$cart->total_price;

    		$created_at = date('Y-m-d H:s:i');

    		$insert_order = array(

	    		'user_id'=>$user_id,

	    		'order_id'=>$order_id,

	    		'course_id'=>$val,

	    		'total_amount'=>$total_amount,

	    		'payment_start_date'=>$start_date,

	    		'payment_status'=>1,

	    		'created_at'=>$created_at,

	    	);

	    	DB::table('tbl_order')->insert($insert_order);

    	}





    	/*tbl_order*/



    	/*cart delete*/

    	foreach($product_id as $value){

    		DB::table('tbl_cart')

    		->where('course_id',$value)

    		->where('user_id',$user_id)

    		->delete();

    	}

    	/*cart delete*/

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([

                "amount" => $amount,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "WeCode/KC payment"

        ]);

        //redirect(url('/success_payment'));

        //return redirect('/success_payment');

        $data['title'] ="Success";

        return view('front/success',$data);



        /*Session::flash('success', 'Payment successful!');



        return back();*/

    }



    function success_payment(Request $request){

    	$data['title'] ="Success";

    	return view('front/success',$data);

    }



    function profile(Request $request){

    	$data['title'] = "Profile";

    	$user_id = session('drphllip_user_id');

        $data['user'] = DB::table('tbl_user')->where('id',$user_id)->first();



    	return view('front/profile',$data);

    }



    function profile_edit(Request $request){

    	$user_id = session('drphllip_user_id');



		$fname = $request->fname;



		$lname = $request->lname;



		$date_of_birth = $request->date_of_birth;

		$email = $request->email;



		$phone_number = $request->phone_number;



		$date_ofbirth = $date_of_birth;





		$check_email = DB::table("tbl_user")

		->where('email','=',$email)

		->where('id','!=',$user_id)

		->where('status','=',1)

		->count();



		if($check_email==0){



			$insert = array(

				'fname'=>$fname,



				'lname'=>$lname,



				'date_of_birth'=>$date_ofbirth,



				'email'=>$email,



				'phone_number'=>$phone_number,

				'created_at'=>date('Y-m-d H:i:s'),



			);



			DB::table('tbl_user')->where('id',$user_id)->update($insert);





			echo "done";



		}else{



			echo "email_error";



		}

    }



    function change_password(Request $request){

    	$user_id = session('drphllip_user_id');



		$old_password = md5($request->old_password);

		$password = md5($request->password);

		$check_email = DB::table("tbl_user")

		->where('password','=',$old_password)

		->where('id','=',$user_id)

		->where('status','=',1)

		->count();



		if($check_email!=0){



			$insert = array(

				'password'=>$password,

			);

			DB::table('tbl_user')->where('id',$user_id)->update($insert);

			echo "done";



		}else{



			echo "email_error";



		}

    }



    function reset_password(Request $request){

    	$data['title'] ="Reset Password";

    	$data['email'] = $request->key;
    	$data['hash_key'] = $request->hash_key;

    	return view('front/reset_password',$data);

    }



    function resetpassword(Request $request){

    	$email = base64_decode($request->email);
    	//$email = $request->email;

    	$password = $request->password;

    	$update_pass = array('password'=>md5($password));

		DB::table('tbl_user')->where(['email'=>$email,'status'=>1])->update($update_pass);
		echo "done";



    }



    function forgot_password(Request $request){

    	$data['title'] ="Forgot Password";

    	//$data['email'] = "";

    	return view('front/forgot_password',$data);

    }



    function forgotpassword(Request $request){

    	$email = $request->email;

    	$check_email = DB::table('tbl_user')->where(['email'=>$email,'status'=>1])->count();

    	if($check_email!=0){
    		$user = DB::table('tbl_user')->where(['email'=>$email,'status'=>1])->first();
    		$email = $user->email;
    		$hash_key = $user->hash_key;
    		$name = $user->fname.' '.$user->lname;
    		/*mail*/

			$insert['url']=url('/reset_password?key='.base64_encode($email).'&hash_key='.base64_encode($hash_key));
			$insert['email'] = $email;
			$insert['name'] = $name;

			Mail::send('email.reset_password', $insert, function($message) use ($insert) {

				$message->to($insert['email'],'Reset Password')

				->subject('Reset Password');

				$message->from('no-reply@itdevelopmentservices.com', 'WeCode/KC');

			});

			/*mail*/
			\Session::put('success', 'Email sent successfully.Please check your mail.');
			 return Redirect::to('/forgot_password');

    		//echo "done";
    	}else{
    		\Session::put('emailerr', $email);
    		\Session::put('error', 'This email is not registerd with us.');
			 return Redirect::to('/forgot_password');

    		//echo "email_error";

    	}

    }


    }



