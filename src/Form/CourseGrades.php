<?php
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

namespace Gibbon\Modules\CourseSelection\Form;

use Gibbon\Forms\Layout\Element;

/**
 * Course Grades - Form Element
 *
 * @version v14
 * @since   19th April 2017
 */
class CourseGrades extends Element
{
    protected $grades;

    public function __construct($selectionsGateway, $gibbonDepartmentID, $gibbonPersonIDStudent)
    {
        $gradesRequest = $selectionsGateway->selectStudentReportGradesByDepartment($gibbonDepartmentID, $gibbonPersonIDStudent);
        $this->grades = ($gradesRequest->rowCount() > 0)? $gradesRequest->fetchAll() : array();
    }

    public function getOutput()
    {
        $output = '';

        $output .= implode('<br/>', array_map(function ($grade) {
            $output = ($grade['schoolYearStatus'] == 'Current')? '<span style="background:#ffd800;">' : '<span>';
            $output .= $grade['courseNameShort'].' ('.$grade['schoolYearName'].'): ';
            $output .= intval($grade['grade']).'%';
            return $output;
        }, $this->grades));

        return $output;
    }
}
