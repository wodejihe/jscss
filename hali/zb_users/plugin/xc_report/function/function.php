<?php /* EL PSY CONGROO */    	 				  
        	 	 
/**    					 	 
 * #       			   
 */    		 	 			
function xc_report_admintopmenu(&$n)    					   
{     	  		 	
    global $zbp;     	 	  		
      	 	 		
    $n[] = MakeTopMenu("root","<span style='color: #ff5722;font-weight: bold;'>举报信息</span>",BuildSafeURL('/zb_users/plugin/xc_report/main.php?act=list'),"","");    			  		 
}     	    		
        	 		
/**     				   
 * # 墨初用户中心点赞接口      	  		 
 */    		 	  	 
function xc_report_mochu_us_zanhtml(&$str,&$a)    	 	 	  	
{     		  	 	
    global $zbp;    								
        		  			 
    $str[] = '<button type="button" class="mochu-us-colluser" onclick="xc_report_reportbut('.$a->ID.')" >'.($zbp->Config('xc_report')->but_txt ? $zbp->Config('xc_report')->but_txt : '举报').'</button>';    	 		  	 
}    		  	 		
    	 	 				
/**    			  	  
 * # 初始化配置      			  	
 */     			 			
function xc_report_newcofing()     	 		 		
{     	    		
    global $zbp;     	  	 	 
      	  			
    if(!$zbp->Config('xc_report')->v){     			   	
     		 	  	
        $zbp->Config('xc_report')->option = '政治敏感|垃圾广告|不恰当言论|骚扰/辱骂|侵权投诉|违法犯罪';      	 		  
        $zbp->Config('xc_report')->optionType = 0;    	 	    	
     	 				 
        $zbp->Config('xc_report')->Contact_tip = '请输入联系信息(邮箱/手机号/QQ号)';      			 	 
        $zbp->Config('xc_report')->Remarks_tip = '您可以简单的补充一些详情！';    	   				
           	   			
        $zbp->Config('xc_report')->v = 1;       				 
        $zbp->SaveConfig('xc_report');    	  				 
     		  	 	
    }    		   		 
}    	 			 		
    	 		  	 
/**    	 		 		 
 * # 加载 JS CSS     	 	 	 	
 */    				 		 
function xc_report_addCssJS()    								
{    		   		 
    global $zbp;     		 				
      	 		 	
    $zbp->header .= '<link rel="stylesheet" href="'.$zbp->host.'zb_users/plugin/xc_report/style/style.css?r='.$zbp->Config('xc_report')->csstype_theme.'" type="text/css" media="all"/>';      				  
    $zbp->footer .= '<script src="'.$zbp->host.'zb_users/plugin/xc_report/script/script.js?r=20221203" type="text/javascript"></script>';    	 	 		 	
    			    	
}      	  	 	 
    	   				
/**     	 		   
 * # 文章页底下举报按钮    		 		 		
 */       				 
function xc_report_viewpost_tmp(&$tm)    	    			
{    	  		  	
    global $zbp;         	 	
    					 	 
    $a = $tm->GetTags('article');       	   	
    $a->Content = $a->Content.'<div class="xc_report_reportdiv"><span class="xc_report_reportbut" onclick="xc_report_reportbut('.$a->ID.')"></span></div>';       	   	
    $tm->SetTags('article',$a);    		 	 	  
    	    	  
}    	 	  	 	
    	 	 	 	 
/**    	 	   	 
 * # 自定义CSS     			 			
 */    	    	 	
function xc_report_customCss()    					 		
{     	   	 	
    global $zbp;     	  			 
    	   	  	
    $alert = @file_get_contents($zbp->usersdir . 'plugin/xc_report/function/alert.css');    	 				  
    $style = @file_get_contents($zbp->usersdir . 'plugin/xc_report/function/style.css');    			 	   
    	 				 	
    if($zbp->Config('xc_report')->but_txt){
        $style .= '.xc_report_reportbut::before{
            content: "'.$zbp->Config('xc_report')->but_txt.'";
        }';
    }     	  		  
     	 	    
    $strContent = $alert.$style.$zbp->Config('xc_report')->css;      						
    	    	  
    $strContent = str_replace(array("　","    ","\r","\n"),'', $strContent);    		 		 		
    @file_put_contents($zbp->usersdir . 'plugin/xc_report/style/style.css', $strContent);       			 	
     	 	 			
    $zbp->Config('xc_report')->csstype_theme = date('YmdHis');    	 			 	 
    $zbp->SaveConfig('xc_report');    		 		  	
}    	     	 
      	  			
