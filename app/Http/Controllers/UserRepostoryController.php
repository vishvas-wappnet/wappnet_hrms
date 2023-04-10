<?php

namespace App\Http\Controllers;


use Redirect;
use DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Type\VoidType;
use Illuminate\Http\RedirectResponse;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\View;

class UserRepostoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $UserRepository;

    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    /**
     * Display a listing of the users
     *
     * 
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = $this->UserRepository->user_index();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn("action", "action.user_action")
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('users.users_index');
    }

    //open add  user page
    public function add_user()
    {
        return view('users.add_user');
    }

    public function add_user_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|email:rfc,dns|unique:users'
        ]);

        $data = $request->all();
        $this->UserRepository->add_user_action($data);
        return view('users.add_user');

    }

    // creating a new resource.

    public function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

    }

    //show edit user
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit_user', compact('user'));

    }

    //store data of edit user request
    public function store(Request $request)
    {
        //validation rules
            $request->validate([
                'name' => 'required|min:4|string|max:255',
                'email' => 'required|email|string|max:255'
        ]);
        $user = $request;
        $this->UserRepository->user_edit_action($user);
        return redirect("users")->withSuccess('User Updates Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     */
    public function destroy(Request $request): RedirectResponse
    {

        $data = $request;
        $this->UserRepository->user_destroy($data);
        return Redirect::route('users.index')->withSuccess('User deleted Successfully');
    }

    //view profile update page
    public function profile_update_view()
    {
        return view('auth.user_profile');
    }

    //profile update action
    public function profile_update_action(Request $request)
    {
        $this->UserRepository->profile_update_action_repostory($request);
        return redirect("profile_update")->withSuccess('User Updated Successfully');
    }

    //delete multiple user from database
    public function delete(Request $request)
{
    $ids = $request->input('ids'); // Get the IDs of the records to be deleted from the request
    User::whereIn('id', $ids)->delete(); // Delete the records from the 'users' table
    return response()->json(['success' => true]); // Return a JSON response indicating success
}

}