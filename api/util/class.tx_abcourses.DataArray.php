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

	/**
	 *  To handle some tuple data...
	 *
	 *  @author	Stefan Precht <sprecht@gmx.de>
	 */
    class DataArray {
        private $dataArr = null;
        private $dataArrLimit = null;
        const IS_EMPTY = true;
        const IS_NOT_EMPTY = false;

        public function __construct() {
            $this->dataArr = Array();
        }

        /**
         * With this function you can fill the CDataArray Instance with an complete Array.
         */
        public function init($arrInit) {
        	if (!is_array($arrInit)) return null;
            $this->reset();
            while(list($key,$value) = each($arrInit)) {
                $this->add($key,$value);
            }
            return true;
        }

        /**
         * Reset the internal Array cursor
         */
        public function reset(){
        	if (is_array($this->dataArr)){
        		reset($this->dataArr);
        	}
        }

        /**
         * Adds one key value tupel to this object
         * @return boolean if the value could not be added, this returns false. otherwise true.
         */
        public function add($key, $value){
        	if(!($this->getValueCountLimit() && ($this->size()>=$this->getValueCountLimit()))) {
            	if ($key != null && !($value === null)) {
                    $this->dataArr[strtolower(trim($key))] = $value;
                    return true;
                }
        	}
            return false;
        }

        /**
         * Get the tupel for a specific key. Returns null if the key does not exist.
         * @return MixedVar The value for the Key or null
         */
        public function get($key) {
        	$key = strtolower(trim($key));
            if ($this->contains($key)) {
                if ($this->dataArr[$key]!=null && $this->dataArr[$key]!= "")
                    return $this->dataArr[$key];
            }
            return null;
        }

        /**
         * Return the current key and value pair from the internal array and advance the array cursor. Do not forget calling <code>reset()</code> before you start an iteration witch each()!!
         */
        public function getEach() {
            return each($this->dataArr);
        }

        /**
         * This returns true, if an element with $key is available within this instance.
         *
         * @param unknown_type $key
         */
        public function contains($key){
        	$key = strtolower(trim($key));
        	return array_key_exists($key,$this->dataArr);
        }

        /**
         * @return array
         */
        public function getDataArray(){
        	return $this->dataArr;
        }

        /**
         * This iterates over the internal array and returns it
         * formattet as marker array.
         *
         * @return array
         */
        public function asMarkerArray(){
        	$MA = Array();
        	$this->reset();
        	while(list($key,$value)=$this->getEach()) {
        		//If value is null, an empty string will be set.
        		$MA['###' . strtoupper($key) . '###'] = ($value==null?"":$value);
        	}
        	return $MA;
        }

        public function size(){
     		if (($this->dataArr === null)||(!is_array($this->dataArr))){
     			return 0;
     		}
     		return count($this->dataArr);
        }
        public function isEmpty(){
        	if ($this->size()==0) {
        		return DataArray::IS_EMPTY;
        	} else {
        		return DataArray::IS_NOT_EMPTY;
        	}
        }
        /**
         * Clears the internal array
         */
        public function flush() {
        	$this->dataArr = null;
        }

        /**
         * If you set an valueCountLimit, this CDataArray will not store more than $limit entrys.
         */
        public function setValueCountLimit($limit){
        	$limit = intval($limit);
        	if ($limit > 0){
        		$this->dataArrLimit = $limit;
        	}
        }
		/**
		 * @return int
		 */
        public function getValueCountLimit() {
        	return $this->dataArrLimit;
        }
    }

?>