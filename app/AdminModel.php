<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
	public function adminlogin($username,$password)
	{
		//$query =  DB::select('select * from admin where username = ?',[$username]);
		$query = DB::table('admin')->where(['email'=> $username,'password'=>$password]);
      	return $query;
	}
	function adminProfileDetails()
	{
		$query = DB::table('admin')->where(['id'=>1])->first();
      	return $query;
	}
	function updateAdminProfile($condition,$data)
	{
		$query = DB::table('admin')->where('id', 1)->update($data);
		return $query;
	}
	function checkOldPassword($id,$oldpassword)
	{
		$query = DB::table('admin')->where(['id'=>1,'password'=>md5($oldpassword)])->count();
      	return $query;
	}
	function updateAdminpass($oldpassword,$data)
	{
		$query = DB::table('admin')->where(['password'=>md5($oldpassword)])->update($data);
		return $query;
	}
}
