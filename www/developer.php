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

include("head.php");
$user = $_GET['user'];
$user = str_replace("..", "", $user);
$user = str_replace("/", "", $user);
$user = str_replace("\\", "", $user);
$username = $user;
$appslist = "../data/users/$username/myapps.txt";
$hasapps = false;
$myappcount = (file_exists($appslist) ? count(file($appslist)) : 0);
if ($myappcount > 0) {
    $hasapps = true;
}
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h3><i class="fa fa-user"></i> <?php echo $username; ?>'s Profile</h3>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    <h4>Info:</h4>
                    <p class="h6"><b>Username: </b> <?php echo $username; ?></p>
                    <p class="h6"><b>Published: </b> <?php echo $myappcount; ?> packages</p>
                </div>
                <div class="col-xs-12">
                    <h4>Packages:</h4>
                    <?php
                    if ($hasapps) {
                        ?><div class="row"><?php
                        $apps = preg_split("/\r\n|\n|\r/", file_get_contents($appslist));
                        $results = [];
                        foreach ($apps as $file) {
                            if (!count($file) == 0) {

                                $file = "../data/apps/" . $file;
                                if (is_dir($file)) {
                                    if (file_exists($file . "/info.json")) {
                                        $json = json_decode(file_get_contents($file . "/info.json"), TRUE);
                                        $results[str_replace("../data/apps/", "", $file)] = $json;
                                    }
                                }
                            }
                        }
                        foreach ($results as $id => $contents) {
                            ?>
                                <div class="col-xs-6 col-lg-4">
                                    <a class="list-group-item row" href="/app.php?appid=<?php echo $id; ?>">
                                        <div class="col-xs-12">
                                            <img class="img-responsive result-image" src="<?php echo $contents['icon']; ?>" />
                                        </div>
                                        <div class="col-xs-12">
                                            <h5><?php echo $contents['name']; ?></h5>
                                            <p><?php echo $contents['sdesc']; ?></p>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                            ?></div><?php
                    } else {
                        echo "<h6>$username has not published any packages yet.</h6>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php");
