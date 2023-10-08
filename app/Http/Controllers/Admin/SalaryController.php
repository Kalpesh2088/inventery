<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Salary::latest();
            if (!empty($request->employee_id)) {
                $data = $data->where('employee_id', 'LIKE', '%' . $request->employee_id . '%');
            }
            if (!empty($request->status)) {
                $status = $request->status == 'delivery' ? 1 : 0;
                $data = $data->where('status', $status);
            }
            $data = $data->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('employee_name', function ($row) {
                    $admins = "";
                    if (!empty($row->admins)) {
                        $admins = $row->admins->name;
                    }
                    return $admins;
                })
                ->editColumn('status', function ($row) {
                    return $row->status == 1 ? 'delivery' : 'pending';
                })
                ->addColumn('action_checkbox', function ($row) {
                    return '<input class="form-check-input" type="checkbox" id="checkAll"
                    value="option">';
                })
                ->addColumn('action', function ($row) {
                    $actions = [
                        'edit' => route('admin.salaries.edit', $row->id),
                        'delete' => route('admin.salaries.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'employee_name', 'action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.salaries.index');
            $dataTableConfig = trans('admin_datatables_constants.salaries');
            $dataTableConfig['url'] = route('admin.salaries.index');
            return view('admin.salaries.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.salaries.create');
        $employee = Admin::where("id", '!=', 1)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        return view('admin.salaries.create', compact('breadcums', 'employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => ['required'],
            'date' => ['required'],
            'salary' => ['required'],
            'status' => ['required'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {
            $obj = Salary::whereMonth('date', $request->date)
                ->where('employee_id', $request->employee_id)
                ->first();
            if (empty($obj)) {
                $obj = new Salary;
                $obj->employee_id = $request->employee_id;
                $obj->date = $request->date;
                $obj->salary = $request->salary;
                $obj->status = $request->status;
                if ($obj->save()) {
                    \Session::flash('success', trans("Addeed Employee salary successfully."));
                    $result = ['message' => 'Addeed Employee salary successfully.', 'status' => true];
                    return response()->json($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'status' => false];
                    return response()->json($result, 200);
                }
            } else {
                $result = ['message' => 'Salary Already  Aded  in This  month.', 'status' => false];
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
        $breadcums = trans('admin_breadcums.salaries.edit');
        $obj = Salary::find($id);
        $employee = Admin::where("id", '!=', 1)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        if ($obj) {
            return view('admin.salaries.edit', compact('breadcums', 'obj', 'employee'));
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
            $obj = Salary::find($id);
            $obj->employee_id = $request->employee_id;
            $obj->date = $request->date;
            $obj->salary = $request->salary;
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Employee salary Updated successfully."));
                $result = ['message' => 'Employee salary Updated successfully.', 'status' => true];
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
            $obj = Salary::find($id);
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
        } catch (\Throwable $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
