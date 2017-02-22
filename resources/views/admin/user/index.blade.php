@extends('layouts.admin')

@section('title', 'Quản Lý Khách Hàng')
@section('script')
<script type="text/javascript">

  var base_url="{{Asset('admin')}}/";
  var __token="{{csrf_token()}}";
  $(function(){
    $("#nav-accordion>li#menuitemnd>a").addClass("active");

  $("form.blockuser").submit(function(){
    var th=$(this);
    var th2=th;
    var loai=th.find("input[type='submit']").val();
    getConfirm('Bạn có chắc muốn '+loai+' người dùng này?',function(result) {
      if(result){
        var id=th.find("input[name='id']").val();
        th=th.parents("tr");
        th.addClass("noaction");
        loai=(loai=="Khóa")?0:1;
        RunJson(base_url+'user/active',{"id":id,"loai":loai,"_token":__token},function(result){
          th.removeClass("noaction");
          if(result=="1"){
            if(loai==0){
              th.addClass("opahi");

              th2.find("input[type='submit']").val("Mở khóa");
            }
            else{
              th.removeClass("opahi");
              th2.find("input[type='submit']").val("Khóa");
            }
          }else{
            alert("có lỗi.");
          }
        });
      }
    });

    return false;
  });    


  $("form.remove").submit(function(){
    var tho=$(this);
    getConfirm('Bạn có chắc xóa người dùng này?',function(result) {
      if(result){
        var datadelete=jQuery.parseJSON(tho.attr("datadelete"));
        if(datadelete.dh>0){
          alert("Người dùng "+datadelete.title+" đã có đơn hàng. Không thể xóa.");
          return false;
        }

        tho=tho.parents("tr");
        tho.addClass("noaction");
        datadelete['_token']=__token;
        RunJson(base_url+'user/delete',datadelete,function(result){
          if(result=="1"){
            tho.remove();
          }else{
            alert("Có lỗi. Không thể xóa");
            tho.removeClass("noaction");
          }
        });

      }
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
   @if(isset($_GET['id']))
      <a href='{{Asset('admin/user')}}' class="btn btn-primary btn-sm">Xem Tất Cả Người Dùng</a>
    @endif
    <?php  if(isset($_GET['f']) || isset($_GET['q'])){ ?>
     <a href="{{Asset('admin/user')}}" class="pull-left btn btn-default btn-sm" style="margin-left:5px">Xem tất cả</a>
    <?php } ?>
 </div>
 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xs-marg text-right clearfix">
  <form method="get" action="" class="pull-right">
    <select class="sfilter" name="f">
      <option value="0">-Lọc-</option>
      <option value="1">Chưa Có Đơn Hàng</option>
      <option value="2">Đã Có Đơn Hàng</option>
      <option value="3">Ngày sinh hôm nay</option>
      <option value="4">Khóa</option>
      <option value="5">Mở Khóa</option>
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
      <option value="4">Địa chỉ</option>
      <option value="5">Ngày sinh</option>
      <option value="6">Ngày Tạo</option>
      <option value="7">Ngày Cập Nhật</option>
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

<div class="table-responsive">
 <table class="table table-hover">
   <tr>
    <th>Tên</th>
    <th>Ngày Sinh</th>
    <th>Giới Tính</th>
    <th>Email</th>
    <th>Số Điện Thoại</th>
    <th width="10%">Địa Chỉ</th>
    <th>Đơn Hàng</th>
    <th>Date</th>
  </tr>
  <?php $count=0; ?>
  <?php foreach ($data as $item): ?>
   <tr <?php if($item->active==0) echo "class='opahi'" ?>>
    <td>{{$item->name}}

     <div class="groupaction">
   
     <form method="post" action="{{Asset('admin/user/delete')}}" class="remove" msg="Bạn có chắc muốn xóa khách hàng {{$item->name}}?" datadelete='{"id":"{{$item->id}}","title":"{{$item->name}}","dh":"{{$item->dh}}"}' nocomfirm="true">
    
      <input type="submit" value="Xóa">
    </form>

     <form method="post" action="{{Asset('admin/ad/active')}}" class="blockuser" style="display:inline">
        <input type="hidden" name="id" value="{{$item->id}}">
        <input type="submit" style="color:blue;background-color:transparent;border:0px;padding:0px;padding-right:7px" value="{{$item->active==0?'Mở khóa':'Khóa'}}">
      </form>
   
 </div>
</td>
<td>
    <?php echo date('d/m/Y',strtotime($item->date)) ?>
</td>
<td>
 {{$item->sex=='1'?'Nam':'Nữ'}}
</td>
<td>
 {{$item->email}}
</td>
<td>
 {{$item->phone}}
</td>
<td>
 {{$item->address}}
</td>
<td>
 {{$item->dh}}
</td>
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