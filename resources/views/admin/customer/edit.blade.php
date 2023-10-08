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
                            <a href="{{ route('admin.customer.index') }}" class="btn btn-primary">
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
                                    {!! Form::label('name', trans('admin.customer.form.name_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('name', $obj->name, [
                                        'class' => 'form-control',
                                        'id' => 'name',
                                        'placeholder' => trans('admin.customer.form.name_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_name"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('email', trans('admin.customer.form.email_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('email', $obj->email, [
                                        'class' => 'form-control',
                                        'id' => 'email',
                                        'placeholder' => trans('admin.customer.form.email_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_email"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('mobile_number', trans('admin.customer.form.mobile_number_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::number('mobile_number', $obj->mobile_number, [
                                        'class' => 'form-control',
                                        'id' => 'mobile_number',
                                        'placeholder' => trans('admin.customer.form.mobile_number_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile_number"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('phone_number', trans('admin.customer.form.phone_number_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('phone_number', $obj->phone_number, [
                                        'class' => 'form-control',
                                        'type' => "phone_number",
                                        'id' => 'phone_number',
                                        'placeholder' => trans('admin.customer.form.phone_number_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_phone_number"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('country', trans('admin.customer.form.country_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('country', $obj->country, [
                                        'class' => 'form-control',
                                        'id' => 'country',
                                        'placeholder' => trans('admin.customer.form.country_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('state', trans('admin.customer.form.state_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('state', $obj->state, [
                                        'class' => 'form-control',
                                        'id' => 'state',
                                        'placeholder' => trans('admin.customer.form.state_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('city', trans('admin.customer.form.city_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('city', $obj->city, [
                                        'class' => 'form-control',
                                        'id' => 'city',
                                        'placeholder' => trans('admin.customer.form.city_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('lendmark', trans('admin.customer.form.lendmak_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('lendmark', $obj->lendmark, [
                                        'class' => 'form-control',
                                        'id' => 'lendmark',
                                        'placeholder' => trans('admin.customer.form.lendmak_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('address', trans('admin.customer.form.address_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('address', $obj->address, [
                                        'class' => 'form-control',
                                        'id' => 'address',
                                        'placeholder' => trans('admin.customer.form.address_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('description', trans('admin.customer.form.description_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::text('description', $obj->description, [
                                        'class' => 'form-control',
                                        'id' => 'description',
                                        'placeholder' => trans('admin.customer.form.description_placeholder'),
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_description"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('profile_image', trans('admin.customer.form.profile_image_label')) !!}<span class="text-danger">*</span>
                                    <input type="file" name="profile_image" class="form-control" id="profile_image">
                                     <span class="text-danger error-span pt-2" id="error_profile_image"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('status', trans('admin.customer.form.status_label')) !!}
                                    {!! Form::select('status', [null => trans('admin.customer.form.status_placeholder')] + FOEM_STATUS, $obj->status, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitPostForm('#CreateForm','{{ route('admin.customer.update', $obj->id) }}')">Update</button>
                                    <a href="{{ route('admin.customer.index') }}" class="btn btn-soft-success">Cancel</a>
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
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.customer.index') }}");
        }
    </script>
@endsection
