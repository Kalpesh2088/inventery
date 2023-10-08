<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Admin::where("id", '!=',1)->latest();
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
                        'edit' => route('admin.employee.edit', $row->id),
                        'delete' => route('admin.employee.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.employee.index');
            $dataTableConfig = trans('admin_datatables_constants.employee');
            $dataTableConfig['url'] = route('admin.employee.index');
            return view('admin.employee.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.employee.create');
        $role = Role::where("id", '!=',1)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        return view('admin.employee.create', compact('breadcums' ,'role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:admins', 'max:250'],
            'role_id' => ['required'],
            'email' => ['required','email'],
            'mobile' => ['required'],
            'password' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'lendmak' => ['required'],
            'address' => ['required'],
            'pincode' => ['required' ,'min:6' ,'max:6'],
            'status' => ['required'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {
            $obj = new Admin;
            $obj->name = $request->name;
            $obj->role_id = $request->role_id;
            $obj->email = $request->email;
            $obj->mobile = $request->mobile;
            $obj->password = $request->password;
            $obj->country = $request->country;
            $obj->state = $request->state;
            $obj->city = $request->city;
            $obj->lendmak = $request->lendmak;
            $obj->address = $request->address;
            $obj->pincode = $request->pincode;
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Employee add successfully."));
                $result = ['message' => 'Employee add successfully.', 'status' => true];
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
        $breadcums = trans('admin_breadcums.employee.edit');
        $obj = Admin::find($id);
        $role = Role::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        if ($obj) {
            return view('admin.employee.edit', compact('breadcums', 'obj', 'role'));
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
            $obj = Admin::find($id);
            $obj->name = $request->name;
            $obj->role_id = $request->role_id;
            $obj->email = $request->email;
            $obj->mobile = $request->mobile;
            $obj->password = $request->password;
            $obj->country = $request->country;
            $obj->state = $request->state;
            $obj->city = $request->city;
            $obj->lendmak = $request->lendmak;
            $obj->address = $request->address;
            $obj->pincode = $request->pincode;
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Employee Updated successfully."));
                $result = ['message' => 'Employee Updated successfully.', 'status' => true];
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
            $obj = Admin::find($id);
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
