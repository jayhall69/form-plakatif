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
													<div class="radio-textlabel">Anderes</div>
												</label>
											</div>
										</div>

										<div class="button-row d-flex mt-4"></div>
									</div>
								</div>



===



<p>Deine Registrierungsnummer: <strong>'.generateRandomString(5).'</strong></p>


