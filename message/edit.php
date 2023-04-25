<?php
use local_message\form\edit;

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot. '/local/message/classes/form/edit.php');

$PAGE->set_url(new moodle_url('/local/message/edit.php'));
$PAGE->set_context(\context_system::instance()); // The global context will be used
$PAGE->set_title('Edit Page');

// If an id of message is passed in the query catch it
$messageid = optional_param('messageid', null, PARAM_INT);

$mform = new edit();

if ($mform->is_cancelled()) {
    // Go back to manage.php page
    redirect($CFG->wwwroot . '/local/message/manage.php', 'The message creation/update was cancelled');

} else if ($fromform = $mform->get_data()) {
    // If the message already has an id is because it needs to be updated
    if ($fromform->id) {
        $object = new stdClass();
        $object->id = $fromform->id;
        $object->messagetext = $fromform->messagetext;
        $object->messagetype = $fromform->messagetype;
        $DB->update_record('local_message', $object);

        redirect($CFG->wwwroot . '/local/message/manage.php', 'The message '. $fromform->messagetext. ' was updated');
    }

    // Create a new message

    // Insert the data in the DB
    $recordToInsert = new stdClass();
    $recordToInsert->messagetext = $fromform->messagetext;
    $recordToInsert->messagetype = $fromform->messagetype;

    // Parameters: Table name, new record;
    $DB->insert_record('local_message', $recordToInsert);

    // Go back to manage.php page
    redirect($CFG->wwwroot . '/local/message/manage.php', 'The message '. $fromform->messagetext. ' was created');
}

if ($messageid) {
    // Add extra data to the form.
    global $DB;
    
    $message = $DB->get_record('local_message', ['id' => $messageid]);
    if (!$message) {
        throw new invalid_parameter_exception('Message not found');
    }
    $mform->set_data($message);
}

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();