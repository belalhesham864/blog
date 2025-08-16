<?php
session_start();           // تبدأ الجلسة
session_unset();           // تمسح كل المتغيرات من الـ session
session_destroy();         // تدمر الجلسة تمامًا

// رجّع المستخدم لصفحة تسجيل الدخول أو الصفحة الرئيسية
header("Location: login.php");  // أو index.php حسب نظامك
exit();