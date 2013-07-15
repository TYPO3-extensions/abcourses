<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2008-2013 Stefan Precht (sprecht@gmail.com)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * For different Tools to assist abcourses or for wrapper of other methods. Use as static.
 * @author Stefan Precht
 */
class AbcoursesUtil {

	/**
	 * Returns a formatted datetime timestamp as human readable.
	 *
	 * @param String $formatString	To format the output format.
	 * @param Integer $timeStamp	The timestamp you want to format. Default is getTimeStamp();
	 * @see www.php.net/strftime
	 */
	public static function getFormattedDate($formatString, $timeStamp = ''){

		if (!$timeStamp) {
			$timeStamp = AbcoursesUtil::getTimeStamp();
		}

		if ($GLOBALS['T3_VAR']['abcourses']['locale']) {
			setlocale(LC_TIME,$GLOBALS['T3_VAR']['abcourses']['locale']);
		}

		return strftime($formatString,$timeStamp);
	}


	public static function getFormattedTime($formatString, $timeStamp = ''){

		if (!$timeStamp) {
			$timeStamp = AbcoursesUtil::getTimeStamp();
		} else {
			if ($GLOBALS['T3_VAR']['abcourses']['offset']!=0){
				$timeStamp = ($timeStamp + ($GLOBALS['T3_VAR']['abcourses']['offset']*60));
			}
		}

		if ($GLOBALS['T3_VAR']['abcourses']['locale']) {
			setlocale(LC_TIME,$GLOBALS['T3_VAR']['abcourses']['locale']);
		}

		return strftime($formatString,$timeStamp);
	}

	/**
	 * Retuns a timestamp, related to the UTC settings of your TYPO3 system.
	 *
	 * @return Integer Timestamp
	 */
	public static function getTimeStamp(){
		return time();
	}
}
?>