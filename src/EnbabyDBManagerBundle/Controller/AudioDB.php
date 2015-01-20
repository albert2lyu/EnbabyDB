<?php
DEFINE("DBROOT","/var/www/EnbabyDB/web/AudioLib/");

function getBookInfoFromIndex($seriesId,$subId)
{
	$bookIndex = DBROOT . $seriesId . "/" . $subId . "/index.json";
	if(!file_exists($bookIndex)) return null;
	$handle = fopen($bookIndex, 'r');
	if(!$handle) return null;
	$json_string = '';
      
	while(!feof($handle)){
		$line = trim(fgets($handle));
		$json_string = $json_string . $line;        	
	}

	$json = json_decode($json_string,true);
	return $json;

}


function getSeriesInfoFromIndex($seriesId)
{
	$bookIndex = DBROOT . $seriesId . "/" . "/index.json";
	if(!file_exists($bookIndex)) return null;
	$handle = fopen($bookIndex, 'r');
	if(!$handle) return null;
	$json_string = '';
      
	while(!feof($handle)){
		$line = trim(fgets($handle));
		$json_string = $json_string . $line;        	
	}

	$json = json_decode($json_string,true);
	return $json;

}

function getSeriesLocation($seriesId)
{
	return DBROOT . $seriesId . "/";
}

function getBookLocation($seriesId,$subId)
{
	return DBROOT . $seriesId . "/" . $subId . "/";
}
?>
