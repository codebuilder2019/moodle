<?php

function local_message_before_footer() {
    \core\notification::add("Exito", \core\output\notification::NOTIFY_SUCCESS);
}