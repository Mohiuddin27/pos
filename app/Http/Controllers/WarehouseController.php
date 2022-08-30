<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WarehouseController extends Controller
{
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
        if (is_null($this->user) || !$this->user->can('warehouse.index')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $products=Product::where('status','Active')->where('is_deleted','No')->get();
        $warehouses=Warehouse::where('is_deleted','No')->latest()->get();
        return view('admin.pages.warehouse',compact('products','warehouses'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('warehouse.store')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:191|unique:warehouses,name',
             'product_id'=>'required',
             'current_stock'=>'required',
             'minimum_stock'=>'required',
             'maximum_stock'=>'required',
             'transfer_id'=>'required',

        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
            
          
            Warehouse::create([
                'name'  => $request->name,
                'product_id'=>$request->product_id,
                'current_stock'=>$request->current_stock,
                'minimum_stock'=>$request->minimum_stock,
                'maximum_stock'=>$request->maximum_stock,
                'transfer_id'=>$request->transfer_id,
                'created_by' =>Auth::guard('admin')->user()->id,
            ]);
            // return redirect()->route('partytype.index');
            return response()->json([
                'status'=>200
               ]);
    
        }
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
        if (is_null($this->user) || !$this->user->can('warehouse.edit')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $data=Warehouse::findOrFail($id);
        $products=Product::where('status','Active')->where('is_deleted','No')->get();
        $product='';
        $product.=' <select name="product_id" class="form-control"  id="edit_product_id">
        <option value="">Select Product </option>';
        foreach($products as $pc){
           if($pc->id == $data->product_id){
              $checked='selected';
          }else{
              $checked='';
          }
          $product.=' <option '.$checked.' value="'.$pc->id.'"> '.$pc->name.'</option>';
          }
         $product.='</select>';
       
        
        
          
    return[
        'id'=>$data->id,
        'name' => $data->name,
        'product_id'=>$product,
        'current_stock'=>$data->current_stock,
        'minimum_stock'=>$data->minimum_stock,
        'maximum_stock'=>$data->maximum_stock,
        'transfer_id'=>$data->transfer_id,
        'status'=>$data->status,  
    ];
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
        if (is_null($this->user) || !$this->user->can('warehouse.update')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:191|unique:warehouses,name,'.$id,
            'product_id'=>'required',
            'current_stock'=>'required',
            'minimum_stock'=>'required',
            'maximum_stock'=>'required',
            'transfer_id'=>'required',
             'status'=>'required',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
            $warehouse=Warehouse::findOrFail($id);
            $warehouse->name = $request->name;
            $warehouse->product_id = $request->product_id;
            $warehouse->current_stock = $request->current_stock;
            $warehouse->minimum_stock = $request->minimum_stock;
            $warehouse->maximum_stock = $request->maximum_stock;
            $warehouse->transfer_id = $request->transfer_id;
            $warehouse->status = $request->status;
            $warehouse->updated_by=Auth::guard('admin')->user()->id;
            $warehouse->update();
            return response()->json([
                'status'=>200
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($this->user) || !$this->user->can('warehouse.temporaryDelete')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $data=Warehouse::findOrFail($id);
        $data->is_deleted='Yes';
        $data->status='Inactive';
        $data->deleted_by=Auth::guard('admin')->user()->id;
    
        $data->deleted_at=Carbon::now();
        $data->save();
    }
}
