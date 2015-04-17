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

$appid = str_replace("\\", "", str_replace("..", "", str_replace("/", "", $_GET['appid'])));
if (file_exists("../data/apps/" . $appid . '/info.json') && $appid != '') {
    $path = "../data/apps/" .
            $appid . '/'
            . json_decode(
                    file_get_contents("../data/apps/" . $appid . '/info.json'), TRUE)
            ['dl'];
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($path));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($path));
    ob_clean();
    flush();
    readfile($path);
    exit;
} else {
    include("head.php");
    echo "<div class='container'>";
    include("inc/404.php");
    echo "</div>";
    include("footer.php");
}