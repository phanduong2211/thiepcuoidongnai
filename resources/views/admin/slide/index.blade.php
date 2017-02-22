@extends('layouts.admin')

@section('title', 'SlideShow')
@section('script')
<script src="{{Asset('public/admin')}}/js/validate.js" ></script>
<script type="text/javascript" src="{{Asset('')}}public/admin/js/dialog.js"></script>
<script type="text/javascript">
var base_url_admin="{{Asset('admin')}}/";
    var asset_path="{{Asset('public')}}/";
    var __token="{{csrf_token()}}";
     function callBackUpload(idobjclick,path){
            $(idobjclick).val(path);
            $(".boxupload img").attr("src",asset_path+"image/"+path);
    
            $("#modaldialog form input[name='image']").removeClass("error").next(".errortext").hide();
        }

    function callBackSuccessModal(data){
         if(dataitem.action=="addnew"){
            var html="<tr data-column='"+data.id+"'>";
            html+='<td><span>'+data.name+'</span>';
            html+='<div class="groupaction">';
            html+='<a class="edit" data-toggle="modal" dataitem=\'{"action":"edit","title":"Sửa '+data.name+'","id":"'+data.id+'","url":"'+(dataitem.url.substr(0,dataitem.url.length-3)+"edit")+'","value":{"name":"'+data.name+'","image":"'+data.image+'","content":"'+data.content+'","url":"'+data.url+'","page":"'+data.page+'"}}\' data-target="#modaldialog" href="#">Sửa</a>';
            html+='<form method="post" action="http://localhost/phukienthoitranggiare/admin/category/delete" class="remove" dataitem=\'{"id":"'+data.id+'","title":"'+data.name+'","url":"'+(dataitem.url.substr(0,dataitem.url.length-3)+"delete")+'"}\'>';
            html+='<input type="submit" value="Xóa">';
            html+='</form>';
            html+='</div>';
            html+="</td>";
            html+='<td><img src="'+showImage(data.image,asset_path+'image/')+'" style="width:100px"></td>';
            html+='<td>'+data.content+'</td>';
            html+='<td>'+data.url+'</td>';
            var page="";
            $("#modaldialog form select[name='page'] option").each(function(){
                if($(this).attr("value")==data.page){
                    page=$(this).text();
                }
            });
            html+='<td>'+page+'</td>';
            html+='<td>Tạo: '+data.created_at.date+'<br />Cập Nhật: '+data.updated_at.date+'</td>';
            html+='</tr>';
            $(".table-responsive .table tr:eq(0)").after(html);
            $("#modaldialog form .uploadimg").attr("src",asset_path+"image/uploadimg.png");
        }else{
            var obj=$(".table-responsive .table tr[data-column='"+data.idedit+"']");
            obj.find("td:eq(0) span:eq(0)").html(data.name);
            obj.find("td:eq(1) img").attr("src",showImage(data.image,asset_path+'image/'));
            obj.find("td:eq(2)").html(data.content);
            obj.find("td:eq(3)").html(data.url);
            var page="";
            $("#modaldialog form select[name='page'] option").each(function(){
                if($(this).attr("value")==data.page){
                    page=$(this).text();
                }
            });
            obj.find("td:eq(4)").html(page);
            obj.find("td:eq(5)").html("Vừa xong");
            dataitem.value.name=data.name;
            dataitem.value.content=data.content;
            dataitem.value.url=data.url;
            dataitem.value.page=data.page;
            dataitem.value.image=data.image;
            dataitem.title="Sửa "+data.name;
            obj.find("a.edit").attr("dataitem",JSON.stringify(dataitem));
            $("#modaldialog").modal('hide');
        }
    }
    $(function(){
        $("#nav-accordion>li:eq(3)>a").addClass("active");
    
        $("#modaldialog form").kiemtra([
           {
                'name':'name',
                'trong':true
            },
            {
                'name':'image',
                'trong':true
            },
            {
                'name':'url',
                'url':true,
                'isnull':true
            },
            {
                'name':'page',
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
  $(function(){
    $('#modaldialog').on('shown.bs.modal', function(e) {
      if(dataitem.action=="edit"){
        $(this).find("form .uploadimg").attr("src",showImage(dataitem.value.image,asset_path+'image/'));
       
      }else{
        $(this).find("form .uploadimg").attr("src",asset_path+"image/uploadimg.png");
      }
    });
  });
</script>
<script type="text/javascript" src="{{Asset('')}}public/admin/js/jsupload.js"></script>
@endsection
@section('content')
@if(Session::has('message'))
        <p class="message hidemessage"> {!! Session::get('message') !!}
        <i class="pull-right fa fa-times-circle"></i>
        </p>
@endif
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-bottom:5px">
       <div class="group-button clearfix">
           <a href="#addnew" dataitem='{"action":"addnew","title":"Thêm Mới","url":"{{Asset('admin/slide/add')}}"}' data-toggle="modal" id="addnewitem" data-target="#modaldialog" class="pull-left btn btn-primary btn-sm">Thêm mới</a>
       </div>
   </div>
   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xs-marg text-right clearfix">
    
    <div class="pull-right">
        <select class="sfilter noautosubmit" name="s">
            <option value="0" data-sort="desc" data-column="-1">-Sắp xếp-</option>
            <option value="1" data-sort="desc" data-column="-1">Mới nhất</option>
            <option value="2" data-sort="asc" data-column="-1">Cũ nhất</option>
            <option value="3" data-sort="asc" data-column="0">Tiêu Đề</option>
            <option value="3" data-sort="asc" data-column="2">Nội Dung</option>
            <option value="3" data-sort="asc" data-column="3">Url</option>
            <option value="3" data-sort="asc" data-column="4">Trang</option>
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
            <th>Tiêu Đề</th>
            <th>Hình Ảnh</th>
            <th width="10%">Nội Dung</th>
            <th>Liên Kết</th>
            <th>Hiện Thị Tại</th>
            <th>Date</th>
        </tr>
        @foreach ($data as $value)
            <tr data-column="{{$value->id}}">
            <td>
                <span>{{$value->name}}</span>
                 <div class="groupaction">
                        <a class="edit" data-toggle="modal" dataitem='{"action":"edit","title":"Sửa {{$value->name}}","id":"{{$value->id}}","url":"{{Asset('admin/slide/edit')}}","value":{"name":"{{$value->name}}","image":"{{$value->image}}","content":"{{$value->content}}","url":"{{$value->url}}","page":"{{$value->page}}"}}' data-target="#modaldialog" href='#'>Sửa</a>
                        <form method="post" action="{{Asset('admin/category/delete')}}" class="remove" dataitem='{"id":"{{$value->id}}","title":"{{$value->name}}","url":"{{Asset('admin/slide/delete')}}"}'>
                                <input type="submit" value="Xóa">
                        </form>
                 </div>
            </td>
            <td><img src="{{showImage($value->image)}}" style="width:100px" /></td>
            <td>
                 {!!$value->content!!}
            </td>
            <td>
                <a href='{{$value->url}}' target="_black">
                 <?php 
                    if(strlen($value->url)>20){
                        echo substr($value->url, 0,20)."...";
                    }else{
                        echo $value->url;
                    }
                 ?>
             </a>
            </td>
            <td>
                 {{$value->namepage}}
            </td>
            <td>
                Tạo: {{date('d/m/Y H:i',strtotime($value->created_at))}}<br />
            	Cập Nhật:  {{date('d/m/Y H:i',strtotime($value->updated_at))}}
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
                    <div class="col-md-3">
                        Tiêu Đề:
                    </div>
                    <div class="col-md-9 require">
                        <div class="red">*</div>
                        <input name="name" class="form-control" />
                    </div>
                </div><br />
                <div class="row">
                    <div class="col-md-3">
                        Hình Ảnh:
                    </div>
                    <div class="col-md-9 require boxupload">
                        <div class="red">*</div>
                        <img src="{{Asset('public/image/uploadimg.png')}}" class="img-thumbnail showupload uploadimg" href="#imagechooseval" id="imgchoose" width="100px">
                        <br><div class="text-left desc">Copy url image từ nơi khác và paste vào textbox bên dưới<br>
                        <input type="text" class="form-control " name="image" id="imagechooseval" />Hoặc upload ảnh khác. Kích thước chuẩn 870x432</div>
                     
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Nội Dung:
                    </div>
                    <div class="col-md-9 ">
                       <textarea name="content" rows="4" class="form-control"></textarea>
                        <span class="desc">Nội dung ngắn gọn. Khoảng 250 ký tự.</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Hiển Thị Trong Trang:
                    </div>
                    <div class="col-md-9 require">
                        <div class="red">*</div>
                        <select name="page" class="form-control">
                            <option value="-1">-- Lựa Chọn --</option>
                            <option value="0">Trang Chủ</option>
                            @foreach($datac as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                        <span class="desc">Slide này sẽ hiện thị trong trang nào?</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Liên Kết:
                    </div>
                    <div class="col-md-9">
                        <input name="url" class="form-control" type="text" />
                        <span class="desc">Khi click vào slideshow sẽ chuyển đến trang nào?. Copy url trang đó rồi dán vào.</span>
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

@include('upload')
    @endsection