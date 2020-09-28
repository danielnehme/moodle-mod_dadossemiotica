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
 * @package   mod_dadossemiotica
 * @copyright 2020 Conexum <conexum@conexum.com.br>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    'mod/dadossemiotica:view' => array( // The following archetypes are recommended for the view capability (to maintain consistancy).
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'guest' => CAP_ALLOW,
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        )
    ),

    'mod/dadossemiotica:addinstance' => array(
        'riskbitmask' => RISK_XSS,
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
        'clonepermissionsfrom' => 'moodle/course:manageactivities'
    ),

    'mod/dadossemiotica:administrateuserinput' => array (
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:create' => array ( // Create annotation or comment.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:deleteown' => array ( // Delete own comments or annotations.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:deleteany' => array ( // Delete all comments or annotations (including comments/annotations by other users).
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:hidecomments' => array (
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:seehiddencomments' => array (
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:edit' => array ( // Update/Edit own annotations or comments.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:editanypost' => array( // Update/Edit all annotations or comments.
        'riskbitmask' => RISK_SPAM,
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        )
    ),

    'mod/dadossemiotica:report' => array ( // Report comments.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:vote' => array ( // Give an interesting question or a helpful comment your vote.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:subscribe' => array ( // Subscribe to a question for notifications about new answers.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:closequestion' => array ( // Close/Open own questions.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:closeanyquestion' => array( // Close/Open all questions.
        'riskbitmask' => RISK_SPAM,
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        )
    ),

    'mod/dadossemiotica:markcorrectanswer' => array( // Mark answers as correct.
        'riskbitmask' => RISK_SPAM,
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        )
    ),

    'mod/dadossemiotica:usetextbox' => array ( // Always use textbox (even if using textbox (for students) is disabled in settings).
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:usedrawing' => array ( // Always use drawing (even if using textbox (for students) is disabled in settings).
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:printdocument' => array ( // Download the pdf document.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:printcomments' => array ( // Download a pdf with all comments in this document.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:forwardquestions' => array ( // Forward a question (to an other teacher/manager).
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:getforwardedquestions' => array ( // Receive forwarded questions.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),


    // Get a notification about new questions.
    'mod/dadossemiotica:recievenewquestionnotifications' => array (
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),
    ),

    'mod/dadossemiotica:viewstatistics' => array ( // View statistics page.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
            'manager' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
        ),
    ),

    'mod/dadossemiotica:viewteacherstatistics' => array ( // See additional information on statistics page.
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
        ),
    ),


    /* ********************** capabilities for viewing the overview page **********************/

    // View reports of comments.
    'mod/dadossemiotica:viewreports' => array (
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
        ),
    ),

    // View answers to questions you wrote or subscribed to.
    'mod/dadossemiotica:viewanswers' => array (
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
        ),
    ),

    // View all questions that are new in this course.
    'mod/dadossemiotica:viewquestions' => array (
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
            'manager' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
        ),
    ),

    // View all self-written posts, be it questions or comments.
    'mod/dadossemiotica:viewposts' => array (
        'captype' => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'student' => CAP_ALLOW,
            'manager' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
        ),
    ),

);
