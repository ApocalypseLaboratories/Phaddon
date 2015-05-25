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

$appid = str_replace("\\", "", str_replace("..", "", str_replace("/", "", $_GET['id'])));
$path = "../data/apps/" . $appid . '/icon.png';
if (file_exists($path) && $appid != '') {
    header("Content-Type: image/png");
    header('Content-Length: ' . filesize($path));
    ob_clean();
    flush();
    readfile($path);
    exit;
} else {
    header("Content-Type: text/plain");
    header("HTTP/1.0 404 Image not found");
    die("404 Image Not Found");
}