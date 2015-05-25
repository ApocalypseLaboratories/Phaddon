<?php

/*
 * Copyright (C) 2015 Skylar
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

ob_start();
session_start();
include("../../data/config/advanced.php");
if (!isset($_SESSION['user']) || $_SESSION['user'] == '') {
    header('Location: /login.php');
    die();
}

$user = $_SESSION['user'];

if (!(isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['confpass']) && $_POST['oldpass'] != '' && $_POST['newpass'] != '' && $_POST['confpass'] != '')) {
    header("Location: /user.php?err=incpass");
    die();
}
if ($_POST['newpass'] !== $_POST['confpass']) {
    header("Location: /user.php?err=passmismatch");
    die();
}

$passwd = "../../data/users/".$user."/passwd";
if (!(hash($HASH, $SALT . $_POST['oldpass']) == file_get_contents($passwd))) {
    header('Location: /user.php?err=badpass');
    die();
}

file_put_contents($passwd, hash($HASH, $SALT . $_POST['newpass']));

header("Location: /user.php?msg=passchanged");