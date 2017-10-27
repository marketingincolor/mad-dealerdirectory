<?php

function ccsve_export(){
	$ccsve_export_check = isset($_REQUEST['export']) ? $_REQUEST['export'] : '';
	if ($ccsve_export_check == 'yes') {          
		echo ccsve_generate();
	exit;
	}
}

function ccsve_generate(){

	// Get the custom post type that is being exported
	$ccsve_generate_post_type = get_option('ccsve_post_type');
	// Get the custom fields (for the custom post type) that are being exported
	$ccsve_generate_custom_fields = get_option('ccsve_custom_fields');
	// Query the DB for all instances of the custom post type
	$ccsve_generate_query = get_posts(array('post_type' => $ccsve_generate_post_type, 'post_status' => 'publish', 'posts_per_page' => -1));
	// Count the number of instances of the custom post type
	$ccsve_count_posts = count($ccsve_generate_query);	
  $order = array( dealer_id, company_name, automotive, architectural, safety_and_security, windshield_protection, logo, street, city, state, zip, country, phone_number, email, madico, sunscape, clearplex, safetyshield, sungard, website, facebook, facebook_status, twitter, twitter_status, linkedin, linkedin_status);
	// Build an array of the custom field values
	$get_ccsve_generate_value_arr = array();
	$i = 0; 
	
	foreach ($ccsve_generate_query as $post): setup_postdata($post);	
			// get the custom field values for each instance of the custom post type 
		  $ccsve_generate_post_values = get_post_custom($post->ID);
		  
              foreach ($ccsve_generate_custom_fields['selectinput'] as $key) {
                     // check if each custom field value matches a custom field that is being exported
                      if (array_key_exists($key, $ccsve_generate_post_values)) {
                           // $sampleArray[] = $ccsve_generate_post_values;
                               $get_ccsve_generate_value_arr[$key][$i] = $ccsve_generate_post_values[$key]['0'];
                            // if the the custom fields match, save them to the array of custom field values
                      }
              }
		  
	$i++;
		 
	endforeach;	
  $ccsve_generate_value_arr = array_replace(array_flip($order), $get_ccsve_generate_value_arr);

        /* To unserialize all the check values to accepted format*/
        foreach($ccsve_generate_value_arr['automotive'] as $automotiveValues){
          if(empty($automotiveValues)){
              $autoMototive['automotive'][] =0;
          } else {
          $automotiveResult = unserialize($automotiveValues);
          $autoMototive['automotive'][] = implode(",", $automotiveResult);
          }
        }
        
        foreach($ccsve_generate_value_arr['architectural'] as $architectureValues){
         if(empty($architectureValues)){
             $archiTecture['architectural'][]= 0;
         } else {
             $architectureResult = unserialize($architectureValues);  
             $archiTecture['architectural'][] = implode(",", $architectureResult);
         }
        }
        
        foreach($ccsve_generate_value_arr['safety_and_security'] as $safetyValues){
          if(empty($safetyValues)) {
            $safetySecurity['safety_and_security'][] = 0;
          } else {
            $safetyResult = unserialize($safetyValues);  
            $safetySecurity['safety_and_security'][] = implode(",", $safetyResult);
          }
        }

        foreach($ccsve_generate_value_arr['windshield_protection'] as $windshieldValues){
          if(empty($windshieldValues)) {
            $windshieldProtection['windshield_protection'][] = 0;
          } else {
            $windshieldResult = unserialize($windshieldValues);  
            $windshieldProtection['windshield_protection'][] = implode(",", $windshieldResult);
          }
        }
        
        foreach($ccsve_generate_value_arr['madico'] as $madicoValues){
            if(empty($madicoValues)){
                $maDico['madico'][] = 0;
            } else {
                $madicoResult = unserialize($madicoValues);  
                $maDico['madico'][] = implode(",", $madicoResult);
            }
        }
        foreach($ccsve_generate_value_arr['sunscape'] as $sunscapeValues){
            if(empty($sunscapeValues)){
                $sunScape['sunscape'][] = 0;
            } else {
                $sunscapeResult = unserialize($sunscapeValues);  
                $sunScape['sunscape'][] = implode(",", $sunscapeResult);
            }
        }
        foreach($ccsve_generate_value_arr['safetyshield'] as $safetyshieldValues){
            if(empty($safetyshieldValues)) {
                $safetyShield['safetyshield'][] = 0;
            } else {
                $safetyshieldResult = unserialize($safetyshieldValues);  
                $safetyShield['safetyshield'][] = implode(",", $safetyshieldResult);
            }
        }
        foreach($ccsve_generate_value_arr['sungard'] as $sungardValues){
            if(empty($sungardValues)) {
                $sunGard['sungard'][] = 0;
            } else {
                $sungardResult = unserialize($sungardValues);  
                $sunGard['sungard'][] = implode(",", $sungardResult);
            }
        }
        foreach($ccsve_generate_value_arr['clearplex'] as $clearplexValues){
            if(empty($clearplexValues)) {
                $clearPlex['clearplex'][] = 0;
            } else {
                $clearplexResult = unserialize($clearplexValues);  
                $clearPlex['clearplex'][] = implode(",", $clearplexResult);
            }
        }
        foreach($ccsve_generate_value_arr['facebook_status'] as $facebookValues){
            if(empty($facebookValues)) {
                $faceStatus['facebook_status'][] = 0;
            } else {
                $facebookResult = unserialize($facebookValues);  
                $faceStatus['facebook_status'][] = implode(",", $facebookResult);
            }
        }
        foreach($ccsve_generate_value_arr['twitter_status'] as $twitterValues){
            if(empty($twitterValues)){
                $twiStatys['twitter_status'][] = 0;
            } else {
                $twitterResult = unserialize($twitterValues);  
                $twiStatys['twitter_status'][] = implode(",", $twitterResult);
            }
        }
        foreach($ccsve_generate_value_arr['linkedin_status'] as $linkedinValues){
            if(empty($linkedinValues)) {
                $linkStatus['linkedin_status'][] = 0;
            } else {
                $linkedinResult = unserialize($linkedinValues);  
                $linkStatus['linkedin_status'][] = implode(",", $linkedinResult);
            }
        }
        
  
        $ccsve_generate_value_arr = array_merge($ccsve_generate_value_arr, $autoMototive,$archiTecture,$safetySecurity,$windshieldProtection,$maDico,$sunScape,$safetyShield,$sunGard,$clearPlex,$faceStatus,$twiStatys,$linkStatus);
    
        unset($ccsve_generate_value_arr['logo']);
//        echo '<pre>';
//        print_r($ccsve_generate_value_arr);
//        exit;
	// create a new array of values that reorganizes them in a new multidimensional array where each sub-array contains all of the values for one custom post instance
	$ccsve_generate_value_arr_new = array();
	
	foreach($ccsve_generate_value_arr as $value) {
		   $i = 0;
		   while ($i <= ($ccsve_count_posts-1)) {
			 $ccsve_generate_value_arr_new[$i][] = $value[$i];
			$i++;
		}
	}
        
	// build a filename based on the post type and the data/time
	$ccsve_generate_csv_filename = $ccsve_generate_post_type.'-'.date('Ymd').'-export.csv';
	
	//output the headers for the CSV file
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header('Content-Description: File Transfer');
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename={$ccsve_generate_csv_filename}");
	header("Expires: 0");
	header("Pragma: public");
 
	//open the file stream
	$fh = @fopen( 'php://output', 'w' );
	
	$headerDisplayed = false;
 
	foreach ( $ccsve_generate_value_arr_new as $data ) {
    // Add a header row if it hasn't been added yet -- using custom field keys from first array
    if ( !$headerDisplayed ) {
        fputcsv($fh, array_keys($ccsve_generate_value_arr));
        $headerDisplayed = true;
    }
 
    // Put the data from the new multi-dimensional array into the stream
    fputcsv($fh, $data);
  }
// Close the file stream
fclose($fh);
// Make sure nothing else is sent, our file is done
exit;
}
