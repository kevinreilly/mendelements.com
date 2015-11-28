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
    		<canvas id="e" width="504" height="360" style="background-image:url(images/moo.png);"></canvas>
        </div>
		<script>
        	var canvas = document.getElementById("e");
        	var context = canvas.getContext("2d");
        	context.fillStyle = "<?php echo $_GET["textColor"]; ?>";
        	context.font = "bold 30px Arial";
        	context.fillText("<?php echo $_GET["text"]; ?>", 10, 37);
			
			$('canvas').each(function(i,e){
				var img = e.toDataURL("image/png");
				$(e).replaceWith(  $('<img src="'+img+'"/>').attr({
					width: $(e).attr("width"), height: $(e).attr("height"), style: $(e).attr("style") 
				}) ) 
			});
        </script>
    </body>
</html>
