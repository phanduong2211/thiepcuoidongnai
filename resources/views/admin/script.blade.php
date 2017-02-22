<script type="text/javascript">
        var dataitem=null;
    var __datatoken="{{csrf_token()}}";

function callBackModal(){
        if(dataitem!=null){
            var data={};
            $("#modaldialog").find("form .form-control").each(function(){
               data[$(this).attr("name")]=$(this).val().trim();
            });

            data['_token']=__datatoken;
            data['json']=true;

            if(dataitem.action=="edit")
                data['idedit']=dataitem.id;


            $('#modaldialog #savemodal').attr("disabled","disabled");
            $("#modaldialog").find("p.text-center").html("Đang thực hiện...");
            RunJson(dataitem.url,data,function(result){
                $("#modaldialog").find("p.text-center").html(result.message).fadeOut(10000);
                $('#modaldialog #savemodal').removeAttr("disabled");
                if(result.result==1){
                    $("#modaldialog").find("form .form-control").each(function(){
                        if(this.nodeName=="SELECT"){
                            this.value="-1";   
                        }else{
                            if(this.type!="password" && this.type!="hidden")
                                this.value="";
                            else
                                this.value=this.defaultValue;
                        }
                    });
                    if(dataitem.action=="addnew")
                        callBackSuccessModal(result.data);
                    else
                         callBackSuccessModal(data);
                }
            });
        }
    }

    $(function(){
    	$('#modaldialog').on('shown.bs.modal', function(e) {
                var modal=$(this);
                dataitem=jQuery.parseJSON(e.relatedTarget.attributes.dataitem.nodeValue);
                modal.find(".modal-title").html(dataitem.title);
                
                if(dataitem.action=="edit"){
                    var obj=modal.find("form");
                    for(var item in dataitem.value) {
                        obj.find("[name='"+item+"']").val(dataitem.value[item]);
                    }
                }else{
                    $("#modaldialog").find("form .form-control").each(function(){
                       
                        if(this.nodeName=="SELECT"){
                            this.value="-1";   
                        }else{
                            if(this.type!="password" && this.type!="hidden")
                                this.value="";
                            else
                                this.value=this.defaultValue;
                        }
                    });
                }
            });

            $('#modaldialog #savemodal').click(function(){
                if(!$(this).attr("disabled")){
                    $(this).parents(".modal-content").find("form").submit();
                }
            });
    });

    </script>