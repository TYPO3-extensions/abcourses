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
 * The cCourse class handles the course records of the abcourses plugin.
 *
 */
class cCourse extends cAbcoursesBase{

	var $fError = 0;
	var $arrStatus = Array();
	var $arrEvents = '';
	var $arrTeachingaids = '';
	var $arrTrainer = '';
	var $arrConditions = '';
	var $displayNextEventOnly = 0;
    const UID = "uid";
    const NUMBER = "number";
    const TITLE = "title";
    const SUBTITLE = "subtitle";
    const TEASER = "teaser";
    const DESCRIPTION = "description";
    const SEODESC = "seodesc";
    const KEYWORDS = "keywords";
    const EDUPOINTS = "edupoints";
    const CONTINGENT = "contingent";
    const DAYS = "days";
    const CONDITIONS = "conditions";
    const COST = "cost";
    const SKILLLEVEL = "skilllevel";

    /**
	 * This loads the data of a course record, depending to a passed courseId or an corresponding eventId.
	 *
	 * @param	integer		$courseId	Id of the course record you would like to get
	 * @param	integer		$eventId Get an course record with an associated event id
	 * @param	cAbcoursesDAL		$DAL A reference to the used abstraction layer
	 * @return	[type]		...
	 */
	function loadData($courseId='',$eventId='',&$DAL) {
		if (!$this->arrData) {
			$this->arrData = $DAL->loadCourse($courseId,$eventId);
			$this->checkErrors($DAL);
			if ($this->arrData == 0) $this->fError = 1;
		}
	}

	/**
	 * Returns how many events are currently initialised
	 *
	 * @return	integer
	 */
	function countEvents(){
		if (is_array($this->arrEvents)) {
			return count($this->arrEvents);
		} else {
			return 0;
		}
	}

	/**
	 * Returns how many teaching aids are currently initialised
	 *
	 * @return	integer
	 */
	function countTeachingaids(){
		if (is_array($this->arrTeachingaids)) {
			return count($this->arrTeachingaids);
		} else {
			return 0;
		}
	}

	/**
	 * Returns how many trainer are currently initialised
	 *
	 * @return	integer
	 */
	function countTrainer(){
		if (is_array($this->arrTrainer)) {
			return count($this->arrTrainer);
		} else {
			return 0;
		}
	}

	/**
	 * Returns how many conditional courses are currently initialized
	 *
	 * @return	integer
	 */
	function countConditions(){
		if (is_array($this->arrConditions)) {
			return count($this->arrConditions);
		} else {
			return 0;
		}
	}

	/**
	 * Load the internal trainer array.
	 *
	 * @param	unknown_type		$objLoader A reference to the used proxy class
	 * @return	void
	 */
	function load_arrTrainer(&$objLoader){
		$debugme = false;

		$DAL =& $objLoader->get_DAL();

		if (!$this->arrData) {
			$this->fError = 1;
			$this->arrStatus[] = 'Can not load trainer for a course without a course uid';
			$this->checkErrors($this);
			return;
		}

		$arrTrainerIds = 0;
		$arrTrainerIds = $DAL->listTrainer($this->getSingleData(self::UID));
		$this->checkErrors($DAL);

		$foo = ($debugme?debug("The following trainer matches the criteria"):'');
		$foo = ($debugme?debug($arrTrainerIds):'');

		if (!$this->fError && $arrTrainerIds) {
			reset($arrTrainerIds);
			while (list($key, $id) = each($arrTrainerIds)) {
				$this->arrTrainer[$id] =& $objLoader->get_Trainer($id);
			}
			reset($this->arrTrainer);
		}
	}

	/**
	 * Load the internal array with conditional courses
	 * @param $objLoader
	 * @return void
	 */
	function load_arrConditions(&$objLoader) {
		$debugme = false;

		$DAL =& $objLoader->get_DAL();

		if (!$this->arrData) {
			$this->fError = 1;
			$this->arrStatus[] = 'Can not load conditional courses for a course without a uid';
			$this->checkErrors($this);
			return;
		}

		$arrCourseIds = 0;
		$arrCourseIds = $DAL->listConditionalCourses($this->getSingleData(self::UID));
		$this->checkErrors($DAL);

		$foo = ($debugme?debug("The following courses matches the criteria"):'');
		$foo = ($debugme?debug($arrCourseIds):'');

		if (!$this->fError && $arrCourseIds) {
			reset($arrCourseIds);
			while(list($key, $id) = each($arrCourseIds)){
				$this->arrConditions[$id] =& $objLoader->get_Course($id);
			}
			reset($this->arrConditions);
		}

	}

