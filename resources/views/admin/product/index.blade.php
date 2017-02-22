@extends('layouts.admin')

@section('title', 'Quản Lý Sản Phẩm')
@section('script')
<script type="text/javascript">
  var base_url="{{Asset('admin')}}/";
  var __token="{{csrf_token()}}";
  $(function(){
    $("#nav-accordion>li:eq(1)>a").addClass("active").parent().find("ul>li:eq(0)").addClass("active");
    $("form.remove").submit(function(){
 var th=$(this);
      getConfirm('Bạn có chắc muốn đưa sản phẩm này vào thùng rác?',function(result) {
        if(result){
         
          var id=th.find("input[name='id']").val();
          th=th.parents("tr");
          th.addClass("noaction");
          RunJson(base_url+'product/addbin',{"id":id,"_token":__token},function(result){
            if(result=="1"){
              th.fadeOut();
            }else{
              th.removeClass("noaction");
              alert("có lỗi. không thể thêm sản phẩm vào thùng rác");
            }
          });
        }
      });

      return false;
    });

    $(".displayitem").click(function(){
      var th=$(this);
      var id=th.attr("data-id");
      var flag=(th.html()=="Ẩn")?0:1;
      th.parents("tr").addClass("noaction");


      RunJson(base_url+'product/hidden',{"id":id,"_token":__token,"flag":flag},function(result){
        if(result=="1"){
          if(flag==0){
            th.html("Hiện");
            th.parents("tr").addClass("opahi");
          }else{
            th.html("Ẩn");
            th.parents("tr").removeClass("opahi");
          }
        }else{

          alert("có lỗi.");
        }
        th.parents("tr").removeClass("noaction");
      });

      return false;
    });

  });
</script>
@endsection
@section('content')
@if(Session::has('message'))
<p class="message hidemessage"> {{ Session::get('message') }}
  <i class="pull-right fa fa-times-circle"></i>
</p>
@endif
<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-bottom:5px">
   <div class="group-button clearfix">
     <a href="{{Asset('admin/product/add')}}" class="pull-left btn btn-primary btn-sm">Thêm mới</a> 
    <?php  if(isset($_GET['f']) || isset($_GET['q'])){ ?>
     <a href="{{Asset('admin/product')}}" class="pull-left btn btn-default btn-sm" style="margin-left:5px">Xem tất cả</a>
    <?php } ?>
   </div>
 </div>
 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xs-marg text-right clearfix">
  <form method="get" action="" class="pull-right">
    <select class="sfilter" name="f">
      <option value="0">-Lọc-</option>
      <option value="1">Sản Phẩm Của Bạn</option>
      <option value="2">Giảm Giá</option>
      <option value="3">Không Giảm Giá</option>
      <option value="4">Mới</option>
      <option value="5">Hot</option>
      <option value="6">Hết Hàng</option>
      <option value="7">Bán Chạy</option>
      <option value="8">Khuyến Mãi</option>
      <option value="9">Ngừng Kinh Doanh</option>
      <option value="10">Gần Hết Hàng</option>
      <option value="11">Hiện</option>
      <option value="12">Ẩn</option>
    </select>
    <?php if(isset($_GET["s"])){ ?>
    <input type="hidden" name="s" value="<?php echo $_GET["s"] ?>" />
    <?php } ?>
  </form>
  <form method="get" action="" class="pull-right">

    <select class="sfilter" name="s">
      <option value="0">-Sắp xếp-</option>
      <option value="1">Mới nhất</option>
      <option value="2">Cũ nhất</option>
      <option value="3">Tên</option>
      <option value="4">Số lượng</option>
      <option value="5">Giá bán</option>
      <option value="6">Giá gốc</option>
      <option value="7">Giá sỉ</option>
      <option value="8">Ngày Tạo</option>
      <option value="9">Ngày Cập Nhật</option>
    </select>
    <?php if(isset($_GET["q"])){ ?>
    <input type="hidden" name="q" value="<?php echo $_GET["q"] ?>" />
    <?php } ?>
  </form>
  <form method="get" action="" class="pull-right">
    <div class="frmsearch clearfix">
      <input title="" type="text" class="textboxsearch" value="<?php if(isset($_GET['q'])) echo $_GET['q']; ?>"  placeholder="Nhập nội dung tìm kiếm..." name="q" />
      <input type="submit" class="buttonsearch" value="" />
    </div>
    <?php if(isset($_GET["s"])){ ?>
    <input type="hidden" name="s" value="<?php echo $_GET["s"] ?>" />
    <?php } ?>
  </form>


</div>
</div><!---search-->
<br />
<?php 
function showImage($path){
  if(strpos($path, "http")===0)
    return $path;
  return Asset('public/image/').'/'.$path;
}
?>

<div class="table-responsive">
 <table class="table table-hover">
   <tr>
    <th width="25%">Sản Phẩm</th>
    <th>Image</th>
    <th width="10%">Loại SP</th>
    <th>Giá Sỉ</th>
    <th>Giá Gốc</th>
    <th>Giá Bán</th>
    <th>SL</th>
    <th>Người Tạo</th>
    <th>Date</th>
  </tr>
  <?php $count=0; ?>
  <?php foreach ($data as $item): ?>
   <tr <?php if($item->display==0) echo "class='opahi'" ?>>
    <td>{{$item->name}}

     <div class="groupaction">
      <span>Xem: {{$item->view}}</span>
      <span>|</span>
      <span>Status: <?php switch ($item->status) {
       case 'new':
       echo "Mới";
       break;

       case 'sale':
       echo "Giảm Giá";
       break;
       case 'hot':
       echo "Hot";
       break;
       case 'promotion':
       echo "Khuyến Mãi";
       break;
       case 'sell':
       echo "Bán Chạy";
       break;
       case 'over':
       echo "Hết Hàng";
       break;
       case 'Ngừng Kinh Doanh':
       echo "Ngừng Kinh Doanh";
       break;
       case 'Không Kinh Doanh':
       echo "Không Kinh Doanh";
       break;
       case '':
       echo "";
       break;
     } ?></span>

     <br />
     <a class="edit" href='{{Asset('admin/product/edit?id='.$item->id)}}'>Sửa</a>
     <form method="post" action="{{Asset('admin/product/addbin')}}" class="remove" msg="Bạn có chắc muốn đưa sản phẩm này vào thùng rác?" nocomfirm="true">
      <input type="hidden" name="id" value="{{$item->id}}">

      <input type="submit" value="Thùng rác">
    </form>
    <?php if($item->display==0){
      echo "<a class='edit displayitem' href='#' data-id='".$item->id."'>Hiện</a>";
    }else{
     echo "<a class='edit displayitem' href='#' data-id='".$item->id."'>Ẩn</a>";
   } ?>
 </div>
</td>
<td><img src="{{showImage($item->image)}}" style="width:50px" />
</td>
<td>
 {{$item->namec}}
</td>
<td>{{number_format($item->original_price,0,',','.')}}</td>
<td>{{number_format($item->promotion_price,0,',','.')}}</td>
<td>{{number_format($item->price,0,',','.')}}</td>
<td>{{$item->quantity}}</td>
<td>{{$item->nameuser}}</td>
<td>
  Tạo: 
  {{date('d/m/Y H:i',strtotime($item->created_at))}}
  <br />
  Cập Nhật:  {{date('d/m/Y H:i',strtotime($item->updated_at))}}
</td>

</tr>
<?php endforeach; ?>

</table>
<?php echo $data->render(); ?>
</div>
@endsection