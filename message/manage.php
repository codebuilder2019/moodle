<?php
require_once(__DIR__ . '/../../config.php');

$PAGE->set_url(new moodle_url('/local/message/manage.php'));
$PAGE->set_context(\context_system::instance()); // The global context will be used
$PAGE->set_title(get_string('Manage Page'));

$employee1 = ["name" => "John", "department" => "Sales"];
$employee2 = ["name" => "Mark", "department" => "Security"];
$employees = array_values([$employee1, $employee2]);

// The template has its own context
$templatecontext = (object)[
    'employees' => $employees,
    'message' => "This is the view for hired employees"
];

echo $OUTPUT->header();

// To call the mustache provide its location and its context
echo $OUTPUT->render_from_template('local_message/manage', $templatecontext);

echo $OUTPUT->footer();