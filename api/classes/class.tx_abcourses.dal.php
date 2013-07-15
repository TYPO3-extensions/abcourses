<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2006-2013 Stefan Precht (stprecht@gmail.com)
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
 * Data access layer for abcourses. Tested with MySQL as Database. You can change this, if you want to connect the abcourses plugin with other applications.
 * Please consider, that this is only related to the front-end!
 * If you change this file, the records as entered in the back end of TYPO3 may not be shown with the FE plugin. May be it would be nice then, to disable the corresponding records in the BE.
 *
 * Do not change parameters or return values of the cAbcoursesDAL functions. If you do this anyway, you have to change the pi1 class and may be any class in the classes folder.
 *
 * @author	Stefan Precht <sprecht@gmx.de>
 */

require_once(t3lib_extMgm::extPath('abcourses').'api/util/class.tx_abcourses.utils.php');

class cAbcoursesDAL extends tslib_pibase {
	var $conf = '';
	var $pages = '';
	var $recursive = '';
	var $cObj = '';

	var $fError = '';
	var $arrStatus = '';

	/**
	 * This is to initalise the DAL. Passed variables are TYPO3 specific. Dont change this parameters.
	 *
	 * @param	array		$conf	TS configuration
	 * @param	string		$pages	List of page ids where seminar records could be saved
	 * @param	integer		$recursive	Level of nested pages
	 * @param	tslib_conf		$cObj	A reference to the tslib_cobj instance of the pi1 class.
	 * @return	[type]		...
	 */
	function init($conf,$pages,$recursive,&$cObj){
		$this->conf = $conf;
		$this->pages = $pages;
		$this->recursive = $recursive;
		$this->cObj = $cObj;
	}

	/**
	 * Resets the error flag and the message array.
	 *
	 * @return	void
	 */
	function reset() {
		$this->fError = '';
		$this->arrStatus = '';
	}


