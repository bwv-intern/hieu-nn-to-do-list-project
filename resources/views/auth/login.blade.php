@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white text-center"><h4>Đăng nhập</h4></div>
            <div class="card-body">
                @if($errors->has('email'))
                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Vào hệ thống</button>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('register') }}">Chưa có tài khoản? Đăng ký ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection