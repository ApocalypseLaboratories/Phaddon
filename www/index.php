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
$page = 'index';
include("head.php");
if ($_GET['msg'] == 'acc') {
    ?>
    <div class="row">
        <div class="col-xs-10 col-sm-6 col-lg-4 col-xs-offset-1 col-sm-offset-3 col-lg-offset-4">
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <i class="fa fa-check"></i> Account created!
            </div>
        </div>
    </div>
    <?php
} else if ($_GET['msg'] == 'lgo') {
    ?>
<div class="row">
        <div class="col-xs-10 col-sm-6 col-lg-4 col-xs-offset-1 col-sm-offset-3 col-lg-offset-4">
            <div class="alert alert-blue">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <i class="fa fa-info-circle"></i> You have been logged out.
            </div>
        </div>
    </div>
<?php
}
include("inc/topapps.php");
include("footer.php");
?>