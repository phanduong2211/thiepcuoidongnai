@extends('layouts.admin')

@section('title', 'Cập Nhật Sản Phẩm')
@section('css')
<link rel="stylesheet" type="text/css" href="{{Asset('public/admin')}}/css/validate.css" />
<style type="text/css">
    .addon{
        position: relative;
    }
    .addon-right .addon-icon{
        position: absolute;
        top:10px;
        right: 10px;
        cursor: pointer;
        color:#888;
    }
    .addon-right .addon-icon:hover{
        cursor: pointer;
        color:#333;
    }
    .addon-right .file{
        display: none;
    }
    .boxupload .showimg{
        display: none;
    }
    .boxupload span{
        color:#999;
        font-size: 11px;
    }
    .boxupload .showimage{
        color:blue;
    }
    .boxupload .showimage:hover{
        cursor: pointer;
        text-decoration: underline;
    }
    .boxupload .showimg{
        width: 100px;
    }
    .tabs{
        margin-bottom:15px;
        border-bottom:1px solid #ccc;
    }
    .tabs li{
        list-style: none;
        display: block;
        float: left;
        margin-right: 30px;
        padding-bottom: 5px;
        color:#999;
    }
    .tabs li:hover,.tabs li.active{
        cursor: pointer;
        color: #000;
    }
    .uploadimg{
        width: 100px;
    }
   
    .removeimgsss{
        font-weight: normal;
    }
    .removeimgsss:hover{
        text-decoration: underline;
        cursor: pointer;
    }
    .coloritem{
        width: 20px;
        height: 20px;
        border:1px solid #ccc;
    }
    #tablecolors tr{
        border-bottom:1px solid #ccc;

    }
     #tablecolors tr td{
        padding: 5px;
     }
     #dialog3 .header{
        position: relative;
     }
     #dialog3 .header #removefindcolor{
        position: absolute;
            top: 16px;
    left: 203px;
    color:#888;
    display: none;
     }
     #dialog3 .header #removefindcolor:hover{
        
    color:#333;
    cursor: pointer;
     }
     .addonselect{
    position: relative;
}
.addonselect .fa{
    position: absolute;
    top: 11px;
    right: 19px;
}
.addonselect .fa:hover{
    cursor: pointer;
    color:#000;
}
</style>
@endsection
@section('script')
<script src="{{Asset('public/admin')}}/js/validate.js" ></script>
<script type="text/javascript" src="{{Asset('')}}public/admin/js/dialog.js"></script>

