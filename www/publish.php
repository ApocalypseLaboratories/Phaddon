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
$page = "publish";
include("head.php");
?>
<div class="container">
    <div class="page-header">
        <h1 class="h2">Publish</h1>
    </div>

    <form method="post" action="/do/publish.php" enctype="multipart/form-data">
        <span class="btn btn-primary btn-file">
            Upload package<input name="pluginfile" id="pluginfile" type="file" />
        </span>     <span class="btn btn-primary btn-file">
            Upload icon<input name="imagefile" id="imagefile" type="file" />
        </span>
    </form>
</div>
<?php
include("footer.php");
?>
