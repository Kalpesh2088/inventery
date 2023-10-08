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
                        <a href="{{ route('admin.expenses.index') }}" class="btn btn-primary">
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
                                {!! Form::label('category_id', trans('admin.expenses.form.expenses_label')) !!}
                                {!! Form::select('category_id', [null => trans('admin.expenses.form.expenses_placeholder')] + $expense, '1', [
                                    'class' => 'form-control  select2',
                                ]) !!}
                                <span class="text-danger error-span pt-2" id="error_status"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('date', trans('admin.expenses.form.date_label')) !!} <span class="text-danger">*</span>
                                {!! Form::date('date', '', [
                                    'class' => 'form-control',
                                    'id' => 'date',
                                    'placeholder' => trans('admin.expenses.form.date_placeholder'),
                                    'required',
                                ]) !!}
                                <span class="text-danger error-span pt-2" id="error_date"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('amount', trans('admin.expenses.form.amount_label')) !!} <span class="text-danger">*</span>
                                {!! Form::number('amount', '', [
                                    'class' => 'form-control',
                                    'id' => 'amount',
                                    'placeholder' => trans('admin.expenses.form.amount_placeholder'),
                                    'required',
                                ]) !!}
                                <span class="text-danger error-span pt-2" id="error_amount"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('receipt', trans('admin.expenses.form.receipt_label')) !!} <span class="text-danger">*</span>
                                {!! Form::text('receipt', '', [
                                    'class' => 'form-control',
                                    'id' => 'receipt',
                                    'placeholder' => trans('admin.expenses.form.receipt_placeholder'),
                                    'required',
                                ]) !!}
                                <span class="text-danger error-span pt-2" id="error_receipt"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('reference', trans('admin.expenses.form.reference_label')) !!} <span class="text-danger">*</span>
                                {!! Form::text('reference', '', [
                                    'class' => 'form-control',
                                    'id' => 'reference',
                                    'placeholder' => trans('admin.expenses.form.reference_placeholder'),
                                    'required',
                                ]) !!}
                                <span class="text-danger error-span pt-2" id="error_reference"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('descriptiion', trans('admin.expenses.form.descriptiion_label')) !!} <span class="text-danger">*</span>
                                {!! Form::text('descriptiion', '', [
                                    'class' => 'form-control',
                                    'id' => 'descriptiion',
                                    'placeholder' => trans('admin.expenses.form.descriptiion_placeholder'),
                                    'required',
                                ]) !!}
                                <span class="text-danger error-span pt-2" id="error_descriptiion"></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                {!! Form::label('status', trans('admin.expenses.form.status_label')) !!}
                                {!! Form::select('status', [null => trans('admin.expenses.form.status_placeholder')] + FOEM_STATUS, '1', [
                                    'class' => 'form-control  select2',
                                ]) !!}
                                <span class="text-danger error-span pt-2" id="error_status"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-primary"
                                    onclick="submitPostForm('#CreateForm','{{ route('admin.expenses.store') }}')">Save</button>
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
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.expenses.index') }}");
        }
    </script>
@endsection
