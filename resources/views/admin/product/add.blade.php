@extends('layouts.admin')

@section('title', 'Thêm Sản Phẩm')
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
    display: none;
}
.boxupload .showimage:hover{
    cursor: pointer;
    text-decoration: underline;
}
.boxupload .showimg{
    width: 100px;
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
</style>
@endsection
@section('script')
 <script src="{{Asset('public/admin')}}/js/validate.js" ></script>

<script type="text/javascript" src="{{Asset('')}}public/admin/js/dialog.js"></script>

<script type="text/javascript">
 var base_url_admin="{{Asset('admin')}}/";
        var asset_path="{{Asset('public')}}/";
        var __token="{{csrf_token()}}";
         var dialogChooseColor=null;
         var dialogAddNewMenu=null;
         var dialogAddNewCT=null;
         var dialogAddNewTab=null;
        function callBackUpload(idobjclick,path){
            $(idobjclick).val(path);
            $(".boxupload .showimg").attr("src",asset_path+"image/"+path);
             $(".boxupload .showimage").show();
            $("#frm input[name='image']").removeClass("error").next(".errortext").hide();
        }
	$(function(){
		$("#nav-accordion>li:eq(1)>a").addClass("active").parent().find("ul>li:eq(1)").addClass("active");
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
            },
            {
                'name':'color',
                'trong':true
            }
    	]);

        $("#valiapp").show().find("input[type='submit']").removeAttr("disabled");


        $(".boxupload .showimage").click(function(){
            if($(this).html()==" Xem hình ảnh"){
                $(this).parent().find(".showimg").show();
                $(this).html(" Ẩn hình ảnh");
            }else{
                $(this).parent().find(".showimg").hide();
                $(this).html(" Xem hình ảnh");
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
@endsection
@section('content')
<h1 class="titlepage"><a href='{{Asset('admin/product')}}'><i class="fa fa-chevron-circle-left"></i></a> Thêm Sản Phẩm</h1>
@if(Session::has('message'))
        <p class="message hidemessage"> {{ Session::get('message') }}
        <i class="pull-right fa fa-times-circle"></i>
        </p>
@endif

<?php 
    $dataold=array();
    $dataold['name']="";
    $dataold['promotion_price']="";
    $dataold['price']="";
    $dataold['quantity']="";
    $dataold['content']="";
    $dataold['original_price']="";
    $dataold['image']="";
    $dataold['tag']="";


    if(Session::has('dataold')){
        $dataold=Session::get('dataold');
    }
?>

    <form method="post" action="" id="frm">
    	<div class="row">
    		<div class="col-md-2">
    			Tên Sản Phẩm:
    		</div>
    		<div class="col-md-10 require">
    			<div class="red">*</div>
    			<textarea class="form-control" name="name">{{$dataold['name']}}</textarea>
    			
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
                        <input type="text" name="promotion_price" class="form-control" value="{{$dataold['promotion_price']}}" />
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
                
                        <input type="text" name="price" value="{{$dataold['price']}}" class="form-control" />
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
                            <input type="text" name="image" class="form-control" id="imageproduct" value="{{$dataold['image']}}" />
                            <i class="fa fa-upload addon-icon showupload" title="upload image" href="#imageproduct"></i>
                        </div>
                        <div class="boxupload">
                          
                            <span class="showimage"> Xem hình ảnh</span>
                            <img src="" class="showimg" />
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
                    <div class="col-md-8">
                        <div class="red"></div>
                        <input type="text" name="original_price" class="form-control" value="1000" />
                        <span class="desc">Giá sỉ. Giá này không hiển thị trên website. Chỉ QTV biết giá này. Điền là 0 nếu không biết</span>
                    </div>
                </div> <br />
            </div>
            <div class="col-md-6">
                 <div class="row">                 
                    <div class="col-md-4">
                        Mô Tả Ngắn Gọn:
                    </div>
                    <div class="col-md-8">
                        <textarea class="form-control" name="content">{{$dataold['content']}}</textarea>
                      
                    </div>
                </div><br />
            </div>
        </div><br />
        <div class="row">
            
            <div style="display: none" class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Số Lượng:
                    </div>
                    <div class="col-md-8">
                        <div class="red"></div>
                       <input type="text" name="quantity" class="form-control" value="1" />
                        <span class="desc">Số lượng hiện có của sản phẩm. Nếu chưa có hàng thì điền là 0</span>
                    </div>
                </div><br />
            </div>
        </div>
        <br />
        <div class="row">
            <div style="display: none" class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Thuộc Menu:
                    </div>
                  <div  class="col-md-8 ">
                        <div class="red"></div>
                        <div class="addonselect">
                            <select name="menuID" class="form-control">
                                <option value="1">--Lựa Chọn--</option>
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
                </div><br />
            </div>
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
                </div><br />
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
                        <span class="desc">Số lượng hiện có của sản phẩm. Nếu chưa có hàng thì điền là 0</span>
                    </div>
                </div><br />
            </div>
        </div>
        <br />
        <div class="row">
            <div style="display: none" class="col-md-6">
                <div  class="row">
                    <div class="col-md-4">
                        Tab:
                    </div>
                    <div class="col-md-8">
                        <div class="addonselect">
                            <select name="tab_categoryID" class="form-control">
                                <option value="1">chọn</option>
                                @foreach($datatabcategory as $value)<option value="{{$value->id}}">{{$value->name}}</option>@endforeach
                            </select>
                            <i class="fa fa-plus" id="addnewtab" title="Thêm Mới"></i>
                        </div>
                    </div>
                </div><br />
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
                        <input name="tagID" type="text" class="form-control" />
               
                <span class="desc">Mỗi tag cách nhau 1 dấu ','</span>
                    </div>
                </div><br />
               
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                       Hiển Thị:
                    </div>
                    <div class="col-md-8">
                       <label style="font-weight:normal"><input type="checkbox" name="display" checked="checked" /> Hiển thị sản phẩm này trên website</label>
                    </div>
                </div><br />
            </div>
        </div>
        <div style="display: none" class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        Màu Sắc Sản Phẩm:
                    </div>
                    <div class="col-md-8">
                        <span class="red"></span>
                        <input type="text" value="red" name="color" id="colors" class="form-control" />
                        <span class="desc">Màu của sản phẩm. Click vào textbox để chọn màu</span>
                       
                    </div>
                </div><br />
            </div>
            <div class="col-md-6">
                 <div class="row">
                    <div class="col-md-4">
                        Kích Thước:
                    </div>
                    <div class="col-md-8">
                        <input type="text" value="xl" name="size" class="form-control" />
                        <span class="desc">Mỗi kích thước cách nhau 1 dấu ','. VD: S,M,L,XL</span>
                    </div>
                </div><br />
            </div>
        </div>
    	<div class="row">
    		<div class="col-md-12 text-right" id="valiapp">
    			<input type="submit" class="btn btn-success"  disabled="disabled" value="Lưu Lại" />
    			<input type="reset" class="btn btn-default" value="Nhập Lại" />
    		</div>
    	</div><br />
    	<input type="hidden" name="_token" value="{{csrf_token()}}"/>
    </form>
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

@include('upload')




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




@endsection