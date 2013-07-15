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
 * Class to work with hotel records within the abcourses extension.
 *
 */
class cHotel extends cAbcoursesBase {
    var $fError = 0;
    var $arrStatus = Array();
    var $arrArrangement = '';

    /**
     * This loads the data of a hotel record. Corresponding to a hotelId or an arrangement id. Passed hotel id takes precedence.
     *
     * @param	integer		$hotelId
     * @param	integer		$arrangementId
     * @param	cAbcoursesDAL		$DAL Reference to the used data abstraction layer
     * @return	[type]		...
     */
    function loadData($hotelId='',$arrangementId='',&$DAL) {
        if (!$this->arrData) {
            if($hotelId!='') {
                $this->arrData = $DAL->loadHotel($hotelId);
            }elseif($arrangementId!=''){
                $this->arrData = $DAL->loadHotel('',$arrangementId);
            }
            $this->checkErrors($DAL);
            if ($this->arrData == 0) $this->fError = 1;
        }
    }

    /**
     * This function initialise one single arrangement and add it to the internal array for later usage.
     *
     * @param	integer		$arrangementId : The id of the arrangemt you want to add.
     * @param	[type]		$objLoader: ...
     * @return	[type]		...
     */
    function addArrangement($arrangementId,&$objLoader) {
        if (!$this->arrArrangement[$arrangementId]) {
            $this->arrArrangement[$arrangementId] =& $objLoader->get_Arrangement($arrangementId);
        }
        return ($this->arrArrangement[$arrangementId]?1:0);
    }

    /**
     * Load the internal arrangement array.
     *
     * @param	cLoader		$objLoader Reference to the proxy class
     * @return	void
     */
    function load_arrArrangement(&$objLoader){
        $debugme = false;

        $DAL =& $objLoader->get_DAL();

        if (!$this->arrData) {
            $this->fError = 1;
            $this->arrStatus[] = 'Cannot load arrangments for a hotel without hotel data in cHotel->load_arrArrangement';
            $this->checkErrors($this);
            return;
        }

        if (!$this->arrArrangement) {
            //list all Courses of this Category
            $arrArrangementIds = $DAL->listArrangements($this->arrData['uid']);
            $this->checkErrors($DAL);
        }

        $foo = ($debugme?debug($arrArrangementIds):'');
        $foo = ($debugme?debug("Error in load_arrArrangement " . $this->fError):'');

        if (!$this->fError && $arrArrangementIds) {
            reset($arrArrangementIds);
            while (list($key, $id) = each($arrArrangementIds)) {
                $this->arrArrangement[$id] =& $objLoader->get_Arrangement($id);
                $foo = ($debugme?debug($this->arrArrangement[$id]):'');
                $Arrangement =& $this->arrArrangement[$id];
            }
            reset($this->arrArrangement);
        }
    }

    /**
     * [Describe function...]
     *
     * @param	[type]		$value: ...
     * @return	[type]		...
     */
    function set_arrArrangement($value){
        $this->arrArrangement = $value;
    }

    /**
     * [Describe function...]
     *
     * @return	[type]		...
     */
    function &get_arrArrangement(){
        return $this->arrArrangement;
    }

    /**
     * Returns the number of initalised arrangements.
     *
     * @return	integer
     */
    function countArrangements(){
        if (is_array($this->arrArrangement)) {
            return count($this->arrArrangement);
        } else {
            return 0;
        }
    }

    /**
     * This function render the view for this hotel, depending on the given template. Contained arrangements are rendered too.
     *
     * @param	string		$template : The remplate for rendering the view.
     * @param	string		&$view : A reference to the pi1 class who wants to render this hotel.
     * @param	string		$conf	: A snippet of TS configuration which should be used for this hotel.
     * @return	string		...
     */
    function printme($template, &$view, $conf) {
        $debugme = false;
        $MA = Array();

        $templateArrangements = $view->cObj->getSubpart($template, '###ARRANGEMENTS###');

        $MA['###NAME###']    = $this->getSingleData('name');
        $MA['###SUBTITLE###']= $this->getSingleData('subtitle');

        $MA['###LINK###']    = ($this->getSingleData('link')?$view->cObj->getTypoLink('',$this->getSingleData('link')):'');

        $image = '';
        $image = $conf['image.'];
        $image['if.']['isTrue'] = $this->getSingleData('image');
        $image['file'] = "uploads/tx_abcourses/" . $this->getSingleData('image');
        $image = $view->cObj->IMAGE($image);
        $MA['###IMAGE###']   = ($this->getSingleData("image")!=''?$image:'');

        $image = '';
        $image = $conf['ratingImage.'];
        $image['if.']['isTrue'] = ($this->getSingleData("rating")!=''?1:0);
        $image['file'] = $view->ratingimagepath . 'star_' . $this->getSingleData("rating") . '.gif';
        $image = $view->cObj->IMAGE($image);
        $MA['###RATING###'] = ($this->getSingleData("rating")!=''?$image:'');

        $arrangements = '';
        $foo = ($debugme?debug($this->countArrangements()):'');

        //should we trigger the view of some arrangements too?
        if($this->countArrangements() && $templateArrangements) {
            $templateArrangement = $view->cObj->getSubpart($templateArrangements, '###ARRANGEMENT###');
            $arrangement = '';
            reset($this->arrArrangement);
            while (list($id, $Arrangement) = each($this->arrArrangement)) {
                $arrangement .= $Arrangement->printme($templateArrangement,$view,$conf['arrangement.']);
            }
            $arrangements = $view->cObj->substituteSubpart($templateArrangements,'###ARRANGEMENT###',$arrangement);
        }
        $template = $view->cObj->substituteSubpart($template,'###ARRANGEMENTS###',$arrangements);

        //render and return the view
        return $view->cObj->substituteMarkerArrayCached($template, $MA);
    }
}
?>