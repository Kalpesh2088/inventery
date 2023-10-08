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
                        <a href="{{ route('admin.sales_order_returns.index') }}" class="btn btn-primary">
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
                                {!! Form::label('customer_id', trans('admin.sales_order_returns.form.customer_label')) !!}
                                {!! Form::select(
                                    'customer_id',
                                    [null => trans('admin.sales_order_returns.form.customer_placeholder')] + $user,
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
                                {!! Form::label('order', trans('admin.sales_order_returns.form.order_label')) !!} <span class="text-danger">*</span>
                                {!! Form::number('order', '', [
                                    'class' => 'form-control',
                                    'id' => 'order',
                                    'placeholder' => trans('admin.sales_order_returns.form.order_placeholder'),
                                    'required',
                                ]) !!}
                                <span class="text-danger error-span pt-2" id="error_name"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('status', trans('admin.sales_order_returns.form.status_label')) !!}
                                {!! Form::select(
                                    'status',
                                    [null => trans('admin.sales_order_returns.form.status_placeholder')] + PURCHAS_STATUS,
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
                                    onclick="submitPostForm('#CreateForm','{{ route('admin.sales_order_returns.store') }}')">Save</button>
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
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.sales_order_returns.index') }}");
        }
    </script>
@endsection
