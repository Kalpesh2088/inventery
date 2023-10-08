<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TransferStock;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TransferStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TransferStock::latest();
            if (!empty($request->name)) {
                $data = $data->where('name', 'LIKE', '%' . $request->name . '%');
            }
            if (!empty($request->status)) {
                $status = $request->status == 'Active' ? 1 : 0;
                $data = $data->where('status', $status);
            }
            $data = $data->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'Active' : 'In-Active';
                })
                ->addColumn('action_checkbox', function ($row) {
                    return '<input class="form-check-input" type="checkbox" id="checkAll"
                    value="option">';
                })
                ->addColumn('action', function ($row) {
                    $actions = [
                        'edit' => route('admin.transfer_stocks.edit', $row->id),
                        'delete' => route('admin.transfer_stocks.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.transfer_stocks.index');
            $dataTableConfig = trans('admin_datatables_constants.transfer_stocks');
            $dataTableConfig['url'] = route('admin.transfer_stocks.index');
            return view('admin.transfer_stocks.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.transfer_stocks.create');
        $warehouse = Warehouses::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $productes = Product::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        return view('admin.transfer_stocks.create', compact('breadcums','warehouse','productes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => ['required'],
            'from_warehouse'=> ['required'],
            'to_warehouse'=> ['required'],
            'date'=> ['required'],
            'order_numbr'=> ['required'],
            'quantity'=> ['required'],
            'invoice'=> ['required'],
            'status' => ['required'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {
            $obj = new TransferStock;
            $obj->product_id = $request->product_id;
            $obj->from_warehouse = $request->from_warehouse;
            $obj->to_warehouse = $request->to_warehouse;
            $obj->date = $request->date;
            $obj->order_numbr = $request->order_numbr;
            $obj->quantity = $request->quantity;
            $obj->status = $request->status;
            $file_path = 'warehouses_invoice' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('invoice')) {
                
                $obj->invoice = $this->uploadFile($request->file('invoice'), $file_path);
            }
            if ($obj->save()) {
                \Session::flash('success', trans("Transfer Stock add successfully."));
                $result = ['message' => 'Transfer Stock add successfully.', 'status' => true];
                return response()->json($result, 200);
            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }
        } catch (\Throwable $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $breadcums = trans('admin_breadcums.transfer_stocks.edit');
        $obj = TransferStock::find($id); 
        if ($obj) {
            $warehouse = Warehouses::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
            $productes = Product::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
            return view('admin.transfer_stocks.edit', compact('breadcums','warehouse','productes', 'obj'));
        } else {
            return redirect()->back()->with('error', 'Oops..something has went wrong. Please try again.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {
            $obj = TransferStock::find( $id );
            $obj->product_id = $request->product_id;
            $obj->from_warehouse = $request->from_warehouse;
            $obj->to_warehouse = $request->to_warehouse;
            $obj->date = $request->date;
            $obj->order_numbr = $request->order_numbr;
            $obj->quantity = $request->quantity;
            $obj->status = $request->status;
            $file_path = 'warehouses_invoice' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('invoice')) {
                
                $obj->invoice = $this->uploadFile($request->file('invoice'), $file_path);
            }
            if ($obj->save()) {
                \Session::flash('success', trans("Warehouses update successfully."));
                $result = ['message' => 'Warehouses update successfully.', 'status' => true];
                return response()->json($result, 200);
            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }
        } catch (\Throwable $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $obj = TransferStock::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Transfer Stock Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Transfer Stock Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
