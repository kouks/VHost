<?php

/**
 * Automatic adding of VHost logic is handled here
 * 
 * @package VHost
 * @author Pavel Koch
 */
class VHost
{	
	/**
	 * Server address
	 *
	 * @var String addr
	 */
	public $addr;
	
	/**
	 * Assigned server name
	 *
	 * @var String name
	 */
	public $name;

	/**
	 * The row virtual host is on
	 *
	 * @var Int row
	 */
	public $row;

	/**
	 * Class constructor
	 * 
	 * @param 	String $addr 	server address
	 * @param 	String $name 	server name
	 * @param 	Int $row 		vhost location in file
	 */
	public function __construct($addr, $name, $row = -1)
	{
		$this->addr = $addr;
		$this->name = $name;
		$this->row = $row;
	}
	
	/**
	 * Setting a new VHost
	 * 
	 * @param 	VHost $vhost 	instance of VHost class
	 * @return 	Bool $success 	success
	 */
	public static function write($addr, $name)
	{
		$config = self::getConfig();
		$hosts = fopen($config->hosts_path, 'a+');

		// return false if opening failed
		if(!$hosts) {
			return false;
		}

		fwrite($hosts, "\n" . $addr . " " . $name);
		fclose($hosts);

		return true;
	}

	/**
	 * Gets all available vhosts
	 * 
	 * @return 	Array $vhosts	array of available VHosts
	 */
	public static function all()
	{
		$config = self::getConfig();
		$ret = [];

		// going through hosts file
		foreach (file($config->hosts_path) as $row => $line) {

			// do necessary parsing
			$line = preg_replace('/\s+/', ' ', preg_replace('/\n/', '', $line));

			if (preg_match('/^#.*$/', $line) || empty($line)) {
				continue;
			}

			list($addr, $name) = explode(' ', $line);
			$ret[] = new VHost($addr, $name, $row);
		}

		return $ret;
	}

	/**
	 * Deleting a vhost
	 * 
	 * @param 	Int $row 		row vhost can be found on
	 * @return 	Bool $success	success
	 */
	public static function delete($row)
	{
		$config = self::getConfig();

		// going through hosts file
		$hostsContents = file($config->hosts_path);

		// deleting given line
		unset($hostsContents[$row]);

		$hosts = fopen($config->hosts_path, 'w+');

		// return false if opening failed
		if(!$hosts) {
			return false;
		}

		fwrite($hosts, implode("\n", $hostsContents));
		fclose($hosts);

		return true;
	}

	/**
	 * Getting config file
	 * 
	 * @return 	Json $config 	config contents
	 */
	private static function getConfig()
	{
		return json_decode(file_get_contents('config.json'));
	}	

}