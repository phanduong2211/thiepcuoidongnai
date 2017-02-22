@extends('layouts.admin')

@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="{{Asset('public/admin/css/morris.css')}}" />
@endsection
@section('script')
 <script src="<?php echo Asset('') ?>public/admin/js/raphael.min.js"></script>
    <script src="<?php echo Asset('') ?>public/admin/js/morris.min.js"></script>
<script type="text/javascript">

	 $(function(){
    	$("#nav-accordion>li:eq(0)>a").addClass("active");
	});

    $(function(){
       
         Morris.Bar({
        element: 'morris-bar-chart',
        data: [@foreach ($chart as $itk)
        {
            date: '{{$itk->t.'-'.$itk->y}}',
            sotien: {{$itk->s}}
        },
        @endforeach],
        xkey: 'date',
        ykeys: ['sotien'],
        labels: ['Số Tiền'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        resize: true
    });

   });
  

</script>
@endsection
@section('content')
     <!--state overview start-->
              <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol terques">
                              <i class="fa fa-qrcode"></i>
                          </div>
                          <div class="value">
                              <h1 class="count">
                                  {{$thongke->sp}}
                              </h1>
                              <p>Sản Phẩm</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol red">
                              <i class="fa fa-list-alt"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count2">
                                  {{$thongke->tt}}
                              </h1>
                              <p>Tin Tức</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol yellow">
                              <i class="fa fa-shopping-cart"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count3">
                                  {{$thongke->dh}}
                              </h1>
                              <p>Đơn Hàng</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol blue">
                              <i class="fa fa-bullhorn"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count4">
                                  {{$thongke->qc}}
                              </h1>
                              <p>Quảng Cáo</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol" style="background-color:#a9d96c">
                              <i class="fa fa-users"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count4">
                                  {{$thongke->nd}}
                              </h1>
                              <p>Người Dùng</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol" style="background-color:#8075c4">
                              <i class="fa fa-envelope"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count4">
                                  {{$thongke->lh}}
                              </h1>
                              <p>Liên Hệ</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol" style="background-color:#fcb322">
                              <i class="fa fa-picture-o"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count4">
                                  {{$thongke->sl}}
                              </h1>
                              <p>Slide</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol" style="background-color:#A94442">
                              <i class="fa fa-bar-chart-o"></i>
                          </div>
                          <div class="value">
                              <h1 class="count4" style="font-size:18px">
                                  {{number_format($thongke->tongtien,0,',','.')}}<br />
                                  VNĐ
                              </h1>
                           
                              <p>Tiền Bán Được</p>
                          </div>
                      </section>
                  </div>
              </div>
              <!--state overview end-->
<br />
<div style="padding-bottom:3px;">

<div class="row">
  <div class="col-md-6">

    <div class="border-head clearfix">
        <h3 class="clearfix">
           <div class="pull-left">
            Sản Phẩm Gần Hết Hàng
          </div>
             <div class="pull-right">
                <a href='{{Asset('admin/product?f=10')}}' style='font-size:13px'>Xem thêm >></a>
            </div>
        </h3>
       
    </div>
  <div style="margin-top:-25px">
    <table class="table">
        <tr>
          <th width="40%" style="border-top:0 !important">Tên</th>
          <th style="border-top:0 !important">Giá</th>
          <th style="border-top:0 !important">SL Còn</th>
          <th style="border-top:0 !important"></th>
        </tr>
        @foreach($product_o as $item)
        <tr>
          <td>{{$item->name}}</td>
          <td>{{number_format($item->promotion_price)}}</td>
          <td>{{$item->quantity}}</td>
          <td>
            <a href="{{Asset('admin/product/edit?id='.$item->id)}}"><i class="fa fa-edit"></i> Sửa</a>
          </td>
        </tr>
        @endforeach
    </table>
  </div>

</div>

<div class="col-md-6">

<div class="border-head clearfix">
      <h3 class="clearfix">
         <div class="pull-left">
          Sản Phẩm Đang Giảm Giá
        </div>
           <div class="pull-right">
              <a href='{{Asset('admin/product?f=2')}}' style='font-size:13px'>Xem thêm >></a>
          </div>
      </h3>
     
</div>

<div style="margin-top:-25px">
    <table class="table">
        <tr>
          <th width="40%" style="border-top:0 !important">Tên</th>
          <th style="border-top:0 !important">Giá</th>
          <th style="border-top:0 !important">Giá Gốc</th>
          <th style="border-top:0 !important"></th>
        </tr>
        @foreach($product_p as $item)
        <tr>
          <td>{{$item->name}}</td>
          <td>{{number_format($item->promotion_price)}}</td>
          <td>{{number_format($item->price)}}</td>
          <td>
            <a href="{{Asset('admin/product/edit?id='.$item->id)}}"><i class="fa fa-edit"></i> Sửa</a>
          </td>
        </tr>
        @endforeach
    </table>
  </div>

</div>

</div>

</div>

<br />
<div style="padding-bottom:3px;">
<div class="border-head clearfix">
      <h3 class="clearfix">
         <div class="pull-left">
          Tổng tiền bán được trong năm {{$year}}
        </div>
           <div class="pull-right" style="margin-top: -3px;">
            <form method="get" action="" name="chooseyear">
            <select name="y" style="font-size:15px" onchange="this.parentElement.submit()">
              @for($i=2016;$i<=$current_year;$i++)
                <option value="{{$i}}">Năm {{$i}}</option>
              @endfor
            </select>
          </form>
          <script type="text/javascript">
          document.chooseyear.y.value="{{$year}}";
          </script>
          </div>
      </h3>
     
</div>

</div>

<div id="morris-bar-chart"></div>
@endsection