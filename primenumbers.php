<?php
function primeCheck($num) {
	for($i = 2; $i <= $num/2; $i++) {
		if($num % $i === 0) //not prime
			return 0;
	}
	return 1;
}

function prime_function($num) {
	$result = "";
	for($i = 2; $i <= $num; $i++) {
		if(primeCheck($i) === 1) {
			$result .= "$i, ";
		}
	}
	$result = rtrim($result, ", ");
	return $result;
}

function testerFunction() {
	printf("Is output from prime_function(10) equal to '2, 3, 5, 7'?\n");
	$result = prime_function(10) === "2, 3, 5, 7" ? "Test Passed" : "Test Failed";
	echo $result . "\n";
	
	printf("Is output from prime_function(0) equal to ''?\n");
	$result = prime_function(0) === "" ? "Test Passed" : "Test Failed";
	echo $result . "\n";

	printf("Is output from prime_function(100) equal to '2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97'?\n");
	$resul = prime_function(100) === "2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97" ? "Test Passed" : "Test Failed";
	echo $resul . "\n";
}

testerFunction();
