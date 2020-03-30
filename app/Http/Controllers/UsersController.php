<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles_User;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {             
        $users = User::orderBy('id', 'asc')->where('permission_id','<>','1')->paginate(10);
        
        return view('pages.management.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $user_id = $request->input("user_id");
        $this->edit($user_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errors = array();
        
        $username = $request->input("username");
        
        $oldUser = User::where('username', $username)->first();
        if (!empty($oldUser)) {
            $errors[] = ['username' => trans('validation.username_duplicated')];
        }
        
        $name = $request->input("first_name") . " " . $request->input("sur_name");
        
        $user_data = array(
            'username' => $username,
            'name' => $name,
            'password' => $request->input("password"),
            'password_confirmation' => $request->input("password_confirmation"),
            'email' => $request->input("email"),
            'permission_id' => 2            
            );
            
        $user = new User();
        $return = $user->saveUser($user_data);
        if (!($return === true)) {
            return redirect()->back()
                ->withInput()
                ->withErrors($return);
        }

        $request->session()->flash('success', 'User created success!');
        return redirect()->route("users.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();

        if (empty($user)) {
            return redirect()->route("users.index");
        }
        $name = explode(" ", $user->name);

        $user_data = array(
            'id' => $user->id,
            'first_name' => $name[0],
            'sur_name' => $name[1],
            'email' => $user->email,
            'username' => $user->username
        );

        return view('pages.management.usershow',
            [
                'user_data' => $user_data
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();

        if (empty($user)) {
            return redirect()->route("users.index");
        }
        $name = explode(" ", $user->name);

        $user_data = array(
            'id' => $user->id,
            'first_name' => $name[0],
            'sur_name' => $name[1],
            'email' => $user->email,
            'username' => $user->username
        );

        //$roles = Roles_User::where('user_id', $id)->get();
        $roles_data = array();

        return view('pages.management.useredit',
            [
                'user_data' => $user_data,
                'roles_data' => $roles_data
            ]
        );
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
        $errors = array();
        
        $user = User::where('id', $id)->first();

        $name = $request->input("first_name") . " " . $request->input("sur_name");
        
        $user->username = $request->input("username");
        $user->name = $name;

        if( $request->input("password") !="" )
            $user->password = bcrypt($request->input("password"));

        $user->email = $request->input("email");
        
        $return = $user->save();

        if( $request->input("user_role_products") != "0" )
            DB::table('roles_user')->where('user_id',$id)->where('menu','Products')->update(['role' => $request->input("user_role_products")]);
        if( $request->input("user_role_components") != "0" )
            DB::table('roles_user')->where('user_id',$id)->where('menu','Components')->update(['role' => $request->input("user_role_components")]);
        if( $request->input("user_role_options") != "0" )
            DB::table('roles_user')->where('user_id',$id)->where('menu','Options')->update(['role' => $request->input("user_role_options")]);
        if( $request->input("user_role_rules") != "0" )
            DB::table('roles_user')->where('user_id',$id)->where('menu','Rules')->update(['role' => $request->input("user_role_rules")]);
        if( $request->input("user_role_brands") != "0" )
            DB::table('roles_user')->where('user_id',$id)->where('menu','Brands')->update(['role' => $request->input("user_role_brands")]);

        if ($return === true) {
            Request()->session()->flash('success', 'User updated Success!');
        } else {
            return redirect()->back()
                ->withInput()
                ->withErrors($return);
        }

        return redirect()->route("users.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        if (empty($user)) {
            return redirect()->route("users.index");
        }

        $user->delete();
        Request()->session()->flash('success', 'user deleted success!');

        return redirect()->route("users.index");
    }
    
    
}
