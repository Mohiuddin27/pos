<?php

namespace App\Http\Controllers\Product;

use App\Models\ProductUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
   //product unit index
   public function index(){
    if (is_null($this->user) || !$this->user->can('product.unit.index')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $productunits=ProductUnit::where('is_deleted','No')->latest()->get();
    return view('admin.pages.productUnit',compact('productunits'));
   }
   // product unit store
   
   public function store(Request $request){
    if (is_null($this->user) || !$this->user->can('product.unit.store')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $validator = Validator::make($request->all(),[
        'name' => 'required|regex:/^[A-Za-z ]+$/|max:191',
    ]);
    if ($validator->fails()){
        return response()->json([
            'status' => 400,
            'errors' => $validator->messages()
        ]);
    }else{

        ProductUnit::create([
            'name'  => $request->name,
            'created_by' =>Auth::guard('admin')->user()->id,
        ]);
        // return redirect()->route('partytype.index');
        return response()->json([
            'status'=>200
           ]);

    }
   }
   //product unit edit id data
   public function edit($id){
    if (is_null($this->user) || !$this->user->can('product.unit.edit')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $data=ProductUnit::findOrFail($id);
    return[
        'id'=>$data->id,
        'name' => $data->name,
        'status'=>$data->status,
        

    ];
   }

   //product unit single data update
   public function update(Request $request,$id){
    if (is_null($this->user) || !$this->user->can('product.unit.update')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $validator = Validator::make($request->all(),[
        'name' => 'required|regex:/^[A-Za-z ]+$/|max:191',
        'status' => 'required',
    ]);
    if ($validator->fails()){
        return response()->json([
            'status' => 400,
            'errors' => $validator->messages()
        ]);
    }else{
        $productunit=ProductUnit::findOrFail($id);
        $productunit->name = $request->name;
        $productunit->status = $request->status;
        $productunit->updated_by=Auth::guard('admin')->user()->id;
        $productunit->update();
        return response()->json([
            'status'=>200
        ]);
    }
    
   
  }

  //product unit single data delete
  public function destroy($id){
    if (is_null($this->user) || !$this->user->can('product.unit.temporaryDelete')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $data=ProductUnit::findOrFail($id);
    $data->is_deleted='Yes';
    $data->status='Inactive';
    $data->deleted_by=Auth::guard('admin')->user()->id;

    $data->deleted_at=Carbon::now();
    $data->save();


  }
}