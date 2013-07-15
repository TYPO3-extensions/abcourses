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
 * cCategory class of the abcourses plugin.
 *
 */
class cCategory extends cAbcoursesBase {
	var $fError = 0;
	var $arrStatus = Array();
	var $arrCourses = '';

	/**
	 * To initalise an cCategory instance with the respective data. You can load this with an uid or with the uid of an associated course.
	 *
	 * @param	integer		$categoryId Uid of the record you want to load
	 * @param	integer		$courseId Uid of a course, for which you would like to load the associated category.
	 * @param	cAbcoursesDAL		$DAL Reference to the used data access layer object
	 * @return	void
	 */
	function loadData($categoryId='',$courseId='',&$DAL) {
		if (!$this->arrData) {
			if($categoryId!='') {
				$this->arrData = $DAL->loadCategory($categoryId);
			}elseif($courseId!=''){
				$this->arrData = $DAL->loadCategory('',$courseId);
			}
			$this->checkErrors($DAL);
			if ($this->arrData == 0) $this->fError = 1;
		}
	}

	/**
	 * To load the internal course array of a category object.
	 *
	 * @param	cLoader		$objLoader	Reference to an instance of the abcourses proxy class
	 * @param	integer		$onlyWithNextEvents	As example, if you set this to 2 the category gets 2 courses initialised with the closest event. Please consider that this is only a flag. You have to set the initEvents flag too, for initialising the events automatically.
	 * @param	integer		$initEvents	Set this flag if you would like to initialise the events of the courses too. If you do not set this, only the courses will be initialised.
	 * @return	void
	 */
	function load_arrCourses(&$objLoader,$onlyWithNextEvents = 0, $initEvents = 0){
		$debugme = false;

		$onlyWithNextEvents = intval($onlyWithNextEvents);
		$DAL =& $objLoader->get_DAL();

		if (!$this->arrData) {
			$this->fError = 1;
			$this->arrStatus[] = 'Cannot load Courses for Category without Category Data in cCategory->load_arrCourses';
			$this->checkErrors($this);
			return;
		}

		if ($onlyWithNextEvents) {
			//load only the courses with the closest events
			$arrCourseIds = $DAL->listCoursesWithNextEvents($this->arrData['uid'],$onlyWithNextEvents);
			$this->checkErrors($DAL);
		} elseif (!$this->arrCourses) {
			//list all Courses of this Category
			$arrCourseIds = $DAL->listCourses($this->arrData['uid']);
			$this->checkErrors($DAL);
		}

		$foo = ($debugme?debug($arrCourseIds):'');
		$foo = ($debugme?debug("Error in load_arrCourses " . $this->fError):'');

		if (!$this->fError && $arrCourseIds) {
			reset($arrCourseIds);
			while (list($key, $id) = each($arrCourseIds)) {
				$this->arrCourses[$id] =& $objLoader->get_Course($id);
				$foo = ($debugme?debug($this->arrCourses[$id]):'');
				$Course =& $this->arrCourses[$id];

				//FIXME This is a bug as displayCategoryWithNextEvents will only display one Event Item...

				if ($onlyWithNextEvents) {
					$Course->setDisplayNextEventOnly(1);
				}
				$foo = ($debugme?debug("Should we load the Events too?: " . $initEvents):'');
				if ($initEvents) {
					$Course->load_arrEvents($objLoader);
				}
			}
			reset($this->arrCourses);
		}
	}

	/**
	 * To set an internal value
	 *
	 * @param	array		$value
	 * @return	[type]		...
	 */
	function set_arrCourses($value){
		$this->arrCourses = $value;
	}

	/**
	 * This returns a reference to the internal course array.
	 *
	 * @return	array		Content of the array: id => cCourse
	 */
	function &get_arrCourses(){
		return $this->arrCourses;
	}

	/**
	 * Returns how many courses are initialised in the internal array.
	 *
	 * @return	integer
	 */
	function countCourses(){
		if (is_array($this->arrCourses)) {
			return count($this->arrCourses);
		} else {
			return 0;
		}
	}

	/**
	 * This function render the view for this category, depending on the given template. Contained courses are rendered too.
	 *
	 * @param	string		$template : The remplate for rendering the view.
	 * @param	string		&$cObj : A reference to the cObj of the pi1 class who wants to render this view.
	 * @param	string		$conf	: A snippet of TS configuration which should be used for this category.
	 * @return	[type]		...
	 */
	function printme($template, &$view, $conf) {
		$debugme = false;
		$MA = Array();

		$templateCourses = $view->cObj->getSubpart($template, '###COURSES###');
		$templateNoCourses = $view->cObj->getSubpart($template, '###NOCOURSES###');

		// Datensatz (Kategorie): Inhalte über cObj wrappen.
		$sTitleLink = $view->cObj->stdWrap(
		$view->pi_linkToPage(
		$this->getSingleData("title"),
		$view->conf['pidOverview'],
	                    '',
		array($view->prefixId .'[catId]' => $this->getSingleData("uid"), $view->prefixId . '[mode]'=>'courses')
		),
		$conf['catTitleLinkWrap.']
		);

		$sTitle =  $view->cObj->stdWrap($this->getSingleData("title"),$conf['catTitleWrap.']);

		$sTeaser = $view->cObj->stdWrap(
				$view->cObj->parseFunc($this->getSingleData("teaser"),
			$conf['parseFunc.']),
			$conf['catTeaserWrap.']
		);

		$sImage = $conf['catImageWrap.'];
		$sImage['if.']['isTrue'] = $this->getSingleData("image");
		$sImage['file'] = $view->conf['uploaddir'] . $this->getSingleData("image"); //Dateipfad zusammensetzen
		$sImage = $view->cObj->IMAGE($sImage);

		$MA['###CATTITLELINK###']   =  $sTitleLink;
		$MA['###CATTITLE###']       =  $sTitle;
		$MA['###CATTEASER###']      =  $sTeaser;
		$MA['###CATIMAGE###']       =  $sImage;

		if ($debugme) {
			debug($MA);
		}

		$courses = '';

		$foo = ($debugme?debug($this->countCourses()):'');

		//should we trigger the view of some courses too?
		if($this->countCourses() && $templateCourses) {
			$templateCourse = $view->cObj->getSubpart($templateCourses, '###COURSE###');
			$course = '';
			reset($this->arrCourses);
			$sOE = '';
			while (list($id, $Course) = each($this->arrCourses)) {
				$singleCourse = '';
				$sOE =  ($sOE=='odd'?'even':'odd');
				$singleCourse = $Course->printme($templateCourse,$view,$conf['course.']);
				$singleCourse = $view->cObj->substituteMarker($singleCourse,'###ODDEVEN###',$sOE);
				$course .= $singleCourse;

			}
			$courses = $view->cObj->substituteSubpart($templateCourses,'###COURSE###',$course);
		} else {
			$courses = $templateNoCourses;
		}

		$template = $view->cObj->substituteSubpart($template,'###NOCOURSES###',"");
		$template = $view->cObj->substituteSubpart($template,'###COURSES###',$courses);

		//render and return the view
		return $view->cObj->substituteMarkerArrayCached($template, $MA);
	}
}
?>