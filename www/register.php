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
