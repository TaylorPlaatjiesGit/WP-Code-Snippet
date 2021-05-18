<?php if(isset($post->meta_index)) { ?	
  <div class="oss_box" data-row-index="0">
		<p class="meta-options custom_field">
			<label for="newsletter[<?php echo $post->meta_index; ?>][oss_date]">Date</label>
			<input id="newsletter[<?php echo $post->meta_index; ?>][oss_date]"
				type="text"
				name="newsletter[<?php echo $post->meta_index; ?>][oss_date]"
				value="<?php echo $post->result->oss_date; ?>">
		</p>
		<p class="meta-options custom_field">
			<label for="newsletter[<?php echo $post->meta_index; ?>][oss_title]">Title</label>
			<input id="newsletter[<?php echo $post->meta_index; ?>][oss_title]"
				type="text"
				name="newsletter[<?php echo $post->meta_index; ?>][oss_title]"
				value="<?php echo $post->result->oss_title; ?>">
		</p>
		<p class="meta-options custom_field">
			<label for="newsletter[<?php echo $post->meta_index; ?>][oss_description]">Description</label>
			<input id="newsletter[<?php echo $post->meta_index; ?>][oss_description]"
				type="text"
				name="newsletter[<?php echo $post->meta_index; ?>][oss_description]"
			   value="<?php echo $post->result->oss_description; ?>">
		</p>
		<p class="meta-options custom_field">
			<label for="newsletter[<?php echo $post->meta_index; ?>][oss_link]">Link</label>
			<input id="newsletter[<?php echo $post->meta_index; ?>][oss_link]"
				type="text"
				name="newsletter[<?php echo $post->meta_index; ?>][oss_link]"
				value="<?php echo $post->result->oss_link; ?>">
		</p>
	</div>
<?php } else { ?>
	<div class="oss_box" data-row-index="0">
		<p class="meta-options custom_field">
			<label for="newsletter[0][oss_date]">Date</label>
			<input id="newsletter[0][oss_date]"
				type="text"
				name="newsletter[0][oss_date]"
				value="">
		</p>
		<p class="meta-options custom_field">
			<label for="newsletter[0][oss_title]">Title</label>
			<input id="newsletter[0][oss_title]"
				type="text"
				name="newsletter[0][oss_title]"
				value="">
		</p>
		<p class="meta-options custom_field">
			<label for="newsletter[0][oss_description]">Description</label>
			<input id="newsletter[0][oss_description]"
				type="text"
				name="newsletter[0][oss_description]"
			   value="">
		</p>
		<p class="meta-options custom_field">
			<label for="newsletter[0][oss_link]">Link</label>
			<input id="newsletter[0][oss_link]"
				type="text"
				name="newsletter[0][oss_link]"
				value="">
		</p>
	</div>
<?php } ?>

<div>
	<button type="button" class="button btn-add-meta-row <?php echo $post->is_last ? '' : 'd-none' ?>" onclick="addMetaRow(this)">Add</button>
	<button type="button" class="button btn-remove-meta-row" onclick="removeMetaRow(this)">Remove</button>
</div>

<script type="text/javascript">
function addMetaRow(btn) {
	var container = jQuery('.postbox ').last();
	
	var cloneData = container.clone();
	cloneData.addClass('newsletter-meta-new');
	jQuery.each(cloneData.find('input'), function() {
		var input = jQuery(this);
		var inputTag = input.attr('id');
		
		var index = inputTag.match(/\d+/);
		var index = parseInt(index[0]) + 1;
		
		var newInputTag = inputTag.replace(/\d+/, index);
		
		input.attr('id', newInputTag);
		input.attr('name', newInputTag);
		
		cloneData.find('h2').text(cloneData.find('h2').text().replace(/\d+/, index+1));
		
		input.val('');
	});
	
	container.after(cloneData);
	
	jQuery('.btn-remove-meta-row').trigger('updateButtons');
}

function removeMetaRow(btn) {
	if(jQuery('.oss_box').length > 1) {
		jQuery(btn).parents('.postbox').remove();
	}
	
	jQuery('.btn-remove-meta-row').trigger('updateButtons');
}

jQuery(document).ready(function() {
	jQuery('.btn-remove-meta-row').on('updateButtons', function() {
		if(jQuery('.oss_box').length == 1) {
			jQuery('.oss_box').parents('.postbox').find('.btn-remove-meta-row').addClass('d-none');
		} else {
			jQuery('.oss_box').parents('.postbox').find('.btn-remove-meta-row').removeClass('d-none');
		}
		
		jQuery('.btn-add-meta-row:not(:last)').addClass('d-none');
		jQuery('.btn-add-meta-row:last').removeClass('d-none');
	});
	
	jQuery('.btn-remove-meta-row').trigger('updateButtons');
});
</script>
