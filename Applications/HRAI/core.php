<!DOCTYPE html>
<html>
<head>
<title>HRAI Core</title>
<script type="text/javascript" src="Applications/jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="Resources/common.js"></script>

</head>
<body>
  <div name="top"></div>
<?php 
session_start();

// / The following code loads core AI files. Write an entry to the log if successful.
require_once('/var/www/html/HRProprietary/HRCloud2/Applications/HRAI/coreVar.php');
require_once($wpfile);
require_once($HRC2SecurityCoreFile);
require_once($coreArrfile);
require_once($coreFuncfile);
require_once($onlineFile);
require_once($InstLoc.'/config.php');
?>
<div id="showConsoleButton" name="showConsoleButton" alt="Toggle Console" style="border:2px; border-style:inset; clear:right; float:right;" onclick="toggle_visibility('console');">Console</div>
<?php
if (!isset($_POST['input'])) { ?>
<div id="HRAITop" align='center'><img id='logo' src='<?php echo $URL.'/HRProprietary/HRCloud2/Applications/HRAI/'; ?>Resources/logoslowbreath.gif'/></div>
<?php } 
if (isset($_POST['input'])) {
  $_POST['input'] = str_replace(str_split('[]{};:$#^&%@>*<'), '', $_POST['input']); ?>
<div id="HRAITop" style="float: left; margin-left: 15px;">
<img id='logo' src='<?php echo $URL.'/HRProprietary/HRCloud2/Applications/HRAI/'; ?>Resources/logo.gif'/>
</div>
<?php } 
if (!isset($_POST['input'])) { ?>
<div align='center'>
<?php } 
if (isset($_POST['input'])) { ?>
<div style="float: right; padding-right: 50px;">
<?php } ?>

<script>
jQuery('#input').on('input', function() {
  $("#logo").attr("src","Resources/logo.gif");
});
jQuery('#submitHRAI').on('submit', function() {
  $("#logo").attr("src","Resources/logo.gif");
});
</script>
<div id="console" align="left" name="console" style="display:none;">HRAI Console<hr />
<?php
// / The following code takes ownership of required HRAI directories for the www-data usergroup.
$checkServerPermissions = checkServerPermissions();

// / The following code cleans up and maintains the server.
$performMaintanence = performMaintanence();

// / The following code starts WordPress.
$detectWordPress = detectWordPress();

// / The followind code handles POSTED variables from other HRAI nodes.
$display_name = defineDisplay_Name();
$user_IDPOST = defineUser_ID(); 
$sesIDPOST = authSesID($user_ID);
$input = defineUserInput();
$inputServerID = defineInputServerID();

// / The following code verifies that a POSTED HRAI request came from a node with similar Salts.
$authenticateAPI = authenticateAPI();

// / The following code detects the user_ID and returns related variables.
$user_ID = verifyUser_ID();

// / The following code creates the session directory and session log files.
$sesID = forceCreateSesID();
$sesLogfile = forceCreateSesDir($sesID);

// / Check how many other HRAI servers are in the vicinity. Returns the number of servers.
$nodeCount = getNetStat();
$serverStat = getServStat();
include($nodeCache); 
$txt = 'CoreAI: Loaded nodeCache, nodeCount is '.$nodeCount;
echo nl2br($txt."\n");
$compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
$txt = 'CoreAI: Server status is '.$serverStat.'.';
echo nl2br($txt."\n");
$compLogfile = file_put_contents($sesLogfile, $txt.PHP_EOL , FILE_APPEND); 
$cpuUseNow = getServCPUUseNow();
$servMemUse = getServMemUse();
$getServBusy = getServBusy();

// / The following code prunes the user's input before loading the CoreCommands to execute matches.
$inputRAW = $input;
$input = str_replace(str_split(',.!?'), '', $_POST['input']);
$input = strtolower($input);

?>
<hr /></div>
<div id="end"></div>
<?php
// / The following code detects and initializes all CoreCommands.
  // / CoreCommands are parsed every time the core is executed.
  // / They contain the format for HRAI to match text to certain tasks.
  // / They also contain the code for the task to be completed.
  // / HRAI loads these CoreCommands, and if the input matches, the command will run.
$CMDFilesDir1 = scandir($InstLoc.'/Applications/HRAI/CoreCommands');
$CMDcounter = 0;
foreach($CMDFilesDir1 as $CMDFile) {
  if ($CMDFile == '.' or $CMDFile == '..' or strpos($CMDFile, 'index') == 'true' or is_dir($CMDFile)) continue;
  $CMDFile = ($InstLoc.'/Applications/HRAI/CoreCommands/'.$CMDFile);
  include_once($CMDFile); }

// / The following code displays the MiniGui if needed.
$displayMiniGui = displayMiniGui();
?>
</div>
</body>
</html>