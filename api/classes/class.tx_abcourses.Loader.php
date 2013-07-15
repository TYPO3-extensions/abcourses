<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2006 Stefan Precht (sprecht@gmx.de)
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
 * This is the persistence proxy class for abcourses... Use this class to get instances of different classes.
 *
 */
class cLoader {
    var $conf = '';
    var $pages = '';
    var $recursive = '';
    var $cObj = '';
    var $DAL = '';

    var $objCategorys = '';	//An instance of CCategorys
    var $objLocations = ''; //An instance of CLocations
    var $arrCourses = '';	//container for currently initialised courses
    var $arrEvents = '';//container for currently initialised events
    var $arrTrainer = '';	////container for currently initialised trainer
    var $arrLocation = '';	////container for currently initialised location records
    var $arrTeachingaids = '';//container for currently initialised teaching aids
    var $arrHotels = '';//container for currently initialised hotels
    var $arrArrangements = '';//container for currently initialised arrangements
    var $arrCategories = '';//container for currently initialised categories
    var $arrParticipants = ''; //container for currently initialized participants

    /**
     * To initialise the proxy class. Normally this is already done by the pi1 class.
     *
     * @param	array		$conf	TS configuration
     * @param	string		$pages	list of page id's to look up records from
     * @param	integer		$recursive	recursive level
     * @param	tslib_cobj		$cObj	Instance of an tslib_cobj instance. Usually the instance as used by the pi1 class.
     * @return	void
     */
    function init($conf,$pages,$recursive,&$cObj){
        $this->set_conf($conf);
        $this->set_pages($pages);
        $this->set_recursive($recursive);
        $this->set_cObj($cObj);
        $this->set_DAL(t3lib_div::makeInstance('cAbcoursesDAL')); // Initialise Data Access Layer
        $this->DAL->init($this->conf,$this->pages,$this->recursive,$this->cObj);
    }

    /**
     * This function initialise the internal attribute $objLocations
     *
     * @return	integer		Returns 1 for success and 0 if an error occured
     */
    function load_objLocations(){
        if (!$this->objLocations) {
            $objLocations = new cLocations();
            $objLocations->init($this);
            $objLocations->loadData($this);
            if (!$objLocations->fError) {
                //nur übernehmen, wenn fehlerfrei
                $this->set_objLocations($objLocations);
            } else {
                return 0;
            }
        }
        return 1;
    }
    /**
     * This function initialise the internal attribute $objCategorys
     *
     * @return	integer		Returns 1 for success and 0 if an error occured
     */
    function load_objCategorys(){
        //in cLoader hinterlegte Instanz von cCategorys initialisieren
        if (!$this->objCategorys) {
            $objCategorys = t3lib_div::makeInstance('cCategorys');
            $objCategorys->init($this->DAL);
            $objCategorys->loadData($this->DAL);
            if (!$objCategorys->fError) {
                //nur übernehmen, wenn fehlerfrei
                $this->set_objCategorys($objCategorys);
            } else {
                return 0;
            }
        }
        return 1;
    }

    /**
     * Returns an array with uid's of similar courses.
     *
     * @param	string		$byTitle	Similar courses are looked up with an title.
     * @param	unknown_type		$expectId	The integer passed for this will not be included in the returned integer list.
     * @return	array		Array with uid's of similar courses.
     */
    function listSimilarCourses($byTitle,$expectId='') {
        $retArr = $this->DAL->listCourses('',$byTitle,$expectId);

        if (is_array($retArr) && !$this->DAL->fError) {
            return $retArr;
        }
    }

    /**
     * Returns an array with uid's for events marked as last minute.
     *
     * @param	integer		$maxNEvents Set this to the amount of events you want to get. If this results in false, all last minute events should be returned.
     * @return array		Array with uid's of last minute events.
     */
    function listLastMinuteEvents($eventsAgo=0,$maxNEvents=0) {
        $ret = $this->DAL->listEvents('',$eventsAgo,1,$maxNEvents);
        return $ret;
    }

