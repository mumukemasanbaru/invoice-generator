<?php
/**
 * Plugin Name: 	Invoice Generator
 * Description: 	Generate instant invoice 
 * Version: 		1.0
 * Author: 			Fabianus Yayan
 * Author URI: 		http://www.IG.com/
 * License: 		
 * Text Domain: 	invoice-generator
 * Domain Path:     /languages
 */

require 'barcode/barcode.php';
define( 'IG__BASENAME', plugin_basename( __FILE__ ) );
define( 'IG__DIR', plugin_dir_url( __FILE__ ) );
define( 'IG__PATH', plugin_dir_path( __FILE__ ) );
require 'helper.php';

/**
* class invoice generator
*/
class Invoice_Generator
{
	
	function __construct()
	{
		
		//Load template from specific page
		add_action( 'wp_enqueue_scripts', array($this, 'iG_frontend_enque_script'), 99 );
		add_filter( 'page_template', array($this, 'IG_page_template' ) );	
		add_filter( 'theme_page_templates', array($this,'IG_add_template_to_select'), 10, 4 );	

		add_action( "wp_head", array($this,"IG_enque_font" ) );
		add_action( "wp_footer", array($this,"IG_footer_hook" ) );

		add_action('template_redirect',array($this,'get_barcode_image') );


	}


	public function get_barcode_image(){

		if(isset($_GET['barcode']) && $_GET['barcode']=1){

			if(is_page_template( array( 'template-invoice.php','template-label.php' ) )){

				// For demonstration purposes, get pararameters that are passed in through $_GET or set to the default value
				$filepath = (isset($_GET["filepath"])?$_GET["filepath"]:"");
				$text = (isset($_GET["text"])?$_GET["text"]:"0");
				$size = (isset($_GET["size"])?$_GET["size"]:"20");
				$orientation = (isset($_GET["orientation"])?$_GET["orientation"]:"horizontal");
				$code_type = (isset($_GET["codetype"])?$_GET["codetype"]:"code128");
				$print = (isset($_GET["print"])&&$_GET["print"]=='true'?true:false);
				$sizefactor = (isset($_GET["sizefactor"])?$_GET["sizefactor"]:"1");

				// This function call can be copied into your project and can be made from anywhere in your code
				barcode( $filepath, $text, $size, $orientation, $code_type, $print, $sizefactor );


				exit();

			}
		}
	}



