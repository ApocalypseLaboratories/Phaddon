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

include("head.php");

echo "<div class='container'>";
$q = $_GET['q'];

$dir = "../data/apps/*";
$results = [];
// Open a known directory, and proceed to read its contents
foreach (glob($dir) as $file) {
    if (is_dir($file)) {
        if (strpos($file, $q) !== FALSE) {
            if (file_exists($file . "/info.json")) {
                $json = json_decode(file_get_contents($file . "/info.json"), TRUE);
                $results[str_replace("../data/apps/", "", $file)] = $json;
            }
        }
    }
}

echo "<h4>Search results for \"$q\":</h4>";
if (count($results) <= 0) {
    echo "<h5>No results found.</h5>";
}
echo "<div class=\"row\">";
foreach ($results as $id => $contents) {
    ?>
    <div class="col-xs-6 col-sm-4">
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
?>
</div>
</div>
<?php
include("footer.php");
?>