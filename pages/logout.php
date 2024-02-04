<?php
session_start();
session_destroy();
session_write_close(); $_SESSION['logado'] = "abacate";
header('location: ../index.html');
?>
