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
                            <a href="{{ route('admin.purchases.index') }}" class="btn btn-primary">
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
                                    {!! Form::label('products_id', trans('admin.purchases.form.products_label')) !!}
                                    {!! Form::select(
                                        'products_id',
                                        [null => trans('admin.purchases.form.products_placeholder')] + $productes,
                                        $obj->products_id,
                                        [
                                            'class' => 'form-control  select2',
                                        ],
                                    ) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('supplier_id', trans('admin.purchases.form.supplier_label')) !!}
                                    {!! Form::select('supplier_id', [null => trans('admin.purchases.form.supplier_placeholder')] + $supplier, $obj->supplier_id, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('purchased_quantity', trans('admin.purchases.form.purchased_quantity_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('purchased_quantity', $obj->purchased_quantity, [
                                        'class' => 'form-control',
                                        'id' => 'purchased_quantity',
                                        'placeholder' => trans('admin.purchases.form.purchased_quantity_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_name"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('request_numbe', trans('admin.purchases.form.request_numbe_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('request_numbe', $obj->request_numbe, [
                                        'class' => 'form-control',
                                        'id' => 'request_numbe',
                                        'placeholder' => trans('admin.purchases.form.request_numbe_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_request_numbe"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('supplier_invoice_number', trans('admin.purchases.form.supplier_invoice_number_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('supplier_invoice_number', $obj->supplier_invoice_number, [
                                        'class' => 'form-control',
                                        'id' => 'supplier_invoice_number',
                                        'placeholder' => trans('admin.purchases.form.supplier_invoice_number_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_supplier_invoice_number"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('date', trans('admin.purchases.form.date_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::date('date', $obj->date, [
                                        'class' => 'form-control',
                                        'id' => 'date',
                                        'placeholder' => trans('admin.purchases.form.date_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_date"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('delivery_date', trans('admin.purchases.form.delivery_date_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::date('delivery_date', $obj->delivery_date, [
                                        'class' => 'form-control',
                                        'id' => 'delivery_date',
                                        'placeholder' => trans('admin.purchases.form.delivery_date_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_delivery_date"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('packaging_type', trans('admin.purchases.form.packaging_type_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('packaging_type', $obj->packaging_type, [
                                        'class' => 'form-control',
                                        'id' => 'packaging_type',
                                        'placeholder' => trans('admin.purchases.form.packaging_type_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_packaging_type"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('description', trans('admin.purchases.form.description_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('description',  $obj->description, [
                                        'class' => 'form-control',
                                        'id' => 'description',
                                        'placeholder' => trans('admin.purchases.form.description_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_description"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('purchased_amount', trans('admin.purchases.form.purchased_amount_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('purchased_amount', $obj->purchased_amount, [
                                        'class' => 'form-control',
                                        'id' => 'purchased_amount',
                                        'placeholder' => trans('admin.purchases.form.purchased_amount_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_unit"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('status', trans('admin.purchases.form.status_label')) !!}
                                    {!! Form::select(
                                        'status',
                                        [null => trans('admin.purchases.form.status_placeholder')] + PURCHAS_STATUS,
                                        $obj->status,
                                        [
                                            'class' => 'form-control  select2',
                                        ],
                                    ) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitPostForm('#CreateForm','{{ route('admin.purchases.update', $obj->id) }}')">Update</button>
                                    <a href="{{ route('admin.purchases.index') }}" class="btn btn-soft-success">Cancel</a>
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
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.purchases.index') }}");
        }
    </script>
@endsection
