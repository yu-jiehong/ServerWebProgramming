<?php
  echo <<<_END
    <html><head><title>PHP Form Upload</title></head><body>
    <form method='post' action='assignment3.php' enctype='multipart/form-data'>
      Select File: <input type='file' name='filename' size='10'>
      <input type='submit' value='Upload'></form>
_END;

  if($_FILES) {
    $name = $_FILES['filename']['name'];
		$file_ext = pathinfo($name);
		if(mime_content_type($name) == 'text/plain' && $file_ext['extension'] == 'txt') //check mime type and extension
			$ext = 'txt';
		if($ext) {
		  move_uploaded_file($_FILES['filename']['tmp_name'], $name);
		  echo "Uploaded text file '$name'<br>";
		} else {
			echo "'$name' is not an accepted file type.<br>";
			return;
		}
		$str = file_get_contents($name);
    largestProduct($str);
  }
  echo "</body></html>";

function validityCheck($str) {
  if((strlen($str) != 1000) && (strlen($str) != 1001)) //sometimes txtfiles auto add newlines
    return false;
  
  for($i = 0; $i < 1000; $i++)
    if(is_numeric($str[$i]) == false)
      return false;
  return true;
}

function factorial($num) {
  if($num == 0)
    return 1;
  $result = $num;
  for($i = $num - 1; $i > 1; $i--)
    $result *= $i;
  return $result;
}

function largestProduct($num) {
  $result = 0;
  if(validityCheck($num) == false) {
    echo "Invalid Input: Must be 1000 numbers. No characters/newlines/spaces allowed<br>";
    return;
  }
  for($i = 0; $i < 996; $i++) {
    $tmpresult = $num[$i] * $num[$i+1] * $num[$i+2] * $num[$i+3] * $num[$i+4];
    if($tmpresult > $result) //new largest value
      $result = $tmpresult;
  }
  printf("The largest product is: " . $result . "<br>");
  $result = "" . $result;
  $factsum = factorial($result[0]) + factorial($result[1]) + factorial($result[2]) +
    factorial($result[3]) + factorial($result[4]);
  echo "The sum of the factorials are: " . $factsum . "<br>";
}

function tester_function() {
  echo "<br>Not sure how to test my code here as I need to start at the top of the file.<br>";
  echo "I will just list what I tested for.\n";
  echo "Tested for file extensions and mime types, only txt files are accepted.<br>";
  echo "Tested for exactly 1000 numbers.<br>";
  echo "For the provided example, the largest product is 40824.<br>";
  echo "For the provided example, the sum of the factorials are 40371.<br>";
  echo "For a file of all zeros, the product was 0 and the factorial sum were 5.<br>";
}

tester_function();
