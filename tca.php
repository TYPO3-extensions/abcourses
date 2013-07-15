<?php
if (!defined ('TYPO3_MODE'))         die ('Access denied.');

$TCA["tx_abcourses_course"] = Array (
        "ctrl" => $TCA["tx_abcourses_course"]["ctrl"],
        "interface" => Array (
                "showRecordFieldList" => "hidden,number,title,subtitle,categorie,type,teachingaids,teaser,description,seodesc,keywords,pages,files,trainers,edupoints,days,contingent,conditions,conditionsref"
        ),
        "feInterface" => $TCA["tx_abcourses_course"]["feInterface"],
        "columns" => Array (
                "hidden" => Array (                ## WOP:[tables][1][add_hidden]
                        "exclude" => 1,
                        "label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
                        "config" => Array (
                                "type" => "check",
                                "default" => "0"
                        )
                ),
                "number" => Array (                ## WOP:[tables][1][fields][1][fieldname]
                        "exclude" => 1,                ## WOP:[tables][1][fields][1][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.number", ## WOP:[tables][1][fields][1][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][1][fields][1][type]
                                "size" => "30",        ## WOP:[tables][1][fields][1][conf_size]
                                "eval" => "required",        ## WOP:[tables][1][fields][1][conf_required]
                        )
                ),
                "title" => Array (                ## WOP:[tables][1][fields][2][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][2][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.title", ## WOP:[tables][1][fields][2][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][1][fields][2][type]
                                "size" => "30",        ## WOP:[tables][1][fields][2][conf_size]
                                "eval" => "required",        ## WOP:[tables][1][fields][2][conf_required]
                        )
                ),
                "subtitle" => Array (                ## WOP:[tables][1][fields][17][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][17][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.subtitle", ## WOP:[tables][1][fields][17][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][1][fields][17][type]
                                "size" => "30",        ## WOP:[tables][1][fields][17][conf_size]
                        )
                ),
                "categorie" => Array (                ## WOP:[tables][1][fields][18][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][18][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.categorie",
                        "config" => Array (
                                "type" => "group",
                                "internal_type" => "db",
                                "allowed" => "tx_abcourses_categorie",
                                "size" => 1,
                                "minitems" => 0,
                                "maxitems" => 1,
                                "MM" => "tx_abcourses_course_categorie_mm", ## WOP:[tables][1][fields][18][conf_relations_mm]
                        )
                ),
                "type" => Array (                ## WOP:[tables][1][fields][18][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][18][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.type",
                        "config" => Array (
                                "type" => "group",
                                "internal_type" => "db",
                                "allowed" => "tx_abcourses_type",
                                "size" => 1,
                                "minitems" => 0,
                                "maxitems" => 1,
                                "MM" => "tx_abcourses_course_type_mm", ## WOP:[tables][1][fields][18][conf_relations_mm]
                        )
                ),
                "teachingaids" => Array (                ## WOP:[tables][1][fields][18][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][18][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.teachingaids",
                        "config" => Array (
                                "type" => "group",
                                "internal_type" => "db",
                                "allowed" => "tx_abcourses_teachingaids",
                                "size" => 5,
                                "minitems" => 0,
                                "maxitems" => 10,
                                "MM" => "tx_abcourses_course_teachingaids_mm", ## WOP:[tables][1][fields][18][conf_relations_mm]
                        )
                ),
                "teaser" => Array (                ## WOP:[tables][1][fields][4][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][4][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.teaser", ## WOP:[tables][1][fields][4][title]
                        "config" => Array (
                                "type" => "text",
                                "cols" => "30",
                                "rows" => "5",
                                "wizards" => Array(
                                        "_PADDING" => 2,
                                        ## WOP:[tables][1][fields][4][conf_rte_fullscreen]
                                        "RTE" => Array(
                                                "notNewRecords" => 1,
                                                "RTEonly" => 1,
                                                "type" => "script",
                                                "title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
                                                "icon" => "wizard_rte2.gif",
                                                "script" => "wizard_rte.php",
                                        ),
                                ),
                        )
                ),
                "description" => Array (                ## WOP:[tables][1][fields][5][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][5][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.description", ## WOP:[tables][1][fields][5][title]
                        "config" => Array (
                                "type" => "text",
                                "cols" => "30",
                                "rows" => "5",
                                "wizards" => Array(
                                        "_PADDING" => 2,
                                        ## WOP:[tables][1][fields][5][conf_rte_fullscreen]
                                        "RTE" => Array(
                                                "notNewRecords" => 1,
                                                "RTEonly" => 1,
                                                "type" => "script",
                                                "title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
                                                "icon" => "wizard_rte2.gif",
                                                "script" => "wizard_rte.php",
                                        ),
                                ),
                        )
                ),
                "seodesc" => Array (                ## WOP:[tables][1][fields][4][fieldname]
                    "exclude" => 0,                ## WOP:[tables][1][fields][4][excludeField]
                    "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.seodesc", ## WOP:[tables][1][fields][4][title]
                    "config" => Array (
                        "type" => "text",
                        "cols" => "30",
                        "rows" => "5",
                    )
                ),
                "keywords" => Array (                ## WOP:[tables][1][fields][2][fieldname]
                    "exclude" => 0,                ## WOP:[tables][1][fields][2][excludeField]
                    "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.keywords", ## WOP:[tables][1][fields][2][title]
                    "config" => Array (
                        "type" => "input",        ## WOP:[tables][1][fields][2][type]
                        "size" => "30"
                    )
                ),
                "pages" => Array (                ## WOP:[tables][1][fields][8][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][8][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.pages", ## WOP:[tables][1][fields][8][title]
                        "config" => Array (
                                "type" => "group",        ## WOP:[tables][1][fields][8][conf_rel_type]
                                "internal_type" => "db",        ## WOP:[tables][1][fields][8][conf_rel_type]
                                "allowed" => "pages",        ## WOP:[tables][1][fields][8][conf_rel_table]
                                "size" => 3,        ## WOP:[tables][1][fields][8][conf_relations_selsize]
                                "minitems" => 0,
                                "maxitems" => 5,        ## WOP:[tables][1][fields][8][conf_relations]
                        )
                ),
                "files" => Array (                ## WOP:[tables][6][fields][3][fieldname]
                        "exclude" => 0,                ## WOP:[tables][6][fields][3][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.files",                ## WOP:[tables][6][fields][3][title]
                        "config" => Array (
                                "type" => "group",
                                "internal_type" => "file",
                                "allowed" => "pdf,zip,tif",        ## WOP:[tables][6][fields][3][conf_files_type]
                                "max_size" => 1000,        ## WOP:[tables][6][fields][3][conf_max_filesize]
                                "uploadfolder" => "uploads/tx_abcourses",
                                "show_thumbs" => 1,        ## WOP:[tables][6][fields][3][conf_files_thumbs]
                                "size" => 3,        ## WOP:[tables][6][fields][3][conf_files_selsize]
                                "minitems" => 0,
                                "maxitems" => 5,        ## WOP:[tables][6][fields][3][conf_files]
                        )
                ),
                "trainers" => Array (                ## WOP:[tables][1][fields][10][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][10][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.trainers", ## WOP:[tables][1][fields][10][title]
                        "config" => Array (
                                "type" => "group",        ## WOP:[tables][1][fields][10][conf_rel_type]
                                "internal_type" => "db",        ## WOP:[tables][1][fields][10][conf_rel_type]
                                "allowed" => "tt_address",        ## WOP:[tables][1][fields][10][conf_rel_table]
                                "size" => 3,        ## WOP:[tables][1][fields][10][conf_relations_selsize]
                                "minitems" => 0,
                                "maxitems" => 5,        ## WOP:[tables][1][fields][10][conf_relations]
                                "MM" => "tx_abcourses_course_trainers_mm",        ## WOP:[tables][1][fields][10][conf_relations_mm]
                        )
                ),
				 "cost" => Array (
					 "exclude" => 0,
					 "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.cost",
					 "config" => Array (
						  "type" => "input",
						  "size" => "7",
						  "max" => "7",
						  "checkbox" => "",
						  "eval" => "double2",
					  )
				),
				"skilllevel" => Array (
					"exclude" => 0,
					"label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.skilllevel",
					"config" => Array (
						"type" => "select",
		                          	"size" => 1,
		                           "minitems" => 0,
		                           "maxitems" => 1,
						"items" => Array (
							Array("LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.skilllevel.I.0", "0"),
							Array("LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.skilllevel.I.1", "1"),
							Array("LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.skilllevel.I.2", "2"),
							Array("LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.skilllevel.I.3", "3"),
							Array("LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.skilllevel.I.4", "4"),
						),
					)
				),
                "edupoints" => Array (                ## WOP:[tables][1][fields][12][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][12][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.edupoints", ## WOP:[tables][1][fields][12][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][1][fields][12][type]
                                "size" => "5",        ## WOP:[tables][1][fields][12][conf_size]
                                "max" => "3",        ## WOP:[tables][1][fields][12][conf_max]
                                "checkbox" => "0",        ## WOP:[tables][1][fields][12][conf_check]
                                "eval" => "int",        ## WOP:[tables][1][fields][12][conf_eval]
                        )
                ),
                "days" => Array (                ## WOP:[tables][1][fields][13][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][13][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.days", ## WOP:[tables][1][fields][13][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][1][fields][13][type]
                                "size" => "5",        ## WOP:[tables][1][fields][13][conf_size]
                                "max" => "3",        ## WOP:[tables][1][fields][13][conf_max]
                                "checkbox" => "0",        ## WOP:[tables][1][fields][13][conf_check]
                                "eval" => "int",        ## WOP:[tables][1][fields][13][conf_eval]
                        )
                ),
                "contingent" => Array (                ## WOP:[tables][4][fields][13][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][13][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.contingent", ## WOP:[tables][4][fields][13][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][4][fields][13][type]
                                "size" => "5",        ## WOP:[tables][4][fields][13][conf_size]
                                "max" => "2",        ## WOP:[tables][4][fields][13][conf_max]
                                "checkbox" => "0",        ## WOP:[tables][4][fields][13][conf_check]
                                "eval" => "int",        ## WOP:[tables][4][fields][13][conf_eval]
                        )
                ),
                "conditions" => Array (                ## WOP:[tables][1][fields][16][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][16][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.conditions", ## WOP:[tables][1][fields][16][title]
                        "config" => Array (
                                "type" => "text",
                                "cols" => "30",        ## WOP:[tables][1][fields][16][conf_cols]
                                "rows" => "5",        ## WOP:[tables][1][fields][16][conf_rows]
                        )
                ),
                "conditionsref" => Array (                ## WOP:[tables][1][fields][18][fieldname]
                        "exclude" => 0,                ## WOP:[tables][1][fields][18][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_course.conditionsref", ## WOP:[tables][1][fields][18][title]
                        "config" => Array (
                                "type" => "group",        ## WOP:[tables][1][fields][18][conf_rel_type]
                                "internal_type" => "db",        ## WOP:[tables][1][fields][18][conf_rel_type]
                                "allowed" => "tx_abcourses_course",        ## WOP:[tables][1][fields][18][conf_rel_table]
                                "size" => 3,        ## WOP:[tables][1][fields][18][conf_relations_selsize]
                                "minitems" => 0,
                                "maxitems" => 5,        ## WOP:[tables][1][fields][18][conf_relations]
                                "MM" => "tx_abcourses_course_conditionsref_mm", ## WOP:[tables][1][fields][18][conf_relations_mm]
                        )
                ),
        ),
        "types" => Array (
                "0" => Array("showitem" => "hidden;;1;;1-1-1, number;;;;3-3-3, title, subtitle, categorie;;;;3-3-3, type, teachingaids, contingent, days;;;;3-3-3, teaser;;;richtext[*];3-3-3, description;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_abcourses/rte/], seodesc, keywords, pages;;;;3-3-3, files;;;;3-3-3, trainers;;;;3-3-3, cost;;;;3-3-3, skilllevel;;;;3-3-3, edupoints, conditions;;;;3-3-3, conditionsref")
        ),
        "palettes" => Array (
                "1" => Array("showitem" => "")
        )
);



