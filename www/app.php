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
include('head.php');
echo "<div class='container'>";
$appid = str_replace("\\", "", str_replace("..", "", str_replace("/", "", $_GET['appid'])));
if (file_exists('../data/apps/' . $appid)) {
    $appdata = json_decode(file_get_contents('../data/apps/' . $appid . '/info.json'), TRUE);
    ?>
    <div class="apppanel">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <img class="img-responsive appicon" src="<?php echo $appdata['icon']; ?>">
            </div>
            <div class="col-xs-12 col-sm-8">
                <h1><?php echo $appdata['name']; ?></h1>
                <p><b><?php echo $appdata['sdesc']; ?></b></p>
                <p><a class="btn btn-success dl-btn" href="/dl.php?appid=<?php echo $appid; ?>"><i class="fa fa-arrow-circle-o-down"></i> Download</a>
                    <span class="platformicons">
                        <?php
                        $desktop = "";
                        $mobile = "";
                        foreach ($appdata['platforms'] as $key => $val) {
                            switch ($val) {
                                case 'windows':
                                    $desktop .= "<i class='fa fa-windows'></i> ";
                                    break;
                                case 'mac':
                                    $desktop .= "<i class='fa fa-apple'></i> ";
                                    break;
                                case 'linux':
                                    $desktop .= "<i class='fa fa-linux'></i> ";
                                    break;
                                case 'android':
                                    $mobile .= "<i class='fa fa-android'></i> ";
                                    break;
                                case 'ios':
                                    $mobile .= "<i class='fa fa-apple'></i> ";
                                    break;
                            }
                        }
                        if (!$desktop == '') {
                            echo "<span class='platforms btn btn-default'>"
                            . "<span class='override'><i class='fa fa-desktop'></i> | </span>"
                            . $desktop
                            . "</span>";
                        }

                        if (!$mobile == '') {
                            echo "<span class='platforms btn btn-default'>"
                            . "<span class='override'><i class='fa fa-mobile'></i> | </span>"
                            . $mobile
                            . "</span>";
                        }
                        ?>
                    </span>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <p><?php echo $appdata['ldesc']; ?></p>
            </div>
        </div>
    </div>
    <?php
} else {
    include('inc/404.php');
}
include("footer.php");
?>