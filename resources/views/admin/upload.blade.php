<?php if(!isset($_GET['keyupload'])){
	header("location:/");
} ?>
<?php 
function KhongDau($str){
	$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
	$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
	$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
	$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
	$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
	$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
	$str = preg_replace("/(đ)/", 'd', $str);
	return $str;
}
function formatToUrl($name){
	$name=KhongDau(trim(mb_strtolower($name,'UTF-8')));
	if (preg_match_all("/[a-za-z0-9_ ]*/", $name, $matches)) {
		$str="";
		foreach($matches[0] as $value)
		{
			$str.=$value;
		}
		$str=str_replace(" ", "-", $str);
		$str=str_replace("--", "-", $str);
		$str=str_replace("--", "-", $str);
		$str=str_replace("_", "-", $str);
		$str=str_replace("__", "-", $str);
		return $str;		  
	}
	return $name;
}
function createFileName($name,$basename,$i,$root,$duoi){
	if(file_exists($root."/".$name.".".$duoi)){
		return createFileName($basename."(".$i.")",$basename,$i+1,$root,$duoi);
	}
	return $name.".".$duoi;
}

function resize($width, $height,$path,$i){
  /* Get original image x y*/
  list($w, $h) = getimagesize($_FILES['image']['tmp_name'][$i]);
  /* calculate new image size with ratio */
  $ratio = max($width/$w, $height/$h);
  $h = ceil($height / $ratio);
  $x = ($w - $width / $ratio) / 2;
  $w = ceil($width / $ratio);
  /* new file name */
  /* read binary data from image file */
  $imgString = file_get_contents($_FILES['image']['tmp_name'][$i]);
  /* create image from string */
  $image = imagecreatefromstring($imgString);
  $tmp = imagecreatetruecolor($width, $height);
  imagecopyresampled($tmp, $image,
    0, 0,
    $x, 0,
    $width, $height,
    $w, $h);
  /* Save image */
  switch ($_FILES['image']['type'][$i]) {
    case 'image/jpeg':
      imagejpeg($tmp, $path, 100);
      break;
    case 'image/png':
      imagepng($tmp, $path, 0);
      break;
    case 'image/gif':
      imagegif($tmp, $path);
      break;
    default:
      return false;
      break;
  }
  imagedestroy($image);
  imagedestroy($tmp);
  return true;
  
}

