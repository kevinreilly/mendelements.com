<?php
// THE GERALD
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Email Template Generator</title>
        <link rel="stylesheet" href="..\style.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    </head>
    
    <body>
    	<div class="wrapper">
            <h1>The Gerald</h1>
            <p>by Kevin Reilly</p>
            <div class="back"><a href="..\">&laquo;&nbsp;Back</a></div>
            <div class="sample"><a href="sample.html" target="_blank">Sample &raquo;</a></div>
            <form action="template.php" method="POST">
            	<h2>General</h2>
                <input type="text" name="bgColor" placeholder="BG Color" /><br />
                <input type="text" name="imagesURL" placeholder="Images URL" /><br />
                <input type="text" name="bgImage" placeholder="BG Image" /><br />
                <input type="text" name="bgRepeat" placeholder="BG Repeat" /><br />
                <h2>Header</h2>
                <input type="text" name="headerBGColor" placeholder="Header BG Color" /><br />
                <input type="text" name="logoImage" placeholder="Logo Image" /><br />
                <input type="text" name="logoLink" placeholder="Logo Link URL" /><br />
                <input type="text" name="topLinkImage" placeholder="Top Link Image" /><br />
                <input type="text" name="topLinkURL" placeholder="Top Link URL" /><br />
                <input type="text" name="middleImage" placeholder="Middle Image" /><br />
                <h2>Banner</h2>
                <input type="text" name="bannerImage" placeholder="Banner Image" /><br />
                <input type="text" name="bannerLink" placeholder="Banner Link" /><br />
                <h2>Body</h2>
                <input type="text" name="bodyBGColor" placeholder="Body BG Color" /><br />
                <textarea name="bodyHTML" placeholder="Body HTML" rows="2"></textarea>
                <h2>Footer</h2>
                <input type="text" name="footerText1" placeholder="Footer Text 1" /><br />
                <input type="text" name="facebookURL" placeholder="Facebook URL" /><br />
                <input type="text" name="facebookImage" placeholder="Facebook Image" value="facebook.png" /><br />
                <input type="text" name="twitterURL" placeholder="Twitter URL" /><br />
                <input type="text" name="twitterImage" placeholder="Twitter Image" value="twitter.png" /><br />
                <input type="text" name="youtubeURL" placeholder="Youtube URL" /><br />
                <input type="text" name="youtubeImage" placeholder="Youtube Image" value="youtube.png" /><br />
                <input type="text" name="gplusURL" placeholder="Google+ URL" /><br />
                <input type="text" name="gplusImage" placeholder="Google+ Image" value="gplus.png" /><br />
                <input type="text" name="footerText2" placeholder="Footer Text 2" /><br />
                
                <input type="submit" value="All done" />
            </form>
        </div>
    </body>
</html>