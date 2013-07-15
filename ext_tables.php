<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

## WOP:[tables][1][allow_ce_insert_records]
t3lib_extMgm::addToInsertRecords("tx_abcourses_course");

$TCA["tx_abcourses_course"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course",		## WOP:[tables][1][title]
		"label" => "title",	## WOP:[tables][1][header_field]
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",	## WOP:[tables][1][sorting]
		"delete" => "deleted",	## WOP:[tables][1][add_deleted]
		"enablecolumns" => Array (		## WOP:[tables][1][add_hidden] / [tables][1][add_starttime] / [tables][1][add_endtime] / [tables][1][add_access]
		"disabled" => "hidden",	## WOP:[tables][1][add_hidden]
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_abcourses_course.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, number, title, subtitle, categorie, type, teachingaids, teaser, description, seodesc, keywords, pages, files, trainers, cost, skilllevel, edupoints, days, conditions, conditionsref",
	)
);


## WOP:[tables][2][allow_ce_insert_records]
t3lib_extMgm::addToInsertRecords("tx_abcourses_type");

$TCA["tx_abcourses_type"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_type",		## WOP:[tables][2][title]
		"label" => "typename",	## WOP:[tables][2][header_field]
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",	## WOP:[tables][2][sorting]
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_abcourses_type.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "typename",
	)
);


## WOP:[tables][2][allow_ce_insert_records]
t3lib_extMgm::addToInsertRecords("tx_abcourses_teachingaids");

$TCA["tx_abcourses_teachingaids"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_teachingaids",		## WOP:[tables][2][title]
		"label" => "name",	## WOP:[tables][2][header_field]
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",	## WOP:[tables][2][sorting]
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_abcourses_teachingaids.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "name",
	)
);

## WOP:[tables][4][allow_on_pages]
t3lib_extMgm::allowTableOnStandardPages("tx_abcourses_event");


## WOP:[tables][4][allow_ce_insert_records]
t3lib_extMgm::addToInsertRecords("tx_abcourses_event");

$TCA["tx_abcourses_event"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event",		## WOP:[tables][4][title]
		"label" => "event",	## WOP:[tables][4][header_field]
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",	## WOP:[tables][4][sorting]
		"delete" => "deleted",	## WOP:[tables][4][add_deleted]
		"enablecolumns" => Array (		## WOP:[tables][4][add_hidden] / [tables][4][add_starttime] / [tables][4][add_endtime] / [tables][4][add_access]
			"disabled" => "hidden",	## WOP:[tables][4][add_hidden]
			"starttime" => "starttime",	## WOP:[tables][4][add_starttime]
			"endtime" => "endtime",	## WOP:[tables][4][add_endtime]
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_abcourses_event.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, starttime, endtime, event, regstart, regend, course, coursestart, firstdaytimestart, firstdaytimeend, courseend, lastdaytimestart, lastdaytimeend, trainer, location, discount, discountvalue, lastminute, contingent,subscriptions",
		//"fe_admin_fieldList" => "hidden, starttime, endtime, event, regstart, regend, course, coursestart, firstdaytimestart, firstdaytimeend, courseend, lastdaytimestart, lastdaytimeend, trainer, participants, location, discount, discountvalue, lastminute, contingent,subscriptions",
	)
);



t3lib_extMgm::addToInsertRecords("tx_abcourses_hotel");
$TCA["tx_abcourses_hotel"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel",
		"label" => "name",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_abcourses_hotel.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, name, subtitle, link, image, rating",
	)
);

t3lib_extMgm::addToInsertRecords("tx_abcourses_arrangement");
$TCA["tx_abcourses_arrangement"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_arrangement",
		"label" => "backendname",
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",
		"delete" => "deleted",
		"enablecolumns" => Array (
			"disabled" => "hidden",
			"starttime" => "starttime",
			"endtime" => "endtime",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_abcourses_arrangement.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, backendname, frontendname, hotel, price",
	)
);


## WOP:[tables][5][allow_ce_insert_records]
t3lib_extMgm::addToInsertRecords("tx_abcourses_location");

$TCA["tx_abcourses_location"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_location",		## WOP:[tables][5][title]
		"label" => "title",	## WOP:[tables][5][header_field]
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"default_sortby" => "ORDER BY crdate",	## WOP:[tables][5][sorting] / [tables][5][sorting_field] / [tables][5][sorting_desc]
		"delete" => "deleted",	## WOP:[tables][5][add_deleted]
		"enablecolumns" => Array (		## WOP:[tables][5][add_hidden] / [tables][5][add_starttime] / [tables][5][add_endtime] / [tables][5][add_access]
			"disabled" => "hidden",	## WOP:[tables][5][add_hidden]
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_abcourses_location.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, title, street, zip, city, phone, fax, email, person, informations",
	)
);

## WOP:[tables][6][allow_ce_insert_records]
t3lib_extMgm::addToInsertRecords("tx_abcourses_categorie");

