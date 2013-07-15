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

class cTrainer extends cPerson {
    function loadData($trainerId='',$eventId='',&$DAL) {
        if (!$this->arrData) {
            $this->set_arrData($DAL->loadTrainer($trainerId,$eventId));
            $this->checkErrors($DAL);
        }
    }

    /**
     * This renders the data of an trainer record with the passed template.
     *
     * @param	string		$template The template for this record.
     * @param	Object		$view Usually a reference to the pi1 class of the plugin
     * @param	array		$conf TS configuration
     * @return	string		The rendered view...
     */
    function printme($template,&$view,$conf='') {
        $MA = Array();

        $MA['###TRAINERTITLE###'] = ($this->getSingleData('title')?$view->cObj->stdWrap($this->getSingleData('title'),$conf['trainerTitleWrap.']):'');
        $MA['###FULLNAME###'] = ($this->getSingleData('name')?$view->cObj->stdWrap($this->getSingleData('name'),$conf['trainerFullnameWrap.']):'');
        $MA['###TRAINERCOMPANY###'] = ($this->getSingleData('company')?$view->cObj->stdWrap($this->getSingleData('company'),$conf['trainerCompanyWrap.']):'');

        $sImage = $conf['trainerImageWrap.'];
        $sImage['if.']['isTrue'] = $this->getSingleData('image');
        $sImage['file'] = "uploads/pics/" . $this->getSingleData('image'); //Dateipfad zusammensetzen
        $sImage = $view->cObj->IMAGE($sImage);
        $MA['###TRAINERIMAGE###'] = $sImage;
        $MA['###TRAINERNUMBER###'] = $this->getSingleData('tx_abcourses_tnumber');
        $MA['###TRAINERPOSITION###'] = $this->getSingleData('tx_abcourses_position');

        //render and return the view
        return $view->cObj->substituteMarkerArrayCached($template, $MA);

    }
}

?>