<?php

$fields = array ('bgColor','imagesURL','bgImage','bgRepeat','headerBGColor','logoLink','logoImage','topLinkImage','topLinkURL','middleImage','bannerImage','bannerLink','bodyBGColor','bodyHTML','footerText1','facebookURL','facebookImage','twitterURL','twitterImage','youtubeURL','youtubeImage','gplusURL','gplusImage','footerText2');

foreach($fields as $field){
	$$field = $_POST[$field];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Email Template</title>
    </head>
    
    <body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0">
    
    	<style type="text/css">
			@media screen and (max-width:600px){
				table[class="mainTable"]{
					font-size:28px;
				}
			}
		</style>
    
    	<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center" style="background:#<?php echo $bgColor ?><?php if($bgImage){ ?> url(<?php echo $imagesURL ?><?php echo $bgImage ?>);<?php if($bgRepeat){ ?>background-repeat:<?php echo $bgRepeat; ?>;<?php } else { ?>background-size:cover;<?php }} ?>">
        	<tr>
            	<td>
                	<table cellpadding="0" cellspacing="0" border="0" align="center" class="mainTable" style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:14px;color:#333333;">
                    	<tr>
                        	<td width="4%">&nbsp;</td>
                        	<td width="600">
                            	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%">
                                	<tr>
                                    	<td>
                                        	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%"<?php if($headerBGColor){ ?> bgcolor="#<?php echo $headerBGColor ?>"<?php } ?>>
                                            	<tr><td colspan="3" height="20"></td></tr>
                                            	<tr>
                                                	<td width="4%"></td>
                                                	<td width="92%">
                                                    	<?php
                                                        	if($middleImage){
																$width = 33;
															}
															else if($topLinkImage) {
																$width = 49.5;
															}
															else {
																$width= 100;
															}
														?>
                                                    	<table cellpadding="0" cellspacing="0" border="0" width="<?php echo $width ?>%" align="left">
                                                        	<tr>
                                                            	<td align="left">
                                                    				<a href="<?php echo $logoLink ?> "><img src="<?php echo $imagesURL ?><?php echo $logoImage ?>" border="0" style="max-width:100%;" /></a>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <?php if ($middleImage){ ?>
                                                        <table cellpadding="0" cellspacing="0" border="0" width="<?php echo $width ?>%" align="left">
                                                        	<tr>
                                                            	<td align="center">
                                                    				<img src="<?php echo $imagesURL ?><?php echo $middleImage ?>" style="max-width:100%;" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <?php } ?>
                                                        <?php if($topLinkImage){ ?>
                                                        <table cellpadding="0" cellspacing="0" border="0" width="<?php echo $width ?>%" align="right">
                                                            <tr>
                                                                <td align="right">
                                                                    <?php if($topLinkURL){ ?><a href="<?php echo $topLinkURL ?> "><?php } ?><img src="<?php echo $imagesURL ?><?php echo $topLinkImage ?>" style="max-width:100%;" /><?php if($topLinkURL){ ?></a><?php } ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <?php } ?>
                                                    </td>
                                                    <td width="4%"></td>
                                                </tr>
                                                <tr><td colspan="3" height="20"></td></tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr><td height="10"></td></tr>
                                    <tr>
                                    	<td>
                                        	<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%"<?php if($bodyBGColor){ ?> bgcolor="#<?php echo $bodyBGColor ?>"<?php } ?>>
                                            	<tr><td colspan="3" height="25"></td></tr>
                                            	<?php if($bannerImage){ ?>
                                                <tr>
                                                	<td></td>
                                                    <td>
                                                        <?php if($bannerLink){ ?><a href="<?php echo $bannerLink ?>"><? } ?>
                                                            <img src="<?php echo $imagesURL ?><?php echo $bannerImage ?>" border="0" style="max-width:100%;" />
                                                        <?php if($bannerLink){ ?></a><? } ?>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <?php } ?>
                                            	<tr><td colspan="3" height="5"></td></tr>
                                            	<tr>
                                                	<td width="4%"></td>
                                                    <td width="92%">
                                                		<?php echo $bodyHTML ?>
                                                    </td>
                                                    <td width="4%"></td>
                                                </tr>
                                                <tr><td colspan="3" height="25"></td></tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr><td height="10">&nbsp;</td></tr>
                                    <?php if($footerText1){ ?>
                                    <tr>
                                        <td align="center">
                                            <?php echo $footerText1 ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td align="center">
                                            <?php if($facebookImage){ ?><a href="<?php echo $facebookURL ?>"><img src="<?php echo $imagesURL ?><?php echo $facebookImage ?>" border="0" /></a>&nbsp;<?php } ?>
                                            <?php if($twitterImage){ ?><a href="<?php echo $twitterURL ?>"><img src="<?php echo $imagesURL ?><?php echo $twitterImage ?>" border="0" /></a>&nbsp;<?php } ?>
                                            <?php if($youtubeImage){ ?><a href="<?php echo $youtubeURL ?>"><img src="<?php echo $imagesURL ?><?php echo $youtubeImage ?>" border="0" /></a>&nbsp;<?php } ?>
                                            <?php if($gplusImage){ ?><a href="<?php echo $gplusURL ?>"><img src="<?php echo $imagesURL ?><?php echo $gplusImage ?>" border="0" /></a><?php } ?>
                                        </td>
                                    </tr>
                                    <?php if($footerText2){ ?>
                                    <tr>
                                        <td align="center">
                                            <?php echo $footerText2 ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td align="center">
                                            <a href="http://pierryinteractive.com"><img src="http://image.exct.net/lib/fe6815707d6402787416/m/1/pierry-powered.png" border="0" width="101" height="44" /></a>
                                        </td>
                                    </tr>
                                    <tr><td height="10">&nbsp;</td></tr>
                                </table>
                            </td>
                            <td width="4%">&nbsp;</td>
                        </tr>
                    </table>
		    		<custom name="opencounter" type="tracking">
                </td>
            </tr>
        </table>
    </body>
</html>
