<?php
session_start();
session_unset();
session_destroy();

header('Location: '.htmlspecialchars($_SERVER['HTTP_REFERER']));
?>
