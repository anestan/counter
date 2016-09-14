<?php
/**
 * Set of sanitization functions used by the customizer
 *
 * @package Owner
 */

/**
 * Sanitizes Text.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_text( $input ) {
	global $allowedtags;
	return wp_kses( $input , $allowedtags );
}

/**
 * Sanitizes Checkbox.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_checkbox( $input ) {
	if ( $input ) {
		return 1;
	}
	return 0;
}

/**
 * Sanitizes Image Upload.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_image( $input ) {
	$filetype = wp_check_filetype( $input );
	if ( $filetype['ext'] && wp_ext2type( $filetype['ext'] ) === 'image' ) {
		return esc_url( $input );
	}
	return '';
}

/**
 * Sanitizes Panel Layout.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_panel_layout( $input ) {
	$choices = owner_get_panel_types();
	if ( array_key_exists( $input, $choices ) ) {
		return $input;
	}
	return 'center';
}

/**
 * Sanitizes Panel Size Type.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_background_size_type( $input ) {
	$choices = array(
		'cover',
		'percent',
	);
	if ( in_array( $input, $choices ) ) {
		return $input;
	}
	return 'auto';
}

/**
 * Sanitizes Panel Layout.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_alignment( $input ) {
	$choices = array(
		'center',
		'right',
	);
	if ( in_array( $input, $choices ) ) {
		return $input;
	}
	return 'left';
}

/**
 * Sanitizes Opacity Range.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_opacity_range( $input ) {
	if ( $input && is_numeric( $input ) ) {
		if ( 1 <= $input ) {
			return 1;
		} else {
			return abs( number_format( $input, 2 ) );
		}
	}
	return 1;
}

/**
 * Sanitizes Panel Background Repeat.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_background_repeat( $input ) {
	$choices = array(
		'repeat',
		'repeat-x',
		'repeat-y',
	);
	if ( in_array( $input, $choices ) ) {
		return $input;
	}
	return 'no-repeat';
}

/**
 * Sanitizes Panel Background Position.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_background_position( $input ) {
	$choices = array(
		'left center',
		'left bottom',
		'center top',
		'center center',
		'center bottom',
		'right top',
		'right center',
		'right bottom',
	);
	if ( in_array( $input, $choices ) ) {
		return $input;
	}
	return 'left top';
}

/**
 * Sanitizes background attachment.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_background_attachment( $input ) {
	if ( 'fixed' == $input ) {
		return $input;
	}
	return 'scroll';
}

/**
 * Sanitizes background attachment.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_panel_count( $input ) {
	if ( $input >= 0 && $input <= owner_get_panel_count_max() ) {
		return absint( $input );
	}
	return 1;
}

/**
 * Returns filtered panel count.
 *
 * @return int Number of panels.
 */
function owner_get_panel_count() {
	return apply_filters( 'owner_panel_count', 10 );
}

/**
 * Sanitizes panel columns.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_column_count( $input ) {
	$choices = array( 3, 4 );
	if ( in_array( $input, $choices ) ) {
		return $input;
	}
	return 2;
}

/**
 * Sanitizes panel columns.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_panel_post_count( $input ) {
	$choices = array( 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 );
	if ( in_array( $input, $choices ) ) {
		return $input;
	}
	return 2;
}

/**
 * Sanitizes Panel Layout.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_blog_layout( $input ) {
	if ( 'grid' == $input ) {
		return $input;
	}
	return 'default';
}

/**
 * Sanitizes Meta Items.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_meta_items( $input ) {
	$choices = array(
		'cat-links',
		'posted-on',
		'byline',
		'comments-link',
	);

	$values = ! is_array( $input ) ? explode( ',', $input ) : $input;

	foreach ( $values as $k => $v ) {
		if ( ! in_array( $v, $choices ) ) {
			unset( $values[ $k ] );
		}
	}

	return $values;
}

/**
 * Sanitizes the name of the color scheme.
 *
 * @param string $value potentially dangerous data.
 */
function owner_sanitize_color_scheme( $value ) {
	$color_schemes = owner_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default';
	}

	return $value;
}

/**
 * Sanitizes the footer text.
 *
 * @param string $input potentially dangerous data.
 */
function owner_sanitize_footer_text( $input ) {
	return wp_kses_post( $input );
}
