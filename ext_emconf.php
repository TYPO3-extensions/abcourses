<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "abcourses".
 *
 * Auto generated 04-03-2013 10:33
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Seminar management',
	'description' => 'An extension for dealing with seminars and appointments with extensive opportunities for advertising your appointments and for subscribing to them. Subscriptions can be stored as tt_address. Offers different hooks.',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '1.7.0',
	'dependencies' => 'cms,tt_address',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 1,
	'createDirs' => 'uploads/tx_abcourses/rte/',
	'modify_tables' => 'tt_address, tt_content',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'Andreas Behrens and Stefan Precht',
	'author_email' => 'Andreas Behrens <behrens@b-networks.de>, Stefan Precht <info@stefanprecht.de>',
	'author_company' => '@b-networks, Precht IT Beratung & Softwareentwicklung, SYMPLASSON GmbH, Tallence GmbH',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => 
	array (
		'depends' => 
		array (
            'php' => '5.3.7-5.5.99',
            'typo3' => '6.2.4',
			'tt_address' => '2.3.5',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
	'_md5_values_when_last_written' => 'a:121:{s:9:"ChangeLog";s:4:"7fce";s:10:"README.txt";s:4:"9fa9";s:8:"ToDo.txt";s:4:"1418";s:24:"de.locallang_db_flex.xml";s:4:"1aa8";s:12:"ext_icon.gif";s:4:"32da";s:17:"ext_localconf.php";s:4:"817a";s:15:"ext_php_api.dat";s:4:"cff4";s:14:"ext_tables.php";s:4:"2968";s:14:"ext_tables.sql";s:4:"29ab";s:28:"ext_typoscript_editorcfg.txt";s:4:"e660";s:24:"ext_typoscript_setup.txt";s:4:"7da1";s:24:"fi.locallang_db_flex.xml";s:4:"5967";s:15:"flexform_ds.xml";s:4:"3c16";s:33:"icon_tx_abcourses_arrangement.gif";s:4:"6da0";s:36:"icon_tx_abcourses_arrangement__h.gif";s:4:"e87e";s:31:"icon_tx_abcourses_categorie.gif";s:4:"be7f";s:28:"icon_tx_abcourses_course.gif";s:4:"583e";s:31:"icon_tx_abcourses_course__h.gif";s:4:"3a8d";s:27:"icon_tx_abcourses_event.gif";s:4:"e607";s:30:"icon_tx_abcourses_event__h.gif";s:4:"ee50";s:27:"icon_tx_abcourses_hotel.gif";s:4:"0e9b";s:30:"icon_tx_abcourses_hotel__h.gif";s:4:"b30e";s:30:"icon_tx_abcourses_location.gif";s:4:"2cc9";s:29:"icon_tx_abcourses_options.gif";s:4:"475a";s:34:"icon_tx_abcourses_skillLevel_0.gif";s:4:"bb44";s:34:"icon_tx_abcourses_skillLevel_1.gif";s:4:"b2f9";s:34:"icon_tx_abcourses_skillLevel_2.gif";s:4:"c601";s:34:"icon_tx_abcourses_skillLevel_3.gif";s:4:"079e";s:34:"icon_tx_abcourses_skillLevel_4.gif";s:4:"689f";s:38:"icon_tx_abcourses_skillLevel_blind.gif";s:4:"bb44";s:34:"icon_tx_abcourses_teachingaids.gif";s:4:"28a5";s:26:"icon_tx_abcourses_type.gif";s:4:"1be4";s:13:"locallang.xml";s:4:"b14f";s:16:"locallang_db.xml";s:4:"df73";s:21:"locallang_db_flex.xml";s:4:"319c";s:7:"tca.php";s:4:"cab6";s:14:"doc/manual.sxw";s:4:"340a";s:35:"doc/csh/locallang_csh_categorie.php";s:4:"6e50";s:32:"doc/csh/locallang_csh_course.php";s:4:"29a3";s:31:"doc/csh/locallang_csh_event.php";s:4:"f1ca";s:34:"doc/csh/locallang_csh_location.php";s:4:"fceb";s:30:"doc/csh/locallang_csh_type.php";s:4:"1eb4";s:28:"doc/csh/images/categorie.jpg";s:4:"86e7";s:34:"doc/csh/images/categorie_image.jpg";s:4:"7bea";s:35:"doc/csh/images/categorie_teaser.jpg";s:4:"d7b6";s:34:"doc/csh/images/categorie_title.jpg";s:4:"1583";s:25:"doc/csh/images/course.jpg";s:4:"3290";s:35:"doc/csh/images/course_categorie.jpg";s:4:"9343";s:36:"doc/csh/images/course_conditions.jpg";s:4:"7aaa";s:39:"doc/csh/images/course_conditionsref.jpg";s:4:"e348";s:30:"doc/csh/images/course_cost.jpg";s:4:"ff39";s:30:"doc/csh/images/course_days.jpg";s:4:"428b";s:37:"doc/csh/images/course_description.jpg";s:4:"baf7";s:35:"doc/csh/images/course_edupoints.jpg";s:4:"7265";s:32:"doc/csh/images/course_hidden.jpg";s:4:"d532";s:32:"doc/csh/images/course_number.jpg";s:4:"f64e";s:31:"doc/csh/images/course_pages.jpg";s:4:"e6d4";s:36:"doc/csh/images/course_skilllevel.jpg";s:4:"f14b";s:34:"doc/csh/images/course_subtitle.jpg";s:4:"8611";s:32:"doc/csh/images/course_teaser.jpg";s:4:"b82d";s:31:"doc/csh/images/course_title.jpg";s:4:"af7d";s:33:"doc/csh/images/course_trainer.jpg";s:4:"20d0";s:30:"doc/csh/images/course_type.jpg";s:4:"7344";s:29:"doc/csh/images/datepicker.jpg";s:4:"7b43";s:24:"doc/csh/images/event.jpg";s:4:"1a24";s:35:"doc/csh/images/event_contingent.jpg";s:4:"f83c";s:33:"doc/csh/images/event_discount.jpg";s:4:"0451";s:28:"doc/csh/images/event_end.jpg";s:4:"d8f9";s:33:"doc/csh/images/event_location.jpg";s:4:"571e";s:37:"doc/csh/images/event_participants.jpg";s:4:"e301";s:30:"doc/csh/images/event_start.jpg";s:4:"de05";s:32:"doc/csh/images/event_trainer.jpg";s:4:"421d";s:25:"doc/csh/images/events.jpg";s:4:"c9ae";s:30:"doc/csh/images/ext_icon__h.gif";s:4:"18ec";s:46:"doc/csh/images/icon_tx_abcourses_categorie.gif";s:4:"ae31";s:43:"doc/csh/images/icon_tx_abcourses_course.gif";s:4:"583e";s:46:"doc/csh/images/icon_tx_abcourses_course__h.gif";s:4:"3a8d";s:42:"doc/csh/images/icon_tx_abcourses_event.gif";s:4:"e607";s:45:"doc/csh/images/icon_tx_abcourses_event__h.gif";s:4:"ee50";s:45:"doc/csh/images/icon_tx_abcourses_location.gif";s:4:"67e9";s:44:"doc/csh/images/icon_tx_abcourses_options.gif";s:4:"475a";s:41:"doc/csh/images/icon_tx_abcourses_type.gif";s:4:"e58c";s:33:"doc/csh/images/lastminuteflag.jpg";s:4:"157e";s:27:"doc/csh/images/location.jpg";s:4:"348b";s:27:"doc/csh/images/regstart.jpg";s:4:"af4e";s:29:"doc/csh/images/timepicker.jpg";s:4:"c4db";s:23:"doc/csh/images/type.jpg";s:4:"8152";s:18:"images/dl_icon.gif";s:4:"dd5b";s:19:"images/pdf_icon.gif";s:4:"fae1";s:15:"images/star.psd";s:4:"d94c";s:17:"images/star_0.gif";s:4:"b870";s:17:"images/star_1.gif";s:4:"b6f9";s:17:"images/star_2.gif";s:4:"d8f4";s:17:"images/star_3.gif";s:4:"0181";s:17:"images/star_4.gif";s:4:"487e";s:17:"images/star_5.gif";s:4:"eb42";s:27:"pi1/abcourses_template.tmpl";s:4:"74af";s:14:"pi1/ce_wiz.gif";s:4:"4f3d";s:30:"pi1/class.tx_abcourses_pi1.php";s:4:"d913";s:38:"pi1/class.tx_abcourses_pi1_wizicon.php";s:4:"b6c1";s:13:"pi1/clear.gif";s:4:"cc11";s:17:"pi1/locallang.xml";s:4:"bf52";s:48:"pi1/classes/class.tx_abcourses.AbcoursesBase.php";s:4:"cbd2";s:48:"pi1/classes/class.tx_abcourses.AbcoursesUtil.php";s:4:"3ccf";s:46:"pi1/classes/class.tx_abcourses.Arrangement.php";s:4:"a6c6";s:43:"pi1/classes/class.tx_abcourses.Category.php";s:4:"f664";s:44:"pi1/classes/class.tx_abcourses.Categorys.php";s:4:"495a";s:41:"pi1/classes/class.tx_abcourses.Course.php";s:4:"ed06";s:44:"pi1/classes/class.tx_abcourses.DataArray.php";s:4:"ffe8";s:40:"pi1/classes/class.tx_abcourses.Event.php";s:4:"5c1c";s:40:"pi1/classes/class.tx_abcourses.Hotel.php";s:4:"4f69";s:41:"pi1/classes/class.tx_abcourses.Loader.php";s:4:"293c";s:43:"pi1/classes/class.tx_abcourses.Location.php";s:4:"a741";s:44:"pi1/classes/class.tx_abcourses.Locations.php";s:4:"d0e6";s:46:"pi1/classes/class.tx_abcourses.Participant.php";s:4:"64d6";s:41:"pi1/classes/class.tx_abcourses.Person.php";s:4:"92d7";s:44:"pi1/classes/class.tx_abcourses.QueryUtil.php";s:4:"9eb8";s:46:"pi1/classes/class.tx_abcourses.Teachingaid.php";s:4:"fc95";s:42:"pi1/classes/class.tx_abcourses.Trainer.php";s:4:"97d8";s:42:"pi1/classes/class.tx_abcourses.classes.php";s:4:"daca";s:38:"pi1/classes/class.tx_abcourses.dal.php";s:4:"c47b";}',
	'suggests' => 
	array (
	),
);

?>