<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009-2013 Stefan Precht (sprecht@gmail.com)
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

        require_once(t3lib_extMgm::extPath('abcourses').'api/util/class.tx_abcourses.utils.php');
        
	/**
	 * This class is for handle events of the abcourses plugin.
	 *
	 */
	class cEvent extends cAbcoursesBase {
		var $fError = 0;
		var $arrStatus = Array();
		var $arrData = '';
		var $arrHotels = '';
		var $Location = '';
		var $arrParticipants = '';

		/**
		 * This function load the event data related to the given id.
		 *
		 * @param	integer		$eventId Id of the event record.
		 * @param	cAbcoursesDAL		$DAL Reference to the used data abstraction layer.
		 * @return	[type]		...
		 */
		function loadData($eventId='',&$DAL) {
			if (!$this->arrData) {
				$this->arrData = $DAL->loadEvent($eventId);
				$this->checkErrors($DAL);
				if ($this->arrData == 0) $this->fError = 1;
			}
		}

	    /**
		 * This function load hotels to the internal array depending on arrangements associated with this event.
		 *
		 * @param	cLoader		: A reference to the used loader object.
		 * @return	[type]		...
		 */
		function load_arrHotels(&$objLoader){
			$debugme = false;

			$DAL =& $objLoader->get_DAL();

			if (!$this->arrData) {
		        $this->fError = 1;
		        $this->arrStatus[] = 'Can not load hotels for an event without an event uid';
		        $this->checkErrors($this);
		        return;
		    }

		    $arrArrangementIds = 0;
	    	$arrArrangementIds = $DAL->listArrangementsForEvent($this->getSingleData("uid"));
			$this->checkErrors($DAL);

			$foo = ($debugme?debug("The following arrangements matches the criteria"):'');
			$foo = ($debugme?debug($arrArrangementIds):'');

			if (!$this->fError && $arrArrangementIds) {
			    reset($arrArrangementIds);
                while (list($key, $id) = each($arrArrangementIds)) {
                    $Hotel =& $objLoader->get_Hotel('',$id);
                    if ($Hotel) {
                        $hotelId = $Hotel->getSingleData('uid');
                    	$this->arrHotels[$hotelId] =& $Hotel;
                    }
                }
   			    reset($this->arrHotels);
			}

		}

		/**
		 * [Describe function...]
		 *
		 * @return	[type]		...
		 */
		function &get_arrHotels(){
				return $this->arrHotels;
		}

		/**
		 * Returns the number of initialised hotels.
		 *
		 * @return	integer
		 */
		function countHotels(){
			if (is_array($this->arrHotels)) {
				return count($this->arrHotels);
			} else {
				return 0;
			}
		}

		/**
		 * Initializes the internal array with associated participants.
		 *
		 * @param	cLoader		: A reference to the used loader object.
		 * @return	[type]		...
		 */
		function load_arrParticipants(&$objLoader){
			$debugme = false;

			$DAL =& $objLoader->get_DAL();

			if (!$this->arrData) {
		        $this->fError = 1;
		        $this->arrStatus[] = 'Can not load participants for an event without an event uid';
		        $this->checkErrors($this);
		        return;
		    }

		    $arrParticipantIds = 0;
	    	$arrParticipantIds = $DAL->listParticipantsForEvent($this->getSingleData("uid"));
			
			$this->checkErrors($DAL);

			$foo = ($debugme?debug("The following participants matches the criteria"):'');
			$foo = ($debugme?debug($arrParticipantIds):'');

			if (!$this->fError && $arrParticipantIds) {
			    reset($arrParticipantIds);
                while (list($key, $id) = each($arrParticipantIds)) {
                    $Participant =& $objLoader->get_Participant($id);
                    if ($Participant) {
                        $participantId = $Participant->getSingleData('uid');
                    	$this->arrParticipants[$participantId] =& $Participant;
                    }
                }
   			    reset($this->arrParticipants);
			}
		}

		/**
		 * Returns the number of initialized participants.
		 *
		 * @return	integer
		 */
		function countParticipants(){
			if (is_array($this->arrParticipants)) {
				return count($this->arrParticipants);
			} else {
				return 0;
			}
		}

		/**
		 * [Describe function...]
		 *
		 * @return	[type]		...
		 */
		function &get_arrParticipants(){
				return $this->arrParticipants;
		}

		/**
		 * Returns if you can subscribe an event or not, regarding on the contingent. You need to call load_arrParticipants before.
		 *
		 * @param	class		$view: An referenced instance of the pi1 class who wants to return the view
		 * @return	integer:	Returns 1 if you can subscribe to this event.
		 */
		function subscribeable(&$view) {
			if (!$view->takeNoticeOfContingent()) {
				return 1;
			}
			$contingent = intval($this->getSingleData('contingent'));
			$subscriptions = 0;
			if (intval($view->conf['trackSubscriptionsAsRecords'])){
				$subscriptions = $this->countParticipants();
			} else {
				$subscriptions = intval($this->getSingleData('subscriptions'));
			}
            return ($subscriptions>=$contingent?0:1);
		}

		/**
		 * Initialise the internal Location object.
		 *
		 * @param	cLoader		$Loader : A Reference to the abcourses proxy class
		 */
		function loadLocation(&$Loader){
			if (!$this->Location) {
				$this->Location = $Loader->get_Location('',$this->getSingleData('uid'));
			}
		}

		/**
		 * Returns a reference to the internal Location object.
		 *
		 * @param	cLoader		$Loader : A Reference to the abcourses proxy class
		 * @return cLocation
		 */
		function &getLocation() {
			return $this->Location;
		}

		/**
		 * This function render the view for this event, depending on the given template.
		 *
		 * @param	string		$template : The remplate for rendering the view.
		 * @param	string		&$view : A reference to the pi1 class who wants to render this view.
		 * @param	string		$conf	: A snippet of TS configuration which should be used for this event.
		 * @param	double		$costs: The base price for this event.
		 * @return	string		The rendered Template
		 */
		function printme($template, &$view, $conf, $costs = 0) {
			$debugme = false;

			//get the objectlayer
			$objLoader =& $GLOBALS['T3_VAR']['abcourses']['cLoader'];

			$templateLocations = $view->cObj->getSubpart($template, '###LOCATIONS###');
			$templateParticipants = $view->cObj->getSubpart($template, '###PARTICIPANTS###');

			$location = '';

	        $MA = $this->getEventMA($view,$conf,$costs,$objLoader);
	        
	        //---------------------------------------------------------
	        //should we trigger the view of an associated location too?
	        //---------------------------------------------------------
	       	if ($templateLocations) {
	       		if (!$this->Location) {
	       			$this->loadLocation($objLoader);
	       		}
	       		if ($this->Location) {
	       			$templateLocation = $view->cObj->getSubpart($templateLocations, '###LOCATION###');
	       			$location = $this->Location->printme($templateLocation,$view,$conf['location.']);
	            	$location = $view->cObj->substituteSubpart($templateLocations,'###LOCATION###',$location);
	       		}
	       	}

	       	$template = $view->cObj->substituteSubpart($template,'###LOCATIONS###',$location);

	       	//-------------------------------------------------------------------
	       	//should we trigger the rendering of associated participants as well?
	       	//-------------------------------------------------------------------
			if ($templateParticipants) {
				if (!is_array($this->arrParticipants)){					
					$this->load_arrParticipants($objLoader);
				}
				if (is_array($this->arrParticipants)){
					reset($this->arrParticipants);
					
					$singleParticipant = $view->cObj->getSubpart($templateParticipants, '###PARTICIPANT###');
					
					$tmp = "";
					
					while (list($id, $Participant) = each($this->arrParticipants)) {
						$tmp .= $Participant->printme($singleParticipant,$view,$conf['participant.']);
					}
					$templateParticipants = $view->cObj->substituteSubpart($templateParticipants,'###PARTICIPANT###',$tmp);
				}
			}
			$template = $view->cObj->substituteSubpart($template,'###PARTICIPANTS###',$templateParticipants);


	        if($debugme){debug($MA);}

	        //render and return the view
	        $renderedTemplate = $view->cObj->substituteMarkerArrayCached($template, $MA);

	        if($debugme){debug($renderedTemplate);}
	        return $renderedTemplate;
		}

		public function getEventMA(&$view, $conf, $costs = 0, &$objLoader){
			$MA = null;

			$MA['###EVENTNUMBER###'] = ($this->getSingleData('event')?$view->cObj->stdWrap($this->getSingleData('event'),$conf['eventNumberWrap.']):'');
	        $MA['###EVENTTEASER###'] = ($this->getSingleData('teaser')?$view->cObj->stdWrap($this->getSingleData('teaser'),$conf['eventTeaserWrap.']):'');
	        $MA['###CONTINGENT###'] = ($this->getSingleData('contingent')?$view->cObj->stdWrap($this->getSingleData('contingent'),$conf['eventContingentWrap.']):'');

			if ($view->takeNoticeOfContingent()) {
				$contingent = ($this->getSingleData('contingent')?intval($this->getSingleData('contingent')):0);
				$left = 0;
				if (intval($view->conf['trackSubscriptionsAsRecords'])) {
					$this->load_arrParticipants($objLoader);
					$subscriptions = $this->countParticipants();
				} else {
		            $subscriptions = ($this->getSingleData('subscriptions')?intval($this->getSingleData('subscriptions')):0);
				}

	            $left = $contingent - $subscriptions;
				$left = ($left<0?0:$left); //sollte eigentlich nicht auftreten...
				$MA['###CONTINGENTLEFT###'] = $view->cObj->stdWrap($left,$conf['eventContingentLeftWrap.']);
			} else {
				$MA['###CONTINGENTLEFT###'] = $view->cObj->stdWrap('0',$conf['useContingentInactiveWrap.']);
			}


	        if ($days) {
		        $MA['###DAYS###'] = $view->cObj->stdWrap($days, $conf['eventDaysWrap.']);
	        }

	        $eventDateStart = null;
			$eventDateEnd = null;
			//Abhängig von globalen Einstellungen zur Datumsanzeige
			if ($this->getSingleData('coursestart')) {
				if (!$this->getSingleData('courseend') || ($this->getSingleData('coursestart') == $this->getSingleData('courseend'))) {
					$eventDateStart = AbcoursesUtil::getFormattedDate($view->conf['ddmmyy'],$this->getSingleData('coursestart'));
				} else {
					$eventDateStart = AbcoursesUtil::getFormattedDate($view->conf['ddmmyy'],$this->getSingleData('coursestart'));
					$eventDateEnd   = AbcoursesUtil::getFormattedDate($view->conf['ddmmyy'],$this->getSingleData('courseend'));
				}
			}
			$eventDate = null;
		    $eventDate  = ($eventDateStart ? $eventDateStart : "");
		    $eventDate .= ($eventDateStart && $eventDateEnd ? " - " . $eventDateEnd : "");

			$eventStartTimeStart = null;
			$eventStartTimeEnd   = null;
			$eventStartTime = null;

			//Relates to global settings of the formatted date output
			if ($this->getSingleData('firstdaytimestart')) {
				if (!$this->getSingleData('firstdaytimestart') || ($this->getSingleData('firstdaytimestart') == $this->getSingleData('firstdaytimeend'))) {
					$eventStartTimeStart = AbcoursesUtil::getFormattedTime($view->conf['hhmmss'],$this->getSingleData('firstdaytimestart'));
				} else {
					$eventStartTimeStart = AbcoursesUtil::getFormattedTime($view->conf['hhmmss'],$this->getSingleData('firstdaytimestart'));
					$eventStartTimeEnd   = AbcoursesUtil::getFormattedTime($view->conf['hhmmss'],$this->getSingleData('firstdaytimeend'));
				}
			}
			$eventStartTime  = ($eventStartTimeStart ? $eventStartTimeStart : "");
			$eventStartTime .= ($eventStartTimeStart && $eventStartTimeEnd? " - " . $eventStartTimeEnd : "");

			$eventEndTimeStart = null;
			$eventEndTimeEnd   = null;
			$eventEndTime = null;

			//Abhängig von globalen Einstellungen zur Datumsanzeige
			if ($this->getSingleData('lastdaytimestart')) {
				if (!$this->getSingleData('lastdaytimeend') || ($this->getSingleData('lastdaytimestart') == $this->getSingleData('lastdaytimeend'))) {
					$eventEndTimeStart = AbcoursesUtil::getFormattedTime($view->conf['hhmmss'],$this->getSingleData('lastdaytimestart'));
				} else {
					$eventEndTimeStart = AbcoursesUtil::getFormattedTime($view->conf['hhmmss'],$this->getSingleData('lastdaytimestart'));
					$eventEndTimeEnd   = AbcoursesUtil::getFormattedTime($view->conf['hhmmss'],$this->getSingleData('lastdaytimeend'));
				}
			}
			$eventEndTime  = ($eventEndTimeStart ? $eventEndTimeStart : "");
			$eventEndTime .= ($eventEndTimeStart && $eventEndTimeEnd? " - " . $eventEndTimeEnd : "");


			$MA['###DATE###'] = $view->cObj->stdWrap($eventDate,$conf['eventDateWrap.']);
			$MA['###DATESTART###'] = $view->cObj->stdWrap($eventDateStart,$conf['eventDateStartWrap.']);
			$MA['###DATEEND###'] = $view->cObj->stdWrap($eventDateEnd,$conf['eventDateEndWrap.']);

		    $MA['###TIMEDATESTART###'] = $view->cObj->stdWrap($eventStartTime,$conf['eventTimeDateStartWrap.']);
		    $MA['###TIMEDATEEND###'] = $view->cObj->stdWrap($eventEndTime,$conf['eventTimeDateEndWrap.']);

	        if (is_numeric($costs) && ($costs!=0)) {
	            //Preis abhängig von Netto, Brutto und Ermäßigung
	            $price = doubleval($costs) + doubleval($this->getSingleData('discountvalue'));
	            $MA['###PRICE###'] = $view->cObj->stdWrap($view->calcPrice($price,$view->conf,0),$conf['eventPriceWrap.']);
	            $MA['###PRICETAX###'] = $view->cObj->stdWrap($view->calcPrice($price,$view->conf,1),$conf['eventPriceTaxWrap.']);
	        } else {
	            $MA['###PRICE###'] = $view->cObj->stdWrap("0",$conf['eventPriceWrap.']);
	            $MA['###PRICETAX###'] = $view->cObj->stdWrap("0",$conf['eventPriceTaxWrap.']);
	        }

	        //Subscribelink abhängig von REGSTART und REGEND
	        $MA['###REGSTART###'] = ($this->getSingleData('regstart')&&$this->getSingleData('regstart')?$view->cObj->stdWrap(AbcoursesUtil::getFormattedDate($view->conf['ddmmyy'],$this->getSingleData('regstart')),$conf['eventRegStartWrap.']):'');
	        $MA['###REGEND###'] = ($this->getSingleData('regend')&&$this->getSingleData('regend')?$view->cObj->stdWrap(AbcoursesUtil::getFormattedDate($view->conf['ddmmyy'],$this->getSingleData('regend')),$conf['eventRegEndWrap.']):'');

	        $timestamp = time();
	        $today = mktime(0, 0, 0, date('m', $timestamp),date('d', $timestamp),date('Y', $timestamp));
	        $tStart = ($this->getSingleData('regstart') && $this->getSingleData('regstart')?$this->getSingleData('regstart'):$today);
	        $tEnd = ($this->getSingleData('regend')&&$this->getSingleData('regend')?$this->getSingleData('regend'):$today);
	        if ($tStart<=$today && $tEnd>=$today && $this->subscribeable($view)) {
	            $sSubscribelink = $view->pi_linkToPage($view->pi_getLL('subscribelabel'),
	                                        $view->conf['pidSubscribe'], '',
	                                        array($view->prefixId.'[eventId]'=>$this->getSingleData('uid'))
	                                     );
	           $dateSubscribeLink = $view->pi_linkToPage($MA['###DATE###'],
	                                        $view->conf['pidSubscribe'], '',
	                                        array($view->prefixId.'[eventId]'=>$this->getSingleData('uid'))
	                                     );
	        } else {
	            $sSubscribelink = $view->pi_getLL('subscribelabel_unavailable');
	            $dateSubscribeLink = $MA['###DATE###'];
	        }

	        $MA['###SUBSCRIBELINK###'] = $view->cObj->stdWrap($sSubscribelink,$conf['eventSubscribeWrap.']);
	        $MA['###DATESUBSCRIBELINK###'] = $view->cObj->stdWrap($dateSubscribeLink,$conf['dateEventSubscribeWrap.']);

	        //Lastminute Termin?
	        $MA['###LASTMINUTE###'] = '';
	        if ($this->getSingleData('lastminute')&&$this->getSingleData('lastminute')) {
	            $MA['###LASTMINUTE###'] = $view->conf['lastminuteclass'];
	        }

	        return $MA;
		}

	}
?>