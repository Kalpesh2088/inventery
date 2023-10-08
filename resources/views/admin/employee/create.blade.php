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
                            <a href="{{ route('admin.employee.index') }}" class="btn btn-primary">
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
                                    {!! Form::label('name', trans('admin.employee.form.name_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('name', '', [
                                        'class' => 'form-control',
                                        'id' => 'name',
                                        'placeholder' => trans('admin.employee.form.name_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_name"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('role_id', trans('admin.employee.form.role_label')) !!}<span class="text-danger">*</span>
                                    {!! Form::select('role_id', [null => trans('admin.employee.form.role_placeholder')] + $role, '1', [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('email', trans('admin.employee.form.email_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('email', '', [
                                        'class' => 'form-control',
                                        'id' => 'email',
                                        'placeholder' => trans('admin.employee.form.email_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_email"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('mobile', trans('admin.employee.form.mobile_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('mobile', '', [
                                        'class' => 'form-control',
                                        'id' => 'mobile',
                                        'placeholder' => trans('admin.employee.form.mobile_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('password', trans('admin.employee.form.password_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('password', '', [
                                        'class' => 'form-control',
                                        'type' => "password",
                                        'id' => 'password',
                                        'placeholder' => trans('admin.employee.form.password_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('country', trans('admin.employee.form.country_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('country', '', [
                                        'class' => 'form-control',
                                        'id' => 'country',
                                        'placeholder' => trans('admin.employee.form.country_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('state', trans('admin.employee.form.state_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('state', '', [
                                        'class' => 'form-control',
                                        'id' => 'state',
                                        'placeholder' => trans('admin.employee.form.state_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('city', trans('admin.employee.form.city_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('city', '', [
                                        'class' => 'form-control',
                                        'id' => 'city',
                                        'placeholder' => trans('admin.employee.form.city_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('lendmak', trans('admin.employee.form.lendmak_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('lendmak', '', [
                                        'class' => 'form-control',
                                        'id' => 'lendmak',
                                        'placeholder' => trans('admin.employee.form.lendmak_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('address', trans('admin.employee.form.address_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('address', '', [
                                        'class' => 'form-control',
                                        'id' => 'address',
                                        'placeholder' => trans('admin.employee.form.address_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('pincode', trans('admin.employee.form.pincode_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('pincode', '', [
                                        'class' => 'form-control',
                                        'id' => 'pincode',
                                        'placeholder' => trans('admin.employee.form.pincode_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('status', trans('admin.employee.form.status_label')) !!}
                                    {!! Form::select('status', [null => trans('admin.employee.form.status_placeholder')] + FOEM_STATUS, '1', [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitPostForm('#CreateForm','{{ route('admin.employee.store') }}')">Save</button>
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
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.employee.index') }}");
        }
    </script>
@endsection