    /**
     * Initialize the internal course array. You can use this, if you want to load some courses without an instance of cCategorys.
     *
     * @param	integer		$courseId: The id of a course you want add to the internal array.
     * @param	integer		$eventId: The id of an event you want to use to load the corresponding course into the internal array.
     * @return	[type]		...
     */
    function load_arrCourses($courseId='',$eventId='') {
        if ($courseId!='') {
            $foo = $this->get_Course($courseId,'');
        } elseif ($eventId!='') {
            $foo = $this->get_Course('',$eventId);
        } else {
            return 0;
        }
        return 1;
    }

    /**
     * Set function for an internal value
     *
     * @param	unknown_type		$value
     * @return	[type]		...
     */
    function set_conf($value){
        $this->conf = $value;
    }

    /**
     * Set function for an internal value
     *
     * @param	unknown_type		$value
     * @return	[type]		...
     */
    function set_pages($value){
        $this->pages = $value;
    }

    /**
     * Set function for an internal value
     *
     * @param	unknown_type		$value
     * @return	[type]		...
     */
    function set_recursive($value){
        $this->recursive = $value;
    }

    /**
     * Set function for an internal value
     *
     * @param	unknown_type		$value
     * @return	[type]		...
     */
    function set_cObj($value){
        $this->cObj = $value;
    }

    /**
     * Set function for an internal value
     *
     * @param	unknown_type		$value
     * @return	[type]		...
     */
    function set_DAL(&$value){
        $this->DAL = $value;
    }

    /**
     * This returns an reference of the used data abstraction layer class
     *
     * @return	cAbcoursesDAL
     */
    function &get_DAL(){
        return $this->DAL;
    }

    /**
     * Set function for an internal value
     *
     * @param	unknown_type		$value
     * @return	[type]		...
     */
    function set_objCategorys($value) {
        $this->objCategorys = $value;
        $GLOBALS['T3_VAR']['abcourses']['cCategorys'] =& $this->objCategorys;
        return;
    }

    /**
     * Returns an reference of the internal cCategorys instance. If not available, the instance will be initialised.
     *
     * @return	cCategorys		Returns 0 if an error occured
     */
    function &get_objCategorys(){
        if (!$this->objCategorys) {
            $this->load_objCategorys();
        }
        if ($this->objCategorys && $GLOBALS['T3_VAR']['abcourses']['cCategorys']) {
            return $GLOBALS['T3_VAR']['abcourses']['cCategorys'];
        }
        return 0;
    }

    /**
     * Set function for an internal value
     *
     * @param	unknown_type		$value
     * @return	[type]		...
     */
    function set_objLocations($value) {
        $this->objLocations = $value;
    }

    /**
     * Returns an reference of the internal cLocations instance. If not available, the instance will be initialised.
     *
     * @return	cLocations
     */
    function &get_objLocations() {
        if (!$this->objLocations) {
            $this->load_objLocations();
        }
        if ($this->objLocations) {
            return $this->objLocations;
        }
        return 0;
    }

    /**
     * Set function for an internal value
     *
     * @param	unknown_type		$value
     * @return	[type]		...
     */
    function set_arrCourses($value){
        $this->arrCourses = $value;
    }