$TCA["tx_abcourses_categorie"] = Array (
        "ctrl" => $TCA["tx_abcourses_categorie"]["ctrl"],
        "interface" => Array (
                "showRecordFieldList" => "title,teaser,image"
        ),
        "feInterface" => $TCA["tx_abcourses_categorie"]["feInterface"],
        "columns" => Array (
                "title" => Array (                ## WOP:[tables][6][fields][1][fieldname]
                        "exclude" => 0,                ## WOP:[tables][6][fields][1][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_categorie.title",                ## WOP:[tables][6][fields][1][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][6][fields][1][type]
                                "size" => "30",        ## WOP:[tables][6][fields][1][conf_size]
                                "eval" => "required",        ## WOP:[tables][6][fields][1][conf_required]
                        )
                ),
                "teaser" => Array (                ## WOP:[tables][6][fields][2][fieldname]
                        "exclude" => 0,                ## WOP:[tables][6][fields][2][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_categorie.teaser",                ## WOP:[tables][6][fields][2][title]
                        "config" => Array (
                                "type" => "text",
                                "cols" => "30",
                                "rows" => "5",
                                "wizards" => Array(
                                        "_PADDING" => 2,
                                        ## WOP:[tables][6][fields][2][conf_rte_fullscreen]
                                        "RTE" => Array(
                                                "notNewRecords" => 1,
                                                "RTEonly" => 1,
                                                "type" => "script",
                                                "title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
                                                "icon" => "wizard_rte2.gif",
                                                "script" => "wizard_rte.php",
                                        ),
                                ),
                        )
                ),
                "image" => Array (                ## WOP:[tables][6][fields][3][fieldname]
                        "exclude" => 0,                ## WOP:[tables][6][fields][3][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_categorie.image",                ## WOP:[tables][6][fields][3][title]
                        "config" => Array (
                                "type" => "group",
                                "internal_type" => "file",
                                "allowed" => $GLOBALS["TYPO3_CONF_VARS"]["GFX"]["imagefile_ext"],        ## WOP:[tables][6][fields][3][conf_files_type]
                                "max_size" => 500,        ## WOP:[tables][6][fields][3][conf_max_filesize]
                                "uploadfolder" => "uploads/tx_abcourses",
                                "show_thumbs" => 1,        ## WOP:[tables][6][fields][3][conf_files_thumbs]
                                "size" => 1,        ## WOP:[tables][6][fields][3][conf_files_selsize]
                                "minitems" => 0,
                                "maxitems" => 1,        ## WOP:[tables][6][fields][3][conf_files]
                        )
                ),
        ),
        "types" => Array (
                "0" => Array("showitem" => "title;;;;2-2-2, teaser;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_abcourses/rte/];3-3-3, image;;;;3-3-3")
        ),
        "palettes" => Array (
                "1" => Array("showitem" => "")
        )
);



