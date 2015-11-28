<?php include 'header.php'; ?>
<div class="main">
    <div class="half">
        <iframe src="//player.vimeo.com/video/75655550" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
    </div>
    <div class="half">
    	<h1>contact</h1>
        <p>request more info:</p>
        <form action="mailto:kreilly253@gmail.com" method="post"enctype="text/plain">
        	<input type="text" name="name" placeholder="name" required>
            <input type="email" name="email" placeholder="email" required>
            <input type="tel" name="phone" placeholder="phone" required><br />
            <input type="radio" name="info" value="flora" required>flora<br />
            <input type="radio" name="info" value="fauna">fauna<br />
            <input type="radio" name="info" value="both" checked>both<br />
            <input type="submit" value="submit">
        </form>
    </div>
    <div class="clear"></div>
</div>
<?php include 'footer.php'; ?>