<script type="text/javascript">
    var base_url_admin="{{Asset('admin')}}/";
    var asset_path="{{Asset('public')}}/";
    var __token="{{csrf_token()}}";
    var btnUpload=null;
    var dialogChooseColor=null;
      var dialogAddNewMenu=null;
         var dialogAddNewCT=null;
         var dialogAddNewTab=null;
    function callBackUpload(idobjclick,path){
        if(idobjclick=="#nicupload"){
            $("textarea"+btnUpload).parent().find(".nicEdit-main").append("<div class='postimg'><img src='"+asset_path+"image/"+path+"' /></div>");
            return false;
        }
        if(idobjclick=="#imageproduct"){
           $(idobjclick).val(path);
           $(".boxupload .showimg").attr("src",asset_path+"image/"+path);
           $(".boxupload .showimage").show();
           $("#frm input[name='image']").removeClass("error").next(".errortext").hide();
       }else{

        if(idobjclick.indexOf('#imageschooseval')===0 || idobjclick.indexOf('#imagesschooseval')===0){
            $(idobjclick).val(path).parent().parent().find("img").attr("src",asset_path+"image/"+path);

        }else{
           $(idobjclick).val(path);
       }
   }
}
$(function(){
  $("#nav-accordion>li:eq(1)>a").addClass("active");
  $("#frm").kiemtra([
  {
     'name':'name',
     'trong':true
 },
 {
    'name':'promotion_price',
    'gia':true,
    'message':'Vui lòng nhập giá gốc'
},
{
    'name':'price',
    'gia':true,
    'message':'Vui lòng nhập giá sản phẩm'
},
{
    'name':'original_price',
    'gia':true,
    'message':'Vui lòng nhập giá sỉ'
},
{
    'name':'image',
    'trong':true
},
{
    'name':'quantity',
    'so':true
},
{
    'name':'menuID',
    'select':true
},
{
    'name':'categoryID',
    'select':true
}
]);

  $("#valiapp").show().find("input[type='submit']").removeAttr("disabled");

$(".newimage").click(function(){
    var size=$("#imagescls").find(".itemimages").size();
   $("#imagescls").append('<div class="col-md-3 text-center itemimages"><img src="'+(asset_path+"image/uploadimg.png")+'" class="img-thumbnail showupload uploadimg" href="#imageschooseval'+size+'" id="imgchoose" width="50%" /><br /><b class="removeimgsss">Xóa</b><br /><div class="text-left desc">Copy url image từ nơi khác và paste vào textbox bên dưới<br /><input type="text" value="" class="form-control " name="images[]" id="imageschooseval'+size+'" />Hoặc upload ảnh khác.</div></div>');
   $("#imgaddimage").hide();
    return false;
});
$(".newimageslide").click(function(){
    var size=$("#imagesclss").find(".itemimages").size();
   $("#imagesclss").append('<div class="col-md-3 text-center itemimages"><img src="'+(asset_path+"image/uploadimg.png")+'" class="img-thumbnail showupload uploadimg" href="#imagesschooseval'+size+'" id="imgchoose" width="50%" /><br /><b class="removeimgsss">Xóa</b><br /><div class="text-left desc">Copy url image từ nơi khác và paste vào textbox bên dưới<br /><input type="text" value="" class="form-control " name="silebar_images[]" id="imagesschooseval'+size+'" />Hoặc upload ảnh khác.</div></div>');
   $("#slideaddimage").hide();
    return false;
});
$("#imagescls").on("click",".removeimgsss",function(){
    if($(this).parent().find('input[type="text"]').val()!=""){
        if(confirm("Bạn có chắc muốn xóa?")){
            $(this).parent().remove();

        }
        return false;
    }
    $(this).parent().remove();
    return false;
});
$("#imagesclss").on("click",".removeimgsss",function(){
    if($(this).parent().find('input[type="text"]').val()!=""){
        if(confirm("Bạn có chắc muốn xóa?")){
            $(this).parent().remove();

        }
        return false;
    }
    $(this).parent().remove();
    return false;
});
$(".boxupload .showimage").click(function(){
    if($(this).html()==" Xem hình ảnh"){
        $(this).parent().find(".showimg").show();
        $(this).html(" Ẩn hình ảnh");
    }else{
        $(this).parent().find(".showimg").hide();
        $(this).html(" Xem hình ảnh");
    }
});
$(".tabs li").click(function(){
    if(!$(this).hasClass("active")){
        var oldid=$(this).parent().find(".active").removeClass("active").attr("data-id");
        $(this).addClass("active");
        $("#"+oldid).hide();
        var id=$(this).attr("data-id");
        if(id=="detailproduct")
            window.location.hash="detail";
        else
             window.location.hash="info";
        $("#"+id).show();
    }
});


$("#colors").focus(function(){
   if(dialogChooseColor==null){
        dialogChooseColor=new dialog($("#dialog3"),{
            "width":300,
            "height":500,
            'ttop':50
        });
        dialogChooseColor.init();
        if($(this).val()!=""){
            var arrcolor=$(this).val().split(",");
            
                $("#tablecolors tr").each(function(){
                    var color=$(this).find("td:eq(0) input").val();
                    for (var i = 0; i < arrcolor.length; i++) {
                        if(color==arrcolor[i]){
                            $(this).find("td:eq(0) input").prop("checked",true);
                            break;
                        }
                    }
                });
            
        }
        $("#findcolor").click(function(){
            var text=$("#valuefindcolor").val().trim();
            if(text==""){
                $("#removefindcolor").hide();
                $("#tablecolors tr").show();
            }else{
                text=text.toLowerCase();
                 $("#tablecolors tr").hide();
                 $("#removefindcolor").show();
                $("#tablecolors tr").each(function(){

                    if($(this).find("td:eq(1)").attr("data-search").indexOf(text)!=-1){
                       $(this).show(); 
                    }
                });
            }
        });
        $("#removefindcolor").click(function(){
            $("#valuefindcolor").val("");
            $(this).hide();
                $("#tablecolors tr").show();
        });

         $("#tablecolors tr td input").change(function(){
            if(this.checked){
                var text=$("#colors").val();
                if(text=="")
                    text=$(this).val();
                else
                    text+=","+$(this).val();
                $("#colors").val(text);
            }else{
                var color=$(this).val();
                var arrtext=$("#colors").val().split(",");
                var text="";
                for (var i = 0; i < arrtext.length; i++) {
                   if(arrtext[i]!=color)
                   {
                        if(text=="")
                            text=arrtext[i];
                        else
                            text+=","+arrtext[i];
                   }
                }
                 $("#colors").val(text);
            }
         });
    }
    dialogChooseColor.show();
}).keypress(function(){
    return false;
});

$("#addnewmenu").click(function(){
        if(dialogAddNewMenu==null){
            dialogAddNewMenu=new dialog($("#dialogmenu"),{
                "width":1000,
                "height":500,
                "ttop":40
            });
            dialogAddNewMenu.init();
            dialogAddNewMenu.getObj().find("iframe").attr("src",base_url_admin+"website/menu?iframe=1");
        }
        dialogAddNewMenu.show();
    });

    $("#addnewct").click(function(){
        if(dialogAddNewCT==null){
            dialogAddNewCT=new dialog($("#dialogct"),{
                "width":1000,
                "height":500,
                "ttop":40
            });
            dialogAddNewCT.init();
            dialogAddNewCT.getObj().find("iframe").attr("src",base_url_admin+"category?iframe=1");
        }
        dialogAddNewCT.show();
    });

    $("#addnewtab").click(function(){
        if(dialogAddNewTab==null){
            dialogAddNewTab=new dialog($("#dialogtab"),{
                "width":1000,
                "height":500,
                "ttop":40
            });
            dialogAddNewTab.init();
            dialogAddNewTab.getObj().find("iframe").attr("src",base_url_admin+"tab?iframe=1");
        }
        dialogAddNewTab.show();
    });

});

