<?php

function local_message_before_footer() {
    //\core\notification::add("Exito", \core\output\notification::NOTIFY_SUCCESS);
    global $OUTPUT;

    $templatecontext = (object)[
        'manageurl' => new moodle_url('/local/message/manage.php'),
        'laurl' => new moodle_url('/local/message/la_test.php')
    ];
    
    return $OUTPUT->render_from_template('local_message/manage_button', $templatecontext);
}

function tool_callbacktest_before_standard_top_of_body_html() {
    return "<div style='background: red'>Before standard top of body html</div>";
}