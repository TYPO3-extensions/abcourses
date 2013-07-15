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
 * cArrangement object of abcourses plugin.
 *
 */
class cArrangement extends cAbcoursesBase {
	var $fError = 0;
	var $arrStatus = Array();

	/**
	 * To initalise an cArrangement instance with the respective data
	 *
	 * @param	integer		$arrangementId Uid of the record you want to load
	 * @param	cAbcoursesDAL		$DAL Reference to the used data access layer object
	 * @return	[type]		...
	 */
	function loadData($arrangementId='',&$DAL) {
		if (!$this->arrData) {
			$this->arrData = $DAL->loadArrangement($arrangementId);
			$this->checkErrors($DAL);
			if ($this->arrData == 0) $this->fError = 1;
		}
	}

	/**
	 * This function render the view for this event, depending on the given template.
	 *
	 * @param	string		$template : The remplate for rendering the view.
	 * @param	string		&$cObj : A reference to the cObj of the pi1 class who wants to render this view.
	 * @param	string		$conf	: A snippet of TS configuration which should be used for this event.
	 * @return	[type]		...
	 */
	function printme($template, &$view, $conf='') {
		$debugme = false;

		$MA['###FORMFIELD###'] = $this->getSingleData('uid');
		$MA['###FRONTENDNAME###'] = ($this->getSingleData('frontendname')?$this->getSingleData('frontendname'):'');

		if ($this->getSingleData('price')!='') {
			//calculate the shown price
			$price = doubleval($this->getSingleData('price'));
			$MA['###PRICE###'] = $view->cObj->stdWrap($view->calcPrice($price,$view->conf,0),$conf['priceWrap.']);
			$MA['###PRICETAX###'] = $view->cObj->stdWrap($view->calcPrice($price,$view->conf,1),$conf['priceTaxWrap.']);
		} else {
			$MA['###PRICE###'] = '';
			$MA['###PRICETAX###'] = '';
		}

		if($debugme){debug($MA);}

		//render and return the view
		return $view->cObj->substituteMarkerArrayCached($template, $MA);
	}

}
?>