function showImg(input) {
    if (input.files && input.files[0]) {
        if(isImage(input.files[0].name)){
            var reader = new FileReader();
            reader.onload = function (e) {
             $(".boxupload .showimg").attr("src",e.target.result);
         }
         $(".boxupload span.filename").html(input.files[0].name+".").parent().find(".showimage").show();
         $("#frm input[name='image']").removeClass("error").next(".errortext").hide();
         reader.readAsDataURL(input.files[0]);
     }else{
        alert("vui lòng chọn 1 hình ảnh");
    }
}
}
</script>
<script type="text/javascript" src="{{Asset('')}}public/admin/js/jsupload.js"></script>
<script type="text/javascript" src="<?php echo Asset('public/admin/js/nicEdit.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        new nicEditor({ fullPanel: true }).panelInstance("infomation");
        new nicEditor({ fullPanel: true }).panelInstance("data_sheet");
        if(window.location.hash!=""){
            if(window.location.hash=="#detail"){
                $(".tabs li:eq(1)").click();
            }else{
                  $("#detailproduct").hide();
            }
        }else{
            $("#detailproduct").hide();
        }
    });
</script>
@endsection
@section('content')
<h1 class="titlepage"><a href='{{Asset('admin/product')}}'><i class="fa fa-chevron-circle-left"></i></a> Cập Nhật Sản Phẩm | {{$data->name}}</h1>
 @if(Session::has('message'))
    <p class="message hidemessage"> {{ Session::get('message') }}
        <i class="pull-right fa fa-times-circle"></i>
    </p>
    @endif
<div class="tabs clearfix">
    <li class="active" data-id="infoproduct">Thông Tin Sản Phẩm</li>
    <li data-id="detailproduct">Chi Tiết Sản Phẩm</li>
