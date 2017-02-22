@extends('layouts.admin')

@section('title', 'Quản Lý Menu')

@if(isset($_GET['iframe']))
<style type="text/css">
.header,#sidebar,.sfilter,.table .groupaction{
  display: none;
}
#main-content{
  margin-left: 0 !important;
}
.wrapper{
  margin-top: 0 !important;
}
</style>
@endif

@section('script')
<script src="{{Asset('public/admin')}}/js/validate.js" ></script>
<script type="text/javascript">
var iFrame="<?php if(isset($_GET['iframe'])) echo 'true'; else echo 'false'; ?>"
function callBackSuccessModal(data){
         if(dataitem.action=="addnew"){
           
            var tr="";
            if(data.root!=0){
                var obj=$(".table-responsive .table tr[data-column='"+data.root+"'] td:eq(1) i").size();
                tr+='<i class="fa fa-mail-forward"></i>';
                for(var ii=0;ii<obj;ii++){
                    tr+='<i class="fa fa-mail-forward"></i>';
                }
            }
            var html="<tr data-column='"+data.id+"'>";
            if(data.root==0)
                html+="<td>"+data.id+"</td>";
            else
                html+="<td></td>";
            html+='<td>'+tr+' <span>'+data.name+'</span>';
            html+='<div class="groupaction">';
            html+='<a class="edit" data-toggle="modal" dataitem=\'{"action":"edit","title":"Sửa '+data.name+'","id":"'+data.id+'","url":"'+(dataitem.url.substr(0,dataitem.url.length-3)+"edit")+'","value":{"name":"'+data.name+'","url":"'+data.url+'","root":"'+data.root+'"}}\' data-target="#modaldialog" href="#">Sửa</a>';
            html+='<form method="post" action="http://localhost/phukienthoitranggiare/admin/category/delete" class="remove" dataitem=\'{"id":"'+data.id+'","title":"'+data.name+'","url2":"'+data.url+'","root":"'+data.root+'","url":"'+(dataitem.url.substr(0,dataitem.url.length-3)+"delete")+'"}\'>';
            html+='<input type="submit" value="Xóa">';
            html+='</form>';
            html+='</div>';
            html+="</td>";
            html+='<td>'+data.url+'</td>';
            html+='<td>'+data.created_at.date+'</td>';
            html+='<td>'+data.updated_at.date+'</td>';
            html+='</tr>';
            if(data.root==0){
                 $(".table-responsive .table tr:eq(0)").after(html);
             }else{
                $(".table-responsive .table tr[data-column='"+data.root+"']").after(html);
             }
             $("#modaldialog form select[name='root']").append("<option value='"+data.id+"'>"+data.name+"</option>");
            if(iFrame=="true"){
              $('#addnewmenu', window.parent.document).parent().find("select").append("<option value='"+data.id+"'>"+data.name+"</option>").val(data.id);
              $('#dialogmenu .closedialog', window.parent.document).click();
            }
        }else{
            var obj=$(".table-responsive .table tr[data-column='"+data.idedit+"']");
            obj.find("td:eq(1) span:eq(0)").html(data.name);
            obj.find("td:eq(2)").html(data.url);
            obj.find("td:eq(4)").html("Vừa xong");
            dataitem.value.name=data.name;
            dataitem.value.url=data.url;
            dataitem.title="Sửa "+data.name;
            obj.find("a.edit").attr("dataitem",JSON.stringify(dataitem));
            $("#modaldialog").modal('hide');
        }
    }
    $(function(){
        $("#nav-accordion>li:eq(4)>a").addClass("active").parent().find("ul>li:eq(0)").addClass("active");
    
        $("#modaldialog form").kiemtra([
            {
                'name':'name',
                'trong':true
            },{
                'name':'root',
                'select':true
            }
        ],function(){
            callBackModal();
            return false;
        });
    });
</script>
@include('admin.script')

