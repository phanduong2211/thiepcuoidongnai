(function ($) {
    $.fn.kiemtra=function(options,callback){
        check($(this),options,callback);
    }
})($);

String.prototype.str_trim = function() {
    return this.replace(/^\s+|\s+$/g,"");
}

function checklength(obj,maxl,minl){
	if(obj.val().str_trim().length>=minl && obj.val().str_trim().length<=maxl){
		return true;
	}
	return false;
}


function isEmpty(obj){
	if(obj.is(":disabled")){
		obj.off('keypress').removeClass('error').next('.errortext').hide();
		return true;
	}
	if(obj.val().str_trim().length>0){
		return true;
	}
	return false;
}

function isEmail(obj){
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(obj.val())) {
        return true
    }
	return false;
}

function isImage(file) {
    file = file.split(".").pop();
    switch (file) {
        case "jpg": case "png": case "gif": case "bimap": case "jpeg": case "ico":
            return true;
        default:
            return false;
    }
    return false;
}

function isVideo(file) {
    file = file.split(".").pop();
    switch (file) {
        case "mp4": case "avi": case "flv": case "3gp":
            return true;
        default:
            return false;
    }
    return false;
}

function isAudio(file) {
    file = file.split(".").pop();
    switch (file) {
        case "mp3": case "aac": case "wav":
            return true;
        default:
            return false;
    }
    return false;
}

function isPhoneNumber(obj) {
    if (/((\+([0-9]{1,3})(\.|-| )?([0-9]{3,4}))|(0[0-9]{2,3}))(\.|-| )?([0-9]{3,4})(\.|-| )?([0-9]{3,4})$/.test(obj.val())) {
        return true;
    }
    return false;

}

function isUrl(obj){
	if(obj.val()=="")
		return false;
	return /^(https|http|fpt|www)+(:\/\/|\\.)?.+$/i.test(obj.val());
} 


function checkIsNumber(obj) {
	return /^[0-9]+$/.test(obj.val());
}

function CompareObj(obj,c){
	var value=obj.val();
	if(c.indexOf("=")!=-1 && c.indexOf("<")==-1 && c.indexOf(">")==-1){
		return value==c.replace("=","").str_trim();
	}
	if(c.indexOf(">")!=-1){
		if(c.indexOf("<")!=-1){
			var nhohonbang=false;
			var lonhonbang=false;

			var mi;
			var ma;

			if(c.substring(c.indexOf(">")+1,c.indexOf(">")+2)=="="){
				nhohonbang=true;
				 mi=parseFloat(c.substring(c.indexOf(">")+2,c.indexOf("<")-1).str_trim());
			}else{
				 mi=parseFloat(c.substring(c.indexOf(">")+1,c.indexOf("<")-1).str_trim());
			}
			if(c.substring(c.indexOf("<")+1,c.indexOf("<")+2)=="="){
				lonhonbang=true;
				ma=parseFloat(c.substring(c.indexOf("<")+2,c.length).str_trim());
			}else{
				ma=parseFloat(c.substring(c.indexOf("<")+1,c.length).str_trim());
			}
			var v=parseFloat(obj.val().str_trim());

			if(nhohonbang && lonhonbang){
				return v>=mi && v<=ma;
			}

			if(nhohonbang){
				return v>=mi && v<ma;
			}

			if(lonhonbang){
				return v>mi && v<=ma;
			}

			return v>mi && v<ma;
			
		}
	}
}

function isDate(obj){
	var date=obj.val().str_trim().split("/");

	if(date.length==3){
		var ngay=parseInt(date[0]);
		var thang=parseInt(date[1]);
		var nam=parseInt(date[2]);

		if(thang>0 && thang<13){
			switch(thang){
				case 1: case 3: case 5: case 7: case 8: case 10: case 12:
					return ngay<32 && ngay>0;
				case 2:
					if((nam%4==0 && nam%100!=0) || nam%400==0)
						return ngay<30 && ngay>0;
					return ngay<29 && ngay>0;
				default:
					return ngay<31 && ngay>0;
			}
		}
		return false;
	}

	return false;
}

