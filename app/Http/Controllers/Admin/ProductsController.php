<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest();
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
                ->addColumn('category_name', function ($row) {
                    return 'AAAAA';
                })
                ->addColumn('brand_name', function ($row) {
                    return 'BBB';
                })
                ->addColumn('action', function ($row) {
                    $actions = [
                        'edit' => route('admin.products.edit', $row->id),
                        'delete' => route('admin.products.destroy', $row->id),
                    ];
                    return view('layouts.admin.elements.list_actions', compact('actions'));
                })
                ->rawColumns(['action_checkbox', 'category_name', 'brand_name', 'action'])
                ->make(true);
        } else {

            $breadcums = trans('admin_breadcums.products.index');
            $dataTableConfig = trans('admin_datatables_constants.products');
            $dataTableConfig['url'] = route('admin.products.index');
            return view('admin.products.index', compact('breadcums', 'dataTableConfig'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcums = trans('admin_breadcums.products.create');
        $categories = Category::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $discounts = Discount::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $brands = Brand::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        return view('admin.products.create', compact('breadcums', 'categories', 'discounts', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:products', 'max:250'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'unit' => ['required'],
            'minimum_quantity' => ['required'],
            'quantity' => ['required'],
            'description' => ['required'],
            'tax' => ['required'],
            'price' => ['required'],
            'thumbnail' => ['required'],
            'status' => ['required'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $result = ['message' => '', 'errors' => $errors, 'status' => 'validator_error'];
            return response()->json($result, 200);
        }
        try {
            $obj = new Product;
            $obj->name = $request->name;
            $obj->status = $request->status;
            $obj->category_id = $request->category_id;
            $obj->brand_id = $request->brand_id;
            $obj->discount_id = $request->discount_id;
            $obj->unit = $request->unit;
            $obj->minimum_quantity = $request->minimum_quantity;
            $obj->price = $request->price;
            $obj->quantity = $request->quantity;
            $obj->description = $request->description;
            $obj->tax = $request->tax;
            $file_path = 'Product_thumbnail' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('thumbnail')) {

                $obj->thumbnail = $this->uploadFile($request->file('thumbnail'), $file_path);
            }
            if ($obj->save()) {
                \Session::flash('success', trans("Product Created successfully."));
                $result = ['message' => 'Product Created successfully.', 'status' => true];
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
        $breadcums = trans('admin_breadcums.products.edit');
        $obj = Product::find($id);
        $categories = Category::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $discounts = Discount::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $brands = Brand::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        if ($obj) {
            return view('admin.products.edit', compact('breadcums', 'obj', 'categories', 'discounts', 'brands'));
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
            $obj = Product::find($id);
            $obj->name = $request->name;
            $obj->status = $request->status;
            $obj->category_id = $request->category_id;
            $obj->brand_id = $request->brand_id;
            $obj->discount_id = $request->discount_id;
            $obj->unit = $request->unit;
            $obj->minimum_quantity = $request->minimum_quantity;
            $obj->price = $request->price;
            $obj->quantity = $request->quantity;
            $obj->description = $request->description;
            $obj->tax = $request->tax;
            $file_path = 'Product_thumbnail' . DIRECTORY_SEPARATOR;
            if ($request->hasfile('thumbnail')) {

                $obj->thumbnail = $this->uploadFile($request->file('thumbnail'), $file_path);
            }
            if ($obj->save()) {
                \Session::flash('success', trans("Product Updated successfully."));
                $result = ['message' => 'Product Updated successfully.', 'status' => true];
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
            $obj = Product::find($id);
            if ($obj) {
                if ($obj->delete()) {
                    $result = ['message' => "Product Deleted Successfully", 'data' => [], 'status' => true];
                    return response($result, 200);
                } else {
                    $result = ['message' => 'Oops..something has went wrong. Please try again.', 'data' => [], 'status' => false];
                    return response($result, 200);
                }
            } else {
                $result = ['message' => "Product Data Not Found...", 'data' => [], 'status' => false];
                return response($result, 200);
            }
        } catch (\Throwable $e) {
            $result = ['message' => $e->getMessage(), 'status' => false];
            return response($result, 200);
        }
    }
}
