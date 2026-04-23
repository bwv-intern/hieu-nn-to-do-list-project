@extends('layouts.app')

@section('title', 'Quản lý công việc')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold m-0 text-primary">✅ Danh sách công việc</h3>
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary">Quay lại Dashboard</a>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3"><h5 class="m-0 fw-bold">Thêm công việc mới</h5></div>
                <div class="card-body p-4">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Tên công việc</label>
                                <input type="text" name="title" class="form-control" placeholder="Cần làm gì..." required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Danh mục</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Chọn danh mục</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small fw-bold">Hạn chót</label>
                                <input type="datetime-local" name="due_date" class="form-control" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Trạng thái</th>
                                <th>Công việc</th>
                                <th>Danh mục</th>
                                <th>Hạn chót</th>
                                <th class="text-end px-4">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tasks as $task)
                                <tr>
                                    <td class="px-4">
                                        <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ $task->status === 'completed' ? 'btn-success' : 'btn-outline-warning' }}">
                                                {{ $task->status === 'completed' ? '✓ Xong' : '○ Chờ' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <span class="{{ $task->status === 'completed' ? 'text-decoration-line-through text-muted' : 'fw-bold' }}">
                                            {{ $task->title }}
                                        </span>
                                    </td>
                                    <td><span class="badge bg-info text-dark">{{ $task->category->name }}</span></td>
                                    <td class="small text-muted">{{ $task->due_date->format('d/m/Y H:i') }}</td>
                                    <td class="text-end px-4">
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('Xóa?')">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center py-5">Chưa có công việc nào. Thêm ngay nào!</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection