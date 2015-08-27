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

$featured = json_decode(file_get_contents("../data/apps/featured.json"), true);
//$topapps = json_decode(file_get_contents("../data/apps/top.json"), true);
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><i class="fa fa-trophy"></i> Featured</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php
                        foreach ($featured as $key => $app) {
                            echo '<a class="col-xs-4 col-sm-3 col-lg-2" href="app.php?appid=' . $app['id'] . '">'
                            . '<img class="img-responsive" src="/appicon.php?id=' . $app['id'] . '" />'
                            . '<br><h4><small>' . $app['name'] . '</small></h4>'
                            . '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php /* <div class="col-xs-12 col-sm-6">
          <div class="panel panel-default">
          <div class="panel-heading">
          <div class="panel-title">
          <h3><i class="fa fa-star"></i> Popular</h3>
          </div>
          </div>
          <div class="panel-body">
          <div class="row">
          <?php
          foreach ($topapps as $key => $app) {
          echo '<div class="col-xs-4 col-sm-3 col-lg-2">'
          . '<img class="img-responsive" src="/appicon.php?app=' . $app['id'] . '" />'
          . '<br><h4><small>' . $app['name'] . '</small></h4>'
          . '</div>';
          }
          ?>
          </div>
          </div>
          </div>
          </div> */ ?>
    </div>
</div>