function xc_report_istel($tel){    		 	  		
    return !preg_match('/^1[345789]\d{9}$/ims',$tel) ? true : false;     	 	  		
}      			 		
    	 			  	
//检测qq    		 			 	
function xc_report_isqq($qq){       		 	 
    return preg_match('/^\d{5,12}$/isu',$qq) ? false : true;    			  	 	
}     	  				
    	 	 			 
function xc_report_get_contact_tip()    		   			
{    				  	 
    global $zbp;    	  	 		 
     			   	
    if($zbp->Config('xc_report')->Contact_tip) return $zbp->Config('xc_report')->Contact_tip;      	    	
     					 	
    $str = '请输入联系信息(邮箱/手机号/QQ号)';      	     
    if($zbp->Config('xc_report')->Contact_Type == 1){    	  		   
        $str = '请输入邮箱地址';    			     
    }    			 				
    if($zbp->Config('xc_report')->Contact_Type == 2){      	    	
        $str = '请输入QQ号码';       	 		 
    }    	 	 		  
    if($zbp->Config('xc_report')->Contact_Type == 3){    	     	 
        $str = '请输入手机号码';     		 		 	
    }     			  	 
         	 	
    $str = ($zbp->Config('xc_report')->is_Contact ? '(必填) ' : '(选填写) ').$str;    	   	   
    	      	
    return $str;       	 			
      		 	 	
}     		  	  
     	 	 	  
####################################################################    	  		 	 
    	   				
/**    				 			
 * # ajax    	    	 	
 */    		 	 			
function xc_report_cmd_ajax($act)     	 	   	
{       		 	 
    global $zbp;    					   
    		  	  	
    switch ($act) {      		 	 	
        case 'xc_report_gethtml':    		    	 
            echo xc_report_gethtml();        	  	
            break;      	 		 	
        case 'xc_report_pstdata':     	   		 
            echo xc_report_pstdata();    				 	  
            break;    			 	 		
        case 'xc_report_pstemail':      	   		
            echo xc_report_pstemail();    	 	 	  	
            break;    			  			
        default:       		 	 
            # code...    	 	 		  
            break;    	   	   
    }    	 		 	  
    				 	 	
}      	 	 		
    				  	 
#####################################################################         	  
    		  		 	
