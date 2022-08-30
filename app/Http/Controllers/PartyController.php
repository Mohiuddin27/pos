<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Party;
use App\Models\Product;
use App\Models\Partytype;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PartyController extends Controller
{
    public $user;


    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    //Party type index
    public function partyTypeIndex(){
        if (is_null($this->user) || !$this->user->can('partytype.index')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $partytype=Partytype::where('is_deleted','No')->latest()->get();
        return view('admin.pages.partytype',
    [
        'partytype' => $partytype,
    ]);
    }
   //Party type data store
    public function partyTypeCreate(Request $request){
        if (is_null($this->user) || !$this->user->can('party.type.create')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $validator = Validator::make($request->all(),[
            'type_name' => 'required|regex:/^[A-Za-z ]+$/|max:191',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{

            Partytype::create([
                'type_name'  => $request->type_name,
                'created_by' =>Auth::guard('admin')->user()->id,
            ]);
            // return redirect()->route('partytype.index');
            return response()->json([
                'status'=>200
               ]);
    
        }


    }
    //edit party type data
    public function partyTypeEdit($id){
        if (is_null($this->user) || !$this->user->can('partytype.edit')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $data=Partytype::find($id);
        return[
            'id'=>$data->id,
            'type_name' => $data->type_name,
            'status'=>$data->status,
            

        ];
    }
    //Party type update
    public function partyTypeUpdate(Request $request,$id){
        if (is_null($this->user) || !$this->user->can('partytype.update')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $validator = Validator::make($request->all(),[
            'type_name' => 'required|regex:/^[A-Za-z ]+$/|max:191',
            'status' => 'required',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
            $partytype=Partytype::findOrFail($id);
            $partytype->type_name = $request->type_name;
            $partytype->status = $request->status;
            $partytype->updated_by=Auth::guard('admin')->user()->id;
            $partytype->update();
            return response()->json([
                'status'=>200
            ]);
        }
        
       
    }
    // public function partyTypeInactive(){
    //     $partytype=Partytype::where('status','Inactive')->latest()->get();
    //     return view('admin.pages.inactivepartytype',
    // [
    //     'partytype' => $partytype,
    // ]);
    // }
    //Party Type Reactive
    // public function partyTypeReactive($id){
    //     $data=Partytype::find($id);
    //     $data->status='Active';
    //     $data->save();
    //     return redirect()->route('partytype.index')->with('success','Party Type Reactive Successfull');
    // }
    //temporarly delete party type
    public function partyTypeTemporaryDelete($id){
        if (is_null($this->user) || !$this->user->can('partytype.temporary.delete')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $data=Partytype::find($id);
        $data->is_deleted='Yes';
        $data->status='Inactive';
        $data->deleted_by=Auth::guard('admin')->user()->id;

        $data->deleted_at=Carbon::now();
        $data->save();

    }
    //Party type trash
    // public function partyTypeTrash(){
    //     $partytype=Partytype::where('is_deleted','yes')->latest()->get();
    //     return view('admin.pages.partytypetrash',
    // [
    //     'partytype' => $partytype,
    // ]);
    // }
    //Party type restore
    // public function partyTypeRestore($id){
    //     $data=Partytype::find($id);
    //     $data->is_deleted='No';
    //     $data->status='Active';
    //     $data->restored_by=Auth::guard('admin')->user()->id;

    //     $data->restored_at=Carbon::now();
    //     $data->save();
    //     return redirect()->route('partytype.index')->with('success','Party Type Restore');
    // }

    //Party type permanently delete
    // public function PartyTypePermanentlyDelete($id){

    //     $partytype_delete_id=Partytype::find($id);
    //     $partytype_delete_id->delete();
        
    // }

    //Party index
    public function PartyIndex(Request $request){
        if (is_null($this->user) || !$this->user->can('party.index') || !$this->user->can('party.view')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        // $party=Party::where('is_deleted','No')->latest()->get();
        // $party_type=Partytype::where('status','Active')->where('is_deleted','No')->get();
        // return view('admin.pages.party',[
        //     'party_type' => $party_type,
        //     'party' => $party,
        // ]);
        $type=$request->type;
        return view('admin.pages.party', ['type' => $type]);
    }

    //PARTY CREATE
    public function PartyCreate(Request $request){
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
            // 'party_type' => 'required',
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
  //PARTY SINGLE edit VIEW
  public function partyEdit($id){
    if (is_null($this->user) || !$this->user->can('party.edit')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $data=Party::find($id);
    $party_type=Partytype::where('status','Active')->where('is_deleted','No')->get();
    $party='';
    $party.=' <select name="party_type" class="form-control" style="width:100%" id="edit_party_type">
              <option value="">--Select Party Type--</option>';
    foreach($party_type as $pt){
        if($pt->id == $data->party_type){
            $checked='selected';
        }else{
            $checked='';
        }
        $party.=' <option '.$checked.' value="'.$pt->id.'"> '.$pt->type_name.'</option>';
    }
    $party.='</select>';
  

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
        'party'=>$party,
        
        

    ];
}

    //PARTY single DATA SHOW
    public function partySingleView($id){
        $data=Party::find($id);
        $party_type=Partytype::where('status','Active')->where('is_deleted','No')->get();
        $party='';
        foreach($party_type as $pt){
                if($data->party_type == $pt->id){
                    $party=$pt->type_name;
                }
        }
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
            'party'=>$party,
            'status' => $data->status,
            'created_by'=>$create_by,
            'updated_by'=>$update_by,
            'restored_by'=>$restore_by
            
            

        ];
    }
 //party single data update
 public function partyUpdate(Request $request,$id){
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
        'party_type' => 'required',
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
        $party->party_type = $request->party_type;
        $party->status = $request->status;
        $party->updated_by=Auth::guard('admin')->user()->id;
        $party->save();
        return response()->json([
            'status'=>200,
           ]);
    }
      


 }

 //inactive party view
//  public function partyInactive(){
//     $party=Party::where('status','Inactive')->latest()->get();
//     return view('admin.pages.inactiveparty',
//    [
//     'party' => $party,
//    ]);
//   }

  //reactive party
//   public function partyReactive($id){
//     $data=Party::find($id);
//     $data->status='Active';
//     $data->save();
//     return redirect()->route('party.index')->with('success','Party Reactive Successfull');
// }

//party temporarily delete
  public function partyTemporaryDelete($id){
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
//Party trash view
    public function partyTrash(){
        if (is_null($this->user) || !$this->user->can('party.trash')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $party=Party::where('is_deleted','Yes')->latest()->get();
        return view('admin.pages.partytrash',
    [
        'party' => $party,
    ]);
    }

// party restore from trash
public function partyRestore($id){
    if (is_null($this->user) || !$this->user->can('party.restore')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $data=Party::find($id);
    $data->is_deleted='No';
    $data->status='Active';
    $data->restored_by=Auth::guard('admin')->user()->id;

    $data->restored_at=Carbon::now();
    $data->save();
    return redirect()->route('party.index')->with('success','Party Restore Successfull');
}

//party permanently delete
public function PartyPermanentlyDelete($id){
    if (is_null($this->user) || !$this->user->can('party.temporary.delete')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $party_delete_id=Party::find($id);
    $party_delete_id->delete();
    
}

// Recycle Bin
public function recycleBin(){
    if (is_null($this->user) || !$this->user->can('recycle.bin')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $party=Party::where('is_deleted','Yes')->latest()->get();
    $partytype=Partytype::where('is_deleted','yes')->latest()->get();
    $products=Product::where('is_deleted','yes')->latest()->get();
    return view('admin.pages.recycleBin',
[
    'party' => $party,
    'partytype' => $partytype,
    'products'=>$products,
]);

}
}