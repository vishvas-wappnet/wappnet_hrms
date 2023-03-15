<?php

namespace App\Interfaces;
use Request;

interface UserRepositoryInterface 
{
    // public function index($request);
    public function add_user_action(aray $data);
    public function user_index();
    public function user_edit_action($user);
    public function user_destroy($user);

   // public function profile_update(Request $request);


}
