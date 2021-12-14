<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

       

          $users =  User::all();
          return view('home')->with('users', $users);
        
    }
    public function destroy($id)
    {

       $user=User::find($id);
    	$user->delete();
        return redirect('home')->with('sucess', 'User  Deleted successfully');
    	//return response()->json(['success'=>"User  Deleted successfully.", 'tr'=>'tr_'.$id]);
    }

    

    public function update($id)
    {
        
       $user=User::find($id);
       
    	return view('update',['data'=>$user]);
        
    }

    protected function edit(request $request)
    {
     
        $user=User::find($request->id);
        $user->id=$request->id;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password= Hash::make($request->password);
        $user->save();
        return redirect('home');

    }

	public function deleteAll(Request $request)  
    {  
        //return $ids = $request->ids;        
        $ids = $request->ids;         
        $ids = explode(",",$ids);
        User::destroy($ids);         
        return response()->json(['success'=>"Products Deleted successfully."]);
    }  
}
