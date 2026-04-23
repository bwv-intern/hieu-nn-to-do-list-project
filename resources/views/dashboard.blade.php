@extends('layouts.app')

@section('title', 'Bảng điều khiển')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12 d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold">Chào {{ Auth::user()->name }}! 👋</h2>
                <p class="text-muted">Bạn có một vài công việc cần hoàn thành hôm nay.</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger shadow-sm">
                    🚪 Đăng xuất
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body p-4 text-center">
                    <h6 class="text-uppercase opacity-75">Danh mục</h6>
                    <h2 class="display-4 fw-bold">{{ Auth::user()->categories()->count() }}</h2>
                    <a href="{{ route('categories.index') }}" class="btn btn-light btn-sm mt-2">Quản lý</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm bg-warning text-dark">
                <div class="card-body p-4 text-center">
                    <h6 class="text-uppercase opacity-75">Đang chờ</h6>
                    <h2 class="display-4 fw-bold">{{ Auth::user()->tasks()->where('status', 'pending')->count() }}</h2>
                    <a href="{{ route('tasks.index') }}" class="btn btn-dark btn-sm mt-2">Xem Task</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body p-4 text-center">
                    <h6 class="text-uppercase opacity-75">Hoàn thành</h6>
                    <h2 class="display-4 fw-bold">{{ Auth::user()->tasks()->where('status', 'completed')->count() }}</h2>
                    <button class="btn btn-light btn-sm mt-2" disabled>Tuyệt vời!</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection