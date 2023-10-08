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
                            <a href="{{ route('admin.discounts.index') }}" class="btn btn-primary">
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
                                    {!! Form::label('name', trans('admin.discounts.form.name_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('name', $obj->name, [
                                        'class' => 'form-control',
                                        'id' => 'name',
                                        'placeholder' => trans('admin.discounts.form.name_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_name"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('code', trans('admin.discounts.form.code_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('code', $obj->code, [
                                        'class' => 'form-control',
                                        'id' => 'code',
                                        'placeholder' => trans('admin.discounts.form.code_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_code"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('discount_type', trans('admin.discounts.form.discount_type_label')) !!}
                                    {!! Form::select('discount_type', [null => trans('admin.discounts.form.discount_type_placeholder')] + DISCOUNT_TYPE, $obj->type	, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('discount', trans('admin.discounts.form.discount_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('discount', $obj->discount, [
                                        'class' => 'form-control',
                                        'id' => 'discount',
                                        'placeholder' => trans('admin.discounts.form.discount_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_discount"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('start_date', trans('admin.discounts.form.start_date_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::date('start_date', date('Y-m-d',strtotime($obj->start_date)), [
                                        'class' => 'form-control',
                                        'id' => 'start_date',
                                        'placeholder' => trans('admin.discounts.form.start_date_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_start_date"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('end_date', trans('admin.discounts.form.end_date_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::date('end_date', date('Y-m-d',strtotime($obj->end_date)),[
                                        'class' => 'form-control',
                                        'id' => 'end_date',
                                        'placeholder' => trans('admin.discounts.form.end_date_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_end_date"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('status', trans('admin.discounts.form.status_label')) !!}
                                    {!! Form::select('status', [null => trans('admin.discounts.form.status_placeholder')] + FOEM_STATUS, $obj->status, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitPostForm('#CreateForm','{{ route('admin.discounts.update', $obj->id) }}')">Update</button>
                                    <a href="{{ route('admin.discounts.index') }}" class="btn btn-soft-success">Cancel</a>
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
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.discounts.index') }}");
        }
    </script>
@endsection
