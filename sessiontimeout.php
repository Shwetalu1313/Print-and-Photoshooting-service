<?php
// start the session
// session_start();

// check for expired session
function sessionTimeOut($timeoutNumSec) {
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeoutNumSec)) {
        // session has expired
        session_unset();
        session_destroy();
        echo '<script>';
        echo 'alert("Your session has expired. Please login again.");';
        echo 'window.location.href = "customer_L_R.php";';
        echo '</script>';
    }
    // update last activity time stamp
    $_SESSION['LAST_ACTIVITY'] = time();
    return false;
}


?>
