tinymce.init
({
	setup: function (editor) {
		editor.on('change', function () {
			tinymce.triggerSave();
		});
	},
	selector : "textarea",
	plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste imagetools"],
	toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
});