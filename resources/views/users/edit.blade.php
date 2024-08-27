@extends('layouts.master')

@section('css')
    <!-- Internal Nice-select css -->
    <link href="{{ URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
@endsection

@section('title')
    تعديل مستخدم -  للإدارة القانونية
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                    مستخدم</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>خطأ!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-3">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">رجوع</a>
                    </div>

                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row mg-b-20">
                            <div class="col-md-6">
                                <label for="name">اسم المستخدم: <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" required id="name">
                            </div>
                        </div>
                        <div class="row mg-b-20">
                            <div class="col-md-6">
                                <label for="email">البريد الإلكتروني: <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required id="email">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>كلمة المرور: <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class=" form-control form-control-sm" placeholder="كلمة المرور" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>تأكيد كلمة المرور: <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" class=" form-control form-control-sm" placeholder="تأكيد كلمة المرور" required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-sm mg-b-20">
                            <div class="col-lg-6">
                                <label class="form-label" for="status">حالة المستخدم</label>
                                <select name="Status" class="form-control nice-select" id="status">
                                    <option value="مفعل" {{ $user->Status == 'مفعل' ? 'selected' : '' }}>مفعل</option>
                                    <option value="غير مفعل" {{ $user->Status == 'غير مفعل' ? 'selected' : '' }}>غير مفعل
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mg-b-20">
                            <div class="col-md-12">
                                <label for="roles">نوع المستخدم</label>
                                <select name="roles_name[]" class="form-control" multiple id="roles">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}"
                                            {{ in_array($role, $userRole) ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- يمكنك إضافة الحقول الأخرى هنا -->

                        <div class="text-center">
                            <button type="submit" class="btn btn-main-primary pd-x-20">تحديث</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <!-- row closed -->
    @endsection

    @section('js')
        <!-- Internal Nice-select js -->
        <script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
        <!-- Internal Parsley.min js -->
        <script src="{{ URL::asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
        <!-- Internal Form-validation js -->
        <script src="{{ URL::asset('assets/js/form-validation.js') }}"></script>

        <script>
            $(document).ready(function() {
                // Initialize Nice Select
                $('select').niceSelect();
            });
        </script>
    @endsection
