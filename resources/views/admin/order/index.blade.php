@extends('layouts.admin')

@section('title', 'Đơn Hàng')
@section('script')
<script type="text/javascript">

  var base_url="{{Asset('admin')}}/";
  var asset_url="{{Asset('')}}";
  var __token="{{csrf_token()}}";
  var idfinish=0;
  var objfinish=null;
  var __datatoken=__token;
  function showImage(url,asset_path){
  if(url.indexOf('http')===0)
    return url;
  return asset_path+url;
}
Number.prototype.formatMoney = function(c, d, t){
var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };

 function removesp(obj){
  obj=$(obj);

  if(obj.parents("table").find("tr").size()==2){
    alert("Đơn hàng phải có ít nhất 1 sản phẩm.");
    return false;
  }

   getConfirm('Bạn có chắc muốn xóa sản phẩm <b>'+obj.attr("data-sp")+'</b> ra khỏi đơn hàng '+obj.attr('data-root')+'?',function(result){
        
        if(result){
          RunJson(base_url+"order/removesp",{"_token":__datatoken,"iddetail":obj.attr("data-id")},function(result){
            if(result.result=='1'){
              
              var tr=$(".table tr[data-value='"+obj.attr("data-root")+"']");
              var sl=parseInt(tr.find("td:eq(5)").text());
              sl--;
              tr.find("td:eq(5)").text(sl);
              var tt=obj.parents('tr').find("td:eq(5)").text();
              tt=parseFloat(tt.replace(/\./g,""));
              var tot=tr.find("td:eq(6)").text();
              tot=parseFloat(tot.replace(/\./g,""));
              tot=tot-tt;

              tot=tot.formatMoney(0,',','.');

              tr.find("td:eq(6)").text(tot);

              $("#DetailOrder .modal-body .pull-right").html("Tổng Tiền: <b>"+tot+" VNĐ</b>");

              $("#areadetail #order"+obj.attr("data-root")).remove();

              obj.parents('tr').remove();
            }else{
              alert(result.message);
            }
          });
        }
     });
   return false;
 }

