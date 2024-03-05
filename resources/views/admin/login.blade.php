<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Vito - Responsive Bootstrap 4 Admin Dashboard Template</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="/assets/images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="/assets/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="/assets/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="/assets/css/responsive.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
         integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toast-css/1.1.0/grid.min.css"
         integrity="sha512-YOGZZn5CgXgAQSCsxTRmV67MmYIxppGYDz3hJWDZW4A/sSOweWFcynv324Y2lJvY5H5PL2xQJu4/e3YoRsnPeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page" id="app">
            <div class="container bg-white mt-5 p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">
                            <h2 class="mb-0 dark-signin">Đăng Nhập</h2>
                            <p>Nhập địa chỉ email và mật khẩu của bạn để truy cập bảng quản trị.</p>
                            <form v-on:submit.prevent="dangNhap()" id="formdata" class="mt-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input name="email" type="email" class="form-control mb-0"  placeholder="Nhập vào email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input name="password" type="password" class="form-control mb-0"  placeholder="Nhập vào password">
                                </div>
                                <div class="d-inline-block w-100">
                                    <button type="submit" class="btn btn-primary float-right">Đăng Nhập</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white">
                            <a class="sign-in-logo mb-5" href="/assets/#"><img src="/assets/images/logo-white.png" class="img-fluid" alt="logo"></a>
                            <div class="slick-slider11" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                <div class="item">
                                    <img src="https://www.prudential.com.vn/export/sites/prudential-vn/vi/.thu-vien/hinh-anh/pulse-nhip-song-khoe/song-khoe/2020/suc-khoe-the-chat/bai-viet-ban-co-biet-thuc-pham-sach-va-thuc-pham-organic-la-hai-loai-khac-nhau-desktop-1366x560.jpg" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Nhịp Sống Khỏe</h4>
                                    <p>Đa dạng thực phẩm tươi ngon cho bữa ăn chất lượng mỗi ngày</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="/assets/js/jquery.min.js"></script>
      <script src="/assets/js/popper.min.js"></script>
      <script src="/assets/js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="/assets/js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="/assets/js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="/assets/js/waypoints.min.js"></script>
      <script src="/assets/js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="/assets/js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="/assets/js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="/assets/js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="/assets/js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="/assets/js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="/assets/js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="/assets/js/smooth-scrollbar.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="/assets/js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="/assets/js/custom.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    new Vue({
        el      :   '#app',
        data    :   {

        },
        created()   {

        },
        methods :   {
            dangNhap() {
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
                    .post('/admin/login', paramObj)
                    .then((res) => {
                        if(res.data.status) {
                            toastr.success("Đăng nhập thành công!");
                            window.location.assign("/admin/danh-muc/index")
                        } else {
                            toastr.error("Tài khoản hoặc mật khẩu không đúng!");
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
   </body>
</html>