function isCharacter(obj){
	if(obj.is(":disabled")){
		obj.off('keypress').removeClass('error').attr('title','');
		return true;
	}
	return /^([a-zA-Z\u00A1-\uFFFF ])+$/.test(obj.val());
}

function isPrice(obj){
	if(obj.val().str_trim()=="")
		return false;
	if(obj.val().str_trim()=="0")
		return true;
	return /^[0-9]{1,3}( |-|\.|\,)?[0-9]{3}(( |-|\.|\,)?[0-9]{3})?(( |-|\.|\,)?[0-9]{3})?(( |-|\.|\,)?[0-9]{3})?$/.test(obj.val().str_trim());
}

function isPriceEn(obj){
	if(obj.val().str_trim()=="")
		return false;
	if(obj.val().str_trim()=="0")
		return true;
	return /^[0-9]{1,3}(( |-|\.|\,)?[0-9]{1,3})?(( |-|\.|\,)?[0-9]{1,3})?(( |-|\.|\,)?[0-9]{1,3})?$/.test(obj.val().str_trim());
}

function compare2obj(obj1,obj2){
	return obj1.val()==obj2.val();
}



function baseCheck(obj,option,errortext,b){
	obj.addClass("error");
	if(!obj.next('.errortext').length){
		obj.after("<span class='errortext'></span>");
	}
	if(option.message!=null)
		obj.next('.errortext').show().html(option.message);
	else
		obj.next('.errortext').show().html(errortext);

	if(b==null){
		obj.on('keydown',function(){
			$(this).off('keydown').removeClass('error').next(".errortext").hide();
		});
	}else{
		obj.on("change",function(){
			$(this).off('change').removeClass('error').next(".errortext").hide();
		});
	}
}

