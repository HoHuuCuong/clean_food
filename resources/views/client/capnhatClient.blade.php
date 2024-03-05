@extends('client.share.master')
@section('noi_dung')
<main  class="content-for-layout">
    <div id="ne" class="login-page mt-100">
        <div class="container">
            <form class="login-form common-form mx-auto">
                <div class="section-header mb-3">
                    <h2 class="section-heading text-center">Cập Nhật Thông Tin</h2>
                </div>
                <div class="row">
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Họ Và Tên</label>
                            <input v-model="updateclient.ho_va_ten"  type="text" />
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Email</label>
                            <input v-model="updateclient.email"  type="email" />
                        </fieldset>
                    </div>

                    <div class="col-12">
                        <fieldset>
                            <label class="label">Số Điện Thoại</label>
                            <input v-model="updateclient.phone" type="tel" />
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Mật Khẩu</label>
                            <input v-model="updateclient.password" type="password" />
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Giới Tính</label>
                            <select v-model="updateclient.gioi_tinh" >
                                <option value="0">Nam</option>
                                <option value="1">Nữ</option>
                                <option value="2">Khác</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-12">
                        <fieldset>
                            <label class="label">Ngày Sinh</label>
                            <input v-model="updateclient.ngay_sinh" type="date" />
                        </fieldset>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="row">
                            <div>
                                <button type="button" v-on:click="updateClient()" class="btn-primary d-block mt-3 btn-signin">Cập Nhật</button>
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
        el      :   '#ne',
        data    :   {
            updateclient : {
                id        : {{$client->id}},
                ho_va_ten : '{{$client->ho_va_ten}}',
                email : '{{$client->email}}',
                phone : '{{$client->phone}}',
                gioi_tinh : {{$client->gioi_tinh}},
                ngay_sinh : '{{$client->ngay_sinh}}',
            },
        },
        created()   {
            console.log(123);
        },
        methods :   {
            updateClient(){
                axios
                    .post('/updateInfo-client', this.updateclient)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message, "Success!");
                            setTimeout(() => {
                                location.reload();
                            }, 2000);

                        } else {
                            toastr.error(res.data.message, "Error!");
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
