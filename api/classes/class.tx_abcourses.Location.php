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
 * This class handles the location records of the abcourses plugin.
 *
 */
class cLocation extends cAbcoursesBase{
    var $fError = 0;
    var $arrStatus = Array();

    /**
     * Load the data of a location record.
     *
     * @param	integer		$byUid To load the data with a location id
     * @param	integer		$byEventId To load the data with a corresponding event id.
     * @param	cAbcoursesDAL		$DAL Reference to the used abstraction layer
     * @return	void		...
     */
    function loadData($byUid='',$byEventId='',&$DAL) {
        if (!$this->arrData) {
            $this->set_arrData($DAL->loadLocation($byUid,$byEventId));
            $this->checkErrors($DAL);
            if ($this->arrData == 0) $this->fError = 1;
        }
    }

    /**
     * Render and return the data of this location with the passed template.
     *
     * @param	string		$template : The remplate for rendering the view.
     * @param	string		&$view : A reference to the pi1 class who wants to render this location.
     * @param	string		$conf	: A snippet of TS configuration which should be used for this location.
     * @return	string		...
     */
    function printme($template,&$view,$conf='') {
        $MA = Array();

        $MA['###LOCNAME###'] = ($this->getSingleData('title')?$view->cObj->stdWrap($this->getSingleData('title'),$conf['locationNameWrap.']):'');
        $MA['###LOCSTREET###'] = ($this->getSingleData('street')?$view->cObj->stdWrap($this->getSingleData('street'),$conf['locationStreetWrap.']):'');
        $MA['###LOCZIP###'] = ($this->getSingleData('zip')?$view->cObj->stdWrap($this->getSingleData('zip'),$conf['locationZipWrap.']):'');
        $MA['###LOCCITY###'] = ($this->getSingleData('city')?$view->cObj->stdWrap($this->getSingleData('city'),$conf['locationCityWrap.']):'');
        $MA['###LOCPHONE###'] = ($this->getSingleData('phone')?$view->cObj->stdWrap($this->getSingleData('phone'),$conf['locationPhoneWrap.']):'');
        $MA['###LOCFAX###'] = ($this->getSingleData('fax')?$view->cObj->stdWrap($this->getSingleData('fax'),$conf['locationFaxWrap.']):'');
        $MA['###LOCEMAIL###'] = ($this->getSingleData('email')?$view->cObj->stdWrap($this->getSingleData('email'),$conf['locationEmailWrap.']):'');
        $MA['###LOCPERSON###'] = ($this->getSingleData('person')?$view->cObj->stdWrap($this->getSingleData('person'),$conf['locationPersonWrap.']):'');

        //render and return the view
        return $view->cObj->substituteMarkerArrayCached($template, $MA);
    }

}
?>