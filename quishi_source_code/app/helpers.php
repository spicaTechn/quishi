<?php
/**
* contains all the required helper functions for the quishi
*
*
*/

if(!function_exists('show_career_advisior_salary_range')){
	function show_career_advisior_salary_range($salary_range){
		// switch salary range
		switch($salary_range){
			case '1':
				return '$0 - $10,000 / per annum';
				break;
			case '2':
			 	return '$10000 - $20000 / per annum';
			    break;
			 case '3':
			    return '$20000 - $30000 / per annum';
			 	break;
			 case '4':
			 	return '$30000 - $50000 / per annum';
			 	break;
			 case '5':
			 	return '$50000 - $80000 / per annum';
			    break;
			 case '6':
			 	return '$80000 - $120000 / per annum';
			    break;
			 case '7':
			 	return '$120000 - $170000 / per annum';
			    break;
			 case '8':
			 	return '$170000 - $230000 / per annum';
			    break;
			 case '9':
			 	return '$230000 - $500000 / per annum';
			    break;
			 case '10':
			    return '$500000+ / per annum';
			    break;
			  default:
			  	return 'unknown';
			  	break;
		}
	}
}


if(!function_exists('show_career_advisior_job_experience')){
	function show_career_advisior_job_experience($job_experience){
		switch($job_experience){
			case '1':
				return '0 to 2 years';
				break;
			case '2':
				return '2 to 4 years';
				break;
			case '3':
				return '4 to 6 years';
				break;
			case '4':
				return '6 to 8 years';
				break;
			case '5':
				return '8 to 10 years';
				break;
			case '6':
				return '10 to 15 years';
				break;
			case '7':
				return '15 to 25 years';
				break;
			case '8':
				return '25+ years';
				break;
			default:
				return 'unknown';
				break;
		}
	}
}



if(!function_exists('show_career_advisior_age_group')){
	function show_career_advisior_age_group($age_group){
		switch($age_group){
			case '1':
				return '0-15 years';
				break;
			case '2':
				return '15-30 years';
				break;
			case '3':
				return '30-45 years';
				break;
			case '4':
				return '45-50 years';
				break;
			case '5':
				return '50+ years';
				break;
			default:
				return 'unknown';
				break;
		}
	}
}



//function to check for the input field and return in 1k or 1m 


if(!function_exists('quishi_convert_number_to_human_readable')){
	function quishi_convert_number_to_human_readable($n,$precision=1){

		if ($n < 900) {
			// 0 - 900
			$n_format = number_format($n, $precision);
			$suffix = '';
		} else if ($n < 900000) {
			// 0.9k-850k
			$n_format = number_format($n / 1000, $precision);
			$suffix = 'K';
		} else if ($n < 900000000) {
			// 0.9m-850m
			$n_format = number_format($n / 1000000, $precision);
			$suffix = 'M';
		} else if ($n < 900000000000) {
			// 0.9b-850b
			$n_format = number_format($n / 1000000000, $precision);
			$suffix = 'B';
		} else {
			// 0.9t+
			$n_format = number_format($n / 1000000000000, $precision);
			$suffix = 'T';
		}
	  // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
	  // Intentionally does not affect partials, eg "1.50" -> "1.50"
		if ( $precision > 0 ) {
			$dotzero = '.' . str_repeat( '0', $precision );
			$n_format = str_replace( $dotzero, '', $n_format );
		}
			return $n_format . $suffix;
			
	}
}


//show the color tags as per the tag name on the superadmin dashboard


if(!function_exists('show_tags_color')){
	function show_tags_color($n){
		switch($n){
			case 1:
				return 'btn bg-c-blue btn-round float-right btn-browser';
				break;
			case 2:
				return 'btn bg-c-pink btn-round float-right btn-browser';
				break;
			case 3:
				return 'btn bg-c-yellow btn-round float-right btn-browser';
				break;
			case 4:
				return 'btn bg-c-green btn-round float-right btn-browser';
				break;
			case 5:
				return 'btn bg-c-yellow btn-round float-right btn-browser';
				break;
			case 6:
				return 'btn bg-c-yellow btn-round float-right btn-browser';
				break;
			default:
				return 'btn bg-c-yellow btn-round float-right btn-browser';
				break;
		}
	}
}


/**
*
* show the link class in the career advisior profile
*
* @param string label
*
* @return string icon_class
*
*
**/


if(!function_exists('get_link_icon_class')){
	function get_link_icon_class($label){
		$icon_class = "";
		switch($label){
			case 'facebook_link':
				$icon_class = 'icon-social-facebook';
				break;
			case 'twitter_link':
				$icon_class = 'icon-social-twitter';
				break;
			case 'google_plus_link':
				$icon_class = 'icon-social-google';
				break;
			case 'linkedin_link':
				$icon_class = 'icon-social-linkedin';
				break;
			default:
				$icon_class = 'icon-link external_link';
				break;

		}

		return $icon_class;
	}
}

