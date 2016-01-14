<?php
/**
 * @Author: ananayarora
 * @Date:   2016-01-14 22:23:38
 * @Last Modified by:   ananayarora
 * @Last Modified time: 2016-01-14 22:24:00
 */
session_start();
unset($_SESSION);
session_destroy();
header("Location: index.php");
?>