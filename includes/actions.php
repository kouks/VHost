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

if (isset($_POST['addr']) && isset($_POST['name']) && isset($_POST['root'])) {
	VHost::write($_POST['addr'], $_POST['name'], $_POST['root']);
}