if(isset($_POST['submit'])){
	$flag=false;
	if(isset($_FILES['image'])){
		$message=0;
		$arrex=array('png','jpg','jpeg','gif','bmp');
		$fileleg=count($_FILES['image']['name']);
		$maxsize=1048576;
		$arrupload=array();
		$path=dirname($_SERVER['SCRIPT_FILENAME'])."/public/image/".$_POST['folder'];
		
		if($_POST['resize']!=''){
			$arrresize=explode("x", $_POST['resize']);
			$maxwidth=(int)$arrresize[0];
			$maxheight=(int)$arrresize[1];	
		}
		for ($i=0; $i <$fileleg ; $i++) { 
			if($_FILES['image']['size'][$i]>0 && strpos($_FILES['image']['type'][$i],"image")===0){
					if($_FILES['image']['size'][$i]>$maxsize){
						continue;
					}
					$arr=explode(".", $_FILES['image']['name'][$i]);
					$length=count($arr)-1;
					if(!in_array($arr[$length], $arrex)){
						continue;
					}
					$name='';
					for($j=0;$j<$length;$j++)
						$name.=$arr[$j];
					$name=formatToUrl($name);

					$filename=createFileName($name,$name,1,$path,$arr[$length]);


					if(isset($maxwidth)){
						if(resize($maxwidth,$maxheight,$path.'/'.$filename,$i)){
							list($width,$height)=getimagesize($path.'/'.$filename);
						
							$arrupload[]=array(
								'width'=>$width,
								'height'=>$height,
								'name'=>$filename,
								'time'=>'Vừa Xong',
								'size'=>$_FILES['image']['size'][$i]
							);	
							$flag=true;
							$message++;
						}
					}else{
						if(move_uploaded_file($_FILES['image']['tmp_name'][$i],$path.'/'.$filename)){
							list($width,$height)=getimagesize($path.'/'.$filename);
							$arrupload[]=array(
								'width'=>$width,
								'height'=>$height,
								'name'=>$filename,
								'time'=>'Vừa Xong',
								'size'=>$_FILES['image']['size'][$i]
							);	
							$message++;
							$flag=true;
						}
					}
	
			}
		}
		$messagec=$message;
		$message="Upload thành công ".$message."/".$fileleg." hình ảnh";
		if((int)$messagec<(int)$fileleg){
			$message.=". Kích thước ảnh phải nhỏ hơn 1MB.";
		}
		echo "<div style='margin-bottom:10px;text-align:center;color:red'>".$message."</div>";
		header("Location: ".Asset('admin/uploadimage?keyupload='.$_GET['keyupload']));
	}else{
		$message="Vui lòng chọn hình ảnh để upload.";
		echo "<div style='margin-bottom:10px;text-align:center;color:red'>".$message."</div>";
		header("Location: ".Asset('admin/uploadimage?keyupload='.$_GET['keyupload']));
	}
}
?>
<link rel="stylesheet" type="text/css" href="{{Asset('public/admin')}}/css/dialog.css" />
<script type="text/javascript" src="{{Asset('public/admin')}}/js/jquery.js"></script>
<script type="text/javascript" src="{{Asset('public/admin')}}/js/dialog.js"></script>
<div style="text-align:center;margin-top:3%">
	
		<form method="post"  action="" enctype="multipart/form-data">
			
			<label for="image" style="display:block;width:520px;margin:10px auto;" id="areauploadfile" class="hoverarea">
				<input type="file" name="image[]" multiple="multiple" id="image" /><br />
				<div id="hiddenaup">
					<img src="{{Asset('public/image')}}/pVbuU.png" />
					<h1>Chọn hình ảnh để upload.<small>(png, jpg, jpeg, gif, bmp)</small></h1><br /><span style="color:#888;font-size:14px">Bạn có thể upload nhiều hình ảnh 1 lúc bằng cách giữ phím Ctrl và chọn các hình</span><br /><br />
				</div>
				<div id="hiddebup">
					<h3 id="slfile"></h3>
					<div style="margin-left:95px">
						<div style="float:left;width:100px;text-align:left;margin-top:3px">
							Lưu Vào:
						</div>
						<div style="float:left;width:170px">
							<input style="width:100%;padding:4px;border:1px solid #ccc;outline:none" onkeydown="return false;" type="text" value="upload" name="folder" id="foldersave" />
						</div>
						<div style="float:left;width:30px">
							<input type="button" id="choosefolder" style="padding:3px 7px" value="..." />
						</div>
					</div>
					<div style="clear:left"></div>
					<br />
					<div style="margin-left:95px">
						<div style="float:left;width:100px;text-align:left;margin-top:3px">
							Kích Thước:
						</div>
						<div style="float:left;width:200px">
							<select name="resize" style="padding:3px;width:100%">
								<option value="">Gữi nguyên kích thước gốc</option>
								<option value="458x458">458x458(Sản Phẩm)</option>
								<option value="80x80">80x80(Sản Phẩm Khác Nhỏ)</option>
								<option value="870x432">870x432(SlideShow)</option>
								<option value="270x169">270x169(Tin Tức)</option>
								<option value="130x50">130x50(Đối Tác)</option>
								<option value="270x432">270x432(Quảng Cáo Vị Trí 1)</option>
								<option value="770x243">770x243(Quảng Cáo Vị Trí 2)</option>
								<option value="370x243">370x243(Quảng Cáo Vị Trí 3)</option>
							</select>
						</div>
					</div>
					<br /><br /><br />
			
				</div>
				<div stype="height:10px"></div>
			</label>
				<div id="inputform">
			
				<input type="submit" id="submitform" value="Upload Hình Ảnh" name="submit" />
				<input type="reset" value="Hủy Bỏ" id="caupload" />
				</div>
			
			<input type="hidden" name="_token" value="{{csrf_token()}}"/>
		</form>
	</div>


