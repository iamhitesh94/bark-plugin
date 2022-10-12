<?php
/**
 * The file used for modal html when search box submitted
 *
 * @link      http://24bits.in/
 * @since      1.0.0
 *
 * @package    Bark Plugin
 * @subpackage bark-plugin/front-end/templates/modal
 */

?>
<div class="bark-modal bark-modal-large" id="bark-search-modal">
	<div class="bark-modal-dialog">
		<div class="bark-modal-content">
			<div class="bark-modal-header">
				<div class="bark-close-button">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
						<path fill="#000000" d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/>
					</svg>
				</div>
			</div>
			<div class="bark-modal-body">
				<div class="bark-modal-search-form">
					<div class="service-image"></div>
					<div class="search-form">
						<form  method="post" action="" id="bark-search-form">
							<div class="steps">
								<div class="step step-1 active">
									<div class="title">Amount of work</div>
									<div class="radios">
										<div class="radio">
											<input type="radio" name="amount-work" id="single-project" value="single project">
											<label for="single-project">
												A signle project
											</label>
										</div>
										<div class="radio">
											<input type="radio" name="amount-work" id="variety-projects" value="variety of projects">
											<label for="variety-projects">
												A Cariety of projects
											</label>
										</div>
										<div class="radio">
											<input type="radio" name="amount-work" id="not-sure" value="I'm not sure">
											<label for="not-sure">
												I'm not sure
											</label>
										</div>
										<div class="radio">
											<input type="radio" name="amount-work" id="other" value="other">
											<label for="other">
												Other
											</label>
										</div>
									</div>
								</div>
								<div class="step step-2">
									<div class="title">Who is this writing aimed at?</div>
									<div class="input-box">
										<input type="text" name="aimed-at" class="text-input">
									</div>
								</div>
								<div class="step step-3">
									<div class="title">Please describe</div>
									<div class="input-box">
										<input type="text" name="describe" class="text-input">
									</div>
								</div>
								<div class="step step-4">
									<div class="title">Email address</div>
									<div class="input-box">
										<input type="email" name="email" class="text-input">
									</div>
								</div>
								<div class="step step-5">
									<div class="title">Phone</div>
									<div class="input-box">
										<input type="text" name="phone" class="text-input">
									</div>
								</div>
								<div class="step step-6">
									<div class="title">Name</div>
									<div class="input-box">
										<input type="text" name="name" class="text-input">
									</div>
								</div>
							</div>
							<div class="bm-form-option">
								<div class="bm-form-submit">
									<input type="hidden" name="action" value="bark_search_service_providers">
									<input type="hidden" name="service-id" value="">
									<button class="continue-btn" type="button">Continue</button>
									<input class="bm-submit-btn" type="submit" value="<?php esc_html_e( 'Submit', 'dutchie-connect' ); ?>">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