$TCA["tx_abcourses_type"] = Array (
        "ctrl" => $TCA["tx_abcourses_type"]["ctrl"],
        "interface" => Array (
                "showRecordFieldList" => "typename"
        ),
        "feInterface" => $TCA["tx_abcourses_type"]["feInterface"],
        "columns" => Array (
                "typename" => Array (                ## WOP:[tables][2][fields][1][fieldname]
                        "exclude" => 0,                ## WOP:[tables][2][fields][1][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_type.typename", ## WOP:[tables][2][fields][1][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][2][fields][1][type]
                                "size" => "30",        ## WOP:[tables][2][fields][1][conf_size]
                                "eval" => "required",        ## WOP:[tables][2][fields][1][conf_required]
                        )
                ),
        ),
        "types" => Array (
                "0" => Array("showitem" => "typename;;;;1-1-1")
        ),
        "palettes" => Array (
                "1" => Array("showitem" => "")
        )
);

$TCA["tx_abcourses_teachingaids"] = Array (
        "ctrl" => $TCA["tx_abcourses_teachingaids"]["ctrl"],
        "interface" => Array (
                "showRecordFieldList" => "name"
        ),
        "feInterface" => $TCA["tx_abcourses_type"]["feInterface"],
        "columns" => Array (
                "name" => Array (                ## WOP:[tables][2][fields][1][fieldname]
                        "exclude" => 0,                ## WOP:[tables][2][fields][1][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_teachingaids.name", ## WOP:[tables][2][fields][1][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][2][fields][1][type]
                                "size" => "30",        ## WOP:[tables][2][fields][1][conf_size]
                                "eval" => "required",        ## WOP:[tables][2][fields][1][conf_required]
                        )
                ),
        ),
        "types" => Array (
                "0" => Array("showitem" => "name;;;;1-1-1")
        ),
        "palettes" => Array (
                "1" => Array("showitem" => "")
        )
);



