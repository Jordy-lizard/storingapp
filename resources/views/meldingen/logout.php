<?php
session_start();
session_destroy();
header("Location: " . $base_url . "/index.php?msg=ingelogd");
exit;


