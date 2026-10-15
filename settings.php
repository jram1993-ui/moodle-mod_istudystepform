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
 * istudystepform module admin settings and defaults
 *
 * @package    mod
 * @subpackage istudystepform
 * @copyright  2024 Jesus Ramirez (jram1993@gmail.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;
require_once($CFG->dirroot.'/mod/istudystepform/lib.php');

if ($ADMIN->fulltree) {

    // Page heading
	$settings->add(new admin_setting_heading('mod_istudystepform/schoolinfoheading',
        get_string('schoolinfoheading', 'istudystepform'), get_string('schoolinfoheading_details', 'istudystepform')));

	// Number of Sessions - Paging options
     $options = array(
         5 => 5,
		 6 => 6,
		 7 => 7,
		 8 => 8,
    );
	$settings->add(new admin_setting_configselect('mod_istudystepform/conditions_agreement',
        get_string('conditions_agreement', 'istudystepform'), get_string('conditions_agreement_details', 'istudystepform'), 7, $options));

	// ---> S T E P  1  -  E N G L I S H <---
	$settings->add(new admin_setting_heading('mod_istudystepform/step_1_form_english',
        get_string('step_1_form_english', 'istudystepform'), get_string('step_1_form_english_details', 'istudystepform')));
	//Title of the form
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/title_step_1_english',
        get_string('title_step_1_english', 'istudystepform'), get_string('title_step_1_english_details', 'istudystepform'), get_string('title_step_1_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	//Paragraph 1 - before the reasons with checkboxes
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/reasons_for_step_1_english',
		get_string('reasons_for_step_1_english', 'istudystepform'), get_string('reasons_for_step_1_english_details', 'istudystepform'), get_string('reasons_for_step_1_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	// Four reasons for the step form - with checkboxes
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_1_step_1_english',
        get_string('reason_1_step_1_english', 'istudystepform'), get_string('reason_1_step_1_english_details', 'istudystepform'), get_string('reason_1_step_1_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_2_step_1_english',
        get_string('reason_2_step_1_english', 'istudystepform'), get_string('reason_2_step_1_english_details', 'istudystepform'), get_string('reason_2_step_1_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_3_step_1_english',
        get_string('reason_3_step_1_english', 'istudystepform'), get_string('reason_3_step_1_english_details', 'istudystepform'), get_string('reason_3_step_1_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_4_step_1_english',
        get_string('reason_4_step_1_english', 'istudystepform'), get_string('reason_4_step_1_english_details', 'istudystepform'), get_string('reason_4_step_1_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	// Reminder of master agreement - Intro paragraph and list of details
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_paragraph_step_1_english',
		get_string('agreement_paragraph_step_1_english', 'istudystepform'), get_string('agreement_paragraph_step_1_english_details', 'istudystepform'), get_string('agreement_paragraph_step_1_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_1_step_1_english',
		get_string('agreement_condition_1_step_1_english', 'istudystepform'), get_string('agreement_condition_1_step_1_english_details', 'istudystepform'), get_string('agreement_condition_1_step_1_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_2_step_1_english',
		get_string('agreement_condition_2_step_1_english', 'istudystepform'), get_string('agreement_condition_2_step_1_english_details', 'istudystepform'), get_string('agreement_condition_2_step_1_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_3_step_1_english',
		get_string('agreement_condition_3_step_1_english', 'istudystepform'), get_string('agreement_condition_3_step_1_english_details', 'istudystepform'), get_string('agreement_condition_3_step_1_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_4_step_1_english',
		get_string('agreement_condition_4_step_1_english', 'istudystepform'), get_string('agreement_condition_4_step_1_english_details', 'istudystepform'), get_string('agreement_condition_4_step_1_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_5_step_1_english',
		get_string('agreement_condition_5_step_1_english', 'istudystepform'), get_string('agreement_condition_5_step_1_english_details', 'istudystepform'), get_string('agreement_condition_5_step_1_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_6_step_1_english',
		get_string('agreement_condition_6_step_1_english', 'istudystepform'), get_string('agreement_condition_6_step_1_english_details', 'istudystepform'), get_string('agreement_condition_6_step_1_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_7_step_1_english',
		get_string('agreement_condition_7_step_1_english', 'istudystepform'), get_string('agreement_condition_7_step_1_english_details', 'istudystepform'), get_string('agreement_condition_7_step_1_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_8_step_1_english',
		get_string('agreement_condition_8_step_1_english', 'istudystepform'), get_string('agreement_condition_8_step_1_english_details', 'istudystepform'), get_string('agreement_condition_8_step_1_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	// Closing paragraph
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/closing_step_1_english',
		get_string('closing_step_1_english', 'istudystepform'), get_string('closing_step_1_english_details', 'istudystepform'), get_string('closing_step_1_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));

	// ---> S T E P  2  -  E N G L I S H <---
	$settings->add(new admin_setting_heading('mod_istudystepform/step_2_form_english',
        get_string('step_2_form_english', 'istudystepform'), get_string('step_2_form_english_details', 'istudystepform')));
	//Title of the form
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/title_step_2_english',
        get_string('title_step_2_english', 'istudystepform'), get_string('title_step_2_english_details', 'istudystepform'), get_string('title_step_2_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	//Paragraph 1 - before the reasons with checkboxes
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/reasons_for_step_2_english',
		get_string('reasons_for_step_2_english', 'istudystepform'), get_string('reasons_for_step_2_english_details', 'istudystepform'), get_string('reasons_for_step_2_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	// Four reasons for the step form - with checkboxes
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_1_step_2_english',
        get_string('reason_1_step_2_english', 'istudystepform'), get_string('reason_1_step_2_english_details', 'istudystepform'), get_string('reason_1_step_2_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_2_step_2_english',
        get_string('reason_2_step_2_english', 'istudystepform'), get_string('reason_2_step_2_english_details', 'istudystepform'), get_string('reason_2_step_2_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_3_step_2_english',
        get_string('reason_3_step_2_english', 'istudystepform'), get_string('reason_3_step_2_english_details', 'istudystepform'), get_string('reason_3_step_2_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_4_step_2_english',
        get_string('reason_4_step_2_english', 'istudystepform'), get_string('reason_4_step_2_english_details', 'istudystepform'), get_string('reason_4_step_2_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	// Reminder of master agreement - Intro paragraph and list of details
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_paragraph_step_2_english',
		get_string('agreement_paragraph_step_2_english', 'istudystepform'), get_string('agreement_paragraph_step_2_english_details', 'istudystepform'), get_string('agreement_paragraph_step_2_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_1_step_2_english',
		get_string('agreement_condition_1_step_2_english', 'istudystepform'), get_string('agreement_condition_1_step_2_english_details', 'istudystepform'), get_string('agreement_condition_1_step_2_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_2_step_2_english',
		get_string('agreement_condition_2_step_2_english', 'istudystepform'), get_string('agreement_condition_2_step_2_english_details', 'istudystepform'), get_string('agreement_condition_2_step_2_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_3_step_2_english',
		get_string('agreement_condition_3_step_2_english', 'istudystepform'), get_string('agreement_condition_3_step_2_english_details', 'istudystepform'), get_string('agreement_condition_3_step_2_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_4_step_2_english',
		get_string('agreement_condition_4_step_2_english', 'istudystepform'), get_string('agreement_condition_4_step_2_english_details', 'istudystepform'), get_string('agreement_condition_4_step_2_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_5_step_2_english',
		get_string('agreement_condition_5_step_2_english', 'istudystepform'), get_string('agreement_condition_5_step_2_english_details', 'istudystepform'), get_string('agreement_condition_5_step_2_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_6_step_2_english',
		get_string('agreement_condition_6_step_2_english', 'istudystepform'), get_string('agreement_condition_6_step_2_english_details', 'istudystepform'), get_string('agreement_condition_6_step_2_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_7_step_2_english',
		get_string('agreement_condition_7_step_2_english', 'istudystepform'), get_string('agreement_condition_7_step_2_english_details', 'istudystepform'), get_string('agreement_condition_7_step_2_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_8_step_2_english',
		get_string('agreement_condition_8_step_2_english', 'istudystepform'), get_string('agreement_condition_8_step_2_english_details', 'istudystepform'), get_string('agreement_condition_8_step_2_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	// Closing paragraph
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/closing_step_2_english',
		get_string('closing_step_2_english', 'istudystepform'), get_string('closing_step_2_english_details', 'istudystepform'), get_string('closing_step_2_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));

	// ---> S T E P  3  -  E N G L I S H <---
	$settings->add(new admin_setting_heading('mod_istudystepform/step_3_form_english',
        get_string('step_3_form_english', 'istudystepform'), get_string('step_3_form_english_details', 'istudystepform')));
	//Title of the form
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/title_step_3_english',
        get_string('title_step_3_english', 'istudystepform'), get_string('title_step_3_english_details', 'istudystepform'), get_string('title_step_3_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	//Paragraph 1 - before the reasons with checkboxes
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/reasons_for_step_3_english',
		get_string('reasons_for_step_3_english', 'istudystepform'), get_string('reasons_for_step_3_english_details', 'istudystepform'), get_string('reasons_for_step_3_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	// Four reasons for the step form - with checkboxes
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_1_step_3_english',
        get_string('reason_1_step_3_english', 'istudystepform'), get_string('reason_1_step_3_english_details', 'istudystepform'), get_string('reason_1_step_3_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_2_step_3_english',
        get_string('reason_2_step_3_english', 'istudystepform'), get_string('reason_2_step_3_english_details', 'istudystepform'), get_string('reason_2_step_3_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_3_step_3_english',
        get_string('reason_3_step_3_english', 'istudystepform'), get_string('reason_3_step_3_english_details', 'istudystepform'), get_string('reason_3_step_3_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_4_step_3_english',
        get_string('reason_4_step_3_english', 'istudystepform'), get_string('reason_4_step_3_english_details', 'istudystepform'), get_string('reason_4_step_3_english_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	// Closing paragraph
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/closing_step_3_english',
		get_string('closing_step_3_english', 'istudystepform'), get_string('closing_step_3_english_details', 'istudystepform'), get_string('closing_step_3_english_default', 'istudystepform'), PARAM_TEXT, 60, 4));

	// ---> S T E P  1  -  S P A N I S H <---
	$settings->add(new admin_setting_heading('mod_istudystepform/step_1_form_spanish',
        get_string('step_1_form_spanish', 'istudystepform'), get_string('step_1_form_spanish_details', 'istudystepform')));
	//Title of the form
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/title_step_1_spanish',
        get_string('title_step_1_spanish', 'istudystepform'), get_string('title_step_1_spanish_details', 'istudystepform'), get_string('title_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	//Paragraph 1 - before the reasons with checkboxes
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/reasons_for_step_1_spanish',
		get_string('reasons_for_step_1_spanish', 'istudystepform'), get_string('reasons_for_step_1_spanish_details', 'istudystepform'), get_string('reasons_for_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	// Four reasons for the step form - with checkboxes
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_1_step_1_spanish',
        get_string('reason_1_step_1_spanish', 'istudystepform'), get_string('reason_1_step_1_spanish_details', 'istudystepform'), get_string('reason_1_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_2_step_1_spanish',
        get_string('reason_2_step_1_spanish', 'istudystepform'), get_string('reason_2_step_1_spanish_details', 'istudystepform'), get_string('reason_2_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_3_step_1_spanish',
        get_string('reason_3_step_1_spanish', 'istudystepform'), get_string('reason_3_step_1_spanish_details', 'istudystepform'), get_string('reason_3_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_4_step_1_spanish',
        get_string('reason_4_step_1_spanish', 'istudystepform'), get_string('reason_4_step_1_spanish_details', 'istudystepform'), get_string('reason_4_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	// Reminder of master agreement - Intro paragraph and list of details
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_paragraph_step_1_spanish',
		get_string('agreement_paragraph_step_1_spanish', 'istudystepform'), get_string('agreement_paragraph_step_1_spanish_details', 'istudystepform'), get_string('agreement_paragraph_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_1_step_1_spanish',
		get_string('agreement_condition_1_step_1_spanish', 'istudystepform'), get_string('agreement_condition_1_step_1_spanish_details', 'istudystepform'), get_string('agreement_condition_1_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_2_step_1_spanish',
		get_string('agreement_condition_2_step_1_spanish', 'istudystepform'), get_string('agreement_condition_2_step_1_spanish_details', 'istudystepform'), get_string('agreement_condition_2_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_3_step_1_spanish',
		get_string('agreement_condition_3_step_1_spanish', 'istudystepform'), get_string('agreement_condition_3_step_1_spanish_details', 'istudystepform'), get_string('agreement_condition_3_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_4_step_1_spanish',
		get_string('agreement_condition_4_step_1_spanish', 'istudystepform'), get_string('agreement_condition_4_step_1_spanish_details', 'istudystepform'), get_string('agreement_condition_4_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_5_step_1_spanish',
		get_string('agreement_condition_5_step_1_spanish', 'istudystepform'), get_string('agreement_condition_5_step_1_spanish_details', 'istudystepform'), get_string('agreement_condition_5_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_6_step_1_spanish',
		get_string('agreement_condition_6_step_1_spanish', 'istudystepform'), get_string('agreement_condition_6_step_1_spanish_details', 'istudystepform'), get_string('agreement_condition_6_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_7_step_1_spanish',
		get_string('agreement_condition_7_step_1_spanish', 'istudystepform'), get_string('agreement_condition_7_step_1_spanish_details', 'istudystepform'), get_string('agreement_condition_7_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_8_step_1_spanish',
		get_string('agreement_condition_8_step_1_spanish', 'istudystepform'), get_string('agreement_condition_8_step_1_spanish_details', 'istudystepform'), get_string('agreement_condition_8_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	// Closing paragraph
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/closing_step_1_spanish',
		get_string('closing_step_1_spanish', 'istudystepform'), get_string('closing_step_1_spanish_details', 'istudystepform'), get_string('closing_step_1_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));

	// ---> S T E P  2  -  S P A N I S H <---
	$settings->add(new admin_setting_heading('mod_istudystepform/step_2_form_spanish',
        get_string('step_2_form_spanish', 'istudystepform'), get_string('step_2_form_spanish_details', 'istudystepform')));
	//Title of the form
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/title_step_2_spanish',
        get_string('title_step_2_spanish', 'istudystepform'), get_string('title_step_2_spanish_details', 'istudystepform'), get_string('title_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	//Paragraph 1 - before the reasons with checkboxes
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/reasons_for_step_2_spanish',
		get_string('reasons_for_step_2_spanish', 'istudystepform'), get_string('reasons_for_step_2_spanish_details', 'istudystepform'), get_string('reasons_for_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	// Four reasons for the step form - with checkboxes
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_1_step_2_spanish',
        get_string('reason_1_step_2_spanish', 'istudystepform'), get_string('reason_1_step_2_spanish_details', 'istudystepform'), get_string('reason_1_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_2_step_2_spanish',
        get_string('reason_2_step_2_spanish', 'istudystepform'), get_string('reason_2_step_2_spanish_details', 'istudystepform'), get_string('reason_2_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_3_step_2_spanish',
        get_string('reason_3_step_2_spanish', 'istudystepform'), get_string('reason_3_step_2_spanish_details', 'istudystepform'), get_string('reason_3_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_4_step_2_spanish',
        get_string('reason_4_step_2_spanish', 'istudystepform'), get_string('reason_4_step_2_spanish_details', 'istudystepform'), get_string('reason_4_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	// Reminder of master agreement - Intro paragraph and list of details
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_paragraph_step_2_spanish',
		get_string('agreement_paragraph_step_2_spanish', 'istudystepform'), get_string('agreement_paragraph_step_2_spanish_details', 'istudystepform'), get_string('agreement_paragraph_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_1_step_2_spanish',
		get_string('agreement_condition_1_step_2_spanish', 'istudystepform'), get_string('agreement_condition_1_step_2_spanish_details', 'istudystepform'), get_string('agreement_condition_1_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_2_step_2_spanish',
		get_string('agreement_condition_2_step_2_spanish', 'istudystepform'), get_string('agreement_condition_2_step_2_spanish_details', 'istudystepform'), get_string('agreement_condition_2_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_3_step_2_spanish',
		get_string('agreement_condition_3_step_2_spanish', 'istudystepform'), get_string('agreement_condition_3_step_2_spanish_details', 'istudystepform'), get_string('agreement_condition_3_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_4_step_2_spanish',
		get_string('agreement_condition_4_step_2_spanish', 'istudystepform'), get_string('agreement_condition_4_step_2_spanish_details', 'istudystepform'), get_string('agreement_condition_4_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_5_step_2_spanish',
		get_string('agreement_condition_5_step_2_spanish', 'istudystepform'), get_string('agreement_condition_5_step_2_spanish_details', 'istudystepform'), get_string('agreement_condition_5_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_6_step_2_spanish',
		get_string('agreement_condition_6_step_2_spanish', 'istudystepform'), get_string('agreement_condition_6_step_2_spanish_details', 'istudystepform'), get_string('agreement_condition_6_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_7_step_2_spanish',
		get_string('agreement_condition_7_step_2_spanish', 'istudystepform'), get_string('agreement_condition_7_step_2_spanish_details', 'istudystepform'), get_string('agreement_condition_7_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/agreement_condition_8_step_2_spanish',
		get_string('agreement_condition_8_step_2_spanish', 'istudystepform'), get_string('agreement_condition_8_step_2_spanish_details', 'istudystepform'), get_string('agreement_condition_8_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	// Closing paragraph
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/closing_step_2_spanish',
		get_string('closing_step_2_spanish', 'istudystepform'), get_string('closing_step_2_spanish_details', 'istudystepform'), get_string('closing_step_2_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));

	// ---> S T E P  3  -  S P A N I S H <---
	$settings->add(new admin_setting_heading('mod_istudystepform/step_3_form_spanish',
        get_string('step_3_form_spanish', 'istudystepform'), get_string('step_3_form_spanish_details', 'istudystepform')));
	//Title of the form
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/title_step_3_spanish',
        get_string('title_step_3_spanish', 'istudystepform'), get_string('title_step_3_spanish_details', 'istudystepform'), get_string('title_step_3_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	//Paragraph 1 - before the reasons with checkboxes
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/reasons_for_step_3_spanish',
		get_string('reasons_for_step_3_spanish', 'istudystepform'), get_string('reasons_for_step_3_spanish_details', 'istudystepform'), get_string('reasons_for_step_3_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
	// Four reasons for the step form - with checkboxes
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_1_step_3_spanish',
        get_string('reason_1_step_3_spanish', 'istudystepform'), get_string('reason_1_step_3_spanish_details', 'istudystepform'), get_string('reason_1_step_3_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_2_step_3_spanish',
        get_string('reason_2_step_3_spanish', 'istudystepform'), get_string('reason_2_step_3_spanish_details', 'istudystepform'), get_string('reason_2_step_3_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_3_step_3_spanish',
        get_string('reason_3_step_3_spanish', 'istudystepform'), get_string('reason_3_step_3_spanish_details', 'istudystepform'), get_string('reason_3_step_3_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	$settings->add(new admin_setting_configtext_with_maxlength('mod_istudystepform/reason_4_step_3_spanish',
        get_string('reason_4_step_3_spanish', 'istudystepform'), get_string('reason_4_step_3_spanish_details', 'istudystepform'), get_string('reason_4_step_3_spanish_default', 'istudystepform'), PARAM_TEXT, 100, 200));
	// Closing paragraph
	$settings->add(new admin_setting_configtextarea('mod_istudystepform/closing_step_3_spanish',
		get_string('closing_step_3_spanish', 'istudystepform'), get_string('closing_step_3_spanish_details', 'istudystepform'), get_string('closing_step_3_spanish_default', 'istudystepform'), PARAM_TEXT, 60, 4));
}