@extends('layouts.admin')
@section('pagecss')
    <link href="{{ asset('admin/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <style>
        .bootstrap-tagsinput {
            line-height: 29px
        }
    </style>
@endsection
@section('content')
    @include('layouts.admin.breadcums')

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="invoiceList">
                <div class="card-header border border-dashed border-start-0 border-end-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">
                            <a href="{{ route('admin.settings.index') }}" class="btn btn-primary">
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
                                    {!! Form::label('group', 'Grop') !!} <span class="text-danger">*</span>
                                    {!! Form::select('group', [null => 'Select Grop'] + $groups, '', [
                                        'class' => 'form-control  select2',
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_group"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('label', 'Settigs Label') !!} <span class="text-danger">*</span>
                                    {!! Form::text('label', '', [
                                        'class' => 'form-control',
                                        'id' => 'label',
                                        'placeholder' => 'Enter Label Name',
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_label"></span>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('key', 'Key') !!} <span class="text-danger">*</span>
                                    {!! Form::text('key', '', [
                                        'class' => 'form-control',
                                        'id' => 'key',
                                        'placeholder' => 'Enter Key Name',
                                        'oninput' => "this.value = this.value.replace(/[^a-zA-Z_]/g, '').replace(/(\..*)\./g, '$1');",
                                        'required',
                                    ]) !!}
                                    <span class="text-danger  error-span pt-2" id="error_key"></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::label('input_type', 'Input Type') !!} <span class="text-danger">*</span>
                                    {!! Form::select('input_type', [null => 'Select Input Type'] + $input_types, '', [
                                        'class' => 'form-control  select2',
                                        'id' => 'input_type',
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_input_type"></span>
                                </div>
                            </div>

                            <div class="col-lg-6" id="input_value_section">
                                <div class="mb-3">
                                    {!! Form::label('input_value', 'Value') !!}<span class="text-danger">*</span>
                                    {!! Form::text('value', '', [
                                        'class' => 'form-control',
                                        'id' => 'input_value',
                                        'placeholder' => 'Enter Value',
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_value"></span>
                                </div>
                            </div>

                            <div class="col-lg-12" id="input_options_section" style="display: none">
                                <div class="mb-3">
                                    {!! Form::label('input_options', 'Input Options') !!}<span class="text-danger">*</span><br>
                                    {!! Form::text('input_options', '', [
                                        'class' => 'form-control',
                                        'id' => 'input_options',
                                        'placeholder' => 'Enter Input Options',
                                        'data-role' => 'tagsinput',
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_input_options"></span>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    {!! Form::label('status', 'Status') !!} <span class="text-danger">*</span>
                                    {!! Form::select('status', [null => 'Select Status', 0 => 'In-Active', 1 => 'Active'], 1, [
                                        'class' => 'form-control  select2',
                                        'required',
                                    ]) !!}
                                    <span class="text-danger error-span pt-2" id="error_status"></span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-primary"
                                        onclick="submitPostForm('#CreateForm','{{ route('admin.settings.store') }}')">Save</button>
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
    @include('admin.settings.coman-sctipt')
@endsection
