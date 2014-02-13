jQuery(document).ready(function() {
	jQuery('.upload_image_button').click(function() {
		no = jQuery(this).attr('no');
		uploadNo = '#upload_image'+ no;
		formfield = jQuery(uploadNo).attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	window.send_to_editor = function(html) {
		imgurl = jQuery('img',html).attr('src');
		jQuery(uploadNo).val(imgurl);
		tb_remove();
	}
});