<?php

unset($argv[0]);

$FilePath = $argv[1];
$ColIndex = $argv[2];
$SearchTerm = $argv[3];


if (($open = fopen($FilePath, "r")) !== FALSE)
{
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE)
    {
	
       $array[] = $data;

    }

    fclose($open);

    foreach($array as $Key => $Row)
    {
    	$Result = array();
    	$Result[] = $Row;

    	if($Row[$ColIndex] == $SearchTerm)
    	{
    		$isExist = true;
    		break;
    	}
    	else
    	{
    		$isExist = false;
    	}
    }
    if($isExist)
    	echo implode($Result[0], ',');
    else 
    	echo "Record not found!";
}
else
echo "Make sure you enter the correct file name / file is not empty!";


?> 