$TCA["tx_abcourses_event"] = Array (
        "ctrl" => $TCA["tx_abcourses_event"]["ctrl"],
        "interface" => Array (
                "showRecordFieldList" => "hidden,starttime,endtime,event,regstart,regend,course,coursestart,firstdaytimestart,firstdaytimeend,courseend,lastdaytimestart,lastdaytimeend,trainer,participants,location,discount,dicountvalue,lastminute,contingent,subscriptions,arrangement"
        ),
        "feInterface" => $TCA["tx_abcourses_event"]["feInterface"],
        "columns" => Array (
                "hidden" => Array (                ## WOP:[tables][4][add_hidden]
                        "exclude" => 1,
                        "label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
                        "config" => Array (
                                "type" => "check",
                                "default" => "0"
                        )
                ),
                "starttime" => Array (                ## WOP:[tables][4][add_starttime]
                        "exclude" => 1,
                        "label" => "LLL:EXT:lang/locallang_general.php:LGL.starttime",
                        "config" => Array (
                                "type" => "input",
                                "size" => "8",
                                "max" => "20",
                                "eval" => "date",
                                "default" => "0",
                                "checkbox" => "0"
                        )
                ),
                "endtime" => Array (                ## WOP:[tables][4][add_endtime]
                        "exclude" => 1,
                        "label" => "LLL:EXT:lang/locallang_general.php:LGL.endtime",
                        "config" => Array (
                                "type" => "input",
                                "size" => "8",
                                "max" => "20",
                                "eval" => "date",
                                "checkbox" => "0",
                                "default" => "0",
                                "range" => Array (
                                        "upper" => mktime(0,0,0,12,31,2020),
                                        "lower" => mktime(0,0,0,date("m")-1,date("d"),date("Y"))
                                )
                        )
                ),
                "event" => Array (                ## WOP:[tables][4][fields][1][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][1][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.event", ## WOP:[tables][4][fields][1][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][4][fields][1][type]
                                "size" => "30",        ## WOP:[tables][4][fields][1][conf_size]
                                "eval" => "required",        ## WOP:[tables][4][fields][1][conf_required]
                        )
                ),
                "regstart" => Array (                ## WOP:[tables][4][fields][2][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][2][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.regstart", ## WOP:[tables][4][fields][2][title]
                        "config" => Array (
                                "type" => "input",
                                "size" => "12",
                                "max" => "20",
                                "eval" => "date",
                                "checkbox" => "0",
                                "default" => "0"
                        )
                ),
                "regend" => Array (                ## WOP:[tables][4][fields][3][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][3][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.regend", ## WOP:[tables][4][fields][3][title]
                        "config" => Array (
                                "type" => "input",
                                "size" => "12",
                                "max" => "20",
                                "eval" => "date",
                                "checkbox" => "0",
                                "default" => "0"
                        )
                ),
                "course" => Array (                ## WOP:[tables][4][fields][4][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][4][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.course", ## WOP:[tables][4][fields][4][title]
                        "config" => Array (
                                "type" => "group",        ## WOP:[tables][4][fields][4][conf_rel_type]
                                "internal_type" => "db",        ## WOP:[tables][4][fields][4][conf_rel_type]
                                "allowed" => "tx_abcourses_course",        ## WOP:[tables][4][fields][4][conf_rel_table]
                                "size" => 1,        ## WOP:[tables][4][fields][4][conf_relations_selsize]
                                "minitems" => 0,
                                "maxitems" => 1,        ## WOP:[tables][4][fields][4][conf_relations]
                                "MM" => "tx_abcourses_event_course_mm",        ## WOP:[tables][4][fields][4][conf_relations_mm]
                        )
                ),
                "coursestart" => Array (                ## WOP:[tables][4][fields][5][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][5][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.coursestart", ## WOP:[tables][4][fields][5][title]
                        "config" => Array (
                                "type" => "input",
                                "size" => "8",
                                "max" => "20",
                                "eval" => "date",
                                "checkbox" => "0",
                                "default" => "0",
                        )
                ),
                "firstdaytimestart" => Array (                ## WOP:[tables][4][fields][14][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][14][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.firstdaytimestart", ## WOP:[tables][4][fields][14][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][4][fields][14][type]
                                "size" => "5",        ## WOP:[tables][4][fields][14][conf_size]
                                "max" => "5",        ## WOP:[tables][4][fields][14][conf_max]
                                "checkbox" => "0",        ## WOP:[tables][4][fields][14][conf_check]
                                "eval" => "time",        ## WOP:[tables][4][fields][14][conf_eval]
                                "wizards" => Array(
                                         "select" => array(
                                                 "type" => "select",
                                                 "mode" => "",
                                                 "items" => array(
                                                       array("08:00","08:00"),
                                                       array("09:00","09:00"),
                                                       array("10:00","10:00"),
                                                       array("11:00","11:00"),
                                                       array("12:00","12:00"),
                                                       array("13:00","13:00"),
                                                       array("14:00","14:00"),
                                                       array("15:00","15:00"),
                                                       array("16:00","16:00"),
                                                       array("17:00","17:00"),
                                                       array("18:00","18:00"),
                                                       array("19:00","19:00"),
                                                       array("20:00","20:00"),
                                                       array("21:00","21:00"),
                                                       array("22:00","22:00"),
                                                       array("23:00","23:00"),
                                                       array("00:00","00:01"),
                                                       array("01:00","01:00"),
                                                       array("02:00","02:00"),
                                                       array("03:00","03:00"),
                                                       array("04:00","04:00"),
                                                       array("05:00","05:00"),
                                                       array("06:00","06:00"),
                                                       array("07:00","07:00"),
                                                 )
                                         )
                                )
                        )
                ),
                "firstdaytimeend" => Array (                ## WOP:[tables][4][fields][15][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][15][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.firstdaytimeend", ## WOP:[tables][4][fields][15][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][4][fields][15][type]
                                "size" => "5",        ## WOP:[tables][4][fields][15][conf_size]
                                "max" => "5",        ## WOP:[tables][4][fields][15][conf_max]
                                "checkbox" => "0",        ## WOP:[tables][4][fields][15][conf_check]
                                "eval" => "time",        ## WOP:[tables][4][fields][15][conf_eval]
                                "wizards" => Array(
                                         "select" => array(
                                                 "type" => "select",
                                                 "mode" => "",
                                                 "items" => array(
                                                       array("08:00","08:00"),
                                                       array("09:00","09:00"),
                                                       array("10:00","10:00"),
                                                       array("11:00","11:00"),
                                                       array("12:00","12:00"),
                                                       array("13:00","13:00"),
                                                       array("14:00","14:00"),
                                                       array("15:00","15:00"),
                                                       array("16:00","16:00"),
                                                       array("17:00","17:00"),
                                                       array("18:00","18:00"),
                                                       array("19:00","19:00"),
                                                       array("20:00","20:00"),
                                                       array("21:00","21:00"),
                                                       array("22:00","22:00"),
                                                       array("23:00","23:00"),
                                                       array("00:00","00:01"),
                                                       array("01:00","01:00"),
                                                       array("02:00","02:00"),
                                                       array("03:00","03:00"),
                                                       array("04:00","04:00"),
                                                       array("05:00","05:00"),
                                                       array("06:00","06:00"),
                                                       array("07:00","07:00"),
                                                 )
                                         )
                                )
                        )
                ),
                "courseend" => Array (                ## WOP:[tables][4][fields][6][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][6][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.courseend", ## WOP:[tables][4][fields][6][title]
                        "config" => Array (
                                "type" => "input",
                                "size" => "8",
                                "max" => "20",
                                "eval" => "date",
                                "checkbox" => "0",
                                "default" => "0"
                        )
                ),
                "lastdaytimestart" => Array (                ## WOP:[tables][4][fields][16][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][16][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.lastdaytimestart", ## WOP:[tables][4][fields][16][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][4][fields][16][type]
                                "size" => "5",        ## WOP:[tables][4][fields][16][conf_size]
                                "max" => "5",        ## WOP:[tables][4][fields][16][conf_max]
                                "checkbox" => "0",        ## WOP:[tables][4][fields][16][conf_check]
                                "eval" => "time",        ## WOP:[tables][4][fields][16][conf_eval]
                                "wizards" => Array(
                                         "select" => array(
                                                 "type" => "select",
                                                 "mode" => "",
                                                 "items" => array(
                                                       array("08:00","08:00"),
                                                       array("09:00","09:00"),
                                                       array("10:00","10:00"),
                                                       array("11:00","11:00"),
                                                       array("12:00","12:00"),
                                                       array("13:00","13:00"),
                                                       array("14:00","14:00"),
                                                       array("15:00","15:00"),
                                                       array("16:00","16:00"),
                                                       array("17:00","17:00"),
                                                       array("18:00","18:00"),
                                                       array("19:00","19:00"),
                                                       array("20:00","20:00"),
                                                       array("21:00","21:00"),
                                                       array("22:00","22:00"),
                                                       array("23:00","23:00"),
                                                       array("00:00","00:01"),
                                                       array("01:00","01:00"),
                                                       array("02:00","02:00"),
                                                       array("03:00","03:00"),
                                                       array("04:00","04:00"),
                                                       array("05:00","05:00"),
                                                       array("06:00","06:00"),
                                                       array("07:00","07:00"),
                                                 )
                                         )
                                )
                        )
                ),
                "lastdaytimeend" => Array (                ## WOP:[tables][4][fields][17][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][17][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.lastdaytimeend", ## WOP:[tables][4][fields][17][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][4][fields][17][type]
                                "size" => "5",        ## WOP:[tables][4][fields][17][conf_size]
                                "max" => "5",        ## WOP:[tables][4][fields][17][conf_max]
                                "checkbox" => "0",        ## WOP:[tables][4][fields][17][conf_check]
                                "eval" => "time",        ## WOP:[tables][4][fields][17][conf_eval]
                                "wizards" => Array(
                                         "select" => array(
                                                 "type" => "select",
                                                 "mode" => "",
                                                 "items" => array(
                                                       array("08:00","08:00"),
                                                       array("09:00","09:00"),
                                                       array("10:00","10:00"),
                                                       array("11:00","11:00"),
                                                       array("12:00","12:00"),
                                                       array("13:00","13:00"),
                                                       array("14:00","14:00"),
                                                       array("15:00","15:00"),
                                                       array("16:00","16:00"),
                                                       array("17:00","17:00"),
                                                       array("18:00","18:00"),
                                                       array("19:00","19:00"),
                                                       array("20:00","20:00"),
                                                       array("21:00","21:00"),
                                                       array("22:00","22:00"),
                                                       array("23:00","23:00"),
                                                       array("00:00","00:01"),
                                                       array("01:00","01:00"),
                                                       array("02:00","02:00"),
                                                       array("03:00","03:00"),
                                                       array("04:00","04:00"),
                                                       array("05:00","05:00"),
                                                       array("06:00","06:00"),
                                                       array("07:00","07:00"),
                                                 )
                                         )
                                )
                        )
                ),
                "trainer" => Array (                ## WOP:[tables][4][fields][7][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][7][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.trainer", ## WOP:[tables][4][fields][7][title]
                        "config" => Array (
                                "type" => "group",        ## WOP:[tables][4][fields][7][conf_rel_type]
                                "internal_type" => "db",        ## WOP:[tables][4][fields][7][conf_rel_type]
                                "allowed" => "tt_address",        ## WOP:[tables][4][fields][7][conf_rel_table]
                                "size" => 5,        ## WOP:[tables][4][fields][7][conf_relations_selsize]
                                "minitems" => 0,
                                "maxitems" => 5,        ## WOP:[tables][4][fields][7][conf_relations]
                                "MM" => "tx_abcourses_event_trainer_mm",        ## WOP:[tables][4][fields][7][conf_relations_mm]
                        )
                ),
                "participants" => Array (                ## WOP:[tables][4][fields][8][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][8][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.participants", ## WOP:[tables][4][fields][8][title]
                        "config" => Array (
                                "type" => "group",        ## WOP:[tables][4][fields][8][conf_rel_type]
                				"internal_type" => "db",
                				"allowed" => "tt_address",
                                "size" => 5,        ## WOP:[tables][4][fields][8][conf_relations_selsize]
                                "minitems" => 0,
                                "MM" => "tx_abcourses_event_participants_mm",        ## WOP:[tables][4][fields][8][conf_relations_mm]
                                "wizards" => Array(
                                        "_PADDING" => 2,
                                        "_VERTICAL" => 1,
                                        ## WOP:[tables][4][fields][8][conf_wiz_addrec]
                                        "add" => Array(
                                                "type" => "script",
                                                "title" => "Create new record",
                                                "icon" => "add.gif",
                                                "params" => Array(
                                                        "table"=>"tt_address",
                                                        "pid" => "###STORAGE_PID###",
                                                        "setValue" => "prepend"
                                                ),
                                                "script" => "wizard_add.php",
                                        ),
                                        ## WOP:[tables][4][fields][8][conf_wiz_listrec]
                                        "list" => Array(
                                                "type" => "script",
                                                "title" => "List",
                                                "icon" => "list.gif",
                                                "params" => Array(
                                                        "table"=>"tt_address",
                                                        "pid" => "###STORAGE_PID###",
                                                ),
                                                "script" => "wizard_list.php",
                                        ),
                                        ## WOP:[tables][4][fields][8][conf_wiz_editrec]
                                        "edit" => Array(
                                                "type" => "popup",
                                                "title" => "Edit",
                                                "script" => "wizard_edit.php",
                                                "popup_onlyOpenIfSelected" => 1,
                                                "icon" => "edit2.gif",
                                                "JSopenParams" => "height=350,width=580,status=0,menubar=0,scrollbars=1",
                                        ),
                                ),
                        )
                ),
                "location" => Array (                ## WOP:[tables][4][fields][9][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][9][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.location", ## WOP:[tables][4][fields][9][title]
                        "config" => Array (
                                "type" => "group",        ## WOP:[tables][4][fields][9][conf_rel_type]
                                "internal_type" => "db",        ## WOP:[tables][4][fields][9][conf_rel_type]
                                "allowed" => "tx_abcourses_location",        ## WOP:[tables][4][fields][9][conf_rel_table]
                                "size" => 1,        ## WOP:[tables][4][fields][9][conf_relations_selsize]
                                "minitems" => 0,
                                "maxitems" => 1,        ## WOP:[tables][4][fields][9][conf_relations]
                                "MM" => "tx_abcourses_event_location_mm",        ## WOP:[tables][4][fields][9][conf_relations_mm]
                        )
                ),
                "discount" => Array (                ## WOP:[tables][4][fields][10][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][10][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.discount", ## WOP:[tables][4][fields][10][title]
                        "config" => Array (
                                "type" => "check",
                        )
                ),
                "discountvalue" => Array (                ## WOP:[tables][4][fields][11][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][11][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.discountvalue", ## WOP:[tables][4][fields][11][title]
                        "config" => Array (
				  "type" => "input",
				  "size" => "7",
				  "max" => "7",
				  "checkbox" => "",
				  "eval" => "double2",
                        )
                ),
                "lastminute" => Array (                ## WOP:[tables][4][fields][12][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][12][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.lastminute", ## WOP:[tables][4][fields][12][title]
                        "config" => Array (
                                "type" => "check",
                        )
                ),
                "contingent" => Array (                ## WOP:[tables][4][fields][13][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][13][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.contingent", ## WOP:[tables][4][fields][13][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][4][fields][13][type]
                                "size" => "5",        ## WOP:[tables][4][fields][13][conf_size]
                                "max" => "2",        ## WOP:[tables][4][fields][13][conf_max]
                                "checkbox" => "0",        ## WOP:[tables][4][fields][13][conf_check]
                                "eval" => "int",        ## WOP:[tables][4][fields][13][conf_eval]
                        )
                ),
                "subscriptions" => Array (                ## WOP:[tables][4][fields][14][fieldname]
                        "exclude" => 0,                ## WOP:[tables][4][fields][14][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.subscriptions", ## WOP:[tables][4][fields][14][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][4][fields][14][type]
                                "size" => "5",        ## WOP:[tables][4][fields][14][conf_size]
                                "max" => "2",        ## WOP:[tables][4][fields][14][conf_max]
                                "checkbox" => "0",        ## WOP:[tables][4][fields][14][conf_check]
                                "eval" => "int",        ## WOP:[tables][4][fields][14][conf_eval]
                        )
                ),
                "arrangement" => Array (
                        "exclude" => 0,
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_event.arrangement",
                        "config" => Array (
                                "type" => "group",
                                "internal_type" => "db",
                                "allowed" => "tx_abcourses_arrangement",
                                "size" => 3,
                                "minitems" => 0,
                                "maxitems" => 10,
                                "MM" => "tx_abcourses_event_arrangement_mm",
                        )
                ),
        ),
        "types" => Array (
                "0" => Array("showitem" => "hidden;;1;;1-1-1, event;;;;3-3-3, course, location, lastminute, coursestart;;2;;3-3-3, courseend;;3;;3-3-3, regstart;;3;;3-3-3, regend, trainer;;;;3-3-3, participants, contingent;;4;;, discount;;;;3-3-3, discountvalue, arrangement")
        ),
        "palettes" => Array (
                "1" => Array("showitem" => "starttime, endtime"),
                "2" => Array("showitem" => "firstdaytimestart, firstdaytimeend"),
                "3" => Array("showitem" => "lastdaytimestart, lastdaytimeend"),
        		"4" => Array("showitem" => "subscriptions")
        )
);



