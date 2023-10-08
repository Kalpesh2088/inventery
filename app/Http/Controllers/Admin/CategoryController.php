<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest();
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
                        'edit' => route('admin.categories.edit', $row->id),
                        'delete' => route('admin.categories.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.categories.index');
            $dataTableConfig = trans('admin_datatables_constants.categories');
            $dataTableConfig['url'] = route('admin.categories.index');
            return view('admin.categories.index', compact('breadcums', 'dataTableConfig'));
        }
            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.categories.create');
        $categories = Category::where('parent_id', 0)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        return view('admin.categories.create', compact('breadcums', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:categories', 'max:250'],
            'image' => ['required'],
            'status' => ['numeric'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {

            $obj = new Category;
            if (!empty($request->parent_id)) {
                $obj->parent_id = $request->parent_id;
            }
            $obj->name = $request->name;
            $obj->status = $request->status;
            $file_path = 'category_images' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('image')) {
                
                $obj->image = $this->uploadFile($request->file('image'), $file_path);
            }
            if ($obj->save()) {
                \Session::flash('success', trans("Category Created successfully."));
                $result = ['message' => 'Category Created successfully.', 'status' => true];
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
        $breadcums = trans('admin_breadcums.categories.edit');
        $obj = Category::find($id); 
        if ($obj) {
            $categories = Category::where('parent_id', 0)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
            return view('admin.categories.edit', compact('breadcums', 'obj', 'categories'));
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
            'name' => ['required', 'string', Rule::unique('categories', 'name')->ignore($id), 'max:250'],
            'status' => ['numeric'],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }

        try {

            $obj = Category::find($id);
            if (!empty($request->parent_id)) {
                $obj->parent_id = $request->parent_id;
            }
            $obj->name = $request->name;
            $obj->status = $request->status;
            $file_path = 'category_images' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('image')) {
                
                $obj->image = $this->uploadFile($request->file('image'), $file_path);
            }
            if ($obj->save()) {
                \Session::flash('success', trans("Category Updated successfully."));
                $result = ['message' => 'Category Updated successfully.', 'status' => true];
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
            $obj = Category::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Category Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Category Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable$e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
