@extends('admin.master')
@section('content')
<div id="app">
    <div class="row mb-3">
        <div class="col-md-4">
            <label>Danh Muc</label>
            <select class="form-control" v-model="id_danh_muc" v-on:change="getSanPham()">
                <option value="0">Tất cả</option>
                <template v-for="(value, key) in dsDanhMuc">
                    <option v-bind:value="value.id">@{{value.ten_danh_muc}}</option>
                </template>
            </select>
        </div>
        <div class="col-md-4">
            <label>Sản Phẩm</label>
            <select class="form-control" v-model="id_san_pham" v-on:change="dataTheoSP()">
                <template v-for="(value, key) in dsSanPham">
                    <option v-bind:value="value.id">@{{value.ten_san_pham}}</option>
                </template>
            </select>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Quản Lý Bình Luận
        </div>
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Người Bình Luận</th>
                                <th>Nội Dung</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in dsBinhLuan">
                                <th>@{{ key + 1 }}</th>
                                <td>@{{ value.ho_va_ten}}</td>
                                <td>@{{ value.noi_dung}}</td>
                                <td>
                                    <button class="btn btn-danger" v-on:click="deleteBL(value)">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
        dsBinhLuan : [],
        dsDanhMuc  : [],
        dsSanPham  : [],
        id_danh_muc : 0,
        id_san_pham : 0,
    },
    created()   {
        this.getBinhLuan();
        this.getDanhMuc();
    },
    methods :   {
        getBinhLuan(){
            axios
                .get('/admin/binh-luan/data')
                .then((res) => {
                    this.dsBinhLuan = res.data.data;
                });
        },

        getDanhMuc(){
            axios
                .get('/admin/binh-luan/data-dm')
                .then((res) => {
                    this.dsDanhMuc = res.data.data;
                });
        },

        getSanPham(){
            axios
                .get('/admin/binh-luan/datasp/' + this.id_danh_muc)
                .then((res) => {
                    this.dsSanPham = res.data.data;
                    this.dsBinhLuan = res.data.dataBL;
                });
        },

        dataTheoSP(){
            axios
                .get('/admin/binh-luan/data-theo-sp/' + this.id_san_pham)
                .then((res) => {
                    this.dsBinhLuan = res.data.data;
                });
        },

        deleteBL(value){
            axios
                .post('/admin/binh-luan/delete', value)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                        this.getBinhLuan();
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
