<?php /* EL PSY CONGROO */     		 				
require '../../../zb_system/function/c_system_base.php';       				 
$zbp->Load();        		  
$action='root';     		 	  	
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}     	    		
if (!$zbp->CheckPlugin('xc_report')) {$zbp->ShowError(48);die();}    		    		
    				 	  
$act = isset($_GET['act']) ? $_GET['act'] : 'setup';     		 	 		
    	 	 	 		
switch ($act) {    		  	 		
    case 'del_all_log':     							
         	  				
        $sql = $zbp->db->sql->DelTable($zbp->table['xc_report_list']);    	    	  
        $zbp->db->Delete($sql);    	 	     
    				 	 	
        $s = $zbp->db->sql->CreateTable($zbp->table['xc_report_list'],$zbp->datainfo['xc_report_list']);    				 	  
        $zbp->db->QueryMulit($s);          		
     	    	 
        $zbp->SetHint('good','清空成功！');        		  
        Redirect('./main.php?act=list&csrfToken='.$zbp->GetCSRFToken());    				 	  
        break;    	 	 	   
    case 'del_log':    	  		 	 
             	      
        $list = new xc_report_list();     			    
        $list->LoadInfoByID((int)$_GET['id']);    	 	  		 
        if($list->ID){     	   		 
            $list->Del();     		 			 
        }    	  				 
     	     	
        $zbp->SetHint('good','删除成功');     	  	 		
        Redirect('./main.php?act=list&csrfToken='.$zbp->GetCSRFToken());    	 	 	  	
    				   	
        break;    		 	  	 
    case 'see_log':    	 	  		 
      		 		 
        $list = new xc_report_list();     							
        $list->LoadInfoByID((int)$_POST['id']);        	 		
        if($list->ID < 1){        	 		
            echo xc_report_json_err('记录不存在！');      		   	
            die();    	  		 	 
        }    	 	   	 
     	 		 	 
        $html = '<div class="xc_report_main_alert">';     	  				
    				 			
        $html .= '<div><span>举报用户</span>'.$list->Mem->Name.'</div>';    			  			
        $html .= '<div><span>举报文章</span>'.$list->article.'</div>';      		 			
        $html .= '<div><span>举报类型</span>'.$list->Option.'</div>';    	 		 	 	
        $html .= '<div><span style="display: block;margin-right: 0px;">举报描述</span><div>'.$list->Remarks.'</div></div>';    	 	 	 		
        $html .= '<div><span>联系方式</span>'.$list->Contact.'</div>';    		   	 	
        $html .= '<div><span>举报时间</span>'.date('Y-m-d H:i:s',$list->Time).'</div>';    	 			 	 
        $html .= '<div><span>举报者IP</span>'.$list->IP.'</div>';     	  		 	
        $html .= '<div><span style="display: block;margin-right: 0px;">举报者UA</span><div>'.$list->Agent.'</div></div>';    	 	 		 	
           		 			  
        $html .= '</div>';    	 	   		
        echo xc_report_json_ok(array('html' => $html));        	 	 
        break;     				  	
    case 'vfemails':    				 	 	
    		   	 	
        $email = FormatString($_POST['email'], '[noscript]');      					 
      	 				
        xc_report_phpmail_post($email,'管理员','测试邮件','如果您收到了此信息，则表示邮箱的配置是正确的！');    	 			  	
      	 	 	 
        $zbp->SetHint('good','测试信息已发出！');      						
	    Redirect('main.php?act=email');     					  
        break;       					
        	  	  		
    default:     	  	   
        # code...      	 	  	
        break;    	 			   
}    	 		  	 
    	 			   