	/**
	 * enque asset
	 */
	public function IG_frontend_enque_script(){
		if(!is_singular() )
			return;

		if( !is_page_template( array( 'template-invoice.php','template-label.php' ) ) )
			return;


		wp_register_style( 'IG-bootstrap-reboot', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap-reboot.min.css', array(), true );
	    wp_register_style( 'IG-icon-css', IG__DIR . 'assets/icons/style.css', array(), true );
	    wp_register_style( 'IG-frontend-css', IG__DIR . 'assets/style.css', array(), true );
	    // wp_register_style( 'IG-custom-css', IG__DIR . 'assets/custom.css', array(), true );
		wp_register_style( 'IG-bootstrap-grid', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap-grid.min.css', array(), true );
		wp_register_style( 'IG-bootstrap-swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/css/swiper.min.css', array(), true );

	    // wp_register_script( 'IG-frontend-js', IG__DIR . 'assets/frontend.js', array('jquery'),'', true);
	    wp_register_script( 'IG-frontend-repeater', IG__DIR . 'assets/repeater.js', array( 'jquery' ), 1.0 , true );
	    wp_enqueue_style( 'IG-frontend-css' );
	    // wp_enqueue_style( 'IG-custom-css' );
	    wp_enqueue_style( 'IG-icon-css' );
	    wp_enqueue_style( 'IG-bootstrap-reboot' );
	    wp_enqueue_style( 'IG-bootstrap-grid' );


		wp_enqueue_script( 'IG-frontend-repeater' );


    	// localize data
		// $data_IG =array('ajaxurl'=> admin_url( 'admin-ajax.php' ) );

		// wp_localize_script('IG-frontend-js','IG_ajax_object',$data_IG);
	}


	/**
	 * enque asset font
	 */
	function IG_enque_font(){

		if(!is_singular() )
		return;

		if( !is_page_template( array( 'template-invoice.php','template-label.php' ) ) )
			return;

	    ob_start();
	    ?>

		<link rel="preconnect" href="https://fonts.googleapis.com">
	    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	    <link rel="stylesheet" href="<?php echo IG__DIR; ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css"> 

	    <?php
	    $content = ob_get_contents();

		ob_end_clean();

		echo $content; 

	}


	/**
	 * footer js
	 */
	function IG_footer_hook(){

		if(!is_singular() )
			return;
		
		if( !is_page_template( array( 'template-invoice.php','template-label.php' ) ) )
			return;

	    ob_start();
	    ?>

		    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/js/swiper.min.js"></script>
			<script src="<?php echo IG__DIR; ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
			<script src="<?php echo IG__DIR; ?>assets/vendor/repeater/jquery.repeater.min.js"></script>
			<script src="<?php echo IG__DIR; ?>assets/vendor/robinherbots-inputmask/jquery.inputmask.min.js"></script>

		    <script>

		        //Upload Logo
		        const fileInput = document.querySelector('#upload-logo'),
		        filePreview = document.querySelector('#select-image .inner'),
		        fileWrapper = document.querySelector('#select-image');

		        fileInput.addEventListener("change", handleFiles, false);

		        function handleFiles(){
		            if (this.files.length) {
		                filePreview.innerHTML = "";
		                const img = document.createElement("img");

		                filePreview.appendChild(img);
		                img.src = URL.createObjectURL(this.files[0]);
		                img.classList.add('img-preview');
		                img.onload = function() {
		                    URL.revokeObjectURL(this.src);
		                }

		                fileWrapper.classList.add('preview');
		            }
		        }

		           jQuery(document).on("keyup", '.harga', function(event) { 
					 jQuery

					});

		        jQuery(function () {
		            jQuery('.datepicker').datepicker({
		                format: "dd/mm/yyyy",
		                orientation: "bottom auto",
		                autoclose: true,
		                todayHighlight: true
		            });
		            var count = 0;
		            jQuery('.repeater').repeater({
		                initEmpty: false,
		                show: function () {
		                	count += 1;
		                    jQuery(this).slideDown();
		                    jQuery(this).attr('id','kode-'+count);

		                },
		                defaultValues: {
		                    'item-qty': 1,
		                },
		                hide: function (deleteElement) {
		                    jQuery(this).slideUp(deleteElement);
		                },
		                isFirstItemUndeletable: true
		            });

		            //https://github.com/RobinHerbots/Inputmask


		            jQuery('.input-money').inputmask('numeric', {
		                'alias': 'numeric', 
		                'groupSeparator': '.', 
		                'digits': 0, 
		                'digitsOptional': false, 
		                'prefix': 'Rp ', 
		                'placeholder': '0'
		            })


		         


		        });



		    </script>

	    <?php
	    $content = ob_get_contents();

		ob_end_clean();

		echo $content; 
	}

	/**
	 * add page template 
	 */
	public function IG_page_template($page_template){
		
		if ( get_page_template_slug() == 'template-invoice.php' ) {
	        $page_template = IG__PATH . 'template-invoice.php';
	    }

    	if ( get_page_template_slug() == 'template-label.php' ) {
	        $page_template = IG__PATH . 'template-label.php';
	    }
	    return $page_template;
	}

	public function IG_add_template_to_select(){
		// Add custom template named template-custom.php to select dropdown 
	    $post_templates['template-invoice.php'] = __('Invoice Generator');
	    $post_templates['template-label.php'] = __('Label Generator');

	    return $post_templates;
	}
}

new Invoice_Generator();