<style type="text/css">
h1 small{
	color:#888;
	display: block;
	font-size: 14px;
	font-weight: normal;
}
#hiddebup{
	display: none;
}
#dialog4 .ct li{
	border:1px solid #fff;
	display: block;
	padding: 3px 7px;
	list-style: none;
	margin-bottom: 2px;
}
#dialog4 .ct li.active,#dialog4 .ct li:hover{
	border:1px solid #C1C1FF;
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    background-color: rgba(237, 245, 253,0.6);
    cursor: pointer;
}
#dialog4 #footerchoose{
	padding: 10px 20px;
	background-color: #eee;
	height: 45px;
}
#areauploadfile{
	border-radius: 3px;
	padding: 20px 0px;
	border:1px dashed #a100a1;
	background-color: #F9E9F9;
}
#areauploadfile #image{
	display: none;
}
#areauploadfile img{
	display: block;
	width: 80px;
	margin: 0px auto;
}
#slfile{
	margin-top: 0px;
	padding-top: 0px;
	color:#a100a1;
}
.hoverarea:hover{
	cursor: pointer;
}
#areauploadfile h1{
	font-size: 20px;
	color:#a100a1;
}
#dialog4{
	-moz-user-select: none;
  -khtml-user-select: none;
  -webkit-user-select: none;
  user-select: none;
}
#submitform{
	background-color: #721799;
    border: 1px solid #721799;
    color: white;
    padding: 7px 10px;
}
#submitform:hover{
	background-color: #a100a1;
    border: 1px solid #a100a1;
    cursor: pointer;
}
#caupload{
	background-color: #F7A400;
    border: 1px solid #F7A400;
    color: white;
    padding: 7px 10px;
}
#caupload:hover{
	background-color: #FCB322;
    border: 1px solid #FCB322;
    cursor: pointer;
}
#inputform{
	display: none;
	margin-top: -60px;
}
#areachoosefolder .subfolder{
	margin-left: 10px;
}
#areachoosefolder ul{
	margin: 0;
	padding: 0;
	margin-left: 5px;
	display: none;
}
#areachoosefolder li i{
	width: 16px;
    height: 16px;
	display: block;
	float: left;
	background-image:url('{{Asset('public/admin/img/nav-expand.png')}}');
	background-position: center top;
	background-color: #759E9E;
	margin-top: 1px;
	border-radius: 30%;
	margin-right: 5px;
}
#areachoosefolder li i:hover{
	background-color: #D06D6D;
}
#areachoosefolder li i.show{
	background-position: center bottom;
}
#areachoosefolder li i.load{
	background-image:url('{{Asset('public/admin/img/ajax-loader.gif')}}');
	background-position: center center;
	background-size: contain;
}
#areachoosefolder li{
	clear:left;
}
</style>

<div id="dialog4">
		<div class='header'>
			Chọn Folder <i title="close" class="fa fa-times closedialog"></i>
		</div>
		<div class='ct'>
			<div id="areachoosefolder">
				<li data-value="upload"><i class="plusfolder"></i> Upload</li>
				<ul></ul>
				<li data-value="product"><i class="plusfolder"></i> Sản Phẩm</li>
				<ul></ul>
				<li data-value="news"><i class="plusfolder"></i> Tin Tức</li>
				<ul></ul>
				<li data-value="slide"><i class="plusfolder"></i> Slide</li>
				<ul></ul>
				<li data-value="ads"><i class="plusfolder"></i> Quảng Cáo</li>
				<ul></ul>
			</div>
			
		</div>
		<div id="footerchoose">
				Folder Name: <input type="text" onkeydown="return false" id="foldercurrentname" style="padding:2px;border:1px solid #ccc;width:60%;outline:none" /><br />
				<div style="float:right;margin-top:7px">
				<input type="button" id="selectedfolder" value="Chọn" />
				<input type="button" value="Đóng" onclick="dialogchoosefolder.hide()" />
				</div>
			</div>
</div>

