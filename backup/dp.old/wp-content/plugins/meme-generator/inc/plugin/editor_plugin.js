/*global ajaxurl:false */
/*global tinymce:false */
(function($) {
	"use strict";
	tinymce.create('tinymce.plugins.meme_generator', {
		init : function (ed, url) {
		
			var nonce = '';
			if ( nonce === '' ) {
				$.post( ajaxurl, { 'action' : 'ajax_memegen_nonce' }, function ( response ) {
					nonce = response;
				});
			}

			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			ed.addCommand('Meme_Generator', function () {
				ed.windowManager.open({
					file : ajaxurl + '?action=ajax_memegen_dialog&memegen_dialog_nonce=' + nonce,
                    width : 1025,
                    height : 550,
                    inline : 1
                }, {
					plugin_url : url // Plugin absolute URL
                });
            });

            // Register button
            ed.addButton('meme_generator', {
                title : 'Meme Generator',
                cmd : 'Meme_Generator',
                image : url + '/tinymce_button.png'
            });

            // Add a node change handler, selects the button in the UI when a image is selected
            ed.onNodeChange.add(function (ed, cm, n) {
                cm.setActive('Meme_Generator', n.nodeName === 'IMG');
            });
        },

        getInfo : function () {
            return {
                longname : 'Meme Generator',
                author : 'Brandon Bell',
                authorurl : 'http://www.wpgoods.com/',
                infourl : 'http://www.wpgoods.com/products/meme-generator/',
                version : "1.1"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('meme_generator', tinymce.plugins.meme_generator);
}(jQuery));