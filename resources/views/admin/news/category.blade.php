@extends('layouts.admin')

@section('title', 'Quản Lý Loại Tin Tức')
@section('script')
<script src="{{Asset('public/admin')}}/js/validate.js" ></script>
<script type="text/javascript">
function callBackSuccessModal(data){
         if(dataitem.action=="addnew"){
            var html="<tr data-column='"+data.id+"'>";
            html+="<td>"+data.id+"</td>";
            html+='<td><span>'+data.name+'</span>';
            html+='<div class="groupaction">';
            html+='<a class="edit" data-toggle="modal" dataitem=\'{"action":"edit","title":"Sửa '+data.name+'","id":"'+data.id+'","url":"'+(dataitem.url.substr(0,dataitem.url.length-12)+"edit-category")+'","value":{"name":"'+data.name+'"}}\' data-target="#modaldialog" href="#">Sửa</a>';
            html+='<form method="post" action="http://localhost/phukienthoitranggiare/admin/category/delete" class="remove" dataitem=\'{"id":"'+data.id+'","title":"'+data.name+'","url":"'+(dataitem.url.substr(0,dataitem.url.length-12)+"delete-category")+'"}\'>';
            html+='<input type="submit" value="Xóa">';
            html+='</form>';
            html+='</div>';
            html+="</td>";
            html+='<td>'+data.created_at.date+'</td>';
            html+='<td>'+data.updated_at.date+'</td>';
            html+='</tr>';
            $(".table-responsive .table tr:eq(0)").after(html);
        }else{
            var obj=$(".table-responsive .table tr[data-column='"+data.idedit+"']");
            obj.find("td:eq(1) span:eq(0)").html(data.name);
            obj.find("td:eq(3)").html("Vừa xong");
            dataitem.value.name=data.name;
            dataitem.title="Sửa "+data.name;
            obj.find("a.edit").attr("dataitem",JSON.stringify(dataitem));
            $("#modaldialog").modal('hide');
        }
    }
    $(function(){
        $("#nav-accordion>li#menuitemtt>a").addClass("active").parent().find("ul>li:eq(2)").addClass("active");
        $("#modaldialog form").kiemtra([
            {
                'name':'name',
                'trong':true
            }
        ],function(){
            callBackModal();
            return false;
        });
    });
</script>
@include('admin.script')
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
           <a href="#addnew" dataitem='{"action":"addnew","title":"Thêm Mới","url":"{{Asset('admin/news/add-category')}}"}' data-toggle="modal" id="addnewitem" data-target="#modaldialog" class="pull-left btn btn-primary btn-sm">Thêm mới</a>
       </div>
   </div>
   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xs-marg text-right clearfix">
    
    <div class="pull-right">
        <select class="sfilter noautosubmit" name="s">
            <option value="0" data-sort="desc" data-column="-1">-Sắp xếp-</option>
            <option value="1" data-sort="desc" data-column="-1">Mới nhất</option>
            <option value="2" data-sort="asc" data-column="-1">Cũ nhất</option>
            <option value="3" data-sort="asc" data-column="1">Tên</option>
            <option value="4" data-sort="desc" data-column="2">Ngày Tạo</option>
            <option value="5" data-sort="desc" data-column="3">Ngày Cập Nhật</option>
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
 <div class="table-responsive">
   <table class="table table-hover">
       <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Ngày Tạo</th>
            <th>Ngày Cập Nhật</th>
        </tr>
        <?php $count=0; ?>
        @foreach ($data as $value)
        <?php $count++; ?>
            <tr data-column="{{$value->id}}">
            <td>{{$count}}</td>
            <td>
               <span>{{$value->name}}</span>
                 <div class="groupaction">
                        <a class="edit" data-toggle="modal" dataitem='{"action":"edit","title":"Sửa {{$value->name}}","id":"{{$value->id}}","url":"{{Asset('admin/news/edit-category')}}","value":{"name":"{{$value->name}}"}}' data-target="#modaldialog" href='#'>Sửa</a>
                        <form method="post" action="{{Asset('admin/news/delete-category')}}" class="remove" dataitem='{"id":"{{$value->id}}","title":"{{$value->name}}","url":"{{Asset('admin/news/delete-category')}}"}'>
                                <input type="submit" value="Xóa">
                        </form>
                 </div>
            </td>
            <td>
                 {{date('d/m/Y H:i',strtotime($value->created_at))}}
            </td>
            <td>
                 {{date('d/m/Y H:i',strtotime($value->updated_at))}}
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
                    <div class="col-xs-4">Tên Loại Tin Tức:</div>
                    <div class="col-xs-8 require">
                        <span class="red">*</span>
                        <input type="text" name="name" class="form-control" />

                    </div>
                </div>
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