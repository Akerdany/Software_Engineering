<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <script src="../CKEDITOR/ckeditor.js"></script><style>.cke{visibility:hidden;}</style>
	<script type="text/javascript" src="http://localhost/Software_Engineering/CKEDITOR/config.js?t=J1QB"></script><link rel="stylesheet" type="text/css" href="http://localhost/Software_Engineering/CKEDITOR/skins/moono-lisa/editor.css?t=J1QB"><script type="text/javascript" src="http://localhost/Software_Engineering/CKEDITOR/lang/en.js?t=J1QB"></script><script type="text/javascript" src="http://localhost/Software_Engineering/CKEDITOR/styles.js?t=J1QB"></script>
</head>
<body>
    <form action="" method="POST">
        <textarea name = "content" id = "editor">
            <?php if (isset($_POST['submit'])) {
    echo $_POST['paragraph'];
}?>
        </textarea>
        <input type="submit" name = "save" value = "Submit Edits">
    </form>
</body>
<script>
CKEDITOR.replace('editor');

    </script>
</html>
<?php
require_once 'connection.php';
$DB = new DbConnection();
if (isset($_POST['save'])) {
    $html = addslashes('
    <html><head>
		<title>About Us</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/aboutUs.css">
		<script src="../CKEDITOR/ckeditor.js"></script><style>.cke{visibility:hidden;}</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="http://localhost/Software_Engineering/CKEDITOR/config.js?t=J1QB"></script><link rel="stylesheet" type="text/css" href="http://localhost/Software_Engineering/CKEDITOR/skins/moono-lisa/editor.css?t=J1QB"><script type="text/javascript" src="http://localhost/Software_Engineering/CKEDITOR/lang/en.js?t=J1QB"></script><script type="text/javascript" src="http://localhost/Software_Engineering/CKEDITOR/styles.js?t=J1QB"></script>
</head>
	<body cz-shortcut-listen="true">

		<!-- Header -->
			<header id="header">
				<div class="logo"><a href="#">About Us</a></div>
			</header>

		<!-- Main -->
			<section id="main">
				<div class="inner">

				<!-- One -->
					<section id="one" class="wrapper style1">
						<header class="special">
							<h2>About the ministry</h2>
							<p>of youth</p>
						</header>
						<div class="content">
							<p id="originalText" name="originalText">' . $_POST['content'] . '</p>

					</div>
					<form action="pagebuilder.php" method="post">
							<input type="hidden" id = "paragraph" name = "paragraph">
							<input type="submit" id="submitButton" name="submit" value="Edit Content">
						</form>
					</section>
</div>
</section></body>
<script>
		var text = $("#originalText").html();
		$("#paragraph").val(text);
</script>
</html>
    ');
    $sql = 'UPDATE pagecode SET HTML = "' . $html . '" WHERE ID = 1';
    mysqli_query($DB->getdbconnect(), $sql);
    Header('Location: aboutUs.php');
}

?>