<?php get_header(); ?>
<?php 


    $upload_dir = wp_upload_dir();
    $random_str = generateRandomString();
    $target_dir = $upload_dir['basedir'].'/';
    $target_url = $upload_dir['baseurl']."/";
    $random_str = generateRandomString();

    if(isset($_POST['LG-submit']) && wp_verify_nonce($_POST['LG-nonce'], 'LG-secure-nonce') ){


    	if(!empty($_FILES["upload-logo"]["name"])){
    	$target_file = $target_dir . $random_str . basename($_FILES["upload-logo"]["name"]);
        $url_file = $target_url . $random_str . basename($_FILES["upload-logo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["upload-logo"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["upload-logo"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }


        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["upload-logo"]["tmp_name"], $target_file)) {
            // echo "The file ". htmlspecialchars( basename( $_FILES["upload-logo"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
    }



        



        ob_start();

        if($_POST['layout']=='potrait'){

            include 'template-potrait.php';
        } else {

            include 'template-landscape.php';
        }

        $content = ob_get_contents();

        ob_end_clean();


        echo $content;



        get_footer();

        exit();

    }



    if(isset($_POST['LG-submit-pdf']) && wp_verify_nonce($_POST['LG-nonce'], 'LG-secure-nonce') ){

    		$target_file = $target_dir . $random_str . basename($_FILES["upload-logo"]["name"]);
        $url_file = $target_url . $random_str . basename($_FILES["upload-logo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["upload-logo"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["upload-logo"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }


        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["upload-logo"]["tmp_name"], $target_file)) {
            // echo "The file ". htmlspecialchars( basename( $_FILES["upload-logo"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }

    	 ob_start();

        if($_POST['layout']=='potrait'){

            include 'template-potrait.php';
        } else {

            include 'template-landscape.php';
        }

        require_once  'vendor/autoload.php';

        $content = ob_get_contents();

        ob_end_clean();

        
        echo $content;

		$stylesheet = file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap-reboot.min.css');
        $custom = file_get_contents(IG__DIR . 'assets/style.css');



        $mpdf = new \Mpdf\Mpdf(['format' => $_POST['format']]);
 
	    $mpdf->AddPage('L');
        	
        
        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($custom,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($content,\Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output($target_dir.$random_str.'.pdf');



        if(isset($_SESSION['post_label']) )
    		unset($_SESSION['post_label']);
    	
    	if(isset($_SESSION['image_url'])) 
    		unset($_SESSION['image_url']);

    	?>

    		  <script type="text/javascript">
                    window.location.href = "<?php echo $target_url.$random_str.'.pdf'; ?>";
                </script>

    	<?php

        get_footer();
    }


?>
<main id="label-generator">
	<form action="" method="POST" enctype="multipart/form-data" >
		 <?php wp_nonce_field( 'LG-secure-nonce', 'LG-nonce' ); ?>  
		<div class="container justify-content-center">
			<section id="main-section" class="col-10 col-lg-10 offset-lg-1">
				<div class="inner-wrap repeater">
					<div class="head-wrap ">
						<h1 class="page-title">Cetak Label Pengiriman</h1>
			            <p class="page-subtitle">Isi formulir di bawah ini untuk membuat dan mencetak label pengiriman dalam hitungan detik!</p>
			        </div>
			        <div class="form-group">
			        	<div class="inner-section" style="padding-bottom: 15px;">
				        	<label class="label-blue" for="nomor">No resi</label>
				        	<div class="form-inner">
		                        <input type="text" class="form-input" value="12312" placeholder="masukkan nomor resi" id="nomor-resi"  name="nomor-resi">
		                    </div>
	                    </div>
			        </div>
			        <div class="form-group">
			        	<div class="inner-section" style="margin-bottom: 25px;">
				        	<h1 class="title-section">Pengirim</h1>
				        	 <p class="page-subtitle" style="text-align: left;">Lengkapi form berikut dan isi sesuai detail sebagai Pengirim</p>
			        	 </div>
			        </div>
			        <div class="inner-section" style="padding-bottom: 15px;margin-bottom: 15px;">
			        	<div class="row">
					        <div class="col-lg-6 col-sm-12 col-xs-12">
					        	<div class="form-group">
				                    <label for="nama-pengirim">Nama Pengirim</label>
				                    <input type="text" name="nama-pengirim" class="form-input" value="Fabianus Yayan" id="nama-pengirim" placeholder="Masukan Nama Pengririm">
				                </div>
				                <div class="form-group">
				                	<div class="form-wrap">
					                    <label for="alamat-pengirim">Alamat Lengkap</label>
					                    <i class="icon-map"></i>
					                    <input type="text" class="form-input" name="alamat-pengirim" value="Jl. Kalimantan Yogyakarta" id="alamat-pengirim" placeholder="Masukan Nama Pengririm">
				                    </div>
				                </div>
					        </div>
					        <div class="col-lg-6 col-sm-12 col-xs-12">
					        	<div class="form-group">
					        		<div class="form-wrap">
					        			<i class="icon-phone"></i>
					                    <label for="nomor-telepon-pengirim">Nomor Telepon</label>
					                    <input type="text"  class="form-input" name="nomor-telepon-pengirim" value="08563044534" id="nomor-telepon-pengirim" placeholder="Nomor Telepon">
					                </div>
				                </div>
				                <div class="form-group">
				                    <label for="kode-post-pengirim">Kode Pos</label>
				                    <input type="text" class="form-input" name="kode-post-pengirim" value="234234" id="kode-post-pengirim" placeholder="Kode Pos">
				                </div>
					        </div>
					    </div>
			        </div>
			        <div class="repeater-wrap">
				         <div class="form-group">
				        	<div class="inner-section penerima-label" style="margin-bottom: 25px;">
					        	<h1 class="title-section">Penerima 1 </h1>
					        	 <p class="page-subtitle" style="text-align: left;">Lengkapi form berikut dan isi sesuai detail sebagai Penerima</p>
				        	 </div>
				        </div>
				        <div class="inner-section" style="padding-bottom: 15px;margin-bottom: 15px;">
				        	<div class="row">
						        <div class="col-lg-6 col-sm-12 col-xs-12">
						        	<div class="form-group">
					                    <label for="nama-penerima">Nama penerima</label>
					                    <input class="form-input" type="text" class="nama-penerima" name="data-penerima[0][nama-penerima]" value="Fabianus Yayan Penerima" id="nama-penerima" placeholder="Masukan Nama Pengririm">
					                </div>
					                <div class="form-group">
					                	<div class="form-wrap">
						                    <label for="alamat-penerima">Alamat Lengkap</label>
						                    <i class="icon-map"></i>
						                    <input  class="form-input" type="text" class="alamat-penerima" name="data-penerima[0][alamat-penerima]" value="Jl. Kalimantan Yogyakarta Penerima" id="alamat-penerima" placeholder="Masukan Nama Pengririm">
					                    </div>
					                </div>
						        </div>
						        <div class="col-lg-6 col-sm-12 col-xs-12">
						        	<div class="form-group">
						        		<div class="form-wrap">
						        			<i class="icon-phone"></i>
						                    <label for="nomor-telepon-penerima">Nomor Telepon</label>
						                    <input  class="form-input" type="text" class="nomor-telepon-penerima" name="data-penerima[0][nomor-telepon-penerima]" value="123123123" id="nomor-telepon-penerima" placeholder="Nomor Telepon">
					                    </div>
					                </div>
					                <div class="form-group">
					                    <label for="kode-post-penerima">Kode Pos</label>
					                    <input class="form-input" type="text" class="kode-post-penerima" name="data-penerima[0][kode-post-penerima]" value="5555" id="kode-post-penerima" placeholder="Kode Pos">
					                </div>
						        </div>
						    </div>
				        </div>
			        </div>
			        <div class="form-group">
			        <div class="form-wrap" style="padding-left: 6px;">
				        <i class="icon-add" style="color: #2254FF; top:28px !important; font-size: 11px;"></i>
				        <button type="button" class="button button-secondary button-medium" id="repeaterku" style="    border: 0px; background: none;"> <span>Tambah Penerima</span></button>
			        </div>
			        </div>
			        <div class="form-group">
			        	<div class="inner-section" style="margin-bottom: 25px;">
				        	<h1 class="title-section">Template Label Pengiriman</h1>
			        	 </div>
			        </div>
			        <div class="inner-section" style="padding-bottom: 15px;margin-bottom: 15px;">
			        	<div class="row">
					        <div class="col-lg-6 col-sm-12 col-xs-12">
					        	<div class="form-group">
				                    <label for="layout">Layout</label>
				                 	<select name="layout" class="form-input" id="layout">
				                 		<option value="potrait">Potrait</option>
				                 		<option value="landscape">Landscape</option>
				                 	</select>
				                </div>
				                <div class="form-group">
				                	<div class="form-wrap">
					                    <label for="nama-company">Nama Company</label>
					                    <input  class="form-input" type="text" name="nama-company" value="Buku Warung" id="nama-company" placeholder="Nama Toko / Perusahaan">
				                    </div>
				                </div>
				                <div class="form-group">
				                    <label for="item-order">Item Order</label>
				                    <input  class="form-input" type="text" name="item-order" value="123123123" id="item-order" placeholder="Nomor Telepon">
				                </div>
				                <div class="form-group">
				                    <input type="checkbox" id="resi-barcode" name="resi-barcode" value="1">
				                    <label for="resi-barcode">Resi Barcode</label>
				                </div>
					        </div>
					        <div class="col-lg-6 col-sm-12 col-xs-12">
					        	<div class="form-group">
				                    <label for="format">Format</label>
				                 	<select name="format" class="form-input" id="format">
				                 		<option value="A4">A4</option>
				                 		<option value="A5">A5</option>
				                 	</select>
				                </div>
				                <div class="logo-upload">
	                                <div id="select-image">
	                                    <label for="upload-logo">
	                                        
	                                        <div class="inner">
	                                            <img src="<?php echo IG__DIR; ?>assets/images/ilustrasi-upload.png" alt="Upload" class="ilustrasi">
	                                            
	                                            <span>Klik untuk upload logo anda disini</span>
	                                        </div>

	                                        <input type="file" name="upload-logo" id="upload-logo" accept="image/*">

	                                    </label>
	                                </div>
	                                <p>Upload Logo Company</p>
	                            </div>
	                             <div class="form-group">
									<label for="catatan">Catatan</label>
				                    <input type="text"  class="form-input" name="catatan" value="terima kasih kembali" id="catatan" placeholder="catatan">
				                </div>
					        </div>
					    </div>
			        </div>
			        <div class="inner-section" style="padding-bottom: 15px;margin-bottom: 15px;">
			        	<div class="row">
			        		<div class="col-12 col-lg-6 ">
				        		<div class="form-group" style="text-align: center;">
					        		<button class="button button-primary" name="LG-submit" formtarget="_blank" style="width: 205px;">Preview</button>
				        		</div>
			        		</div>
			        		<div class="col-12 col-lg-6 ">
				        		<div class="form-group" style="text-align: center;">
					        		<button class="button button-primary" name="LG-submit-pdf" formtarget="_blank" style="width: 205px;">Download</button>
				        		</div>
			        		</div>
			        	</div>
			        </div>

			        <?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    	<?php the_content(); ?>
	                <?php endwhile; endif;  ?>
	            </div>



	        </section>
		</div>
	</form>
</main>
<?php get_footer(); ?>