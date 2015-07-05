<?php
// Verify that we are allowed to start installing

if(file_exists('./application/config/database.php'))
{
	exit("It seems that you have already installed this package. If you mean to re-install, please delete 'database.php' located in './application/config/'");
}

echo '<link href="./assets/css/bootstrap.min.css" rel="stylesheet" media="screen">';
echo '<link href="./assets/css/main.css" rel="stylesheet">';
echo '<title>Store Control Panel Setup</title>';


if (isset($_POST['submit']))
{
	processInfo();
} else {
	requestInfo();
}

function requestInfo()
{
	// This is the way novices will be installing the script.
	// That is why I only ask them for critical details, the rest can remain default.
	echo <<<HTML
		<div class="container">
			<h1>Setup</h1>
			<p>In order for this package to function, you must supply access details to a MySQL database, and a secret encryption key (this can be random).</p>
			<form action="install.php" method="post">
				<p><label for="host">Hostname:</label><input type="text" name="host">
				<label for="user">Username:</label><input type="text" name="user">
				<label for="pass">Password:</label><input type="text" name="pass">
				<label for="name">Database:</label><input type="text" name="name"></p>
				<p><label for="key">Encryption key:</label><input type="text" name="key"></p>
				<input type="submit" name="submit" value="Submit">
			</form>
			<hr>
			<footer>
				<p>&copy; 2013-2015 Store Plugin Developed by <a href="https://github.com/alongubkin/" target="_blank"><strong>alongub</strong></a> and <a href="https://github.com/Drixevel/" target="_blank"><strong>Drixevel</strong></a>. Code by <a href="https://github.com/Arrow768/" target="_blank"><strong>Arrow768</strong></a>. Design by <strong>Bor3d Gaming</strong>.
				</p><p> Go to <a href="https://github.com/SourceMod-Store/store-webpanel/issues/" target="_blank"><strong>Github</strong></a> to report Bugs and request Features.</p>
			</footer>
		</div>
HTML;
}

function processInfo() 
{
	// Import the SQL stuffs first. If these go wrong, no harm done.
	// This is going to hurt your eyes.
	mysql_connect($_POST['host'],$_POST['user'],$_POST['pass']) or die('Error connecting to MySQL. No harm done, just start the installation again.');
	mysql_select_db($_POST['name']) or die('Error selecting MySQL database: ' . mysql_error());
	
	$query = ''; // Store the query as we read the file.
	$file = file("./application/sql/ion_auth.sql");
	foreach ($file as $line)
	{
		if (substr($line, 0, 2) == '--' || $line == '')
		{
			// comments lol
			continue;
		}
		$query .= $line;
		if (substr(trim($line), -1, 1) == ';')
		{
			mysql_query($query) or print('Error performing query \'<b>' . $query . '\': ' . mysql_error() . '<br><br>');
			$query = '';
		}
	}
	echo "MySQL Database populated.<br>";
	// Start by opening the sample file
	$dbsample = './application/config/database.sample.php';
	$dbhandler = fopen($dbsample, "r");
	$dbfile = fread($dbhandler, filesize($dbsample) );
	
	// We are done with the sample file. Close it.
	fclose($dbhandler);
	
	// This is easy thanks to the uniqueness of what I'm looking for.
	// Add the host...
	$dbfile = str_replace("[YOUR DB-HOST HERE]", $_POST['host'], $dbfile);
	// ... the user...
	$dbfile = str_replace("[YOUR DB-USER HERE]", $_POST['user'], $dbfile);
	// ... the password...
	$dbfile = str_replace("[YOUR DB-PASSWORD HERE]", $_POST['pass'], $dbfile);
	// ... and the name.
	$dbfile = str_replace("[YOUR DB-NAME HERE]", $_POST['name'], $dbfile);
	
	// Create the real database file
	$realdbfile = fopen('./application/config/database.php', 'w') or exit('Error creating Database file. Does the system have access to the directory?');
	fwrite($realdbfile, $dbfile);
	echo "Database info saved!<br>";
	
	/////////
	$configsample = './application/config/config.sample.php';
	$confighandler = fopen($configsample, "r");
	$configfile = fread($confighandler, filesize($configsample) ); // Seriously, just assume the entire file please fread
	fclose($confighandler);
	
	$configfile = str_replace("[REPLACE-ENCRYPTION_KEY]", $_POST['key'], $configfile);
	$realconfigfile = fopen('./application/config/config.php', 'w') or exit('Error creating Config file. Does the system have access to the directory?');
	fwrite($realconfigfile, $configfile);	
	echo "Config saved!<br>";
	echo <<<HTML
		<meta http-equiv="refresh" content="3;url=./" />
		<b>Redirecting in 3 seconds...</b>
HTML;
}

?>