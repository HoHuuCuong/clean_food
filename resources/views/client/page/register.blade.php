@extends('client.share.master')
@section('noi_dung')
<main id="app" class="content-for-layout">
    <div class="login-page mt-100">
        <div class="container">
            <form v-on:submit.prevent="add()" id="formdata" class="login-form common-form mx-auto">
                <div class="section-header mb-3">
                    <h2 class="section-heading text-center">Đăng Ký Tài Khoản</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Họ Và Tên</label>
                            <input name="ho_va_ten" type="text" />
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Email</label>
                            <input name="email" type="email" />
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Số Điện Thoại</label>
                            <input name="phone"type="tel" />
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Mật Khẩu</label>
                            <input name="password" type="password" />
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Giới Tính</label>
                            <select name="gioi_tinh"  >
                                <option value="0">Nam</option>
                                <option value="1">Nữ</option>
                                <option value="2">Khác</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Ngày Sinh</label>
                            <input name="ngay_sinh" type="date" />
                        </fieldset>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="row">
                            <div>
                                <button type="submit" class="btn-primary d-block mt-3 btn-signin">Đăng Ký</button>
                            </div>
                            <div class="text-center mt-3" >
                                <p>Bạn đã có tài khoản? <a href="/login">Đăng Nhập</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
@section('js')
<script>
    new Vue({
        el      :   '#app',
        data    :   {

        },
        created()   {
        },
        methods :   {
            add() {
                var paramObj = {};
                $.each($('#formdata').serializeArray(), function(_, kv) {
                    if (paramObj.hasOwnProperty(kv.name)) {
                        paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                        paramObj[kv.name].push(kv.value);
                    } else {
                        paramObj[kv.name] = kv.value;
                    }
                });

                axios
                    .post('/register', paramObj)
                    .then((res) => {
                        toastr.success('Đã tạo tài khoản thành công!');
                        window.location.href = '/login';
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },

        },
    });
</script>
@endsection
