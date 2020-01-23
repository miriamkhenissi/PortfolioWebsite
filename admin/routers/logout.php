<?php
/**
 * Admin index template
 * @version 1.0.0
 * @author Miriam Habiba Khenissi
 */
require_once('../includes/dbh.inc.php');

//Destroy session and redirect user to admin.
admin_logout();

header("Location: ".ADMIN_SITE_URL);
exit();
