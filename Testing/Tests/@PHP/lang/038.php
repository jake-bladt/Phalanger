[expect php]
[file]
<?php

class MyException extends Exception
{
	function __construct($errstr, $errno=0, $errfile='', $errline='')
	{
		parent::__construct($errstr, $errno);
		$this->file = $errfile;
		$this->line = $errline;
	}
}

function Error2Exception($errno, $errstr, $errfile, $errline)
{
	throw new MyException($errstr, $errno);//, $errfile, $errline);
}

$err_msg = 'no exception';
set_error_handler('Error2Exception');

try
{
	$con = fopen("/tmp/a_file_that_does_not_exist",'r');
}
catch (Exception $e)
{
	$trace = $e->getTrace();
	echo ($trace[0]['function']),"\n";
	echo ($trace[1]['function']),"\n";
}

?>
