<?  
  @$ps = $_REQUIRE["pass"];  
  $encript_pass = crypt($ps);
  echo $ps."<br>";
  echo $encript_pass;