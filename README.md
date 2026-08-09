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
# 🤖 ESP32 Robot Web & Voice Control

A cloud-hosted web control system for an **ESP32-based robot**.
The project provides a web interface for controlling the robot manually or using **voice commands**, with commands stored in a MySQL database and retrieved by the ESP32 through a PHP API.

## ✨ Features

* 🎮 Manual robot control using directional buttons.
* 🎤 Voice control using the Web Speech API.
* ☁️ Cloud-based command storage using MySQL.
* 🔌 PHP API for communication between the web interface and ESP32.
* 🛑 Stop command for immediate robot control.
* 🌐 Compatible with free InfinityFree hosting.
* 📡 ESP32 can periodically fetch the latest robot command.

---

# 🏗️ Project Structure

```text
project/
│
├── index.html
├── update_command.php
├── get_state.php
├── db.php
└── setup.sql
```

### File Description

| File                 | Description                                                              |
| -------------------- | ------------------------------------------------------------------------ |
| `index.html`         | Web interface for manual and voice control                               |
| `update_command.php` | Receives commands from the web interface and stores them in the database |
| `get_state.php`      | API endpoint used by the ESP32 to retrieve the latest command            |
| `db.php`             | MySQL database connection configuration                                  |
| `setup.sql`          | Creates the required database tables and default values                  |

---

# ☁️ Deployment on InfinityFree

## Step 1 — Create the Database

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

# 🔐 Step 2 — Configure the Database Connection

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

> ⚠️ **Security:** Do not upload real database passwords or other private credentials to a public GitHub repository. Keep your production `db.php` private or use a configuration method that keeps credentials outside the repository.

---

# 📂 Step 3 — Upload the Server Files

Upload the following files into the InfinityFree `htdocs` directory:

```text
htdocs/
├── index.html
├── update_command.php
├── get_state.php
├── db.php
└── setup.sql
```

Make sure the PHP files and `index.html` are in the correct directory.

---

# 🚀 Running the Project

## 1. Open the Web Interface

Open **Google Chrome** or **Microsoft Edge**, which support the Web Speech API required for voice control.

Navigate to:

```text
http://your-subdomain.infinityfreeapp.com/index.html
```

When prompted, allow the browser to access your microphone.

---

# 🎮 2. Manual Control

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

# 🎤 3. Voice Control

Switch to the **Voice** tab and click the microphone button.

You can use commands such as:

```text
Forward
Backward
Turn Left
Turn Right
Stop
```

You can also use single-letter commands:

```text
F
B
L
R
S
```

The recognized command is sent to the PHP backend and stored in the database.

---

# 📡 4. ESP32 Data Fetching

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

# 🔄 System Architecture

```text
             ┌─────────────────────┐
             │      Web Browser    │
             │                     │
             │ Manual / Voice UI   │
             └──────────┬──────────┘
                        │
                        │ HTTP Request
                        ▼
             ┌─────────────────────┐
             │ update_command.php  │
             └──────────┬──────────┘
                        │
                        │
                        ▼
             ┌─────────────────────┐
             │      MySQL DB       │
             │                     │
             │ Current Robot State │
             └──────────┬──────────┘
                        │
                        │ HTTP Request
                        ▼
             ┌─────────────────────┐
             │   get_state.php     │
             └──────────┬──────────┘
                        │
                        │ Command
                        ▼
             ┌─────────────────────┐
             │       ESP32         │
             │                     │
             │  Robot Controller   │
             └─────────────────────┘
```

---

# 🧪 Testing Checklist

After deployment, verify the following:

* [ ] InfinityFree hosting account is active.
* [ ] Subdomain is working.
* [ ] MySQL database has been created.
* [ ] `setup.sql` has been imported successfully.
* [ ] `db.php` contains the correct database credentials.
* [ ] All project files are inside `htdocs`.
* [ ] `index.html` opens successfully.
* [ ] Manual buttons send commands correctly.
* [ ] Microphone permission is enabled.
* [ ] Voice commands are recognized.
* [ ] `get_state.php` returns the current command.
* [ ] ESP32 successfully reads the command from the API.

---

# 🛠️ Troubleshooting

### Database Connection Failed

Check:

* MySQL hostname.
* Database username.
* Database password.
* Database name.
* Whether the database was created in InfinityFree.
* Whether `setup.sql` was imported successfully.

### Voice Control Is Not Working

Make sure:

* You are using Google Chrome or Microsoft Edge.
* Microphone permission is allowed.
* The browser can access the microphone.
* The page is being served correctly from your hosting environment.

### `get_state.php` Does Not Return a Command

Check:

1. `db.php` database credentials.
2. The MySQL database connection.
3. Whether `setup.sql` created the required table.
4. Whether `update_command.php` is successfully storing commands.
5. The browser's network/developer console for errors.

---

# 🔒 Security Notes

**Do not commit production database credentials to GitHub.**

For example, avoid publishing:

```php
$password = "MY_REAL_PASSWORD";
```

Instead, keep sensitive configuration private and consider adding your local/private configuration file to `.gitignore`.

Example:

```text
db.php
.env
```

If `db.php` is required by the server but contains private credentials, upload it directly to the hosting server rather than publishing it in a public repository.

---

# 📜 License

This project can be distributed and modified according to the license included in this repository.

---

# 👨‍💻 Project Overview

This project demonstrates how an **ESP32 robot** can be controlled remotely through a web interface using:

* HTML
* JavaScript
* PHP
* MySQL
* Web Speech API
* HTTP communication
* ESP32

The architecture separates the **user interface**, **cloud database**, and **ESP32 controller**, allowing the robot to receive commands remotely through a simple web API.


  
