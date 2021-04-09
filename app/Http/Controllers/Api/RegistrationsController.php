<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Registration;

class RegistrationsController extends Controller
{

    public function index()
    {
        return Registration::applyFilters();
        $email = request()->get('email', null);
        if ($email) {
            return Registration::where('email', $email)->get();
        }
        return Registration::all();
    }

}
