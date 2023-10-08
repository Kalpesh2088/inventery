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
                            <a href="{{ route('admin.warehouses.index') }}" class="btn btn-primary">
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
                                    {!! Form::label('name', trans('admin.warehouses.form.name_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('name', '', [
                                        'class' => 'form-control',
                                        'id' => 'name',
                                        'placeholder' => trans('admin.warehouses.form.name_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_name"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('email', trans('admin.warehouses.form.email_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('email', '', [
                                        'class' => 'form-control',
                                        'id' => 'email',
                                        'placeholder' => trans('admin.warehouses.form.email_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_email"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('code', trans('admin.warehouses.form.code_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('code', '', [
                                        'class' => 'form-control',
                                        'id' => 'code',
                                        'placeholder' => trans('admin.warehouses.form.code_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_code"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('phone_number', trans('admin.warehouses.form.phone_number_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('phone_number', '', [
                                        'class' => 'form-control',
                                        'type' => "phone_number",
                                        'id' => 'phone_number',
                                        'placeholder' => trans('admin.warehouses.form.phone_number_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_phone_number"></span>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('address', trans('admin.warehouses.form.address_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('address', '', [
                                        'class' => 'form-control',
                                        'id' => 'address',
                                        'placeholder' => trans('admin.warehouses.form.address_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('logo', trans('admin.warehouses.form.logo_label')) !!}<span class="text-danger">*</span>
                                    <input type="file" name="logo" class="form-control" id="logo">
                                     <span class="text-danger error-span pt-2" id="error_logo"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('status', trans('admin.warehouses.form.status_label')) !!}
                                    {!! Form::select('status', [null => trans('admin.warehouses.form.status_placeholder')] + FOEM_STATUS, '1', [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitPostForm('#CreateForm','{{ route('admin.warehouses.store') }}')">Save</button>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-soft-success">Cancel</a>
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
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.warehouses.index') }}");
        }
    </script>
@endsection
