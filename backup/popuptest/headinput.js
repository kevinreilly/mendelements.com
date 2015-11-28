// JavaScript Document

function head_input(){
document.write("<link rel=\"stylesheet\" href=\"colorbox.css\" \/>");
document.write("		<script src=\"https:\/\/ajax.googleapis.com\/ajax\/libs\/jquery\/1.9.1\/jquery.min.js\"><\/script>");
document.write("		<script src=\"jquery.colorbox.js\"><\/script>");
document.write("		<script>");
document.write("			$(document).ready(function(){");
document.write("				$(\".iframe\").colorbox({iframe:true, width:\"80%\", height:\"80%\"});");
document.write("				$(\".inline\").colorbox({inline:true, width:\"50%\"});");
document.write("				$(\".callbacks\").colorbox({");
document.write("					onOpen:function(){ alert('onOpen: colorbox is about to open'); },");
document.write("					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },");
document.write("					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },");
document.write("					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },");
document.write("					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }");
document.write("				});");
document.write("			});");
document.write("		<\/script>");
document.write("        <script type=\"text\/javascript\">");
document.write("			jQuery(document).ready(function(){");
document.write("				if (document.cookie.indexOf('visited=true') == -1) {");
document.write("					var expirationTime = 1000;");
document.write("					var expires = new Date((new Date()).valueOf() + expirationTime);");
document.write("					document.cookie = \"visited=true;expires=\" + expires.toUTCString() + \"; path=\/\";");
document.write("					$.colorbox({inline:true, href:\"#inline_content\", width:525, height:535});");
document.write("				}");
document.write("			});");
document.write("		<\/script>");
}

head_input();