<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Users;
use App\User_type;

class LoginController extends Controller
{
    //
		function login(Request $req)
		{

			$user = Users::select('id','name','user_type','password')
			->where('login_id', $req->loginid)
			//->where('password', Hash::make($req->password))
			->first();

			if(!$user || !Hash::check($req->password, $user->password))
				{
					return response([
						'error'=>["Not Matched"]
					]);
				}

			//return "Hello";
			//return $user;

			return response([
					'userName' => $user->name,
					'userID'=>$user->id,
					'type' => $user->user_type
			]);
		}



		function Register(Request $req)
		{
			$user = new Users;
			$user->name = $req->name;
			$user->user_type = $req->type;
			$user->login_id = $req->loginId;
			$user->password = Hash::make($req->input('password'));
			$user->save();

			return "saved";
		}
}
