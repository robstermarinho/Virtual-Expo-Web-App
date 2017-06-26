<?php

namespace App\Http\Controllers;

use App\Bookin;
use App\Mail\EmailReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;



class EmailController extends Controller
{

	public function send_email(Request $request){

		try{

			$validator = Validator::make($request->all(),  [ 'email' => 'required|email' ]);

			if ($validator->fails()){
				$error_msg  = $validator->getMessageBag()->getMessages();
				return response()->json(['msg' => $error_msg['email'][0]], 422);

			}else{
				$user = Auth::user();
				$bookins = Bookin::all(); 
				Mail::to($request->email)->send(new EmailReport($bookins));

				return response()->json(['msg' => 'Report successfully sent.'], 200);               	
			}


		} catch(\Exception $e){
			return response()->json(['msg' => $e->getMessage()], 422);
		}
	}
}
