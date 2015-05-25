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
if (!isset($_SESSION['user']) || $_SESSION['user'] == '') {
    header('Location: login.php');
    die();
}
?>
<div class="container">
    <div class="pagepanel">
        <h1>Publish</h1>

        <?php
        if (strlen($_SESSION['uperr']) >= 1) {
            ?>
        <div class="alert alert-danger"><?php echo $_SESSION['uperr']; ?></div>
            <?php
            $_SESSION['uperr'] = '';
        }
        ?>
        <form method="post" action="/do/publish.php" enctype="multipart/form-data">
            <span class="btn btn-primary btn-file">
                Upload package<input name="appfile" id="pluginfile" type="file" required="required" />
            </span>     <span class="btn btn-primary btn-file">
                Upload image<input name="imagefile" id="imagefile" type="file" required="required" />
            </span><br /><br /><br />
            <label for="name">Package Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="My App Name" required="required" />
            <label for="package">Package ID:</label>
            <input type="text" class="form-control" id="package" name="package" placeholder="com.example.myapp" required="required" />
            <label for="sdesc">Version:</label>
            <input type="text" class="form-control" id="version" name="version" placeholder="1.0.0" required="required" />
            <label for="sdesc">Short Description:</label>
            <input type="text" class="form-control" id="sdesc" name="sdesc" placeholder="Short description of the package." required="required" />
            <label for="ldesc">Long Description:</label>
            <textarea rows="10" class="form-control" id="ldesc" name="ldesc" placeholder="Description of the package." required="required" ></textarea>

            <br />
            <input type="submit" class="btn btn-success" value="Publish" />
        </form>
    </div>
</div>
<?php
include("footer.php");
?>
