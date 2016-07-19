<?php
	
/**
 * Separator class
 * 
 * @package VHost
 * @author Pavel Koch
 */
class Separator
{
	
	/**
	 * Separator content
	 *
	 * @var String content
	 */
	public $content;

	/**
	 * The row the separator is on
	 *
	 * @var Int row
	 */
	public $row;

	/**
	 * Class constructor
	 * 
	 * @param 	String $content separator content
	 * @param 	Int $row separator location in the file
	 */
	public function __construct($content, $row)
	{
		$this->content = $content;
		$this->row = $row;
	}
}
