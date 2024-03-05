@extends('client.share.master')
@section('noi_dung')
<div class="container mt-5" id="appne">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="align-middle text-nowrap text-center">#</th>
                            <th class="align-middle text-nowrap text-center">Mã Đơn Hàng</th>
                            <th class="align-middle text-nowrap text-center">Tiền Hàng</th>
                            <th class="align-middle text-nowrap text-center">Phí Ship</th>
                            <th class="align-middle text-nowrap text-center">Tổng Tiền</th>
                            <th class="align-middle text-nowrap text-center">Vận Chuyển</th>
                            <th class="align-middle text-nowrap text-center">Tình Trạng</th>
                            <th class="align-middle text-nowrap text-center">Chi Tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(value, key) in list">
                            <th class="align-middle text-center">@{{ key + 1 }}</th>
                            <td class="align-middle">@{{ value.hash_don_hang }}</td>
                            <td class="align-middle">@{{ numberformat(value.tien_hang) }}</td>
                            <td class="align-middle">@{{ numberformat(value.phi_ship) }}</td>
                            <td class="align-middle">@{{ numberformat(value.tong_thanh_toan) }}</td>
                            <td class="align-middle text-center">
                                <template v-if="value.giao_hang == 0">
                                    <button class="btn btn-danger">Chưa Vận Chuyển</button>
                                </template>
                                <template v-else-if="value.giao_hang == 1">
                                <button class="btn btn-warning">Đang Vận Chuyển</button>
                                </template>
                                <template v-else="value.giao_hang == 2">
                                    <button class="btn btn-success">Đã Giao Hàng</button>
                                </template>
                            </td>
                            <td class="align-middle text-center">
                                <template v-if="value.thanh_toan == 0">
                                    <button class="btn btn-danger">Chưa Thanh Toán</button>
                                </template>
                                <template v-else>
                                    <button class="btn btn-success">Đã Thanh Toán</button>
                                </template>
                            </td>
                            <td class="align-middle text-center">
                                <button class="btn btn-primary" v-on:click="loadChiTiet(value.id), don_hang = value" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-info"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Chi Tiết Đơn Hàng - @{{don_hang.hash_don_hang}}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="align-middle text-center">#</th>
                                        <th class="align-middle text-center">Hình Ảnh</th>
                                        <th class="align-middle text-center">Tên Sản Phẩm</th>
                                        <th class="align-middle text-center">Đơn Giá</th>
                                        <th class="align-middle text-center">Thành Tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(value, key) in list_san_pham">
                                        <th class="text-center align-middle">@{{ key + 1 }}</th>
                                        <td class="align-middle">
                                            <img style="height: 100PX; width: 100px ;"
                                                v-bind:src="value?.hinh_anh.split(',')[0]" alt="img">
                                        </td>
                                        <td class="align-middle">
                                            <h6><a class="text-dark"target="_blank"
                                                    v-bind:href="'/product/' + value.slug_san_pham + 'post' + value.id_san_pham">@{{ value.ten_san_pham }}</a>
                                            </h6>
                                        </td>
                                        <td class="align-middle">@{{ numberformat(tinhGia(value.gia_ban, value.gia_khuyen_mai)) }} x @{{ value.so_luong }}</td>
                                        <td class="align-middle">@{{ numberformat(tinhGia(value.gia_ban, value.gia_khuyen_mai) * value.so_luong) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    new Vue({
    el      :   '#appne',
    data    :   {
        list                : [],
        list_san_pham       : [],
        don_hang            : {},
    },
    created()   {
        this.loadData();
    },
    methods :   {
        loadData(){
            axios
                .get('/lich-su/data')
                .then((res) => {
                    this.list = res.data.data;
                })
        },

        loadChiTiet(v){
            axios
                .get('/lich-su/dataChiTiet/' + v)
                .then((res) => {
                    this.list_san_pham = res.data.data;
                    console.log(this.list_san_pham);
                })
        },

        numberformat(number) {
            return new Intl.NumberFormat('vi-VI', {
                style: 'currency',
                currency: 'VND'
            }).format(number)
        },

        tinhGia(gia_ban, gia_khuyen_mai) {
            if (gia_khuyen_mai > 0) {
                return gia_khuyen_mai;
            }
            return gia_ban;
        },
    },
});
</script>
@endsection

