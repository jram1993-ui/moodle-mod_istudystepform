<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package    mod_istudystepform
 * @copyright  2024 Jesus Ramirez <jram1993@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_istudystepform;

use stdClass;

/**
 * Class utils
 *
 * @package    mod_istudystepform
 * @copyright  2024 Jesus Ramirez <jram1993@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class utils {

    /**
     * Get a single advisor.
     *
     * @param [integer] $chosen_advisor
     * @return [string]
     */
    public static function get_advisor($chosen_advisor) {
        global $DB;
        $sql = "SELECT * FROM {istudyteachers} ORDER By lastname ASC, firstname ASC";
        $params = null;
        $all_advisors = $DB->get_records_sql($sql, $params);
        $advisor = [];
        $count = 0;
        $advisor[$count] = 'All';
        // Create the list of advisors.
       foreach ($all_advisors as $this_advisor) {
            $count = $count + 1;
            $teacher_lastname = $this_advisor->lastname;
            $teacher_firstname = $this_advisor->firstname;
            $advisor[$count] = $teacher_lastname . '-' . $teacher_firstname;
        }
        // Return the advisor.
        return $advisor[$chosen_advisor];
    }

    // Get a list of all advisors.
    public static function get_advisors() {
        global $DB;
        $sql = "SELECT * FROM {istudyteachers} ORDER By lastname ASC, firstname ASC";
        $params = null;
        $all_advisors = $DB->get_records_sql($sql, $params);
        $count = 0;
        $advisor[$count] = 'All';
        foreach ($all_advisors as $this_advisor) {
            $count++;
            $advisor[$count] = $this_advisor->lastname . '-' . $this_advisor->firstname;
        }
        return $advisor;
    }

    // Get advisor name.
    public static function get_advisor_name($advisorid) {
        global $DB;
        $this_teacher = new stdClass();
        $sql = "SELECT * FROM {istudyteachers} WHERE teacherid = '" . $advisorid . "'";
        $params = null;
        $this_teacher = $DB->get_record_sql($sql, $params);
        $advisor_name = $this_teacher->lastname . '-' . $this_teacher->firstname;
        return $advisor_name;
    }

    /**
     * Get the default adivsor.
     *
     * @param [string] $advisors_list array
     * @return [integer]
     */
    public static function get_default_advisor($advisors_list) {
        global $USER;
        $advisorid = $USER->id;
        $current_advisor = utils::get_field_data($advisorid, utils::get_fieldid('whichteacher'));
        if ($current_advisor == "Administrator" OR $current_advisor == "Parent") {
            return 0;
        }
        else {
            $default_advisor = 0;
            $count = 0;
            $current_advisor = utils::get_advisor_name($advisorid);
            foreach ($advisors_list as $advisor_list) {
                $count = $count + 1;
                if (trim($advisor_list) == trim($current_advisor)) {
                    $default_advisor = $count;
                }
            }
            return ($default_advisor-1);
        }
    }

    /**
     * Calculate the grade level from the graduation year.
     *
     * @param [integer] $grad_year
     * @return [integer] $my_grade_level
     */
    public static function get_gradelevel($grad_year) {
        $currentmonth = date('m');
        $currentyear = date('Y');
        if ($grad_year <= $currentyear) {
            $years_left = 0;
        }
        else if ($currentmonth > 7) {
            $years_left = $grad_year - ($currentyear + 1);
        }
        else {
            $years_left = $grad_year - $currentyear;
        }
        $my_grade_level = 12 - $years_left;
        return $my_grade_level;
    }

    /**
     * Get the user_info_field id to use in searching user_info_data.
     *
     * @param [string] $item_name
     * @return [integer]
     */
    public static function get_fieldid($item_name) {
        global $DB;
        $item = $DB->get_record('user_info_field', ['shortname' => $item_name], 'id');
        return $item->id;
    }

    /**
     * Search user_info_data for student data using the student id and user_info_field id.
     *
     * @param [integer] $student_id
     * @param [integer] $itemid
     * @return [string]
     */
    public static function get_field_data($student_id, $itemid) {
        global $DB;
        if ($DB->record_exists('user_info_data', ['userid'=>$student_id, 'fieldid'=>$itemid])) {
            $search_results = $DB->get_record('user_info_data', ['userid'=>$student_id, 'fieldid'=>$itemid], 'data');
            return $search_results->data;
        }
        else {
            return '';
        }
    }

    /**
     * Replace the dash in the advisor name with a comma and a space.
     *
     * @param [string] $myteacher
     * @return [string]
     */

    public static function put_comma_in_name($myteacher) {
        $postion = strrpos($myteacher,"-");
        $name_with_dash = substr($myteacher, $postion);
        $name_with_comma = ', ' . substr($name_with_dash,1);
        $new_name = str_replace($name_with_dash,$name_with_comma,$myteacher);
        return $new_name;
    }

    /**
     * Make sure that the date is not zero.
     *
     * @param [object] $submission
     * @return string
     */
    public static function check_date($submission) {
        if ($submission > 0) {
            return date("m-d-Y", $submission);
        }
        else {
            return '';
        }
    }

    /**
     * Check to see if at least 1 student was chosen.
     *
     * @param [object] $submission
     * @return boolean
     */
    public static  function get_student_chosen($submission) {
        $student_count = $submission->studentcount;
        for ($i = 1; $i <= $student_count; $i++) {
             $this_student = 'student_chosen' . $i;
            // Check to make sure that the student exists and has not been deleted (rare occurance).
            if (!property_exists($submission, $this_student)) {
                return false;
            }
            $this_studentid = $submission->$this_student;
            if ($this_studentid <> 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the lastname search criteria.
     *
     * @param [integer] $lastnameinitial
     * @return string
     */
    public static function get_lastnamesearch($lastnameinitial){
        if ($lastnameinitial < 27) {
            $lastname_criteria = chr($lastnameinitial + 96) . '%';
        }
        else {$lastname_criteria = '%';
        }
        return $lastname_criteria;
    }

    /**
     * Remove extra characters from the string.
     *
     * @param [string] $snip
     * @return string
     */
    public static function remove_extra_symbols($snip) {
        $snip = str_replace("'", "’", $snip); // remove apostrophe
        $snip = str_replace("\t", "", $snip); // remove tabs
        $snip = str_replace("\n", "", $snip); // remove new lines
        $snip = str_replace("\r", "", $snip); // remove carriage returns
        return $snip;
    }

    /**
     * Gets the advisor ($myteacher) phone extension number.
     *
     * @param [type] $myteacher
     * @return void
     */
    public static function get_advisor_extension($myteacher) {
        global $DB;
        // Separate the first name and last name that are joined with a dash (-).
        $teacher_lastname = strstr($myteacher, '-', true);
        $myteacher_temp = strstr($myteacher, '-');
        $teacher_firstname = substr($myteacher_temp, 1);
        $this_teacher = new stdClass();
        $sql = "SELECT * FROM {istudyteachers} WHERE lastname = '" .  $teacher_lastname . "' AND firstname = '" .  $teacher_firstname . "'";
        $params = null;
        $this_teacher = $DB->get_record_sql($sql, $params);
        return $this_teacher->extension;
    }

    /**
     * Get a list of the students for a single advisor or all advisors according to lastname initial.
     *
     * @param [string] $advisorlist
     * @param [string] $lastnamesearch
     * @return void
     */
    public static function get_studentlist($advisorlist, $lastnamesearch) {
        global $DB;
        $table = '{' . 'user' . '}';
        $select = " lastname LIKE " . "'" . $lastnamesearch . "'";
        $params = null;
        $sort =" ORDER BY lastname ASC, firstname ASC";
        $fields='id, firstname, lastname, email, deleted, suspended';
        $sql = "SELECT " . $fields . " FROM " . $table . " WHERE " . $select . $sort;
        $mystudent_lists = $DB->get_records_sql($sql, $params, 0, 0);
        $count = 0;
        $students_were_found = false;
        foreach ($mystudent_lists as $mystudent_list) {
            $record_found = true;
            $student_id = $mystudent_list->id;
            /**
             * Admin user, guest user, and anon user will be skipped.
             */
            if (($mystudent_list->firstname == 'Admin') OR (substr($mystudent_list->firstname, 0, 4) == 'anon')
                OR (substr($mystudent_list->firstname, 0, 5) == 'Guest') OR ($mystudent_list->deleted) OR ($mystudent_list->suspended)){
                $record_found = false;
            }
            /**
             * Get the year and term according to the search criteria.
             */
            if ($record_found == true) {
                $whichuser_status = utils::get_field_data($student_id, utils::get_fieldid('whichteacher'));
                $myadvisor = utils::get_field_data($student_id, utils::get_fieldid('advisor'));
                /**
                 * Check to see if user is an advisor or parent.
                 * If so, exclude user.
                 */
                if ($whichuser_status <> 'Student') {
                        $record_found = false; }
                /**
                 * Check to see if the all adivsors or single advisor chosen match up.
                 */
                else if ($advisorlist <> 'All' AND $advisorlist <> $myadvisor) {
                    $record_found = false; }
            }
            if ($record_found == true) {
                $students_were_found = true;
                $count = $count +1;
                $students_found[$count] = new stdClass();
                /**
                 * Get student id, last name, and first name.
                 */
                $students_found[$count]->id = $student_id;
                $students_found[$count]->schoolid = utils::get_field_data($student_id, utils::get_fieldid('schoolid'));
                $students_found[$count]->email = $mystudent_list->email;
                $students_found[$count]->lastname = $mystudent_list->lastname;
                $students_found[$count]->firstname = $mystudent_list->firstname;
                /**
                 * Get the student grade level.
                 */
                $my_gradelevel = utils::get_gradelevel(utils::get_field_data($student_id, utils::get_fieldid('graduationyear')));
                $students_found[$count]->gradelevel = $my_gradelevel;
                /**
                 * Get the student's advisor.
                 */
                $my_advisor = utils::get_field_data($student_id, utils::get_fieldid('advisor'));
                $students_found[$count]->advisor = $my_advisor;
                /**
                 * Get the student's date of birth.
                 */
                $students_found[$count]->birthdate = utils::get_field_data($student_id, utils::get_fieldid('dob'));
                /**
                 * Get the student's grade point average.
                 */
                $students_found[$count]->gpa = utils::get_field_data($student_id, utils::get_fieldid('gpa'));
                /**
                 * Get the student's enrollment date.
                 */
                $students_found[$count]->startdate = utils::get_field_data($student_id, utils::get_fieldid('startdate'));
            }
        }
        if ($students_were_found == false){
            return NULL; }
        else {
            return $students_found;  }
    }

    /**
     * Get single student record.
     *
     * @param [integer] $student_id
     * @return object
     */
    public static function get_singlestudent($student_id) {
        global $USER, $DB;
        /**
         * Get student info.
         */
        $student_info = new stdClass();
        $student_info->id = $student_id;
        $student_temp = new stdClass();
        $student_temp = $DB->get_record('user', ['id' => $student_id] , '*');
        $student_info->lastname = utils::remove_extra_symbols($student_temp->lastname);
        $student_info->firstname = utils::remove_extra_symbols($student_temp->firstname);
        $student_info->gradelevel = utils::get_gradelevel(utils::get_field_data($student_id, utils::get_fieldid('graduationyear')));
        $student_info->schoolid = utils::get_field_data($student_id, utils::get_fieldid('schoolid'));
        $student_info->parentname = utils::remove_extra_symbols(utils::get_field_data($student_id, utils::get_fieldid('parentname')));
        $student_info->homephone = utils::get_field_data($student_id, utils::get_fieldid('homephone'));
        $student_info->address = utils::remove_extra_symbols(utils::get_field_data($student_id, utils::get_fieldid('address')));
        /**
         * If a city was not chosen from the list, then it equals '' instead of 'None'.
         */
        $temp_city = utils::get_field_data($student_id, utils::get_fieldid('city'));
        if ($temp_city <> 'None') {
            $student_info->city = $temp_city;
        }
        else {
            $student_info->city = '';
        }
        $dob_temp = utils::get_field_data($student_id, utils::get_fieldid('dob'));
        /**
         * If a birthdate was entered, format the date.
         */
        if ($dob_temp > 0) {
            $student_info->birthdate = date("m-d-Y", $dob_temp);
        }
        else {
            $student_info->birthdate = '';
        }
        /**
         * Get user name and room extension.
         */
        $teacher_id = $USER->id;
        $my_advisor = utils::get_field_data($teacher_id, utils::get_fieldid('whichteacher'));
        $student_info->advisor_english = ' / Administrator';
        $student_info->advisor_spanish = ' / Administrador(a)';
        $student_info->roomextension = '';
        if ($my_advisor == 'Teacher') {
            $student_info->advisor = utils::get_advisor_name($teacher_id);
            $student_info->advisor_english = ' - ' . utils::put_comma_in_name($student_info->advisor);
            $student_info->advisor_spanish = $student_info->advisor_english;
            $student_info->roomextension = utils::get_advisor_extension($student_info->advisor);
        }
        return $student_info;
    }

     /**
     * Create step forms and print them.
     *
     * @param [object] $submission
     * @return void
     */
    public static function step_forms($submission) {
        /**
         * Define variables.
         */
        $reason = new stdClass();
        $comments = new stdClass();
        /**
         * Get step form information.
         */
        $student_count = $submission->studentcount;
        $step_number = $submission->step_number;
        $days_behind = $submission->days_behind;
        $date_today = date("m-d-Y", $submission->date_today);
        $temp_reason1 = 'reasons_for_problem1_' . $step_number;
        $temp_reason2 = 'reasons_for_problem2_' . $step_number;
        $temp_reason3 = 'reasons_for_problem3_' . $step_number;
        $temp_reason4 = 'reasons_for_problem4_' . $step_number;
        $reason->one = $submission->$temp_reason1;
        $reason->two = $submission->$temp_reason2;
        $reason->three = $submission->$temp_reason3;
        $reason->four = $submission->$temp_reason4;
        $comments->english = $submission->comments_english;
        $comments->spanish = $submission->comments_spanish;
        $print_envelope = $submission->envelope_adress;
        /**
         * Initialize student cards to empty.
         */
        $student_cards = '';
        /**
         * Create the step forms for the students chosen.
         */
        for ($i = 1; $i <= $student_count; $i++) {
            $this_studentid = $submission->{'student_chosen' . $i};
            if ($this_studentid > 0) {
                /**
                 * Add a page break before the next page, but do not add break if it's the first page.
                 */
                if ($student_cards <> '') {
                    $student_cards = $student_cards . '<p style="page-break-before: always"></p>';
                }
                /**
                 * Create the step form for this student.
                 */
                $student_cards = $student_cards . student_info::get_stepform($this_studentid, $step_number, $days_behind, $date_today, $reason, $comments);
            }
        }
        /**
         * Print step forms.
         */
        $step_form_print_newtab = "<script>
                    var newWindow = window.open('');
                    newWindow.document.write('$student_cards');
            </script>";
        echo $step_form_print_newtab;
        /**
         * Initialize student cards to empty.
         */
        $student_envelopes = '';
        if ($print_envelope > 1) {
            for ($i = 1; $i <= $student_count; $i++) {
            $this_studentid = $submission->{'student_chosen' . $i};
            if ($this_studentid > 0) {
                /**
                 * Add a page break at befor the next page, but do not add break if it's the first page.
                 */
                if ($student_envelopes <> '') {
                    $student_envelopes = $student_envelopes . '<footer style="page-break-before: always">';
                }
                $student_envelopes = $student_envelopes . student_info::get_envelopes($this_studentid, $print_envelope);
            }
            }
            /**
             * Print envelopes.
             */
            $envelopes_print_newtab = "<script>
                    var newWindow = window.open('');
                    newWindow.document.write('$student_envelopes');
                </script>";
            echo $envelopes_print_newtab;
        }
        return;
    }
}