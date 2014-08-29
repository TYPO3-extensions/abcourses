<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Stefan Precht (info@stefanprecht.de)
 *
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
 * TODO Documentation
 *
 * @author Stefan Precht <info@stefanprecht.de>
 */

require_once(t3lib_extMgm::extPath('abcourses').'api/util/class.tx_abcourses.CurrentContext.php');


class tx_abcourses_metadata {

    private $currentContext = null;
    private $useAbcoursesKeywords = false;
    private $useAbcoursesDescription = false;
    private $descriptionParseFuncConfig = array("denyTags"=>"*");
    private $descriptionLength = 100;
    private $conf = array();
    public $cObj = null; //as userFunc accesses this, it needs to be public

    /**
     * To avoid bothering WARN message when instantiated with makeInstance, the parameter cObj is set to null by
     * default. Make instance accesses the property directly. wtf. How ever. Take care to set this manually, if you use
     * normal instantiation.
     * @param string $cObj
     */
    function __construct($cObj=null)
    {
        $this->cObj = $cObj;

        $isConfSet = isset($GLOBALS['TSFE']->tmpl->setup['tx_abcourses.']['metadata.']);
        if ($isConfSet){
            $this->conf = $GLOBALS['TSFE']->tmpl->setup['tx_abcourses.']['metadata.'];
        }

        $this->useAbcoursesKeywords = $this->conf != null ?
            isset($this->conf['addKeywords']) ?
                $this->conf['addKeywords'] : $this->useAbcoursesKeywords
            : false;

        $this->useAbcoursesDescription = $this->conf != null ?
            isset($this->conf['addDescription']) ?
                $this->conf['addDescription'] : $this->useAbcoursesDescription
            : false;

        if (isset($this->conf['description.']['parseFunc.'])) {
            $this->descriptionParseFuncConfig = $this->conf['description.']['parseFunc.'];
        }

        if (is_numeric($this->conf['description.']['length'])){
            $this->descriptionLength = $this->conf['description.']['length'];
        }
    }

    /**
     * As you need to configure this function explicitely within your TS, there is no switch for the activation-state.
     * @param $currentTitle The current page title used for rendering
     * @param $emptyArray As the name says
     * @return string The page title which possibly replaces the current one
     */
    public function titleTagFunction($currentTitle,$emptyArray){
        //return a modified title, if required and available
        if ($this->isCourseAvailable()) {
            $newTitle = $this->getCurrentCourse()->getSingleData(cCourse::TITLE);
            $newTitle .= ($this->getCurrentCourse()->getSingleData(cCourse::SUBTITLE)?' - ' . $this->getCurrentCourse()->getSingleData(cCourse::SUBTITLE):'');
            return $newTitle;
        }
        //else return the current title
        return $currentTitle;
    }

    public function addKeywords(){
        $keywords = $this->getCurrentCourse()->getSingleData(cCourse::KEYWORDS);
        if (!empty($keywords)) {
            $keywords = htmlspecialchars($keywords);
            if (!empty($this->cObj)) {
            $GLOBALS['TSFE']->additionalHeaderData['abcourses_keywords'] = $this->cObj->stdWrap($keywords,
                $this->conf['keywords.']['keywordsWrap.']);
            } else {
                //just as fallback
                $GLOBALS['TSFE']->additionalHeaderData['abcourses_keywords'] = "<meta keywords=\"".$keywords."\"/>";
            }
        }
    }

    public function addDescription(){

        $description = $this->getCurrentCourse()->getSingleData(cCourse::SEODESC);

        if (!empty($description)) {
            $description = $this->cObj->parseFunc($description, $this->descriptionParseFuncConfig);
            $description = strip_tags($description);
            $description = mb_substr($description,0,$this->descriptionLength,'UTF-8');

            if (!empty($this->cObj)) {
            $GLOBALS['TSFE']->additionalHeaderData['abcourses_description'] = $this->cObj->stdWrap($description,
                $this->conf['description.']['seoDescWrap.']);
            } else {
                //just as fallback
                $GLOBALS['TSFE']->additionalHeaderData['abcourses_description'] = "<meta description=\"".$description."\" />";
            }
        }
    }

    /**
     * Returns true, if a current course is detected
     * @return bool
     */
    private function isCourseAvailable() {
        return $this->getCurrentContext()->isCurrentCourseAvailable();
    }

    /**
     * @return cCourse
     */
    private function &getCurrentCourse(){
        return $this->getCurrentContext()->getCurrentCourse();

    }

    /**
     * @return null|tx_abcourses_CurrentContext
     */
    private function getCurrentContext(){
        if ($this->currentContext == null) {
            $this->currentContext = new tx_abcourses_CurrentContext();
        }
        return $this->currentContext;
    }
}

?>