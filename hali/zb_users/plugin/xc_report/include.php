<?php /* EL PSY CONGROO */       				 
#注册插件      		 	  
RegisterPlugin("xc_report","ActivePlugin_xc_report");     				 		
       		  	
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'function/class.php';     	 	  	 
require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'function/function.php';      	  	  
    			 		 	
function ActivePlugin_xc_report()     		  		  
{          	 
    global $zbp;    	  			 	
     	 	 			
    Add_Filter_Plugin('Filter_Plugin_Index_Begin','xc_report_addCssJS');      					 
    Add_Filter_Plugin('Filter_Plugin_Cmd_Ajax','xc_report_cmd_ajax');      					 
    Add_Filter_Plugin('Filter_Plugin_Admin_TopMenu','xc_report_admintopmenu');      	 	 		
     		 	   
    if($zbp->Config('xc_report')->is_theme){        	 	 
        Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','xc_report_viewpost_tmp');     	  		 		
    }    		 		   
      				  
    # 墨初用户中心点赞接口    	  	 	  
    // Filter_Mochu_Us_web_zanhtml       	  	 
    if ($zbp->CheckPlugin('mochu_us')) {     				 		
        if($zbp->Config('xc_report')->is_mochu_us){     				  	
            Add_Filter_Plugin('Filter_Mochu_Us_web_zanhtml','xc_report_mochu_us_zanhtml');     			 		 	
        }       	   	
    }    	 	  			
}          		
            
function InstallPlugin_xc_report()       	  	 	
{     			 			
    xc_report_CreateTable_sql();      	 		  
    xc_report_newcofing();    	 		 		 
}    	 	   		
    	 						
function UninstallPlugin_xc_report()     	 				  
{    	 		 		 
        	 			   
}     	   	  
     					  
function UpdatePlugin_xc_report()    			   		
{       			  
    xc_report_customCss();         	 	
}    			 			 
    						  
###################################################     		 	  	