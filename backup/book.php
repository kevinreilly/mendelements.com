<form onSubmit="bet()">
	<input type="text" name="amount" placeholder="$0.00" />
    <input type="submit" value="Bet" />
</form>

<?php
	$one_odds = 1;
	$two_odds = 1;
	
	echo 'Team 1: '.$one_odds.'<br />';
	echo 'Team 2: '.$two_odds;
?>