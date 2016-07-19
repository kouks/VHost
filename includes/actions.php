<?php
/**
 * Handles actions
 *
 * @package VHost
 * @author Pavel Koch
 */
	
/**
 * If del is supplied, delete one
 *
 */

if (isset($_GET['del'])) {
	VHost::delete($_GET['del']);
	header('Location: /');
}

/**
 * If data was supplied, add a new vhost
 *
 */

if (isset($_POST['addr']) && isset($_POST['name'])) {
	VHost::write($_POST['addr'], $_POST['name']);
}