<script type="text/javascript">
    $(document).ready(function(){
        $('#modaldialog').on('shown.bs.modal', function(e) {
                var modal=$(this);
                dataitem=jQuery.parseJSON(e.relatedTarget.attributes.dataitem.nodeValue);
                modal.find(".modal-title").html(dataitem.title);
                
                if(dataitem.action=="edit"){
                    var obj=modal.find("form");
                    for(var item in dataitem.value) {
                        obj.find("[name='"+item+"']").val(dataitem.value[item]);
                    }
                }else{
                   var modal=modal.find("form");
                   modal.find("input[name='name']").val('');
                   modal.find("select[name='root']").val('-1');
                   modal.find("select[name='url']").val('');
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
           <a href="#addnew" dataitem='{"action":"addnew","title":"Thêm Mới","url":"{{Asset('admin/website/menu/add')}}"}' data-toggle="modal" id="addnewitem" data-target="#modaldialog" class="pull-left btn btn-primary btn-sm">Thêm mới</a>
       </div>
   </div>
   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xs-marg text-right clearfix">
    
    <form method="get" action="" class="pull-right">
        <select class="sfilter" name="s">
            <option value="0" data-sort="desc" data-column="-1">-Sắp xếp-</option>
            <option value="1" data-sort="desc" data-column="-1">Mới nhất</option>
            <option value="2" data-sort="asc" data-column="-1">Cũ nhất</option>
            <option value="3" data-sort="asc" data-column="1">Tên</option>
            <option value="4" data-sort="desc" data-column="2">Ngày Tạo</option>
            <option value="5" data-sort="desc" data-column="3">Ngày Cập Nhật</option>
        </select>
    </form>
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
            <th>Trang</th>
            <th>Ngày Tạo</th>
            <th>Ngày Cập Nhật</th>
        </tr>
        <?php $count=0; ?>
        <?php 
            function dequy($parentid,$arr,$datap,$res = '<i class="fa fa-mail-forward"></i>'){
                foreach ($arr as $key => $subvalue) {
                    if($subvalue->root==$parentid){?>
 <tr class="submenu" data-column="{{$subvalue->id}}">
            <td></td>
            <td>
                <?php echo $res ?> <span>{{$subvalue->name}}</span>
                <div class="groupaction">
                        <a class="edit" data-toggle="modal" dataitem='{"action":"edit","title":"Sửa {{$subvalue->name}}","id":"{{$subvalue->id}}","url":"{{Asset('admin/website/menu/edit')}}","value":{"name":"{{$subvalue->name}}","url":"{{str_replace('pages/','',$subvalue->url)}}","root":"{{$subvalue->root}}"}}' data-target="#modaldialog" href='#'>Sửa</a>
                        <form method="post" action="{{Asset('admin/website/menu/delete')}}" class="remove" dataitem='{"id":"{{$subvalue->id}}","title":"{{$subvalue->name}}","url2":"{{$subvalue->url}}","root":"{{$subvalue->root}}","url":"{{Asset('admin/website/menu/delete')}}"}'>
                                <input type="submit" value="Xóa">
                        </form>
                 </div>
            </td>
             <td>
                 @if($subvalue->url=='')
                 Sản phẩm
                 @else
                     @foreach($datap as $item)
                        @if('pages/'.$item->url==$subvalue->url)
                            {{$item->name}}
                        @endif
                     @endforeach
                 @endif
            </td>
            <td>
                 {{date('d/m/Y H:i',strtotime($subvalue->created_at))}}
            </td>
            <td>
                 {{date('d/m/Y H:i',strtotime($subvalue->updated_at))}}
            </td>
            </tr>
                    <?php     
                        dequy($subvalue->id,$arr,$datap,$res.' <i class="fa fa-mail-forward"></i>');
                    }
                }
            }
        ?>
        <?php foreach ($data as $key => $value) {?>
         <?php if($value->root==0){$count++; ?>
            <tr data-column="{{$value->id}}">
            <td>{{$count}}</td>
            <td>
                <span>{{$value->name}}</span>
                 <div class="groupaction">
                        <a class="edit" data-toggle="modal" dataitem='{"action":"edit","title":"Sửa {{$value->name}}","id":"{{$value->id}}","url":"{{Asset('admin/website/menu/edit')}}","value":{"name":"{{$value->name}}","url":"{{str_replace('pages/','',$value->url)}}","root":"{{$value->root}}"}}' data-target="#modaldialog" href='#'>Sửa</a>
                       <form method="post" action="{{Asset('admin/website/menu/delete')}}" class="remove" dataitem='{"id":"{{$value->id}}","title":"{{$value->name}}","url2":"{{$value->url}}","root":"{{$value->root}}","url":"{{Asset('admin/website/menu/delete')}}"}'>
                                <input type="submit" value="Xóa">
                        </form>
                 </div>
               
            </td>
            <td>
               @if($value->url=='')
                 Sản phẩm
                 @else
                     @foreach($datap as $item)
                        @if('pages/'.$item->url==$value->url)
                            {{$item->name}}
                        @endif
                     @endforeach
                 @endif
            </td>
            <td>
                 {{date('d/m/Y H:i',strtotime($value->created_at))}}
            </td>
            <td>
                 {{date('d/m/Y H:i',strtotime($value->updated_at))}}
            </td>
        </tr>
            <?php dequy($value->id,$data,$datap);
            } ?>
       <?php } ?>
       
        
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
                    <div class="col-xs-4">Tên Menu:</div>
                    <div class="col-xs-8 require">
                        <span class="red">*</span>
                        <input type="text" name="name" class="form-control" />
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-xs-4">Thuộc Menu:</div>
                    <div class="col-xs-8 require">
                        <span class="red">*</span>
                        <select name="root" class="form-control">
                        <option value="-1">--Lựa Chọn--</option>
                        <option value="0">Không Thuộc</option>
                        <?php 
                           function dequy11($parentid,$arr,$text = ''){
                                foreach ($arr as $key => $value) {
                                    if($value->root==$parentid){?>
                                        <option value="{{$value->id}}">{{$text.$value->name}}</option>
                                        <?php 
                                        dequy11($value->id,$arr,$text.'--');
                                    }
                                }
                            }
                       dequy11(0,$data);
                            ?>
                           
                        </select>
                        <span class="desc">Nếu không thuộc menu nào thì chọn không thuộc</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">Trang:</div>
                    <div class="col-xs-8">
                        <select name="url" class="form-control">
                            <option value=''>Trang hiện thị sản phẩm</option>
                            @foreach($datap as $item)
                                <option value='{{$item->url}}'>{{$item->name}}</option>
                            @endforeach
                        </select>
                        <span class="desc"></span>
                    </div>
                </div>
                <br />

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