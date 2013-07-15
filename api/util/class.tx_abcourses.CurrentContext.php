<?php

require_once(t3lib_extMgm::extPath('abcourses').'api/classes/class.tx_abcourses.classes.php');
require_once(t3lib_extMgm::extPath('abcourses').'api/util/class.tx_abcourses.utils.php');

/**
 * Class tx_abcourses_CurrentContext
 *
 * TODO Documentation
 */
class tx_abcourses_CurrentContext
{
    private $prefixId = 'tx_abcourses_pi1';
    private $piVars = array();
    private $objLoader = null;
    private $conf = array();
    var $pages = '';
    var $recursive = '';

    function __construct()
    {
        if ($this->prefixId) {
            $this->piVars = t3lib_div::_GPmerged($this->prefixId);
        }
        $this->conf = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_abcourses_pi1.'];

    }

    /**
     * @param string $prefixId
     */
    public function setPrefixId($prefixId)
    {
        $this->prefixId = $prefixId;
    }

    /**
     * @return string
     */
    private function getPrefixId()
    {
        return $this->prefixId;
    }

    /**
     * @return bool
     */
    public function isCurrentCourseAvailable()
    {
        return (isset($this->piVars['courseId'])||isset($this->piVars['eventId']));
    }

    /**
     * @return cCourse|null
     */
    public function &getCurrentCourse(){
        $objLoader = &$this->getLoader();
        if (isset($this->piVars['courseId'])) {
            return $objLoader->get_Course($this->piVars['courseId']);
        } elseif (isset($this->piVars['eventId'])) {
            return $objLoader->get_Course('',$this->piVars['eventId']);
        } else {
            return null;
        }
    }

    /**
     * @return cLoader
     */
    private function &getLoader(){
        if ($this->objLoader == null) {
            if (!$GLOBALS['T3_VAR']['abcourses']['currentContextcLoader']) {
                $GLOBALS['T3_VAR']['abcourses']['currentContextcLoader'] =&t3lib_div::makeInstance('cLoader');
                $objLoader =&$GLOBALS['T3_VAR']['abcourses']['currentContextcLoader'];
                $objLoader->init($this->conf,$this->pages,$this->recursive,$GLOBALS['TSFE']->cObj);
            } else {
                $this->objLoader =&$GLOBALS['T3_VAR']['abcourses']['currentContextcLoader'];
            }
        }
        return $GLOBALS['T3_VAR']['abcourses']['currentContextcLoader'];
    }
}
?>