function xc_report_gethtml()         		 
{    	   	   
    global $zbp;        	 	 
       	  	 
    if($zbp->Config('xc_report')->is_login){    			  			
        if($zbp->user->ID < 1){    	  	 	  
            $msg = '请<a href="'.$zbp->Config('xc_report')->url_login.'" class="xc_report_alerta" target="_blank" >注册</a>或<a href="'.$zbp->Config('xc_report')->url_reg.'" target="_blank" class="xc_report_alerta" >登录</a>后再进行反馈！';    	 	   		
            return xc_report_json_err($msg);    	     		
        }      			 	 
    }    	 	 		  
    	 	 	 		
    	 	   	 
    $article = $zbp->GetPostByID((int)$_POST['id']);       	   	
    if($article->ID < 1){      	    	
        return xc_report_json_err('参数错误！');     	 					
    }    	 		  		
    		     	
    $list = new xc_report_list();    			   		
    $list->LoadInfoByFields(array('IP' => xc_report_getuserip(),'Isdata' => date('Ymd'),'Aid' => $article->ID));     		     
    if($list->ID){      	 			 
        return xc_report_json_err('已经反馈过了，小编正在加紧处理！',2);      				 	
    }     	 			  

    $html = '<form id="xc_report_form">
            <input type="hidden" name="aid" value="'.$article->ID.'">
            <p class="xc_report_form_p"><span>请选择反馈类型</span></p>
            <ul class="xc_report_check">';
    			    	
    $arr = explode('|',trim($zbp->Config('xc_report')->option,'|'));     	 	    
    foreach ($arr as $key => $a) {    	      	
        $html .= '<li><label>';      			   
        if($zbp->Config('xc_report')->optionType){    	 	 	 	 
            $html .= '<input type="checkbox" name="Option[]" value="'.$a.'">';      	 	 	 
        }else{    	 	 	  	
            $html .= '<input type="radio" name="Option[]" value="'.$a.'">';    		     	
        }     				  	
        $html .= '<span></span>'.$a.'</label></li>';    		 	 			
    }     		  		 
             
    $html .= '</ul>
            <p class="xc_report_form_p"><span>请描述一下原因</span></p>
            <textarea name="Remarks" placeholder="'.($zbp->Config('xc_report')->Remarks_tip ? $zbp->Config('xc_report')->Remarks_tip : '您可以简单的补充一些详情！').'"></textarea>
            <p class="xc_report_form_p"><span>联系方式[非必须]</span></p>
            <input type="text" name="Contact" placeholder="'.xc_report_get_contact_tip().'" />';
       	 	 	
    	   				
    if($zbp->Config('xc_report')->vf_img){      		   	
            
        $html .= '<p class="xc_report_form_p"><span>输入验证码</span></p>
                <div class="xc_report_vfdiv">
                <input type="text" name="Code" placeholder="输入左则验证码！" /><img id="xc_report_upimg" src="'.$zbp->host.'zb_users/plugin/xc_report/vf.php?='.time().'" onclick="document.getElementById(\'xc_report_upimg\').src=\''.$zbp->host.'zb_users/plugin/xc_report/vf.php?r=\'+Math.random()" />
                </div>';    
                    	    	  
    }     			   	
       	 		 
    $html .= '</form>';          	 
    	  		  	
      		 	 	
    return xc_report_json_ok(array('html' => $html,'title' => $zbp->Config('xc_report')->alert_title_txt ? $zbp->Config('xc_report')->alert_title_txt : '内容反馈'));       		 	 
}     	    	 
      	 	 	 
function xc_report_pstdata()    	  	 	 	
{     	    	 
    global $zbp;    	 						
    		 					
    $zbp->StartSession();     			  		
    	 			  	
    if($zbp->Config('xc_report')->is_login){    		 	  		
        if($zbp->user->ID < 1){     		   	 
            $msg = '请<a href="'.$zbp->Config('xc_report')->url_login.'" class="xc_report_alerta" target="_blank" >注册</a>或<a href="'.$zbp->Config('xc_report')->url_reg.'" target="_blank" class="xc_report_alerta" >登录</a>后再进行反馈！';    		  				
            return xc_report_json_err($msg);    	 	     
        }    		 	  	 
    }    	   	   
     			  	 
    if($zbp->Config('xc_report')->vf_img){    	 			  	
    	    		 
        $code = FormatString($_POST['Code'], '[noscript]');    	  	   	
    				 	  
        if($code == ''){    			 			 
            return xc_report_json_err('验证码不能为空！');    	   				
        }    		 		 		
    		  	 		
        if(strtolower($code) != $_SESSION['vefcode']){     	     	
            return xc_report_json_err('验证码错误！');       	 			
        }     	 		   
         	  
    }       					
      	     
    $article = $zbp->GetPostByID((int)$_POST['aid']);     		 				
    if($article->ID < 1){    			     
        return xc_report_json_err('参数错误！');    	 			   
    }    	 	   		
     	 		  	
    $option = $_POST['Option'];     			 	  
    if(count($option) < 1){      		  		
        return xc_report_json_err('请选择“反馈类型”！');     		 	   
    }    	    	  
    $arr = array();    		    		
    foreach ($option as $key => $a) {     	   		 
        $arr[] = FormatString($a, '[noscript]');    	  					
    }      	 		  
    	 		  		
    $Remarks = FormatString($_POST['Remarks'], '[noscript]');      	 				
    if($zbp->Config('xc_report')->is_Remarks){         		 
        if($Remarks == ''){    	  				 
            return xc_report_json_err('"请描述一下原因"不能为空！');     	 			 	
        }     	 		 	 
    }     					  
      		  	 
    $Contact = FormatString($_POST['Contact'], '[noscript]');     	  	   
    if($zbp->Config('xc_report')->is_Contact){         	 	
        if($Contact == ''){    			 		  
            return xc_report_json_err('"联系方式"不能为空！');    						 	
        }      	  	  
    }     	 	 			
    				  	 
    if($Contact != ''){     	  	 	 
         	  
        if($zbp->Config('xc_report')->Contact_Type == 1){    		  		 	
            if(!CheckRegExp($Contact,'[email]')){    	       
                return xc_report_json_err('邮箱格式错误！');    				 	 	
            };     			    
        }    	 				  
    	   		 	
        if($zbp->Config('xc_report')->Contact_Type == 2){    		    	 
            if(xc_report_isqq($Contact)){    		 					
                return xc_report_json_err('QQ号码格式错误！');      		    
            }       		 		
        }    	 			  	
     				 		
        if($zbp->Config('xc_report')->Contact_Type == 3){    	    		 
            if(xc_report_istel($Contact)){    	   			 
                return xc_report_json_err('手机号格式错误！');     		   	 
            }    	     		
        }    	 						
          		
    }     			  		
      		  		
    	   	   
    $list = new xc_report_list();     		    	
    	 					 
    $list->LoadInfoByFields(array('IP' => xc_report_getuserip(),'Isdata' => date('Ymd'),'Aid' => $article->ID));     			    
    if($list->ID){        				
        return xc_report_json_err('此文章已反馈过，感谢您的热心贡献！',2);    			 		  
    }    	 				  
     	 			  
    $list->Uid = $zbp->user->ID;        		  
    $list->Aid = $article->ID;     		   		
    $list->Option = implode('|',$arr);    		    		
    $list->Remarks = $Remarks;      	 	   
    $list->Contact = $Contact;    				  		
    $list->Time = time();     	  				
    $list->Isdata = date('Ymd');      	    	
    $list->IP = xc_report_getuserip();    		 			 	
    $list->Agent = $_SERVER['HTTP_USER_AGENT'];    	 	 	 		
    $list->Save();    		 			  
       			 	
    $_SESSION['xc_report_listid_id'] = $list->ID;    		 			 	
      	  			
    return xc_report_json_ok('信息提交成功！谢谢您的贡献');      				  
     		 	  	
}     	  		  
    	   	   
