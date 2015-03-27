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

$featured = json_decode("../data/apps/featured.json", true);
$topapps = json_decode("../data/apps/top.json", true);
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><i class="fa fa-trophy"></i> Featured</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php
                        foreach ($app as $featured) {
                            echo '<div class="col-xs-4 col-sm-3 col-lg-2">'
                            . '<img class="img-responsive" src="/appicon.php?app=' . $app['id'] . '" />'
                            . '<br><h4><small>' . $app['name'] . '</small></h4>'
                            . '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><i class="fa fa-star"></i> Popular</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php
                        foreach ($app as $topapps) {
                            echo '<div class="col-xs-4 col-sm-3 col-lg-2">'
                            . '<img class="img-responsive" src="/appicon.php?app=' . $app['id'] . '" />'
                            . '<br><h4><small>' . $app['name'] . '</small></h4>'
                            . '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>