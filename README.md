# Voice-and-Manual-Robot-Control
A responsive web interface with voice and manual controls using SpeechRecognition API and ESP32 integration via PHP &amp; MySQL.
إليك ملف README.md المحدث بالكامل بشكل احترافي مع إضافة قسم مفصل خطوة بخطوة (Step-by-Step Implementation) يشرح لأي شخص كيف يطبق نفس مشروعك بالضبط وكيف يقوم بتشغيله وفتحه بسهولة:

Markdown
# 🤖 ESP32 Voice & Manual Robot Command Center

An interactive, responsive web interface for real-time control of a mobile robot using **Web Speech Recognition API** and **Manual Directional Controls**. Designed for smooth communication with an **ESP32** microcontroller via a lightweight server framework.

---

##Overview

This system provides a dual-control mechanism for mobile robotic platforms:
1. **Voice Control Mode**: Converts spoken English commands or phonetics into standardized single-character operational codes using speech recognition dictionary mapping.
2. **Manual Control Mode**: An intuitive touch/click directional grid for manual steering.

Commands are immediately logged, displayed on the interface, and dispatched to the backend (`update_command.php`) to update the state accessible by the **ESP32** microcontroller.

---

## System Architecture

[ Web Dashboard ]  ---> (HTTP GET/FETCH) ---> [ PHP Server / Database ]
(Voice / UI)                                         │
▼
[ ESP32 Microcontroller ]
│
▼
[ Motor Driver & Robot ]
