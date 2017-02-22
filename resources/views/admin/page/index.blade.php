@extends('layouts.admin')

@section('title', 'Quản Lý Trang')
@section('script')
<script type="text/javascript">
   var __datatoken="{{csrf_token()}}";
    $(function(){
        $("#nav-accordion>li:eq(4)>a").addClass("active").parent().find("ul>li:eq(2)").addClass("active");
       
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
           <a href="{{Asset('admin/page/add')}}" class="pull-left btn btn-primary btn-sm">Thêm mới</a>
       </div>
   </div>
   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xs-marg text-right clearfix">
    
    <div class="pull-right">
        <select class="sfilter noautosubmit" name="s">
            <option value="0" data-sort="desc" data-column="-1">-Sắp xếp-</option>
            <option value="1" data-sort="desc" data-column="-1">Mới nhất</option>
            <option value="2" data-sort="asc" data-column="-1">Cũ nhất</option>
            <option value="3" data-sort="asc" data-column="0">Tên</option>
            <option value="4" data-sort="desc" data-column="4">Ngày Tạo</option>
            <option value="5" data-sort="desc" data-column="5">Ngày Cập Nhật</option>
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
            <th>Tiêu Đề</th>
            <th>Nội Dung</th>
            <th>Url</th>
            <th>Lượt Xem</th>
            <th>Ngày Tạo</th>
            <th>Ngày Cập Nhật</th>
        </tr>
        @foreach ($data as $value)
            <tr data-column="{{$value->id}}">
            <td>
                <span> <a target="_black" href='{{Asset('pages/'.$value->url)}}' >{{$value->name}}</a></span>
                <div class="groupaction">
                        <a class="edit" href='{{Asset('admin/page/edit?id='.$value->id)}}'>Sửa</a>
                        <form method="post" action="{{Asset('admin/page/delete')}}" class="remove" dataitem='{"id":"{{$value->id}}","title":"{{$value->name}}","url":"{{Asset('admin/page/delete')}}"}'>
                                <input type="submit" value="Xóa">
                        </form>
                 </div>
            </td>
            <td>
                <a target="_black" href='{{Asset('pages/'.$value->url)}}' >Xem</a>
            </td>
            <td>
                {{$value->url}}
            </td>
            <td>
                {{$value->view}}
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




@endsection