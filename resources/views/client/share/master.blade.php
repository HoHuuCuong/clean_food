<!doctype html>
<html lang="en" class="no-js">
<head>
 @include('client.share.css')
</head>
<body>
    <div class="body-wrapper">
        <!-- announcement bar start -->
        @include('client.share.header')
        <!-- announcement bar end -->

        <!-- header start -->
            @include('client.share.menu')
        <!-- header end -->
        @yield('noi_dung')

        <!-- footer start -->
        @include('client.share.foot')

        @include('client.share.js')
        @yield('js')

        <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            <button v-if="trang_thai == 1" class="btn btn-primary" v-on:click="trang_thai = 0">Login</button>
                            <button v-else class="btn btn-primary" v-on:click="trang_thai = 1">Register</button>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div v-if="trang_thai == 1" class="login-page">

                            <form style="max-width: 100% !important;" v-on:submit.prevent="add()" id="formdata" class="login-form common-form mx-auto">
                                <h2 class="section-heading text-center">Register</h2>
                                <div class="row">
                                    <div class="col-6">
                                        <fieldset>
                                            <label class="label">Họ Và Tên</label>
                                            <input name="ho_va_ten" type="text" />
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset>
                                            <label class="label">Email</label>
                                            <input name="email" type="email" />
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset>
                                            <label class="label">Số Điện Thoại</label>
                                            <input name="phone"type="tel" />
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset>
                                            <label class="label">Mật Khẩu</label>
                                            <input name="password" type="password" />
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset>
                                            <label class="label">Giới Tính</label>
                                            <select name="gioi_tinh"  >
                                                <option value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                                <option value="2">Khác</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-6">
                                        <fieldset>
                                            <label class="label">Ngày Sinh</label>
                                            <input name="ngay_sinh" type="date" />
                                        </fieldset>
                                    </div>
                                    <div class="col-6 mt-3">
                                        <button type="submit" class="btn-primary d-block mt-3 btn-signin">REGISTER</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div v-else class="login-page">

                            <form v-on:submit.prevent="login()" id="formdata" class="login-form common-form mx-auto">
                                <div class="section-header mb-3 text-end">
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
                                        <button data-bs-dismiss="modal" type="submit" class="btn-primary d-block mt-3 btn-signin">LOGIN</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    new Vue({
        el      :   '#authModal',
        data    :   {
            trang_thai  :   0,
        },
        created()   {
            console.log(123);
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
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            $('#authModal').modal('hide');
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },
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
                        if(res.data.status) {
                            toastr.success(res.data.message, "Thành công!");

                            location.reload();
                        } else {
                            toastr.error(res.data.message, "Error!");
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },

            timSanPham(){
                console.log(123);
            },
        },
    });
</script>
    <script>
        $(document).ready(function() {
            $("#addtocart_me").click(function() {
                var paramObj = {
                    'id_san_pham'   : $("#id_san_pham").val(),
                    'so_luong'      : $("#so_luong").val(),
                };
                axios
                    .post('/add-to-cart', paramObj)
                    .then((res) => {
                        if(res.data.status == 1) {
                            toastr.success(res.data.message, "Success!");
                        } else if(res.data.status == 2) {
                            toastr.warning(res.data.message, "Success!");
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            })

            $('body').on('click', '.yeuThich', function() {
                var id = $(this).data('id');
                axios
                    .get('/client/yeu-thich/' + id)
                    .then((res) => {
                        if(res.data.status == true) {
                            toastr.success(res.data.message, "Success!");
                        } else if(res.data.status == false) {
                            toastr.warning(res.data.message, "Success!");
                        }
                    })
            });

            $('body').on('click', '.huyYeuThich', function() {
                var id = $(this).data('id');
                axios
                    .get('/client/huy-yeu-thich/' + id)
                    .then((res) => {
                        if(res.data.status == true) {
                            toastr.success(res.data.message, "Success!");
                        } else if(res.data.status == false) {
                            toastr.warning(res.data.message, "Success!");
                        }
                    })
            });
        });
    </script>
<script>
    new Vue({
        el      :   '#search',
        data    :   {
            key_search  :   '',
        },
        created()   {

        },
        methods :   {
            timSanPham(){
                window.location.href = '/search-san-pham/' + this.key_search;
            },
        },
    });
    </script>
</html>