function changequantity(th,name,id,idroot){
  var value=parseInt(th.value);
  var oldvalue=parseInt($(th).attr("data-value"));
  if(value!=oldvalue && value>0){
    var loai=(value>oldvalue)?"lên":"xuống";
    getConfirm('Bạn có chắc muốn thay đổi số lượng sản phẩm <b>'+name+'</b> từ '+oldvalue+' '+loai+' '+value+' ',function(result){
      if(result){
        RunJson(base_url+"order/changeq",{"_token":__datatoken,"iddetail":id,"sl":value},function(result){
          if(result=='1'){
              var tr=$(".table tr[data-value='"+idroot+"']");
              
              $(th).attr("data-value",value);
              var tien=parseFloat($(th).parents("tr").find("td:eq(4)").text().replace(/\./g,""));

              var tongtien=value*tien;

              $(th).parents("tr").find("td:eq(5)").text(tongtien.formatMoney(0,',','.'));
              var tot=parseFloat(tr.find("td:eq(6)").text().replace(/\./g,""));
              var tienhientai=0;

              if(value>oldvalue){
                tienhientai=tot+(tien*(value-oldvalue));
              }else{
                tienhientai=tot-(tien*(oldvalue-value));
              }

              tr.find("td:eq(6)").text(tienhientai.formatMoney(0,',','.'));

              $("#DetailOrder .modal-body .pull-right").html("Tổng Tiền: <b>"+tienhientai.formatMoney(0,',','.')+" VNĐ</b>");

              $("#areadetail #order"+obj.attr("data-root")).remove();
          }else{
            alert("Có lỗi. Vui lòng thử lại");
          }
        });
      }
    });
  }
}

  $(function(){
    $("#nav-accordion>li:eq(2)>a").addClass("active");

    $('#DetailOrder').on('shown.bs.modal', function(e) {
      var data=jQuery.parseJSON(e.relatedTarget.attributes.data.nodeValue);
      $(this).find(".modal-title").html("Chi Tiết Đơn Hàng Số "+data.id);
      $(this).find(".modal-body").html("Đang Tải...<br /><small>Nếu không tải được vui lòng close dialog và click lại.</small>");
      if(!$("#areadetail #order"+data.id).length){
        
      
      RunJson(base_url+"order/detail",{"id":data.id,"_token":__token},function(result){
        var html="<h5 style='border-bottom:1px solid #eee;padding-bottom:5px;margin-top:0px'>Thông Tin Khách Hàng</h5><div class='row'>";
        html+="<div class='col-md-6'><b>Họ Tên:</b> "+data.name+"</div>";
        html+="<div class='col-md-6'><b>Địa Chỉ:</b> "+data.address+"</div>";
        html+="<div class='col-md-6'><b>Số Điện Thoại:</b> "+data.phone+"</div>";
        html+="<div class='col-md-6'><b>Email:</b> "+data.email+"</div>";
        html+='</div>';
        html+="<br /><h5>Danh Sách Sản Phẩm</h5><div class='table-responsive'>";
        html+='<table class="table table-hover"><tr><th>STT</th><th width="30%">Tên SP</th><th>Hình SP</th><th>Size/Color</th><th>SL</th><th>Đơn Giá</th><th>Thành Tiền</th>';
        if(data.status=='0'){
          html+='<th>Xóa</th>';
        }
        html+='</tr>';

        var ttong=0;
       
        for(var i=0;i<result.length;i++){
          var item=result[i];
          html+='<tr>';
          html+='<td>'+(i+1)+'</td>';
          html+='<td>'+item.name+'</td>';
          html+='<td><img src="'+showImage(item.image,asset_url+'public/image/')+'" width="50px" /></td>';
          html+='<td>Size: '+item.size+'.<br />Color: '+item.color+'</td>';
          if(data.status=='0'){
            html+='<td><input type="number" data-value="'+item.quantity+'" onchange="changequantity(this,\''+item.name+'\','+item.detailid+','+data.id+')" value="'+item.quantity+'" style="width:50px" /></td>';
            
          }else{
            html+='<td>'+item.quantity+'</td>';
          }
        
          html+='<td>'+parseFloat(item.promotion_price).formatMoney(0,',','.')+'</td>';
          var tongt=parseFloat(item.quantity*item.promotion_price);
          ttong+=tongt;
          html+='<td>'+tongt.formatMoney(0,',','.')+'</td>';
          if(data.status=='0'){
            html+='<td><div class="removesporder" onclick="removesp(this)" data-sp="'+item.name+'" data-id="'+item.detailid+'" data-root="'+data.id+'">Xóa</div></td>';
          }
          html+='</tr>';
        }
         html+="</table></div><div class='pull-right' style='font-size:15px'>Tổng Tiền: <b>"+ttong.formatMoney(0,',','.')+" VNĐ</b></div><br />";
         $('#DetailOrder .modal-body').html(html);
        $("#areadetail").append("<div id='order"+data.id+"'>"+html+"</div>");
      });
      }else{
         $('#DetailOrder .modal-body').html($("#areadetail #order"+data.id).html());
      }
      
      
    });

$("#FinishOrder .modal-body .col-md-8 input").click(function(){
  $(this).select();
});
   

    $(".finishorder").click(function(){
      var th=$(this);
      var data=jQuery.parseJSON(th.attr('data'));
     getConfirm('Bạn có chắc muốn hoàn thành đơn hàng '+data.id+'?<br />P/S: Một khi hoàn thành bạn sẽ không thể xóa được đơn hàng.',function(result){
        
        if(result){

          $("#FinishOrder").modal({show:true});

          $("#FinishOrder .modal-title").html("Hoàn Thành Đơn Hàng "+data.id);
          $("#FinishOrder .modal-body .col-md-8 input").val($(".top-menu .username").text());
          
         objfinish=th;
         idfinish=data.id;


          // RunJson(base_url+'order/finish',{"id":data.id,"_token":__token,"flag":flag},function(result){
          
          //   th.parents("tr").removeClass("noaction");

          // });
        }
     });

    
     

      return false;
    });

    $("#FinishOrder .modal-footer .btn-success").click(function(){
     var name=$("#FinishOrder .modal-body .col-md-8 input").val().trim();
     if(name==''){
      alert('Vui lòng nhập họ tên.');
      return false;
    }
    $("#FinishOrder").modal('hide');
     objfinish.parents("tr").addClass("noaction");
      RunJson(base_url+'order/finish',{"id":idfinish,"_token":__token,"name":name},function(result){
          if(result=='1'){
            objfinish.parents("tr").removeClass("nosuccess");
            var iitem=objfinish.parents("tr").find("td:eq(0) i");
            var datai=jQuery.parseJSON(iitem.attr("data"));

            datai.status="1";
            iitem.attr("data",JSON.stringify(datai));

            if(!$("#areadetail #order"+idfinish).length){
              $("#areadetail #order"+idfinish+" .removesporder").remove();
            }
            objfinish.parents("tr").find("td:eq(7)").html("Đã Giao<br /><small>Bởi "+name+"<br />Vừa Xong</small>");
            objfinish.parents("tr").removeClass("noaction");
            objfinish.parent().remove();
          }else{
            objfinish.parents("tr").removeClass("noaction");
            alert('Có lỗi. Vui lòng thử lại');
          }
          

      });
    });


  $(".removeorder").click(function(){
    var thc=$(this);
    getConfirm('Xác nhận lần 1. Bạn có chắc muốn xóa đơn hàng này?<br /><small>Chỉ nên xóa khi đây là đơn hàng spam. Hãy kiểm tra kỹ trước khi xóa.</small>',function(result){
      if(result){
        setTimeout(function(){
           thc.next("form.remove").submit();
        },1000);
       
        return false;
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
      <a href='{{Asset('admin/order')}}' class="btn btn-primary btn-sm">Xem Tất Cả Đơn Hàng</a>
    @endif
    <?php  if(isset($_GET['f']) || isset($_GET['q'])){ ?>
     <a href="{{Asset('admin/order')}}" class="pull-left btn btn-default btn-sm" style="margin-left:5px">Xem tất cả</a>
    <?php } ?>
 </div>
 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-xs-marg text-right clearfix">
  <form method="get" action="" class="pull-right">
    <select class="sfilter" name="f">
      <option value="0">-Lọc-</option>
      <option value="1">Chưa Giao</option>
      <option value="2">Đã Giao</option>
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
      <option value="3">Tổng Tiền</option>
      <option value="4">Tổng Sản Phẩm</option>
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
    <th width="80px">Chi Tiết</th>
    <th>Mã</th>
    <th width="150px">Ngày Đặt</th>
    <th>Họ Tên</th>
    <th>Số ĐT</th>
    <th>Số SP</th>
    <th>Tổng Tiền</th>
    <th>Trạng Thái</th>
    <th width="10%">Ghi Chú</th>
  </tr>
  <?php $now=getdate(); foreach ($data as $item): ?>
   <tr data-value="{{$item->id}}" <?php if($item->status==0) echo "class='nosuccess'" ?>>
    <?php 
       $info=unserialize($item->address);
     ?>
    <td align="center">
      <i data-toggle="modal" data-target="#DetailOrder" data='{"id":"{{$item->id}}","name":"{{$info['name']}}","address":"{{$info['address']}}","phone":"{{$info['phone']}}","email":"{{$info['email']}}","status":"{{$item->status}}","tt":"{{number_format($item->tongtien,0,',','.')}}"}' class="fa fa-search"> Xem</i>
    </td>
    
     <td>
      {{$item->id}}
    </td>
    <td>
      <span title="<?php echo date('d/m/Y H:i',strtotime($item->created_at)) ?>">

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

      <?php if($item->status==0){ ?>
      <div class="groupaction">
        <a class='removeorder'>Xóa</a>
        <form method="post" action="" msg="<h4>Bạn vẫn chắc chắn muốn xóa đơn hàng {{$item->id}}?.</h4><small>Chỉ nên xóa khi đây là đơn hàng spam. Hãy kiểm tra kỹ trước khi xóa.</small>" class="remove hide" dataitem='{"id":"{{$item->id}}","title":"{{$item->id}}","url":"{{Asset('admin/order/delete')}}"}'>
            <input type="submit" value="Xóa">
        </form>
          <a href='#' data='{"id":"{{$item->id}}"}' class="edit finishorder">Hoàn Thành</a>
        
      </div>
      <?php } ?>
    </td>
    <td>
      ({{$info['sex']}}) {{$info['name']}}
    </td>
    <td>
      {{$info['phone']}}
    </td>
    <td>
      {{$item->sp}}
    </td>
    <td>
      {{number_format($item->tongtien,0,',','.')}}
    </td>
    <td>
      @if($item->status==0)
      Chưa Giao
      @else
        Đã Giao<br />
        @foreach($fi as $v)
        @if($v->idorder==$item->id)
        <small>Bởi {{$v->name}}<br />
          {{date('d/m/Y H:i',strtotime($v->created_at))}}
        </small>
        @endif
        @endforeach
      @endif
    </td>
    <td>
      {{$info['addcomment']}}
    </td>

</tr>
<?php endforeach; ?>

</table>
<?php echo $data->render(); ?>
</div>

<div id="DetailOrder" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="areadetail" style="display:none">
</div>

<div id="FinishOrder" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hoàn Thành Đơn Hàng</h4>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-md-4">Họ Tên Nhân Viên Hoàn Thành: </div>
            <div class="col-md-8">
              <input type="text" class="form-control" />
            </div>
          </div>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-success">Tiếp Tục</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
    </div>

  </div>
</div>


<style type="text/css">
  .table .nosuccess{
    background-color: #E9FFFD;
  }
  .table tr .fa-search:hover{
    color:blue;
    cursor: pointer;
  }
  .removesporder,.removeorder{
        color: #9C1616;
  }
  .removesporder:hover,.removeorder:hover{
          text-decoration: underline;
          cursor:pointer;
  }
  @media (min-width: 768px){
  .modal-dialog {
      width: 680px;
      margin: 30px auto;
  }

  #confirmbox .modal-dialog{
    width: 500px;
    margin-top: 90px;
    box-shadow: 0px 0px 3px #999;
  }

</style>
@endsection