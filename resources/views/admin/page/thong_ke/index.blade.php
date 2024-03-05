@extends('admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form action="/admin/thong-ke" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control mt-1" name="so_luong">
                                <option value="5"  {{ isset($so_luong) ? $so_luong == 5 ? "selected" : "" : "selected" }}>5 Sản Phẩm</option>
                                <option value="10" {{ isset($so_luong) ? $so_luong == 10 ? "selected" : "" : "" }}>10 Sản Phẩm</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-1">
                            <button class="btn btn-primary" type="submit">Chọn</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var lables =  <?php echo json_encode($array_lable); ?>;
var datas  = <?php echo json_encode($array_datas); ?>;
const ctx = document.getElementById('myChart');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: lables,
    datasets: [{
      label: '# Số lượng',
      data: datas,
      backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>
@endsection

