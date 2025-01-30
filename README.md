Form Plakatif
Contributors: Jürgen Hall
Tags: multi-step, form, customizable, email, validation, jquery, bootstrap
Requires at least: 5.0
Tested up to: 6.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Description:
Form Plakatif is a versatile, fully customizable multi-step form plugin for WordPress. With this plugin, users can create as many panels as needed with different input fields, text areas, and multiple-choice options. At the end of the form, a confirmation email will be sent to the user, and a notification will be sent to the website administrator.

The email sending happens via AJAX for a seamless user experience. We also utilize the NONCE mechanism from WordPress for added security. Additionally, there is server-side sanitization of the inputs to minimize potential attack vectors.

The plugin can easily be embedded into any WordPress page using the shortcode [form-plakatif].

Requirements:

- WordPress version 5.0 or higher
- An SMTP server for email sending, eg. wp-smtp plugin
- For local test environments: MailHog for OSX
- jQuery and Bootstrap 4 as prerequisites

Features:

- Built-in form validation using jQuery Validation
- Customizable validation messages for maximum flexibility
- Dynamically generated progress bar using JavaScript
- Mobile-friendly and responsive
- Each new field requires a unique ID and can easily be added as a new panel
- Customizable email templates for both the user confirmation email and the admin notification email
- Example use case: Submitting a project request by a customer

Installation:

- Upload the plugin directory to the /wp-content/plugins/ directory.
- Activate the plugin via the 'Plugins' menu in WordPress.
- Configure the plugin according to your needs.
- Use config.php for mail settings.
- Adjust CSS

===




example for selection with images


								<div class="multisteps-form__panel shadow p-4 rounded bg-lightgrey" data-animation="scaleIn" style="display:none;">
									<h3 class="multisteps-form__title">Welches x ist dir am Wichtigsten ?</h3>
									<div class="multisteps-form__content">
										<div class="form-row mt-4 businesstype">
											<div class="col-12">
												<input type="radio" name="businesstype" id="networker" value="networker" class="input-hidden" />
												<label for="networker">
												<img src="'.plugin_dir_url( __FILE__ ) . '/assets/img/icon_networker.png'.'" />
													<div class="radio-textlabel">Networker/in</div>
												</label>
											
												<input type="radio" name="businesstype" id="coach" value="coach" class="input-hidden" />
												<label for="coach">
													<img src="'.plugin_dir_url( __FILE__ ) . '/assets/img/icon_coach.png'.'" />
													<div class="radio-textlabel">Trainer / Coach</div>
												</label>

												<input type="radio" name="businesstype" id="other" value="other" class="input-hidden" />
												<label for="other">
												<img src="'.plugin_dir_url( __FILE__ ) . '/assets/img/icon_other.png'.'" />
													<div class="radio-textlabel">Other</div>
												</label>
											</div>
										</div>

										<div class="button-row d-flex mt-4"></div>
									</div>
								</div>



===

