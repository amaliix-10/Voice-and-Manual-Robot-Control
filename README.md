# Voice-and-Manual-Robot-Control

An interactive, responsive web interface for real-time control of a mobile robot using **Web Speech Recognition API** and **Manual Directional Controls**. Designed for smooth communication with an **ESP32** microcontroller via a lightweight server framework.

---

##Overview

This system provides a dual-control mechanism for mobile robotic platforms:
1. **Voice Control Mode**: Converts spoken English commands or phonetics into standardized single-character operational codes using speech recognition dictionary mapping.
2. **Manual Control Mode**: An intuitive touch/click directional grid for manual steering.

Commands are immediately logged, displayed on the interface, and dispatched to the backend (`update_command.php`) to update the state accessible by the **ESP32** microcontroller.

---

## Features

- **Smart Speech Parsing**: Handles variations in accents, phonetic spellings, and direct letter pronunciations.
- **Touch-Friendly Manual Controller**: Grid interface tailored for desktop and mobile browsers.
- **Real-Time Visual Feedback**: Visual pulse indicator for active microphone state and transaction logging.
- **Modern Dark UI**: Designed with CSS variables, clean typography (Inter), and FontAwesome iconography.
- **Cloud Hosted**: Hosted online via InfinityFree for remote accessibility anywhere without local server constraints.
---

##  Command Mapping Reference

The speech engine utilizes a dictionary mapping (`commandMap`) to reliably translate spoken input into precise robot operations:

| Command Action | Recognized Spoken Input / Phonetics | Stored / Sent Code |
| :--- | :--- | :---: |
| **Forward** | `"F"`, `"FORWARD"`, `"EF"`, `"IF"`, `"GO FORWARD"` | `F` |
| **Backward** | `"B"`, `"BACKWARD"`, `"BE"`, `"BEE"`, `"BACK"` | `B` |
| **Turn Left** | `"L"`, `"LEFT"`, `"EL"`, `"IEL"`, `"IL"` | `L` |
| **Turn Right** | `"R"`, `"RIGHT"`, `"WRITE"`, `"RITE"`, `"ARE"` | `R` |
| **Stop** | `"S"`, `"STOP"`, `"ESS"`, `"HALT"` | `S` |

---

## Step-by-Step Implementation Guide

Follow these exact steps to replicate this cloud-hosted deployment:

**Step 1**: InfinityFree Account & Database Setup
1- Create a free hosting account on InfinityFree and set up your free subdomain.

2- Log in to the InfinityFree Control Panel (vPanel).

3- Navigate to MySQL Databases and create a new database (e.g., if0_xxxxxx_robotcontrol).

4- Click on phpMyAdmin next to your newly created database to open the database management interface.

5- In phpMyAdmin, click on the SQL tab in the top navigation bar.

6- Paste the following SQL script to create the commands table and insert the initial stop state (S):
```sql
   CREATE TABLE commands (
       id INT AUTO_INCREMENT PRIMARY KEY,
       command VARCHAR(10) NOT NULL,
       updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   );
   INSERT INTO commands (id, command) VALUES (1, 'S');
```
7- Click Go to execute the query and generate the database structure.

**Step 2**:Backend PHP Configuration
Upload a pre-prepared file to Notepad named update_command.php using the InfinityFree Online File Manager inside the htdocs folder:

```PHP
<?php
// update_command.php
$servername = "sqlXXX.infinityfree.com"; // Your InfinityFree MySQL Hostname
$username   = "if0_XXXXXXXX";           // Your InfinityFree Database Username
$password   = "YOUR_vPANEL_PASSWORD";   // Your InfinityFree vPanel Password
$dbname     = "if0_XXXXXXXX_robot_db";  // Your InfinityFree Database Name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['cmd'])) {
    $cmd = $conn->real_escape_string($_GET['cmd']);
    $sql = "UPDATE commands SET command='$cmd' WHERE id=1";
    if ($conn->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
```


  
