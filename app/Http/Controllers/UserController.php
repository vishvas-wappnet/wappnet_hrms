<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth; 


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                 $search = $request['search'] ?? "";
                 if($search != "")
                     {
                        $users = User::where('name' , 'LIKE' , "%$search%")->orwhere('email' , 'LIKE' , "%$search%")->paginate(10);
                     }
                 else
                     {
                        $users = User::paginate(10);
                     }     
                    //$users = User::paginate(10);
                    $data = compact('users', 'search');
                   // $users = User::select('id', 'email', 'name')->paginate(10);
                    //$data = compact('user' , 'search');
                    return view('users.users_list')->with($data);

        //              return view('users.users_list')->with([
        //                  'users' => $users
        //              ]);
         }
    


        // public function index(Request $request)
        // {
        //     if ($request->ajax()) {
        //         $data = User::select('id','name','email')->get();
        //         return Datatables::of($data)->addIndexColumn()
        //             ->addColumn('action', function($row){
        //                 $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
        //                 return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        //     }
    
        //     return view('users');
        // }
       
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

        public function edit(User $user) 
        {
            return view('users.edit', [
                'user' => $user
            ]);
        }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
    
        public function update(User $user, UpdateUserRequest $request) 
        {
            $user->update($request->validated());
    
            return redirect()->route('user_list')->withSuccess('sucess','User updated successfully.');
        }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) 
    {
        $user->delete();

        return redirect()->route('user_list')->withSuccess(__('User deleted successfully.'));
    }



    public function delete($id) 
        {
                $user = User::findOrFail($id);
                $user->delete();

                return redirect()->route('user_list');
        }
}
