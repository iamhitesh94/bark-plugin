<?php
/**
 * Register all actions and filters for the custom post types for bark
 *
 * @link       http://24bits.in/
 * @since      1.0.0
 *
 * @package    Bark Plugin
 * @subpackage bark-plugin/admin/parts/metabox
 */

?>
<div class="bark-plugin-wrap">
	<div class="service-meta-box">
		<div class="row">
			<div class="full-col">
				<div class="options-blocks">
					<div class="question">
						<label for="">Question</label>
						<input type="text" name='question' placeholder="Please enter first step question here?" class="input-text">
					</div>
					<div class="options">
						<div class="can-clone">
							<input type="text" class="input-text" placeholder="Option" name="options[]">
							<a href="#" class="remove-options">
								<i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zM124 296c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h264c6.6 0 12 5.4 12 12v56c0 6.6-5.4 12-12 12H124z"/></svg></i>
								<span>Remove</span>
							</a>
						</div>
					</div>
					<div class="add-new-option">
						<a href="#" class="add-new btn">
							<i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm144 276c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92h-92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"/></svg></i>
							<span>Add new</span>
						</a>
					</div>
					<div class="selected-option">
						<label for="">Selected Option</label>
						<select name="selected-option" class="select-option">
							<option value="">Select option</option>
						</select>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
