<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Stefan Precht (sprecht@gmx.de)
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

require_once('class.tx_abcourses.DataArray.php');

/**
 * Util class supporting query building and record creation.
 * @author Stefan Precht <sprecht@gmx.de>
 *
 */
class QueryUtil {
	/**
	 * Returns an integer value for a "sorting" field. TYPO3 need unique sorting values,
	 * as records can not be changed via BE if a sorting value occures twice in one table.
	 *
	 * @param	string	$txtTable: The table name you need a sorting value for.
	 * @static
	 * @return integer	A valid sorting value for the commited table name.
	 */
	public static function getNextSorting($txtTable) {
		$select_table = $txtTable;

	    $tableInfo = new DataArray();
	    $tableInfo->init($GLOBALS['TYPO3_DB']->admin_get_fields($txtTable));
        if (!$tableInfo->contains("sorting")) {
			return null;
        }
		$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
        	'MAX(sorting) AS sortingcounter',
			$select_table,
            '',
            '',
            '',
            ''
        );
		if ($GLOBALS['TYPO3_DB']->sql_error()){
			//TODO add exception handling
			return null;
		}

		if ($special = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {
			return intval($special['sortingcounter'])+5;
		} else {
			return 1;
		}
	}

	/**
	 * Wrapper for the enableFields Method of the TYPO3 API
	 */
	public static function enableFields($table,$show_hidden=0){
		return $GLOBALS['TSFE']->sys_page->enableFields($table,$show_hidden?$show_hidden:($table=='pages' ? $GLOBALS['TSFE']->showHiddenPage : $GLOBALS['TSFE']->showHiddenRecords));
	}

	/**
	 * This returns an indexed array containing the uid's within an SQL Resultset.
	 *
	 * @param $res The Resultset
	 * @return array or null
	 */
	public static function getUidArrayFromResult($res) {
		$data = null;
		$ret = null;
		if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
			while ($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
				$ret[] = $data['uid'];
			}
		}
		return $ret;
	}

	/**
	 * This returns just the first result array from an resultset.
	 * @return array or null
	 */
	public static function getFirstDataArrayFromResult($res) {
		$data = null;
		if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
			$data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		}
		return $data;
	}

	/**
	 * This returns an indexed array with associative contents. One for each result.
	 * @return array or null
	 */
	public static function getIndexedDataArrayFromResult($res) {
		$data = "";
		$ret = null;

		if ($res && $GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
			while($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
				$ret[] = $data;
			}
		}

		return $ret;
	}

	/**
	 * Creates a new record within $table an returns it id.
	 * @return int The id of the new record
	 */
	public static function createRecord($table,$pid=null,DataArray $data=null,$beUserId=null, $pid=null){
	    $timeStamp = time();
	    $arrFields = $GLOBALS['TYPO3_DB']->admin_get_fields($table);

		if (!$table) { return null; }
		$createVars = new DataArray();

		//Remove this!


		if ($data!=null) {
			$createVars->init($data->getDataArray());
		}

		$newId = null;

		$ctrl = $GLOBALS['TCA'][$table]['ctrl'];
		if (is_array($ctrl)) {
			if ($ctrl['delete']) {
				$createVars->add('deleted',0);
			}
			if ($ctrl['disabled']) {
				$createVars->add('disabled',0);
			}
		}

		if (is_array($arrFields['pid'])) {
			if ($pid===null){
				$storagePidsArr = $GLOBALS['TSFE']->getStorageSiterootPids();
				$pid = $storagePidsArr["_STORAGE_PID"];
			}
			$createVars->add('pid',$pid);
		}

		if (is_array($arrFields['crdate'])) {
			$createVars->add('crdate',$timeStamp);
		}

		if (is_array($arrFields['cruser_id'])) {
			if ($beUserId) {
				$createVars->add('cruser_id',intval($beUserId));
			} else {
				$createVars->add('cruser_id',0);
			}
		}

		if (is_array($arrFields['tstamp'])) {
			$createVars->add('tstamp',$timeStamp);
		}

		if (is_array($arrFields['sorting'])) {
			//validate if there is the need to set a sorting value
			$nextSorting = QueryUtil::getNextSorting($table);
			if ($nextSorting != null) {
			    $createVars->add('sorting',$nextSorting);
			}
		}

		$res = $GLOBALS['TYPO3_DB']->exec_INSERTquery($table,$createVars->getDataArray());

		if (!$GLOBALS['TYPO3_DB']->sql_error()) {
			//Get the id of the new created record.
			$newId = $GLOBALS['TYPO3_DB']->sql_insert_id();
		} else {
			if (is_null($newId)) {
				$GLOBALS['TYPO3_DB']->sql_error();
			}
		}
		return $newId;
	}

	/**
	 * Deletes a record. If a control field for delete can be found in the TCA, this method will mark the record as deleted.
	 * Otherwise this method destroys the record $uid in $table
	 * @return true for success
	 */
	public static function deleteRecord($table,$uid) {
		if (!$table || !$uid) { return null; }

		$fDestroy = true;
		$ctrl = $GLOBALS['TCA'][$table]['ctrl'];
		if (is_array($ctrl))    {
			//If this table have a known delete attribute, this method will use it. Otherwise it destroy the record.
			if ($ctrl['delete']) {
				$fDestroy = false;
			}
		}

		if ($fDestroy) {
		 	//Use the delete flag
            $res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery($table,'uid='.intval($uid),Array($ctrl['delete']=>1));
		} else {
			//Destroy the record
            $res = $GLOBALS['TYPO3_DB']->exec_DELETEquery($table,'uid='.intval($uid));
		}

		if ($GLOBALS['TYPO3_DB']->sql_error()){
			//TODO Implement exception handling
		}

		return true;
	}

}
?>