</div>
<!--Infotab-->
<div id="infoproduct">
   

    <?php 
    function showImage($path){
        if(strpos($path, "http")===0)
            return $path;
        return Asset('public/image/').'/'.$path;
    }
    ?>

    <form method="post" action="" id="frm" name="frm">
    	<div class="row">
    		<div class="col-md-2">
    			Tên Sản Phẩm:
    		</div>
    		<div class="col-md-10 require">
    			<div class="red">*</div>
    			<textarea class="form-control" name="name">{{$data->name}}</textarea>
    			
    		</div>
    	</div>
        <br />
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Giá Gốc:
                    </div>
                    <div class="col-md-8 require">
                        <div class="red">*</div>
                        <input type="text" name="promotion_price" class="form-control" value="{{number_format($data->promotion_price,0,',','.')}}" />
                        <span class="desc">VD: 1 triệu thì điền 1.000.000 hoặc 1,000,000 hoặc 1 000 000. Nếu chưa có giá thì điền 0</span>
                    </div>
                </div><br />
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Giá Hiện Tại:
                    </div>
                    <div class="col-md-8 require">
                        <div class="red">*</div>

                        <input type="text" name="price" value="{{number_format($data->price,0,',','.')}}" class="form-control" />
                        <span class="desc">Giá bán hiện tại của sản phẩm này.</span>
                    </div>
                </div><br />
            </div>
        </div><br />
        <div class="row">
            <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            Hình Ảnh:
                        </div>
                        <div class="col-md-8 require">
                            <div class="red">*</div>
                            <div class="addon addon-right">
                                <input type="text" name="image" class="form-control" id="imageproduct" value="<?php echo $data->image ?>"  />
                                <i class="fa fa-upload addon-icon showupload" href="#imageproduct" title="upload image"></i>

                            </div>
                            <div class="boxupload">
                                <span class="showimage"> Xem hình ảnh</span>
                                <img src="<?php echo showImage($data->image) ?>" class="showimg" />
                            </div>
                            <span class="desc">Copy url hình ảnh và dán vào hoặc click vào icon upload để upload ảnh mới. Kích thước chuẩn 458x458</span>
                        </div>
                    </div><br />
            </div>
            <div style="display: none;" class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Giá Nhập Hàng:
                    </div>
                    <div class="col-md-8 require">
                        <div class="red">*</div>
                        <input type="text" name="original_price" class="form-control" value="{{number_format($data->original_price,0,',','.')}}" />
                        <span class="desc">Giá sỉ. Giá này không hiển thị trên website. Chỉ QTV biết giá này. Điền là 0 nếu không biết</span>
                    </div>
                </div><br />
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Mô Tả Ngắn Gọn:
                    </div>
                    <div class="col-md-8">
                        <textarea class="form-control" name="content">{{$data->content}}</textarea>
                    </div>
                </div><br />
            </div>
        </div><br />
        <div class="row">
            
            <div style="display: none;" class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Số Lượng:
                    </div>
                    <div class="col-md-8 require">
                        <div class="red">*</div>
                        <input type="text" name="quantity" class="form-control" value="{{$data->quantity}}" />
                        <span class="desc">Số lượng hiện có của sản phẩm. Nếu chưa có hàng thì điền là 0</span>
                    </div>
                </div><br />
            </div>
        </div>
        <br />
        <div class="row">

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Trạng Thái:
                    </div>
                    <div class="col-md-8">
                     <select name="status" class="form-control">
                        <option value="new">Mới</option>
                        <option value="sale">Giảm Giá</option>
                        <option value="hot">Hot</option>
                        <option value="promotion">Khuyến Mãi</option>
                        <option value="sell">Bán Chạy</option>
                        <option value="over">Hết Hàng</option>
                        <option value="Ngừng Kinh Doanh">Ngừng Kinh Doanh</option>
                        <option value="Không Kinh Doanh">Không Kinh Doanh</option>
                        <option value="">Không Có</option>
                    </select>
                </div>
            </div></div>
            <div style="display: none;" class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Thuộc Menu:
                    </div>
                    <div class="col-md-8 require">
                        <div class="red">*</div>
                        <div class="addonselect">
                            <select name="menuID" class="form-control">
                                <option value="-1">--Lựa Chọn--</option>
                                <?php 
                                function getMinRoot($data){
                                    $length=count($data);
                                    if($length>0){
                                        $min=$data[0]->root;
                                        for ($i=1; $i <$length ; $i++) { 
                                            if($data[$i]->root<$min)
                                                $min=$data[$i]->root;
                                        }
                                        return $min;
                                    }
                                    return 0;
                                }
                                function dequy($parentid,$arr,$text = ''){
                                    foreach ($arr as $key => $value) {
                                        if($value->root==$parentid){?>
                                        <option value="{{$value->id}}">{{$text.$value->name}}</option>
                                        <?php 
                                        dequy($value->id,$arr,$text.'--');
                                    }
                                }
                            }
                            dequy(getMinRoot($datamenu),$datamenu);
                            ?>

                        </select>
                        <i class="fa fa-plus" id="addnewmenu" title="Thêm Mới"></i>
                    </div>
                    <span class="desc">Chọn menu hiển thị sản phẩm.</span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    Loại Sản Phẩm:
                </div>
                <div class="col-md-8 require">
                    <div class="red">*</div>
                    <div class="addonselect">
                        <select name="categoryID" class="form-control">
                            <option value="-1">--Lựa Chọn--</option>
                            @foreach($datacategory as $value)<option value="{{$value->id}}">{{$value->name}}</option>@endforeach
                        </select>
                        <i class="fa fa-plus" id="addnewct" title="Thêm Mới"></i>
                    </div>
                </div>
            </div><br />
        </div>
    </div>
    <br />
    <div class="row">
        <div style="display: none;" class="col-md-6">
            <div class="row">
                <div class="col-md-4">
                    Tab:
                </div>
                <div class="col-md-8">
                    <div class="addonselect">
                        <select name="tab_categoryID" class="form-control">
                            <option value="0">--Lựa Chọn--</option>
                            @foreach($datatabcategory as $value)<option value="{{$value->id}}">{{$value->name}}</option>@endforeach
                        </select>
                        <i class="fa fa-plus" id="addnewtab" title="Thêm Mới"></i>
                    </div>
                </div>
            </div><br />
        </div>
        
        <br />
    </div>