$TCA["tx_abcourses_categorie"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_categorie",		## WOP:[tables][6][title]
		"label" => "title",	## WOP:[tables][6][header_field]
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"sortby" => "sorting",	## WOP:[tables][6][sorting]
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_abcourses_categorie.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "title, teaser, image",
	)
);

$tempColumns = Array (
	"tx_abcourses_tnumber" => Array (		## WOP:[fields][1][fields][1][fieldname]
		"exclude" => 0,		## WOP:[fields][1][fields][1][excludeField]
		"label" => "LLL:EXT:abcourses/locallang_db.xml:tt_address.tx_abcourses_tnumber",		## WOP:[fields][1][fields][1][title]
		"config" => Array (
			"type" => "input",	## WOP:[fields][1][fields][1][type]
			"size" => "30",	## WOP:[fields][1][fields][1][conf_size]
		)
	),
	"tx_abcourses_position" => Array (		## WOP:[fields][1][fields][2][fieldname]
		"exclude" => 0,		## WOP:[fields][1][fields][2][excludeField]
		"label" => "LLL:EXT:abcourses/locallang_db.xml:tt_address.tx_abcourses_position",		## WOP:[fields][1][fields][2][title]
		"config" => Array (
			"type" => "input",	## WOP:[fields][1][fields][2][type]
			"size" => "30",	## WOP:[fields][1][fields][2][conf_size]
		)
	),
	"tx_abcourses_courses" => Array (		## WOP:[fields][1][fields][4][fieldname]
		"exclude" => 0,		## WOP:[fields][1][fields][4][excludeField]
		"label" => "LLL:EXT:abcourses/locallang_db.xml:tt_address.tx_abcourses_courses",		## WOP:[fields][1][fields][4][title]
		"config" => Array (
			"type" => "group",	## WOP:[fields][1][fields][4][conf_rel_type]
			"internal_type" => "db",	## WOP:[fields][1][fields][4][conf_rel_type]
			"allowed" => "tx_abcourses_course",	## WOP:[fields][1][fields][4][conf_rel_table]
			"size" => 5,	## WOP:[fields][1][fields][4][conf_relations_selsize]
			"minitems" => 0,
			"maxitems" => 50,	## WOP:[fields][1][fields][4][conf_relations]
			"MM" => "tt_address_tx_abcourses_courses_mm",	## WOP:[fields][1][fields][4][conf_relations_mm]
		)
	),
);

t3lib_div::loadTCA("tt_address");
t3lib_extMgm::addTCAcolumns("tt_address",$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes("tt_address","tx_abcourses_tnumber;;;;1-1-1, tx_abcourses_position, tx_abcourses_courses, tx_abcourses_image");

$tempColumns = Array (
	"tx_abcourses_type" => Array (		## WOP:[fields][2][fields][1][fieldname]
		"exclude" => 0,		## WOP:[fields][2][fields][1][excludeField]
		"label" => "LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type",		## WOP:[fields][2][fields][1][title]
		"config" => Array (
			"type" => "select",
			## WOP:[fields][2][fields][1][conf_select_items]
			"items" => Array (
				Array("LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type.I.0", "0"),
				Array("LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type.I.1", "1"),
				Array("LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type.I.2", "2"),
				Array("LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type.I.3", "3"),
				Array("LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type.I.4", "4"),
				Array("LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type.I.5", "5"),
				Array("LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type.I.6", "6"),
				Array("LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type.I.7", "7"),
				Array("LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type.I.8", "8"),
				Array("LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type.I.9", "9"),
				Array("LLL:EXT:abcourses/locallang_db.xml:tt_content.tx_abcourses_type.I.10", "10"),
			),
			"size" => 1,	## WOP:[fields][2][fields][1][conf_relations_selsize]
			"maxitems" => 1,	## WOP:[fields][2][fields][1][conf_relations]
		)
	),
);

t3lib_div::loadTCA("tt_content");
t3lib_extMgm::addTCAcolumns("tt_content",$tempColumns,1);
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages,recursive';

// add FlexForm field to tt_content
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1']='pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:abcourses/flexform_ds.xml');

## WOP:[pi][1][addType]
t3lib_extMgm::addPlugin(Array('LLL:EXT:abcourses/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');

## WOP:[pi][1][plus_wiz]:
if (TYPO3_MODE=="BE")	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_abcourses_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_abcourses_pi1_wizicon.php';

t3lib_extMgm::addLLrefForTCAdescr('tx_abcourses_event','EXT:abcourses/doc/csh/locallang_csh_event.php');
t3lib_extMgm::addLLrefForTCAdescr('tx_abcourses_course','EXT:abcourses/doc/csh/locallang_csh_course.php');
t3lib_extMgm::addLLrefForTCAdescr('tx_abcourses_type','EXT:abcourses/doc/csh/locallang_csh_type.php');
t3lib_extMgm::addLLrefForTCAdescr('tx_abcourses_categorie','EXT:abcourses/doc/csh/locallang_csh_categorie.php');
t3lib_extMgm::addLLrefForTCAdescr('tx_abcourses_location','EXT:abcourses/doc/csh/locallang_csh_location.php');
?>