@extends('admin.master')
@section('content')
<div class="row" id="app">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Danh Sách Khách Hàng
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Họ Và Tên</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Số Điện Thoại</th>
                            <th class="text-center">Giới Tính</th>
                            <th class="text-center">Ngày Sinh</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(v, key) in listKhachHang">
                            <tr>
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="align-middle">@{{ v.ho_va_ten }}</td>
                                <td class="align-middle">@{{ v.email }}</td>
                                <td class="align-middle text-center">@{{ v.phone }}</td>
                                <td class="align-middle text-center">@{{ v.gioi_tinh  == 0 ? 'Nam' : 'Nữ' }}</td>
                                <td class="align-middle text-center">@{{ v.ngay_sinh }}</td>
                                <td class="text-center">
                                    <button v-on:click="editKh = v" class="btn btn-info" data-toggle="modal" data-target="#updateModal">Cập Nhật</button>
                                    <button v-on:click="xoaKH = v" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Xóa Bỏ</button>
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
                Bạn có chắc chắn xóa khách hàng: <b class="text-danger">@{{ xoaKH.ho_va_ten }}</b> này!
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
              <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Khách Hàng: <b class="text-danger">@{{ editKh.ho_va_ten }}</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="formDangKy" class="default-form">
                    <input class="form-control" type="hidden" name="id" v-model="editKh.id">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" v-model="editKh.email">
                    </div>
                    <div class="form-group">
                        <label>Họ Và Tên</label>
                        <input class="form-control" type="text" v-model="editKh.ho_va_ten">
                    </div>
                    <div class="form-group">
                        <label>Số Điện Thoại</label>
                        <input class="form-control" type="text" v-model="editKh.phone">
                    </div>
                    <div class="form-group">
                        <label>Ngày Sinh</label>
                        <input class="form-control" class="form-control form-control-lg" type="date" v-model="editKh.ngay_sinh">
                    </div>
                    <div class="form-group">
                        <select class="form-control"  v-model="editKh.gioi_tinh">
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button v-on:click="updateKhachHang()" type="button" class="btn btn-primary" data-dismiss="modal">Cập Nhật </button>
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
            listKhachHang  :   [],
            xoaKH           : {},
            editKh           : {},
        },
        created()   {
            this.loadData();
        },
        methods :   {
            loadData() {
                axios
                    .get('/admin/client/getData')
                    .then((res) => {
                        this.listKhachHang = res.data.data;
                    });
            },
            xoaKhachHang() {
                axios
                    .post('/admin/client/delete' , this.xoaKH)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success('Đã xóa khách hàng thành công!');
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
            updateKhachHang() {
                axios
                    .post('/admin/client/update', this.editKh)
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
