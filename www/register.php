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

function error($text) {
    ?>
    <div class="container">
        <div class="form-signin">
            <div class="alert alert-danger"><i class="fa fa-times"></i> <?php echo $text; ?></div>
        </div>
    </div>
    <?php
}

function error2($text) {
    ?>
    <div class="alert alert-danger"><i class="fa fa-times"></i> <?php echo $text; ?></div>
    <?php
}

if (isset($_SESSION['user']) && $_SESSION['user'] != '') {
    error("You are already signed in!");
} else {
    ?>
    <div class="container">
        <form class="form-signin" action="do/register.php" method="post">
            <?php
            if (isset($_GET['err'])) {
                switch ($_GET['err']) {
                    case 'email':
                        error2("Please use a valid email address.");
                        break;
                    case 'exists':
                        error2("An account with that username already exists.");
                        break;
                }
            }
            ?>
            <h2 class="form-signin-heading h3">Create account</h2>
            <label for="user" class="sr-only">Username</label>
            <input type="text" id="user" class="form-control" name="user" placeholder="Username" required autofocus>
            <label for="pass" class="sr-only">Password</label>
            <input type="password" id="pass" class="form-control" placeholder="Password" name="pass" required>
            <label for="email" class="sr-only">Email address</label>
            <input type="email" id="email" class="form-control" name="email" placeholder="Email address" required>
            <br />
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>

    </div> <!-- /container -->
    <?php
}
include("footer.php");
