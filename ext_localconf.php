<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::addUserTSConfig('
	options.saveDocNew {
		tx_abcourses_course=1
		tx_abcourses_type=1
		tx_abcourses_event=1
		tx_abcourses_location=1
		tx_abcourses_categorie=1
	}
');

t3lib_extMgm::addUserTSConfig('
	kj_calendar.lang = de
');

t3lib_extMgm::addUserTSConfig('
	kj_calendar.style = aqua
');

t3lib_extMgm::addPItoST43($_EXTKEY,'pi1/class.tx_abcourses_pi1.php','_pi1','list_type',0);

t3lib_extMgm::addTypoScript($_EXTKEY,'setup','
	tt_content.shortcut.20.0.conf.tx_abcourses_course = < plugin.'.t3lib_extMgm::getCN($_EXTKEY).'_pi1
	tt_content.shortcut.20.0.conf.tx_abcourses_course.CMD = CATOVERVIEW
',43);

#$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-postProcess'][] = 'EXT:abcourses/hooks/class.tx_abcourses_hooks.php:tx_abcourses_hooks->renderPostProcessHook';
?>