<?php
/*-------------------------
Autor: RiLaRos
Web: www.rilaros.com
Mail: info@rilaros.com
---------------------------*/
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: ../login/");
	exit;
}