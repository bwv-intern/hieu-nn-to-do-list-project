$(document).ready(function() {
        // Thêm các hàm kiểm tra Regex cho jQuery
        $.validator.addMethod("strongPassword", function(value) {
            return /[A-Z]/.test(value) 
                && /[0-9]/.test(value) 
                && /[^A-Za-z0-9]/.test(value); 
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
                        url: window.laravelData.checkEmailUrl,
                        type: "post",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            email: function(){
                                return $("input[name='email']").val();
                            }
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 8,
                    strongPassword: true 
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