</div>
<br />
<div class="row">
    <div class="col-md-6">
       <div class="row">
        <div class="col-md-4">
         Tag:
     </div>
     <div class="col-md-8">
        <input name="tagID" type="text" class="form-control" value="{{$data->tagID}}" />

        <span class="desc">Mỗi tag cách nhau 1 dấu ','</span>
    </div>
</div><br />

</div>
<div class="col-md-6">
    <div class="row">
        <div class="col-md-4">
         Ngày Tạo:
     </div>
     <div class="col-md-8">
         {{date('d/m/Y H:i',strtotime($data->created_at))}}
     </div>
 </div><br />
</div>
</div>
<div class="row">
  <div class="col-md-12 text-right" id="valiapp">
     <input type="submit" class="btn btn-success" disabled="disabled" value="Lưu Lại" />
     <input type="button" class="btn btn-default btn-reset" value="Hủy Bỏ" />
 </div>
</div><br />
<input type="hidden" name="_token" value="{{csrf_token()}}"/>
<input type="hidden" name="idedit" value="{{$data->id}}"/>
</form>
<script type="text/javascript">
    document.frm.menuID.value="{{$data->menuID}}";
    document.frm.categoryID.value="{{$data->categoryID}}";
    document.frm.tab_categoryID.value="{{$data->tab_categoryID}}";
    document.frm.status.value="{{$data->status}}";
