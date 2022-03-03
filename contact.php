<?php

if($_POST) {
    $name = "";
    $company = "";
    $email = "";
    $msg = "";
    $email_body = "<html>";

    if(isset($_POST["name"])) {
        $name = test_input($_POST["name"]);
        $email_body .= "<p>Name: ".$name."<br>";
    }

    if(isset($_POST["company"])) {
        $company = test_input($_POST["company"]);
        $email_body .= "<p>Company: ".$company."<br>";
    }

    if(isset($_POST["email"])) {
        $email = test_input($_POST["email"]);
        $email_body .= "<p>Email: ".$email."<br>";
    }

    if(isset($_POST["msg"])) {
        $msg = test_input($_POST["msg"]);
        $msg = nl2br($msg);
        $email_body .= "<p>Message:<br>".$msg;
    }

    $recipient = "jordanknapp00@gmail.com";

    /*
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";
    */

    $headers = array(
        "From: ".$email."",
        "MIME-Version: 1.0",
        "Content-Type: text/html; charset=utf-8"
    );

    ini_set("SMTP","ssl://smtp.gmail.com");
    ini_set("smtp_port","443");

    if(mail($recipient, "New Message From Contact Form", $email_body, implode("\r\n", $headers))) {
        header("Location: http://www.jordanknapp.net/thanks.html");
        exit();
    }
    else {
        header("Location: http://www.jordanknapp.net/error.html");
        exit();
    }
} else {
    header("Location: http://www.jordanknapp.net/error.html");
    exit();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>