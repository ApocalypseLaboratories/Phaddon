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
include('head.php');
echo "<div class='container'>";
$appid = str_replace("\\", "", str_replace("..", "", str_replace("/", "", $_GET['appid'])));
if ($appid !== '' && file_exists('../data/apps/' . $appid)) {
    $appdata = json_decode(file_get_contents('../data/apps/' . $appid . '/info.json'), TRUE);
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <img class="img-responsive appicon" src="<?php echo $appdata['icon']; ?>">
                </div>
                <div class="col-xs-12 col-sm-8">
                    <h1><?php echo $appdata['name']; ?></h1>
                    <p><b><?php echo $appdata['sdesc']; ?></b></p>
                    <p><a class="btn btn-success dl-btn" href="/dl.php?appid=<?php echo $appid; ?>"><i class="fa fa-arrow-circle-o-down"></i> Download</a>
                        <?php
                        if (isset($appdata['platforms'])) {
                            ?>
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
                            <?php
                        }
                        ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <hr />
                    <p><?php echo $appdata['ldesc']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <hr />
                    <p>Developed by: <a href="/developer.php?user=<?php echo $appdata['user']; ?>"><?php echo $appdata['user']; ?></a></p>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    include('inc/404.php');
}
include("footer.php");
?>