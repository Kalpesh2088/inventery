<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use App\Models\PaymentTerms;
use App\Models\Product;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sales::with(['product'])->latest();
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
                        'edit' => route('admin.sales.edit', $row->id),
                        'delete' => route('admin.sales.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'product_name', 'in_stock', 'action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.sales.index');
            $dataTableConfig = trans('admin_datatables_constants.sales');
            $dataTableConfig['url'] = route('admin.sales.index');
            return view('admin.sales.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.sales.create');
        $productes = Product::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $customer = User::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $payment = PaymentTerms::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $delivery = DeliveryMethod::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        return view('admin.sales.create', compact('breadcums', 'productes', 'customer', 'payment', 'delivery'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'products_id' => ['required'],
            'customer_id' => ['required'],
            'payment_id' => ['required'],
            'delivery_id' => ['required'],
            'so_number' => ['required'],
            'order_date' => ['required'],
            'expected_shipment_date' => ['required'],
            'attachFile' => ['required'],
            'sale_amount' => ['required'],
            'sale_quantity' => ['required'],
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
                    $obj = new Sales;
                    $obj->products_id = $request->products_id;
                    $obj->customer_id = $request->customer_id;
                    $obj->payment_id = $request->payment_id;
                    $obj->so_number = $request->so_number;
                    $obj->order_date = $request->order_date;
                    $obj->expected_shipment_date = $request->expected_shipment_date;
                    $obj->delivery_id = $request->delivery_id;
                    $obj->sale_amount = $request->sale_amount;
                    $obj->sale_quantity = $request->sale_quantity;
                    $obj->status = $request->status;
                    $file_path = 'sales_file' . DIRECTORY_SEPARATOR;
                    if ($request->hasfile('attachFile')) {

                        $obj->attachFile = $this->uploadFile($request->file('attachFile'), $file_path);
                    }
                    if ($obj->save()) {
                        $product->quantity = $product->quantity - $request->sale_quantity;
                        $product->save();
                        \Session::flash('success', trans("Sales order successfully."));
                        $result = ['message' => 'Sales order successfully.', 'status' => true];
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
        $breadcums = trans('admin_breadcums.sales.edit');
        $obj = Sales::find($id);
        $productes = Product::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $customer = User::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $payment = PaymentTerms::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $delivery = DeliveryMethod::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        if ($obj) {
            return view('admin.sales.edit', compact('breadcums', 'obj', 'productes', 'customer', 'payment', 'delivery'));
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
            $obj = Sales::find($id);
            $obj->products_id = $request->products_id;
            $obj->customer_id = $request->customer_id;
            $obj->payment_id = $request->payment_id;
            $obj->so_number = $request->so_number;
            $obj->order_date = $request->order_date;
            $obj->expected_shipment_date = $request->expected_shipment_date;
            $obj->delivery_id = $request->delivery_id;
            $obj->sale_amount = $request->sale_amount;
            $obj->sale_quantity = $request->sale_quantity;
            $obj->status = $request->status;
            $file_path = 'sales_file' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('attachFile')) {

                $obj->attachFile = $this->uploadFile($request->file('attachFile'), $file_path);
            }
            if ($obj->save()) {
                \Session::flash('success', trans("Sales order Updated successfully."));
                $result = ['message' => 'Sales order Updated successfully.', 'status' => true];
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
            $obj = Sales::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Sales order Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Sales order Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }

}
