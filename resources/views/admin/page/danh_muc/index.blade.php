@extends('admin.master')
@section('content')
<div class="row" id="app">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Thêm Mới Danh Mục
            </div>
            <form id="formdata" v-on:submit.prevent="add()">
                <div class="card-body">
                    <label>Tên Danh Mục</label>
                    <input class="form-control mt-1" v-on:keyup="chuyenThanhSlug()" v-model="ten_danh_muc" type="text" name="ten_danh_muc">
                    <label class="mt-3">Slug Danh Mục</label>
                    <input class="form-control mt-1" v-model="slug" type="text" name="slug_danh_muc">
                    <label class="mt-3">Tình Trạng</label>
                    <select class="form-control mt-1" name="is_open">
                        <option value="1">Hiển Thị</option>
                        <option value="0">Tạm Tắt</option>
                    </select>
                    <label class="mt-3">Danh Mục Cha</label>
                    <select class="selectt form-control mt-1" name="id_danh_muc_cha">
                        <option value="0">Root</option>
                        <template v-for="(value, key) in listDanhMuc">
                            <option v-bind:value="value.id" v-if="value.id_danh_muc_cha == 0">@{{ value.ten_danh_muc }}</option>
                        </template>
                    </select>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Thêm Mới</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Danh Sách Danh Mục
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <table class="table table-bordered" id="">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tên Danh Mục</th>
                                <th class="text-center">Tình Trạng</th>
                                <th class="text-center">Danh Mục Cha</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(value, key) in listDanhMuc">
                                <th class="text-center align-middle">@{{ key + 1 }}</th>
                                <td class="align-middle">@{{ value.ten_danh_muc }}</td>
                                <td class="text-center">
                                    <button class="btn btn-success" v-on:click="changeStatus(value.id)" v-if="value.is_open == 1">Hiển Thị</button>
                                    <button class="btn btn-danger" v-on:click="changeStatus(value.id)" v-else>Tạm tắt</button>
                                </td>
                                <td class="align-middle">@{{ value.ten_danh_muc_cha == null ? 'Root' : value.ten_danh_muc_cha }}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary" v-on:click="edit = value" data-toggle="modal" data-target="#editModal">Cập nhật</button>
                                    <button class="btn btn-danger" v-on:click="xoa_danh_muc = value" data-toggle="modal" data-target="#xoaModal">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Danh Mục</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input class="form-control mt-1" v-model="edit.id" type="hidden" name="id">
                <label>Tên Danh Mục</label>
                <input class="form-control mt-1" v-on:keyup="chuyenThanhSlugEdit()"  v-model="edit.ten_danh_muc" type="text">
                <label class="mt-3">Slug Danh Mục</label>
                <input class="form-control mt-1" v-model="edit.slug_danh_muc" type="text">
                <label class="mt-3">Tình Trạng</label>
                <select class="form-control mt-1" v-model="edit.is_open">
                    <option value="1">Hiển Thị</option>
                    <option value="0">Tạm Tắt</option>
                </select>
                <label class="mt-3">Danh Mục Cha</label>
                <select v-model="edit.id_danh_muc_cha" class="form-control mt-1">
                    <option value="0">Root</option>
                    <template v-for="(value, key) in listDanhMuc">
                        <option v-bind:value="value.id" v-if="value.id_danh_muc_cha == 0">@{{ value.ten_danh_muc }}</option>
                    </template>
                </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" v-on:click="updateDanhMuc()" data-dismiss="modal" class="btn btn-primary">Cập Nhật</button>
            </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="xoaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Xóa Danh Mục</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa danh mục: <b class="text-danger">@{{ xoa_danh_muc.ten_danh_muc }}</b> này không?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" v-on:click="deleteDanhMuc()" data-dismiss="modal" class="btn btn-primary">Xóa Danh Mục</button>
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
        listDanhMuc       : [],
        edit              : {},
        xoa_danh_muc      : {},
        ten_danh_muc      : '',
        slug              : '',
    },
    created()   {
        this.loadData();
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
                .post('/admin/danh-muc/create', paramObj)
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

        loadData(){
            axios
                .get('/admin/danh-muc/data')
                .then((res) => {
                    this.listDanhMuc = res.data.list;
                })
        },

        changeStatus(id){
            axios
                .get('/admin/danh-muc/change-status/' + id)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                        this.loadData();
                    }else{
                        toastr.success(res.data.message);
                    }
                })
        },

        updateDanhMuc() {

            axios
            .post('/admin/danh-muc/update', this.edit)
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

        deleteDanhMuc() {
            axios
                .post('/admin/danh-muc/delete', this.xoa_danh_muc)
                .then((res) => {
                    toastr.success(res.data.message);
                    this.loadData();
                })
                .catch((res) => {
                    $.each(res.response.data.errors, function(k, v) {
                        toastr.error(v[0]);
                    });
                });
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
            this.slug = this.toSlug(this.ten_danh_muc);
        },

        chuyenThanhSlugEdit(){
            this.edit.slug_danh_muc = this.toSlug(this.edit.ten_danh_muc);
        },
    },
});
</script>
@endsection
