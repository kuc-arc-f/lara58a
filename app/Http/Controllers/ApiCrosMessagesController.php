<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Message;
use App\User;
//
class ApiCrosMessagesController extends Controller
{
	/**************************************
	 *
	 **************************************/
	public function __construct(){
        $this->TBL_LIMIT = 500;
    }    
    /**************************************
     *
     **************************************/  
    public function create_message(Request $request){
		$data = $request->all();
        $user_id = $data["user_id"];

		$message = new Message();
		$message["user_id"]= $user_id;
		$message["from_id"]= $user_id;
		$message["to_id"]= $data["to_id"];
		$message["type"]= 1;
		$message["status"]= 1;
		$message->fill($data );
        $message->save();
        return response()->json($data);
    }
    /**************************************
     *
     **************************************/
    public function get_message(Request $request)
    {
        $message = Message::find(request('id'));
		//status_set
		$message["status"] = 2;
		$message->save();

		$item = Message::select([
			'messages.id',
			'messages.title',
			'messages.content',
			'messages.from_id',
			'messages.created_at',
			'messages.status',
			'users.name as user_name',
			'users.email as user_email',
		])
        ->leftJoin('users','users.id','=','messages.from_id')
        ->where('messages.id' , request('id') )
		->first();        
//        $ret = ['id'=> request('id') ];
        return response()->json($item );
    }      
    /**************************************
     *
     **************************************/
    public function get_sent_message(Request $request)
    {
        $item = Message::find(request('id'));
        $ret = ['id'=> request('id') ];
        return response()->json($item );
    }  
    /**************************************
     *
     **************************************/
    public function delete_message(Request $request )
    {
        $message = Message::find(request('id') );
        $message->delete();
        $ret = ['id'=> request('id') ];
        return response()->json($ret );
	}        

}
