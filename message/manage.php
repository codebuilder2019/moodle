<?php
require_once(__DIR__ . '/../../config.php');

global $DB;

require_login();
$context = context_system::instance();

$PAGE->set_url(new moodle_url('/local/message/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title("Manage Page");
$PAGE->set_heading("Manage Page");
$PAGE->requires->js_call_amd('local_message/confirm');
$PAGE->requires->css('/local/message/styles.css');

$messages = $DB->get_records('local_message', null, 'id');

echo $OUTPUT->header();
$templatecontext = (object)[
    'messages' => array_values($messages),
    'editurl' => new moodle_url('/local/message/edit.php'),
];

echo $OUTPUT->render_from_template('local_message/manage', $templatecontext);

echo $OUTPUT->footer();