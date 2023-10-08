<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryMethod;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DeliveryMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DeliveryMethod::latest();
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
                        'edit' => route('admin.delivery_methods.edit', $row->id),
                        'delete' => route('admin.delivery_methods.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'supplier_name','action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.delivery_methods.index');
            $dataTableConfig = trans('admin_datatables_constants.delivery_methods');
            $dataTableConfig['url'] = route('admin.delivery_methods.index');
            return view('admin.delivery_methods.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.delivery_methods.create');
        return view('admin.delivery_methods.create', compact('breadcums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:delivery_methods', 'max:250'],
            'status' => ['numeric'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {

            $obj = new DeliveryMethod;
            $obj->name = $request->name;
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Delivery Method Created successfully."));
                $result = ['message' => 'Delivery Method Created successfully.', 'status' => true];
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
        $breadcums = trans('admin_breadcums.delivery_methods.edit');
        $obj = DeliveryMethod::find($id); 
        if ($obj) {
            
            return view('admin.delivery_methods.edit', compact('breadcums', 'obj'));
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

            $obj = DeliveryMethod::find($id);
            $obj->name = $request->name;
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Delivery Method Update successfully."));
                $result = ['message' => 'Delivery Method Update successfully.', 'status' => true];
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
            $obj = DeliveryMethod::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Delivery Method Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Delivery Method Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