	/**
	 * Load the internal array of teaching aids.
	 *
	 * @param	unknown_type		$objLoader A reference to the used proxy class
	 * @return	void
	 */
	function load_arrTeachingaids(&$objLoader){
		$debugme = false;

		$DAL =& $objLoader->get_DAL();

		if (!$this->arrData) {
			$this->fError = 1;
			$this->arrStatus[] = 'Can not load teaching aids for a course without a course uid';
			$this->checkErrors($this);
			return;
		}

		$arrTeachingaidsIds = 0;
		$arrTeachingaidsIds = $DAL->listTeachingaidsForCourse($this->getSingleData(self::UID));
		$this->checkErrors($DAL);

		$foo = ($debugme?debug("The following teaching aids matches the criteria"):'');
		$foo = ($debugme?debug($arrTeachingaidsIds):'');

		if (!$this->fError && $arrTeachingaidsIds) {
			reset($arrTeachingaidsIds);
			while (list($key, $id) = each($arrTeachingaidsIds)) {
				$this->arrTeachingaids[$id] =& $objLoader->get_Teachingaid($id);
			}
			reset($this->arrTeachingaids);
		}

	}

	/**
	 * Loads the events array of this course.
	 *
	 * @param	cLoader		$objLoader: An reference to a cLoader instance.
	 * @param	integer		$showeventsago: Set this e.g. to "2" if you want to load events too which are out of date since max 2 days.
	 * @param	array		$displayEventInList: Arraykey is the eventid and value is 1 if you want to load only special events for this course.
	 * @param   integer     $limitEvents: This limits the count of events added to the course. Set to 0 deactivates this feature.
	 * @return	[type]		...
	 */
	function load_arrEvents(&$objLoader,$showeventsago = 0,$displayEventInList='',$limitEvents=''){

		$debugme = false;

		$DAL =& $objLoader->get_DAL();
		$showeventsago = intval($showeventsago);

		$foo = ($debugme?debug("Limit Events to: " . $limitEvents):'');
		$foo = ($debugme?debug("Show events with a start date older than " . $showeventsago . " days too"):'');

		if (!$this->arrData) {
			$this->fError = 1;
			$this->arrStatus[] = 'Can not load events for a course without a course uid';
			$this->checkErrors($this);
			return;
		}

		$arrEventIds = 0;
		if ($this->displayNextEventOnly) {
			$foo = ($debugme?debug("List only the next events: " . $this->displayNextEventOnly):'');
			//load only the closest event
			$arrEventIds = $DAL->listNextEventForCourse($this->getSingleData(self::UID),$showeventsago);
			$this->checkErrors($DAL);
		} elseif (!$this->arrEvents) {
			$foo = ($debugme?debug("List all events."):'');
			//list all events of this course
			$arrEventIds = $DAL->listEvents($this->getSingleData(self::UID),$showeventsago);
			$this->checkErrors($DAL);
		} elseif (is_array($displayEventInList)){
			$arrEventIds = Array();
			while (list($eventId, $displayState) = each($displayEventInList)) {
				$arrEventIds[] = $eventId;
			}
		}

		if (!$this->fError && $arrEventIds) {
			reset($arrEventIds);
			$count = 1;
		
			while (list($key, $id) = each($arrEventIds)) {
				if (!$limitEvents || ($count<=$limitEvents)) {
					if (!$displayEventInList || $displayEventInList[$id]==1) {
						$state = $this->addEvent($id,$objLoader);
						if ($debugme && $state==0) {
							debug("Failed to load Event with id " . $id);
						}
					}
				}
				$count++;
			}
			reset($this->arrEvents);
		}
	}

