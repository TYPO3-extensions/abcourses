<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Stefan Precht (sprecht@gmx.de)
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
 * Represents a single participant.
 *
 */
class cParticipant extends cPerson {

	function loadData($participantId='', &$DAL) {
        if (!$this->arrData) {
            $this->set_arrData($DAL->loadParticipant($participantId));
            $this->checkErrors($DAL);
        }
    }

    /**
     * This renders the data of an participant with the passed template.
     *
     * @param	string		$template The template for this record.
     * @param	Object		$view Usually a reference to the pi1 class of the plugin
     * @param	array		$conf TS configuration
     * @return	string		The rendered view...
     */
    function printme($template,&$view,$conf='') {
        $MA = Array();

        $MA['###TITLE###']      = ($this->getSingleData('title')?$view->cObj->stdWrap($this->getSingleData('title'),$conf['titleWrap.']):'');
        $MA['###FULLNAME###']   = ($this->getSingleData('name')?$view->cObj->stdWrap($this->getSingleData('name'),$conf['fullnameWrap.']):'');
        $MA['###COMPANY###']    = ($this->getSingleData('company')?$view->cObj->stdWrap($this->getSingleData('company'),$conf['companyWrap.']):'');
               
        $gender = "";
        if ($this->getSingleData('gender')){
        	if ($this->getSingleData('gender')=="m") {
        		$gender = $view->pi_getLL('labelmale');
        	} else {
        		$gender = $view->pi_getLL('labelfemale');
        	}
        }
		$MA['###GENDER###']     = ($gender?$view->cObj->stdWrap($gender,$conf['genderWrap.']):'');
		$MA['###FIRST_NAME###'] = ($this->getSingleData('first_name')?$view->cObj->stdWrap($this->getSingleData('first_name'),$conf['firstNameWrap.']):'');
		$MA['###MIDDLE_NAME###']= ($this->getSingleData('middle_name')?$view->cObj->stdWrap($this->getSingleData('middle_name'),$conf['middleNameWrap.']):'');
		$MA['###LAST_NAME###']  = ($this->getSingleData('last_name')?$view->cObj->stdWrap($this->getSingleData('last_name'),$conf['lastNameWrap.']):'');
		$MA['###EMAIL###']      = ($this->getSingleData('email')?$view->cObj->stdWrap($this->getSingleData('email'),$conf['emailWrap.']):'');
		$MA['###PHONE###']      = ($this->getSingleData('phone')?$view->cObj->stdWrap($this->getSingleData('phone'),$conf['phoneWrap.']):'');
		$MA['###MOBILE###']     = ($this->getSingleData('mobile')?$view->cObj->stdWrap($this->getSingleData('mobile'),$conf['mobileWrap.']):'');
		$MA['###CITY###']       = ($this->getSingleData('city')?$view->cObj->stdWrap($this->getSingleData('city'),$conf['cityWrap.']):'');
		$MA['###ZIP###']        = ($this->getSingleData('zip')?$view->cObj->stdWrap($this->getSingleData('zip'),$conf['zipWrap.']):'');

        //render and return the view
        return $view->cObj->substituteMarkerArrayCached($template, $MA);
    }
}
?>