function xc_report_pstemail()    		    	 
{     		  	 	
    global $zbp;    	 	   		
         	 	
    $zbp->StartSession();     				 	 
    if($zbp->Config('xc_report')->admin_emails && $zbp->Config('xc_report')->on_email_vf){    		  		 	
        if(isset($_SESSION['xc_report_listid_id'])){    	  		 		
            $id = $_SESSION['xc_report_listid_id'];         	  
            $list = new xc_report_list();     				 		
            $list->LoadInfoByID((int)$id);    	   			 
            if($list->ID > 0){    			 	  	
    	     	 
                $title = '有新的投诉信息需要处理！';    			 		  
                $center = '<p>您的网站《<a href="'.$zbp->host.'" target="_blank">'.$zbp->name.'</a>》有新的投诉通知！</p>';    	 	  		 
                $center .= '<p>投诉的文章为：《'.$list->articleEmail.'》</p>';       	  		
                $center .= '<p>投诉类型为：'.$list->Option.'</p>';      			  	
              			 		
                xc_report_phpmail_post($zbp->Config('xc_report')->admin_emails,'管理员',$title,$center);     			  	 
            		 			  
                return true;     	   	 	
    			 	 		
            }     	 		 		
     	 		  	
            unset($_SESSION['xc_report_listid_id']);      		   	
        }     		    	
    }       	 	 	
      	 	 	 
}     	   	 	
     	 		 		
####################################################################      	  	  
     	 					
function xc_report_json_err($tips,$code = 1)    	 	     
{    	 	 	 		
    $arr = array();    	     		
    if(is_array($tips)){    		   	  
        $arr = $tips;          	 
    }else{     	  	   
        $arr['msg'] = $tips;    		 					
    }      			  	
    $arr['code'] = $code;    		 				 
    	      	
    return json_encode($arr,JSON_UNESCAPED_UNICODE);     			 	 	
}    	 	 	   
    	      	
