@extends('admin.master')
@section('content')
<div class="row" id="app">
    <div class="col-md-4">
        <div class="card">
            <form id="taoTaiKhoan" v-on:submit.prevent="themMoiTaiKhoan()">
                <div class="card-header">
                    Thêm Mới Tài Khoản
                </div>
                <div class="card-body">
                    <label>Họ Và Tên</label>
                    <input name="ho_va_ten" class="form-control mt-1" type="text" placeholder="Nhập vào họ và tên">
                    <label>Email</label>
                    <input name="email" class="form-control mt-1" type="email" placeholder="Nhập vào email">
                    <label>Mật Khẩu</label>
                    <input name="password" class="form-control mt-1" type="password">
                    <label>Nhập Lại Mật Khẩu</label>
                    <input name="re_password" class="form-control mt-1" type="password">
                    <label>Số Điện Thoại</label>
                    <input name="so_dien_thoai" class="form-control mt-1" type="text" placeholder="Nhập vào số điện thoại">
                    <label>Ngày Sinh</label>
                    <input name="ngay_sinh" class="form-control mt-1" type="date" placeholder="Nhập vào ngày sinh">
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Thêm Mới Tài Khoản</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Danh Sách Tài Khoản
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Họ Và Tên</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Số Điện Thoại</th>
                            <th class="text-center">Ngày Sinh</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(v, key) in listTK">
                            <tr>
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="align-middle">@{{ v.ho_va_ten }}</td>
                                <td class="align-middle">@{{ v.email }}</td>
                                <td class="align-middle">@{{ v.so_dien_thoai }}</td>
                                <td class="align-middle">@{{ v.ngay_sinh }}</td>
                                <td class="text-center">
                                    <button v-on:click="editTK = v" class="btn btn-info" data-toggle="modal" data-target="#updateModal">Cập Nhật</button>
                                    <button v-on:click="xoaTK = v" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Xóa Bỏ</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Xóa Khách Hàng</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn xóa khách hàng: <b class="text-danger">@{{ xoaTK.ho_va_ten }}</b> này!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button v-on:click="xoaKhachHang()" type="button" class="btn btn-danger" data-dismiss="modal">Xóa </button>
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Khách Hàng: <b class="text-danger">@{{ editTK.ho_va_ten }}</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input name="id" class="form-control mt-1" type="hidden" v-model="editTK.id">

                <label>Họ Và Tên</label>
                <input v-model="editTK.ho_va_ten" name="ho_va_ten" class="form-control mt-1" type="text" placeholder="Nhập vào họ và tên">
                <label>Email</label>
                <input v-model="editTK.email" name="email" class="form-control mt-1" type="email" placeholder="Nhập vào email">
                <label>Số Điện Thoại</label>
                <input v-model="editTK.so_dien_thoai" name="so_dien_thoai" class="form-control mt-1" type="text" placeholder="Nhập vào số điện thoại">
                <label>Ngày Sinh</label>
                <input v-model="editTK.ngay_sinh" name="ngay_sinh" class="form-control mt-1" type="date" placeholder="Nhập vào ngày sinh">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button v-on:click="updateKhachHanG()" type="button" class="btn btn-primary" data-dismiss="modal">Cập Nhật </button>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    new Vue({
        el      :   '#app',
        data    :   {
            listTK          : [],
            xoaTK           : {},
            editTK          : {},
        },
        created()   {
            this.loadData();
        },
        methods :   {
            themMoiTaiKhoan()  {
                var paramObj = {};
                $.each($('#taoTaiKhoan').serializeArray(), function(_, kv) {
                    if (paramObj.hasOwnProperty(kv.name)) {
                        paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                        paramObj[kv.name].push(kv.value);
                    }
                    else {
                        paramObj[kv.name] = kv.value;
                    }
                });

                axios
                    .post('/admin/tai-khoan/create', paramObj)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success("Đã thêm mới tài khoản!");
                            this.loadData();
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },
            loadData() {
                axios
                    .get('/admin/tai-khoan/data')
                    .then((res) => {
                        this.listTK = res.data.data;
                    });
            },
            xoaKhachHang() {
                axios
                    .post('/admin/tai-khoan/delete' , this.xoaTK)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success('Đã xóa tài khoản thành công!');
                            this.loadData();
                        } else {
                            toastr.error('Có lỗi không mong muốn!');
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },
            updateKhachHanG() {
                axios
                    .post('/admin/tai-khoan/update', this.editTK)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            this.loadData();
                        }
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
