(function () {
    tinymce.PluginManager.add('zhanot_add_TMCE_shortcode', function (editor, url) {
        editor.addButton('zhanot_add_TMCE_shortcode', {
            icon: 'zhanot-tinymce-button',
            text: 'ژانوت',
            onclick: function (e) {
                selected = tinyMCE.activeEditor.selection.getContent();
                editor.windowManager.open({
                    title: 'افزودن اعلان ژانوت',
                    body: insert_zhanot_shortcode,
                    onsubmit: function (e) {
                        editor.insertContent('[zhanot id="' + e.data.zhanot_shortcode_textbox + '"]');
                    }
                });
            }
        });
    });
})();