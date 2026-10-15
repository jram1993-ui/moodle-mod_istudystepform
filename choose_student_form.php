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
 * The main istudystepform configuration form used for entering attendance credit
 *
 * It uses the standard core Moodle formslib. For more info about them, please
 * visit: http://docs.moodle.org/en/Development:lib/formslib.php
 *
 * @package    mod_istudystepform
 * @copyright  2024 Jesus Ramirez <jram1993@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/lib/formslib.php');

/**
 * Module instance settings form
 *
 * @package    mod_istudystepform
 * @copyright  2024 Jesus Ramirez <jram1993@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_istudystepform_choose_student_form extends moodleform
{
	public $advisor;
	public $lastnamesearch;

    public function definition()
	{
		$mform    		= $this->_form;
		$advisor    	= $this->_customdata['advisor'];
		$lastnamesearch = $this->_customdata['lastnamesearch'];
		$mystudents = mod_istudystepform\utils::get_studentlist($advisor, $lastnamesearch);

		$mform->addElement('html', '<link rel="stylesheet" type="text/css" href="styles-choose_student_form.css">');

		$mform->addElement('html', '<body><h1>Step Forms</h1>');
		$mform->addElement('html', '<h2>Form Details & Choose Students</h2><br>');

		$mform->addElement('html', '<table class="table2"><tr><th width="20%"></th><th width="80%">Complete the information below</th></tr>');

		/**
		 * Choose the step form (#1-3).
		 */
		$mform->addElement('html', '<tr><td class="mycell3" valign="top" rowspan="3">Which step number?</td><td class="mycell2">');
		$mform->addElement('radio', 'step_number', '','Step 1', 1);
		$mform->addElement('html', '</td></tr><tr><td class="mycell2">');
		$mform->addElement('radio', 'step_number', '','Step 2', 2);
		$mform->addElement('html', '</td></tr><tr><td class="mycell2">');
		$mform->addElement('radio', 'step_number', '','Step 3', 3);
		$mform->addElement('html', '</td></tr>');
		$mform->setDefault('step_number', 1);
		$mform->setType('step_number', PARAM_INT);

		/**
		 * Choose the date.
		 */
		$date_for_this_day = array(
							'startyear' => 2019,
							'stopyear'  => 2050,
							'timezone'  => 99,
							'optional'  => false
						);
		$mydate_today = time();

		$mform->addElement('html', '<tr><td valign="top" class="mycell3">Date today:</td><td>');
		$mform->addElement('date_selector', 'date_today', '', $date_for_this_day);
		$mform->setDefault('date_today', $mydate_today);
		$mform->addElement('html', '</td></tr>');

		/**
		 * Choose the number of days behind on work.
		 */
		for($i = 1; $i <= 12; ++$i) {
			$count_by_five = $i * 5;
			$daysbehind[$count_by_five] = $count_by_five;
		}
		$mform->addElement('html', '<tr><td valign="top" class="mycell3">Days behind in work:</td><td class="mycell3">');
		$select = $mform->addElement('select', 'days_behind', '', $daysbehind);
		/**
		 * Set default to 5 days.
		 */
		$select->setSelected(5);
		$mform->addElement('html', '</td></tr>');

		/**
		 * State the reasons for insufficient progress.
		 */

		$reason1_step1 = get_config('mod_istudystepform', 'reason_1_step_1_english');
		$reason1_step2 = get_config('mod_istudystepform', 'reason_1_step_2_english');
		$reason1_step3 = get_config('mod_istudystepform', 'reason_1_step_3_english');
		$reason2_step1 = get_config('mod_istudystepform', 'reason_2_step_1_english');
		$reason2_step2 = get_config('mod_istudystepform', 'reason_2_step_2_english');
		$reason2_step3 = get_config('mod_istudystepform', 'reason_2_step_3_english');
		$reason3_step1 = get_config('mod_istudystepform', 'reason_3_step_1_english');
		$reason3_step2 = get_config('mod_istudystepform', 'reason_3_step_2_english');
		$reason3_step3 = get_config('mod_istudystepform', 'reason_3_step_3_english');
		$reason4_step1 = get_config('mod_istudystepform', 'reason_4_step_1_english');
		$reason4_step2 = get_config('mod_istudystepform', 'reason_4_step_2_english');
		$reason4_step3 = get_config('mod_istudystepform', 'reason_4_step_3_english');
		$mform->addElement('html', '<tr><td valign="top" rowspan="4" class="mycell3">Resons for insufficient progress:</td><td align="left" class="mycell2">');
		$mform->addElement('advcheckbox', 'reasons_for_problem1_1', '', $reason1_step1, ['group' => 2], array(0, 1));
		$mform->addElement('advcheckbox', 'reasons_for_problem1_2', '', $reason1_step2, ['group' => 2], array(0, 1));
		$mform->addElement('advcheckbox', 'reasons_for_problem1_3', '', $reason1_step3, ['group' => 2], array(0, 1));
		$mform->hideIf('reasons_for_problem1_1', 'step_number', 'neq', 1);
		$mform->hideIf('reasons_for_problem1_2', 'step_number', 'neq', 2);
		$mform->hideIf('reasons_for_problem1_3', 'step_number', 'neq', 3);

		$mform->addElement('html', '</td></tr><tr><td class="mycell2">');
		$mform->addElement('advcheckbox', 'reasons_for_problem2_1', '', $reason2_step1, ['group' => 2], array(0, 1));
		$mform->addElement('advcheckbox', 'reasons_for_problem2_2', '', $reason2_step2, ['group' => 2], array(0, 1));
		$mform->addElement('advcheckbox', 'reasons_for_problem2_3', '', $reason2_step3, ['group' => 2], array(0, 1));
		$mform->hideIf('reasons_for_problem2_1', 'step_number', 'neq', 1);
		$mform->hideIf('reasons_for_problem2_2', 'step_number', 'neq', 2);
		$mform->hideIf('reasons_for_problem2_3', 'step_number', 'neq', 3);

		$mform->addElement('html', '</td></tr><tr><td class="mycell2">');
		$mform->addElement('advcheckbox', 'reasons_for_problem3_1', '', $reason3_step1, ['group' => 2], array(0, 1));
		$mform->addElement('advcheckbox', 'reasons_for_problem3_2', '', $reason3_step2, ['group' => 2], array(0, 1));
		$mform->addElement('advcheckbox', 'reasons_for_problem3_3', '', $reason3_step3, ['group' => 2], array(0, 1));
		$mform->hideIf('reasons_for_problem3_1', 'step_number', 'neq', 1);
		$mform->hideIf('reasons_for_problem3_2', 'step_number', 'neq', 2);
		$mform->hideIf('reasons_for_problem3_3', 'step_number', 'neq', 3);

		$mform->addElement('html', '</td></tr><tr><td class="mycell2">');
		$mform->addElement('advcheckbox', 'reasons_for_problem4_1', '', $reason4_step1, ['group' => 2], array(0, 1));
		$mform->addElement('advcheckbox', 'reasons_for_problem4_2', '', $reason4_step2, ['group' => 2], array(0, 1));
		$mform->addElement('advcheckbox', 'reasons_for_problem4_3', '', $reason4_step3, ['group' => 2], array(0, 1));
		$mform->hideIf('reasons_for_problem4_1', 'step_number', 'neq', 1);
		$mform->hideIf('reasons_for_problem4_2', 'step_number', 'neq', 2);
		$mform->hideIf('reasons_for_problem4_3', 'step_number', 'neq', 3);
		$mform->addElement('html', '</td></tr>');
		/**
		 * Add teacher comments in English.
		 */
		$mform->addElement('html', '<tr><td valign="top" class="mycell3">Teacher Comments - English:</td><td>');
		$mform->addElement('textarea', 'comments_english', '', 'wrap="virtual" rows="1" cols="60"');
		$mform->setDefault('comments_english', '');
		$mform->setType('comments_english', PARAM_TEXT);
		$mform->addElement('html', '</td></tr>');
		/**
		 * Add teacher comments in Spanish.
		 */
		$mform->addElement('html', '<tr><td valign="top" class="mycell3">Teacher Comments - Spanish:</td><td>');
		$mform->addElement('textarea', 'comments_spanish', '', 'wrap="virtual" rows="1" cols="60"');
		$mform->setDefault('comments_spanish', '');
		$mform->setType('comments_spanish', PARAM_TEXT);
		$mform->addElement('html', '</td></tr>');
		/**
		 * Include the label for the envelope.
		 */
		$mform->addElement('html', '<tr><td class="mycell3" valign="top" rowspan="3">Print address for envelope?</td><td class="mycell2">');
		$mform->addElement('radio', 'envelope_adress', '','No', 1);
		$mform->addElement('html', '</td></tr><tr><td class="mycell2">');
		$mform->addElement('radio', 'envelope_adress', '','Student address only', 2);
		$mform->addElement('html', '</td></tr><tr><td class="mycell2">');
		$mform->addElement('radio', 'envelope_adress', '','Student and school address', 3);
		$mform->addElement('html', '</td></tr>');
		$mform->setDefault('envelope_adress', 1);
		$mform->setType('envelope_adress', PARAM_INT);
		$mform->addElement('html', '</table><br>');
		/**
		 * The student list starts here.
		 */
		$this->add_checkbox_controller(1, 'Select ALL Students / Select NONE', '', 0);
		$mform->addElement('html', '<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for a specific student..." title="Type in a name">');
		$mform->addElement('html', '<table id="myTable">');
		$mform->addElement('html', '<tr><th width="2%">#</th><th>Student ID#</th><th>Student Name</th><th>Grade</th><th>Email</th><th>Birthday</th><th>Advisor</th><th>G.P.A.</th><th>Start Date</th></tr>');
		$count = 0;
		if ($mystudents == NULL) {
			echo '<h4>No students found using the search criteria</h4>';
		}
		else {
			/**
			 * List the students: Enter the points earned and a description of the assignment for each of the 4 weeks.
			 */
			$count = 0;
			foreach ($mystudents as $mystudent) {
				$count = $count + 1;
				$mform->addElement('html', '<tr><td><center>');
				/**
				 * First column assigns $count (the current number in the series) to each student.
				 */
				$mform->addElement('advcheckbox', 'student_chosen' . $count, '', $count, ['group' => 1, 'class' => 'mycheckbox'], array(0, $mystudent->id));
				$mform->addElement('html', '</center></td>');
				/**
				 * The second column shows the permanent district id.
				 */
				$mform->addElement('html', '<td><center>'. $mystudent->schoolid . '</center></td>');
				// Third column displays the student name - lastname
				$mform->addElement('html', '<td>' . $mystudent->lastname . ', ' .  $mystudent->firstname . '</td>');
				/**
				 * The fifth column shows the current grade level - 9, 10, 11, or 12.
				 */
				$mform->addElement('html', '<td><center>' . $mystudent->gradelevel . '</center></td>');
				/**
				 * The sixth column shows the student email.
				 */
				$mform->addElement('html', '<td>' . $mystudent->email . '</td>');
				/**
				 * The seventh column shows the student birthday.
				 */
				$mform->addElement('html', '<td><center>' . mod_istudystepform\utils::check_date($mystudent->birthdate) . '</center></td>');
				/**
				 * The eighth column shows the advisory teacher for that student.
				 */
				$mform->addElement('html', '<td>' . $mystudent->advisor . '</td>');
				/**
				 * The ninth column shows the student grade point average.
				 */
				$mform->addElement('html', '<td><center>' . $mystudent->gpa . '</center></td>');
				/**
				 * The tenth column shows the start or enrollment date.
				 */
				$mform->addElement('html', '<td><center>' . mod_istudystepform\utils::check_date($mystudent->startdate) . '</center></td></tr>');
			}
			$mform->addElement('html', '</table>');
			/**
			 * Hidden id number for sending the student count.
			 */
			$mform->addElement('hidden', 'studentcount', $count);
			$mform->setType('studentcount', PARAM_INT);
			/**
			 * Hidden id number for sending the data back.
			 */
			$mform->addElement('hidden', 'id');
			$mform->setType('id', PARAM_INT);
			/**
			 * Add standard buttons, common to all modules.
			 */
			$mform->addElement('html', '<br><h3>  </h3>');
			$this->add_action_buttons(true, 'Create Step Form');

			$mform->addElement('html', '<script>
                function myFunction() {
					var input, filter, table, tr, td, i, txtValue;
					input = document.getElementById("myInput");
					filter = input.value.toUpperCase();
					table = document.getElementById("myTable");
					tr = table.getElementsByTagName("tr");
					for (i = 0; i < tr.length; i++) {
						td = tr[i].getElementsByTagName("td")[2];
						if (td) {
							txtValue = td.textContent || td.innerText;
							if (txtValue.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
							} else {
							tr[i].style.display = "none";
							}
						}
					}
				}
            </script>');
			$mform->addElement('html', '</body>');
		}
	}

	public function reset_checkboxes($submission) {
		$student_count = $submission->studentcount;
		for ($i = 1; $i <= $student_count; $i++) {
			$this_student_checkbox = 'student_chosen' . $i;
			$this->_form->setConstant($this_student_checkbox, 0);
		}
	}
}