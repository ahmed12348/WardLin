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
    public function __construct()
    {
        $this->middleware(['permission:users_read'])->only('index');
        $this->middleware(['permission:users_create'])->only('create');
        $this->middleware(['permission:users_update'])->only('edit');
        $this->middleware(['permission:users_delete'])->only('destroy');
    }

    public function index(Request $request)
    {

         $users =User::whereRoleIs('user')->where(function($q) use ($request) {
             return   $q->when($request->search,function($query) use ($request){

                 return  $query->where('first_name','like','%'.$request->search. '%')
                     ->orWhere('last_name','like','%'.$request->search. '%');
             });

            })->latest()->paginate(5);

        return view('dashboard.users.index',compact('users'));
    }


    public function create()
    {

         $users =User::all();
        $roles=Role::all();
        return view('dashboard.users.create',compact('users','roles'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => ['required', 'confirmed', 'min:6'],
//          'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            'image' => 'image',
            'permissions' => 'required|min:1',
        ]);
        $request_data=$request->except(['password','password_confirmation','permissions','image']);
        $request_data['password']=bcrypt($request->password);

        if ($request->image){
            Image::make($request->image)->resize(300,null,function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()));
            $request_data['image']=$request->image->hashName();
        }
//        dd($request_data);
//       return $request->roles;
        $user=User::create($request_data);
        $user->attachRole($request->roles);
//        return $request->permissions;
        $user->syncPermissions($request->permissions);
//        return 'll';
        Session::flash('success',__( 'site.added_successfully'));
         return redirect()->route('dashboard.users.index');
    }


    public function show($id)
    {
    }


    public function edit($id)
    {
         $user=User::findOrFail($id);
        $users =User::all();
        $roles=Role::all();
        return view('dashboard.users.edit',compact('users','roles','user'));
    }


    public function update(Request $request,$id)
    {
        $user=User::findOrFail($id);
        $request->validate([
            'first_name' => 'required',
            'email' => ['required',Rule::unique('users')->ignore($user->id),],
            'image' => 'image',
            'permissions' => 'required|min:1',
        ]);
        $request_data=$request->except(['permissions','image']);

        if ($request->image){
            if ($user->image != 'default.png'){
                Storage::disk('public_uploads')->delete('/user_images/'.$user->image);
            }
            Image::make($request->image)->resize(300,null,function ($constraint){
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $request->image->hashName()));
            $request_data['image']=$request->image->hashName();
        }

        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        Session::flash('success',  __('site.updated_successfully'));
        return redirect()->route('dashboard.users.index',compact('user'));
    }


    public function destroy($id)
    {

        $user=User::findOrFail($id);
        if($user->image != 'default.png'){
            Storage::disk('public_uploads')->delete('/user_images/'.$user->image);
        }
        $user->delete();
        Session::flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }



    public function showProfile()
    {

        $user = User::find(auth()->user()->id);
        return view('dashboard.users.profile', compact('user'));
    }

    public function user_profile_update(Request $request)
    {
        if ($request->new_password) {
            $request->validate([
                'current_password' => ['required', new MatchOldPassword],
                'new_password' => ['required'],
                'new_confirm_password' => ['same:new_password'],
            ]);

            // Update the user's password
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        }

        $user = User::findOrFail(auth()->user()->id);
        $request_data = $request->except(['current_password', 'new_password', 'new_confirm_password']);

        if ($request->hasFile('image')) {
            // Delete the old image if it's not the default one
            if ($user->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
            }

            // Process and save the new image
            $uploadedImage = $request->file('image');
            $imageName = $uploadedImage->hashName();
            Image::make($uploadedImage)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user_images/' . $imageName));

            $request_data['image'] = $imageName;
        }

        $user->update($request_data);

// Flash success message
        Session::flash('success', __('site.updated_successfully'));

        return redirect()->back()->with(['success' => "Profile Updated Successfully"]);


    }

}
