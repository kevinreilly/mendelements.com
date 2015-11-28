<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Template Generator</title>
        <link rel="stylesheet" href="style.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    </head>
    
    <body>
    	<div class="wrapper">
        	<h1>Templates</h1>
            <div class="templates">
				<?php
                $templates = array('gerald','cornelius');
                
                foreach($templates as $template){
                ?>
                <div class="template">
                    <a href="<?php echo $template .'/generator.php' ?>">
                    	<h2>The <?php $title = ucfirst($template); echo $title; ?></h2>
                        <img src="<?php echo $template .'/'. $template .'.jpg' ?>" />
                    </a>
                </div>
                <?php } ?>
            </div>
            <div class="clear"></div>
        </div>
    </body>
</html>