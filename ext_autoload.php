<?php
    $extensionPath = t3lib_extMgm::extPath('abcourses');
    $autoloading = array(
        'tx_abcourses_metadata' => $extensionPath . 'hooks/class.tx_abcourses_metadata.php',
    );
    return $autoloading;
?>