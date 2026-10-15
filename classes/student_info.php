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

/**
 * Class get_info
 *
 * @package    mod_istudystepform
 * @copyright  2024 Jesus Ramirez <jram1993@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class student_info {

    public static function get_stepform($student_id, $step_number, $days_behind, $date_today, $reason, $comment) {
        /**
         * Initialize the titles for the forms.
         */
        $title_english[1] = get_config('mod_istudystepform', 'title_step_1_english');
        $title_english[2] = get_config('mod_istudystepform', 'title_step_2_english');
        $title_english[3] = get_config('mod_istudystepform', 'title_step_3_english');
        $title_spanish[1] = get_config('mod_istudystepform', 'title_step_1_spanish');
        $title_spanish[2] = get_config('mod_istudystepform', 'title_step_2_spanish');
        $title_spanish[3] = get_config('mod_istudystepform', 'title_step_3_spanish');
        /**
         * Create the checkboxes - 0 is an empty box and 1 is a checked box.
         */
        $check_box[0] = '&#9744';
        $check_box[1] = '&#9745';
        /**
         * Set the phone number for the school.
         */
        $school_phone = get_config('mod_istudy', 'schoolphone');
        /**
         * Master Agreement conditions that must be met in a table.
         */
        $number_of_condtions = get_config('mod_istudystepform', 'conditions_agreement');
        /**
         * Create column one.
         */
        $conditions_step_1_english = '<table class="table1"><tr><col width="50%"><col width="50%"><td valign="top"><div><ul>';
        $conditions_step_2_english = '<table class="table1"><tr><col width="50%"><col width="50%"><td valign="top"><div><ul>';
        $conditions_step_1_spanish = '<table class="table1"><tr><col width="50%"><col width="50%"><td valign="top"><div><ul>';
        $conditions_step_2_spanish = '<table class="table1"><tr><col width="50%"><col width="50%"><td valign="top"><div><ul>';
        for ($i = 1; $i <= 4; $i++){
            $conditions_step_1_english = $conditions_step_1_english . '<li>' . get_config('mod_istudystepform', 'agreement_condition_' . $i . '_step_1_english') . '</li>';
            $conditions_step_2_english = $conditions_step_2_english . '<li>' . get_config('mod_istudystepform', 'agreement_condition_' . $i . '_step_2_english') . '</li>';
            $conditions_step_1_spanish = $conditions_step_1_spanish . '<li>' . get_config('mod_istudystepform', 'agreement_condition_' . $i . '_step_1_spanish') . '</li>';
            $conditions_step_2_spanish = $conditions_step_2_spanish . '<li>' . get_config('mod_istudystepform', 'agreement_condition_' . $i . '_step_2_spanish') . '</li>';
        }
        $conditions_step_1_english = $conditions_step_1_english . '</ul></div></td><td valign="top"><div><ul>';
        $conditions_step_2_english = $conditions_step_2_english . '</ul></div></td><td valign="top"><div><ul>';
        $conditions_step_1_spanish = $conditions_step_1_spanish . '</ul></div></td><td valign="top"><div><ul>';
        $conditions_step_2_spanish = $conditions_step_2_spanish . '</ul></div></td><td valign="top"><div><ul>';
        /**
         * Create column two.
         */
        for ($i = 5; $i <= $number_of_condtions; $i++) {
            $conditions_step_1_english = $conditions_step_1_english . '<li>' . get_config('mod_istudystepform', 'agreement_condition_' . $i . '_step_1_english') . '</li>';
            $conditions_step_2_english = $conditions_step_2_english . '<li>' . get_config('mod_istudystepform', 'agreement_condition_' . $i . '_step_2_english') . '</li>';
            $conditions_step_1_spanish = $conditions_step_1_spanish . '<li>' . get_config('mod_istudystepform', 'agreement_condition_' . $i . '_step_1_spanish') . '</li>';
            $conditions_step_2_spanish = $conditions_step_2_spanish . '<li>' . get_config('mod_istudystepform', 'agreement_condition_' . $i . '_step_2_spanish') . '</li>';
        }
        $conditions_step_1_english = $conditions_step_1_english . '</ul></div></td></tr></table>';
        $conditions_step_2_english = $conditions_step_2_english . '</ul></div></td></tr></table>';
        $conditions_step_1_spanish = $conditions_step_1_spanish . '</ul></div></td></tr></table>';
        $conditions_step_2_spanish = $conditions_step_2_spanish . '</ul></div></td></tr></table>';
        /**
         * Create the final paragraphs.
         */
        $paragraph_english[1] = '<p>Your student is now <b><u>' . $days_behind . '</u></b> days behind in work. ' .
            get_config('mod_istudystepform', 'agreement_paragraph_step_1_english')  . '</p><br>' . $conditions_step_1_english .
            '<br><p>' . get_config('mod_istudystepform', 'closing_step_1_english') . '</p>';
        $paragraph_english[2] = '<p>Your student is now <b><u>' . $days_behind . '</u></b> days behind in work. ' .
            get_config('mod_istudystepform', 'agreement_paragraph_step_2_english')  . '</p><br>' . $conditions_step_2_english .
            '<br><p>' . get_config('mod_istudystepform', 'closing_step_2_english') . '</p>';
        $paragraph_english[3] = '<br><p>' . get_config('mod_istudystepform', 'closing_step_3_english') . '</p>';
        $paragraph_spanish[1] = '<p>Su estudiante está ahora <b><u>' . $days_behind . '</u></b> días atrasado/a en el trabajo. ' .
            get_config('mod_istudystepform', 'agreement_paragraph_step_1_spanish')  . '</p><br>' . $conditions_step_1_spanish .
            '<br><p>' . get_config('mod_istudystepform', 'closing_step_1_spanish') . '</p>';
        $paragraph_spanish[2] = '<p>Su estudiante está ahora <b><u>' . $days_behind . '</u></b> días atrasado/a en el trabajo. ' .
            get_config('mod_istudystepform', 'agreement_paragraph_step_2_spanish')  . '</p><br>' . $conditions_step_2_spanish .
            '<br><p>' . get_config('mod_istudystepform', 'closing_step_2_spanish') . '</p>';
        $paragraph_spanish[3] = '<br><p>' . get_config('mod_istudystepform', 'closing_step_3_spanish') . '</p>';
        /**
         * Prepare step form in English.
         *
         * Create the title for the individual card.
         */
        $student_card = '<link rel="stylesheet" type="text/css" href="styles_stepform.css"><html><head><title>Step Forms</title></head><body><h1>' .
                        get_config('mod_istudy', 'schoolname') . '</h1><h1>' . $title_english[$step_number] . '</h1><br>';
        /**
         * Student demographics.
         */
        $student_info = utils::get_singlestudent($student_id);
        $student_card = $student_card . '<table class="table2"><tr><col width="15%"><col width="45%"><col width="10%"><col width="5%"><col width="10%"><col width="15%">' .
            '<th><b>Student Name:</b></th><td>' . $student_info->lastname . ', ' . $student_info->firstname .
            '</td><th><b>Grade:</b></th><td>' . $student_info->gradelevel . '</td><th><b>ID#:</b></th><td>' . $student_info->schoolid . '</td></tr>';
        $student_card = $student_card . '<tr><th align="right"><b>Parent/Guardian:</b></th><td align="left" colspan="3">' . $student_info->parentname .
            '</td><th align="right"><b>Phone#:</b></th><td align="left">' . $student_info->homephone . '</td></tr>';
        /**
         * Get address and city and make adjustments if 1 or both are missing.
         */
        $address_and_city = '';
        if ($student_info->address <> '' AND $student_info->city <> '') {
            $address_and_city = $student_info->address . ', ' . $student_info->city;
        }
        else if ($student_info->address <> '' OR $student_info->city <> '') {
            $address_and_city = $student_info->address . $student_info->city;
        }
        $student_card = $student_card . '<tr><th align="right"><b>Address:</b></th><td align="left" colspan="3">' . $address_and_city .
            '</td><th align="right"><b>DOB:</b></th><td align="left">' . $student_info->birthdate . '</td></tr>';
        $student_card = $student_card . '</table>';
        $student_card = $student_card . '<br><p>Dear Parent/Guardian:</p>';
        $student_card = $student_card . '<p>' .  get_config('mod_istudystepform', 'reasons_for_step_' . $step_number . '_english') . '</p>';
        $student_card = $student_card . '<table class="table4"><tr><col width="5%"><col width="95%">' .
            '<th>' . $check_box[$reason->one] . '</th><td>' . get_config('mod_istudystepform', 'reason_1_step_' . $step_number . '_english') . '</td></tr>' .
            '<tr><th>' . $check_box[$reason->two] . '</th><td>' . get_config('mod_istudystepform', 'reason_2_step_' . $step_number . '_english') . '</td></tr>' .
            '<tr><th>' . $check_box[$reason->three] . '</th><td>' . get_config('mod_istudystepform', 'reason_3_step_' . $step_number . '_english') . '</td></tr>' .
            '<tr><th>' . $check_box[$reason->four] . '</th><td>' . get_config('mod_istudystepform', 'reason_4_step_' . $step_number . '_english') . '</td></tr></table><br>';
        $student_card = $student_card . '<table class="table2"><tr><col width="20%"><col width="80%">' .
            '<th>Teacher comments:</th><td>' . utils::remove_extra_symbols($comment->english) . '</td></tr></table><br>';
        $student_card = $student_card . $paragraph_english[$step_number] .
            '<p align="left">Sincerely,</p><br>';
        $student_card = $student_card . '<table class="table3"><tr><col width="54%"><col width="3%"><col width="13%"><col width="1%"><col width="15%"><td></td><th></th>' .
            '<th class="mycell3">Date:</th><th></th><td>' . $date_today . '</td></tr><tr><th class="mycell2">Teacher' .
            $student_info->advisor_english . '</th><th></th><th class="mycell3">Phone Number:</th><th></th><td>' . $school_phone . '</td></tr>' .
            '<tr><th></th><th></th><th class="mycell3">Extension:</th><th></th><td>' . $student_info->roomextension . '</td></tr></table>';
        /**
         * Prepare step form in Spanish.
         */
        $student_card = $student_card . '<P style="page-break-before: always">';
        /**
         * Create the title for the individual card.
         */
        $student_card = $student_card . '<h1>' . get_config('mod_istudy', 'schoolname') . '</h1><h1>' . $title_spanish[$step_number] . '</h1><br>';
        /**
         * Get the student demographics.
         */
        $student_info = utils::get_singlestudent($student_id);
        $student_card = $student_card . '<table class="table2"><tr><col width="15%"><col width="45%"><col width="10%"><col width="5%"><col width="10%"><col width="15%">' .
            '<th><b>Nombre:</b></th><td>' . $student_info->lastname . ', ' . $student_info->firstname .
            '</td><th><b>Grado:</b></th><td>' . $student_info->gradelevel . '</td><th><b>ID#:</b></th><td>' . $student_info->schoolid . '</td></tr>';
        $student_card = $student_card . '<tr><th align="right"><b>Padre/Guardián:</b></th><td align="left" colspan="3">' . $student_info->parentname .
            '</td><th align="right"><b>Teléfono:</b></th><td align="left">' . $student_info->homephone . '</td></tr>';
        $student_card = $student_card . '<tr><th align="right"><b>Domicilio:</b></th><td align="left" colspan="3">' . $student_info->address .
            $student_info->city . '</td><th align="right"><b>Fec. Nac.:</b></th><td align="left">' . $student_info->birthdate . '</td></tr>';
        $student_card = $student_card . '</table>';
        $student_card = $student_card . '<br><p>Estimados Padres/Guardianes:</p>';
        $student_card = $student_card . '<p>' .  get_config('mod_istudystepform', 'reasons_for_step_' . $step_number . '_spanish') . '</p>';
        $student_card = $student_card . '<table class="table4"><tr><col width="5%"><col width="95%">' .
            '<th>' . $check_box[$reason->one] . '</th><td>' . get_config('mod_istudystepform', 'reason_1_step_' . $step_number . '_spanish') . '</td></tr>' .
            '<tr><th>' . $check_box[$reason->two] . '</th><td>' . get_config('mod_istudystepform', 'reason_2_step_' . $step_number . '_spanish') . '</td></tr>' .
            '<tr><th>' . $check_box[$reason->three] . '</th><td>' . get_config('mod_istudystepform', 'reason_3_step_' . $step_number . '_spanish') . '</td></tr>' .
            '<tr><th>' . $check_box[$reason->four] . '</th><td>' . get_config('mod_istudystepform', 'reason_4_step_' . $step_number . '_spanish') . '</td></tr></table><br>';
        $student_card = $student_card . '<table class="table2"><tr><col width="20%"><col width="80%">' .
            '<th>Maestro-Comentarios:</th><td>' . utils::remove_extra_symbols($comment->spanish) . '</td></tr></table><br>';
        $student_card = $student_card . $paragraph_spanish[$step_number] .
            '<p align="left">Atentamente,</p><br>';
        $student_card = $student_card . '<table class="table3"><tr><col width="54%"><col width="3%"><col width="13%"><col width="1%"><col width="15%"><td></td><th></th>' .
            '<th class="mycell3">Fecha:</th><th></th><td>' . $date_today . '</td></tr><tr><th class="mycell2"> Maestro(a)' .
            $student_info->advisor_spanish . '</th><th></th><th class="mycell3">Teléfono:</th><th></th><td>' . $school_phone . '</td></tr>' .
            '<tr><th></th><th></th><th class="mycell3">Extensión:</th><th></th><td>' . $student_info->roomextension . '</td></tr></table></bodyd></html>';
        return $student_card;
    }

    /**
     * Create envelope with home address of the student.
     *
     * @param [integer] $this_studentid
     * @param [text] $print_envelope
     * @return html
     */
    public static function get_envelopes($this_studentid, $print_envelope) {
        // Get the student home address.
        $student_info = utils::get_singlestudent($this_studentid);
        $parent_address_label = '<p class="main_address">' . $student_info->parentname .  '<br>' .
            $student_info->address . '<br>' .
            $student_info->city . '</p>';
        // Get school address.
        $school_name = get_config('mod_istudy', 'schoolname');
        $school_address = get_config('mod_istudy', 'schooladdress');
        $school_city = get_config('mod_istudy', 'schoolcity') . ', ' . get_config('mod_istudy', 'schoolstate') . ' ' . get_config('mod_istudy', 'schoolzip');
        $school_address_label = '<p>' . $school_name . '<br>' .
            $school_address . '<br>' .
            $school_city . '</p>';
        $student_envelope = '<link rel="stylesheet" type="text/css" href="styles_envelope.css"><html><head><title>Envelopes</title></head><body><div>';
        if ($print_envelope == 3) {
            $student_envelope = $student_envelope . '<p>' . $school_address_label . '</p>';
        }
        else {
            $student_envelope = $student_envelope . '<p><br><br><br></p>';
        }
        $student_envelope = $student_envelope . '<br><br><br><br><br><p>' . $parent_address_label . '</p>' .
            '</div><br></body><footer></footer></html>';
        return $student_envelope;
    }
}