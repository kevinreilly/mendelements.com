<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Meme Generator</title>
        <link rel="stylesheet" type="text/css" href="memestyle.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    </head>
    
    <body>
    	<div class="stage">
        	<form action="meme.php">
        		<textarea class="input" name="text" style="background-image:url(images/moo.png);color:yellow;font-size:30px;font-weight:bold;font-family:Arial;" placeholder="Enter text here"></textarea>
                <input type="hidden" name="textColor" value="yellow" />
                <input class="submit" type="submit" value="Save" />
            </form>
        </div>
    </body>
</html>
