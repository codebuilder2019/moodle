<?php
use local_message\form\edit;

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot. '/local/message/classes/form/edit.php');

$PAGE->set_url(new moodle_url('/local/message/edit.php'));
$PAGE->set_context(\context_system::instance()); // The global context will be used
$PAGE->set_title('Edit Page');

// We want to display our form.
$mform = new edit();

echo $OUTPUT->header();

$mform->display();

echo $OUTPUT->footer();