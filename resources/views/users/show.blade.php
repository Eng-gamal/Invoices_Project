@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between">
                <h2>عرض المستخدم</h2>
                <a class="btn btn-primary" href="{{ route('users.index') }}">رجوع</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <strong>الاسم:</strong>
                <p>{{ $user->name }}</p>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <strong>البريد الإلكتروني:</strong>
                <p>{{ $user->email }}</p>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <strong>الأدوار:</strong>
                @if($user->getRoleNames()->isNotEmpty())
                    @foreach($user->getRoleNames() as $role)
                        <span class="badge bg-success">{{ $role }}</span>
                    @endforeach
                @else
                    <p>لا توجد أدوار محددة</p>
                @endif
            </div>
        </div>
    </div>
@endsection
