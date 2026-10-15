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

use moodle_url;

require(__DIR__.'/../../config.php');
require_once(__DIR__.'/lib.php');
require_once(__DIR__.'/choose_student_form.php');

global $DB, $USER;

/**
 * Course module id.
 */
$id = optional_param('id', 0, PARAM_INT);

/**
 * Activity instance id.
 */
$i = optional_param('i', 0, PARAM_INT);

if ($id) {
    $cm = get_coursemodule_from_id('istudystepform', $id, 0, false, MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $moduleinstance = $DB->get_record('istudystepform', array('id' => $cm->instance), '*', MUST_EXIST);
} else {
    $moduleinstance = $DB->get_record('istudystepform', array('id' => $i), '*', MUST_EXIST);
    $course = $DB->get_record('course', array('id' => $moduleinstance->course), '*', MUST_EXIST);
    $cm = get_coursemodule_from_instance('istudystepform', $moduleinstance->id, $course->id, false, MUST_EXIST);
}
$istudystepformid = $cm->instance;
$just_submitted = 'No';

require_login($course, true, $cm);

$modulecontext = \context_module::instance($cm->id);
$PAGE->set_url('/mod/istudystepform/choose_student.php', array('id' => $cm->id));
$PAGE->set_title(format_string($moduleinstance->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($modulecontext);

$advisor = utils::get_advisor($USER->advisorsf);
$lastnamesearch = utils::get_lastnamesearch($USER->lastnamesearchsf);

echo $OUTPUT->header();

// Display form.
$formparams = array('advisor' => $advisor, 'lastnamesearch' => $lastnamesearch);
$mform = new \mod_istudystepform_choose_student_form(null, $formparams);
$mform->set_data($istudystepformid);
if ($mform->is_cancelled()) {
	// Cancelled forms redirect to the course main page.
	$url = new \moodle_url('/course/view.php', array('id' => $course->id));
	redirect($url);
	return;

} else if ($data = $mform->get_data()) {
	// Make sure at least 1 student was chosen.
	$student_was_chosen = utils::get_student_chosen($data);
	if ($student_was_chosen) {
		// Get the course data.
		utils::step_forms($data);
		// Changes have been saved - reload the page and output the message 'Changes Saved'.
		$USER->just_savedstep = 'Yes';
		$mform->reset_checkboxes($data);
	}
	else{
		$USER->just_savedstep = 'Error';
		$choose_studenturl = new moodle_url('/mod/istudystepform/choose_student.php', ['id' => $cm->id]);
		redirect($choose_studenturl);
	}

} else {
	// Form has not been submitted or there was an error.
	// Just display the form.
	$mform->set_data(['id' => $id]);
}

// Print the page header.
$PAGE->set_title(format_string($course->fullname));
$PAGE->set_heading(format_string($course->fullname));

// Finish the page.
if ($USER->just_savedstep == 'Yes') {
	echo $OUTPUT->notification('YOUR DOCUMENT HAS BEEN PRINTED - If it did not print, please turn off your popup blocker for this site', 'notifysuccess');
	$just_savedstep = 'No';
}
elseif ($USER->just_savedstep == "Error") {
	echo $OUTPUT->notification('ERROR: Please choose at least 1 student.');
	$USER->just_savedstep = 'No';
}
$mform->display();
echo $OUTPUT->footer();