    /**
     * This returns a reference to a course instance, corresponding to the passed uid or eventId. If an eventId is passed, this will lookup the corresponding course an add the event to the internal event array of the returned course instance.
     *
     * @param	integer		$uid	Id of the course you want to load. If an eventId is passed also, this value takes precedence.
     * @param	integer		$eventId	Id of a corresponding event.
     * @return	cCourse
     */
    function &get_Course($uid='',$eventId=''){
        $debugme = false;
        $objCourse = '';
        if ($uid!='') {
            $foo = ($debugme?debug("Get Course with uid " . $uid):'');
            if (!$this->arrCourses[$uid]) {
                $objCourse = new cCourse;
                $objCourse->loadData($uid,'',$this->DAL);
            }
        } elseif($eventId!='') {
            $foo = ($debugme?debug("Get Course with eventId " . $eventId):'');
            $objCourse = new cCourse;
            $objCourse->loadData('',$eventId,$this->DAL);
            if (!$objCourse->fError) {
                $uid = $objCourse->getSingleData('uid');
                if ($this->arrCourses[$uid]) {
                    $foo = ($debugme?debug("Course with uid " . $uid . " already initialised"):'');
                    $objCourse = '';
                    $objCourse =& $this->get_Course($uid);
                }
                $objCourse->load_arrEvents($this,0,Array($eventId => "1"));
            }
        }
        if ($objCourse!=''){
            if (!$objCourse->fError) {
                $GLOBALS['T3_VAR']['abcourses']['cCourse'][$uid] =& $objCourse;
                $this->arrCourses[$uid] =& $GLOBALS['T3_VAR']['abcourses']['cCourse'][$uid];
            }
        }

        if ($this->arrCourses[$uid] && !$this->DAL->fError) {
            return $this->arrCourses[$uid];
        } else {
            return 0;
        }
    }

    /**
     * Returns an instance of cEvent, corresponding to the passed $uid.
     *
     * @param	integer		$uid	Uid of the event you want to return...
     * @return	cEvent
     */
    function &get_Event($uid){
        $debugme = false;
        $foo = ($debugme?debug("Get Event " . $uid):'');
        if (!$this->arrEvents[$uid]) {
            $objEvent = t3lib_div::makeInstance('cEvent');
            $objEvent->loadData($uid,$this->DAL);
            $foo = ($debugme?debug($objEvent):'');
            if (!$objEvent->fError) {
            	//TODO Fehlt hier vielleicht etwas wie: $objEvent->loadLocation($this); ??
                $GLOBALS['T3_VAR']['abcourses']['cEvent'][$uid] =& $objEvent;
                $this->arrEvents[$uid] =& $GLOBALS['T3_VAR']['abcourses']['cEvent'][$uid];
            }
        }
        $foo = ($debugme?debug($this->DAL):'');

        if ($this->arrEvents[$uid] && !$this->DAL->fError) {
            return $this->arrEvents[$uid];
        } else {
            return 0;
        }
    }

    /**
     * Returns an instance of cCategory, corresponding to the passed $uid.
     *
     * @param	integer		$uid	Uid of the category you want to return...
     * @return	cCategory
     */
    function &get_Category($uid){
        $debugme = false;
        $foo = ($debugme?debug("Get category " . $uid):'');
        if (!$this->arrCategories[$uid]) {
            $Category = t3lib_div::makeInstance('cCategory');
            $Category->loadData($uid,'',$this->DAL);
            if (!$Category->fError) {
                $GLOBALS['T3_VAR']['abcourses']['cCategory'][$uid] =& $Category;
                $this->arrCategories[$uid] =& $GLOBALS['T3_VAR']['abcourses']['cCategory'][$uid];
            }
        }

        if ($this->arrCategories[$uid] && !$this->DAL->fError) {
            return $this->arrCategories[$uid];
        } else {
            return 0;
        }
    }