</script>
</div><!--//Infotab-->
<!--DetailTab-->
<div id="detailproduct">
    <form method="post" id="frm2" action="{{Asset('admin/product/detail')}}">
        <div class="row">
            <div class="col-md-12">
            <div style="border-bottom:1px solid #ddd;padding-bottom:7px">
               <b> Hình Ảnh Khác:</b> 
               <a href='' class="newimage btn btn-xs btn-primary pull-right">
                            <i class="fa fa-plus"></i> Thêm Ảnh Khác

                        </a>
                        </div>
            </div><br /><br />
            <div class="col-md-12">
                <div class="row" id="imagescls" style="min-height:200px">
                 <?php 
                 $images=explode(",", $detail->images);
                 foreach ($images as $key => $value) {
                    if($value!=""){
                    ?>
                    <div class="col-md-3 text-center itemimages"><img src="{{showImage($value)}}" class="img-thumbnail showupload uploadimg" href="#imageschooseval{{$key}}" id="imgchoose" width="50%"><br><b class="removeimgsss">Xóa</b><br><div class="text-left desc">Copy url image từ nơi khác và paste vào textbox bên dưới<br><input type="text" value="{{$value}}" class="form-control " name="images[]" id="imageschooseval{{$key}}" />Hoặc upload ảnh khác.</div></div>
                    <?php }}
                    if(count($images)==1)
                        echo "<p id='imgaddimage' style='padding:0px 15px'>Click vào nút 'Thêm Ảnh Khác' phía trên để thêm ảnh.</p>";
                     ?>
                </div>
            </div>
        </div><br />
         <div class="row">
            <div class="col-md-12" >
                <div style="border-bottom:1px solid #ddd;padding-bottom:7px">
                <b>Hình Ảnh Khác(Ảnh nhỏ kích thước 80x80):</b>
                 <a href='' class="newimageslide btn btn-xs btn-primary pull-right">
                            <i class="fa fa-plus" ></i> Thêm Ảnh Khác

                        </a>
                        </div>
            </div><br /><br />
            <div class="col-md-12">
                <div class="row" id="imagesclss" style="min-height:200px">
                 <?php 
                 $silebar_images=explode(",", $detail->silebar_images);
                 foreach ($silebar_images as $key => $value) {
                    if($value!=""){
                    ?>
                    <div class="col-md-3 text-center itemimages"><img src="{{showImage($value)}}" class="img-thumbnail showupload uploadimg" href="#imagesschooseval{{$key}}" id="imgchoose" width="50%"><br><b class="removeimgsss">Xóa</b><br><div class="text-left desc">Copy url image từ nơi khác và paste vào textbox bên dưới<br><input type="text" value="{{$value}}" class="form-control " name="silebar_images[]" id="imagesschooseval{{$key}}" />Hoặc upload ảnh khác.</div></div>
                    <?php }} 
                    if(count($silebar_images)==1)
                        echo "<p id='slideaddimage' style='padding:0px 15px'>Click vào nút 'Thêm Ảnh Khác' phía trên để thêm ảnh.</p>";
                     ?>
                   <!--  <div class="col-md-3 text-center">
                        <a href='' class="newimageslide">
                            <i class="fa fa-plus" style="font-size:30px"></i>
                            <br />Thêm Ảnh Khác

                        </a>
                    </div> -->
                </div>
            </div>
        </div><!--//Silebar--><br />
        
        <div class="row">
             <div class="col-md-12" >
             <div style="border-bottom:1px solid #ddd;padding-bottom:7px">
                <b>Thông Tin Chi Tiết Sản Phẩm(Bài Viết Về Sản Phẩm):</b>
                </div>
             </div><br /><br />
             <div class="col-md-12" >
                <textarea id="infomation" name="infomation" style="width:100%;height:250px">{!!$detail->infomation!!}</textarea>
             </div>
        </div><!--//Info--><br /><br />
        <div class="row">
             <div class="col-md-12" >
             <div style="border-bottom:1px solid #ddd;padding-bottom:7px">
                <b>Thông Số Sản Phẩm:</b>
                </div>
             </div><br /><br />
             <div class="col-md-12" >
                <textarea id="data_sheet" name="data_sheet" style="width:100%;height:250px">{!!$detail->data_sheet!!}</textarea>
             </div>
        </div><!--//data-sheet--><br />
        <br />
        <div class="row">
            <div style="display: none;" class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Màu Sắc Sản Phẩm:
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="color" id="colors" class="form-control" value="{{$detail->color}}" />
                        <span class="desc">Màu của sản phẩm. Click vào textbox để chọn màu</span>
                       
                    </div>
                </div><br />
            </div>
            <div style="display: none;" class="col-md-6">
                 <div class="row">
                    <div class="col-md-4">
                        Kích Thước:
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="size" class="form-control" value="{{$detail->size}}" />
                        <span class="desc">Mỗi kích thước cách nhau 1 dấu ','. VD: S,M,L,XL</span>
                    </div>
                </div><br />
            </div>
        </div><br />
                <div class="row">
                    <div class="col-md-12 text-right">
                        <input type="submit" class="btn btn-success" value="Lưu Lại" />
                        <input type="button" class="btn btn-default btn-reset" value="Hủy Bỏ" />
                    </div>
                </div><br />
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <input type="hidden" name="idedit" value="{{$detail->id}}"/>
                <input type="hidden" name="idproductedit" value="{{$data->id}}"/>
                <input type="hidden" name="nameproductedit" value="{{$data->name}}"/>
            </div>

        </form>
    </div>
    <a class="nicupload showupload" href="#nicupload">Upload</a>
    <div id="dialogmenu" style="display:none">
        <div class='header'>
            Quản Lý Menu <i title="close" class="fa fa-times closedialog"></i>
        </div>
        <div class="ct" style="padding:0">
            <iframe src="" width="100%" height="98%" frameborder="0"></iframe>
        </div>
    </div>

