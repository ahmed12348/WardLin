<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;



class UserController extends Controller
{

    public function index() {
        return User::all();
    }

    public function store(Request $request) {
        return User::create($request->all());
    }

    public function show($id) {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }

}
