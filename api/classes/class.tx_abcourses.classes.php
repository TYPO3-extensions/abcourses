<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2006 - 2013 Stefan Precht (info@stefanprecht.de)
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
 * Different classes for the 'abcourses' extension.
 *
 * @author	Stefan Precht <info@stefanprecht.de>
 */

require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.dal.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.AbcoursesBase.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Location.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Locations.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Category.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Categorys.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Course.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Arrangement.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Hotel.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Event.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Person.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Trainer.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Participant.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Teachingaid.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.Loader.php');
?>