<div id="dialogct" style="display:none">
        <div class='header'>
            Quản Lý Danh Mục <i title="close" class="fa fa-times closedialog"></i>
        </div>
        <div class="ct" style="padding:0">
            <iframe src="" width="100%" height="98%" frameborder="0"></iframe>
        </div>
    </div>

    <div id="dialogtab" style="display:none">
        <div class='header'>
            Quản Lý Tab <i title="close" class="fa fa-times closedialog"></i>
        </div>
        <div class="ct" style="padding:0">
            <iframe src="" width="100%" height="98%" frameborder="0"></iframe>
        </div>
    </div>
   <div id="dialog3">
        <div class='header'>
            Chọn Màu <input type="text" id="valuefindcolor" style="font-size:12px;width:50%" placeholder="Nhập tên màu..." /><input type="button"  id="findcolor" value="Tìm" /> <i title="close" class="fa fa-times closedialog"></i>
            <i class="fa fa-times-circle" id="removefindcolor"></i>
        </div>
        <div class="ct">
            <table border="0" id="tablecolors" style="width:100%">
            <tr>
                <td>
                <input type="checkbox" value="white" />
                </td>
                <td data-search="trang trắng">
                 Trắng
                </td>
                <td>
                    <div class='coloritem' style="background-color:white" ></div>
                </td>
            </tr>
            <tr>
                <td>
                <input type="checkbox" value="blue" />
                </td>
                <td data-search="xanh lam">
                  Xanh Lam
                </td>
                <td>
                    <div class='coloritem' style="background-color:blue" ></div>
                </td>
            </tr>
            <tr>
                <td>
                <input type="checkbox" value="skyblue" />
                </td>
                <td data-search="xanh da troi xanh da trời">
                  Xanh Da Trời
                </td>
                <td>
                    <div class='coloritem' style="background-color:skyblue" ></div>
                </td>
            </tr>
            <tr>
                <td>
                <input type="checkbox" value="red" />
                </td>
                <td data-search="do đỏ">
                Đỏ
                </td>
                <td>
                    <div class='coloritem' style="background-color:red" ></div>
                </td>
            </tr>
            <tr>
                <td>
                <input type="checkbox" value="yellow" />
                </td>
                <td data-search="vang vàng">
                Vàng
                    
                </td>
                <td>
                    <div class='coloritem' style="background-color:yellow" ></div>
                </td>
            </tr>
            <tr>
                <td>
                <input type="checkbox" value="black" />
                </td>
                <td data-search="den đen">
                  Đen
                </td>
                <td>
                    <div class='coloritem' style="background-color:black" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="green" />
                </td>
                <td data-search="luc lục">
                  Lục
                </td>
                <td>
                    <div class='coloritem' style="background-color:green" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="pink" />
                </td>
                <td data-search="hong hồng">
                 Hồng
                </td>
                <td>
                    <div class='coloritem' style="background-color:pink" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="purple" />
                </td>
                <td data-search="tim tím">
                 Tím
                </td>
                <td>
                    <div class='coloritem' style="background-color:purple" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="brown" />
                </td>
                <td data-search="nau nâu">
                 Nâu
                </td>
                <td>
                    <div class='coloritem' style="background-color:brown" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="tomato" />
                </td>
                <td data-search="da cam">
                 Da Cam
                </td>
                <td>
                    <div class='coloritem' style="background-color:tomato" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="tan" />
                </td>
                <td data-search="da">
                 Da
                </td>
                <td>
                    <div class='coloritem' style="background-color:tan" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="silver" />
                </td>
                <td data-search="bac bạc">
                 Bạc
                </td>
                <td>
                    <div class='coloritem' style="background-color:silver" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="gray" />
                </td>
                <td data-search="xam xám">
                 Xám
                </td>
                <td>
                    <div class='coloritem' style="background-color:gray" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="khaki" />
                </td>
                <td data-search="kaki">
                 Kaki
                </td>
                <td>
                    <div class='coloritem' style="background-color:khaki" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="olive" />
                </td>
                <td data-search="oliu">
                 Ô liu
                </td>
                <td>
                    <div class='coloritem' style="background-color:olive" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#F0DC82" />
                </td>
                <td data-search="da bo da bò">
                 Da bò
                </td>
                <td>
                    <div class='coloritem' style="background-color:#F0DC82" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#C41E3A" />
                </td>
                <td data-search="hong y hồng y">
                 Hồng y
                </td>
                <td>
                    <div class='coloritem' style="background-color:#C41E3A" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#007BA7" />
                </td>
                <td data-search="thien thanh thiên thanh">
                 Thiên thanh
                </td>
                <td>
                    <div class='coloritem' style="background-color:#007BA7" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#B87333" />
                </td>
                <td data-search="dong đồng">
                 Đồng
                </td>
                <td>
                    <div class='coloritem' style="background-color:#B87333" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#FF7F50" />
                </td>
                <td data-search="san ho san hô">
                 San hô
                </td>
                <td>
                    <div class='coloritem' style="background-color:#FF7F50" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#FFFDD0" />
                </td>
                <td data-search="kem">
                 Kem
                </td>
                <td>
                    <div class='coloritem' style="background-color:#FFFDD0" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#00FFFF" />
                </td>
                <td data-search="xanh lo xanh lơ ">
                 Xanh lơ 
                </td>
                <td>
                    <div class='coloritem' style="background-color:#00FFFF" ></div>
                </td>
            </tr>

             <tr>
                <td>
                <input type="checkbox" value="#4B0082" />
                </td>
                <td data-search="cham chàm">
                 Chàm
                </td>
                <td>
                    <div class='coloritem' style="background-color:#4B0082" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#00A86B" />
                </td>
                <td data-search="ngoc thach ngọc thạch">
                 Ngọc thạch
                </td>
                <td>
                    <div class='coloritem' style="background-color:#00A86B" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#CCFF00" />
                </td>
                <td data-search="vang chanh vàng chanh">
                 Vàng chanh
                </td>
                <td>
                    <div class='coloritem' style="background-color:#00A86B" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#E6E6FA" />
                </td>
                <td data-search="oai huong oải hương">
                Oải hương
                </td>
                <td>
                    <div class='coloritem' style="background-color:#E6E6FA" ></div>
                </td>
            </tr>

             <tr>
                <td>
                <input type="checkbox" value="#800000" />
                </td>
                <td data-search="hat de hạt dẻ">
                Hạt dẻ
                </td>
                <td>
                    <div class='coloritem' style="background-color:#800000" ></div>
                </td>
            </tr>


            <tr>
                <td>
                <input type="checkbox" value="#660099" />
                </td>
                <td data-search="tia tía">
                Tía
                </td>
                <td>
                    <div class='coloritem' style="background-color:#660099" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#FF2400" />
                </td>
                <td data-search="do tuoi đỏ tươi">
                Đỏ tươi
                </td>
                <td>
                    <div class='coloritem' style="background-color:#FF2400" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#FF4D00" />
                </td>
                <td data-search="do son đỏ son">
               Đỏ son
                </td>
                <td>
                    <div class='coloritem' style="background-color:#FF4D00" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#ACE1AF" />
                </td>
                <td data-search="men ngoc men ngọc">
               Men ngọc
                </td>
                <td>
                    <div class='coloritem' style="background-color:#ACE1AF" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#DE3163" />
                </td>
                <td data-search="anh dao anh đào">
               Anh đào
                </td>
                <td>
                    <div class='coloritem' style="background-color:#DE3163" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="#7FFF00" />
                </td>
                <td data-search="xanh non chuoi xanh nõn chuối">
               Xanh nõn chuối
                </td>
                <td>
                    <div class='coloritem' style="background-color:#7FFF00" ></div>
                </td>
            </tr>


            <tr>
                <td>
                <input type="checkbox" value="#704214" />
                </td>
                <td data-search="nau den nâu đen">
                Nâu đen
                </td>
                <td>
                    <div class='coloritem' style="background-color:#704214" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="beige" />
                </td>
                <td data-search="be">
                 Be
                </td>
                <td>
                    <div class='coloritem' style="background-color:beige" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="darkblue " />
                </td>
                <td data-search="xanh dam xanh đậm">
                 Xanh Đậm
                </td>
                <td>
                    <div class='coloritem' style="background-color:darkblue" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="aqua" />
                </td>
                <td data-search="xanh nhat xanh nhạt">
                 Xanh Nhạt
                </td>
                <td>
                    <div class='coloritem' style="background-color:aqua" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="blueviolet" />
                </td>
                <td data-search="xanh tim  xanh tím">
                 Xanh Tím
                </td>
                <td>
                    <div class='coloritem' style="background-color:blueviolet" ></div>
                </td>
            </tr>

            <tr>
                <td>
                <input type="checkbox" value="darkmagenta" />
                </td>
                <td data-search="tim dam tím đậm">
                 Tím Đậm
                </td>
                <td>
                    <div class='coloritem' style="background-color:darkmagenta" ></div>
                </td>
            </tr>

            </table>
        </div>
    </div>
    <!--//DetailTab-->
    @include('upload')
    @endsection
