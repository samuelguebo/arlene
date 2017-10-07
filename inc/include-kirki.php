<?php
/**
 * This file implements custom requirements for the Kirki plugin.
 * It can be used as-is in themes (drop-in).
 *
 * @package kirki-helpers
 */

// No need to proceed if Kirki already exists.
if ( class_exists( 'Kirki' ) ) {
	return;
}

if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'Kirki_Installer_Section' ) ) {
	/**
	 * Recommend the installation of Kirki using a custom section.
	 *
	 * @see WP_Customize_Section
	 */
	class Kirki_Installer_Section extends WP_Customize_Section {

		/**
		 * Customize section type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'kirki-installer';

		/**
		 * Render the section.
		 *
		 * @access protected
		 */
		protected function render() {
			// Determine if the plugin is not installed, or just inactive.
			$plugins   = get_plugins();
			$installed = false;
			$plugin_path = 'kirki/kirki.php';
			foreach ( $plugins as $path => $plugin ) {
				if ( 'Kirki' === $plugin['Name'] || 'Kirki Toolkit' === $plugin['Name'] ) {
					$installed   = true;
					$plugin_path = $path;
				}
			}
			// Get the plugin-installation URL.            
			$plugin_install_url = wp_nonce_url( add_query_arg(
				array(
					'action' => 'install-plugin',
					'plugin' => 'kirki',
				),
				self_admin_url( 'update.php' )
			), 'install-plugin_kirki' );
			
			// Get the plugin-activation URL.
			$plugin_activate_url = wp_nonce_url( add_query_arg(
				array(
					'action' => 'activate',
					'plugin' => $plugin_path,
				),
				self_admin_url( 'plugins.php' )
			), 'activate-plugin_' . $plugin_path );

			?>
			<div style="padding:10px 14px;">
				<?php if ( ! $installed ) : ?>
					<?php esc_attr_e( 'A plugin is required to take advantage of this theme\'s features in the customizer.', 'bastille' ); ?>
					<a class="install-now button-primary button" data-slug="kirki" href="<?php echo esc_url_raw( $plugin_install_url ); ?>" aria-label="Install Kirki Toolkit now" data-name="Kirki Toolkit"><?php esc_html_e( 'Install Now', 'bastille' ); ?></a>
				<?php else : ?>
					<?php esc_attr_e( 'A plugin is required to take advantage of this theme\'s features in the customizer.', 'bastille' ); ?>
					<a class="install-now button-secondary button" data-slug="kirki" href="<?php echo esc_url_raw( $plugin_activate_url ); ?>" aria-label="Activate Kirki Toolkit now" data-name="Kirki Toolkit"><?php esc_html_e( 'Activate Now', 'bastille' ); ?></a>
				<?php endif; ?>
			</div>
			<?php
		}
	}
}

if ( ! function_exists( 'kirki_installer_register' ) ) {
	/**
	 * Registers the section, setting & control for the kirki installer.
	 *
	 * @param object $wp_customize The main customizer object.
	 */
	function kirki_installer_register( $wp_customize ) {
		$wp_customize->add_section( new Kirki_Installer_Section( $wp_customize, 'kirki_installer', array(
			'title'      => '',
			'capability' => 'install_plugins',
			'priority'   => 0,
		) ) );
		$wp_customize->add_setting( 'kirki_installer_setting', array(
			'sanitize_callback'	=> 'sanitize_text_field') );
		$wp_customize->add_control( 'kirki_installer_control', array(
			'section'    => 'kirki_installer',
			'settings'   => 'kirki_installer_setting',
		) );
	}
	add_action( 'customize_register', 'kirki_installer_register' );
}
