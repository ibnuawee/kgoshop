<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request){
        if(Gate::denies('index-user')) {
            abort(403, 'Anda tidak memiliki cukup hak akses');
        }
        $users = User::paginate(5);
        $users = DB::table('users')
            ->when($request->input('search'), function($query,$search){
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })->paginate(10);
        return view('user.index', compact('users'));
    }
}
