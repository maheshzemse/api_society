<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\Models\User;
use App\Models\visitor_record; 

use Illuminate\Support\Facades\Auth; 
use Validator;
class UserController extends Controller 
{
public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
$input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->name;
return response()->json(['success'=>$success], $this-> successStatus); 
    }
    	public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }


































    public function add(Request $req)
    {
    	$vit=new visitor_record;
    	$vit->name=$req->name;
    	$vit->contact_no=$req->contact_no;
    	$vit->address=$req->address;
    	$vit->temperature=$req->temperature;
    	$vit->visit_from=$req->visit_from;
    	$vit->visit_to=$req->visit_to;
    	$vit->vehicle_no=$req->vehicle_no;
    	$vit->entry_date=$req->entry_date;
    	$vit->entry_time=$req->entry_time;
    	$vit->exit_date=$req->exit_date;

    	$result=$vit->save();

    	if($result)
    	{
    		return ["result"=>"Data has been saved"];
    	}

    	else
    	{
    		return ["result"=>"Data entry failed"];
    	}

	}
	

	public function list()
	{
		return visitor_record::all();
	}

	public function getlist($id)
	{
		// $list=visitor_record::where('id', $id)->get();
		// if($list)
		// {
			
		// 	return response($list, 200);

		// }
		// else
		// {
		// 	return response()->json([
  //         "message" => "Record not found"
  //       ], 404);
  //     	}


			

		// }


		if (visitor_record::where('id', $id)->exists()) 
			{
        $get = visitor_record::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($get, 200);
      		} else 
      		{
        return response()->json([
          "message" => "Records not found"
        ], 404);
      		}
  }
		

	














}
