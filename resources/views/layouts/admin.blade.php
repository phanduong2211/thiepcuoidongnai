<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from thevectorlab.net/flatlab/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2015 03:42:50 GMT -->
<head>
    <noscript>
        <meta http-equiv="refresh" content="0; URL=<?php echo Asset('nojavascript.html') ?>" />
    </noscript>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <meta name="author" content="Lovadweb">
  

    <title>ACP - @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{Asset('public/admin')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{Asset('public/admin')}}/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{{Asset('public/admin')}}/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{Asset('public/admin')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{Asset('public/admin')}}/css/owl.carousel.css" type="text/css">

      <!--right slidebar-->
      <link href="{{Asset('public/admin')}}/css/slidebars.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="{{Asset('public/admin')}}/css/style.css" rel="stylesheet">
    <link href="{{Asset('public/admin')}}/css/style-responsive.css" rel="stylesheet" />

    @yield('css')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="{{Asset('public/admin')}}/js/html5shiv.js"></script>
      <script src="{{Asset('public/admin')}}/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!--header start-->
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="{{Asset('')}}" class="logo">HOME<span>PAGE</span></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="badge bg-success"><img style="width:10px" src="{{Asset('public/admin/img/ajax-loader.gif')}}" /></span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">Đang tải...</p>
                            </li>
                           <!--  <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">Dashboard v1.3</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            -->
                            <li class="external">
                                <a href="{{Asset('admin/order')}}">Xem tất cả</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-important"><img style="width:10px" src="{{Asset('public/admin/img/ajax-loader.gif')}}" /></span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-red"></div>
                            <li>
                                <p class="red">Đang tải...</p>
                            </li>
                         
                            <li>
                                <a href="{{Asset('admin/contact')}}">Xem tất cả</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="fa fa-user"></i>
                            <span class="badge bg-warning"><img style="width:10px" src="{{Asset('public/admin/img/ajax-loader.gif')}}" /></span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-yellow"></div>
                            <li>
                                <p class="yellow">Đang tải...</p>
                            </li>
                            <!-- <li>
                                <a href="#">
                                    <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                    Server #3 overloaded.
                                    <span class="small italic">34 mins</span>
                                </a>
                            </li> -->
                          
                            <li>
                                <a href="{{Asset('admin/user')}}">Xem tất cả</a>
                            </li>
                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
                
            </div>
            <div id="note" class="pull-left clearfix">
              <div class="pull-left">
                <i class="fa fa-bullhorn"></i>
              </div>
                <div id="ctnote">
                  <marquee width="450" onmouseover="this.stop()" onmouseout="this.start()"></marquee>
                </div> 
             </div>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">

                    <?php $leveluser=Session::get('logininfo')->level; ?>
                   
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            
                            <span class="username">{{Session::get('logininfo')->name}}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="{{Asset('admin/info')}}"><i class=" fa fa-suitcase"></i>Thông Tin</a></li>
                            <li><a href="{{Asset('admin/info/change-pass')}}"><i class="fa fa-edit"></i> Đổi Mật Khẩu</a></li>
                            <li><a href="#"><i class="fa fa-exclamation-triangle"></i> Quyền hạn</a></li>
                            <li><a href="{{Asset('admin/logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                   
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a href="{{Asset('admin')}}">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-qrcode"></i>
                          <span>Sản Phẩm</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="{{Asset('admin/product')}}">Danh Sách Sản Phẩm</a></li>
                          <li><a  href="{{Asset('admin/product/add')}}">Thêm Sản Phẩm</a></li>
                          <li><a  href="{{Asset('admin/category')}}">Loại Sản Phẩm</a></li>
                          <li><a  href="{{Asset('admin/tab')}}">Tab</a></li>
                          <li><a  href="{{Asset('admin/product/recyclebin')}}">Thùng Rác</a></li>
                      </ul>
                  </li>

                  <!-- <li>
                      <a href="{{Asset('admin/order')}}">
                          <i class="fa fa-shopping-cart"></i>
                          <span>Đơn Hàng</span>
                      </a>
                  </li> -->

                  <li>
                      <a href="{{Asset('admin/slide')}}">
                          <i class="fa fa-picture-o"></i>
                          <span>SlideShow</span>
                      </a>
                  </li>

                  <?php if($leveluser!=3){ ?>
                      <li class="sub-menu">
                          <a href="javascript:;" >
                              <i class="fa fa-windows"></i>
                              <span>Website</span>
                          </a>
                          <ul class="sub">
                              <li><a  href="{{Asset('admin/website/menu')}}">Menu</a></li>
                              <li><a  href="{{Asset('admin/website/info')}}">Thông Tin Website</a></li>
                              <li><a  href="{{Asset('admin/page')}}">Trang</a></li>
                              <li><a  href="{{Asset('admin/page/add')}}">Tạo Trang</a></li>
                              <!-- <li><a  href="{{Asset('admin/website/note')}}">Thông Báo</a></li> -->
                          </ul>
                      </li>
                  <?php } ?>

                  <!-- <li class="sub-menu" id="menuitemtt">
                      <a href="javascript:;" >
                         <i class="fa fa-list-alt"></i>
                          <span>Tin Tức</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="{{Asset('admin/news')}}">Danh Sách Tin Tức</a></li>
                          <li><a  href="{{Asset('admin/news/add')}}">Thêm Mới Tin Tức</a></li>
                          <li><a  href="{{Asset('admin/news/category')}}">Loại Tin Tức</a></li>
                        
                      </ul>
                  </li> -->

                  <?php if($leveluser!=3){ ?>
                    <?php if($leveluser!=2){ ?>
                      <li>
                          <a href="{{Asset('admin/ad')}}">
                              <i class="fa  fa-sitemap"></i>
                              <span>Quản Trị Viên</span>
                          </a>
                      </li>
                    <?php } ?>

                  <!-- <li id="menuitemnd">
                      <a href="{{Asset('admin/user')}}">
                          <i class="fa fa-users"></i>
                          <span>Người Dùng</span>
                      </a>
                  </li> -->

                  <li id="menuitemqc">
                      <a href="{{Asset('admin/ads')}}">
                          <i class="fa fa-bullhorn"></i>
                          <span>Quảng Cáo</span>
                      </a>
                  </li>

                  <?php } ?>

                  <li id="menuitemlh">
                      <a href="{{Asset('admin/contact')}}">
                          <i class=" fa fa-envelope"></i>
                          <span>Liên Hệ</span>
                      </a>
                  </li>


                  <!--multi level menu end-->

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
            	@yield('content')
          </section>
      </section>
      <!--main content end-->

      <!--footer start-->
      <!-- <footer class="site-footer">
          <div class="text-center">
              2013 &copy; FlatLab by VectorLab.
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer> -->
      <!--footer end-->
  </section>

    <div class="modal fade" id="confirmbox" role="dialog">
         <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
             
              <h4 class="modal-title">Thông Báo</h4>
        </div>
        <div class="modal-body">
            <p id="confirmMessage">Any confirmation message?</p>
        </div>
        <div class="modal-footer">
            <button class="btn" id="confirmFalse">Cancel</button>
            <button class="btn btn-primary" id="confirmTrue">OK</button>
        </div>
        </div>
        </div>
    </div>

    <div id="ajaxloader" style="display:none;position:fixed;top:20px;left:45%;z-index:9999;box-shadow:0px 0px 3px #ff6c60;border-radius:3px;background-color:#ff6c60;width:100px;padding:10px 0px;opacity:0.8;color:white;text-align:center">
        <img src="{{Asset('public/admin/img/ajax-loader.gif')}}" />
        <div style="height:5px"></div>Đang Xử Lý
    </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{Asset('public/admin')}}/js/jquery.js"></script>
    <script src="{{Asset('public/admin')}}/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="{{Asset('public/admin')}}/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="{{Asset('public/admin')}}/js/jquery.scrollTo.min.js"></script>
    <script src="{{Asset('public/admin')}}/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="{{Asset('public/admin')}}/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="{{Asset('public/admin')}}/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="{{Asset('public/admin')}}/js/owl.carousel.js" ></script>
    <script src="{{Asset('public/admin')}}/js/jquery.customSelect.min.js" ></script>
    <script src="{{Asset('public/admin')}}/js/respond.min.js" ></script>
    <script type="text/javascript">
    
      function RunJson(url,dt,callback,disload) {
            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data:dt,
                beforeSend: function(){
                  if(disload==null)
                  $("#ajaxloader").show();
                },
                success: function(data){
                    if(disload==null)
                  $("#ajaxloader").hide();
                  callback(data);
                },
                error: function (e, e2, e3) {
                    if(disload==null)
                   $("#ajaxloader").hide();
                }
            });
        }
    </script>
    @yield('script')
    <!--right slidebar-->
    <script src="{{Asset('public/admin')}}/js/slidebars.min.js"></script>

    <!--common script for all pages-->
    <script src="{{Asset('public/admin')}}/js/common-scripts.js"></script>

    <!--script for this page-->

  
   

  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true

          });
      });

      //custom select box



          function getTimeInDate(date){
            var time=date.split(' ');

            var time=time[1].split(':');
            return time[0]+":"+time[1];
          }

      function getConfirm(confirmMessage,callback){
            confirmMessage = confirmMessage || '';

            $('#confirmbox').modal({show:true,
                                    backdrop:false,
                                    keyboard: false,
            });

            $('#confirmMessage').html(confirmMessage);
            $('#confirmFalse').on('click',function(){
                $('#confirmbox').modal('hide');
                $(this).off('click');
                 $('#confirmTrue').off('click');
                if (callback) callback(false);

            });
            $('#confirmTrue').on('click',function(){
                $('#confirmbox').modal('hide');
                 $(this).off('click');
                 $('#confirmFalse').off('click');
                if (callback) callback(true);
            });
        }  

        var leveluser="{{$leveluser}}";
      $(function(){

            $("#searchtable .buttonsearch").click(function(){
                var key=$(this).parent().find(".textboxsearch").val();
                if(key.trim()!=""){
                    var table=$(".table-responsive .table tr");
                    var size=table.size();
                        if(size==1)
                            return false;
                    key=key.toLowerCase();
                    for (var i = 1; i < size; i++) {
                        table.eq(i).hide().find("td").each(function(){
                            if($(this).text().trim().toLowerCase().indexOf(key)!=-1){
                                $(this).parent().show();
                            }
                        });
                    }
                }else{
                    $(".table-responsive .table tr").show();
                }
            });


            $("#searchtable .textboxsearch").keyup(function(e){
                if($(this).val()==""){
                    $(".table-responsive .table tr").show();
                }else{
                    if(e.keyCode==13){
                        $("#searchtable .buttonsearch").click();
                    }
                }
            });

            $(".dropdown-menu.logout li:eq(2) a").click(function(){
                switch(leveluser){
                    case '1':
                        alert('Bạn là Administrator.');
                        break;
                    case '2':
                        alert('Bạn là Moderator.');
                        break;
                    case '3':
                        alert('Bạn là Nhân Viên.');
                        break;
                }
                return false;
            });

            $(".sfilter").change(function(){
                var thf=$(this);
                if(!thf.hasClass("noautosubmit")){
                    thf.parent().submit();
                }else{
                    if(thf.attr("name")=="s"){
                        var table=$(".table-responsive .table tr");
                        var size=table.size();
                        if(size==1)
                            return false;
                        var s=thf.find(":selected").attr("data-sort")=="asc";
                        var c=thf.find(":selected").attr("data-column");
                        if(c=="-1"){
                            for (var i = 1; i < size; i++) {
                                for (var j = i+1; j < size; j++) {
                                    if(s){
                                        if(parseInt(table.eq(i).attr("data-column"))>parseInt(table.eq(j).attr("data-column"))){
                                            table.eq(i).before(table.eq(j));
                                        }
                                    }else{
                                        if(parseInt(table.eq(i).attr("data-column"))<parseInt(table.eq(j).attr("data-column"))){
                                            table.eq(i).before(table.eq(j));
                                        }
                                    }
                                }    
                            }
                        }else{
                            for (var i = 1; i < size; i++) {
                                for (var j = i+1; j < size; j++) {
                                    if(s){
                                        if(table.eq(i).find("td:eq("+c+")").text().trim().localeCompare(table.eq(j).find("td:eq("+c+")").text().trim())==1){
                                            table.eq(i).before(table.eq(j));
                                        }
                                    }else{
                                        if(table.eq(i).find("td:eq("+c+")").text().trim().localeCompare(table.eq(j).find("td:eq("+c+")").text().trim())==-1){
                                            table.eq(i).before(table.eq(j));
                                        }
                                    }
                                }    
                            }
                        }
                    }else{
                        if(thf.attr("name")=="f"){
                            var table=$(".table-responsive .table tr");
                            var size=table.size();
                            if(size==1)
                                return false;
                            var c=thf.find(":selected").attr("data-column");
                            var k=thf.find(":selected").attr("data-key");
                            table.show();
                            if(k==""){
                                return false;
                            }else{

                                for (var i = 1; i < size; i++) {
                                    var key=(c=="-1")?table.eq(i).attr("data-key"):table.eq(i).find("td:eq("+c+")").text().trim().toLowerCase();
                                    
                                    if(key!=k){
                                        table.eq(i).hide();
                                    }
                                }
                            }
                        }
                    }
                }
            });
            var sort="<?php if(isset($_GET['s'])) echo $_GET['s']; else echo '0' ?>";

            $("select[name='s']").val(sort);

            var filter="<?php if(isset($_GET['f'])) echo $_GET['f']; else echo '0' ?>";

            $("select[name='f']").val(filter);
          $('select.styled').customSelect();

          $(".table").on('submit','form.remove',function(){
            if($(this).attr("nocomfirm")){
                return true;
            }
            var msg="Bạn có chắc muốn xóa?";
            if($(this).attr('msg')){
                msg=$(this).attr('msg');
            }

            if(!$(this).hasClass("submitform")){
                var thhhs=$(this);
                getConfirm(msg,function(result) {
                    if(result){
                        if(!thhhs.attr("dataitem")){
                            thhhs.addClass("submitform");
                            thhhs.submit();
                        }else{
                           
                            var dataremove=jQuery.parseJSON(thhhs.attr("dataitem"));
                            thhhs=thhhs.parents("tr");
                            thhhs.addClass("noaction");
                            RunJson(dataremove.url,{"id":dataremove.id,"title":dataremove.title,"_token":__datatoken,"json":1},function(result){
                                if(result.result==1){
                                    thhhs.fadeOut();
                                }else{
                                      thhhs.removeClass("noaction");
                                     
                                }
                                if(result.message!=null){
                                     alert(result.message);
                                }
                            });
                        }
                    }
                });
                return false;
            }
            else
                return true;
          });


          $(".hidemessage .fa").click(function(){
            $(this).parent().fadeOut();
          });

          $(".btn-reset").click(function(){
            window.location.reload();
          });
          var _baseurl="{{Asset('admin')}}";
           $(window).load(function(){
               RunJson(_baseurl+"/ajax/count",{'_token':'{{csrf_token()}}'},function(result){
                    var p=$("#top_menu .nav>li");
                    var p1=p.eq(1);
                    p1.find(".badge").html(result.contact.length);
                    if(result.contact.length>0){
                      
                       p1.find("ul li:eq(0) .red").html("Có "+result.contact.length+" liên hệ mới");
                        p1=p1.find("ul li:eq(0)");

                        for(var i=0;i<result.contact.length;i++){
                            var item=result.contact[i];
                            p1.after("<li><a href='"+_baseurl+"/contact?id="+item.id+"'><span class='subject'><span class='from'>"+item.email+"</span><span class='time'>"+getTimeInDate(item.created_at)+"</span></span><span class='message'>"+item.content.substr(0,70)+"...</span></a></li>");
                        }
                    }else{
                      p1.find("ul li:eq(0) .red").html("Không có liên hệ mới");
                    }

                    var p1=p.eq(2);
                    p1.find(".badge").html(result.user.length);
                    if(result.user.length>0){

                       p1.find("ul li:eq(0) .yellow").html("Có "+result.user.length+" người dùng mới");
                        p1=p1.find("ul li:eq(0)");

                        for(var i=0;i<result.user.length;i++){
                            var item=result.user[i];
                            p1.after(' <li><a href="'+_baseurl+'/user?id='+item.id+'"> <span class="label label-danger"><i class="fa fa-'+(item.sex==1?'male':'female')+'"></i></span> '+item.name+' <span class="small italic pull-right">'+getTimeInDate(item.created_at)+'</span></a></li>');

                        }
                    }else{
                      p1.find("ul li:eq(0) .yellow").html("Không có người dùng mới");
                    }

                    var p1=p.eq(0);
                    p1.find(".badge").html(result.order.length);
                    if(result.order.length>0){

                       p1.find("ul li:eq(0) .green").html("Có "+result.order.length+" đơn hàng chưa giao");
                        p1=p1.find("ul li:eq(0)");

                        for(var i=0;i<result.order.length;i++){
                            var item=result.order[i];
                            var name=item.address.match(/(\"name\")(.*?)(:\")*([a-zA-Z0-9 ]*)\";/i);
                            name=name[0].toString();
                            name=name.substr(0,name.length-2);
                            name=name.replace(/\"name\";s:[0-9]*:\"/ig,"");
                          
                            p1.after(' <li><a href="'+_baseurl+'/order?id='+item.id+'"> <span class="label label-danger"><i class="fa fa-plus"></i></span> '+name+' <span class="small italic pull-right">'+getTimeInDate(item.created_at)+'</span></a></li>');

                        }
                    }else{
                      p1.find("ul li:eq(0) .green").html("Không có đơn hàng chưa giao");
                    }

                    if(result.note.contents!=null){
                      var note=result.note.contents;
                      note=note.replace(/\n/ig,'|');
                      note=note.replace(/\|/ig," <span style='padding:0px 10px'><i class='fa fa-star'></i></span> ");
                      $("#note marquee").html(note);
                      $("#note").css("padding-bottom","1px");
                    }

               },true);
            });
      });



  </script>

  </body>

<!-- Mirrored from thevectorlab.net/flatlab/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Aug 2015 03:43:32 GMT -->
</html>
