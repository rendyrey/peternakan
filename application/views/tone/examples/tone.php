<?php
// if (PHP_SAPI != 'cli') {
// 	echo "<pre>";
// }






require_once __DIR__ . '/../autoload.php';
$sentiment = new \PHPInsight\Sentiment();


	// calculations:
	$scores = $sentiment->score($string);
	$class = $sentiment->categorise($string);

	// output:
	// echo "String: $string\n";
	// echo "Dominant: $class, scores: ";
	// print_r($scores);
	// echo "\n";

	echo $class;
?>
