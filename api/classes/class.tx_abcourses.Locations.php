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
 * As like as cCategorys for category records this is a wrapper class for cLocation instances.
 *
 */
class cLocations extends cAbcoursesBase {

    var $fError = 0;
    var $arrStatus = Array();
    var $arrLocationIds = '';

    /**
     * Initialise some class attributes and loads the internal location Id-Array.
     *
     * @param	cLoader		$DAL Reference to the abcourses proxy class
     * @return	[type]		...
     */
    function init(&$Loader) {
        $this->arrLocationIds = $Loader->DAL->listLocations();
        $this->checkErrors($this->DAL);
        if ($this->arrData == 0) $this->fError = 1;
    }

    /**
     * Initialise the cLocation instances for the location id's as contained in the internal array arrLocationIds.
     * Return false if an error occurs.
     *
     * @param	cLoader		$DAL Reference to the abcourses proxy class
     * @return	boolean
     */
    function loadData(&$Loader) {
        if ($this->fError || (!is_array($this->arrLocationIds))) {return false;}

        foreach($this->arrLocationIds as $key=>$value) {
            unset($objNextLocation);
            $objNextLocation =& $Loader->get_Location($value);
            $this->arrData[$objNextLocation->arrData['uid']] = $objNextLocation;
        }
        return true;
    }

    /**
     * Returns an Array with the id of a location as key and the title of the location as value.
     * The returned array is empty, if no data was available.
     *
     * @return	array
     */
    function getLocationUidTitleArray() {
        if ($this->fError) {return false;}
        $arrReturn = Array();
        if (is_array($this->arrData)) {
            //returns a list with all uid->title pairs of loaded locations
            reset($this->arrData);
            while (list($key) = each($this->arrData)) {
                $arrReturn[$key] = $this->arrData[$key]->arrData['title'];
            }
            reset($this->arrData);
        }
        return $arrReturn;
    }

}
?>