<link rel="stylesheet" type="text/css" href="{{Asset('')}}public/admin/css/dialog.css" />

<div id="refreshuploadend"></div>
<div id="dialogupload">
    <div class='header'>
        Chọn Hình Ảnh <span></span> <i title="close" class="fa fa-times closedialog"></i>
    </div>
    <div class="tabupload">
        <div class="tabitem clearfix">
            <li class="active" data-value="tabchooseimg">Chọn Hình Ảnh</li>
            <li data-value="tabuploadimg">Upload Hình Mới</li>
            <li data-value="tabuploadin">Upanhtocdo.com</li>
            
        </div>
        <div class="ct">
            <div id="backfolderupload"><i title="Trở ra" class="fa fa-arrow-circle-left"></i><span></span></div>
            <div class="tabuploaditem active" id="tabchooseimg">
                <div id="groupbutton" class="clearfix">
                    <div id="chooseImg" title="Chọn" class="fa fa-check"> Chọn</div>
                    <div id="removeupload" title="Xóa ảnh" class="fa fa-times"> Xóa</div>
                    <div id="zoomimage" title="Xem ảnh với kích thước lớn" class="fa fa-search-plus"> Phóng To</div>
                    <div id="newfolderupload" title="Tạo folder mới" class="fa fa-folder-o"> Tạo Thư Mục</div>
                    <div id="refreshupload" title="làm mới" class="fa fa-refresh"> Tải Lại</div>
                    
                    

                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-4">
                       <b style="display:block;margin-bottom:8px">Chọn Folder:</b>
                       <div class='tabfolder'>
                        <li id="fffupload" class="active" data-value="upload">Upload</li>
                        <li id="fffproduct" data-value="product">Sản Phẩm</li>
                        <li id="fffnews" data-value="news">Tin Tức</li>
                        <li id="fffslide" data-value="slide">Slide</li>
                        <li id="fffads" data-value="ads">Quảng Cáo</li>

                       
                    </div>
                </div>
                <div class="col-md-10 col-sm-8 col-xs-8" id="folderitems">
                    <div id="uploadfolder" data-value='{"folder":"upload"}' class="folderitem active">
                        Đang Tải...<br />
                        <small>Nếu không tải được vui lòng click vào nút tải lại.</small>
                    </div>

                   <div id="productfolder" data-value='{"folder":"product"}' class="folderitem">
                        Đang Tải...
                    </div> 

                    <div id="newsfolder" data-value='{"folder":"news"}' class="folderitem">
                        Đang Tải...
                    </div>

                    <div id="slidefolder" data-value='{"folder":"slide"}' class="folderitem">
                        Đang Tải...
                    </div>

                    <div id="adsfolder" data-value='{"folder":"ads"}' class="folderitem">
                        Đang Tải...
                    </div>
                </div>
            </div>
        </div>
        <div class="tabuploaditem" id="tabuploadimg">
            <iframe src="" width="100%" height="350px" frameborder="0"></iframe>
        </div>
        <div class="tabuploaditem" id="tabuploadin"></div>
    </div>

</div>

</div>

<div id="dialogshowimg">
    <div class='ct'>
    </div>
    <p></p>
    <div class="pull-right" style="margin-right:20px">
        <div class="btn btn-default" onclick="dialogshowimg.hide()">Đóng</div>
    </div>
</div>

<div id="dialogxoaimg">
    <div class='header'>
     Xác Nhận Xóa Hình Ảnh <i title="close" class="fa fa-remove closedialog"></i>
 </div>
 <div class='ct'>
 <div class='row'><div class='col-md-4 col-xs-4'><img class='img-thumbnail' style='width:100px' src='' /></div><div class='col-md-8 col-sm-8'>
    Bạn có chắc muốn xóa ảnh <b></b>.<br />Khi xóa ảnh này đi thì những nơi dùng ảnh này sẽ bị lỗi.<br />Bạn hãy kiểm tra kỹ trước khi xóa.<br /><br /><input type="button" class='btn btn-primary btn-xs' id="btnremoveimgdialog" value="Tiếp tục xóa" /> <a class='btn btn-default btn-xs' onclick='dialogxoahd.hide()'>Hủy bỏ</a>
</div></div>

</div>
</div>

<div id="dialogxoafolder">
    <div class='header'>
     Xác Nhận Xóa Thư Mục <i title="close" class="fa fa-remove closedialog"></i>
 </div>
 <div class='ct'>
 <div class='row'><div class='col-md-4 col-xs-4'><img class='img-thumbnail' style='width:100px' src='{{Asset('public/image/folder.png')}}' /></div><div class='col-md-8 col-sm-8'>
    Bạn có chắc muốn thư mục <b></b>.<br /><br /><br /><br /><input type="button" class='btn btn-primary btn-xs' id="btnremovefolderdialog" value="Tiếp tục xóa" /> <a class='btn btn-default btn-xs' onclick='dialogxoafolder.hide()'>Hủy bỏ</a>
</div></div>

</div>
</div>

<div id="dialognewfolder">
    <div class='header'>
     Tạo Thư Mục Mới <i title="close" class="fa fa-times closedialog"></i>
    </div>
    <div class='ct'>
        <div class="row">
            <div class="col-md-4">
                Tên Thư Mục:
            </div>
            <div class="col-md-8">
                <input type='text' class='form-control' />
            </div>
        </div><br />
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
                <input type="button" id="ajaxcreatefolder" value="Lưu Lại" />
                <input type="button" value="Hủy Bỏ" onclick="dialognewfolder.hide()" />
            </div>
        </div>
    </div>
</div>