function xc_report_json_ok($tips,$code = 0)     	 			 	
{      			  	
    global $zbp;       		 	 
      			   
    $arr = array();    			 		  
    if(is_array($tips)){    			    	
        $arr = $tips;      	 	  	
    }else{       		   
        $arr['msg'] = $tips;    	       
    }     	 	 		 
    $arr['code'] = $code;    	 						
      	 	  	
    return json_encode($arr,JSON_UNESCAPED_UNICODE);      		 	 	
}        	  	
    	 			 	 
function xc_report_getuserip()     			 	  
{    	 	   		
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){    			  	  
        $arr = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);     				 		
        return $arr[0];      	  	 	
    }      		 			
    return GetGuestIP();    	  			  
}    	    	 	
    	 			  	
    	 			 		
//发送邮件    			 				
function xc_report_phpmail_post($email,$name,$title,$center)    	  	 	  
{    					 	 
    global $zbp;    		  	   
     		    	
    $mail = new xc_report_phpmail();    	  		 		
    $mail->isSMTP();     	   	 	
    $mail->IsHTML(true);    	 				  
    $mail->CharSet = "UTF-8";    	 	  		 
    $mail->Host = trim($zbp->Config('xc_report')->mail_smtp);    	 	     
    $mail->SMTPAuth = true;       	 	 	
    $mail->Username = trim($zbp->Config('xc_report')->mail_name);    				 		 
    $mail->Password = trim($zbp->Config('xc_report')->mail_pass);    					 		
    $mail->SMTPSecure = "ssl";    		  		 	
    $mail->Port = trim($zbp->Config('xc_report')->mail_port);     			 	  
    $mail->setFrom(trim($zbp->Config('xc_report')->mail_name),$zbp->name);       					
    $mail->addAddress($email,$name);        	 		
    $mail->addReplyTo(trim($zbp->Config('xc_report')->mail_name),$zbp->name);    			  			
    $mail->Subject = $title;    					 	 
    $mail->Body = xc_report_getHtmlcent($center);    	  		 	 
    						 	
    if(!$mail->send()){     		  			
        $zbp->Config('xc_report')->mail_statu = '<span style="color:red;">'.$mail->ErrorInfo.'</span>';    		 	 		 
        $zbp->SaveConfig('xc_report');       				 
        return false;     		  		 
    }    		    		
       	   	
    $zbp->Config('xc_report')->mail_statu = '<span style="green;">状态正常</span>';     	   			
    $zbp->SaveConfig('xc_report');    	 	  	  
    return true;    		   		 
}    			  	  
    	 	 		  
//邮箱内容     				   
function xc_report_getHtmlcent($content,$type = 'system')     		 	 		
{      	  			
    global $zbp;    	  	    

    return $type == 'system' ? '<div style="background:#e9e9e9;padding:50px 0;width:100%;">
    <div style="background:#fff;max-width:700px;width:auto;border:2px solid #eee;margin:auto;">
    <div style="padding:5px 10px;font-size:18px;border-bottom:1px solid #e9e9e9;border-top: 5px solid #0074bc;"><span>'.$zbp->name.'</span></div>
    <div style="padding:30px">'.$content.'</div>
    <div style="border-top: 1px solid #f4f3f3;padding: 10px 20px;color: #aaa;" >系统邮件，请勿回复！<br/>感谢您对'.$zbp->name.'的关注！<br/>'.$zbp->host.'</div>
    </div></div>' : $content;
}     	 	   	
     	   		 
//发送投诉通知给管理员       	   	
function xc_report_pst_adminemails($article)     			  		
{    	    	 	
    global $zbp;     		   		
    	 			   
    if($zbp->Config('xc_report')->admin_emails && $zbp->Config('xc_report')->on_email_vf){    		  		  
    	 		  		
        $title = '有新的投诉信息需要处理！';    	      	
        $center = '<p>您的网站《<a href="'.$zbp->host.'" target="_blank">'.$zbp->name.'</a>》有新的投诉通知！</p>';    				    
        $center .= '<p>投诉的文章为：《<a href="'.$article->Url.'" target="_blank">'.$article->Title.'</a>》</p>';    	     	 
        $center .= '<p>投诉类型为：</p>';    			 			 
    		 		 		
        xc_report_phpmail_post($zbp->Config('xc_report')->admin_emails,'管理员',$title,$center);       	    
     	 	  	 
        return true;    		   		 
    }    	 	    	
    		 	    
    return false;    	   	   
}    				  	 