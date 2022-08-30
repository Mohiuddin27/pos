<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use RealRashid\SweetAlert\Facades\Alert;


class RolesController extends Controller
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
        if (is_null($this->user) || !$this->user->can('role.view')) {
            
            session()->flash('error','Sorry !! You are Unauthorized  !');
           
            return redirect()->route('admin.login.view');
        }
        $roles=Role::all();
        return view('admin.roles.index',[
            'roles'=>$roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('role.create')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $permissions= Permission::all();
        $permission_groups=User::getPermissionGroups();
        return view('admin.roles.create',[
            'permissions'=>$permissions,
            'permission_groups'=>$permission_groups,
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
        if (is_null($this->user) || !$this->user->can('role.create')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $request->validate([
            'name' => 'required|max:100|unique:roles',
        ]);
        $role=Role::create(['name'=>$request->name,'guard_name'=>'admin']);
        $permissions=$request->input('permissions');
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        Alert::success('Success','Role has been added successfully!');
        return redirect()->route('roles.index');
        
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
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $role=Role::findById($id,'admin');
        $permissions= Permission::all();
        $permission_groups=Admin::getPermissionGroups();
        return view('admin.roles.edit',[
            'role'=>$role,
            'all_permissions'=>$permissions,
            'permission_groups'=>$permission_groups,
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
        if (is_null($this->user) || !$this->user->can('role.edit')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,'.$id,
        ]);
        $role=Role::findById($id,'admin');
        $role->name=$request->name;
        $role->save();
        $permissions=$request->input('permissions');
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        else{
            $role->syncPermissions([]);

        }
        Alert::success('Success','Role has been updated successfully!');

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
        if (is_null($this->user) || !$this->user->can('role.delete')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $role=Role::findById($id,'admin');
        $role->delete();
        return back();
    }

    //Permission part here
    //Permission index
    public function permissionIndex(){
        if (is_null($this->user) || !$this->user->can('permission.index')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $permissions= Permission::latest()->get();
        return view('admin.permissions.index',[
            'permissions' => $permissions,
        ]);
    }
    //Permission Create
    public function permissionCreate(){
        if (is_null($this->user) || !$this->user->can('permission.create')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $roles=Role::all();
        return view('admin.permissions.create',[
            'roles'=>$roles,
        ]);
    }
    //permission store 
    public function permissionStore(Request $request){
        if (is_null($this->user) || !$this->user->can('permission.create')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $request->validate([
            'name' => 'required|max:100|unique:permissions,name',
            'group_name' => 'required|max:100',
        ]);
        $permission=Permission::create(['name'=>$request->name,'guard_name'=>'admin','group_name'=>$request->group_name]);
        $roles=$request->input('roles');
        if(!empty($roles)){
            $permission->syncRoles($roles);
        }
        Alert::success('Success','Permission has been Added successfully!');

        return redirect()->route('permission.index');



    }
    //permission edit
    public function permissionEdit($id){
        if (is_null($this->user) || !$this->user->can('permission.edit')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
         $permission=Permission::findById($id,'admin');
         $roles=Role::all();
         return view('admin.permissions.edit',[
            'permission'=>$permission,
            'roles' => $roles,
         ]);
    }
    //permission update
    public function permissionUpdate(Request $request, $id){
        if (is_null($this->user) || !$this->user->can('permission.update')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $request->validate([
            'name' => 'required|max:100|unique:permissions,name,'.$id,
            'group_name' => 'required|max:100',
        ]);
        $permission=Permission::findById($id,'admin');
        $permission->name=$request->name;
        $permission->group_name=$request->group_name;
        $permission->roles()->detach();
        if($request->roles){
            $permission->syncRoles($request->roles);
        }
        $permission->save();
        Alert::success('Success','Permission has been updated successfully!');

        return back();

    }
    //permission delete
    public function permissionDestroy($id){
        if (is_null($this->user) || !$this->user->can('permission.delete')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $permission=Permission::findById($id,'admin');
        $permission->delete();
        return back()->with('success','Permission has been deleted successfully');

    }
}
