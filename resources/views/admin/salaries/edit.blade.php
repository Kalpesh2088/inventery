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
                            <a href="{{ route('admin.salaries.index') }}" class="btn btn-primary">
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
                                    {!! Form::label('employee_id', trans('admin.salaries.form.employee_label')) !!}
                                    {!! Form::select('employee_id', [null => trans('admin.salaries.form.employee_placeholder')] + $employee, $obj->employee_id, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('date', trans('admin.salaries.form.date_label')) !!} <span class="text-danger">*</span>
                                    {!! Form::date('date', $obj->date, [
                                        'class' => 'form-control',
                                        'id' => 'date',
                                        'placeholder' => trans('admin.salaries.form.date_placeholder'),
                                        'required',
                                        'readonly',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_date"></span>
                                </div>
                            </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        {!! Form::label('salary', trans('admin.salaries.form.salary_label')) !!} <span class="text-danger">*</span>
                                        {!! Form::number('salary', $obj->salary, [
                                            'class' => 'form-control',
                                            'id' => 'salary',
                                            'placeholder' => trans('admin.salaries.form.salary_placeholder'),
                                            'required',
                                        ]) !!}
                                        <span class="text-danger error-span pt-2" id="error_name"></span>
                                    </div>
                                </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('status', trans('admin.salaries.form.status_label')) !!}
                                    {!! Form::select('status', [null => trans('admin.salaries.form.status_placeholder')] + PURCHAS_STATUS, $obj->status, [
                                        'class' => 'form-control  select2',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitPostForm('#CreateForm','{{ route('admin.salaries.update', $obj->id) }}')">Update</button>
                                    <a href="{{ route('admin.salaries.index') }}" class="btn btn-soft-success">Cancel</a>
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
            callPostAjax(form_action_url, form_id, 0, 1, "{{ route('admin.salaries.index') }}");
        }
    </script>
@endsection