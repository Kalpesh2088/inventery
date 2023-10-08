<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseCategories;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Expense::latest();
            if (!empty($request->category_id)) {
                $data = $data->where('category_id', 'LIKE', '%' . $request->category_id . '%');
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
                ->addColumn('categories_name', function ($row) {
                    $expense_categories = "";
                    if (!empty($row->expense_categories)) {
                        $expense_categories = $row->expense_categories->name;
                    }
                    return $expense_categories;
                })
                ->addColumn('action_checkbox', function ($row) {
                    return '<input class="form-check-input" type="checkbox" id="checkAll"
                    value="option">';
                })
                ->addColumn('action', function ($row) {
                    $actions = [
                        'edit' => route('admin.expenses.edit', $row->id),
                        'delete' => route('admin.expenses.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'categories_name','action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.expenses.index');
            $dataTableConfig = trans('admin_datatables_constants.expenses');
            $dataTableConfig['url'] = route('admin.expenses.index');
            return view('admin.expenses.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.expenses.create');
        $expense = ExpenseCategories::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        return view('admin.expenses.create', compact('breadcums','expense'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => ['required'],
            'date' => ['required'],
            'amount' => ['required'],
            'receipt' => ['required'],
            'reference' => ['required'],
            'descriptiion' => ['required'],
            'status' => ['numeric'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {

            $obj = new Expense;
            $obj->category_id = $request->category_id;
            $obj->date = $request->date;
            $obj->amount = $request->amount;
            $obj->receipt = $request->receipt;
            $obj->reference = $request->reference;
            $obj->descriptiion = $request->descriptiion;
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Expense Created successfully."));
                $result = ['message' => 'Expense Categories Created successfully.', 'status' => true];
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
        $breadcums = trans('admin_breadcums.expenses.edit');
        $obj = ExpenseCategories::find($id); 
        if ($obj) {
            $expense = ExpenseCategories::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
            return view('admin.expenses.edit', compact('breadcums', 'obj' ,'expense'));
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

            $obj = Expense::find($id);
            $obj->category_id = $request->category_id;
            $obj->date = $request->date;
            $obj->amount = $request->amount;
            $obj->receipt = $request->receipt;
            $obj->reference = $request->reference;
            $obj->descriptiion = $request->descriptiion;
            $obj->status = $request->status;
            if ($obj->save()) {
                \Session::flash('success', trans("Expense Update successfully."));
                $result = ['message' => 'Expense Update successfully.', 'status' => true];
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
            $obj = Expense::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Expense Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Expense Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
