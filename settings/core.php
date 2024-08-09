<?php

// Start the session
session_start();


require_once("../settings/connection.php"); // Include connection file


// Function to check for login status
function check_login(){

    // Check do the person logged in
    if($_SESSION['user_id']==NULL){
        // Not logged in
        echo "You haven't log in";
        header("Location: ../login/login.php");  //Redirect to login page
        return false;
    }
    else{
        $id = $_SESSION['user_id'];
        // Logged in
        echo "Successfully logged in as $username ";
        return true;
    }
}


?>