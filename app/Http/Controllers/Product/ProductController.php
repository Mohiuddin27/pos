<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    //product index
    public function index(){
        if (is_null($this->user) || !$this->user->can('product.index')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }

        $productCategories=ProductCategory::where('status','Active')->where('is_deleted','No')->get();
        $productBrands=ProductBrand::where('status','Active')->where('is_deleted','No')->get();
        $productUnits=ProductUnit::where('status','Active')->where('is_deleted','No')->get();
        $products=Product::where('is_deleted','No')->latest()->get();
        return view('admin.pages.product',compact('products','productCategories','productBrands','productUnits'));
    }

    //product store
    public function store(Request $request){
        if (is_null($this->user) || !$this->user->can('product.store')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:191|unique:products,name',
             'category_id'=>'required',
             'brand_id'=>'required',
             'unit_id'=>'required',
             'model_no'=>'required',
             'type'=>'required',
             'remainder_quantity'=>'required',
             'stock_check'=>'required',
             'image'=>'required',
            'items_in_box'=>'required',
             'opening_stock'=>'required',
             'current_stock'=>'required',
             'purchase_price'=>'required',
             'sale_price'=>'required',
             'notes'=>'required',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
            
            if($request->hasFile('image')){
                $img = $request->file('image');
                $file_name=md5(time().rand()).'.'.$img->getClientOriginalExtension();
                $img->move(public_path('media/products'),$file_name);
            }else{
                $file_name='';
            }
            Product::create([
                'name'  => $request->name,
                'category_id'=>$request->category_id,
                'brand_id'=>$request->brand_id,
                'unit_id'=>$request->unit_id,
                'model_no'=>$request->model_no,
                'type'=>$request->type,
                'remainder_quantity'=>$request->remainder_quantity,
                'stock_check'=>$request->stock_check,
                'image'=>$file_name,
               'items_in_box'=>$request->items_in_box,
                'opening_stock'=>$request->opening_stock,
                'current_stock'=>$request->current_stock,
                'purchase_price'=>$request->purchase_price,
                'sale_price'=>$request->sale_price,
                'notes'=>$request->notes,

                'created_by' =>Auth::guard('admin')->user()->id,
            ]);
            // return redirect()->route('partytype.index');
            return response()->json([
                'status'=>200
               ]);
    
        }
    }
    //product edit
    public function edit($id){
        if (is_null($this->user) || !$this->user->can('product.edit')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }

        $data=Product::findOrFail($id);
        $productCategories=ProductCategory::where('status','Active')->where('is_deleted','No')->get();
        $productCategory='';
        $productCategory.=' <select name="category_id" class="form-control" style="width:100%" id="edit_category_id">
        <option value="">Select Category </option>';
        foreach($productCategories as $pc){
           if($pc->id == $data->category_id){
              $checked='selected';
          }else{
              $checked='';
          }
          $productCategory.=' <option '.$checked.' value="'.$pc->id.'"> '.$pc->name.'</option>';
          }
         $productCategory.='</select>';
       
        
        $productBrands=ProductBrand::where('status','Active')->where('is_deleted','No')->get();
        $productBrand='';
        $productBrand.=' <select name="brand_id" class="form-control" style="width:100%" id="edit_brand_id">
        <option value="">Select Brand </option>';
        foreach($productBrands as $pb){
           if($pb->id == $data->brand_id){
              $checked='selected';
          }else{
              $checked='';
          }
          $productBrand.=' <option '.$checked.' value="'.$pb->id.'"> '.$pb->name.'</option>';
          }
         $productBrand.='</select>';
         $productUnits=ProductUnit::where('status','Active')->where('is_deleted','No')->get();
         $productUnit='';
         $productUnit.=' <select name="unit_id" class="form-control" style="width:100%" id="edit_unit_id">
         <option value="">Select Unit </option>';
         foreach($productUnits as $pu){
            if($pu->id == $data->unit_id){
               $checked='selected';
           }else{
               $checked='';
           }
           $productUnit.=' <option '.$checked.' value="'.$pu->id.'"> '.$pu->name.'</option>';
           }
          $productUnit.='</select>';
          
    return[
        'id'=>$data->id,
        'name' => $data->name,
        'category_id'=>$productCategory,
        'brand_id'=>$productBrand,
        'unit_id'=>$productUnit,
        'model_no'=>$data->model_no,
        'type'=>$data->type,
        'remainder_quantity'=>$data->remainder_quantity,
        'stock_check'=>$data->stock_check,
        'image'=>$data->image,
        'items_in_box'=>$data->items_in_box,
        'opening_stock'=>$data->opening_stock,
        'current_stock'=>$data->current_stock,
        'purchase_price'=>$data->purchase_price,
        'sale_price'=>$data->sale_price,
        'notes'=>$data->notes,
        'status'=>$data->status,
        
        
        

    ];

       


    }
    //product update
    public function update(Request $request,$id){
        if (is_null($this->user) || !$this->user->can('product.update')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }

        $validator = Validator::make($request->all(),[
             'name' => 'required|max:191|unique:products,name,'.$id,
             'category_id'=>'required',
             'brand_id'=>'required',
             'unit_id'=>'required',
             'model_no'=>'required',
             'type'=>'required',
             'remainder_quantity'=>'required',
             'stock_check'=>'required',
            'items_in_box'=>'required',
             'opening_stock'=>'required',
             'current_stock' => 'required',
             'purchase_price'=>'required',
             'sale_price'=>'required',
             'notes'=>'required',
             'status'=>'required',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
            $product=Product::findOrFail($id);
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->unit_id = $request->unit_id;
            $product->model_no = $request->model_no;
            $product->type = $request->type;
            $product->remainder_quantity = $request->remainder_quantity;
            $product->stock_check = $request->stock_check;
            $product->items_in_box = $request->items_in_box;
            $product->opening_stock = $request->opening_stock;
            $product->current_stock = $request->current_stock;
            $product->purchase_price = $request->purchase_price;
            $product->sale_price = $request->sale_price;
            $product->notes = $request->notes;
            $product->purchase_price = $request->purchase_price;
            if($request->hasFile('image')){
                unlink(public_path('media/products/'.$product->image));
                $img = $request->file('image');
                $file_name=md5(time().rand()).'.'.$img->getClientOriginalExtension();
               
                $img->move(public_path('media/products'),$file_name);
                $product->image=$file_name;
           
            }

            $product->status = $request->status;
            $product->updated_by=Auth::guard('admin')->user()->id;
            $product->update();
            return response()->json([
                'status'=>200
            ]);
        }
    }

     //product  single data delete
  public function destroy($id){
    if (is_null($this->user) || !$this->user->can('product.temporaryDelete')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }

    $data=Product::findOrFail($id);
    $data->is_deleted='Yes';
    $data->status='Inactive';
    $data->deleted_by=Auth::guard('admin')->user()->id;

    $data->deleted_at=Carbon::now();
    $data->save();


  }

  // product restore from trash
public function productRestore($id){
   
    if (is_null($this->user) || !$this->user->can('product.restore')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }

    $data=Product::findOrFail($id);
    $data->is_deleted='No';
    $data->status='Active';
    $data->restored_by=Auth::guard('admin')->user()->id;

    $data->restored_at=Carbon::now();
    $data->save();
    // return redirect()->route('party.index')->with('success','Product Restore Successfull');
}

//product permanently delete
public function productPermanentlyDelete($id){
    if (is_null($this->user) || !$this->user->can('product.permanently.delete')) {
        abort(403, 'Sorry !! You are Unauthorized  !');
    }

    $product_delete_id=Product::findOrFail($id);
    unlink(public_path('media/products/'.$product_delete_id->image));
    $product_delete_id->delete();
    
}

}