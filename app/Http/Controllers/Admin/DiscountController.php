<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Discount::latest();
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
                        'edit' => route('admin.discounts.edit', $row->id),
                        'delete' => route('admin.discounts.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.discounts.index');
            $dataTableConfig = trans('admin_datatables_constants.discounts');
            $dataTableConfig['url'] = route('admin.discounts.index');
            return view('admin.discounts.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.discounts.create');
        return view('admin.discounts.create', compact('breadcums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:discounts', 'max:250'],
            'code' => ['required'],
            'discount_type' => ['required'],
            'discount' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'status' => ['required'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {
            $obj = new Discount;
            $obj->name = $request->name;
            $obj->status = $request->status;
            $obj->type = $request->discount_type;
            $obj->code = $request->code;
            $obj->discount = $request->discount;
            $obj->start_date = $request->start_date;
            $obj->end_date = $request->end_date;
            if ($obj->save()) {
                \Session::flash('success', trans("Discount Created successfully."));
                $result = ['message' => 'Discount Created successfully.', 'status' => true];
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
        $breadcums = trans('admin_breadcums.discounts.edit');
        $obj = Discount::find($id); 
        if ($obj) {
            return view('admin.discounts.edit', compact('breadcums', 'obj'));
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
            'name' => ['required', 'string', Rule::unique('discounts', 'name')->ignore($id), 'max:250'],
            'status' => ['numeric'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {
            $obj = Discount::find($id);
            $obj->name = $request->name;
            $obj->status = $request->status;
            $obj->type = $request->discount_type;
            $obj->code = $request->code;
            $obj->discount = $request->discount;
            $obj->start_date = $request->start_date;
            $obj->end_date = $request->end_date;
            if ($obj->save()) {
                \Session::flash('success', trans("Discount Updated successfully."));
                $result = ['message' => 'Discount Updated successfully.', 'status' => true];
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
            $obj = Discount::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Discount Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Discount Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
