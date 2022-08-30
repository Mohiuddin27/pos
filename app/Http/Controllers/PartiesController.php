<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PartiesController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function index($type){
        if (is_null($this->user) || !$this->user->can('party.index') || !$this->user->can('party.view')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
       
        $type=$type;
        $parties = Party::where('is_deleted','No')->where('party_type',$type)->orderBy('id', 'DESC')->get();  
        return view('admin.pages.party', [
            'type' => $type,
            'parties'=>$parties,
        ]);
    }

    //PARTY CREATE
    public function store(Request $request){
        if (is_null($this->user) || !$this->user->can('party.create')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|regex:/^[A-Za-z ]+$/|max:191',
            'contact_person' =>'required|max:191|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
            'email' => 'required|email|unique:parties,email|max:255',
            'mobile_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:15|unique:parties,mobile_no',
            'alternative_mobile_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:15',
            'address' =>'required|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
            'country'=>'required|regex:/^[a-zA-Z]+$/u|max:255',
            'district'=>'required|regex:/^[a-zA-Z]+$/u|max:255',
            'credit_limit' => 'numeric',
            'party_type' => 'required',
            'party_variety'=>'required',

           
        ]);

        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        else{
            Party::create([
                'name'=>$request->name,
                'contact_person'=>$request->contact_person,
                'email'=>$request->email,
                'mobile_no'=>$request->mobile_no,
                'alternative_mobile_no'=>$request->alternative_mobile_no,
                'address'=>$request->address,
                'district'=>$request->district,
                'country'=>$request->country,
                'credit_limit'=>$request->credit_limit,
                'party_variety'=>$request->party_variety,
                'party_type'=>$request->party_type,
                'created_by' =>Auth::guard('admin')->user()->id,
                
    
            ]);
            return response()->json([
                'status'=>200,
               ]);
        }
       
    }
     //PARTY single DATA SHOW
     public function show($id){
        // echo "the show id is ".$id;
        $data=Party::find($id);
        $user=Admin::all();
        $create_by='';
        foreach($user as $us){
            if($data->created_by == $us->id){
                $create_by=$us->name;
            }
           
        }
        $update_by='';
        foreach($user as $us){
            if($data->updated_by == $us->id){
                $update_by=$us->name;
            }
           
        }
        $restore_by='';
        foreach($user as $us){
            if($data->restored_by == $us->id){
                $restore_by=$us->name;
            }
           
        }
        return[
            'id'=>$data->id,
            'name' => $data->name,
            'contact_person'=>$data->contact_person,
            'email'=>$data->email,
            'mobile_no'=>$data->mobile_no,
            'alternative_mobile_no'=>$data->alternative_mobile_no,
            'address'=>$data->address,
            'country'=>$data->country,
            'district'=>$data->district,
            'credit_limit'=>$data->credit_limit,
            'current_due'=>$data->current_due,
            'opening_due'=>$data->opening_due,
            'party'=>$data->party_type,
            'status' => $data->status,
            'created_by'=>$create_by,
            'updated_by'=>$update_by,
            'restored_by'=>$restore_by
            
            

        ];
    }

    //PARTY SINGLE edit VIEW
  public function edit($id){
    if (is_null($this->user) || !$this->user->can('party.edit')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $data=Party::find($id);
  

    return[
        'id'=>$data->id,
        'name' => $data->name,
        'contact_person'=>$data->contact_person,
        'email'=>$data->email,
        'mobile_no'=>$data->mobile_no,
        'alternative_mobile_no'=>$data->alternative_mobile_no,
        'address'=>$data->address,
        'country'=>$data->country,
        'district'=>$data->district,
        'credit_limit'=>$data->credit_limit,
        // 'current_due'=>$data->current_due,
        // 'opening_due'=>$data->opening_due,
        'status'=>$data->status,
        'party_variety'=>$data->party_variety,
        // 'party'=>$party,
        
        

    ];
}
//party single data update
 public function update(Request $request,$id){
    if (is_null($this->user) || !$this->user->can('party.update')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $validator = Validator::make($request->all(),[
        'name' => 'required|regex:/^[A-Za-z ]+$/|max:191|unique:parties,name,'.$id,
        'contact_person' =>'required|max:191|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
        'email' => 'required|email|max:255|unique:parties,email,'.$id,
        'mobile_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:15|unique:parties,mobile_no,'.$id,
        'alternative_mobile_no' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11|max:15',
        'address' =>'required|regex:/^([a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+\s)*[a-zA-Z0-9_ "\.\-\s\,\;\:\/\&\$\%\(\)]+$/u',
        'country'=>'required|regex:/^[a-zA-Z]+$/u|max:255',
        'district'=>'required|regex:/^[a-zA-Z]+$/u|max:255',
        'credit_limit' => 'numeric',
        // 'current_due'=>'numeric',
        // 'opening_due'=>'numeric',
        'party_variety' => 'required',
        'status'=>'required',

    ]);
    if ($validator->fails()){
        return response()->json([
            'status' => 400,
            'errors' => $validator->messages()
        ]);
    }else{
    
        $party=Party::find($id);
        $party->name = $request->name;
        $party->contact_person = $request->contact_person;
        $party->email = $request->email;
        $party->mobile_no = $request->mobile_no;
        $party->alternative_mobile_no = $request->alternative_mobile_no;
        $party->address = $request->address;
        $party->country = $request->country;
        $party->district = $request->district;
        $party->credit_limit = $request->credit_limit;
        // $party->current_due = $request->current_due;
        // $party->opening_due = $request->opening_due;
        $party->party_variety = $request->party_variety;
        $party->status = $request->status;
        $party->updated_by=Auth::guard('admin')->user()->id;
        $party->save();
        return response()->json([
            'status'=>200,
           ]);
    }
      


 }
 //party temporarily delete
 public function delete($id){
    if (is_null($this->user) || !$this->user->can('party.temporary.delete')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $data=Party::find($id);
    $data->is_deleted='Yes';
    $data->status='Inactive';
    $data->deleted_by=Auth::guard('admin')->user()->id;

    $data->deleted_at=Carbon::now();
    $data->save();

  }
  // party restore from trash
  public function restore($id){
    if (is_null($this->user) || !$this->user->can('party.restore')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $data=Party::find($id);
    $data->is_deleted='No';
    $data->status='Active';
    $data->restored_by=Auth::guard('admin')->user()->id;

    $data->restored_at=Carbon::now();
    $data->save();
  }
}
