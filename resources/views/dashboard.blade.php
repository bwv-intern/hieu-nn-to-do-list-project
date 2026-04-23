@extends('layouts.app')

@section('title', 'Bảng điều khiển')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h2 class="fw-bold">Chào mừng quay trở lại, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-muted">Hôm nay bạn có kế hoạch gì không?</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fs-3">📁</i>
                    </div>
                    <h5 class="card-title fw-bold">Danh mục</h5>
                    <p class="card-text text-muted">Quản lý các nhóm công việc của bạn.</p>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-primary w-100">Truy cập ngay</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fs-3">✅</i>
                    </div>
                    <h5 class="card-title fw-bold">Công việc</h5>
                    <p class="card-text text-muted">Xem và quản lý danh sách To-do list.</p>
                    <a href="#" class="btn btn-outline-success w-100">Xem Task</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-dark text-white">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold border-bottom pb-2 mb-3">Thống kê nhanh</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tổng số Task:</span>
                        <span class="badge bg-light text-dark">0</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Danh mục:</span>
                        <span class="badge bg-light text-dark">{{ count($categories ?? []) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection