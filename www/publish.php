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
$page = "publish";
include("head.php");
if (!isset($_SESSION['user']) || $_SESSION['user'] == '') {
    header('Location: login.php');
    die();
}
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h3><i class="fa fa-cloud-upload"></i> Publish</h3>
            </div>
        </div>

        <div class="panel-body">
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
                <textarea rows="5" class="form-control" id="ldesc" name="ldesc" placeholder="Description of the package." required="required" ></textarea>
                <label for="platform">Platforms: <small>Ctrl-click or Command-click to select multiple platforms</small></label>
                <select class="form-control" multiple="multiple" name="platform[]">
                    <?php
                    foreach ($PLATFORMS as $id => $name) {
                        echo "<option value=\"$id\">$name</option>\n";
                    }
                    ?>
                </select>
                <br />
                <input type="submit" class="btn btn-success" value="Publish" />
            </form>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>
