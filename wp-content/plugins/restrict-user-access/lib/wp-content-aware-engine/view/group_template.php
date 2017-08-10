<?php
/**
 * @package WP Content Aware Engine
 * @copyright Joachim Jensen <jv@intox.dk>
 * @license GPLv3
 */
?>
<script type="text/template" id="wpca-template-group">
<div class="cas-group-sep" data-vm="classes:{'wpca-group-negate': statusNegated}">
	<span class="wpca-sep-or"><?php _e('Or',WPCA_DOMAIN); ?></span>
	<span class="wpca-sep-not"><?php _e('Not',WPCA_DOMAIN); ?></span>
</div>
<div class="cas-group-body">
	<div class="cas-group-cell">
		<div class="cas-content" data-vm="collection:$collection"></div>
		<div>
			<select class="js-wpca-add-and">
				<option value="0">-- <?php _e("Select content type",WPCA_DOMAIN); ?> --</option>
				<?php
					foreach ($options as $key => $value) {
						echo '<option data-placeholder="'.$value['placeholder'].'" data-default="'.$value['default_value'].'" value="'.$key.'">'.$value['name'].'</option>';
					}
				?>
			</select>
		</div>
	</div>
	<ul class="cas-group-options hide-if-js">
		<li>
			<label class="cae-toggle">
				<input data-vm="checked:exposureSingular" class="js-cas-option-exposure" type="checkbox" value="0" />
				<div class="cae-toggle-bar"></div><?php _e("Singulars",WPCA_DOMAIN); ?>
			</label>
		</li>
		<li>
			<label class="cae-toggle">
				<input data-vm="checked:exposureArchive" class="js-cas-option-exposure" type="checkbox" value="2" />
				<div class="cae-toggle-bar"></div><?php _e("Archives",WPCA_DOMAIN); ?>
			</label>
		</li>
		<li>
			<label class="cae-toggle">
				<input data-vm="checked:statusNegated" class="js-cas-group-option js-wpca-group-status" type="checkbox" name="<?php echo WPCACore::PREFIX; ?>status" value="negated" />
				<div class="cae-toggle-bar"></div><?php _e("Negate conditions",WPCA_DOMAIN); ?>
			</label>
		</li>
		<?php do_action("wpca/group/settings",$post_type); ?>
	</ul>
	<div class="cas-group-actions">
		<div class="alignleft">
			<span class="spinner"></span>
			<button class="js-wpca-save-group button button-small hide-if-js" type="button"><?php _e("Save Changes",WPCA_DOMAIN); ?></button>
		</div>
		<?php do_action("wpca/group/actions",$post_type); ?>
		<button type="button" class="button button-small js-wpca-options"><span class="dashicons dashicons-admin-generic"></span> <?php _e('Settings',WPCA_DOMAIN) ?></button>
	</div>
</div>
</script>