<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getAllUserBooks() {
    $userBooks = DB::select('select * from users_books');
    return response($userBooks);
    }
}