<?php /* EL PSY CONGROO */    	 		   	
require '../../../zb_system/function/c_system_base.php';    			 		  
$zbp->Load();     	   		 
$zbp->StartSession();    	  					
    			 		  
#################################################     	   	  
// 利用 _SESSION 防止刷验证码    			    	
if(!isset($_SESSION['Y_size'])){      			 	 
    $_SESSION['Y_size'] = 0;    				 	  
}    		  	  	
      			 		
$_SESSION['Y_size'] = (int)$_SESSION['Y_size'] + 1;    	 	   		
    	 		 	 	
if($_SESSION['Y_size'] > 50){    	   		 	
    if((time() - $_SESSION['Y_time']) > 600){    	 	    	
        $_SESSION['Y_size'] = 0;    				  	 
    }     		 				
    echo 'parameter error';    	 	 	   
    die();    	 		    
}     	  	 		
     			 		 
$_SESSION['Y_time'] = time();    	   				
    			  	  
#################################################    	 	  	  
    	 	 	 		
$vimg = new xc_report_vfimg();    	  					
$vimg->type();     			 		 
$_SESSION['vefcode'] = $vimg->pstcode();    	   			 