    /**
     * Returns an instance of cTrainer, corresponding to the passed $uid or $eventId.
     *
     * @param	integer		$trainerId Id of the trainer you want to get.
     * @param	integer		$eventId Id of the event you want to get the corresponding trainer for.
     * @return	cTrainer
     */
    function &get_Trainer($trainerId='',$eventId=''){
        $debugme = false;
        $foo = ($debugme?debug("Get Trainer " . $trainerId):'');
        $objTrainer = '';

        if ($trainerId != '') {
            if (!$this->arrTrainer[$trainerId]) {
                $objTrainer = new cTrainer();
                $objTrainer->loadData($trainerId,'',$this->DAL);
            }
        } elseif($eventId!='') {
            $objTrainer = new cTrainer();
            $objTrainer->loadData('',$eventId,$this->DAL);
            if (!$objTrainer->fError) {
                $trainerId = $objTrainer->getSingleData('uid');
            }
        }

        if ($objTrainer!='') {
            if (!$objTrainer->fError) {
                $GLOBALS['T3_VAR']['abcourses']['cTrainer'][$trainerId] =& $objTrainer;
                $this->arrTrainer[$trainerId] =& $GLOBALS['T3_VAR']['abcourses']['cTrainer'][$trainerId];
            }
        }

        if ($this->arrTrainer[$trainerId] && !$this->DAL->fError) {
            return $this->arrTrainer[$trainerId];
        } else {
            return 0;
        }
    }

    /**
     * Returns an instance of cParticipant, corresponding to the passed $uid.
     *
     * @param	integer		$participantId Id of the participant you want to receive.
     * @return	cParticipant
     */
    function &get_Participant($participantId=''){
        $debugme = false;
        $foo = ($debugme?debug("Get Participant " . $participantId):'');
        $objParticipant = '';

        if ($participantId != '') {
            if (!$this->arrParticipants[$participantId]) {
                $objParticipant = new cParticipant();
                $objParticipant->loadData($participantId, $this->DAL);
            }
        }

        if ($objParticipant!='') {
            if (!$objParticipant->fError) {
                $GLOBALS['T3_VAR']['abcourses']['cParticipant'][$participantId] =& $objParticipant;
                $this->arrParticipants[$participantId] =& $GLOBALS['T3_VAR']['abcourses']['cParticipant'][$participantId];
            }
        }

        if ($this->arrParticipants[$participantId] && !$this->DAL->fError) {
            return $this->arrParticipants[$participantId];
        } else {
            return 0;
        }
    }

    function &get_ParticipantByUniqueField($field, $value) {
		if ($field!=null && $value!=null && $value!="") {
			$id = $this->DAL->get_ParticipantIdByUniqueField($field,$value);
			if ($id!=null) {
				return $this->get_Participant($id);
			}
		}
    	return null;
    }

    /**
     * Returns an instance of cLocation, corresponding to the passed $uid or $eventId.
     *
     * @param	integer		$locationId Id of the location you want to get.
     * @param	integer		$eventId Id of the event you want to get the corresponding location for.
     * @return	cLocation
     */
    function &get_Location($locationId='',$eventId=''){
        $debugme = false;
        $foo = ($debugme?debug("Get Location " . $locationId):'');
        $Location = '';

        if ($locationId != '') {
            if (!$this->arrLocation[$locationId]) {
                $Location = new cLocation;
                $Location->loadData($locationId,'',$this->DAL);
            }
        } elseif($eventId!='') {
            $Location = new cLocation;
            $Location->loadData('',$eventId,$this->DAL);
            if (!$Location->fError) {
                $locationId = $Location->getSingleData('uid');
            }
        }

        if ($Location!='') {
            if (!$Location->fError) {
                $GLOBALS['T3_VAR']['abcourses']['cLocation'][$locationId] =& $Location;
                $this->arrLocation[$locationId] =& $GLOBALS['T3_VAR']['abcourses']['cLocation'][$locationId];
            }
        }

        if ($this->arrLocation[$locationId] && !$this->DAL->fError) {
            return $this->arrLocation[$locationId];
        } else {
            return 0;
        }
    }

