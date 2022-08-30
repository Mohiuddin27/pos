<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Party;
use App\Models\Partytype;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function userDashboard(){
      return view('admin.pages.userdashboard');
    }
    public function dashboard(){
      $total_roles=count(Role::select('id')->get());
      $total_admins=count(Admin::select('id')->get());
      $total_permissions=count(Permission::select('id')->get());
      $total_parties=count(Party::select('id')->get());
      $total_party_types=count(Partytype::select('id')->get());
       return view('admin.pages.dashboard',compact('total_party_types','total_parties','total_roles','total_admins','total_permissions'));
       
    }
    public function Profile(){
       return view('admin.pages.profile');
       
    }
    public function signup(){
       return view('admin.pages.signup');
       
    }
    public function signing(){
       return view('admin.pages.signing');
       
    }
    public function blank(){
       return view('admin.pages.blank');
       
    }
    public function buttons(){
       return view('admin.pages.buttons');
       
    }
    public function forms(){
       return view('admin.pages.forms');
       
    }
    
    public function cards(){
       return view('admin.pages.cards');
       
    }
    public function typography(){
       return view('admin.pages.typography');
       
    }
    public function icons(){
       return view('admin.pages.icons');
       
    }
    
    public function charts(){
       return view('admin.pages.charts');
       
    }
    public function maps(){
       return view('admin.pages.maps');
       
    }
    
}
