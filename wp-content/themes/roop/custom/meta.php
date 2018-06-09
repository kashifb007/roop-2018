<div class="my_meta_control">
	
	<p>Please enter extra page content data here if necessary.</p>

	<label>Extra Information</label>

	<p>
		<textarea name="_my_meta[header_text]" id="_my_meta[header_text]" cols="130" rows="5"><?php if(!empty($meta['header_text'])) echo $meta['header_text']; ?></textarea>
		<br/><span>Enter extra information</span>
	</p>

</div>
<?php
$content = '';
$editor_id = '_my_meta[header_text]';
//$settings = array( 'media_buttons' => false  );
//wp_editor( $content, $editor_id, $settings );