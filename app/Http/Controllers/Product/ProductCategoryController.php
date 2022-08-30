<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    //product category index
   public function index(){
    if (is_null($this->user) || !$this->user->can('product.category.index')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $productcategories=ProductCategory::where('is_deleted','No')->latest()->get();
    return view('admin.pages.productCategory',compact('productcategories'));
   }
   // product category store
   
   public function store(Request $request){
    if (is_null($this->user) || !$this->user->can('product.category.store')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $validator = Validator::make($request->all(),[
        'name' => 'required|max:191',
    ]);
    if ($validator->fails()){
        return response()->json([
            'status' => 400,
            'errors' => $validator->messages()
        ]);
    }else{

        ProductCategory::create([
            'name'  => $request->name,
            'created_by' =>Auth::guard('admin')->user()->id,
        ]);
        // return redirect()->route('partytype.index');
        return response()->json([
            'status'=>200
           ]);

    }
   }
   //product category edit id data
   public function edit($id){
    if (is_null($this->user) || !$this->user->can('product.category.edit')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }
    $data=ProductCategory::findOrFail($id);
    return[
        'id'=>$data->id,
        'name' => $data->name,
        'status'=>$data->status,
        

    ];
   }

   //product category single data update
   public function update(Request $request,$id){
    if (is_null($this->user) || !$this->user->can('product.category.update')) {
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
        $productCategory=ProductCategory::findOrFail($id);
        $productCategory->name = $request->name;
        $productCategory->status = $request->status;
        $productCategory->updated_by=Auth::guard('admin')->user()->id;
        $productCategory->update();
        return response()->json([
            'status'=>200
        ]);
    }
    
   
  }

  //product category single data delete
  public function destroy($id){
    if (is_null($this->user) || !$this->user->can('product.category.temporaryDelete')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }

    $data=ProductCategory::findOrFail($id);
    $data->is_deleted='Yes';
    $data->status='Inactive';
    $data->deleted_by=Auth::guard('admin')->user()->id;

    $data->deleted_at=Carbon::now();
    $data->save();


  }
}
