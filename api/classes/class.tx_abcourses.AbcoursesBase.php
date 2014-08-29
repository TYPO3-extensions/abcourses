<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2008 Stefan Precht (sprecht@gmx.de)
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
 * Base class for abcourses content objects.
 *
 */
class cAbcoursesBase extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin {
	var $arrData = '';
	var $fError = 0;

	/**
	 * Check if an error occured for the referenced object and write the error message array to the logfile. If you set debugme flag true, the error messages are pushed into the debug() function too.
	 *
	 * @param	object		$obj
	 * @return	[type]		...
	 */
	function checkErrors(&$obj) {
		$debugme = false;
		if ($obj->fError || (is_array($obj->arrStatus))) {
			foreach($obj->arrStatus as $error) {
				$sAllErrors .= $error . "\r\n";
			}
			t3lib_div::sysLog($sAllErrors,'abcourses');
			$this->fError = $obj->fError;
			$foo = ($debugme?debug($sAllErrors):'');
		}
	}

	/**
	 * To set an internal value.
	 *
	 * @param	array		$value
	 * @return	[type]		...
	 */
	function set_arrData($value){
	    if (is_array($value)){
		    $this->arrData = $value;
	    } else {
	        $this->arrData = '';
	    }
	}

	/**
	 * This returns a reference to the internal data array.
	 *
	 * @return	array
	 */
	function &get_arrData(){
		return $this->arrData;
	}

	/**
	 * Returns a single value of the internal data array.
	 *
	 * @param	string		$value: Each DB Field is possible.
	 * @return	string
	 */
	function getSingleData($value){
		return $this->arrData[$value];
	}
}
?>