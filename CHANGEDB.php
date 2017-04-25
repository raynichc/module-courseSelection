<?php
//USE ;end TO SEPERATE SQL STATEMENTS. DON'T USE ;end IN ANY OTHER PLACES!

$sql=array() ;
$count=0 ;

//v0.0.00
$sql[$count][0]="0.0.00" ;


//v0.0.01
$count++;
$sql[$count][0]="0.0.01" ;

//v0.0.02
$count++;
$sql[$count][0]="0.0.02" ;
$sql[$count][1]="
ALTER TABLE `courseSelectionChoice` ADD `courseSelectionBlockID` INT(10) UNSIGNED ZEROFILL NULL AFTER `gibbonCourseID`;end
ALTER TABLE `courseSelectionChoice` CHANGE `status` `status` ENUM('Required','Approved','Requested','Selected','Recommended','Declined','Removed') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Selected';end
ALTER TABLE `courseSelectionOfferingBlock` ADD `sequenceNumber` INT(3) NULL AFTER `maxSelect`;end" ;

//v0.0.03
$count++;
$sql[$count][0]="0.0.03" ;
$sql[$count][1]="
INSERT INTO `gibbonAction` (`gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Course Selection'), 'Copy Course Selections', 0, 'Tools', 'Create new course selections from existing course enrolments.', 'tools_copy.php', 'tools_copy.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N') ;end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Course Selection' AND gibbonAction.name='Copy Course Selections'));end" ;

//v0.0.04
$count++;
$sql[$count][0]="0.0.04" ;
$sql[$count][1]="INSERT INTO `gibbonSetting` (`scope` ,`name` ,`nameDisplay` ,`description` ,`value`) VALUES ('Course Selection', 'selectionComplete', 'Message on Completion', 'The text to display when the course selection process is complete.', 'Great! The course selection form is complete, you\'re ready to submit.');end
INSERT INTO `gibbonSetting` (`scope` ,`name` ,`nameDisplay` ,`description` ,`value`) VALUES ('Course Selection', 'selectionInvalid', 'Message on Invalid', 'The text to display when an invalid selection has been made.', 'The form is incomplete or contains an invalid choice. Please check your course selections above.');end
INSERT INTO `gibbonSetting` (`scope` ,`name` ,`nameDisplay` ,`description` ,`value`) VALUES ('Course Selection', 'selectionContinue', 'Message to Continue', 'The text to display when the course selection is in progress.', 'Continue selecting courses. You can submit a partial selection now and complete your choices at a later date.');end";

//v0.0.05
$count++;
$sql[$count][0]="0.0.05" ;
$sql[$count][1]="UPDATE `gibbonAction` SET `name`='Copy Selections By Course', `URLList`='tools_copyByCourse.php', `entryURL`='tools_copyByCourse.php' WHERE name='Copy Course Selections' AND gibbonModuleID=(SELECT gibbonModuleID FROM gibbonModule WHERE gibbonModule.name='Course Selection');end
INSERT INTO `gibbonAction` (`gibbonModuleID`, `name`, `precedence`, `category`, `description`, `URLList`, `entryURL`, `defaultPermissionAdmin`, `defaultPermissionTeacher`, `defaultPermissionStudent`, `defaultPermissionParent`, `defaultPermissionSupport`, `categoryPermissionStaff`, `categoryPermissionStudent`, `categoryPermissionParent`, `categoryPermissionOther`) VALUES ((SELECT gibbonModuleID FROM gibbonModule WHERE name='Course Selection'), 'Manual Course Selection', 0, 'Tools', 'Add a course selection for a student, even ourside a current offering.', 'tools_selectByStudent.php', 'tools_selectByStudent.php', 'Y', 'N', 'N', 'N', 'N', 'Y', 'N', 'N', 'N') ;end
INSERT INTO `gibbonPermission` (`permissionID` ,`gibbonRoleID` ,`gibbonActionID`) VALUES (NULL , '1', (SELECT gibbonActionID FROM gibbonAction JOIN gibbonModule ON (gibbonAction.gibbonModuleID=gibbonModule.gibbonModuleID) WHERE gibbonModule.name='Course Selection' AND gibbonAction.name='Manual Course Selection'));end
";

?>
