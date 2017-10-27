<?php 
/*
Plugin Name: Import Dealers
Plugin URI: http://www.madico.com
Description: A simple wordpress plugin for importing dealers details from a csv file.
Version: 1.0
Author: Madico
Author URI: http://www.madico.com
License: GPL
*/
?>
<?php 
add_action('admin_menu','addDealers');
function addDealers(){
	add_menu_page('Import Dealers','Import Dealers','administrator','import-dealer','importDealers');
}

function importDealers(){
global $wpdb;
$tablename=$wpdb->prefix."posts";
?>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<h2>Import Dealers from CSV file</h2>
<table>
<tr>
<td><input type="file" name="csv_file" id="my_uploader" onchange="setSubmit()" accept=".csv"/><td>
<td><input type="submit" name="csv_file_import" value="Import" id="my_submit_button" disabled="disabled" class="import-button"  onClick="messageFun()"/></td>
<td id="loadingMessage"></td></tr>
</table>
</form> 
<?php 

 if ( is_user_logged_in() ) {  
    global $current_user;
    get_currentuserinfo();
	
	if(isset($_POST['csv_file_import'])){
	$path_array  = wp_upload_dir();
	//$path  = wp_upload_dir();
		$path = str_replace('\\', '/', $path_array['path']);
		$old_name = $_FILES["csv_file"]["name"];
		$split_name = explode('.',$old_name);
	 	//$time = time();
		$time = date('dmYHis');
		$file_name = "Madico_".$time.".".$split_name[1];
		$temp_path=$_FILES['csv_file']['tmp_name'];
		$target_path= realpath($_SERVER['DOCUMENT_ROOT'])."/imported_dealers_csv";
		if(file_exists($target_path)==false){
		mkdir($target_path,0777,true);
		}
		$target_path= realpath($_SERVER['DOCUMENT_ROOT'])."/imported_dealers_csv/".$file_name;
		if(move_uploaded_file($temp_path,$target_path))
		{
		echo "<br> Uploaded Path :".$target_path."<br>";
                $handle = fopen($target_path, "r");
                $linecount = count(file($target_path));
                $i=0;
                while (($line_of_text = fgetcsv($handle, 1000, ",")) !== FALSE) {
                 if($i>0) {
                     
                        $tpl_postmeta=$wpdb->prefix."postmeta";
			$tpl_post=$wpdb->prefix."posts";
                        $query = "SELECT * FROM $tpl_postmeta WHERE meta_key = 'dealer_id' AND meta_value = '$line_of_text[0]' ";
			$is_dealerID = $wpdb->get_results($query);
                        
			$post_id=$is_dealerID[0]->post_id;

			$query="SELECT ID FROM $tpl_post WHERE ID=".$post_id;

			$is_post_exists = $wpdb->get_results($query);	

                        if(empty($is_post_exists))
			{
				//echo "There is no such dealer exists";
				$post = array(
                                    'comment_status' =>'open',
                                    'ping_status'    =>'open',
                                    'post_author'    => $current_user->ID,
                                    'post_status'    => 'publish',
                                    'post_title'     =>  htmlentities($line_of_text[1], ENT_QUOTES, "ISO-8859-1"),
                                    'post_type'      => 'dealer', 
                                  ); 
                                $post_id = wp_insert_post( $post );  
                                
			} else {
				//echo "ALready a dealer exists with this dealer ID";			
				$update_posts="UPDATE $tpl_post SET post_author=$current_user->ID, post_title= '".htmlentities($line_of_text[1], ENT_QUOTES, "ISO-8859-1")."' WHERE ID=".$is_post_exists[0]->ID ;
				$wpdb->query($update_posts); 
				$post_id=$is_post_exists[0]->ID;	 
			}
                        
                        //$str = implode('', $line_of_text[1]);
                        //$str = serialize($line_of_text[1]);
                        
                        //echo $str;exit;
                        //print_r($line_of_text[1]);exit;
                        
                        /* converting the dealers category values into array formats*/
                        $automotive =  explode(',', $line_of_text[2]);
                        $architecture =  explode(',', $line_of_text[3]);
                        $safety_and_security =  explode(',', $line_of_text[4]);
                        $windshield_protection =  explode(',', $line_of_text[5]);
                        
                        /* converting the dealers brand values into array formats*/
                        $madico =  explode(',', $line_of_text[13]);
                        $sunscape =  explode(',', $line_of_text[14]);
                        $clearplex =  explode(',', $line_of_text[15]);
                        $safetyshield =  explode(',', $line_of_text[16]);
                        $sungard =  explode(',', $line_of_text[17]);
                        
                        /* converting the social links values into array formats*/
                        $facebook_status =  explode(',', $line_of_text[20]);
                        $twitter_status =  explode(',', $line_of_text[22]);
                        $linkedin_status =  explode(',', $line_of_text[24]);
                        
                        update_post_meta($post_id,'dealer_id',$line_of_text[0]);
                        update_post_meta($post_id,'company_name', htmlentities($line_of_text[1], ENT_QUOTES, "ISO-8859-1"));
                        update_post_meta($post_id,'automotive',$automotive);
                        update_post_meta($post_id,'architectural',$architecture);
                        update_post_meta($post_id,'safety_and_security',$safety_and_security);
                        update_post_meta($post_id,'windshield_protection',$windshield_protection);
                        update_post_meta($post_id,'street',$line_of_text[6]);
                        update_post_meta($post_id,'city',htmlentities($line_of_text[7],ENT_QUOTES, "ISO-8859-1"));
                        update_post_meta($post_id,'state',$line_of_text[8]);
                        update_post_meta($post_id,'zip',$line_of_text[9]);
                        update_post_meta($post_id,'country',$line_of_text[10]);
                        update_post_meta($post_id,'phone_number',$line_of_text[11]);
                        update_post_meta($post_id,'email',$line_of_text[12]);
                        update_post_meta($post_id,'madico',$madico);
                        update_post_meta($post_id,'sunscape',$sunscape);
                        update_post_meta($post_id,'clearplex',$clearplex);
                        update_post_meta($post_id,'safetyshield',$safetyshield);
                        update_post_meta($post_id,'sungard',$sungard);
                        update_post_meta($post_id,'website',$line_of_text[18]);
                        update_post_meta($post_id,'facebook',$line_of_text[19]);
                        update_post_meta($post_id,'facebook_status',$facebook_status);
                        update_post_meta($post_id,'twitter',$line_of_text[21]);
                        update_post_meta($post_id,'twitter_status',$twitter_status);
                        update_post_meta($post_id,'linkedin',$line_of_text[23]);
                        update_post_meta($post_id,'linkedin_status',$linkedin_status);
                        update_post_meta($post_id,'_enable_dealer',1);
                        
                        
                }
                $i++;
                }
	echo "<br>Number of Dealers :".--$i."  Uploaded successfully ";
	fclose($handle);
	
/* ========================================================================================================== */	
  }else{
	echo "Unable to upload your file <br>";
	//print_r( $_FILES );
	}
  }
 } /* end of is user logged in */
 }
?>
<?php 
function your_css_and_js() {
wp_register_style('importdealers', plugins_url('css/importdealers.css',__FILE__ ));
wp_enqueue_style('importdealers');
wp_register_script( 'importbutton', plugins_url('js/importbutton.js',__FILE__ ));
wp_enqueue_script('importbutton');
}
add_action( 'admin_init','your_css_and_js');
?>
