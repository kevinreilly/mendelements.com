<?php 

function getAdminOptions() {
$devOptions = array(
		"criteria" => 'labnol',
		"mode" => 'feed',
		"headertext" => 'Related Tweets',
		"num" => '5',
		"img" => 'yes',
		"imgclass" => '',
		"auth" => 'no',
		"encoding" => '',		
		"followlink" => 'yes',
		"searchlink" => 'yes',
		"anchor" => '',
		"userlinks" => 'yes',
		"hashlinks" => 'yes',
		"timeline" => 'yes',
		"smalltime" => 'yes',
		"smalltimeclass" => '',
		"conditional" => 'yes',
		"phptime" => 'j F Y \a\t h:ia',
		"linktotweet" => 'yes',
		"divid" => '',
		"ulclass" => '',
		"liclass" => '',
		"linklove" => 'no',
    );
			$devSavedOptions = get_option('TechBrijPluginAdminOptions');
			
			//print_r($devSavedOptions);
			if (!empty($devSavedOptions)) {
			
				foreach ($devSavedOptions as $key => $option)
					 $devOptions[$key] = $option;
			}				
			//update_option('TechBrijPluginAdminOptions', $devOptions);
			return $devOptions;
}
					$devOptions = getAdminOptions();
					if (isset($_POST['update_TechBrijPluginSettings'])) { 
						if (isset($_POST['_techbrij_meta_mode'])) {
							$devOptions['mode'] =  $_POST['_techbrij_meta_mode'];
						}
						if (isset($_POST['headertext'])) {
							$devOptions['headertext'] = $_POST['headertext'];
						}	
						if (isset($_POST['criteria'])) {
							$devOptions['criteria'] = $_POST['criteria'];
						}
						if (isset($_POST['num'])) {
							$devOptions['num'] = $_POST['num'];
						}
						if (isset($_POST['img'])) {
							$devOptions['img'] = $_POST['img'];
						}
						if (isset($_POST['auth'])) {
							$devOptions['auth'] = $_POST['auth'];
						}
						if (isset($_POST['userlinks'])) {
							$devOptions['userlinks'] = $_POST['userlinks'];
						}
						if (isset($_POST['hashlinks'])) {
							$devOptions['hashlinks'] = $_POST['hashlinks'];
						}
						if (isset($_POST['timeline'])) {
							$devOptions['timeline'] = $_POST['timeline'];
						}
						if (isset($_POST['linklove'])) {
							$devOptions['linklove'] = $_POST['linklove'];
						}						
						if (isset($_POST['imgclass'])) {
							$devOptions['imgclass'] = $_POST['imgclass'];
						}
						if (isset($_POST['divid'])) {
							$devOptions['divid'] = $_POST['divid'];
						}
						if (isset($_POST['ulclass'])) {
							$devOptions['ulclass'] = $_POST['ulclass'];
						}
						if (isset($_POST['liclass'])) {
							$devOptions['liclass'] = $_POST['liclass'];
						}
						update_option( 'TechBrijPluginAdminOptions', $devOptions);						
						?>
						<div class="updated"><p><strong><?php _e("Settings Updated.", "TechBrijPlugin");?></strong></p></div>
					<?php
					} ?>


<div class=wrap>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<h2>TweetsByPost Plugin Settings</h2>

<h3>Title Text</h3>
<p>Enter text to be displayed before tweets</p>
<p><input type="text" id="headertext" name="headertext" value="<?php if (isset($devOptions['headertext'])) { _e($devOptions['headertext'], "TechBrijPlugin"); }?>" /></p>

<h3>Default Twitter Name or Search Term</h3>
<p><input type="text" id="criteria" name="criteria" value="<?php if (isset($devOptions['criteria'])) { _e($devOptions['criteria'], "TechBrijPlugin"); }?>" /></p>

<h3>Default Mode:</h3>
<p style="white-space:pre-wrap"><strong>Modes:</strong>
<strong>None</strong> - No display
<strong>Feed</strong> - displays the most recent tweets
<strong>Retweets</strong> - displays retweets by others mentioning @username
<strong>Mentions</strong> - displays everyone’s tweets mentioning @username
<strong>Public</strong> - displays latest tweets plus replies/mentions and retweets (basically a merge of feed and mentions mode)
<strong>Favorite</strong> - displays the favourites of @username
<strong>Search</strong> - displays feed of that search term
<strong>Hashtag</strong> - displays feed of that hashtag</p>
<strong>Select Mode:</strong>
<select name="_techbrij_meta_mode">
<option value="none" <?php if($devOptions['mode'] == "none" ) echo "selected" ?>>none</option>
<option value="feed" <?php if($devOptions['mode'] == "feed" ) echo "selected" ?>>feed</option>
<option value="retweets" <?php if($devOptions['mode'] == "retweets" ) echo "selected" ?>>retweets</option>
<option value="mentions" <?php if($devOptions['mode'] == "mentions" ) echo "selected" ?>>mentions</option>
<option value="public" <?php if($devOptions['mode'] == "public" ) echo "selected" ?>>public</option>
<option value="favorite" <?php if($devOptions['mode'] == "favorite" ) echo "selected" ?>>favorite</option>
<option value="search" <?php if($devOptions['mode'] == "search" ) echo "selected" ?>>search</option>
<option value="hashtag" <?php if($devOptions['mode'] == "hashtag" ) echo "selected" ?>>hashtag</option> 
</select>

