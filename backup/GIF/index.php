<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>GIFs with Audio</title>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    </head>
    
    <body>
    	<style type="text/css">
			#gif {
				background-image:url(images/chipstill.gif);
				width:420px;
				height:325px;
			}
			#gif:hover {
				background-image:url(images/chip.gif);
			}
			
		</style>
        
        <script type="text/javascript">
			var audio = $("#sound")[0];
			$("gif").mouseenter(function() {
			  audio.play();
			});
		</script>
    	
        <div id="gif" onmouseover="document.getElementById('sound').play()" onmouseout="document.getElementById('sound').pause()">
            <audio id="sound" src="audio/captain.mp3" preload="auto" loop></audio>
        </div>
        
        <div id="gif" onmouseover="youtube();" onmouseout="document.getElementById('sound').pause()">
            <audio id="sound" src="audio/captain.mp3" preload="auto" loop></audio>
        </div>
        
        <?php 
		$video = '
        <iframe id="ytplayer" type="text/html" width="300" height="27"
        src="https://www.youtube.com/embed/?listType=search&list=mia%2520bad%2520girls&autoplay=1&loop=1"
        frameborder="0" allowfullscreen>';
		
		function youtube(){
			echo $video;
		}
		?>
        
    </body>
</html>
