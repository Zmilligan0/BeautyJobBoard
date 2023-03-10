<?php
session_start();
session_destroy();
header('Location: ../../index?action=1');
?>