    /**
     * Returns an instance of cTeachingaid, corresponding to the passed $uid.
     *
     * @param	integer		$uid	The uid of the record you want to get the object for.
     * @return	cTeachingaid
     */
    function &get_Teachingaid($uid){
        $debugme = false;
        $foo = ($debugme?debug("Get teaching aid " . $uid):'');
        if (!$this->arrTeachingaids[$uid]) {
            $objTeachingaid = t3lib_div::makeInstance('cTeachingaid');
            $objTeachingaid->loadData($uid,$this->DAL);
            if (!$objTeachingaid->fError) {
                $GLOBALS['T3_VAR']['abcourses']['cTeachingaid'][$uid] =& $objTeachingaid;
                $this->arrTeachingaids[$uid] =& $GLOBALS['T3_VAR']['abcourses']['cTeachingaid'][$uid];
            }
        }

        if ($this->arrTeachingaids[$uid] && !$this->DAL->fError) {
            return $this->arrTeachingaids[$uid];
        } else {
            return 0;
        }

        return " ";
    }

    /**
     * Returns an instance of cHotel, corresponding to a passed hotelId or arrangementId
     *
     * @param	integer		$hotelId	Id of the hotel record you want to get the object for. This takes precedence, if an arrangementId is passed too.
     * @param	integer		$arrangementId	Id of an arrangement you want to get the corresponding hotel for.
     * @return	cHotel
     */
    function &get_Hotel($hotelId='',$arrangementId=''){
        $debugme = false;
        $foo = ($debugme?debug("Get Hotel " . $hotelId . " or Arrangement " . $arrangementId):'');
        $objHotel = '';

        if ($hotelId != '') {
            if (!$this->arrHotels[$hotelId]) {
                $objHotel = new cHotel;
                $objHotel->loadData($hotelId,'',$this->DAL);
            }
        } elseif($arrangementId!='') {
            $objHotel = new cHotel;
            $objHotel->loadData('',$arrangementId,$this->DAL);
            $foo = ($debugme?debug("Error while loading hotel?: " . $objHotel->fError):'');
            if (!$objHotel->fError) {
                $hotelId = $objHotel->getSingleData('uid');
                $foo = ($debugme?debug($hotelId):'');
                //check if this hotel was initialised before
                if($this->arrHotels[$hotelId]){
                    //throw the current hotel into the garbage and get the already initialised one
                    $foo = ($debugme?debug("Hotel with id " . $hotelId . " already initialised."):'');
                    $objHotel='';
                    $objHotel =& $this->get_Hotel($hotelId);
                }
                //add the arrangement wich was used to get this hotel to the hotel-internal arrangement array
                $objHotel->addArrangement($arrangementId,$this);
            } else {
                $foo = ($debugme?debug($this->DAL->arrStatus):'');
            }

        }

        if ($objHotel!='') {
            if (!$objHotel->fError) {
                $GLOBALS['T3_VAR']['abcourses']['cHotel'][$hotelId] =& $objHotel;
                $this->arrHotels[$hotelId] =& $GLOBALS['T3_VAR']['abcourses']['cHotel'][$hotelId];
            }
        }

        if ($this->arrHotels[$hotelId] && !$this->DAL->fError) {
            return $this->arrHotels[$hotelId];
        } else {
            return 0;
        }
    }

    /**
     * Returns one instance of cArrangement with the given id
     *
     * @param	integer		$uid	: The id of the arrangement wich should be initialised an returned
     * @return	cArrangement
     */
    function &get_Arrangement($uid){
        $debugme = false;
        $foo = ($debugme?debug("Get Arrangement " . $uid):'');
        if (!$this->arrArrangements[$uid]) {
            $objArrangement = new cArrangement;
            $objArrangement->loadData($uid,$this->DAL);
            if (!$objArrangement->fError) {
                $GLOBALS['T3_VAR']['abcourses']['cArrangement'][$uid] =& $objArrangement;
                $this->arrArrangements[$uid] =& $GLOBALS['T3_VAR']['abcourses']['cArrangement'][$uid];
            }
        }

        if ($this->arrArrangements[$uid] && !$this->DAL->fError) {
            return $this->arrArrangements[$uid];
        } else {
            return 0;
        }

        return " ";
    }

}
?>