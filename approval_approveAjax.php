<?php
/*
Gibbon: Course Selection & Timetabling Engine
Copyright (C) 2017, Sandra Kuipers
*/

include '../../functions.php';

use CourseSelection\Domain\SelectionsGateway;

// Autoloader & Module includes
$loader->addNameSpace('CourseSelection\\', 'modules/Course Selection/src/');

if (isActionAccessible($guid, $connection2, '/modules/Course Selection/approval_byOffering.php') == false) {
    die(false);
} else {
    //Proceed!
    $courseSelectionOfferingID = $_POST['courseSelectionOfferingID'] ?? '';
    $gibbonPersonIDStudent = $_POST['gibbonPersonIDStudent'] ?? '';
    $courseSelectionChoiceID = $_POST['courseSelectionChoiceID'] ?? '';
    $status = $_POST['status'] ?? '';

    if (empty($courseSelectionOfferingID) || empty($gibbonPersonIDStudent) || empty($courseSelectionChoiceID)) {
        die(false);
    } else {
        $gateway = new SelectionsGateway($pdo);
        if ($status === 'true') {
            $data = array();
            $data['courseSelectionChoiceID'] = $courseSelectionChoiceID;
            $data['gibbonPersonIDApproved'] = $_SESSION[$guid]['gibbonPersonID'];
            $data['timestampApproved'] = date('Y-m-d H:i:s');

            $gateway->insertApproval($data);
        } else {
            $gateway->deleteApproval($courseSelectionChoiceID);
        }
        die(true);
    }
}
