# Voice-and-Manual-Robot-Control

A responsive web interface with voice and manual controls using SpeechRecognition API and ESP32 integration via PHP, HTML & MySQL.

---

## Overview

This system provides a dual-control mechanism for mobile robotic platforms:
1. **Voice Control Mode**: Converts spoken English commands or phonetics into standardized single-character operational codes using speech recognition dictionary mapping.
2. **Manual Control Mode**: An intuitive touch/click directional grid for manual steering.

Commands are immediately logged, displayed on the interface, and dispatched to the backend (`update_command.php`) to update the state accessible by the **ESP32** microcontroller.

---

## Features

*  Manual robot control using directional buttons.
*  Voice control using the Web Speech API.
*  Cloud-based command storage using MySQL.
*  PHP API for communication between the web interface and ESP32.
*  Stop command for immediate robot control.
*  Compatible with free InfinityFree hosting.
*  ESP32 can periodically fetch the latest robot command.

---

## File Description

| File                 | Description                                                              |
| -------------------- | ------------------------------------------------------------------------ |
| `index.html`         | Web interface for manual and voice control                               |
| `update_command.php` | Receives commands from the web interface and stores them in the database |
| `get_state.php`      | API endpoint used by the ESP32 to retrieve the latest command            |
| `db.php`             | MySQL database connection configuration                                  |
| `setup.sql`          | Creates the required database tables and default values                  |

---

## Step-by-Step Implementation Guide

Follow these exact steps to replicate this cloud-hosted deployment:

### Step 1: Create the Database

1. Create a free hosting account on **InfinityFree**.
2. Create your desired subdomain.
3. Open the **InfinityFree Control Panel (vPanel)**.
4. Navigate to **MySQL Databases**.
5. Create a new MySQL database.
6. Open **phpMyAdmin** for the newly created database.
7. Go to the **Import** tab.
8. Upload `setup.sql`.

Alternatively, you can open the **SQL** tab and paste the contents of `setup.sql`.

This will create the required tables and insert the default values.

---

### Step 2: Configure the Database Connection

Open `db.php` using the InfinityFree Online File Manager.

The file should be located inside:

```text
htdocs/db.php
```

Configure it with your InfinityFree database credentials:

```php
<?php

$servername = "sqlXXX.infinityfree.com"; // Your InfinityFree MySQL Hostname
$username   = "if0_XXXXXXXX";             // Your InfinityFree Database Username
$password   = "YOUR_vPANEL_PASSWORD";     // Your InfinityFree vPanel Password
$dbname     = "if0_XXXXXXXX_robot_db";     // Your InfinityFree Database Name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
```
---

### Step 3: Upload the Server Files

Upload the following files into the InfinityFree create file named `web` at `htdocs`file:

```text
web/
├── index.html
├── update_command.php
├── get_state.php
├── db.php
└── setup.sql
```

---

## Running the Project

### 1. Open the Web Interface

Open **Google Chrome** or **Microsoft Edge**, which support the Web Speech API required for voice control.

Navigate to:

```text
http://your-subdomain.infinityfreeapp.com/index.html
```

---

### 2. Manual Control

Open the **Manual Control** interface and use the directional buttons.

The system sends the following commands:

| Command | Action     |
| ------- | ---------- |
| `F`     | Forward    |
| `B`     | Backward   |
| `L`     | Turn Left  |
| `R`     | Turn Right |
| `S`     | Stop       |

For example:

```text
Forward → F
Backward → B
Left → L
Right → R
Stop → S
```

---

### 3. Voice Control

Switch to the **Voice** tab and click the microphone button.

You can use commands such as:

```text
Forward
Backward
Turn Left
Turn Right
Stop
```

The recognized command is sent to the PHP backend and stored in the database.

---

### 4. ESP32 Data Fetching

The ESP32 retrieves the latest robot command through:

```text
http://your-subdomain.infinityfreeapp.com/get_state.php
```

Open this URL in your browser to test the API.

If everything is configured correctly, the endpoint should return the currently stored command letter, for example:

```text
F
```

The ESP32 can then use this value to control the robot's motors.

---

# Testing 

[CLick here to see website](https://website-and-application-programming.ifree.page/web/)

[CLick here to see website letter](https://website-and-application-programming.ifree.page/web/get_state.php)

<img width="1917" height="1017" alt="Screenshot 2026-08-09 154548" src="https://github.com/user-attachments/assets/f577841f-da61-4b91-92a6-e5ba1b2da54e" />

---



  
