<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="stamm.css" />
<script src="script.js?1176997364" type="text/javascript"></script>
</head>

<body >
{if !empty($userlist)}
	<script type="text/javascript">insertAdresses('{$userlist};', true);</script>
{/if}
{if $clear}
	<script type="text/javascript">opener.document.forms["header"].to.value = "";</script>
{/if}
<p><a href="igm_to.php?insert=ally">Gesamter Stamm</a></p>
<br />
<a href="igm_to.php?clear">Empfänger löschen</a>

</body>
</html>