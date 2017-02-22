@extends('layouts.admin')

@section('title', 'Thùng Rác Sản Phẩm')

@section('script')
<script type="text/javascript">
 
var base_url="{{Asset('admin')}}/";
    $(function(){
        $("#nav-accordion>li:eq(1)>a").addClass("active").parent().find("ul>li:eq(4)").addClass("active");
        
        $("form.remove1").submit(function(){
            var th=$(this);
        getConfirm('Bạn có chắc khôi phục sản phẩm này?',function(result) {
           if(result){
          var id=th.find("input[name='id']").val();
          var __token=th.find("input[name='_token']").val();
        th=th.parents("tr");
        th.addClass("noaction");
          RunJson(base_url+'product/restore',{"id":id,"_token":__token},function(result){
            if(result=="1"){
              th.fadeOut();
            }else{
              th.removeClass("noaction");
              alert("có lỗi. không thể khôi phục sản phẩm");
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
       <div class="group-button clearfix">
           <a href="{{Asset('admin/product')}}" class="pull-left btn btn-success btn-sm">Danh Sách Sản Phẩm</a>
       </div>
   </div>
   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xs-marg text-right clearfix">
    <form method="get" action="" class="pull-right">

        <select class="sfilter" name="s">
            <option value="0">-Sắp xếp-</option>
            <option value="1">Mới nhất</option>
            <option value="2">Cũ nhất</option>
            <option value="3">Tên</option>
            <option value="4">Ngày Tạo</option>
            <option value="5">Ngày Cập Nhật</option>
        </select>
    </form>
    <form method="get" action="" class="pull-right">
        <div class="frmsearch clearfix">
            <input title="" type="text" class="textboxsearch" value="<?php if(isset($_GET['q'])) echo $_GET['q']; ?>"  placeholder="Nhập nội dung tìm kiếm..." name="q" />
            <input type="submit" class="buttonsearch" value="" />
        </div>
        <?php if(isset($_GET["sort"])){ ?>
        <input type="hidden" name="sort" value="<?php echo $_GET["sort"] ?>" />
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
            <th>Sản Phẩm</th>
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
                         
                        <form method="post" action="{{Asset('admin/product/delete')}}" class="remove" msg="Bạn có chắc muốn xóa vĩnh viễn sản phẩm này?. Một khi xóa đi bạn sẽ không thể khôi phục.">
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <input type="hidden" name="title" value="{{$item->name}}">
                                <input type="submit" value="Xóa Vĩnh Viễn">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            </form>
                           <form method="post" action="{{Asset('admin/product/restore')}}" class="remove remove1" nocomfirm="true">
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <input type="hidden" name="title" value="{{$item->name}}">
                                <input type="submit" value="Khôi Phục">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            </form>
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
<style type="text/css">
  .remove.remove1 input[type='submit']{
    color:blue !important;
  }
</style>
    @endsection