$TCA["tx_abcourses_location"] = Array (
        "ctrl" => $TCA["tx_abcourses_location"]["ctrl"],
        "interface" => Array (
                "showRecordFieldList" => "hidden,title,street,zip,city,phone,fax,email,person,informations"
        ),
        "feInterface" => $TCA["tx_abcourses_location"]["feInterface"],
        "columns" => Array (
                "hidden" => Array (                ## WOP:[tables][5][add_hidden]
                        "exclude" => 1,
                        "label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
                        "config" => Array (
                                "type" => "check",
                                "default" => "0"
                        )
                ),
                "title" => Array (                ## WOP:[tables][5][fields][1][fieldname]
                        "exclude" => 0,                ## WOP:[tables][5][fields][1][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_location.title",                ## WOP:[tables][5][fields][1][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][5][fields][1][type]
                                "size" => "30",        ## WOP:[tables][5][fields][1][conf_size]
                                "eval" => "required",        ## WOP:[tables][5][fields][1][conf_required]
                        )
                ),
                "street" => Array (                ## WOP:[tables][5][fields][2][fieldname]
                        "exclude" => 0,                ## WOP:[tables][5][fields][2][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_location.street",                ## WOP:[tables][5][fields][2][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][5][fields][2][type]
                                "size" => "30",        ## WOP:[tables][5][fields][2][conf_size]
                        )
                ),
                "zip" => Array (                ## WOP:[tables][5][fields][3][fieldname]
                        "exclude" => 0,                ## WOP:[tables][5][fields][3][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_location.zip",                ## WOP:[tables][5][fields][3][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][5][fields][3][type]
                                "size" => "5",        ## WOP:[tables][5][fields][3][conf_size]
                                "max" => "5",        ## WOP:[tables][5][fields][3][conf_max]
                        )
                ),
                "city" => Array (                ## WOP:[tables][5][fields][4][fieldname]
                        "exclude" => 0,                ## WOP:[tables][5][fields][4][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_location.city",                ## WOP:[tables][5][fields][4][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][5][fields][4][type]
                                "size" => "30",        ## WOP:[tables][5][fields][4][conf_size]
                                "eval" => "required",        ## WOP:[tables][5][fields][4][conf_required]
                        )
                ),
                "phone" => Array (                ## WOP:[tables][5][fields][5][fieldname]
                        "exclude" => 0,                ## WOP:[tables][5][fields][5][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_location.phone",                ## WOP:[tables][5][fields][5][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][5][fields][5][type]
                                "size" => "30",        ## WOP:[tables][5][fields][5][conf_size]
                        )
                ),
                "fax" => Array (                ## WOP:[tables][5][fields][6][fieldname]
                        "exclude" => 0,                ## WOP:[tables][5][fields][6][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_location.fax",                ## WOP:[tables][5][fields][6][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][5][fields][6][type]
                                "size" => "30",        ## WOP:[tables][5][fields][6][conf_size]
                        )
                ),
                "email" => Array (                ## WOP:[tables][5][fields][7][fieldname]
                        "exclude" => 0,                ## WOP:[tables][5][fields][7][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_location.email",                ## WOP:[tables][5][fields][7][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][5][fields][7][type]
                                "size" => "30",        ## WOP:[tables][5][fields][7][conf_size]
                                "wizards" => Array(
                                        "_PADDING" => 2,
                                        ## WOP:[tables][5][fields][7][conf_wiz_link]
                                        "link" => Array(
                                                "type" => "popup",
                                                "title" => "Link",
                                                "icon" => "link_popup.gif",
                                                "script" => "browse_links.php?mode=wizard",
                                                "JSopenParams" => "height=300,width=500,status=0,menubar=0,scrollbars=1"
                                        ),
                                ),
                        )
                ),
                "person" => Array (                ## WOP:[tables][5][fields][8][fieldname]
                        "exclude" => 0,                ## WOP:[tables][5][fields][8][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_location.person",                ## WOP:[tables][5][fields][8][title]
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][5][fields][8][type]
                                "size" => "30",        ## WOP:[tables][5][fields][8][conf_size]
                        )
                ),
                "informations" => Array (                ## WOP:[tables][5][fields][9][fieldname]
                        "exclude" => 0,                ## WOP:[tables][5][fields][9][excludeField]
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_location.informations",                ## WOP:[tables][5][fields][9][title]
                        "config" => Array (
                                "type" => "group",        ## WOP:[tables][5][fields][9][conf_rel_type]
                                "internal_type" => "db",        ## WOP:[tables][5][fields][9][conf_rel_type]
                                "allowed" => "pages",        ## WOP:[tables][5][fields][9][conf_rel_table]
                                "size" => 1,        ## WOP:[tables][5][fields][9][conf_relations_selsize]
                                "minitems" => 0,
                                "maxitems" => 1,        ## WOP:[tables][5][fields][9][conf_relations]
                                "MM" => "tx_abcourses_location_informations_mm",        ## WOP:[tables][5][fields][9][conf_relations_mm]
                        )
                ),
        ),
        "types" => Array (
                "0" => Array("showitem" => "hidden;;1;;1-1-1, title;;;;2-2-2, street;;;;3-3-3, zip, city, phone, fax, email, person, informations")
        ),
        "palettes" => Array (
                "1" => Array("showitem" => "")
        )
);


