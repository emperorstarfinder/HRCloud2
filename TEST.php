<!DOCTYPE html>
<html>
<head>
<title>DocumentControl | TEST </title>
<link rel="stylesheet" type="text/css" href="DocConCSS.css">
</head>
<?php
require ("config.php");
?>
<div align="center">
  <h3>Administrator Login</h3>
  <hr />
  <p>Please enter your login credentials below.</p>
<form action="/HRProprietary/HRCloud2/cloudCore.php" method="post" enctype="multipart/form-data">
  <p><input type="text" name='convertSelected' id='convertSelected' value="convertSelected"></p>
  <p><input type="text" name='extension' id='extension' value="extension"></p>
   <p><input type="text" name='userconvertfilename' id='userconvertfilename' value="userconvertfilename"></p> 
    <p><input type="text" name='width' id='width' value="width"></p>
      <p><input type="text" name='height' id='height' value="height"></p>
         <p><input type="text" name='rotate' id='rotate' value="rotate"></p>
    <p><input type="submit" value="submit" name='submit'></p>
  <input type="hidden" name="user_ID" value="<?php echo $AdmLogin;?>">

</form>
</div>
</div>
<hr />
</div>
</body>
</html>