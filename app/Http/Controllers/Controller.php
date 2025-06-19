<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function permission($role){
        if ($role == 'admin' && auth()->user()->role_id == 1) {
            return true;
        }
    }
}
