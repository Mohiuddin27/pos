<?php

namespace App\Http\Controllers\Product;
use App\Models\User;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductBrandController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
     //product brand index
     public function index(){
        if (is_null($this->user) || !$this->user->can('product.brand.index')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $productbrands=ProductBrand::where('is_deleted','No')->latest()->get();
        return view('admin.pages.productBrand',compact('productbrands'));
       }
       // product category store
       
       public function store(Request $request){
        if (is_null($this->user) || !$this->user->can('product.brand.store')) {
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
    
            ProductBrand::create([
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
        if (is_null($this->user) || !$this->user->can('product.brand.edit')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $data=ProductBrand::find($id);
        return[
            'id'=>$data->id,
            'name' => $data->name,
            'status'=>$data->status,
            
    
        ];
       }
    
       //product category single data update
       public function update(Request $request,$id){
        if (is_null($this->user) || !$this->user->can('product.brand.update')) {
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
            $productBrand=ProductBrand::findOrFail($id);
            $productBrand->name = $request->name;
            $productBrand->status = $request->status;
            $productBrand->updated_by=Auth::guard('admin')->user()->id;
            $productBrand->update();
            return response()->json([
                'status'=>200
            ]);
        }
        
       
      }
    
      //product category single data delete
      public function destroy($id){
        if (is_null($this->user) || !$this->user->can('product.brand.temporaryDelete')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $data=ProductBrand::findOrFail($id);
        $data->is_deleted='Yes';
        $data->status='Inactive';
        $data->deleted_by=Auth::guard('admin')->user()->id;
    
        $data->deleted_at=Carbon::now();
        $data->save();
    
    
      }
}
