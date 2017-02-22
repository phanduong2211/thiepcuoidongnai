@extends('layouts.admin')

@section('title', 'Quản Trị Viên')
@section('script')
<script src="{{Asset('public/admin')}}/js/validate.js" ></script>

<script type="text/javascript">
  

  function callBackSuccessModal(data){
   if(dataitem.action=="addnew"){

    var html="<tr data-column='"+data.id+"' data-key='1'>";

    html+='<td><span>'+data.name+'</span>';
    html+='<div class="groupaction">';
    html+='<a class="edit" data-toggle="modal" dataitem=\'{"action":"edit","title":"Sửa '+data.name+'","id":"'+data.id+'","url":"'+(dataitem.url.substr(0,dataitem.url.length-3)+"edit")+'","value":{"name":"'+data.name+'","username":"'+data.username+'","email":"'+data.email+'","phone":"'+data.phone+'","level":"'+data.level+'","password":"123456"}}\' data-target="#modaldialog" href="#">Sửa</a>';
    html+='<form method="post" action="http://localhost/phukienthoitranggiare/admin/category/delete" class="remove" dataitem=\'{"id":"'+data.id+'","title":"'+data.name+'","url":"'+(dataitem.url.substr(0,dataitem.url.length-3)+"delete")+'"}\'>';
    html+='<input type="submit" value="Xóa">';
    html+='</form>';
    html+='</div>';
    html+="</td>";
    html+='<td>'+data.username+'</td>';
    html+='<td>'+data.email+'</td>';
    html+='<td>'+data.phone+'</td>';
    var capdo="";
    switch(data.level){
      case '1':
      capdo="Administrator";
      break;
      case '2':
      capdo="Moderator";
      break;
      case '3':
      capdo="Nhân Viên";
      break;
    }
    html+='<td>'+capdo+'</td>';
    html+='<td>Tạo: '+data.created_at.date+'<br />Cập Nhật: '+data.updated_at.date+'</td>';

    html+='</tr>';
    $(".table-responsive .table tr:eq(0)").after(html);

  }else{
    var obj=$(".table-responsive .table tr[data-column='"+data.idedit+"']");
    obj.find("td:eq(0) span:eq(0)").html(data.name);
    obj.find("td:eq(1)").html(data.username);
    obj.find("td:eq(2)").html(data.email);
    obj.find("td:eq(3)").html(data.phone);
    var capdo="";
    switch(data.level){
      case '1':
      capdo="Administrator";
      break;
      case '2':
      capdo="Moderator";
      break;
      case '3':
      capdo="Nhân Viên";
      break;
    }
    obj.find("td:eq(4)").html(capdo);
    obj.find("td:eq(5)").html("Vừa xong");
    dataitem.value.name=data.name;
    dataitem.title="Sửa QTV "+data.name;
    obj.find("a.edit").attr("dataitem",JSON.stringify(dataitem));
    $("#modaldialog").modal('hide');
  }
}

