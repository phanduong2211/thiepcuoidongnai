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
function showImage(url,asset_path){
	if(url.indexOf('http')===0)
		return url;
	return asset_path+url;
}
function dialog(obj,options){
	var th=this;
	var init=false;

	this.init=function(){	
		if(!obj.hasClass("dialog")){
			obj.addClass("dialog");
		}

		var widthobj=0;
		var heightobj=0;

		if(options.width!=null){
			widthobj=options.width;
		}else{
			widthobj=obj.width();
			options.width=widthobj;
		}

		if(options.height!=null){
			heightobj=options.height;
		}else{
			heightobj=obj.height();
			options.height=heightobj;
		}

		if(options.title==null){
			options.title="Tiêu Đề Dailog";
		}

		var widthw=$(window).width();
		var widthh=$(window).height();

		var left=(widthw-widthobj)/2;
		var top=(widthh-heightobj)/2;
		left=left*100/widthw;
		top=top*100/widthh;

		if(widthobj>widthw){
			widthobj=widthw-10;
			left=1;
		}
		if(heightobj>widthh){
			heightobj=widthh-10;
			top=1;
		}

		
		if(top<=5){
			top=6;
		}

		var trutop=75;

		if(options.ttop!=null){
			trutop=options.ttop;
		}

		obj.css({"width":widthobj,"height":heightobj,"left":left+"%","top":(top-5)+"%"});
		obj.find(".ct").css({"height":heightobj-trutop});

		if(!$(".dimb").length){
			$("body").append("<div class='dimb'></div>");
			if(options.outside==null){
				$(".dimb").click(function(){
					th.hide();
				});
			}
		}
		obj.find(".closedialog").click(function(){
			th.hide();
		});
		if(!init){
			obj.css("z-index",2100+$(".dialog").size());
			init=true;
			$(window).resize(function(){
				th.init();
			});
		}

	};
	this.show=function(){
		obj.fadeIn();
		if(options.hidedim==null)
		$(".dimb").fadeIn();
	};
	this.hide=function(){
		
		if($(".dialog:visible").size()>1){
			var maxZindex=0;
			var thmax=null;
			$(".dialog:visible").each(function(){
					if(this.style.zIndex>maxZindex){
						maxZindex=this.style.zIndex;
						thmax=this;
					}
			});
			$(thmax).fadeOut();
		}else{
			$(".dialog").fadeOut();
			$(".dimb").fadeOut();
		}
		
		
		if(options.removeObj!=null){
			obj.find(".ct "+options.removeObj).html("");
		}
	};
	
	this.getObj=function(){
		return obj;
	};
	this.resize=function(){
		th.init();
	};
}
