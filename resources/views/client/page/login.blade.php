@extends('client.share.master')
@section('noi_dung')
<main id="app" class="content-for-layout">
    <div class="login-page mt-100">
        <div class="container">
            <form v-on:submit.prevent=" login()" id="formdata"  class="login-form common-form mx-auto">
                <div class="section-header mb-3">
                    <h2 class="section-heading text-center">Login</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Email</label>
                            <input type="email" name="email"/>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Mật Khẩu</label>
                            <input type="password" name="password"/>
                        </fieldset>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="submit" class="btn-primary d-block mt-4 btn-signin">SIGN IN</button>
                        <div class="text-center mt-3" >
                            <p>Bạn chưa có tài khoản? <a href="/register">Đăng Ký Tại Đây</a>
                            </p>
                            <a href="/quen-mat-khau">Quên Mật Khẩu?</a>
                            </p>
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
            login() {
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
                    .post('/login', paramObj)
                    .then((res) => {
                        console.log(res.data.status);
                        if(res.data.status) {
                            console.log(123);
                            toastr.success(res.data.message, "Thành công!");
                            window.location.href = "/";
                        }else{
                            toastr.error(res.data.message, "That Bai!");
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            }
        },
    });
</script>
@endsection
