@extends('admin.master')
@section('content')
<div class="row" id="app">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Thêm Mới Sản Phẩm
            </div>
            <div class="card-body">
                <label>Tên Sản Phẩm</label>
                <input v-on:keyup="chuyenThanhSlug()" v-model="add.ten_san_pham" class="form-control mt-1" type="text">
                <label>Slug Sản Phẩm</label>
                <input v-model="slug" type="text" class="form-control mt-1" type="text">
                <label>Số Lượng</label>
                <input v-model="add.so_luong" class="form-control mt-1" type="number">
                <label>Hình Ảnh</label>
                <div class="input-group">
                    <input id="hinh_anh" class="form-control" type="text" name="filepath">
                    <span class="input-group-prepend">
                        <a id="lfm" data-input="hinh_anh" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                <label>Mô tả ngắn</label>
                <textarea class="form-control" v-model="add.mo_ta_ngan" cols="30" rows="10"></textarea>
                <label>Mô tả chi tiết</label>
                <input v-model="add.mo_ta" id="mo_ta" name="mo_ta" class="form-control mt-1" type="text">
                <label>Giá bán</label>
                <input v-model="add.gia_ban" class="form-control mt-1" type="number">
                <label>Giá khuyến mãi</label>
                <input v-model="add.gia_khuyen_mai" class="form-control mt-1" type="number">
                <label>Danh Mục</label>
                <select v-model="add.id_danh_muc" class="form-control mt-1">
                    <template v-for="(v, k) in listDanhMuc">
                        <option v-bind:value="v.id">@{{ v.ten_danh_muc }}</option>
                    </template>
                </select>
                <label>Tình trạng</label>
                <select v-model="add.is_open" class="form-control">
                    <option value="1">Còn kinh doanh</option>
                    <option value="0">Dừng kinh doanh</option>
                </select>
            </div>
            <div class="card-footer text-right">
                <button type="button" v-on:click="addSP()" class="btn btn-primary">Thêm Mới</button>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Danh Sách Sản Phẩm
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Sản Phẩm</th>
                                <th class="text-center">Số Lượng</th>
                                <th class="text-center">Hình Ảnh</th>
                                <th class="text-center">Mô Tả</th>
                                <th class="text-center">Giá Bán</th>
                                <th class="text-center">Giá Khuyến Mãi</th>
                                <th class="text-center">Danh Mục</th>
                                <th class="text-center">Tình Trạng</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(v, k) in listSanPham">
                                <th class="text-center align-middle">@{{ k + 1 }}</th>
                                <td class="align-middle">@{{ v.ten_san_pham }}</td>
                                <td class="align-middle">@{{ v.so_luong }}</td>
                                <td class="align-middle">
                                    <img v-bind:src="v.hinh_anh.split(',')[0]" class="img-fluid" style="max-width: 200px;">
                                </td>
                                <td class="text-center align-middle">
                                    <button v-on:click="modal = v, hienMoTa()"  data-toggle="modal" data-target="#mo_ta_chi_tiet" class="btn btn-primary"><i style="padding-left: 6px" class="fa-sharp fa-solid fa-info"></i></button>
                                </td>
                                <td class="align-middle text-nowrap">@{{ number_format(v.gia_ban, 0, ',', '.') }} vnđ</td>
                                <td class="align-middle">@{{ number_format(v.gia_khuyen_mai, 0, ',', '.') }} vnđ</td>
                                <td class="align-middle text-nowrap">@{{ v.ten_danh_muc }}</td>
                                <td class="text-center align-middle">
                                    <button class="btn btn-success" v-on:click="changeStatus(v.id)" v-if="v.is_open == 1">Còn Kinh Doanh</button>
                                    <button class="btn btn-danger" v-on:click="changeStatus(v.id)" v-else>Dừng Kinh Doanh</button>
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    <button v-on:click="edit(v)" data-toggle="modal" data-target="#editModal" class="btn btn-info">Cập Nhật</button>
                                    <button v-on:click="sp_delete = v" data-toggle="modal" data-target="#xoaModal" class="btn btn-danger">Xóa Bỏ</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Sản Phẩm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <label>Tên Sản Phẩm</label>
                <input v-model="sp_edit.ten_san_pham" name="ten_san_pham" class="form-control mt-1" type="text">
                <label>Slug Sản Phẩm</label>
                <input v-model="sp_edit.slug_san_pham" class="form-control mt-1" type="text">
                <label>Số Lượng</label>
                <input v-model="sp_edit.so_luong" class="form-control mt-1" type="text">
                <label>Hình Ảnh</label>
                <div class="input-group">
                    <input v-model="sp_edit.hinh_anh" id="hinh_anh_edit" class="form-control" type="text" name="filepath">
                    <span class="input-group-prepend">
                        <a id="lfm_edit" data-input="hinh_anh_edit" data-preview="holder_edit" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                </div>
                <div id="holder_edit" style="margin-top:15px;max-height:100px;"></div>
                <label>Mô tả ngắn</label>
                <textarea class="form-control" v-model="sp_edit.mo_ta_ngan" cols="30" rows="10"></textarea>
                <label>Mô tả</label>
                <input id="mo_ta_edit" name="mo_ta_edit" class="form-control mt-1" type="text">
                <label>Giá bán</label>
                <input v-model="sp_edit.gia_ban" class="form-control mt-1" type="number">
                <label>Giá khuyến mãi</label>
                <input v-model="sp_edit.gia_khuyen_mai" class="form-control mt-1" type="number">
                <label>Danh Mục</label>
                <select v-model="sp_edit.id_danh_muc" class="form-control mt-1">
                    <template v-for="(v, k) in listDanhMuc">
                        <option v-bind:value="v.id">@{{ v.ten_danh_muc }}</option>
                    </template>
                </select>
                <label>Tình trạng</label>
                <select v-model="sp_edit.is_open"class="form-control">
                    <option value="1">Còn kinh doanh</option>
                    <option value="0">Dừng kinh doanh</option>
                </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" v-on:click="updateSanPham()" data-dismiss="modal" class="btn btn-primary">Cập Nhật</button>
            </div>
          </div>
        </div>
    </div> --}}
    <!-- The Modal -->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <label>Tên Sản Phẩm</label>
                <input v-model="sp_edit.ten_san_pham" name="ten_san_pham" class="form-control mt-1" type="text">
                <label>Slug Sản Phẩm</label>
                <input v-model="sp_edit.slug_san_pham" class="form-control mt-1" type="text">
                <label>Số Lượng</label>
                <input v-model="sp_edit.so_luong" class="form-control mt-1" type="text">
                <label>Hình Ảnh</label>
                <div class="input-group">
                    <input v-model="sp_edit.hinh_anh" id="hinh_anh_edit" class="form-control" type="text" name="filepath">
                    <span class="input-group-prepend">
                        <a id="lfm_edit" data-input="hinh_anh_edit" data-preview="holder_edit" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                </div>
                <div id="holder_edit" style="margin-top:15px;max-height:100px;"></div>
                <label>Mô tả ngắn</label>
                <textarea class="form-control" v-model="sp_edit.mo_ta_ngan" cols="30" rows="10"></textarea>
                <label>Mô tả</label>
                <input id="mo_ta_edit" name="mo_ta_edit" class="form-control mt-1" type="text">
                <label>Giá bán</label>
                <input v-model="sp_edit.gia_ban" class="form-control mt-1" type="number">
                <label>Giá khuyến mãi</label>
                <input v-model="sp_edit.gia_khuyen_mai" class="form-control mt-1" type="number">
                <label>Danh Mục</label>
                <select v-model="sp_edit.id_danh_muc" class="form-control mt-1">
                    <template v-for="(v, k) in listDanhMuc">
                        <option v-bind:value="v.id">@{{ v.ten_danh_muc }}</option>
                    </template>
                </select>
                <label>Tình trạng</label>
                <select v-model="sp_edit.is_open"class="form-control">
                    <option value="1">Còn kinh doanh</option>
                    <option value="0">Dừng kinh doanh</option>
                </select>
            </div>
            <div class="modal-footer">
            <button type="button" v-on:click="updateSanPham()" data-dismiss="modal" class="btn btn-primary">Cập Nhật</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="xoaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Xóa Sản Phẩm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa sản phẩm: <b class="text-danger">@{{ sp_delete.ten_danh_muc }}</b> này không?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="button" v-on:click="deleteSanPham()" data-dismiss="modal" class="btn btn-primary">Xóa Sản Phẩm</button>
          </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mo_ta_chi_tiet" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mô Tả</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="hienMoTa"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
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
            add            : {},
            listDanhMuc    : [],
            listSanPham    : [],
            sp_edit        : {},
            sp_delete      : {},
            slug           : '',
            ten_san_pham   : '',
            modal          : {},
        },
        created()   {
            this.loadDanhMuc();
            this.loadSanPham();
        },
        methods :   {
            addSP() {
                this.add.mo_ta = CKEDITOR.instances['mo_ta'].getData();
                this.add.slug_san_pham = this.slug;
                this.add.hinh_anh = $("#hinh_anh").val();
                axios
                    .post('/admin/san-pham/create', this.add)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            $("#formdata").trigger("reset");
                            CKEDITOR.instances['mo_ta'].setData('');
                            this.loadSanPham();
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
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

            loadDanhMuc() {
                axios
                    .get('/admin/san-pham/data-dm')
                    .then((res) => {
                        this.listDanhMuc = res.data.data;
                        console.log(this.listDanhMuc);
                    });
            },

            loadSanPham() {
                axios
                    .get('/admin/san-pham/data')
                    .then((res) => {
                        this.listSanPham = res.data.data;
                    });
            },

            updateSanPham() {
                this.sp_edit.hinh_anh = $("#hinh_anh_edit").val();
                this.sp_edit.mo_ta = CKEDITOR.instances['mo_ta_edit'].getData();
                console.log(this.sp_edit);
                axios
                    .post('/admin/san-pham/update', this.sp_edit)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            this.loadSanPham();
                        }
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                        toastr.error(v[0]);
                    });
                });
            },

            edit(v) {
                this.sp_edit = v;
                CKEDITOR.instances['mo_ta_edit'].setData(v.mo_ta);
            },

            deleteSanPham() {
                axios
                    .post('/admin/san-pham/delete', this.sp_delete)
                    .then((res) => {
                        toastr.success(res.data.message);
                        this.loadSanPham();
                    })
                    .catch((res) => {
                        $.each(res.response.data.errors, function(k, v) {
                            toastr.error(v[0]);
                        });
                    });
            },

            changeStatus(id){
                axios
                    .get('/admin/san-pham/change-status/' + id)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success(res.data.message);
                            this.loadSanPham();
                        }else{
                            toastr.success(res.data.message);
                        }
                    })
            },
            toSlug(str) {
                str = str.toLowerCase();
                str = str
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '');
                str = str.replace(/[đĐ]/g, 'd');
                str = str.replace(/([^0-9a-z-\s])/g, '');
                str = str.replace(/(\s+)/g, '-');
                str = str.replace(/-+/g, '-');
                str = str.replace(/^-+|-+$/g, '');
                return str;
            },

            chuyenThanhSlug(){
                this.slug = this.toSlug(this.add.ten_san_pham);
            },

            chuyenThanhSlugEdit(){
                this.edit.slug_san_pham = this.toSlug(this.edit.ten_san_pham);
            },

            hienMoTa(){
                $('#hienMoTa').html(this.modal.mo_ta);
            },

        },

    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
<script>
    CKEDITOR.replace('mo_ta');
    CKEDITOR.replace('mo_ta_edit');
</script>
<script>
    var route_prefix = "/laravel-filemanager";
</script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $("#lfm").filemanager('image', {prefix : route_prefix});
    $("#lfm_edit").filemanager('image', {prefix : route_prefix});
</script>
@endsection
