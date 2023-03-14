<?php

namespace App\Interfaces;
use Request;

interface LoginRegisterRepositoryInterface 
{
    public function index();
    public function custom_login(Request $request);

    public function create(array $data);
    public function  registration_action(aray $data);
    
    
}
