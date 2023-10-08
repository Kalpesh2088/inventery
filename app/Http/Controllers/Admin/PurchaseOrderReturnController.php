<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrderReturn;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PurchaseOrderReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PurchaseOrderReturn::latest();
            if (!empty($request->supplier_id)) {
                $data = $data->where('supplier_id', 'LIKE', '%' . $request->supplier_id . '%');
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
                ->addColumn('supplier_name', function ($row) {
                    $suppliers = "";
                    if (!empty($row->suppliers)) {
                        $suppliers = $row->suppliers->name;
                    }
                    return $suppliers;
                })
                ->addColumn('action_checkbox', function ($row) {
                    return '<input class="form-check-input" type="checkbox" id="checkAll"
                    value="option">';
                })
                ->addColumn('action', function ($row) {
                    $actions = [
                        'edit' => route('admin.purchase_order_returns.edit', $row->id),
                        'delete' => route('admin.purchase_order_returns.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'supplier_name','action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.purchase_order_returns.index');
            $dataTableConfig = trans('admin_datatables_constants.purchase_order_returns');
            $dataTableConfig['url'] = route('admin.purchase_order_returns.index');
            return view('admin.purchase_order_returns.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.purchase_order_returns.create');
        $supplier = Supplier::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        return view('admin.purchase_order_returns.create', compact('breadcums', 'supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => ['required'],
            'order' => ['required'],
            'status' => ['numeric'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {

            $obj = new PurchaseOrderReturn;
            $obj->supplier_id = $request->supplier_id;
            $obj->order = $request->order;
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Purchase Order Return Created successfully."));
                $result = ['message' => 'Purchase Order Return Created successfully.', 'status' => true];
                return response()->json($result, 200);
            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }

        } catch (\Throwable$e) {
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
        $breadcums = trans('admin_breadcums.purchase_order_returns.edit');
        $obj = PurchaseOrderReturn::find($id); 
        if ($obj) {
            $supplier = Supplier::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
            return view('admin.purchase_order_returns.edit', compact('breadcums', 'obj', 'supplier'));
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
            'status' => ['numeric'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {

            $obj = PurchaseOrderReturn::find($id);
            $obj->supplier_id = $request->supplier_id;
            $obj->order = $request->order;
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Purchase Order Return Update successfully."));
                $result = ['message' => 'Purchase Order Return Update successfully.', 'status' => true];
                return response()->json($result, 200);
            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }

        } catch (\Throwable$e) {
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
            $obj = PurchaseOrderReturn::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Purchase Order Return Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Purchase Order Return Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    
    }
}
