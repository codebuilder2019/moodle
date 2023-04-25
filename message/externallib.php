<?php

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . "/externallib.php");

class local_message_external extends external_api  {
    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function delete_message_parameters() {
        return new external_function_parameters(
            ['messageid' => new external_value(PARAM_INT, 'id of message')],
        );
    }

    /**
     * The function itself
     * @return string welcome message
     */
    public static function delete_message($messageid): string {
        $params = self::validate_parameters(self::delete_message_parameters(), array('messageid'=>$messageid));

        global $DB;
        $transaction = $DB->start_delegated_transaction();
        $deletedMessage = $DB->delete_records('local_message', ['id' => $messageid]);
        $deletedRead = $DB->delete_records('local_message_read', ['messageid' => $messageid]);
        if ($deletedMessage && $deletedRead) {
            $DB->commit_delegated_transaction($transaction);
        }
        return true;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function delete_message_returns() {
        return new external_value(PARAM_BOOL, 'True if the message was successfully deleted.');
    }
}