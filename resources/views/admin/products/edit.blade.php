@extends('layouts.admin')
@section('pagecss')
@endsection
@section('content')
    @include('layouts.admin.breadcums')

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="card-header border border-dashed border-start-0 border-end-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">
                                <i class="ri-arrow-left-line "></i>
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="javascript:void(0);" id="CreateForm">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('name', trans('admin.products.form.name_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('name', $obj->name, [
                                        'class' => 'form-control',
                                        'id' => 'name',
                                        'placeholder' => trans('admin.products.form.name_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_name"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('unit', trans('admin.products.form.unit_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('unit', $obj->unit, [
                                        'class' => 'form-control',
                                        'id' => 'unit',
                                        'placeholder' => trans('admin.products.form.unit_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_unit"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('minimum_quantity', trans('admin.products.form.minimum_quantity_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('minimum_quantity', $obj->minimum_quantity, [
                                        'class' => 'form-control',
                                        'id' => 'minimum_quantity',
                                        'placeholder' => trans('admin.products.form.minimum_quantity_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_minimum_quantity"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('quantity', trans('admin.products.form.quantity_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('quantity', $obj->quantity, [
                                        'class' => 'form-control',
                                        'id' => 'quantity',
                                        'placeholder' => trans('admin.products.form.quantity_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_quantity"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('tax', trans('admin.products.form.tax_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('tax', $obj->tax, [
                                        'class' => 'form-control',
                                        'id' => 'tax',
                                        'placeholder' => trans('admin.products.form.tax_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_tex"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('price', trans('admin.products.form.price_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('price', $obj->price, [
                                        'class' => 'form-control',
                                        'id' => 'price',
                                        'placeholder' => trans('admin.products.form.price_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_price"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('description', trans('admin.products.form.description_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('description', $obj->description, [
                                        'class' => 'form-control',
                                        'id' => 'description',
                                        'placeholder' => trans('admin.products.form.description_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_description"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('thumbnail', trans('admin.products.form.thumbnail_label')) !!}
                                    <input type="file" name="thumbnail" class="form-control" id="thumbnail">
                                     <span class="text-danger error-span pt-2" id="error_thumbnail"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('category_id', trans('admin.products.form.categories_label')) !!}
                                    {!! Form::select('category_id', [null => trans('admin.products.form.categories_placeholder')] + $categories, '1', [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('brand_id', trans('admin.products.form.brand_label')) !!}
                                    {!! Form::select('brand_id', [null => trans('admin.products.form.brand_placeholder')] + $brands, $obj->brand_id, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('discount_id', trans('admin.products.form.discount_label')) !!}
                                    {!! Form::select('discount_id', [null => trans('admin.products.form.discount_placeholder')] + $discounts, $obj->discount_id, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('status', trans('admin.products.form.status_label')) !!}
                                    {!! Form::select('status', [null => trans('admin.products.form.status_placeholder')] + FOEM_STATUS, $obj->status, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitPostForm('#CreateForm','{{ route('admin.products.update', $obj->id) }}')">Update</button>
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-soft-success">Cancel</a>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>

        </div>
        <!--end col-->
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function submitPostForm(form_id, form_action_url) {
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.products.index') }}");
        }
    </script>
@endsection
