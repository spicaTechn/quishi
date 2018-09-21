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