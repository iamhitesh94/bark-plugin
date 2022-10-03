<?php
/**
 * The file display the search form for the service suggestions.
 *
 * @link      http://24bits.in/
 * @since      1.0.0
 *
 * @package    Bark Plugin
 * @subpackage bark-plugin/front-end/templates
 */

?>
<div class="searchbox">
	<h1><?php echo esc_html( $args['title'] ); ?></h1>
	<p><?php echo esc_html( $args['description_text'] ); ?></p>
	<form action="" class="flxrow bark-search-form">
		<div class="input-row service">
			<input type="text" name="term" id="" class="input-text" placeholder="<?php echo esc_html( $args['search_placeholder'] ); ?>" value="">
		</div>
		<div class="input-row zip">
			<input type="text" name="zipcode" id="" class="input-text" placeholder="<?php echo esc_html( $args['zipcode_placeholder'] ); ?>">
		</div>
		<div class="input-row button">
			<input type="submit" value="<?php echo esc_html( $args['search_btn_text'] ); ?>">
		</div>
	</form>
</div>
