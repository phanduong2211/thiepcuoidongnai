/*
Copy right 2015 by trần văn thỏa
*/
var dialogupload=null;
var dialogshowimg=null;
function converSize(size){
  if(size>=1048576)
    return (size/1048576)+" MB";
    return Math.round((size/1024)*100,1)/100+" KB";
}
function LoadDataFolder(clickfirst){

  if(!$("#dialogupload .tabfolder li.active").hasClass("success")){

    var foldername=$("#dialogupload .tabfolder li.active").attr("data-value");
  
    var area=$("#dialogupload #"+(foldername.replace(/\//gi,"_"))+"folder");
    area.html("Đang Tải...<br /><small>Nếu không tải được vui lòng click vào nút tải lại.</small>");
        LoadJson(base_url_admin+"ajax/loadfolder",{"folder":foldername,"_token":__token},function(result){
        
        if(typeof result==="undefined" || typeof result==="number"){
          alert("Có lỗi. Không thể load folder");
           
        }else{

          if(typeof result==="object"){
            var leg=result.length;
            for (var i=0;i<leg;i++) {
              for (var j=i+1;j<leg;j++) {
                if(result[i].time<result[j].time){
                  var temp=result[i];
                  result[i]=result[j];
                  result[j]=temp;
                }
              }
            }
            var asset=asset_path+"image/"+foldername+"/";
          
            area.html("<div class='item col-md-2 col-sm-3 col-xs-6'>success</div>");
            var maxwidth=area.find(".item:eq(0)").width()+10;

            area.html("");
            for (var key in result) {
              var item=result[key];
              if(item['width']==null){
                area.append("<div class='item isfolder col-md-2 col-sm-3 col-xs-6'><div class='hoveritem'><div class='ctitem'><img class='' style='width:80px' src='"+asset_path+"/image/folder.png' /></div><div class='namefile'>"+item['name']+"</div></div></div>");
                continue;
              }
              var dorong=0;
              if(item['width']<maxwidth){
                dorong="width:"+item['width']+"px";
              }else{
                if(item['height']>=item['width']){
                  if(item['height']>100){
                    dorong="height:100px";
                  }else{
                    dorong="height:"+item['height']+"px";
                  }
                  
                }else{
                  dorong="width:100%";
                }
              }
              area.append("<div title='"+("Tên File: "+item['name']+"\nKích Thước: "+(converSize(item['size']))+"\nKích Thước: "+(item['width']+"x"+item['height'])+"\nNgày Tạo: "+item["time"])+"' class='item col-md-2 col-sm-3 col-xs-6'><div class='hoveritem'><div class='ctitem'><img class='contentitem' style='"+dorong+"' src='"+(asset+item['name'].replace(" ","%20"))+"' /></div><div class='namefile'>"+item['name']+"</div></div></div>");
            };

            if(clickfirst!=null){
              area.find(".item:eq(0)").click();
            }
          }
          $("#dialogupload .tabfolder li.active").addClass("success");     
          
        }
    }); 
  } 
}
function removeimgaa(){
  alert(pathremoveimg);
}
var idobjclick="";
var dialogxoahd=null;
var dialogxoafolder=null;
var dialognewfolder=null;
var pathremoveimg=null;
$(document).ready(function(){
    

        $("body").on("click",".showupload",function(){
          if(dialogupload==null){
            dialogupload=new dialog($("#dialogupload"),{
            "width":1000,
            "height":500
            });
            dialogupload.init();
          }
          LoadDataFolder();
       		dialogupload.show();
          idobjclick=$(this).attr("href");
          
        	return false;
   	 	  });

   	 	$("#dialogupload .tabupload .tabitem li").click(function(){
   	 		if(!$(this).hasClass("active")){
   	 			var parenttab=$(this).parent().find(".active").removeClass("active");
   	 			$("#dialogupload .ct #"+parenttab.attr("data-value")).hide();

				  $(this).addClass("active");   
				  $("#dialogupload .ct #"+$(this).attr("data-value")).show();	 			
   	 		 if($(this).attr("data-value")=="tabuploadimg"){
           $("#backfolderupload").hide();
          if($("#tabuploadimg>iframe").attr("src")==""){
            $("#tabuploadimg>iframe").attr("src",base_url_admin+"uploadimage?keyupload="+__token);
          }
         }

         if($(this).attr("data-value")=="tabuploadin"){
           $("#backfolderupload").hide();
          if($("#tabuploadin").html()==""){
            $("#tabuploadin").html('<iframe src="http://upload.aloxovn.com/" width="100%" height="650px" style="margin-top:-300px" frameborder="0"></iframe><br /><h4 style="font-size:15px;color:red">Upload ảnh xong click vào tab <b>Direct Link</b> để lấy url hình, sau đó dán vào textbox</h4>');
          }

         }

         if($(this).attr("data-value")=="tabchooseimg"){
          if($("#backfolderupload span").html()!=""){
            $("#backfolderupload").show();
          }
         }

        }
   	 	});



      $("#dialogupload .tabuploaditem").on('dblclick',"#folderitems .folderitem .isfolder",function(){
          var folderroot=$("#dialogupload .tabfolder li.active").attr("data-value");
          
          var foldername=$(this).find(".namefile").text();

          foldername=foldername.replace(/ /gi,"_").toLowerCase();

        $("#folderitems .active").removeClass("active");
          
          if(!$("#folderitems #"+folderroot.replace(/\//ig,"_")+"_"+foldername+"folder").length){
            
            $("#folderitems").append('<div id="'+(folderroot.replace(/\//ig,"_")+"_"+foldername)+'folder" data-value=\'{"folder":"'+(folderroot+"/"+foldername)+'"}\' class="folderitem active">Đang Tải...</div>');
            $("#dialogupload .tabfolder").append(' <li id="fff'+(folderroot.replace(/\//ig,"_")+"_"+foldername)+'" data-value="'+(folderroot+"/"+foldername)+'" style="display:none"></li>');
            
          }else{
            $("#folderitems #"+folderroot.replace(/\//ig,"_")+"_"+foldername+"folder").addClass("active");
          }

          $("#dialogupload .tabfolder li.active").removeClass("active").addClass("activeroot");

          $("#dialogupload .tabfolder #fff"+(folderroot.replace(/\//ig,"_")+"_"+foldername)).addClass("active");
          
          LoadDataFolder();

          $("#backfolderupload").show().find("span").attr("data-value",'{"folder":"'+(folderroot+"/"+foldername)+'"}').html(" "+folderroot+"/"+foldername);
           
          return false;
      });


      $("#dialogupload .tabuploaditem").on('dblclick',"#folderitems .folderitem .item",function(){
       
        if($(this).hasClass("isfolder")){
  
          return false;
        }
        var folder=jQuery.parseJSON($(this).parent('.folderitem').attr("data-value"));
        
        dialogupload.hide();
        callBackUpload(idobjclick,folder.folder+"/"+$(this).find(".namefile").html().replace(" ","%20"));
      });

      $("#dialogupload .tabuploaditem").on('click',"#folderitems .folderitem .item",function(){
        if(!$(this).hasClass("activeitem")){
          $(this).parent().find(".activeitem").removeClass("activeitem");
          $(this).addClass("activeitem");
        }else{
          $(this).removeClass("activeitem");
        }
        
      });

   	 	$("#dialogupload .tabfolder li").click(function(){
   	 		if(!$(this).hasClass("active")){
   	 			var parenttab=$(this).parent().find(".active").removeClass("active");
   	 			$("#dialogupload .ct #folderitems #"+parenttab.attr("data-value").replace(/\//ig,'_')+"folder").removeClass("active");

  				$(this).addClass("active");   
  				$("#dialogupload .ct #folderitems #"+$(this).attr("data-value")+"folder").addClass("active");	 			
     	 		 LoadDataFolder();
           $("#backfolderupload").hide().find("span").html("");
           $(this).parent().find(".activeroot").removeClass("activeroot");
        }
   	 	});
   	 	$("#dialogupload #refreshupload").click(function(){
   	 		 $("#dialogupload .tabfolder li.active").removeClass("success");
          LoadDataFolder();
   	 	});
      $("#dialogupload #newfolderupload").click(function(){
         if(dialognewfolder==null){
             dialognewfolder=new dialog($("#dialognewfolder"),{
              "width":350,
              "height":150,
              'ttop':50
              });
              dialognewfolder.init();
             dialognewfolder.getObj().find("#ajaxcreatefolder").click(function(){
                if($(this).hasClass("run")){
                  return false;
                }
                var foldername=dialognewfolder.getObj().find(".form-control").val().trim();
                if(foldername==''){
                  alert("Vui lòng nhập tên thư mục.");
                  return false;
                }
                var arrfoldername=foldername.toLowerCase().match(/([a-z0-9 _-]+)/g);
               
                if(typeof arrfoldername!="object"){
                  alert("Tên thư mục không được có ký tự đặc biệt.");
                  return false;
                }
                foldername="";
                for(var i=0;i<arrfoldername.length;i++){
                  foldername+=arrfoldername[i];
                }

                foldername=foldername.replace(/ /gi,"-");
                var folderroot=$("#dialogupload .tabfolder li.active").attr("data-value");
                var thf=$(this);
                thf.addClass("run");
                LoadJson(base_url_admin+"ajax/createfolder",{"foldername":foldername,"folderroot":folderroot,"_token":__token},function(result){
                  if(result==1){
                    var area=$("#dialogupload #"+folderroot.replace(/\//ig,"_")+"folder");
                  
                    area.prepend("<div class='item isfolder col-md-2 col-sm-3 col-xs-6'><div class='hoveritem'><div class='ctitem'><img class='' style='width:80px' src='"+asset_path+"/image/folder.png' /></div><div class='namefile'>"+foldername+"</div></div></div>");
                    dialognewfolder.hide();
                   
                    dialognewfolder.getObj().find(".form-control").val("");
                  }else{
                    alert("Thư mục đã tồn tại.");
                  }
                   thf.removeClass("run");
                });
             });
            }
            dialognewfolder.show();
            dialognewfolder.getObj().find(".form-control").focus();
      });
      $("#refreshuploadend").click(function(){
        var folderarea=$("#fff"+$(this).attr("data-folder").replace(/\//ig,"_"));
        if(!folderarea.length){
          $("#folderitems .active").removeClass("active");
          var folderroot=$(this).attr("data-folder");
          $("#folderitems").append('<div id="'+(folderroot.replace(/\//ig,"_"))+'folder" data-value=\'{"folder":"'+(folderroot)+'"}\' class="folderitem active">Đang Tải...</div>');
          $("#dialogupload .tabfolder").append('<li id="fff'+(folderroot.replace(/\//ig,"_"))+'" data-value="'+(folderroot)+'" style="display:none"></li>');
          
          $("#dialogupload .tabfolder li.active").removeClass("active").addClass("activeroot");

          $("#dialogupload .tabfolder #fff"+(folderroot.replace(/\//ig,"_"))).addClass("active");
          
          LoadDataFolder();
          $("#backfolderupload").show().find("span").attr("data-value",'{"folder":"'+(folderroot)+'"}').html(" "+folderroot);
          return false;
        }
        folderarea.click();
        if(folderarea.hasClass("success")){
          var result=jQuery.parseJSON($(this).attr("data-value"));
          var area=$("#dialogupload #"+$(this).attr("data-folder").replace(/\//ig,"_")+"folder");
          var maxwidth=area.find(".item:eq(0)").width()+10;
          var asset=asset_path+"image/"+$(this).attr("data-folder")+"/";
          for (var key in result) {
              var item=result[key];
              var dorong=0;
              if(item['width']<maxwidth){
                dorong="width:"+item['width']+"px";
              }else{
                if(item['height']>=item['width']){
                  if(item['height']>100){
                    dorong="height:100px";
                  }else{
                    dorong="height:"+item['height']+"px";
                  }
                  
                }else{
                  dorong="width:100%";
                }
              }
              area.prepend("<div title='"+("Tên File: "+item['name']+"\nKích Thước: "+(converSize(item['size']))+"\nKích Thước: "+(item['width']+"x"+item['height'])+"\nNgày Tạo: "+item["time"])+"' class='item col-md-2 col-sm-3 col-xs-6'><div class='hoveritem'><div class='ctitem'><img class='contentitem' style='"+dorong+"' src='"+(asset+item['name'].replace(" ","%20"))+"' /></div><div class='namefile'>"+item['name']+"</div></div></div>");
            };

            area.find(".item:eq(0)").click();
         
        }
        
      });

      $("#chooseImg").click(function(){
        var currentItemSeclect=$("#folderitems .folderitem.active .activeitem");
        if(currentItemSeclect.size()>0){
        if(!currentItemSeclect.eq(0).hasClass("isfolder")){
          var folder=jQuery.parseJSON(currentItemSeclect.parent('.folderitem').attr("data-value"));

          dialogupload.hide();
          callBackUpload(idobjclick,folder.folder+"/"+currentItemSeclect.find(".namefile").html().replace(" ","%20"));
        }else{
          alert("la folder");
        }
        }else{
          alert("Vui lòng chọn 1 hình ảnh");
        }
      });

      $("#backfolderupload i").click(function(){
        var data=jQuery.parseJSON($(this).parent().find("span").attr("data-value"));
        var arrdata=data.folder.split("/");
        arrdata.splice(arrdata.length-1,1);
        if(arrdata.length==1){
          $("#fff"+arrdata.toString()).removeClass("activeroot").click();
          return false;
        }
        arrdata=arrdata.toString().replace(/,/g,"/");
        $(".tabfolder .active").removeClass("active").removeClass("activeroot");
        $("#folderitems .active").removeClass("active");
        $(".tabfolder #fff"+arrdata.replace(/\//g,"_")).addClass("active");
        $("#folderitems #"+arrdata.replace(/\//g,"_")+"folder").addClass("active");
        $("#backfolderupload").show().find("span").attr("data-value",'{"folder":"'+arrdata+'"}').html(" "+arrdata);
      });

      $("#removeupload").click(function(){
        var currentItemSeclect=$("#folderitems .folderitem.active .activeitem");
        if(currentItemSeclect.size()>0){
            var namefile=currentItemSeclect.eq(0).find(".namefile").html();
            var folder=jQuery.parseJSON(currentItemSeclect.parent('.folderitem').attr("data-value"));
           
            pathremoveimg=folder.folder+"/"+namefile;
            if(currentItemSeclect.eq(0).hasClass("isfolder")){
              
                if(dialogxoafolder==null){
                  dialogxoafolder=new dialog($("#dialogxoafolder"),{
                    "width":400,
                    "height":170,
                    'ttop':50
                  });
                  dialogxoafolder.init();
                 
                }
                dialogxoafolder.getObj().find("b").html(namefile);
                dialogxoafolder.show();
                return false;
              }
            
            if(dialogxoahd==null){
              dialogxoahd=new dialog($("#dialogxoaimg"),{
                "width":400,
                "height":200,
                'ttop':50
              });
              dialogxoahd.init();
             
            }
            
            dialogxoahd.getObj().find("img").attr("src",asset_path+"image/"+pathremoveimg);
            dialogxoahd.getObj().find("b").html(namefile);
            dialogxoahd.show();
        }else{
          alert("Vui lòng chọn 1 hình ảnh");
        }
      });

      $("#btnremoveimgdialog").click(function(){
        var th=$(this);
        th.attr("disabled","disabled").val("Đang xóa...");
        LoadJson(base_url_admin+"ajax/removeimg",{"file":pathremoveimg,"_token":__token},function(result){
         th.removeAttr("disabled").val("Tiếp tục xóa");
          dialogxoahd.hide();
          if(result==1)
           $("#folderitems .folderitem.active .activeitem").remove();
         else
          alert("Hình ảnh không tôn tại.");
        });
      });

      $("#btnremovefolderdialog").click(function(){
        var th=$(this);
        th.attr("disabled","disabled").val("Đang xóa...");
        LoadJson(base_url_admin+"ajax/removefolder",{"file":pathremoveimg,"_token":__token},function(result){
         th.removeAttr("disabled").val("Tiếp tục xóa");
          dialogxoafolder.hide();
          switch(result){
            case 1:
            $("#folderitems .folderitem.active .activeitem").remove();
              break;
            case 2:
              alert('Thư mục không tồn tại');
              break;
            case 3:
              alert('Thư mục đang có các file khác. Vui lòng xóa hết dữ liệu trong thư mục trước khi xóa.');
              break;
          }
          
        });
      });

      $("#zoomimage").click(function(){
        var objselect=$("#folderitems .folderitem.active .activeitem");

        if(objselect.size()>0){
            if(objselect.eq(0).hasClass("isfolder"))
              return false;
          if(dialogshowimg==null){
            dialogshowimg=new dialog($("#dialogshowimg"),{
              "width":1100,
              "height":550
            });
            dialogshowimg.init();
          }
          var objdialog=dialogshowimg.getObj();
          objdialog.find(".ct").css("line-height",objdialog.height()-100+"px").html("<img src='"+objselect.find(".contentitem").attr("src")+"' class='img' />");
          objdialog.find(".img").css({"max-width":objdialog.width()-100,"max-height":objdialog.height()-100});
          objdialog.find("p").html(objselect.attr("title").replace(/\n/g," - "));
          
          dialogshowimg.show();
        }else{
          alert("Vui lòng chọn 1 hình ảnh");
        }

      });
});