<h3>Number of Tweets</h3>
<p><input type="text" id="num" name="num" size="3" value="<?php if (isset($devOptions['num'])) { _e($devOptions['num'], "TechBrijPlugin"); }?>" /></p>

<h3>Options</h3>
<p>Displays avatar/profile image to the left of the tweet</p>
<p><label for="techbrijimg_yes"><input type="radio" id="techbrijimg_yes" name="img" value="yes" <?php if ($devOptions['img'] == "yes") { _e('checked="checked"', "TechBrijPlugin"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="techbrijimg_no"><input type="radio" id="techbrijimg_no" name="img" value="no" <?php if ($devOptions['img'] == "no") { _e('checked="checked"', "TechBrijPlugin"); }?>/> No</label></p>

<p>Displays a link to @username at the beginning of that tweet</p>
<p><label for="techbrijauth_yes"><input type="radio" id="techbrijauth_yes" name="auth" value="yes" <?php if ($devOptions['auth'] == "yes") { _e('checked="checked"', "TechBrijPlugin"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="techbrijauth_no"><input type="radio" id="techbrijauth_no" name="auth" value="no" <?php if ($devOptions['auth'] == "no") { _e('checked="checked"', "TechBrijPlugin"); }?>/> No</label></p>

<p>Inserts a link to any @username who is mentioned in a tweet</p>
<p><label for="techbrijuserlinks_yes"><input type="radio" id="techbrijuserlinks_yes" name="userlinks" value="yes" <?php if ($devOptions['userlinks'] == "yes") { _e('checked="checked"', "TechBrijPlugin"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="techbrijuserlinks_no"><input type="radio" id="techbrijuserlinks_no" name="userlinks" value="no" <?php if ($devOptions['userlinks'] == "no") { _e('checked="checked"', "TechBrijPlugin"); }?>/> No</label></p>

<p>Inserts a link to any #hashtag that is mentioned in a tweet.</p>
<p><label for="techbrijhashlinks_yes"><input type="radio" id="techbrijhashlinks_yes" name="hashlinks" value="yes" <?php if ($devOptions['hashlinks'] == "yes") { _e('checked="checked"', "TechBrijPlugin"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="techbrijhashlinks_no"><input type="radio" id="techbrijhashlinks_no" name="hashlinks" value="no" <?php if ($devOptions['hashlinks'] == "no") { _e('checked="checked"', "TechBrijPlugin"); }?>/> No</label></p>

<p>To append xx minutes/hours/days ago from the tweet</p>
<p><label for="techbrijtimeline_yes"><input type="radio" id="techbrijtimeline_yes" name="timeline" value="yes" <?php if ($devOptions['timeline'] == "yes") { _e('checked="checked"', "TechBrijPlugin"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="techbrijtimeline_no"><input type="radio" id="techbrijtimeline_no" name="timeline" value="no" <?php if ($devOptions['timeline'] == "no") { _e('checked="checked"', "TechBrijPlugin"); }?>/> No</label></p>

<p>Inserts a plugin link after tweets. It’s a free plugin so leave it in if you can.</p>
<p><label for="techbrijlinklove_yes"><input type="radio" id="techbrijlinklove_yes" name="linklove" value="yes" <?php if ($devOptions['linklove'] == "yes") { _e('checked="checked"', "TechBrijPlugin"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="techbrijlinklove_no"><input type="radio" id="techbrijlinklove_no" name="linklove" value="no" <?php if ($devOptions['linklove'] == "no") { _e('checked="checked"', "TechBrijPlugin"); }?>/> No</label></p>

<h3>Styles(Optional)</h3>
<p>The CSS class of avatar images.</p>
<p><input type="text" id="imgclass" name="imgclass" value="<?php if (isset($devOptions['imgclass'])) { _e($devOptions['imgclass'], "TechBrijPlugin"); }?>" /></p>

<p>the container DIV with the ID you choose</p>
<p><input type="text" id="divid" name="divid" value="<?php if (isset($devOptions['divid'])) { _e($devOptions['divid'], "TechBrijPlugin"); }?>" /></p>

<p>The CSS class of &lt;ul> the tweets are listed within</p>
<p><input type="text" id="ulclass" name="ulclass" value="<?php if (isset($devOptions['ulclass'])) { _e($devOptions['ulclass'], "TechBrijPlugin"); }?>" /></p>

<p>The CSS class of &lt;li> each tweet is listed within</p>
<p><input type="text" id="liclass" name="liclass" value="<?php if (isset($devOptions['liclass'])) { _e($devOptions['liclass'], "TechBrijPlugin"); }?>" /></p>
<p><a href="http://techbrij.com/category/portfolio/tweets-by-post">Plugin Home</a> | <a href="http://techbrij.com/category/portfolio/tweets-by-post">Help Docs</a> |  <a href="http://techbrij.com/contact-us-suggestion-submit-link">Suggestion</a> | <a href="http://feedburner.google.com/fb/a/mailverify?uri=techbrij&amp;loc=en_US">Email Updates</a> | <a href="http://twitter.com/itechbrij">Twitter</a> | <a href="http://www.facebook.com/itechbrij">Facebook</a> </p>
<div class="submit">
<input type="submit" name="update_TechBrijPluginSettings" value="<?php _e('Update Settings', 'TechBrijPlugin') ?>" /></div>
</form>


 </div>