var base_url="{{Asset('admin')}}/";
var __token="{{csrf_token()}}";
$(function(){
  $("#nav-accordion>li:eq(6)>a").addClass("active");
  $("form.blockuser").submit(function(){
    var th=$(this);
    var th2=th;
    var loai=th.find("input[type='submit']").val();
    getConfirm('Bạn có chắc muốn '+loai+' QTV này?',function(result) {
      if(result){
        var id=th.find("input[name='id']").val();
        th=th.parents("tr");
        th.addClass("noaction");
        loai=(loai=="Khóa")?0:1;
        RunJson(base_url+'ad/active',{"id":id,"loai":loai,"_token":__token},function(result){
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
            th.attr("data-key",loai);
          }else{
            alert("có lỗi.");
          }
        });
      }
    });

    return false;
  });

  $("#modaldialog form").kiemtra([
  {
    'name':'name',
    'trong':true
  },
  {
    'name':'username',
    'trong':true
  },
  {
    'name':'email',
    'email':true,
    'isnull':true
  },
  {
    'name':'phone',
    'sodt':true,
    'isnull':true
  },
  {
    'name':'level',
    'select':true
  },
  {
    'name':'password',
    'trong':true
  }
  ],function(){
    callBackModal();
    return false;
  });

});
</script>
@include('admin.script')
<script type="text/javascript">
  $(function(){
    $('#modaldialog').on('shown.bs.modal', function(e) {
      if(dataitem.action=="edit"){
        $(this).find("form .row:last").hide();
        $(this).find("form .hiddeninedit").removeClass("form-control");
      }else{
        $(this).find("form .row:last").show();
        $(this).find("form .hiddeninedit").addClass("form-control");
      }
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
     <a href="#addnew" dataitem='{"action":"addnew","title":"Thêm Mới","url":"{{Asset('admin/ad/add')}}"}' data-toggle="modal" id="addnewitem" data-target="#modaldialog" class="pull-left btn btn-primary btn-sm">Thêm mới</a>
   </div>
 </div>
 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xs-marg text-right clearfix">
  <div class="pull-right">
    <select class="sfilter noautosubmit" name="f">
      <option value="0" data-key="" data-column="-2">-Lọc-</option>
      <option value="1" data-key="administrator" data-column="4">Là Administrator</option>
      <option value="2" data-key="moderator" data-column="4">Là Moderator</option>
      <option value="3" data-key="nhân viên" data-column="4">Là Nhân Viên</option>
      <option value="4" data-key="0" data-column="-1">Đang Khóa</option>
    </select>
  </div>
  <div class="pull-right">

    <select class="sfilter noautosubmit" name="s">
      <option value="0" data-sort="desc" data-column="-1">-Sắp xếp-</option>
      <option value="1" data-sort="desc" data-column="-1">Mới nhất</option>
      <option value="2" data-sort="asc" data-column="-1">Cũ nhất</option>
      <option value="3" data-sort="asc" data-column="0">Tên</option>
      <option value="4" data-sort="asc" data-column="1">Tài Khoản</option>
      <option value="4" data-sort="asc" data-column="2">Email</option>
      <option value="4" data-sort="asc" data-column="3">Số ĐT</option>
      <option value="4" data-sort="asc" data-column="4">Cấp Độ</option>
    </select>
  </div>
  <div class="pull-right">
    <div class="frmsearch clearfix" id="searchtable">
      <input title="" type="text" class="textboxsearch" value="<?php if(isset($_GET['q'])) echo $_GET['q']; ?>"  placeholder="Nhập nội dung tìm kiếm..." name="q" />
      <input type="submit" class="buttonsearch" value="" />
    </div>
  </div>


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
    <th>Tên</th>
    <th>Tài khoản</th>
    <th>Email</th>
    <th>Số điện thoại</th>
    <th>Cấp độ</th>
    <th>Date</th>
  </tr>
  @foreach($data as $item)
  <tr data-column="{{$item->id}}" data-key="{{$item->active}}" <?php if($item->active==0) echo "class='opahi'" ?>>
    <td><span>{{$item->name}}</span>
     <div class="groupaction">
       <a class="edit" data-toggle="modal" dataitem='{"action":"edit","title":"Sửa QTV {{$item->name}}","id":"{{$item->id}}","url":"{{Asset('admin/ad/edit')}}","value":{"name":"{{$item->name}}","username":"{{$item->username}}","email":"{{$item->email}}","phone":"{{$item->phone}}","level":"{{$item->level}}","password":"123456"}}' data-target="#modaldialog" href='#'>Sửa</a>
       <?php $useronline=Session::get('logininfo')->id; ?>
       @if($useronline!=$item->id)
       <form method="post" action="{{Asset('admin/ad/delete')}}" msg="Bạn có chắc muốn xóa QTV {{$item->name}}" class="remove" dataitem='{"id":"{{$item->id}}","title":"{{$item->name}}","url":"{{Asset('admin/ad/delete')}}"}'>
       
        <input type="submit" value="Xóa">
      </form>
      <form method="post" action="{{Asset('admin/ad/active')}}" class="remove blockuser" nocomfirm="true">
        <input type="hidden" name="id" value="{{$item->id}}">
        <input type="submit" value="{{$item->active==0?'Mở khóa':'Khóa'}}">
      </form>
      <form method="post" action="{{Asset('admin/ad/resetpass')}}" class="remove" msg="Bạn có chắc muốn reset lại mật khẩu cho QTV {{$item->name}}?. Mật khẩu sau khi reset là <b>123456</b>" dataitem='{"id":"{{$item->id}}","title":"{{$item->name}}","url":"{{Asset('admin/ad/reset-pass')}}"}'>
        <input type="submit" style="color:green" value="Reset Pass" />
      </form>
      @endif
    </div>
  </td>
  <td>
   {{$item->username}}
 </td>
 <td>
   {{$item->email}}
 </td>
 <td>
   {{$item->phone}}
 </td>
 <td>
  <?php 
  switch ($item->level) {
    case 1:
    echo "Administrator";
    break;
    case 2:
    echo "Moderator";
    break;
    case 3:
    echo "Nhân Viên";
    break;
  }
  ?>
</td>
<td>
  Tạo: 
  {{date('d/m/Y H:i',strtotime($item->created_at))}}
  <br />
  Cập Nhật:  {{date('d/m/Y H:i',strtotime($item->updated_at))}}
</td>

</tr>
@endforeach

</table>

</div>

<link rel="stylesheet" type="text/css" href="{{Asset('public/admin')}}/css/validate.css" />
<!--modal insert and edit-->
<div id="modaldialog" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p class="text-center"></p>
        <form method="post" action="{{Asset('admin/category/add')}}">
          <div class="row">
            <div class="col-xs-4">Họ Tên:</div>
            <div class="col-xs-8 require">
              <span class="red">*</span>
              <input type="text" class="form-control " name="name" value="{{$_POST['name'] or ''}}" />
              <span class="desc">Hiển thị khi đăng nhập</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              Tài Khoản:
            </div>
            <div class="col-md-8 require">
              <div class="red">*</div>
              <input type="text" class="form-control " name="username" value="{{$_POST['username'] or ''}}"  />
              <span class="desc">Dùng để đăng nhập vào website</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              Email:
            </div>
            <div class="col-md-8">
              <input type="email" class="form-control " name="email" value="{{$_POST['email'] or ''}}" />
              <span class="desc">Dùng để đăng nhập vào website</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              Số Điện Thoại:
            </div>
            <div class="col-md-8">
              <input type="text" class="form-control " name="phone" value="{{$_POST['phone'] or ''}}"  />

            </div>
          </div><br />
          <div class="row">
            <div class="col-md-4">
              Cấp Độ:
            </div>
            <div class="col-md-8 require">
              <span class="red">*</span>
              <select name="level" class="form-control">
               <option value="-1">-- Lựa Chọn --</option>
               <option value="1">Administrator</option>
               <option value="2">Moderator</option>
               <option value="3">Nhân Viên</option>
             </select>
             <span class="desc">
              Administrator: Có mọi quyền.
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            Mật Khẩu:
          </div>
          <div class="col-md-8 require">
            <span class="red">*</span>
            <input type="password" class="form-control hiddeninedit" value="{{$_POST['password'] or '123456'}}" name="password"  />
            <span class="desc">
              Mật khẩu mặc định là 123456
            </span>
          </div>
        </div>
        <input type="hidden" name="active" class="form-control hiddeninedit" value="1"/>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" id="savemodal" class="btn btn-primary">Lưu Lại</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
    </div>
  </div>

</div>
</div>
<!--//modal insert and edit-->

@endsection