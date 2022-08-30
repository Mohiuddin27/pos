<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminsController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('admin.view')) {
            abort(403, 'Sorry !! You are Unauthorized !');
        }
        $admins=Admin::all();
        return view('admin.admins.index',[
            'admins'=>$admins,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $roles= Role::all();
        return view('admin.admins.create',[
           'roles'=>$roles,
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
        if (is_null($this->user) || !$this->user->can('admin.create')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $request->validate([
            'name' => 'required|max:100',
            'email'=>'required|max:100|email|unique:admins,email',
            'username'=>'required|max:100|unique:admins,username',
            'password'=>'required|min:6|confirmed',
            'image'=>'required',
        ]);
          
        if($request->hasFile('image')){
            $img = $request->file('image');
            $file_name=md5(time().rand()).'.'.$img->getClientOriginalExtension();
            $img->move(public_path('media/admins'),$file_name);
        }
        
        $admin=new Admin();
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->username=$request->username;
        $admin->password=Hash::make($request->password);
        $admin->image=$file_name;
        if($request->roles){
            $admin->assignRole($request->roles);
        }
        $admin->save();

        Alert::success('Success','Admin has been Added successfully!');

        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $admin=admin::find($id);
        $roles= Role::all();
       
        return view('admin.admins.edit',[
            'admin'=>$admin,
            'roles'=>$roles,

          
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
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $request->validate([
            'name' => 'required|max:100',
            'email'=>'required|max:100|email|unique:admins,email,'.$id,
            'username'=>'required|max:100|unique:admins,username,'.$id,

            'password'=>'nullable|min:6|confirmed',
        ]);
        $admin=Admin::find($id);
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->username=$request->username;
        if($request->password){
            $admin->password=Hash::make($request->password);

        }
        if($request->hasFile('image')){
            // unlink(public_path('media/admins/'.$admin->image));

            $img = $request->file('image');
            $file_name=md5(time().rand()).'.'.$img->getClientOriginalExtension();
           
            $img->move(public_path('media/admins'),$file_name);
            $admin->image=$file_name;

       
        }
        $admin->roles()->detach();
        if($request->roles){
            $admin->assignRole($request->roles);
        }
        $admin->save();

        Alert::success('Success','Admin has been updated successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $admin=Admin::find($id);
        $admin->delete();
        return back()->with('success','admin has been deleted successfully');
    }
}
