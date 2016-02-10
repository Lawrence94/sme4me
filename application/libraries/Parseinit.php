<?php 
defined('BASEPATH') OR exit('No direct script access allowed');



use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseACL;

class Parseinit
{
	
	public function __construct()
	{
		$this->init();
	}

	public function init()
	{
		
		
		ParseClient::initialize('p2hWofjw6qfSeY6VY9iqJcBN6rhC3wT4I788qZZS', 'KFNoW4hh4KwC2tcv3D62g9lakTyn7NoUBQiHRmoc', 'BszPH92r6Jyvi6LdKwKRyw6qPJfRHUMDvjjmlOjO');

	}

}