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
 * This class handles the teaching-aid records of the abcourses plugin.
 *
 */
class cTeachingaid extends cAbcoursesBase {
    var $fError = 0;
    var $arrStatus = Array();

    /**
     * Load the data of a teaching aid record depending on the passed teachingaidId.
     *
     * @param	integer		$teachingaidId
     * @param	cAbcoursesDAL		$DAL Reference to the used data abstraction layer
     * @return	void
     */
    function loadData($teachingaidId='',&$DAL) {
        if (!$this->arrData) {
            $this->arrData = $DAL->loadTeachingaid($teachingaidId);
            $this->checkErrors($DAL);
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
    function printme($template, &$view) {
        $debugme = false;

        $MA['###NAME###'] = ($this->getSingleData('name')?$this->getSingleData('name'):'');

        if($debugme){debug($MA);}

        //render and return the view
        return $view->cObj->substituteMarkerArrayCached($template, $MA);
    }

}
?>