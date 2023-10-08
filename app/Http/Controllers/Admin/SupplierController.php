<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::latest();
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
                        'edit' => route('admin.suppliers.edit', $row->id),
                        'delete' => route('admin.suppliers.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.suppliers.index');
            $dataTableConfig = trans('admin_datatables_constants.suppliers');
            $dataTableConfig['url'] = route('admin.suppliers.index');
            return view('admin.suppliers.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.suppliers.create');
        return view('admin.suppliers.create', compact('breadcums'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:admins', 'max:250'],
            'email'=> ['required', 'email'],
            'mobile_number'=> ['required'],
            'phone_number'=> ['required'],
            'address'=> ['required'],
            'country'=> ['required'],
            'state'=> ['required'],
            'city'=> ['required'],
            'lendmark'=> ['required'],
            'logo'=> ['required'],
            'description'=> ['required'],
            'website'=> ['required'],
            'status' => ['required'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {
            $obj = new Supplier;
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
            $obj->website = $request->website;
            $obj->status = $request->status;
            $file_path = 'suppliers_logo' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('logo')) {
                
                $obj->logo = $this->uploadFile($request->file('logo'), $file_path);
            }
            if ($obj->save()) {
                \Session::flash('success', trans("Suppliers add successfully."));
                $result = ['message' => 'Suppliers add successfully.', 'status' => true];
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
        $breadcums = trans('admin_breadcums.suppliers.edit');
        $obj = Supplier::find($id); 
        if ($obj) {
            return view('admin.suppliers.edit', compact('breadcums', 'obj'));
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
            $obj = Supplier::find( $id );
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
            $obj->website = $request->website;
            $obj->status = $request->status;
            $file_path = 'suppliers_logo' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('logo')) {
                
                $obj->logo = $this->uploadFile($request->file('logo'), $file_path);
            }
            if ($obj->save()) {
                \Session::flash('success', trans("Suppliers update successfully."));
                $result = ['message' => 'Suppliers update successfully.', 'status' => true];
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
            $obj = Supplier::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Supplier Deleted Successfully", 'data' => [], 'status' => true];
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
