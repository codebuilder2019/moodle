<?php
require_once(__DIR__ . '/../../config.php');

global $DB;

require_login();
$context = context_system::instance();

$PAGE->set_url(new moodle_url('/local/message/la_test.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title("LA Test Page");
$PAGE->set_heading("LA Test Page");

$predictions = $DB->get_records('analytics_predictions', null, 'id');

echo $OUTPUT->header();
$templatecontext = (object)[
    'predictions' => array_values($predictions)
];

echo $OUTPUT->render_from_template('local_message/la_test', $templatecontext);
echo $OUTPUT->footer();