$TCA["tx_abcourses_hotel"] = Array (
        "ctrl" => $TCA["tx_abcourses_hotel"]["ctrl"],
        "interface" => Array (
                "showRecordFieldList" => "hidden, name, subtitle, link, image, rating"
        ),
        "feInterface" => $TCA["tx_abcourses_hotel"]["feInterface"],
        "columns" => Array (
                "hidden" => Array (
                        "exclude" => 1,
                        "label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
                        "config" => Array (
                                "type" => "check",
                                "default" => "0"
                        )
                ),
                "name" => Array (
                        "exclude" => 0,
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel.name",
                        "config" => Array (
                                "type" => "input",
                                "size" => "30",
                                "eval" => "required",
                        )
                ),
                "subtitle" => Array (
                        "exclude" => 0,
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel.subtitle",
                        "config" => Array (
                                "type" => "input",
                                "size" => "30",
                        )
                ),
                "link" => Array (
                        "exclude" => 0,
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel.link",
                        "config" => Array (
                                "type" => "input",        ## WOP:[tables][5][fields][7][type]
                                "size" => "30",        ## WOP:[tables][5][fields][7][conf_size]
                                "wizards" => Array(
                                        "_PADDING" => 2,
                                        "link" => Array(
                                                "type" => "popup",
                                                "title" => "Link",
                                                "icon" => "link_popup.gif",
                                                "script" => "browse_links.php?mode=wizard",
                                                "JSopenParams" => "height=300,width=500,status=0,menubar=0,scrollbars=1"
                                        ),
                                ),
                        )
                ),
                "image" => Array (
                        "exclude" => 0,
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel.image",                ## WOP:[tables][6][fields][3][title]
                        "config" => Array (
                                "type" => "group",
                                "internal_type" => "file",
                                "allowed" => $GLOBALS["TYPO3_CONF_VARS"]["GFX"]["imagefile_ext"],
                                "max_size" => 500,
                                "uploadfolder" => "uploads/tx_abcourses",
                                "show_thumbs" => 1,
                                "size" => 1,
                                "minitems" => 0,
                                "maxitems" => 1,
                        )
                ),
				"rating" => Array (
					"exclude" => 0,
					"label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel.rating",
					"config" => Array (
						"type" => "select",
		                          	"size" => 1,
		                           "minitems" => 0,
		                           "maxitems" => 1,
						"items" => Array (
							Array("LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel.rating.I.0", "0"),
							Array("LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel.rating.I.1", "1"),
							Array("LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel.rating.I.2", "2"),
							Array("LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel.rating.I.3", "3"),
							Array("LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel.rating.I.4", "4"),
							Array("LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_hotel.rating.I.5", "5"),
						),
					)
				),


        ),
        "types" => Array (
                "0" => Array("showitem" => "hidden;;1;;1-1-1, name;;2;;1-1-1, image")
        ),
        "palettes" => Array (
                "1" => Array("showitem" => ""),
                "2" => Array("showitem" => "subtitle, rating, link")
        )
);


