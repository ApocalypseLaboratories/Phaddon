<?php

/*
 * Copyright (C) 2015 Apocalypse Laboratories
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

$user = $_POST['user'];
$user = str_replace("..", "", $user);
$user = str_replace("/", "", $user);
$user = str_replace("\\", "", $user);
$pass = $_POST['pass'];
$email = "";

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == true) {
    $email = $_POST['email'];
} else {
    header('Location: /register.php?err=email');
    die();
}


$userdir = "../../data/users/" . $user;
if (file_exists($userdir)) {
    header('Location: /register.php?err=exists');
    die();
} else {
    mkdir($userdir, 0650, true);
}


$passwd = $userdir . "/passwd";
file_put_contents($passwd, hash($HASH, $SALT.$pass));
file_put_contents($userdir."/email.txt", $email);

$_SESSION['user'] = $user;

header("Location: /?msg=acc");