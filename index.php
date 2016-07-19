<?php
/**
 * Automatic adding of VHosts
 *
 * @version 0.2
 * @package VHost
 * @author Pavel Koch
 */

/**
 * Vhost class import
 *
 */

require 'includes/class.vhost.php';
require 'includes/class.separator.php';

/**
 * Actions file
 *
 */

require 'includes/actions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>VHost</title>
	<link rel="stylesheet" href="css/glob.css">
</head>
<body>
	<main class="site-main">

		<form action="/" method="post" class="new-vhost">
			<input type="text" name="addr" value="127.0.0.1" placeholder="Address"><!-- 
		 --><input type="text" name="name" placeholder="Server name"><!-- 
		 --><button>Add</button>
		 	<!-- These comments garantee that there is no whitespace in between inputs	 -->		
		</form>

		<p class="comment">Add a separator by prefixing the server name with a hashmark (#)</p>

		<table class="table-simple">
			<thead>
				<tr>
					<td>Address</td>
					<td colspan="2">Server name</td>
				</tr>
			</thead>

			<tfoot>
				<tr>
					<td>Address</td>
					<td colspan="2">Server name</td>
				</tr>
			</tfoot>

			<?php foreach (VHost::all() as $vhost) : ?>
				<?php if ($vhost instanceof Separator) : ?>
					<tr class="darkened">
						<td colspan="2"><?= $vhost->content ?></td>
						<td>
							<div class="actions">
								<!-- <span class="edit">
									<a href="">Edit</a> | 
								</span> -->
								<span class="trash">
									<a href="?del=<?= $vhost->row ?>" class="delete">Delete</a>
								</span>
							</div>
						</td>
					</tr>
				<?php continue; endif; ?>
				<tr>
					<td><?= $vhost->addr ?></td>
					<td><?= $vhost->name ?></td>
					<td>
						<div class="actions">
							<!-- <span class="edit">
								<a href="">Edit</a> | 
							</span> -->
							<span class="trash">
								<a href="?del=<?= $vhost->row ?>" class="delete">Delete</a>
							</span>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</main>
	<footer>
		
	</footer>	
</body>
</html>
