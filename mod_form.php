<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * The main mod_dadossemiotica configuration form.
 *
 * @package     mod_dadossemiotica
 * @copyright   2020 Conexum <conexum@conexum.com.br>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->libdir . '/filelib.php');
require_once($CFG->dirroot . '/mod/dadossemiotica/lib.php');

/**
 * Module instance settings form.
 *
 * @author Daniel Muller
 */

class mod_dadossemiotica_mod_form extends moodleform_mod
{

    /**
     * Defines forms elements
     */
    public function definition()
    {
        global $CFG;

        $mform =& $this->_form;

        // Adding the "general" fieldset, where all the common settings are shown.
        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Adding the standard "name" field.
        $mform->addElement('text', 'name', get_string('dadossemioticaname', 'mod_dadossemiotica'), array('size' => '64'));

        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }

        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        $mform->addHelpButton('name', 'dadossemioticaname', 'mod_dadossemiotica');

        // Adding the standard "intro" and "introformat" fields.
        if ($CFG->branch >= 29) {
            $this->standard_intro_elements();
        } else {
            $this->add_intro_editor();
        }

        $mform->addElement('filemanager', 'arqs',
            get_string('setting_fileupload', 'mod_dadossemiotica'), null,
            $this->get_filemanager_options_array());
        $mform->addRule('arqs', null, 'required', null, 'client');
        $mform->addHelpButton('arqs', 'setting_fileupload', 'mod_dadossemiotica');

/*
        // Issue options.

        $mform->addElement('header', 'issueoptions', get_string('issueoptions', 'mod_dadossemiotica'));

        // Email to teachers ?
        $mform->addElement('selectyesno', 'emailauthors', get_string('emailauthors', 'mod_dadossemiotica'));
        $mform->setDefault('emailauthors', 0);
        $mform->addHelpButton('emailauthors', 'emailauthors', 'mod_dadossemiotica');

        // Email Others.
        $mform->addElement('text', 'emailothers', get_string('emailothers', 'mod_dadossemiotica'), array('size' => '40', 'maxsize' => '200'));
        $mform->setType('emailothers', PARAM_TEXT);
        $mform->addHelpButton('emailothers', 'emailothers', 'mod_dadossemiotica');

        // Email From.
        $mform->addElement('text', 'emailfrom', get_string('emailfrom', 'mod_dadossemiotica'), array('size' => '40', 'maxsize' => '200'));
        $mform->setDefault('emailfrom', $CFG->supportname);
        $mform->setType('emailfrom', PARAM_EMAIL);
        $mform->addHelpButton('emailfrom', 'emailfrom', 'mod_dadossemiotica');
        $mform->setAdvanced('emailfrom');

        // Delivery Options (Email, Download,...).
        $deliveryoptions = array(
            0 => get_string('openbrowser', 'mod_dadossemiotica'),
            1 => get_string('download', 'mod_dadossemiotica'),
            2 => get_string('emailbook', 'mod_dadossemiotica'),
            3 => get_string('nodelivering', 'mod_dadossemiotica'),
            4 => get_string('emailoncompletion', 'mod_dadossemiotica'),
        );

        $mform->addElement('select', 'delivery', get_string('delivery', 'mod_dadossemiotica'), $deliveryoptions);
        $mform->setDefault('delivery', 0);
        $mform->addHelpButton('delivery', 'delivery', 'mod_dadossemiotica');
*/

        // Add standard elements.
        $this->standard_coursemodule_elements();

        // Add standard buttons.
        $this->add_action_buttons();
    }


    /**
     * Prepares the form before data are set
     *
     * Additional wysiwyg editor are prepared here, the introeditor is prepared automatically by core.
     * Grade items are set here because the core modedit supports single grade item only.
     *
     * @param array $data to be set
     * @return void
     */
    public function data_preprocessing(&$data) {
        // require_once(dirname(__FILE__) . '/locallib.php');
        // $fileinfo = simplecertificate::get_dadossemiotica_fileinfo($this->context);
        //file_prepare_draft_area($draftitemid, $fileinfo['contextid'],
        //                $fileinfo['component'], $fileinfo['filearea'],
        //                $fileinfo['itemid'],
        //                $this->get_filemanager_options_array());
        parent::data_preprocessing($data);
        if ($this->current->instance) {
            $contextid = $this->context->id;
            $draftitemid = file_get_submitted_draft_itemid('arqs');
            file_prepare_draft_area($draftitemid, $contextid, 'mod_dadossemiotica', 'arqs', 1, $this->get_filemanager_options_array());
            global $USER;
            $usercontext = context_user::instance($USER->id);
            $fs = get_file_storage();
            $files = $fs->get_area_files($usercontext->id, 'user', 'draft', $draftitemid, 'id', false);
            $data['arqs'] = $draftitemid;

            //var_dump($files);
            //foreach ($files as $f) {
            //    echo $f->get_filename() . '<br />';
            //}
            //echo " :: data_preprocessing";
        }
    }



    public function data_postprocessing($data) {

        // File manager always creata a Files folder, so certimages is never empty.
        // I must check if it has a file or it's only a empty files folder reference.
        //if (isset($data->arqs) && !empty($data->arqs)
        //    && !$this->check_has_files('arqs')) {
        //        $data->arqs = null;
        //}
        global $USER;
        $usercontext = context_user::instance($USER->id);
        $fs = get_file_storage();
        if ($files = $fs->get_area_files($usercontext->id, 'user', 'draft', $data->arqs, 'sortorder, id', false)) {
            file_save_draft_area_files($data->arqs, $this->context->id, 'mod_dadossemiotica', 'arqs', 1, $this->get_filemanager_options_array());
            //foreach ($files as $f) {
            //    echo $f->get_filename() . '<br />';
            //}
        }
    }

/*
    private function check_has_files($itemname) {
        global $USER;

        $draftitemid = file_get_submitted_draft_itemid($itemname);
        file_prepare_draft_area($draftitemid, $this->context->id, 'mod_dadossemiotica', 'arqs', null,
                                $this->get_filemanager_options_array());

        // Get file from users draft area.
        $usercontext = context_user::instance($USER->id);
        $fs = get_file_storage();
        $files = $fs->get_area_files($usercontext->id, 'user', 'draft', $draftitemid, 'id', false);
        //var_dump($files);

        //echo " :: check_has_files :: " . count($files);
        if (count($files) == 1) {
            file_save_draft_area_files($draftitemid, $this->context->id, 'mod_dadossemiotica', 'arqs', 1, $this->get_filemanager_options_array());
            //echo " :: check_has_files :: ENTROU :: " . count($files);
        }

        return (count($files) > 0);
    }
*/

    private function get_filemanager_options_array()
    {
        //global $COURSE;
        //'maxbytes' => $COURSE->maxbytes,

        return array('subdirs' => false, 'maxfiles' => 1,'accepted_types' => array('.pdf'));
    }

    /**
     * Some basic validation
     *
     * @param $data
     * @param $files
     * @return array
     */
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        global $USER;
        $usercontext = context_user::instance($USER->id);
        $fs = get_file_storage();
        if (!$files = $fs->get_area_files($usercontext->id, 'user', 'draft', $data['arqs'], 'sortorder, id', false)) {
            $errors['arqs'] = get_string('required');
            return $errors;
        }

        return $errors;
    }


}