	/**
	 * This function initialise one single event and add it to the internal array for later usage.
	 *
	 * @param	integer		$eventId : The id of the event you want to add.
	 * @param	[type]		$objLoader: ...
	 * @return	[type]		...
	 */
	function addEvent($eventId,&$objLoader) {
		if (!is_array($this->arrEvents)) {
			$this->arrEvents = Array();
		}
		if (!$this->arrEvents[$eventId]) {
			$this->arrEvents[$eventId] =& $objLoader->get_Event($eventId);
		}
		return ($this->arrEvents[$eventId]?1:0);
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$value: ...
	 * @return	[type]		...
	 */
	function set_arrTeachingaids($value){
		$this->arrTeachingaids = $value;
	}

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	function &get_arrTeachingaids(){
		return $this->arrTeachingaids;
	}

	/**
	 * To set the array with conditional courses.
	 *
	 * @param	[type]		$value: ...
	 * @return	[type]		...
	 */
	function set_arrConditions($value){
		$this->arrConditions = $value;
	}

	/**
	 * Returns an array with already initialized conditional courses.
	 *
	 * @return	[type]		...
	 */
	function &get_arrConditions(){
		return $this->arrConditions;
	}

	/**
	 * If you call this with "1" this course will load only the next event, when load_arrEvents is called. You have to call this BEFORE you call load_arrEvents.
	 *
	 * @param	integer		$val Set this to 1 or 0 || true or false
	 * @return	[type]		...
	 */
	function setDisplayNextEventOnly($val) {
		$this->displayNextEventOnly = $val;
	}

	/**
	 * This function render the view for this course, depending on the given template. Initialised events are rendered too.
	 *
	 * @param	string		$template : The remplate for rendering the view.
	 * @param	string		&$cObj : A reference to the cObj of the pi1 class who wants to render this view.
	 * @param	string		$conf	: A snippet of TS configuration which should be used for this course.
	 * @return	[type]		...
	 */
	function printme($template, &$view, $conf) {
		$debugme = false;
		$MA = Array();

		$templateEvents = $view->cObj->getSubpart($template, '###EVENTS###');
		$templateTeachingaids = $view->cObj->getSubpart($template, '###TEACHINGAIDS###');
		$templateTrainers = $view->cObj->getSubpart($template, '###TRAINERS###');
		$templateConditions = $view->cObj->getSubpart($template, '###CONDITIONS###');
		$templateFiles = $view->cObj->getSubpart($template,'###FILES###');

		//Daten (Kurs) wrappen und im MA ablegen.
		$MA['###COURSEUID###']    = ($this->getSingleData(self::UID)!=''?$this->getSingleData(self::UID):'');
		$MA['###NUMBER###']       = ($this->getSingleData(self::NUMBER)!=''?$view->cObj->stdWrap($this->getSingleData(self::NUMBER), $conf['courseNumberWrap.']):'');
		$MA['###TITLE###']        = ($this->getSingleData(self::TITLE)!=''?$view->cObj->stdWrap($this->getSingleData(self::TITLE), $conf['courseTitleWrap.']):'');
		$MA['###SUBTITLE###']     = ($this->getSingleData(self::SUBTITLE)!=''?$view->cObj->stdWrap($this->getSingleData(self::SUBTITLE), $conf['courseSubtitleWrap.']):'');
		$MA['###TEASER###']       = ($this->getSingleData(self::TEASER)!=''?$view->cObj->stdWrap($view->cObj->parseFunc($this->getSingleData(self::TEASER), $conf['parseFunc.']), $conf['courseTeaserWrap.']):'');
		$MA['###DESCRIPTION###']  = ($this->getSingleData(self::DESCRIPTION)!=''?$view->cObj->stdWrap($view->cObj->parseFunc($this->getSingleData(self::DESCRIPTION), $conf['parseFunc.']), $conf['courseDescriptionWrap.']):'');
		$MA['###EDUPOINTS###']    = (intval($this->getSingleData(self::EDUPOINTS))>0?$view->cObj->stdWrap($this->getSingleData(self::EDUPOINTS), $conf['courseEdupointsWrap.']):$view->pi_getLL('novalue'));
		$MA['###CONTINGENT###']   = ($this->getSingleData(self::CONTINGENT)!=''?$view->cObj->stdWrap($this->getSingleData(self::CONTINGENT), $conf['courseContingentWrap.']):$view->pi_getLL('novalue'));
		$MA['###DAYS###']         = ($this->getSingleData(self::DAYS)!=''?$view->cObj->stdWrap($this->getSingleData(self::DAYS), $conf['courseDaysWrap.']):'');
		$MA['###DAYSLABEL###']    = ($this->getSingleData(self::DAYS)!=''?$view->cObj->stdWrap((intval($this->getSingleData(self::DAYS))>1?$view->pi_getLL('labeldays'):$view->pi_getLL('labelday')), $conf['courseDayslabelWrap.']):'');
		$MA['###CONDITIONSTEXT###']   = ($this->getSingleData(self::CONDITIONS)!=''?$view->cObj->stdWrap($view->cObj->parseFunc($this->getSingleData(self::CONDITIONS), $conf['parseFunc.']), $conf['courseConditionWrap.']):'');
		$MA['###DETAILLINK###']   = ($this->getSingleData(self::UID)!=''?$view->cObj->stdWrap(
            $view->pi_LinkToPage($view->pi_getLL('coursedetaillinklabel'),
            $view->conf['pidCourseDetails'],'',
            array($view->prefixId. '[courseId]'=>$this->getSingleData(self::UID)))
            ,$conf['courseDetaillinkWrap.']):'');

		
		$MA['###TITLELINK###']   = (($this->getSingleData(self::UID)!='')&&($this->getSingleData(self::TITLE)!='')?$view->cObj->stdWrap(
            $view->pi_LinkToPage($this->getSingleData(self::TITLE),
            $view->conf['pidCourseDetails'],'',
            array($view->prefixId. '[courseId]'=>$this->getSingleData(self::UID)))
            ,$conf['courseTitlelinkWrap.']):'');

		$MA['###NUMBERLINK###']   = (($this->getSingleData(self::UID)!='')&&($this->getSingleData(self::NUMBER)!='')?$view->cObj->stdWrap(
            $view->pi_LinkToPage($this->getSingleData(self::NUMBER),
            $view->conf['pidCourseDetails'],'',
            array($view->prefixId. '[courseId]'=>$this->getSingleData(self::UID)))
            ,$conf['courseNumberlinkWrap.']):'');

		//This only for calculating the costs for each single Event later.
		$MA['###COST###']         = ($this->getSingleData(self::COST)?$this->getSingleData(self::COST):'');

		if (is_numeric($MA['###COST###']) && (intval($MA['###COST###'])!=0)) {
			//Base price with and without tax
			$price = doubleval($MA['###COST###']);
			$MA['###BASEPRICE###'] = $view->cObj->stdWrap($view->calcPrice($price,$view->conf,0),$conf['basepriceWrap.']);
			$MA['###BASEPRICETAX###'] = $view->cObj->stdWrap($view->calcPrice($price,$view->conf,1),$conf['basepricetaxWrap.']);
		} else {
			$MA['###BASEPRICE###'] = '0';
			$MA['###BASEPRICETAX###'] = '0';
		}


		$sImage = $conf['courseSkillImageWrap.'];
		$sImage['if.']['isTrue'] = ($this->getSingleData(self::SKILLLEVEL)!=''?1:0);
		$sImage['file'] = $view->skillimagepath . 'icon_tx_abcourses_skillLevel_' . $this->getSingleData(self::SKILLLEVEL) . '.gif'; //Dateipfad zusammensetzen

		if($debugme) {
			debug($view->skillimagepath);
			debug($this->getSingleData(self::SKILLLEVEL));
			debug($sImage['file']);
		}

		$sImage = $view->cObj->IMAGE($sImage);
		$MA['###COURSESKILLLEVELIMAGE###'] = ($this->getSingleData(self::SKILLLEVEL)!=''?$sImage:'');


		//MA mit Type auffüllen
		if ($this->getSingleData(self::UID)!='') {
			$view->fillTypeMA($MA,$conf,'','',$this->getSingleData(self::UID));
		}

		if($debugme) {debug($MA);}

		$events = '';

		$foo = ($debugme?debug("Events loaded: " . $this->countEvents()):'');
		
		//should we trigger the view of some events too?
		if($this->countEvents() && $templateEvents) {
			$templateEvent = $view->cObj->getSubpart($templateEvents, '###EVENT###');
			
			$event = '';
			reset($this->arrEvents);
			while (list($id, $Event) = each($this->arrEvents)) {
				$event .= $Event->printme($templateEvent,$view,$conf['event.'],$this->getSingleData(self::COST));
			}
			$events = $view->cObj->substituteSubpart($templateEvents,'###EVENT###',$event);
		}

		$template = $view->cObj->substituteSubpart($template,'###EVENTS###',$events);


		//should we trigger the view of some teaching aids too?
		$foo = ($debugme?debug("Teaching aids loaded: " . $this->countTeachingaids()):'');
		$teachingaids = '';

		if($this->countTeachingaids() && $templateTeachingaids) {
			$templateTeachingaid = $view->cObj->getSubpart($templateTeachingaids, '###TEACHINGAID###');
			$teachingaid = '';
			reset($this->arrTeachingaids);
			while (list($id, $Teachingaid) = each($this->arrTeachingaids)) {
				$teachingaid .= $Teachingaid->printme($templateTeachingaid,$view);
			}
			$teachingaids = $view->cObj->substituteSubpart($templateTeachingaids,'###TEACHINGAID###',$teachingaid);
		}
		$template = $view->cObj->substituteSubpart($template,'###TEACHINGAIDS###',$teachingaids);

		//should we trigger the view of some trainers too?
		$foo = ($debugme?debug("Trainer loaded: " . $this->countTrainer()):'');
		$trainers = '';

		if($this->countTrainer() && $templateTrainers) {
			$templateTrainer = $view->cObj->getSubpart($templateTrainers, '###TRAINER###');
			$trainer = '';
			reset($this->arrTrainer);
			while (list($id, $Trainer) = each($this->arrTrainer)) {
				$trainer .= $Trainer->printme($templateTrainer,$view,$conf['trainer.']);
			}
			$trainers = $view->cObj->substituteSubpart($templateTrainers,'###TRAINER###',$trainer);
		}
		$template = $view->cObj->substituteSubpart($template,'###TRAINERS###',$trainers);


		//should we trigger the view of some conditional courses as well?
		$conditions = '';
		$foo = ($debugme?debug("Conditions loaded: " . $this->countConditions()):'');
		if($this->countConditions() && $templateConditions) {
			$templateConditionalCourse = $view->cObj->getSubpart($templateConditions, '###COURSE###');
			$condition = '';
			reset($this->arrConditions);
			while (list($id, $conditionalCourse) = each($this->arrConditions)) {
				$condition .= $conditionalCourse->printme($templateConditionalCourse,$view,$conf['conditionalCourse.']);
			}
			$conditions = $view->cObj->substituteSubpart($templateConditions,'###COURSE###',$condition);
		}

		$template = $view->cObj->substituteSubpart($template,'###CONDITIONS###',$conditions);


		//Load the Download-Files
		$filenames = $this->getSingleData("files");
		$files = '';
		$file = '';

		if ($filenames && $templateFiles) {
			$fileTemplate = $view->cObj->getSubpart($templateFiles, '###FILE###');
			$filenames = explode(",",$filenames);
			foreach($filenames as $id => $filename) {
				$dlimage = $view->conf['dlimage_' . substr($filename,strlen($filename)-3)];
				$dlimage = ($dlimage?$dlimage:$view->conf['dlimage']);
				$MAFile['###DOWNLOADLINK###'] = "<a href=\"/" . $view->conf['uploaddir'] . $filename . "\" title=\"Download-Link\">" . $filename . "</a>";
				$MAFile['###DOWNLOADLINKIMAGE###'] = "<a href=\"/" . $view->conf['uploaddir'] . $filename . "\" title=\"Download-Link\"><img src=\"" . $dlimage . "\" border=\"0\" alt=\"Download " . $filename . "\"/></a>";
				$file .= $view->cObj->substituteMarkerArray($fileTemplate,$MAFile);
			}
			$files = $view->cObj->substituteSubpart($templateFiles,'###FILE###',$file);
		}
		$template = $view->cObj->substituteSubpart($template,'###FILES###',$files);

		//render and return the view
		return $view->cObj->substituteMarkerArrayCached($template, $MA);
	}
}
?>