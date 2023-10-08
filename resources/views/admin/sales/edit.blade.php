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
                            <a href="{{ route('admin.sales.index') }}" class="btn btn-primary">
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
                                    {!! Form::label('products_id', trans('admin.sales.form.products_label')) !!}
                                    {!! Form::select(
                                        'products_id',
                                        [null => trans('admin.sales.form.products_placeholder')] + $productes,
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
                                    {!! Form::label('customer_id', trans('admin.sales.form.customer_label')) !!}
                                    {!! Form::select('customer_id', [null => trans('admin.sales.form.customer_placeholder')] + $customer, $obj->customer_id, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('payment_id', trans('admin.sales.form.payment_label')) !!}
                                    {!! Form::select('payment_id', [null => trans('admin.sales.form.payment_placeholder')] + $payment, $obj->payment_id, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('delivery_id', trans('admin.sales.form.delivery_label')) !!}
                                    {!! Form::select('delivery_id', [null => trans('admin.sales.form.delivery_placeholder')] + $delivery, $obj->delivery_id, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('so_number', trans('admin.sales.form.so_number_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('so_number', $obj->so_number, [
                                        'class' => 'form-control',
                                        'id' => 'so_number',
                                        'placeholder' => trans('admin.sales.form.so_number_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_so_number"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('order_date', trans('admin.sales.form.order_date_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::date('order_date', $obj->order_date, [
                                        'class' => 'form-control',
                                        'id' => 'order_date',
                                        'placeholder' => trans('admin.sales.form.order_date_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_order_date"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('expected_shipment_date', trans('admin.sales.form.expected_shipment_date_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::date('expected_shipment_date', $obj->expected_shipment_date, [
                                        'class' => 'form-control',
                                        'id' => 'expected_shipment_date',
                                        'placeholder' => trans('admin.sales.form.expected_shipment_date_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_expected_shipment_date"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('attachFile', trans('admin.sales.form.attachFile_label')) !!}<span class="text-danger">*</span>
                                    <input type="file" name="attachFile" class="form-control" id="attachFile">
                                    <span class="text-danger error-span pt-2" id="error_attachFile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('sale_quantity', trans('admin.sales.form.sale_quantity_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('sale_quantity', $obj->sale_quantity, [
                                        'class' => 'form-control',
                                        'id' => 'sale_quantity',
                                        'placeholder' => trans('admin.sales.form.sale_quantity_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_name"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('sale_amount', trans('admin.sales.form.sale_amount_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('sale_amount', $obj->sale_amount, [
                                        'class' => 'form-control',
                                        'id' => 'sale_amount',
                                        'placeholder' => trans('admin.sales.form.sale_amount_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_unit"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('status', trans('admin.sales.form.status_label')) !!}
                                    {!! Form::select(
                                        'status',
                                        [null => trans('admin.sales.form.status_placeholder')] + PURCHAS_STATUS,
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
                                        onclick="submitPostForm('#CreateForm','{{ route('admin.sales.update', $obj->id) }}')">Update</button>
                                    <a href="{{ route('admin.sales.index') }}" class="btn btn-soft-success">Cancel</a>
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
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.sales.index') }}");
        }
    </script>
@endsection