$TCA["tx_abcourses_arrangement"] = Array (
        "ctrl" => $TCA["tx_abcourses_arrangement"]["ctrl"],
        "interface" => Array (
                "showRecordFieldList" => "hidden, starttime, endtime, backendname, frontendname, hotel, price"
        ),
        "feInterface" => $TCA["tx_abcourses_arrangement"]["feInterface"],
        "columns" => Array (
                "hidden" => Array (
                        "exclude" => 1,
                        "label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
                        "config" => Array (
                                "type" => "check",
                                "default" => "0"
                        )
                ),
                "starttime" => Array (
                        "exclude" => 1,
                        "label" => "LLL:EXT:lang/locallang_general.php:LGL.starttime",
                        "config" => Array (
                                "type" => "input",
                                "size" => "8",
                                "max" => "20",
                                "eval" => "date",
                                "default" => "0",
                                "checkbox" => "0"
                        )
                ),
                "endtime" => Array (
                        "exclude" => 1,
                        "label" => "LLL:EXT:lang/locallang_general.php:LGL.endtime",
                        "config" => Array (
                                "type" => "input",
                                "size" => "8",
                                "max" => "20",
                                "eval" => "date",
                                "checkbox" => "0",
                                "default" => "0",
                                "range" => Array (
                                        "upper" => mktime(0,0,0,12,31,2020),
                                        "lower" => mktime(0,0,0,date("m")-1,date("d"),date("Y"))
                                )
                        )
                ),
                "backendname" => Array (
                        "exclude" => 0,
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_arrangement.backendname",
                        "config" => Array (
                                "type" => "input",
                                "size" => "30",
                                "eval" => "required",
                        )
                ),
                "frontendname" => Array (
                        "exclude" => 0,
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_arrangement.frontendname",
                        "config" => Array (
                                "type" => "input",
                                "size" => "30",
                        )
                ),
                "hotel" => Array (
                        "exclude" => 0,
                        "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_arrangement.hotel",
                        "config" => Array (
                                "type" => "group",
                                "internal_type" => "db",
                                "allowed" => "tx_abcourses_hotel",
                                "size" => 1,
                                "minitems" => 0,
                                "maxitems" => 1,
                                "MM" => "tx_abcourses_arrangement_hotel_mm",
                        )
                ),
                "price" => Array (
					 "exclude" => 0,
					 "label" => "LLL:EXT:abcourses/locallang_db.xml:tx_abcourses_arrangement.price",
					 "config" => Array (
						  "type" => "input",
						  "size" => "7",
						  "max" => "7",
						  "checkbox" => "",
						  "eval" => "double2",
					  )
				),
        ),
        "types" => Array (
                "0" => Array("showitem" => "hidden;;1;;1-1-1, backendname, frontendname, hotel, price")
        ),
        "palettes" => Array (
                "1" => Array("showitem" => "starttime, endtime"),
        )
);


?>