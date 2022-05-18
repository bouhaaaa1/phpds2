<?php
/**
 * Check if the session has already been started
 * @return boolean
 */
function is_session_started() {
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(PHP_VERSION, '5.4.0', '>=') ) {
            return (session_status() === PHP_SESSION_ACTIVE);
        } else {
            return (session_id() !== '');
        }
    }
    return false;
}