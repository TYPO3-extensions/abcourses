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
 * cCategorys is as like a wrapper class for cCategory objects. It collects all available categorys in an internal array.
 * This is used for category listings.
 *
 */
class cCategorys extends cAbcoursesBase {

    var $fError = 0;
    var $arrStatus = Array();
    var $arrCategoryIds = '';
    var $DAL = '';

    /**
     * Initialise this object. Loads the internal array with category ids but does not initalise the category objects.
     *
     * @param	cAbcoursesDAL		$DAL A reference to the used abstraction layer
     * @return	void
     */
    function init(&$DAL) {
        $this->DAL = $DAL;
        $this->arrCategoryIds = $this->DAL->listCategorys();
        $this->checkErrors($this->DAL);
    }

    /**
     * Initialise the category objects and put them into the internal category array.
     *
     * @return	void
     */
    function loadData() {
        if ($this->fError || !(is_array($this->arrCategoryIds))) {return;}
        foreach($this->arrCategoryIds as $key=>$value) {
            $objNextCategory=&t3lib_div::makeInstance('cCategory');
            $objNextCategory->loadData($value,'',$this->DAL);
            $this->arrData[$objNextCategory->arrData['uid']] = $objNextCategory;
            unset($objNextCategory);
        }
    }

    /**
     * Returns a list with all uid->title pairs of loaded categories. Returns an empty array
     * if no categories are available.
     *
     * @return	array
     */
    function getCategoryUidTitleArray() {
        $arrReturn = Array();
        if (is_array($this->arrData)){
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