function check(th,options,callback){
	th.submit(function(){
		var flag=true;
		var error=false;

		for(var i=0;i<options.length;i++){
			error=false;
			
			if(options[i].name!=null){
				var obj=th.find('[name="'+options[i].name+'"]');
				if(options[i].isnull!=null){
					if(obj.val()==""){
						continue;
					}
				}
				if(options[i].max!=null && options[i].min!=null){
					
					if(!checklength(obj,options[i].max,options[i].min)){
						baseCheck(obj,options[i],'chiều dài không hợp lệ');
						flag=false;
						error=true;
					}
				}else{
					if(options[i].trong!=null && options[i].trong){
						if(options[i].array!=null && options[i].array){
							if(options[i].index==null){
								obj.each(function(){
									if(!isEmpty($(this))){

										baseCheck($(this),options[i],'không được bỏ trống');
										
										flag=false;
										error=true;
									}
								});
							}else{
								if(!isEmpty(obj.eq(options[i].index))){
									
									baseCheck(obj.eq(options[i].index),options[i],'không được bỏ trống');

									flag=false;
									error=true;
								}
							}
						}else{
							if(!isEmpty(obj)){
								baseCheck(obj,options[i],'không được bỏ trống');
								
								flag=false;
								error=true;
							}
						}
						
					}
				}
				if(options[i].email!=null && options[i].email && !error){
					
					if(!isEmail(obj)){
						baseCheck(obj,options[i],'Email không hợp lệ');
						flag=false;
						error=true;
					}
				}
				if(options[i].sodt!=null && options[i].sodt && !error){
					
					if(!isPhoneNumber(obj)){
						baseCheck(obj,options[i],'Số điện thoại không hợp lệ');
						flag=false;
						error=true;
					}
				}
				if(options[i].sosanh!=null && !error){
					if(!CompareObj(obj,options[i].sosanh)){
						baseCheck(obj,options[i],'Không hợp lệ');
						flag=false;
						error=true;
					}
				}
				if(options[i].so!=null && options[i].so && !error){
					
					if(!checkIsNumber(obj)){
						baseCheck(obj,options[i],'Phải là số');
						flag=false;
						error=true;
					}
				}
				if(options[i].date!=null && options[i].date && !error){
					if(!isDate(obj)){
						baseCheck(obj,options[i],'Thời gian không hợp lệ');
						flag=false;
						error=true;
					}
				}
				if(options[i].string!=null && options[i].string && !error){
					if(!isCharacter(obj)){
						baseCheck(obj,options[i],'Không được có ký tự đặc biệt');
						flag=false;
						error=true;
					}
				}
				if(options[i].gia!=null && options[i].gia && !error){
					if(!isPrice(obj)){
						baseCheck(obj,options[i],'Phải là tiền tệ VNĐ');
						flag=false;
						error=true;
					}
				}
				if(options[i].price!=null && options[i].price && !error){
					if(!isPriceEn(obj)){
						baseCheck(obj,options[i],'Phải là tiền tệ $');
						flag=false;
						error=true;
					}
				}
				if(options[i].sosanhdoituong!=null && options[i].sosanhdoituong && !error){
					var obj2=th.find('[name="'+options[i].name2+'"]');
					if(!compare2obj(obj,obj2)){
						baseCheck(obj,options[i],'Không hợp lệ');
						flag=false;
						error=true;
					}
				}
				if(options[i].select!=null && options[i].select && !error){

					if(obj.val()=="-1"){
						baseCheck(obj,options[i],'Vui lòng lựa chọn',true);
						flag=false;
						error=true;
					}
				}
				if(options[i].url!=null && options[i].url && !error){
					if(!isUrl(obj)){
						baseCheck(obj,options[i],'Url không hợp lệ',true);
						flag=false;
						error=true;
					}
				}
				if(options[i].file!=null && options[i].file){

					if(obj.val().length>0){
						if(options[i].typefile!=null){
							switch(options[i].typefile){
								case "image":
								if(!isImage(obj.val())){
									if(obj.hasClass("none")){
										obj.parent().find(".asimg").addClass('error').attr('title','Vui lòng chọn 1 hình ảnh');	
									}else{
										obj.attr('title','Vui lòng chọn 1 hình ảnh');
										obj.addClass("error");
									}
									obj.on("change",function(){
										$(this).off('change').removeClass('error').attr('title','');
									});
									flag=false;
								}
								break;
								case "video":
								if(!isVideo(obj.val())){
									if(obj.hasClass("none")){
										obj.parent().find(".asimg").addClass('error').attr('title','Vui lòng chọn 1 video');	
									}else{
										obj.attr('title','Vui lòng chọn 1 video');
										obj.addClass("error");
									}
									obj.on("change",function(){
										$(this).off('change').removeClass('error').attr('title','');
									});
									flag=false;
								}
								break;
								case "audio":
								if(!isAudio(obj.val())){
									obj=obj.parent().find("input:text");
									obj.attr('title','Vui lòng chọn 1 audio');
									obj.addClass("error");
									obj.on("change",function(){
										$(this).off('change').removeClass('error').attr('title','');
									});
									flag=false;
								}
								break;
							}
						}
					}else{
						if(options[i].notnull==null || options[i].notnull){
							flag=false;
							if(obj.hasClass("none")){
								obj.parent().find(".asimg").addClass('error').attr('title','Vui lòng chọn 1 file');	
							}else{
								obj.attr('title','Vui lòng chọn 1 file');
								obj.addClass("error");
							}
							obj.on("change",function(){
								$(this).off('change').removeClass('error');
							});
						}
					}
				}
			}
		}
		if(!flag){
			var top=th.find('.error').eq(0).offset().top;

			var wtop=$(window);
			var wheight=wtop.height();
			wtop=wtop.scrollTop();
			if(top<wtop || top>wtop+wheight)
			$('html, body').animate({ scrollTop:  top-70}, 'slow');
		}

		if(flag && callback!=null){
			return callback();
		}
		return flag;
	});

}
