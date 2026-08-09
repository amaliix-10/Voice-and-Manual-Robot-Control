<?php
// بيانات الاتصال بقاعدة البيانات - غيّرها ببياناتك من InfinityFree
$host = "sql306.infinityfree.com";      // اسم السيرفر (Hostname)
$user = "if0_42611572";                // اسم المستخدم
$pass = "3iW66LYLhxB";           // كلمة المرور
$dbname = "if0_42611572_robotcontrol";   // اسم قاعدة البيانات

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "فشل الاتصال: " . $conn->connect_error]));
}
?>
