<?php 
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Function to check admin permissions
function checkAdminAccess($requiredLevel = 4) {
    if (!isset($_SESSION['admin_type'])) {
        http_response_code(403);
        die('Unauthorized access');
    }

    $admin_flag = $_SESSION['admin_type'];
    
    if ($admin_flag < $requiredLevel) {
        http_response_code(403);
        die('Unauthorized access');
    }
    
    return true;
}


function checkUserAccess($requiredLevel = 0) {
    if (!isset($_SESSION['user_type'])) {
        http_response_code(403);
        die('Unauthorized access');
    }

    if($_SESSION['user_type'] !== "P"){
        http_response_code(403);
        die('Unauthorized access');
    }
}

function checkOrgAccess($orgID = 0) {
    if (!isset($_SESSION['orgID'])) {
        http_response_code(403);
        die('Unauthorized access');
    }

    $admin_flag = (float)$_SESSION['admin_type'];
    
    if ($_SESSION['orgID'] == 0) {
        http_response_code(403);
        die('Unauthorized access');
    }
    
    return true;
}


function checkPoliAccess() {
    if (!isset($_SESSION['user_type'])) {
        http_response_code(403);
        die('Unauthorized access');
    }
    
    if ($_SESSION['user_type'] !== "EP") {
        http_response_code(403);
        die('Unauthorized access');
    }
    
    return true;
}


function checkPINAccess($requiredLevel = 0) {
    if (!isset($_SESSION['pin_status'])) {
        http_response_code(403);
        die('Unauthorized access');
    }

    $pin_status = (int)$_SESSION['pin_status'];
    
    if ($pin_status !== 3) {
        http_response_code(403);
        die('Unauthorized access');
    }
    
    return true;
}

function checkStudentAccess($requiredLevel = 0) {
    if (!isset($_SESSION['student_flag'])) {
        http_response_code(403);
        die('Unauthorized access');
    }

    if($_SESSION['student_flag'] == true){
        http_response_code(403);
        die('Unauthorized access');
    }
}


function checkWriterEditorPoliticianAccess() {
    if (!isset($_SESSION['user_type'])) {
        http_response_code(403);
        die('Unauthorized access');
    }

    if($_SESSION['admin_type'] <= 0 && $_SESSION['user_type'] !== "EP"){
        http_response_code(403);
        die('Unauthorized access');
    }

    return true;
}




?>