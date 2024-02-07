<?php
/**
 * All public facing functions
 */
namespace Codexpert\ExtraFields\App;
use Codexpert\Plugin\Base;
use Codexpert\ExtraFields\Helper;
/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Front
 * @author Codexpert <hi@codexpert.io>
 */
class Front extends Base {

	public $plugin;

	/**
	 * Constructor function
	 */
	public function __construct( $plugin ) {
		$this->plugin	= $plugin;
		$this->slug		= $this->plugin['TextDomain'];
		$this->name		= $this->plugin['Name'];
		$this->version	= $this->plugin['Version'];
	}

	public function head() {
		if( isset( $_POST['extra_fields'] )){
			Helper::pri( $_POST['extra_fields'] );
		}	
	}
	
	/**
	 * Enqueue JavaScripts and stylesheets
	 */
	public function enqueue_scripts() {
		$min = defined( 'Extra_Fields_DEBUG' ) && Extra_Fields_DEBUG ? '' : '.min';

		wp_enqueue_style( $this->slug, plugins_url( "/assets/css/front{$min}.css", Extra_Fields ), '', $this->version, 'all' );

		wp_enqueue_style( 'fontawsome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', '', $this->version, 'all' );

		wp_enqueue_script( $this->slug, plugins_url( "/assets/js/front{$min}.js", Extra_Fields ), [ 'jquery' ], $this->version, true );

		wp_enqueue_script( 'fontawsome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js','', $this->version, true ); 
		wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js', '', $this->version, true );
		
		$localized = [
			'ajaxurl'	=> admin_url( 'admin-ajax.php' ),
			'_wpnonce'	=> wp_create_nonce(),
		];
		wp_localize_script( $this->slug, 'Extra_Fields', apply_filters( "{$this->slug}-localized", $localized ) );
	}

	public function modal() {
		echo '
		<div id="extra-fields-modal" style="display: none">
			<img id="extra-fields-modal-loader" src="' . esc_attr( Extra_Fields_ASSET . '/img/loader.gif' ) . '" />
		</div>';
	}

	public function add_extra_fields(){
		?>
		<div class="cx-variable-form">
			<p>Extra filelds</p>

			<button class="cx-extra-button-1">Extra Fileds*  </button>

			<div class="cx-extra-item-1"> 
				<input type="radio"  name="extra_fields" class='cx-extra-item-input' value ='2'>
				<label for="">Item One <span class="cx-extra-item-1-span ">+2$</span> </label> <br>
				<input type="radio" name="extra_fields" class='cx-extra-item-input' value ='5'>
				<label for="">Item One <span class="cx-extra-item-1-span ">+5$</span> </label> <br>
				<input type="radio" name="extra_fields"  class='cx-extra-item-input'value ='10'>
				<label for="">Item One <span class="cx-extra-item-1-span ">+10$</span> </label> <br>
			</div>

			<button class="cx-extra-button-2">accessories* </button>

			<div class="cx-extra-item-2"> 
				<input type="checkbox"  name="cx-accessorie" value ='55'>
				<label for="">Long Cable<span class="cx-extra-item-2-span">+55$</span> </label> <br>
				<input type="checkbox" name="cx-accessorie" value ='96'>
				<label for="">Type-C Cable<span class="cx-extra-item-2-span">+96$</span> </label> <br>
				
			</div>

			

		</div>
		<?php 
		
	}
}