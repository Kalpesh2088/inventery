<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest();
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
                        'edit' => route('admin.customer.edit', $row->id),
                        'delete' => route('admin.customer.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.customer.index');
            $dataTableConfig = trans('admin_datatables_constants.customer');
            $dataTableConfig['url'] = route('admin.customer.index');
            return view('admin.customer.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.customer.create');
        return view('admin.customer.create', compact('breadcums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
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
        $breadcums = trans('admin_breadcums.customer.edit');
        $obj = User::find($id); 
        if ($obj) {
            return view('admin.customer.edit', compact('breadcums', 'obj'));
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
            'status' => ['required'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {
            $obj = User::find($id);
            $obj->name = $request->name;
            $obj->email = $request->email;
            $obj->mobile_number = $request->mobile_number;
            $obj->phone_number = $request->phone_number;
            $obj->country = $request->country;
            $obj->state = $request->state;
            $obj->city = $request->city;
            $obj->lendmark = $request->lendmark;
            $obj->address = $request->address;
            $obj->description = $request->description;
            $obj->status = $request->status;
            $file_path = 'user_profile' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('profile_image')) {
                
                $obj->profile_image = $this->uploadFile($request->file('profile_image'), $file_path);
            }
            if ($obj->save()) {
                \Session::flash('success', trans("User Updated successfully."));
                $result = ['message' => 'User Updated successfully.', 'status' => true];
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
            $obj = User::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "User Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Brands Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
