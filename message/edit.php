<?php
use local_message\form\edit;

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot. '/local/message/classes/form/edit.php');

$PAGE->set_url(new moodle_url('/local/message/edit.php'));
$PAGE->set_context(\context_system::instance()); // The global context will be used
$PAGE->set_title('Edit Page');

$mform = new edit();

if ($mform->is_cancelled()) {
    // Go back to manage.php page
    redirect($CFG->wwwroot . '/local/message/manage.php', 'The message creation was cancelled');

} else if ($fromform = $mform->get_data()) {

    // Insert the data in the DB
    $recordToInsert = new stdClass();
    $recordToInsert->messagetext = $fromform->messagetext;
    $recordToInsert->messagetype = $fromform->messagetype;

    // Parameters: Table name, new record;
    $DB->insert_record('local_message', $recordToInsert);

    // Go back to manage.php page
    redirect($CFG->wwwroot . '/local/message/manage.php', 'The message '. $fromform->messagetext. ' was created');
}

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();