<?php #mbx-inc.php

####### FORMATTING FUNCTIONS...

/*
 * Return multiple line breaks based on int given
 * Default is set to 3;
 *
 * Optional parameter $clear if set to TRUE will require
 * currently logged in admin to view crash - will not interfere with
 * public's view of the page
 *
 *
 * <code>
 * 	returnBreak(int = 0, $optional parameter = 'TRUE');
 * </code>
 *
 * @param int will return number of breaks equal to int
 * @param boolean $adminOnly if TRUE will only show crash to logged in admins (optional)
 * @return none
 */
function returnBreak($step = 0, $clear = FALSE){ #return $x breaks
	#if $step == 0, set $step to 3
	if($step == 0){ $step = 3;}

	#create line breaks
	for ($x = 1; $x <= $step; $x++) {

		if($clear == FALSE){
			echo "<br>";
		}else{
			echo "returnBreak is: $x <br>";
		}
	}
}







####### TROUBLE SHOOTING FUNCTIONS...
/*
 * troubleshooting wrapper function for var_dump
 *
 * saves annoyance of needing to type pre-tags
 *
 * Optional parameter $adminOnly if set to TRUE will require
 * currently logged in admin to view crash - will not interfere with
 * public's view of the page
 *
 * WARNING: Use for troubleshooting only: will crash page at point of call!
 *
 * <code>
 * dumpDie($myObject);
 * </code>
 *
 * @param object $myObj any object or data we wish to view internally
 * @param boolean $adminOnly if TRUE will only show crash to logged in admins (optional)
 * @return none
 */
function dumpDie($myObj,$adminOnly = FALSE){
	if(!$adminOnly || startSession() && isset($_SESSION['AdminID']))
	{#if optional TRUE passed to $adminOnly check for logged in admin
		echo '<pre>';
		var_dump($myObj);
		echo '</pre>';
		die;
	}
}


/*
 * variation of dumpDie()
 *
 * saves annoyance of needing to type pre-tags
 * lets page contiue after display object give
 *
 * Optional parameter $adminOnly if set to TRUE will require
 * currently logged in admin to view crash - will not interfere with
 * public's view of the page
 *
 * WARNING: Use for troubleshooting only: will crash page at point of call!
 *
 * <code>
 * dumpster($obj, __LINE__, __FILE__);
 * </code>
 *
 * @param object $myObj any object or data we wish to view internally
 * @param object $myObj any object or data we wish to view internally
 *
 * @param boolean $adminOnly if TRUE will only show crash to logged in admins (optional)
 * @return none
 */
function dumpGo($str='', $lineNumber, $fileName){

	if($lineNumber > 0){
			echo '<br /><br />';
			echo 'Declared in: <b><font color="red">' . $fileName . '</font></b><br />';
			echo 'Line: <b><font color="red">#' . $lineNumber . '</font></b><br />';
			}

	echo '<br /><pre>';
			var_dump($str);
	echo '</pre><br />';
}


