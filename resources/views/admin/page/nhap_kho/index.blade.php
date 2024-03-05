@extends('admin.master')
@section('content')
<div class="row" id="app">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary">
                Danh Sách Sản Phẩm
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-white">
                        <tr>
                            <th colspan="100%">
                                <input type="text" class="form-control" placeholder="Nhập vào sản phẩm cần tìm">
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên Sản Phẩm</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(value, key) in dsSanPham">
                            <th class="text-center align-middle">@{{ key + 1 }}</th>
                            <td class="align-middle">@{{ value.ten_san_pham}}</td>
                            <td class="align-middle text-center">
                                <button class="btn btn-sm btn-primary" v-on:click="addDetail(value)">Thêm</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header bg-primary">
                Chi tiết đơn hàng
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên Sản Phẩm</th>
                            <th class="text-center">Số Lượng</th>
                            <th class="text-center">Đơn Giá</th>
                            <th class="text-center">Thành Tiền</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(v, k) in dsDetail">
                            <th class="text-center align-middle">@{{ k + 1 }}</th>
                            <td class="align-middle">@{{ v.ten_san_pham }}</td>
                            <td class="align-middle">
                                <input type="number" class="form-control" v-model="v.so_luong_nhap" v-on:blur="update(v)">
                            </td>
                            <td class="align-middle">
                                <input type="number" class="form-control" v-model="v.don_gia_nhap" v-on:blur="update(v)">
                            </td>
                            <td class="align-middle">
                                {{-- @{{ format(v.so_luong_nhap * v.don_gia_nhap) }} --}}
                                @{{number_format(v.so_luong_nhap * v.don_gia_nhap, 0, '.', ',')}}đ
                            </td>
                            <td class="align-middle text-center">
                                <button class="btn btn-danger" v-on:click="destroy(v)">Xóa Dòng</button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="100%">
                                <textarea class="form-control" v-model="add.ghi_chu" cols="30" rows="5" placeholder="Nhập vào ghi chú đơn hàng"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-end">
                <button v-on:click="nhapKho()" class="btn btn-primary">Nhập Kho</button>
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
        dsSanPham : [],
        dsDetail : [],
        add : {},
    },
    created()   {
        this.getSanPham();
        this.loadData();
    },
    methods :   {
        date_format(now) {
                return moment(now).format('DD/MM/yyyy');
            },
        number_format(number, decimals = 2, dec_point = ",", thousands_sep = ".") {
            var n = number,
            c = isNaN((decimals = Math.abs(decimals))) ? 2 : decimals;
            var d = dec_point == undefined ? "," : dec_point;
            var t = thousands_sep == undefined ? "." : thousands_sep,
                s = n < 0 ? "-" : "";
            var i = parseInt((n = Math.abs(+n || 0).toFixed(c))) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;

            return (s +(j ? i.substr(0, j) + t : "") +i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) +(c? d +
                    Math.abs(n - i)
                        .toFixed(c)
                        .slice(2)
                    : "")
            );
        },
        getSanPham(){
            axios
                .get('/admin/nhap-kho/datasp')
                .then((res) => {
                    this.dsSanPham = res.data.data;
                });
        },

        loadData(){
            axios
                .get('/admin/nhap-kho/data')
                .then((res) => {
                    this.dsDetail = res.data.data;
                });
        },

        addDetail(v){
            axios
                .post('/admin/nhap-kho/createDetail', v)
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

        update(v){
            axios
                .post('/admin/nhap-kho/updateDetail', v)
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

        destroy(v){
            console.log(v);
            axios
                .post('/admin/nhap-kho/deleteDetail', v)
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

        nhapKho(){
            axios
                .post('/admin/nhap-kho/acceptNhapKho', this.add)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                        this.loadData();
                        this.add = '';
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
