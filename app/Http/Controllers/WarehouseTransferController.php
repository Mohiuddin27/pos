<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\WarehouseTransfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WarehouseTransferController extends Controller
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
        if (is_null($this->user) || !$this->user->can('warehouse.transfer.index')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }

        $products=Product::where('status','Active')->where('is_deleted','No')->get();
        $warehouses=Warehouse::where('status','Active')->where('is_deleted','No')->get();

        $warehousetransfer=WarehouseTransfer::where('is_deleted','No')->latest()->get();
        return view('admin.pages.warehousetransfer',compact('products','warehouses','warehousetransfer'));
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
        if (is_null($this->user) || !$this->user->can('warehouse.transfer.store')) {
            abort(403, 'Sorry !! You are Unauthorized  !');
        }
        $validator = Validator::make($request->all(),[
            'transferDate' => 'required',
             'current_warehouse_id'=>'required',
             'product_id'=>'required',
             'current_stock'=>'required',
             'remaining_stock'=>'required',
             'transfer_warehouse_id'=>'required',
             'transfer_stock'=>'required'

        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }else{
            
          
            WarehouseTransfer::create([
                'transferDate'  => $request->transferDate,
                'current_warehouse_id'=>$request->current_warehouse_id,
                'product_id'=>$request->product_id,
                'current_stock'=>$request->current_stock,
                'remaining_stock'=>$request->remaining_stock,
                'transfer_warehouse_id'=>$request->transfer_warehouse_id,
                'transfer_stock'=>$request->transfer_stock,

                'created_by' =>Auth::guard('admin')->user()->id,
            ]);
            // return redirect()->route('partytype.index');
            return response()->json([
                'status'=>200
               ]);
    
        }
    }


    //find product current stock
    public function findCurrentStock(Request $request){
        $p=Product::select('current_stock')->where('id',$request->id)->first();
		
    	return response()->json($p);

    }
    //current warehouse id
    public function currentWarehouse(Request $request){
        // $ware=Warehouse::select('id')->where('id',$request->id)->first();

        $warehouses=Warehouse::where('status','Active')->where('is_deleted','No')->get();
        $transfer='';
        $transfer.=' <select name="transfer_warehouse_id" class="form-control"  id="transfer_warehouse_id">
              <option value="">Select Warehouse</option>';
              foreach($warehouses as $warehouse){
                if( $warehouse->id==$request->id){
                    $checked='hidden';
                }
                else{
                    $checked='';
                }
                $transfer.=' <option '.$checked.' value="'.$warehouse->id.'"> '.$warehouse->name.'</option>';
            }
            
       
        $transfer.='</select>';

        return [
            'transfer'=>$transfer,
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarehouseTransfer  $warehouseTransfer
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseTransfer $warehouseTransfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarehouseTransfer  $warehouseTransfer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WarehouseTransfer  $warehouseTransfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WarehouseTransfer $warehouseTransfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarehouseTransfer  $warehouseTransfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseTransfer $warehouseTransfer)
    {
        //
    }
}