@extends('layouts.app')

@section('title', 'Quản lý danh mục')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold m-0 text-primary">📁 Danh sách danh mục</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </nav>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Nhập tên danh mục mới (vd: Việc nhà, Công ty...)" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <span class="me-2">+</span> Thêm mới
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3" style="width: 10%">#</th>
                                    <th class="py-3">Tên danh mục</th>
                                    <th class="py-3">Slug (Đường dẫn)</th>
                                    <th class="px-4 py-3 text-end">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $key => $category)
                                    <tr>
                                        <td class="px-4">{{ $key + 1 }}</td>
                                        <td class="fw-bold">{{ $category->name }}</td>
                                        <td><code class="text-muted">{{ $category->slug }}</code></td>
                                        <td class="px-4 text-end">
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này? Tất cả các Task thuộc danh mục này cũng sẽ bị xóa!')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm">
                                                    🗑️ Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            Bạn chưa có danh mục nào. Hãy thêm danh mục đầu tiên ở trên!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection