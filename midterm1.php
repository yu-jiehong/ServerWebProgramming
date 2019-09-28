<?php
  echo <<<_END
    <html><head><title>PHP Form Upload</title></head><body>
    <form method='post' action='midterm1.php' enctype='multipart/form-data'>
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

    if(validityCheck($str) == false) {
      echo "Invalid Input: Must be 400 numbers. No characters/newlines/spaces allowed.<br>";
      return;
    }

    $str = convertToGrid($str);
    largestProduct($str);
  }
  echo "</body></html>";

function validityCheck($str) {
  if((strlen($str) != 400) && (strlen($str) != 401)) //sometimes txtfiles auto add newlines
    return false;
  
  for($i = 0; $i < 400; $i++)
    if(is_numeric($str[$i]) == false)
      return false;
  return true;
}

function convertToGrid($str) { //20x20 array
  $newstr = array();
  $strCounter = 0;
  for($i = 0; $i <= 19; $i++) {
    for($j = 0; $j <= 19; $j++) {
      $newstr[$i][$j] = $str[$strCounter];
      $strCounter++;
    }
  }
  return $newstr;
}

function largestProduct($num) {
  $result = 0;
  
  for($i = 0; $i <= 19; $i++) { //check rows
    for($j = 0; $j <= 16; $j++) {
      $tmpresult = $num[$i][$j] * $num[$i][$j+1] * $num[$i][$j+2] * $num[$i][$j+3];
      if($tmpresult > $result)
        $result = $tmpresult;
    }
  }

  for($j = 0; $j <= 19; $j++) { //check columns
    for($i = 0; $i <= 16; $i++) {
      $tmpresult = $num[$i][$j] * $num[$i+1][$j] * $num[$i+2][$j] * $num[$i+3][$j];
      if($tmpresult > $result)
        $result = $tmpresult;
    }
  }

  for($i = 0; $i <= 16; $i++) { //check '\' diagonals
    for($j = 0; $j <= 16; $j++) {
      $tmpresult = $num[$i][$j] * $num[$i+1][$j+1] * $num[$i+2][$j+2] * $num[$i+3][$j+3];
      if($tmpresult > $result)
        $result = $tmpresult;
    }
  }

  for($i = 0; $i <= 16; $i++) { //check '/' diagonals
    for($j = 3; $j <= 19; $j++) {
      $tmpresult = $num[$i][$j] * $num[$i+1][$j-1] * $num[$i+2][$j-2] * $num[$i+3][$j-3];
      if($tmpresult > $result)
        $result = $tmpresult;
    }
  }

  printf("The largest product is: " . $result . "<br><br>");
}
