<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate();
        return view('admin.users.index' ,[
            'users' =>  $users ,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name' , 'id');
        // dd($roles);
        return view('admin.users.create' ,
    [
        'roles' =>  $roles ,
    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255' , 'unique:users,name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image'     =>  ['image'] ,
            'type'      =>  ['exists:users,type'] ,
            'role'      =>  ['nullable' ,'exists:roles,id']
        ]);

        $image = '';
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $imageName = 'User-' . rand(100 , 50000) . '.' . $file->getClientOriginalExtension();
                $image = $file->storeAs('UsersImage' , $imageName , 'public');
            }
        $user = new User();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->type = $request->post('type');
        $user->password = Hash::make($request->post('password'));
        $user->image = $image;
        $user->save();

        DB::table('role_user')->insert([
            'role_id'   =>  $request->post('role') ,
            'user_id'   =>  $user->id
        ]);

        return redirect()->route('users.index')->with('success' , "User  $user->name Added Successfuly");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd( User::with('roles')->findOrfail($id));
        return view('admin.users.show' , [
            'user'  =>  User::findOrfail($id) ,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_role = DB::table('role_user')->where('user_id' , '=' , $id)->first();
        $roles = Role::pluck('name' , 'id');
        return view('admin.users.edit' , [
            'user'  =>  User::findOrfail($id) ,
            'user_role' =>  $user_role ,
            'roles' =>  $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255' , 'unique:users,name,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id ],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'image'     =>  ['image'] ,
            'type'      =>  ['exists:users,type'] ,
            'role'      =>  ['nullable' ,'exists:roles,id'] ,
        ]);

            $image = $user->image;
            $previousImage = '';
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $imageName = 'User-' . rand(100 , 50000) . '.' . $file->getClientOriginalExtension();
                $image = $file->storeAs('UsersImage' , $imageName , 'public');
                $previousImage = $user->image;
            }

        if($request->post('passwprd'))
        {
            $user->password = Hash::make($request->post('password'));
        }
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->image = $image;
        $user->type = $request->post('type');
        $user->update();
        if($previousImage)
        {
            Storage::disk('public')->delete($previousImage);
        }

        DB::table('role_user')->where('user_id' , $user->id)->update([
            'role_id'   =>  $request->post('role') ,
            'user_id'   =>  $user->id
        ]);
        return redirect()->route('users.index')->with('success' , "User $user->name Updated Successfuly");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        if($user->image)
        {
            Storage::disk('public')->delete($user->image);
        }
        return redirect()->route('users.index')->with('success' , "User  $user->name Deleted Successfuly");
    }
}
