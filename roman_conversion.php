<?php
function roman_array() {
  $arr = array(
  'I' => 1,
  'V' => 5,
  'X' => 10,
  'L' => 50,
  'C' => 100,
  'D' => 500,
  'M' => 1000,
  );
  return $arr;
}

//Used logic from https://www.wikihow.com/Convert-Roman-Numerals
function roman_converter($roman) {
  $romans = roman_array();
  $result = 0;
  if(checkValidity($roman) === false)
    return 'Error, Invalid Input';
  
  while($roman != '') {
    if(strlen($roman) == 1) {
      $result += $romans[$roman[0]];
      return $result;
    }
    if($romans[$roman[0]] >= $romans[$roman[1]]) { //larger value 1st
      $result += $romans[$roman[0]];
      $roman = substr($roman, 1);
    } else {                                      //larger value 2nd
      $result += $romans[$roman[1]] - $romans[$roman[0]];
      $roman = substr($roman, 2);
    }
  }
  return $result;
}

function checkValidity($roman) {
  $romans = roman_array();
  for($x = 0; $x < strlen($roman); $x++) {
    $check = false;
    foreach($romans as $key => $value) {
      if($roman[$x] === $key)
        $check = true;
    }
    if($check == false)
      return false;
  }
}

function testerFunction() {
  printf("Is output from roman_converter('VI') equal to 6?\n");
  $result = roman_converter('VI') === 6 ? "Test Passed" : "Test Failed";
  echo $result . "\n";

  printf("Is output from roman_converter('MCMXC') equal to 1990?\n");
  $result = roman_converter('MCMXC') === 1990 ? "Test Passed" : "Test Failed";
  echo $result . "\n";

  printf("Is output from roman_converter('t') an error?\n");
  $result = roman_converter('t') === 'Error, Invalid Input' ? "Test Passed" : "Test Failed";
  echo $result . "\n";

  printf("Is output from roman_converter('123') an error?\n");
  $result = roman_converter('123') === 'Error, Invalid Input' ? "Test Passed" : "Test Failed";
  echo $result . "\n";

  printf("Is output from roman_converter('VXIcV') an error?\n");
  $result = roman_converter('VXIcV') === 'Error, Invalid Input' ? "Test Passed" : "Test Failed";
  echo $result . "\n";
}

testerFunction();
