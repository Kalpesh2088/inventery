@extends('layouts.admin')
@section('pagecss')
@endsection
@section('content')
    @include('layouts.admin.breadcums')
    <div class="col-lg-12">
        <div class="card" id="invoiceList">
            <div class="card-header border border-dashed border-start-0 border-end-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">
                        <a href="{{ route('admin.transfer_stocks.index') }}" class="btn btn-primary">
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
                                {!! Form::label('product_id', trans('admin.transfer_stocks.form.product_label')) !!}
                                {!! Form::select(
                                    'product_id',
                                    [null => trans('admin.transfer_stocks.form.product_placeholder')] + $productes,
                                    '1',
                                    [
                                        'class' => 'form-control  select2',
                                    ],
                                ) !!}
                                <span class="text-danger error-span pt-2" id="error_status"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('from_warehouse', trans('admin.transfer_stocks.form.from_warehouse_label')) !!}
                                {!! Form::select(
                                    'from_warehouse',
                                    [null => trans('admin.transfer_stocks.form.from_warehouse_placeholder')] + $warehouse,
                                    '1',
                                    [
                                        'class' => 'form-control  select2',
                                    ],
                                ) !!}
                                <span class="text-danger error-span pt-2" id="error_status"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('to_warehouse', trans('admin.transfer_stocks.form.to_warehouse_label')) !!}
                                {!! Form::select(
                                    'to_warehouse',
                                    [null => trans('admin.transfer_stocks.form.to_warehouse_placeholder')] + $warehouse,
                                    '1',
                                    [
                                        'class' => 'form-control  select2',
                                    ],
                                ) !!}
                                <span class="text-danger error-span pt-2" id="error_status"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('date', trans('admin.transfer_stocks.form.date_label')) !!} <span class="text-danger">*</span>
                                {!! Form::date('date', '', [
                                    'class' => 'form-control',
                                    'id' => 'date',
                                    'placeholder' => trans('admin.transfer_stocks.form.date_placeholder'),
                                    'required',
                                ]) !!}
                                <span class="text-danger error-span pt-2" id="error_date"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('order_numbr', trans('admin.transfer_stocks.form.order_numbr_label')) !!} <span class="text-danger">*</span>
                                {!! Form::number('order_numbr', '', [
                                    'class' => 'form-control',
                                    'id' => 'order_numbr',
                                    'placeholder' => trans('admin.transfer_stocks.form.order_numbr_placeholder'),
                                    'required',
                                ]) !!}
                                <span class="text-danger error-span pt-2" id="error_order_numbr"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('quantity', trans('admin.transfer_stocks.form.quantity_label')) !!} <span class="text-danger">*</span>
                                {!! Form::number('quantity', '', [
                                    'class' => 'form-control',
                                    'id' => 'quantity',
                                    'placeholder' => trans('admin.transfer_stocks.form.quantity_placeholder'),
                                    'required',
                                ]) !!}
                                <span class="text-danger error-span pt-2" id="error_quantity"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('invoice', trans('admin.transfer_stocks.form.invoice_label')) !!}
                                <input type="file" name="invoice" class="form-control" id="invoice">
                                 <span class="text-danger error-span pt-2" id="error_invoice"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('status', trans('admin.transfer_stocks.form.status_label')) !!}
                                {!! Form::select(
                                    'status',
                                    [null => trans('admin.transfer_stocks.form.status_placeholder')] + PURCHAS_STATUS,
                                    '1',
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
                                    onclick="submitPostForm('#CreateForm','{{ route('admin.transfer_stocks.store') }}')">Save</button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-soft-success">Cancel</a>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
            </div>
            <!--end row-->
            </form>
        </div>
    </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function submitPostForm(form_id, form_action_url) {
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.transfer_stocks.index') }}");
        }
    </script>
@endsection
