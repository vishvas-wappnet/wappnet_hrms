<?php

namespace App\Interfaces;
use Request;

interface LoginRegisterRepositoryInterface 
{
    public function index();
    public function custom_login(Request $request);
    // public function registration();
    // public function customRegistration(Request $request);
    // public function dashboard();
    // public function signOut();
}
