<?php
/*
 * Copyright (C) 2015 Netsyms Technologies.
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 * 
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 * 
 * 3. Neither the name of the copyright holder nor the names of its contributors
 * may be used to endorse or promote products derived from this software without
 * specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
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
