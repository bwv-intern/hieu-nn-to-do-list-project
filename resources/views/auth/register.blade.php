@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center"><h4>Đăng ký tài khoản</h4></div>
            <div class="card-body">
                <form action="{{ route('register.post') }}" method="POST" id="registerForm">
                    @csrf <div class="mb-3">
                        <label class="form-label">Tên của bạn</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Đăng ký ngay</button>
                </form>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Thêm các hàm kiểm tra Regex cho jQuery
        $.validator.addMethod("strongPassword", function(value) {
            return /[A-Z]/.test(value) // Chữ hoa
                && /[0-9]/.test(value) // Số
                && /[^A-Za-z0-9]/.test(value); // Ký tự đặc biệt
        }, "Mật khẩu phải bao gồm chữ hoa, số và ký tự đặc biệt.");

        $("#registerForm").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{ route('check.email') }}",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token() }}",
                            email: function(){
                                return $("input[name='email']").val();
                            }
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 8,
                    strongPassword: true // Dùng hàm vừa tạo ở trên
                },  
                password_confirmation: {
                    required: true,
                    equalTo: "input[name='password']"
                }
            },
            
            messages: {
                name: {
                    required: "Vui lòng nhập tên",
                    maxlength: "Độ dài tối đa 255 ký tự"
                },
                email: {
                    required: "Vui lòng nhập email",
                    email: "Email không đúng định dạng",
                    remote: "Email đã tồn tại"
                },
                password: {
                    required: "Vui lòng nhập mật khẩu",
                    minlength: "Mật khẩu phải ít nhất 8 ký tự",
                },  
                password_confirmation: {
                    required: "Vui lòng xác nhận lại mật khẩu",
                    equalTo: "Mật khẩu không khớp"
                }
            },

            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.mb-3').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
                $(element).siblings('.text-danger').hide(); 
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endpush