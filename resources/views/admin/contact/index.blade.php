@extends('layouts.admin')

@section('title', 'Liên Hệ')
@section('script')
<script type="text/javascript">
  var base_url="{{Asset('admin')}}/";
  var __token="{{csrf_token()}}";
  $(function(){
    $("#nav-accordion>li#menuitemlh>a").addClass("active").parent().find("ul>li:eq(0)").addClass("active");
     $("form.remove").submit(function(){
    var tho=$(this);
    getConfirm('Bạn có chắc xóa liên hệ này??',function(result) {
      if(result){
        var datadelete=jQuery.parseJSON(tho.attr("datadelete"));

        tho=tho.parents("tr");
        tho.addClass("noaction");
        datadelete['_token']=__token;
        RunJson(base_url+'contact/delete',datadelete,function(result){
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
      <a href='{{Asset('admin/contact')}}' class="btn btn-primary btn-sm">Xem Tất Cả Liên Hệ</a>
    @endif
    <?php  if(isset($_GET['f']) || isset($_GET['q'])){ ?>
     <a href="{{Asset('admin/contact')}}" class="pull-left btn btn-default btn-sm" style="margin-left:5px">Xem tất cả</a>
    <?php } ?>
 </div>
 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xs-marg text-right clearfix">
  <form method="get" action="" class="pull-right">
    <select class="sfilter" name="f">
      <option value="0">-Lọc-</option>
      <option value="1">Hôm Nay</option>
      <option value="2">Hôm Qua</option>
      <option value="3">Tháng Này</option>
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
      <option value="3">Email</option>
    </select>
    <?php if(isset($_GET["q"])){ ?>
    <input type="hidden" name="q" value="<?php echo $_GET["q"] ?>" />
    <?php } ?>
 
  </form>
  <form method="get" action="" class="pull-right">
    <div class="frmsearch clearfix">
      <input title="Nhập D/M/Y để xem liên hệ trong ngày hoặc M/Y để xem liên hệ trong tháng." type="text" class="textboxsearch" value="<?php if(isset($_GET['q'])) echo $_GET['q']; ?>"  placeholder="Nhập nội dung tìm kiếm..." name="q" />
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
     <th>Thời Gian</th>
    <th>Chủ Đề</th>
    <th>Email</th>
    <th width="30%">Nội Dung</th>
    <th>Trả Lời</th>
   
  </tr>
  <?php $level=Session::get('logininfo')->level;$now=getdate(); foreach ($data as $item): ?>
   <tr>
    <td> <span title="<?php echo date('d/m/Y H:i',strtotime($item->created_at)) ?>">
<?php $date_create=date_parse($item->created_at);
       if($date_create['year']==$now['year'] && $date_create['month']==$now['mon'] && $date_create['day']==$now['mday']){
        echo $date_create['hour'].":".$date_create['minute'];
       }else{
        if($date_create['year']==$now['year']){
          echo $date_create['hour'].':'.$date_create['minute'].' - '.$date_create['day'].' thg '.$date_create['month'];
        }
        else{
          echo date('d/m/Y H:i',strtotime($item->created_at));
        }
       }
        ?>
    </span>
    <?php if($level!=3){ ?>
    <div class="groupaction">
   
       <form method="post" action="{{Asset('admin/contact/delete')}}" class="remove" msg="Bạn có chắc muốn xóa liên hệ này?" datadelete='{"id":"{{$item->id}}","title":"{{$item->subject}}"}' nocomfirm="true">
      
        <input type="submit" value="Xóa">
    </form>
  </div>
  <?php } ?>
  </td>
<td>
 {{$item->subject}}
</td>
<td>
 {{$item->email}}
</td>
<td>
 {{$item->content}}
</td>
  <td>
       <a href='mailto:<?php echo $item->email ?>' class='fa fa-reply'></a>
   </td>
</tr>
<?php endforeach; ?>

</table>
<?php echo $data->render(); ?>
</div>
@endsection