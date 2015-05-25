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
header('Content-Type: text/plain; charset=utf-8');
session_start();

try {

    switch ($_FILES['appfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file uploaded.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    switch ($_FILES['imagefile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No image sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here.
    if ($_FILES['upfile']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    /* $finfo = new finfo(FILEINFO_MIME_TYPE);
      if (false === $ext = array_search(
      $finfo->file($_FILES['imagefile']['tmp_name']), array(
      'jpg' => 'image/jpeg',
      'png' => 'image/png',
      'gif' => 'image/gif',
      ), true
      )) {
      throw new RuntimeException('Invalid image format.');
      } */

    if (!preg_match("/[a-z0-9\.]+/", $_POST['package'])) {
        throw new RuntimeException('Invalid package name.');
    }

    if (file_exists("../../data/apps/" . $_POST['package'])) {
        throw new RuntimeException('This package ID already exists.  Choose another.');
    }

    mkdir("../../data/apps/" . $_POST['package']);

    // Image
    $img = imagecreatefromstring(file_get_contents($_FILES['imagefile']['tmp_name']));
    imagealphablending($img, false);
    imagesavealpha($img, true);
    imagepng($img, "../../data/apps/" . $_POST['package'] . "/icon.png");

    $appdata = [];
    $appdata['name'] = $_POST['name'];
    $appdata['sdesc'] = $_POST['sdesc'];
    $appdata['ldesc'] = str_replace("\n", "<br />", $_POST['ldesc']);
    $appdata['icon'] = "/appicon.php?id=" . $_POST['package'];
    $appdata['version'] = $_POST['version'];

    $name = $_FILES["appfile"]["name"];
    $ext = end((explode(".", $name)));

    if (!move_uploaded_file($_FILES['appfile']['tmp_name'], "../../data/apps/" . $_POST['package'] . "/" . $_POST['package'] . "." . $ext)) {
        throw new RuntimeException('Failed to complete upload.  Try again.');
    }

    $appdata['dl'] = $_POST['package'] . "." . $ext;

    $appdata['platforms'] = ["windows", "mac", "linux"];

    file_put_contents("../../data/apps/" . $_POST['package'] . "/info.json", json_encode($appdata));

    header('Location: /app.php?appid=' . $_POST['package']);
} catch (RuntimeException $e) {
    $_SESSION['uperr'] = $e->getMessage();
    header('Location: /publish.php');
}