	//+++++++++++++++++++++++++++++++++++//
	//+++++++++++ CATEGORIES +++++++++++++//
	//+++++++++++++++++++++++++++++++++++//
	/**
	* This function must return an array containing the unique id's of available categories. The id's should be of integer.
	*
	* @return	array		Must be in the format key => value where key is an counter and value the id of a category
	*/
	function listCategorys() {
		$this->reset();

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
    	 				       'uid',
    					       'tx_abcourses_categorie',
    							   'pid IN (' .$this->pi_getPidList(
		$this->pages,
		$this->recursive
		) . ')' .$this->cObj->enableFields('tx_abcourses_categorie'),'','sorting'
		);
		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$ret[] = $data['uid'];
				}
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->listCategorys.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listCategorys.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}

	}

	/**
	 * This function must return an array containing the unique id of a category. This function must work with corresponding course id's too!
	 *
	 * @param	integer		$byUid Unique id of an category
	 * @param	integer		$byCourseId Unique id of an course
	 * @return	array		Must be in the format fieldname => value where fieldname must be uid and value the id of a category.
	 */
	function loadCategory($byUid='',$byCourseId='') {
		$this->reset();

		if ($byCourseId!=''){
		}

		if ($byUid != '') {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                               'uid,title,teaser,image',
                               'tx_abcourses_categorie',
                                   'pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->recursive
			) . ')' .$this->cObj->enableFields('tx_abcourses_categorie') . " AND uid='" . intval($byUid) . "'",'','sorting'
			);
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				$ret = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				return $ret;
			}   else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->loadCategory.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->loadCategory.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}


	//++++++++++++++++++++++++++++++++++//
	//+++++++++++ COURSES ++++++++++++++//
	//++++++++++++++++++++++++++++++++++//

	/**
	 * This function must return a list of course id's. The course id's can be looked up with different values.
	 *
	 * @param	integer		$byCategoryId An id of a category a course could be associated with...
	 * @param	string		$bySimilarTitle
	 * @param	integer		$expectCourseId
	 * @return	array		Must be in the format key => value where key is an counter and value the id of a course
	 */
	function listCourses($byCategoryId='',$bySimilarTitle='', $expectCourseId = ''){
		$this->reset();

		if ($byCategoryId) {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query('tx_abcourses_course.uid AS uid',
                             'tx_abcourses_course',
                             'tx_abcourses_course_categorie_mm',
                             'tx_abcourses_categorie',
                             'AND tx_abcourses_course.pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->recursive
			) . ')
                                AND  tx_abcourses_course_categorie_mm.uid_foreign = ' . intval($byCategoryId) . ' ' . $this->cObj->enableFields('tx_abcourses_course'),
                                '',
                                'tx_abcourses_course.sorting',
                                ''
                                );
		}elseif($bySimilarTitle) {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                   'uid',
                   'tx_abcourses_course',
                       'pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->recursive
			) . ')' .$this->cObj->enableFields('tx_abcourses_course') .
                       " AND title LIKE '%" . $GLOBALS['TYPO3_DB']->quoteStr($bySimilarTitle,'tx_abcourses_course') . "%' " . (intval($expectCourseId)?' AND uid != ' . intval($expectCourseId):''),'','sorting'
                       );
		} else {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                   'uid',
                   'tx_abcourses_course',
                       'pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->recursive
			) . ')' .$this->cObj->enableFields('tx_abcourses_course'),'','sorting'
			);
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$ret[] = $data['uid'];
				}
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->listCourses.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listCourses.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}

	/**
	 * This function must return a list of course id's. The course id's can be looked up with different values.
	 *
	 * @param	integer		$categoryId An id of a category a course could be associated with...
	 * @param	integer		$counter This is used as LIMIT value for the mysql statement an passed through the plugin TS configuration into this function.
	 * @return	array		Must be in the format key => value where key is an counter and value the id of a course
	 */
	function listCoursesWithNextEvents($categoryId='',$counter=1){
		$this->reset();

		//set time filter for events
		$datefilter = '';
		$time = time();
		$datefilter = ' AND tx_abcourses_event.coursestart >= ' . mktime(0, 0, 0, date('m', $time),date('d', $time),date('Y', $time));

		//Query $counter course uid's with the closest events
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
        		'DISTINCT tx_abcourses_course.uid',
                'tx_abcourses_course ' .
    		        'INNER JOIN tx_abcourses_event_course_mm ' .
    		        'ON tx_abcourses_event_course_mm.uid_foreign = tx_abcourses_course.uid ' .
    		        'INNER JOIN tx_abcourses_event ' .
    				'ON tx_abcourses_event.uid = tx_abcourses_event_course_mm.uid_local ' .
    		        'INNER JOIN tx_abcourses_course_categorie_mm '.
    				'ON  tx_abcourses_course_categorie_mm.uid_local = tx_abcourses_course.uid ' .
    		        'INNER JOIN tx_abcourses_categorie ' .
    		        'ON tx_abcourses_categorie.uid = tx_abcourses_course_categorie_mm.uid_foreign ',
				'tx_abcourses_course.pid IN (' .$this->pi_getPidList(
		                $this->pages,
		                $this->recursive
		            ) . ')' .
		            $this->cObj->enableFields('tx_abcourses_course') .
		            $this->cObj->enableFields('tx_abcourses_event') . ' ' .
                    'AND tx_abcourses_categorie.uid = '. intval($categoryId) . ' ' .
		            $datefilter,
                '',
                'tx_abcourses_event.coursestart',
		        $counter
		);

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$ret[] = $data['uid'];
				}
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->listCoursesWithNextEvents.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listCoursesWithNextEvents.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}

	/**
	 * This must return an array with all course data. The array must be an associatve array where the array key is the attribute name and the array value the attribute it self.
	 * The array key must related to the default attribute names in the mysql db as delivered with the default abcourses installation.
	 *
	 * @param	integer		$byUid The unique id of the course you would like to get the attributes for.
	 * @param	integer		$byEventId To get the the course id for the corresponding event id.
	 * @return	array
	 */
	function loadCourse($byUid='',$byEventId='') {
		$this->reset();

		if ($byEventId!=''){
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query (
                'tx_abcourses_course.*',
                'tx_abcourses_event',
                'tx_abcourses_event_course_mm',
                'tx_abcourses_course',
                 $this->cObj->enableFields('tx_abcourses_course') . '
                 AND tx_abcourses_event_course_mm.uid_local = ' . intval($byEventId) . '
                 AND tx_abcourses_course.uid = tx_abcourses_event_course_mm.uid_foreign'
                 );
		}

		if ($byUid != '') {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                'tx_abcourses_course.*',
                'tx_abcourses_course',
                'tx_abcourses_course.uid = ' . intval($byUid) . $this->cObj->enableFields('tx_abcourses_course')
			);
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				$ret = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->loadCourse.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->loadCourse.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}

	}


	//++++++++++++++++++++++++++++++++++//
	//++++++++++++ EVENTS ++++++++++++++//
	//++++++++++++++++++++++++++++++++++//

	/**
	 * Must return a list of related event id's.
	 *
	 * @param	integer		$byCourseId : Id of an course
	 * @param	integer		$showeventsago : If you would like to receive expired events too, set this to an appropriate number of days an event may have expired.
	 * @param	integer		$lastMinuteOnly : If this results in true, only lastMintue Events should be returned
	 * @param 	integer		$maxNEvents : Set this as LIMIT value for the SQL statement. This is only used in the last minute query.
	 * @return	array		Array key only as counter
	 */
	function listEvents($byCourseId='',$showeventsago = 0,$lastMinuteOnly = 0,$maxNEvents=0){
		$this->reset();

		if (!$maxNEvents) $maxNEvents = '';

		//Filter für Termine setzen. Termin darf $ago Tage zurückliegen.
		$datefilter = '';
		$ago = intval($showeventsago);
		$time = time()-($ago*24*3600);
		$datefilter = ' AND tx_abcourses_event.coursestart >= ' . mktime(0, 0, 0, date('m', $time),date('d', $time),date('Y', $time));

		if (is_numeric($byCourseId)) {
		  //Fixme Testen ob die Sortierung unten nu auch funzt...
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query (
                'tx_abcourses_event.uid',
                'tx_abcourses_event',
                'tx_abcourses_event_course_mm',
                'tx_abcourses_course',
                'AND tx_abcourses_event.pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->recursive
			) . ')' .$this->cObj->enableFields('tx_abcourses_event') . '
                 AND tx_abcourses_event_course_mm.uid_foreign = ' . intval($byCourseId) . $datefilter,
                 '',
                 'tx_abcourses_event.coursestart, tx_abcourses_event.firstdaytimestart'
			);
		} elseif($lastMinuteOnly) {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                        'tx_abcourses_event.uid',
                        'tx_abcourses_event',
                        'tx_abcourses_event.pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->recursive
			) . ')' . $this->cObj->enableFields('tx_abcourses_event') .
    					' AND tx_abcourses_event.lastminute <> 0 ' . $datefilter,
    				    '',
    				    'tx_abcourses_event.coursestart, tx_abcourses_event.firstdaytimestart',
			$maxNEvents
			);

		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$ret[] = $data['uid'];
				}
				return $ret;
			} else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->listEvents.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listEvents.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}

	}

	/**
	 * This function returns an indexed array with one event uid key=>value pair for a given course uid.
	 *
	 * @param	integer		$courseId The id of the course you would like to receive an event id for.
	 * @param	integer		$showeventsago If you would like to receive expired events too, set this to an appropriate number of days an event may have expired.
	 * @return	array		The key is the attribute uid and the value the received id.
	 */
	function listNextEventForCourse($courseId,$showeventsago = 0){
		$debugme = false;
		$this->reset();

		//TODO Remove that ago filter because it is nonsense within this method.
		//Filter für Termine setzen. Termin darf $ago Tage zurückliegen.
		$datefilter = '';
		$ago = intval($showeventsago);
		$time = time()-($ago*24*3600);
		$datefilter = ' AND tx_abcourses_event.coursestart >= ' . mktime(0, 0, 0, date('m', $time),date('d', $time),date('Y', $time));

		if (is_numeric($courseId)) {
			if ($debugme) {
				$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = 1;
			}
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query (
                'tx_abcourses_event.uid',
                'tx_abcourses_event',
                'tx_abcourses_event_course_mm',
                'tx_abcourses_course',
                'AND tx_abcourses_event.pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->recursive
			) . ')' .$this->cObj->enableFields('tx_abcourses_event') . '
                 AND tx_abcourses_event_course_mm.uid_foreign = ' . intval($courseId) . $datefilter,
                '',
                'tx_abcourses_event.coursestart',
                ''
                );
                if ($debugme) {
                	debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);
                }
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				$ret = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->listNextEventForCourse.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listNextEventForCourse.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}

	/**
	 * Returns the data of an event as associative array.
	 * The array keys must related to the default attribute names in the mysql db as delivered with the default abcourses installation.
	 *
	 * @param	integer		$eventId Id of the event
	 * @return	array
	 */
	function loadEvent($eventId='') {
		$this->reset();

		if ($eventId!=''){
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                'tx_abcourses_event.*',
                'tx_abcourses_event',
                'tx_abcourses_event.uid = ' . intval($eventId) . $this->cObj->enableFields('tx_abcourses_event')
			);
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				$ret = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->loadEvent.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->loadEvent.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}


	//++++++++++++++++++++++++++++++++++//
	//+++++++++++ LOCATION +++++++++++++//
	//++++++++++++++++++++++++++++++++++//

	/**
	 * Returns a list of the unique id's for all available loactions
	 *
	 * @return	array		Array key only as counter
	 */
	function listLocations() {
		$this->reset();

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
    	 				       'uid',
    					       'tx_abcourses_location',
    							   'pid IN (' .$this->pi_getPidList(
		$this->pages,
		$this->recursive
		) . ')' .$this->cObj->enableFields('tx_abcourses_location')
		);
		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$ret[] = $data['uid'];
				}
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->listLocations.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listLocations.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}

	}

	/**
	 * Returns the data of an location as associative array. The array must be an associatve array where the array key is the attribute name and the array value the attribute it self.
	 * The array key must related to the default attribute names in the mysql db as delivered with the default abcourses installation.
	 *
	 * @param	integer		$byUid To load the location data with an location id.
	 * @param	integer		$byEventId To load the location data corresponding to an special event.
	 * @return	unknown
	 */
	function loadLocation($byUid='',$byEventId='') {
		$this->reset();

		if ($byUid != '') {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                               'uid,title,street,zip,city,phone,fax,email,person,informations',
                               'tx_abcourses_location',
                                   'pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->recursive
			) . ')' .$this->cObj->enableFields('tx_abcourses_location') . " AND uid='" . intval($byUid) . "'",'','city, title'
			);
		} elseif ($byEventId!=''){
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query (
            	'tx_abcourses_location.uid,tx_abcourses_location.title,tx_abcourses_location.street,tx_abcourses_location.zip,tx_abcourses_location.city,tx_abcourses_location.phone,tx_abcourses_location.fax,tx_abcourses_location.email,tx_abcourses_location.person,tx_abcourses_location.informations',
                'tx_abcourses_event',
                'tx_abcourses_event_location_mm',
                'tx_abcourses_location',
                'AND tx_abcourses_location.pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->conf["recursive"]
			) . ')' .$this->cObj->enableFields('tx_abcourses_location') .
    			' AND tx_abcourses_event_location_mm.uid_local = ' . intval($byEventId) .
    			' AND tx_abcourses_location.uid = tx_abcourses_event_location_mm.uid_foreign'
    			);
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				$ret = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				return $ret;
			}   else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->loadLocation.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->loadLocation.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}


	//++++++++++++++++++++++++++++++++++++++//
	//++++++++++++++ Trainer +++++++++++++++//
	//++++++++++++++++++++++++++++++++++++++//
	/**
	* Returns a array with unique id's of trainers, associated to the given course.
	*
	* @param	integer		$byCourseId Id of the course you want to get the trainers for
	* @return	array		The key of the array is only a counter.
	*/
	function listTrainer($byCourseId=''){
		$this->reset();

		if ($byCourseId) {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query (
                            'tt_address.*',
                            'tx_abcourses_course',
                            'tx_abcourses_course_trainers_mm',
                            'tt_address',
                            'AND tt_address.pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->recursive
			) . ')' .$this->cObj->enableFields('tt_address') . '
    						 AND tx_abcourses_course_trainers_mm.uid_local = ' . intval($byCourseId) . '
    						 AND tt_address.uid = tx_abcourses_course_trainers_mm.uid_foreign',
    						'',
                            'tx_abcourses_course_trainers_mm.sorting'
                            );
		} else {
			$res = 0;
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$ret[] = $data['uid'];
				}
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->listTrainer.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listTrainer.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}


	//++++++++++++++++++++++++++++++++++++++//
	//++++++++++++ Conditions ++++++++++++++//
	//++++++++++++++++++++++++++++++++++++++//

	/**
	 * Should return an array with the uid of conditional courses.
	 * @param $courseId The uid of the course where you want to get the conditionals for.
	 * @return array	Conditional courses
	 */
	function listConditionalCourses($courseId) {
		$debugme = false;
		$this->reset();

		if ($debugme) {
			$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = true;
		}

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                            	'tx_abcourses_course_conditionsref_mm.uid_foreign AS uid',
    				     		'tx_abcourses_course_conditionsref_mm',
                            	' tx_abcourses_course_conditionsref_mm.uid_local = ' . intval($courseId)
                             );

        if ($debugme) {
			debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);
        }

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$ret[] = $data['uid'];
				}
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->listConditionalCourses.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listConditionalCourses.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			debug($this->arrStatus);
			return 0;
		}
	}

	/**
	 * Returns the data of a trainer as associative array. The array must be an associatve array where the array key is the attribute name and the array value the attribute it self.
	 * The array key must related to the default attribute names in the mysql db as delivered with the default abcourses installation.
	 *
	 * @param	integer		$byUid Load the data for an given id of a trainer. This value takes precedence.
	 * @param	integer		$byEventId Load the data for the trainer which is associated with the eventId.
	 * @return	array
	 */
	function loadTrainer($byUid='',$byEventId='') {
		$this->reset();

		if ($byEventId!=''){
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query (
                    'tt_address.*',
                    'tx_abcourses_event',
                    'tx_abcourses_event_trainer_mm',
                    'tt_address',
                    'AND tt_address.pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->recursive
			) . ')' .$this->cObj->enableFields('tt_address') . '
                     AND tx_abcourses_event_trainer_mm.uid_local = ' . intval($byEventId) . '
                     AND tt_address.uid = tx_abcourses_event_trainer_mm.uid_foreign'
                     );
		}

		if ($byUid != '') {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    'tt_address.*',
                    'tt_address',
                    'tt_address.uid = ' . intval($byUid) . $this->cObj->enableFields('tt_address')
			);
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				$ret = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->loadTrainer.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->loadTrainer.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}

	//++++++++++++++++++++++++++++++++++++++//
	//++++++++++++Teaching aids ++++++++++++//
	//++++++++++++++++++++++++++++++++++++++//

	/**
	 * Returns an array with unique id's of teaching aids associated with the passed course id.
	 *
	 * @param	integer		$courseId Id of the course you would like to load the teaching aids for.
	 * @return	array		The key of this array is only used as an counter.
	 */
	function listTeachingaidsForCourse($courseId){
		$debugme = false;
		$this->reset();

		if (is_numeric($courseId)) {
			if ($debugme) {
				$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = 1;
			}
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query (
                'tx_abcourses_teachingaids.uid',
                'tx_abcourses_course',
                'tx_abcourses_course_teachingaids_mm',
                'tx_abcourses_teachingaids',
                'AND tx_abcourses_course_teachingaids_mm.uid_local = ' . intval($courseId) . ' ' . $this->cObj->enableFields('tx_abcourses_teachingaids'),
                '',
                'tx_abcourses_teachingaids.sorting',
                ''
                );
                if ($debugme) {
                	debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);
                }
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$ret[] = $data['uid'];
				}
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->listTeachingaidsForCourse.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listTeachingaidsForCourse.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}

	/**
	 * To load the whole data of a teaching aid record. The array must be an associatve array where the array key is the attribute name and the array value the attribute it self.
	 * The array key must related to the default attribute names in the mysql db as delivered with the default abcourses installation.
	 *
	 * @param	integer		$id Id of the teching aid
	 * @return	array
	 */
	function loadTeachingaid($id='') {
		$this->reset();

		if (is_numeric($id)){
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                'tx_abcourses_teachingaids.*',
                'tx_abcourses_teachingaids',
                'tx_abcourses_teachingaids.uid = ' . intval($id) . $this->cObj->enableFields('tx_abcourses_teachingaids')
			);
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				$ret = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->loadTeachingaid.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->loadTeachingaid.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}

	//++++++++++++++++++++++++++++++++++++++//
	//+++++++++++++  HOTEL  ++++++++++++++++//
	//++++++++++++++++++++++++++++++++++++++//

	/**
	 * To load the whole data of a hotel record. The array must be an associatve array where the array key is the attribute name and the array value the attribute it self.
	 * The array key must related to the default attribute names in the mysql db as delivered with the default abcourses installation.
	 *
	 * @param	integer		$hotelId	To receive the data corresponding to a hotel id
	 * @param	integer		$arrangementId To receive the data corresponding to a arrangement id
	 * @return	array
	 */
	function loadHotel($hotelId='',$arrangementId='') {
		$debugme = false;
		$this->reset();

		if ($debugme) {
			$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = 1;
		}
		if (is_numeric($hotelId)){
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                'tx_abcourses_hotel.*',
                'tx_abcourses_hotel',
                'tx_abcourses_hotel.uid = ' . intval($id) . $this->cObj->enableFields('tx_abcourses_hotel')
			);
		} elseif (is_numeric($arrangementId)) {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query (
                'tx_abcourses_hotel.*',
                'tx_abcourses_arrangement',
                'tx_abcourses_arrangement_hotel_mm',
                'tx_abcourses_hotel',
                'AND tx_abcourses_arrangement.pid IN (' .$this->pi_getPidList(
			$this->pages,
			$this->recursive
			) . ')' .$this->cObj->enableFields('tx_abcourses_arrangement') . ' ' .$this->cObj->enableFields('tx_abcourses_hotel') . '
                 AND tx_abcourses_arrangement_hotel_mm.uid_local = ' . intval($arrangementId)
			);
		}
		if ($debugme) {
			debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				$ret = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->loadHotel.';
				$this->fError = 1;
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->loadHotel.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}


	// ++++++++++++++++++++++ //
	// +++++ ARRANGEMENT ++++ //
	// ++++++++++++++++++++++ //

	/**
	 * Returns an array with unique id's of arrangement records, corresponding to a hotel id.
	 *
	 * @param	integer		$hotelId
	 * @return	array		Array key is only used as an counter
	 */
	function listArrangements($hotelId=''){
		$debugme = false;
		$this->reset();

		if (is_numeric($hotelId)) {
			if ($debugme) {
				$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = 1;
			}
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query (
                'tx_abcourses_arrangement.uid',
                'tx_abcourses_arrangement',
                'tx_abcourses_arrangement_hotel_mm',
                'tx_abcourses_hotel',
                'AND tx_abcourses_arrangement_hotel_mm.uid_foreign = ' . intval($hotelId) . ' ' . $this->cObj->enableFields('tx_abcourses_arrangement') . ' ' . $this->cObj->enableFields('tx_abcourses_hotel'),
                '',
                'tx_abcourses_arrangement_hotel_mm.sorting',
                ''
                );
                if ($debugme) {
                	debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);
                }
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$ret[] = $data['uid'];
				}
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->listArrangements.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listArrangements.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}

	/**
	 * Returns an array with unique id's of arrangement records, corresponding to ann event id.
	 *
	 * @param	integer		$eventId
	 * @return	array		Array key is only used as an counter
	 */
	function listArrangementsForEvent($eventId=''){
		$debugme = false;
		$this->reset();

		if (is_numeric($eventId)) {
			if ($debugme) {
				$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = 1;
			}
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query (
                'tx_abcourses_arrangement.uid',
                'tx_abcourses_event',
                'tx_abcourses_event_arrangement_mm',
                'tx_abcourses_arrangement',
                'AND tx_abcourses_event_arrangement_mm.uid_local = ' . intval($eventId) . ' ' . $this->cObj->enableFields('tx_abcourses_arrangement') . ' ' . $this->cObj->enableFields('tx_abcourses_event'),
                '',
                'tx_abcourses_event_arrangement_mm.sorting',
                ''
                );
                if ($debugme) {
                	debug($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);
                }
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$ret[] = $data['uid'];
				}
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->listArrangementsForEvent.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->listArrangementsForEvent.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}

	/**
	 * Load the whole data of an arrangement id. The array must be an associatve array where the array key is the attribute name and the array value the attribute it self.
	 * The array key must related to the default attribute names in the mysql db as delivered with the default abcourses installation.
	 *
	 * @param	integer		$id
	 * @return	array
	 */
	function loadArrangement($id='') {
		$this->reset();

		if (is_numeric($id)){
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                'tx_abcourses_arrangement.*',
                'tx_abcourses_arrangement',
                'tx_abcourses_arrangement.uid = ' . intval($id) . $this->cObj->enableFields('tx_abcourses_arrangement')
			);
		}

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				$ret = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->loadArrangement.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->loadArrangement.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}
	}

	function loadParticipant($participantId) {
		$this->reset();
		$res = null;
			
		if ($participantId != '') {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    'tt_address.*',
                    'tt_address',
                    'tt_address.uid = ' . intval($participantId) . $this->cObj->enableFields('tt_address')
			);
		}
		
		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				$ret = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->loadParticipant.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->loadParticipant.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}

	}

	function get_ParticipantIdByUniqueField($field,$value){
		$fieldsArr = $GLOBALS['TYPO3_DB']->admin_get_fields("tt_address");
		if (is_array($fieldsArr[$field])) {
			$value = $GLOBALS['TYPO3_DB']->fullQuoteStr($value,"tt_address");
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
                    'tt_address.uid',
                    'tt_address',
                    $field . ' = ' . $value . $this->cObj->enableFields('tt_address')
			);
            $arr = QueryUtil::getFirstDataArrayFromResult($res);
            if ($arr != null) {
            	return $arr['uid'];
            }
		} else {
			die('The configured value regarding the address record unique field is not available. Please correct you setup.');
		}
	}

	function listParticipantsForEvent($eventId){
		$this->reset();
		$res = null;
		
		if ($eventId!=''){
			$res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query (
                    'tt_address.uid',
                    'tx_abcourses_event',
                    'tx_abcourses_event_participants_mm',
                    'tt_address',
                    ' AND tt_address.uid = tx_abcourses_event_participants_mm.uid_foreign' .
					' AND tx_abcourses_event_participants_mm.uid_local = ' . intval($eventId)
                     );
		}
		
		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
				while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
					$ret[] = $data['uid'];
				}
				return $ret;
			}	else {
				$this->arrStatus[] = 'Query returns no data in cAbcoursesDAL->loadParticipantsForEvent.';
				return 0;
			}
		} else {
			$this->fError = 1;
			$this->arrStatus[] = 'An SQL error occured in cAbcoursesDAL->loadParticipantsForEvent.';
			$this->arrStatus[] = $GLOBALS['TYPO3_DB']->debug();
			return 0;
		}

	}
}



?>