<script type="text/javascript">
	var foldername1="upload";
	var dialogchoosefolder=null;
	var isSelectFolder=false;
	var _base_url="{{Asset('')}}";
	var _to_ken="{{csrf_token()}}";
	function LoadJson(url,dt,callback) {
		$.ajax({
			type: "POST",
			url: url,
			dataType: 'json',
			data:dt,
			beforeSend: function(){
			},
			success: callback,
			error: function (e, e2, e3) {
			}
		});
	}

	function loadFolder(path,thobj){
		thobj.find("i").addClass("load");
		LoadJson(_base_url+"admin/ajax/loadonlyfolder",{"_token":_to_ken,"folder":path},function(result){
			var obj=thobj.next("ul");
			obj.html("");
			thobj.find("i").removeClass("load");
			if(typeof result==="object"){
				
				var parent=thobj.attr("data-value");
				for (var key in result) {
					obj.append('<li data-value="'+(parent+"/"+result[key])+'"><i class="plusfolder"></i> '+result[key]+'</li><ul></ul>');
          		}

			}else{
				alert("Có lỗi");
			}
			
		});
	}
	
	$(document).ready(function(){
		$("form input[name='folder']").change(function(){
			foldername1=$(this).val();
		});
		$("label#areauploadfile").click(function(){
			if(!$(this).hasClass("hoverarea"))
			return false;
		});
		$("#areauploadfile input[type='file']").change(function(){
			$("#hiddebup").show();
			$("#hiddenaup").hide();
			$("#inputform").show();
			$("#slfile").html(this.files.length+" hình ảnh được chọn.");

			$("#areauploadfile").css("padding-bottom","35px").removeClass("hoverarea");
			
			var flagc=true;
			for(var i=0;i<this.files.length;i++){
				if(this.files[i].name.split('.').pop()=="bmp"){
					flagc=false;
					break;
				}
			}

			if(flagc){
				$("#hiddebup>div:eq(2)").show();
			}else{
				$("#hiddebup>div:eq(2)").val("").hide();
			}
		});
		
		$("#caupload").click(function(){
			$("#hiddebup").hide();
			$("#hiddenaup").show();
			$("#inputform").hide();
			$("#areauploadfile").css("padding-bottom","20px").addClass("hoverarea");
		});
		$("#foldersave").focus(function(){
			$("#choosefolder").click();
		});
		if(!isSelectFolder){
			$("#foldersave").val($('.tabfolder .active',window.parent.document).attr("data-value"));
		}
		$('.tabupload .tabitem li:eq(1)', window.parent.document).click(function(){
			if(!isSelectFolder){
				$("#foldersave").val($('.tabfolder .active',window.parent.document).attr("data-value"));
			}
		});
		$("#choosefolder").click(function(){
			if(dialogchoosefolder==null){
				dialogchoosefolder=new dialog($("#dialog4"),{
				"width":300,
				"height":275,
				"ttop":125,
				"outside":false,
				"hidedim":true
				});
				dialogchoosefolder.init();
				$("#selectedfolder").click(function(){
					$("#foldersave").val($("#foldercurrentname").val());
					isSelectFolder=true;
					dialogchoosefolder.hide();
				});

				$("#dialog4").on('click','#areachoosefolder li',function(){
					if(!$(this).hasClass("active")){
						$(this).parents("div").find(".active").removeClass("active");
						$(this).addClass("active");
						dialogchoosefolder.getObj().find("#foldercurrentname").val($(this).attr("data-value"));
					}
				});
				$("#dialog4").on('dblclick','#areachoosefolder li',function(){
					$("#foldersave").val($("#foldercurrentname").val());
					isSelectFolder=true;
					dialogchoosefolder.hide();
				});

				$("#dialog4").on('click','#areachoosefolder li i',function(){
					if($(this).parent().hasClass("showsub")){
						$(this).parent().removeClass("showsub").next("ul").hide();
						$(this).removeClass("show");
					}else{
						var ul=$(this).parent().addClass("showsub").next("ul").show();
						if(!ul.attr("success")){
							loadFolder($(this).parent().attr("data-value"),$(this).parent());
						}
						$(this).addClass("show");
					}
				});
			}
			var value=$("#foldersave").val();
			dialogchoosefolder.getObj().find("#foldercurrentname").val(value);
			
			dialogchoosefolder.getObj().find("#areachoosefolder li").each(function(){
				if($(this).attr("data-value")==value){
					$(this).addClass("active");
				}
			});
			dialogchoosefolder.show();
		});
	});
</script>
<?php if(isset($flag) && $flag){ ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#refreshuploadend",window.parent.document).attr("data-value",'<?php echo json_encode($arrupload) ?>').attr("data-folder","<?php echo $_POST['folder'] ?>").click();
		$('.tabupload .tabitem li:eq(0)', window.parent.document).click();
	});
</script>

<?php } ?>