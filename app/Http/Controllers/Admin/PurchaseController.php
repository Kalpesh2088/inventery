<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Purchase::latest();
            if (!empty($request->products_id)) {
                $data = $data->where('products_id', 'LIKE', '%' . $request->products_id . '%');
            }
            if (!empty($request->status)) {
                $status = $request->status == 'delivery' ? 1 : 0;
                $data = $data->where('status', $status);
            }
            $data = $data->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'delivery' : 'pending';
                })
                ->addColumn('product_name', function ($row) {
                    $product = "";
                    if (!empty($row->product)) {
                        $product = $row->product->name;
                    }
                    return $product;
                })
                ->addColumn('action_checkbox', function ($row) {
                    return '<input class="form-check-input" type="checkbox" id="checkAll"
                    value="option">';
                })
                ->addColumn('in_stock', function ($row) {
                    $stock = "";
                    if (!empty($row->product)) {
                        $stock = $row->product->quantity;
                    }

                    return $stock;
                })
                ->addColumn('action', function ($row) {
                    $actions = [
                        'edit' => route('admin.purchases.edit', $row->id),
                        'delete' => route('admin.purchases.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'product_name', 'in_stock', 'action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.purchases.index');
            $dataTableConfig = trans('admin_datatables_constants.purchases');
            $dataTableConfig['url'] = route('admin.purchases.index');
            return view('admin.purchases.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.purchases.create');
        $supplier = Supplier::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $productes = Product::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        return view('admin.purchases.create', compact('breadcums', 'productes', 'supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'products_id' => ['required'],
            'request_numbe' => ['required'],
            'date' => ['required'],
            'delivery_date' => ['required'],
            'supplier_id' => ['required'],
            'supplier_invoice_number' => ['required'],
            'packaging_type' => ['required'],
            'description' => ['required'],
            'purchased_amount' => ['required'],
            'purchased_quantity' => ['required'],
            'status' => ['required'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {
            $product = Product::find($request->products_id);
            if ($product) {

                if ($product->quantity >= $request->sale_quantity) {
                    $obj = new Purchase;
                    $obj->products_id = $request->products_id;
                    $obj->request_numbe = $request->request_numbe;
                    $obj->date = $request->date;
                    $obj->delivery_date = $request->delivery_date;
                    $obj->supplier_id = $request->supplier_id;
                    $obj->supplier_invoice_number = $request->supplier_invoice_number;
                    $obj->packaging_type = $request->packaging_type;
                    $obj->description = $request->description;
                    $obj->purchased_quantity = $request->purchased_quantity;
                    $obj->purchased_amount = $request->purchased_amount;
                    $obj->status = $request->status;
                    if ($obj->save()) {
                        $product->quantity = $product->quantity + $request->purchased_quantity;
                        $product->save();
                        \Session::flash('success', trans("Purchas order successfully."));
                        $result = ['message' => 'Purchas order successfully.', 'status' => true];
                        return response()->json($result, 200);
                    } else {
                        $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                        return response()->json($result, 200);
                    }
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                    return response()->json($result, 200);
                }

            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }

        } catch (\Throwable $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
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
        $breadcums = trans('admin_breadcums.purchases.edit');
        $obj = Purchase::find($id);
        $supplier = Supplier::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $productes = Product::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        if ($obj) {
            return view('admin.purchases.edit', compact('breadcums', 'obj', 'productes','supplier'));
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
            $product = Product::find($request->products_id);
            if ($product) {

                if ($product->quantity >= $request->sale_quantity) {
                    $obj = Purchase::find($id);
                    $obj->products_id = $request->products_id;
                    $obj->request_numbe = $request->request_numbe;
                    $obj->date = $request->date;
                    $obj->delivery_date = $request->delivery_date;
                    $obj->supplier_id = $request->supplier_id;
                    $obj->supplier_invoice_number = $request->supplier_invoice_number;
                    $obj->packaging_type = $request->packaging_type;
                    $obj->description = $request->description;
                    $obj->purchased_quantity = $request->purchased_quantity;
                    $obj->purchased_amount = $request->purchased_amount;
                    $obj->status = $request->status;
                    if ($obj->save()) {
                        $product->quantity = $product->quantity + $request->purchased_quantity;
                        $product->save();
                        \Session::flash('success', trans("Purchas order Updated successfully."));
                        $result = ['message' => 'Purchas order Updated successfully.', 'status' => true];
                        return response()->json($result, 200);
                    } else {
                        $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                        return response()->json($result, 200);
                    }
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                    return response()->json($result, 200);
                }

            } else {
                $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                return response()->json($result, 200);
            }

        } catch (\Throwable $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response()->json($result, 200);
        }
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $obj = Purchase::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Purchase order Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Purchase order Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
