<?php /* EL PSY CONGROO */      	  	 	
require '../../../zb_system/function/c_system_base.php';         			
require '../../../zb_system/function/c_system_admin.php';      	 		 	
$zbp->Load();           	
$action='root';    		   	 	
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}     				 		
if (!$zbp->CheckPlugin('xc_report')) {$zbp->ShowError(48);die();}    	    			
    						 	
$act = isset($_GET['act']) ? $_GET['act'] : 'setup';       	   	
      			   
if (count($_POST) > 0) {     		   	 
	CheckIsRefererValid();    	 			 		
}      				  
$blogtitle='文章举报插件';     	  	 	 
require $blogpath . 'zb_system/admin/admin_header.php';    	    	 	
require $blogpath . 'zb_system/admin/admin_top.php';     	 				 
require_once 'function/main.php';    		 	 		 
       					
?>
<style>
	table{
		width:100%;
	}
	
</style>
<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu"><?php xc_report_main_nav($act);?></div>
	<div id="divMain2">
	<!------------------------------------------->
	<?php if($act == 'setup'){ 
		if(count($_POST)){      		 	  
			foreach ($_POST as $key => $value) {    	 	 				
				$zbp->Config('xc_report')->$key = $value;    		  				
			}     	 	 			
			$zbp->SaveConfig('xc_report');     		    	
			$zbp->ShowHint('good');      	  		 
			xc_report_customCss();    		 	 			
		}      				  
	?>
	<form action="" method="post">
	<input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken();?>">
		<table>
			<tr>
				<td colspan="3">基本设置</td>
			</tr>
			<tr>
				<td style="width: 200px;">举报选项</td>
				<td>
					<textarea name="option" style="width:100%;height: 50px;" ><?php echo $zbp->Config('xc_report')->option;?></textarea>
				</td>
				<td>多个选项用“|”分割</td>
			</tr>
			<tr>
				<td>选项选择方式</td>
				<td>
					<select name="optionType" style="width: 150px;" >
						<?php xc_report_status($zbp->Config('xc_report')->optionType);?>
					</select>
				</td>
				<td>
					选择选项方式！
				</td>
			</tr>
			<tr>
				<td>必填项</td>
				<td>
					备注：<input type="text" class="checkbox" name="is_Remarks" value="<?php echo $zbp->Config('xc_report')->is_Remarks;?>">&nbsp;&nbsp;&nbsp;&nbsp;
					联系方式：<input type="text" class="checkbox" name="is_Contact" value="<?php echo $zbp->Config('xc_report')->is_Contact;?>">
				</td>
				<td>
					开启后则必填！
				</td>
			</tr>
			<tr>
				<td>联系方式填写类型</td>
				<td>
					<select name="Contact_Type" id="">
						<?php xc_report_ContactType($zbp->Config('xc_report')->Contact_Type);?>
					</select>
				</td>
				<td>
					<p>选择联系方式的填写类型，不同的类型会有不同的验证逻辑！</p>
				</td>
			</tr>
			<tr>
				<td>联系方式输入框提示</td>
				<td>
					<input type="text" style="width: 90%;" name="Contact_tip" value="<?php echo $zbp->Config('xc_report')->Contact_tip;?>">
				</td>
				<td>
					<p>联系方式输入框中的提示！</p>
					<p>不自定义的情况下，会根据联系方式类型自动显示不同的内容！</p>
				</td>
			</tr>
			<tr>
				<td>备注输入框提示</td>
				<td>
					<input type="text" style="width: 90%;" name="Remarks_tip" value="<?php echo $zbp->Config('xc_report')->Remarks_tip;?>">
				</td>
				<td>
					<p>联系方式输入框中的提示！</p>
					<p>不自定义的情况下，会根据联系方式类型自动显示不同的内容！</p>
				</td>
			</tr>
			<tr>
				<td>登录举报</td>
				<td>
					<p>是否登录后可举报：<input type="text" class="checkbox" name="is_login" value="<?php echo $zbp->Config('xc_report')->is_login;?>"></p>
					<p>登录链接：<input type="text" style="width:calc(100% - 80px)" name="url_login" value="<?php echo $zbp->Config('xc_report')->url_login;?>"></p>
					<p>注册链接：<input type="text" style="width:calc(100% - 80px)"  name="url_reg" value="<?php echo $zbp->Config('xc_report')->url_reg;?>"></p>
				</td>
				<td>
					<p>可配合登录类插件使用</p>
					<p>推荐：<a href="https://app.zblogcn.com/?id=1712" style="margin-right: 10px;" target="_blank">用户中心</a><a href="https://app.zblogcn.com/?id=28828" target="_blank">登录插件</a></p>
				</td>
			</tr>
			<tr>
				<td>自动适配主题</td>
				<td>
					<input type="text" class="checkbox" name="is_theme" value="<?php echo $zbp->Config('xc_report')->is_theme;?>">
				</td>
				<td>
					开启后，会在文章页的文章内容底部加入一个举报按钮！
				</td>
			</tr>
			<tr>
				<td>按钮文字</td>
				<td>
					<input type="text"  name="but_txt" value="<?php echo $zbp->Config('xc_report')->but_txt;?>">
				</td>
				<td>如为空，则默认为"举报"！</td>
			</tr>
			<tr>
				<td>弹出窗口标题</td>
				<td>
					<input type="text"  name="alert_title_txt" value="<?php echo $zbp->Config('xc_report')->alert_title_txt;?>">
				</td>
				<td>如为空，则默认为“内容举报”！</td>
			</tr>
			<tr>
				<td>自定义CSS</td>
				<td>
					<textarea name="css" style="width:100%;height: 150px;"><?php echo $zbp->Config('xc_report')->css;?></textarea>
				</td>
				<td>自定义CSS样式代码</td>
			</tr>
			<tr>
				<td>开启验证码</td>
				<td>
					<input type="text" class="checkbox" name="vf_img" value="<?php echo $zbp->Config('xc_report')->vf_img;?>">
				</td>
				<td>开启后，会让用户输入验证码！</td>
			</tr>
			<?php if ($zbp->CheckPlugin('mochu_us')) { ?>
			<tr>
				<td>适配墨初用户中心</td>
				<td>
					<input type="text" class="checkbox" name="is_mochu_us" value="<?php echo $zbp->Config('xc_report')->is_mochu_us;?>">
				</td>
				<td>开启后，自动适配墨初用户中心！</td>
			</tr>
			<?php } ?>
		</table>
		<input type="submit" value="保存">
		<br>
	</form>
	<?php } ?>
	<!------------------------------------------->
	<?php if($act == 'list'){ ?>
		<link rel="stylesheet" href="style/style.css">
		<style>
			.buts_but{
				height: 30px;
				line-height: 30px;
				background-color: red;
				color: #fff !important;
				display: inline-block;
				padding: 0 15px;
				cursor: pointer;
			}
			.xc_report_main_alert{
				padding: 20px;
			}
			.xc_report_main_alert>div{
				line-height: 35px;
				border: 1px solid #f5f5f5;
				margin-bottom: 10px;
			}
			.xc_report_main_alert>div span{
				height: 35px;
				line-height: 35px;
				padding: 0 15px;
				background-color: #f5f5f5;
				display: inline-block;
				margin-right: 10px;
			}
			.xc_report_main_alert>div>div{
				padding: 10px;
			}
		</style>

		<form class="search" id="search" method="post" style="display: inline-block;" action="#">
			<p>状态：&nbsp;&nbsp;
			<select name="status" >
				<option value="0">文章ID</option>
				<option value="1">文章标题</option>
				<option value="2">IP地址</option>
				<option value="3">用户ID</option>
				<option value="4">用户账号</option>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;输入搜索内容：
			<input type="text" name="search" style="width: 250px;" >
			<input type="submit" class="button" value="查询" style=" width: 100px;"/>
			</p>
		</form> 
		<div>
			<a href="javascript::;"  onclick="if(confirm('您确定要进行清空操作吗？')){location.href='save.php?act=del_all_log'}" class="buts_but">清空所有记录</a>
		</div>
		<?php
      		 	 	
			$p = new Pagebar('{%host%}zb_users/plugin/xc_report/main.php?act=list{&page=%page%}{&status=%status%}{&search=%search%}', false);     		  		 
			$p->PageCount = $zbp->managecount;    			 			 
			$p->PageNow = (int) GetVars('page', 'GET') == 0 ? 1 : (int) GetVars('page', 'GET');    	 				 	
			if (GetVars('search') !== GetVars('search', 'GET')) {       	 		 
				$p->PageNow = 1;    	   	   
			}      		  	 
			$p->PageBarCount = $zbp->pagebarcount;    				   	
			$p->UrlRule->Rules['{%search%}'] = GetVars('search');    	   			 
			$p->UrlRule->Rules['{%status%}'] = GetVars('status');     			 	  
			$l = array(($p->PageNow - 1) * $p->PageCount, $p->PageCount);    		 					
			$op = array('pagebar' => $p);    	 		  	 
			$w = array();     	 	   	
    		 	    
    	 						
			if(GetVars('search') != ''){    	 	 	 	 
				    							 
				if((int)GetVars('status') ==  0){    					 	 
					$w[] = array('=','c_Aid',GetVars('search'));    			  	 	
				}    		 		   
    		 			  
				if((int)GetVars('status') ==  1){     				 		
					$article = $zbp->GetSomeThing($zbp->GetCache('Post'), 'Title', GetVars('search'), 'Post');    						 	
					if($article->ID > 0){       	 		 
						$w[] = array('=','c_Aid',$article->ID);      	   		
					}     			 	 	
				}    	 						
        			 
				if((int)GetVars('status') ==  2){      			 	 
					$w[] = array('=','c_IP',GetVars('search'));    		 	  		
				}       	 	 	
    		 				 
				if((int)GetVars('status') ==  3){        	  	
					$w[] = array('=','c_Uid',GetVars('search'));      		  	 
				}     		 	  	
    	 		 			
				if((int)GetVars('status') ==  4){    				  		
					$mem = $zbp->GetMemberByName(GetVars('search'));      	 	 		
					$w[] = array('=','c_Uid',$mem->ID);    	   	 		
				}    	   		 	
				    		 	  		
			}      		 	 	
    	  		 	 
			$list = new xc_report_list();     	 	 	 	
			$array = $list->GetByList($w,$l,$op);    	       
		      			 	 
		?>

    <table style="width:100%;">
        <tr>
            <td style="width: 60px;">ID</td>
			<td style="width: 120px;">用户</td>
			<td>文章</td>
            <td style="width: 120px;">举报类型</td>
			<td>备注：</td>
            <td style="width: 140px;">联系方式</td>
			<td style="width: 140px;">举报时间</td>
			<td style="width: 140px;">IP</td>
			<td style="width: 120px;">操作</td>
        </tr>
        <?php
            if(count($array)){     		 	  	
                foreach ($array as $key => $a) {     	     	
                    echo '<tr>';      	 		 	
                    echo '<td>'.$a->ID.'</td>';    				   	
					echo '<td>'.$a->Mem->Name.'</td>';         	  
					echo '<td>'.$a->article.'</td>';     		   		
                    echo '<td>'.$a->Option.'</td>';    	 	  			
					echo '<td>'.$a->Remarks.'</td>';     	   	 	
					echo '<td>'.$a->Contact.'</td>';    	  	    
                    echo '<td>'.($a->Time ? date('m-d H:i:s',$a->Time) : '').'</td>';      		  		
					echo '<td>'.$a->IP.'</td>';     	     	
                    echo '<td>'.$a->Caozuo.'</td>';    	 	    	
                    echo '</tr>';    		   	  
                }    		  		 	
            }    		 	 			
        ?>
    </table>
    <?php
        echo '<hr/><p class="pagebar">';      				 	
        foreach ($p->Buttons as $key => $value) {      	 			 
            if ($p->PageNow == $key) {       	    
                echo '<span class="now-page">' . $key . '</span>&nbsp;&nbsp;';     	  		  
            } else {     		 	  	
                echo '<a href="' . $value . '">' . $key . '</a>&nbsp;&nbsp;';     	  		 	
            }    	 	 	   
        }    		 	 		 
        echo '</p>';
    ?>      



	<script src="script/script.js"></script>
	<script>
		window.see_log = function(id)
		{
			var index = xc_report.msg('loading...',{icon: 16,time:false,shade:0.01});
			$.ajax({
				type: "POST",
				url: "save.php?act=see_log",
				data: {'id':id},
				dataType: "json",
				success: function (res) {
					xc_report.close(index);
					if(res.code == 0){
						xc_report.open({
							title: ['详细记录'],
							type: 1,
							area: ['650px', 'auto'], //宽高
							content: res.html,
						});
					}else{
						xc_report.msg(res.msg,{icon:0})
					}
				},
				error:function(){xc_report.alert('出现错误！');}
			});
		}



	</script>
	
	
	
	<?php } ?>

	<!--------------------------------------------------------->
	<?php if($act == 'email'){ 
		if(count($_POST)){    	  			  
			foreach ($_POST as $key => $value) {       	 	 	
				$zbp->Config('xc_report')->$key = $value;    		 	 	  
			}    	 	   	 
			$zbp->SaveConfig('xc_report');    	   	  	
			$zbp->ShowHint('good');    			  	 	
		}    	  		 		
	?>
		<form action="" method="post">
		<input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken();?>">
			<table>
				<tr>
					<td class="main_title_td" colspan="3">本地邮箱配置:</td>
				</tr>
				<tr>
					<td style="width: 200px;">SMTP服务器地址：</td>
					<td><input type="text" name="mail_smtp" value="<?php echo $zbp->Config('xc_report')->mail_smtp;?>"></td>
					<td>输入邮箱的SMTP地址，比如:smtp.qq.com或smtp.126.com</td>
				</tr>
				<tr>
					<td>邮箱用户名：</td>
					<td><input type="text" name="mail_name" value="<?php echo $zbp->Config('xc_report')->mail_name;?>"></td>
					<td>输入你的邮箱地址，比如：xiaochan@126.com</td>
				</tr>
				<tr>
					<td>邮箱授权码：</td>
					<td><input type="text" name="mail_pass" value="<?php echo $zbp->Config('xc_report')->mail_pass;?>"></td>
					<td>是授权码，而不是邮箱密码！</td>
				</tr>
				<tr>
					<td>ssl端口号：</td>
					<td><input type="text" name="mail_port" value="<?php echo $zbp->Config('xc_report')->mail_port;?>"></td>
					<td>这里是SSL协议的端口号</td>
				</tr>
				<tr>
					<td>邮箱状态：</td>
					<td colspan="2"><?php echo $zbp->Config('xc_report')->mail_statu;?></td>
				</tr>
				<tr>
					<td colspan="3">阿里邮件推送SSL:465 , 网易：994或465 , QQ:465或587</td>
				</tr>
			</table>
			<table>
				<tr><td colspan="3" class="main_title_td">其它设置</td></tr>
				<tr>
					<td style="width: 200px;">管理员邮箱地址</td>
					<td><input type="text" name="admin_emails"  value="<?php echo $zbp->Config('xc_report')->admin_emails;?>"></td>
					<td>输入管理员的邮箱地址，如果有新的举报信息，会邮件通知管理员！</td>
				</tr>
				<tr>
					<td style="width: 200px;">启用邮箱通知功能</td>
					<td><input type="text" name="on_email_vf" class="checkbox" value="<?php echo $zbp->Config('xc_report')->on_email_vf;?>"></td>
					<td>如果不启用此功能，则用户可随意修改自己的邮箱地址，并不确保地址的真实性！</td>
				</tr>
			</table>
			<input type="submit" value="保存">
		</form>
		<form action="save.php?act=vfemails" method="post">
			<table>
				<tr>
					<td style="width:120px;">输入邮箱地址：</td>
					<td style="width:200px;"><input type="email" name="email" /></td>
					<td>
						<input type="submit" value="提交并验证邮箱配置">
					</td>
				</tr>
			</table>

		</form>
	<?php } ?>
	<!--------------------------------------------------------->
	<?php if($act == 'help'){ ?>
	<div style="padding: 2px 10px 10px 10px; background-color: #f9f9f9;">
		<h2>使用帮助</h2>
		<p style="margin-bottom: 20px;">主题开发者可以通过以下的代码，来调用投诉的弹窗！</p>
		<textarea style="width: 505px; height: 40px; padding: 10px; font-size: 12px;"><span onclick="xc_report_reportbut(文章ID)">举报</span></textarea>
	</div>
	
	
	<?php } ?>

	</div>
</div>



<?php
require $blogpath . 'zb_system/admin/admin_footer.php';       			  
RunTime();          	 
?>