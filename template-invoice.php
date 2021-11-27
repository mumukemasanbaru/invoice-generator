<?php get_header(); ?>
<?php 
    
    $upload_dir = wp_upload_dir();
    $random_str = generateRandomString();
    $target_dir = $upload_dir['basedir'].'/';
    $target_url = $upload_dir['baseurl']."/";
    $random_str = generateRandomString();

     if(isset($_POST['IG-download']) && wp_verify_nonce($_POST['IG-nonce'], 'IG-secure-nonce') ){


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

            if($_POST['template-invoice']=='template-1'){

                include 'template-preview.php';
            } else {
                
                include 'template-preview-2.php';
            }


            ?>
                <script type="text/javascript">
                    window.location.href = "<?php echo $target_url.$random_str.'.pdf'; ?>";
                </script>
            <?php

            $content = ob_get_contents();

            ob_end_clean();

            
            echo $content;



            require_once  'vendor/autoload.php';

            ob_start();

            ob_end_flush();

            $stylesheet = file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap-reboot.min.css');
            $custom = file_get_contents(IG__DIR . 'assets/style.css');



            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($custom,\Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($content,\Mpdf\HTMLParserMode::HTML_BODY);
            $mpdf->Output($target_dir.$random_str.'.pdf');
            
            get_footer();

            exit();


     }



    if(isset($_POST['IG-preview']) && wp_verify_nonce($_POST['IG-nonce'], 'IG-secure-nonce') ){

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

            if($_POST['template-invoice']=='template-1'){

                include 'template-preview.php';
            } else {
                
                include 'template-preview-2.php';
            }

            $content = ob_get_contents();

            ob_end_clean();

            
            echo $content;



            // require_once  'vendor/autoload.php';

            // ob_start();

            // ob_end_flush();

            // $stylesheet = file_get_contents('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap-reboot.min.css');
            // $custom = file_get_contents(IG__DIR . 'assets/style.css');



            // $mpdf = new \Mpdf\Mpdf();
            // $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
            // $mpdf->WriteHTML($custom,\Mpdf\HTMLParserMode::HEADER_CSS);
            // $mpdf->WriteHTML($content,\Mpdf\HTMLParserMode::HTML_BODY);
            // $mpdf->Output($target_dir.$random_str.'.pdf');
            
            get_footer();

            exit();
            
        }
?>
<main>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data" >
            <?php wp_nonce_field( 'IG-secure-nonce', 'IG-nonce' ); ?>    
            <div class="row">
                <section id="main-section" class="col-12 col-lg-9">
                    <div class="inner-wrap repeater">
                        <div class="inner-section first">
                            <div class="row">
                                <div class="col-12 col-lg-6">
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
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="invoice-info">
                                        <h1 class="title-invoice">INVOICE</h1>
                                        <div class="form-group">
                                            <div class="form-inner">
                                                <input type="text" class="form-input" value="" placeholder="#001" id="invoice-id" name="invoice-id">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="invoice-datecreated">Tanggal Pembuatan</label>
                                            <div class="form-inner">
                                                <i class="icon-calendar"></i>
                                                <input type="text" class="form-input datepicker" value="" name="invoice-datecreated" id="invoice-datecreated">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!--.inner-section-->

                        <div class="inner-section" style="padding-bottom: 20px;">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="invoice-form form-sender">
                                        <h3 class="title-section">Invoice Pengirim</h3>

                                        <div class="form-group">
                                            <input type="text" class="form-input" id="sender-nama" name="sender-nama" value="" placeholder="Nama">
                                        </div>

                                        <div class="form-group">
                                            <input type="email" value="" class="form-input" id="sender-email" name="sender-email" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-input" id="sender-npwp" value="" name="sender-npwp" placeholder="NPWP (Opsional)">
                                        </div>

                                        <div class="form-group">
                                            <textarea name="sender-alamat" id="sender-alamat"  name="sender-alamat" class="form-input" rows="3" placeholder="Alamat"> </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="invoice-form form-receiver">
                                        <h3 class="title-section">Invoice Penerima</h3>

                                        <div class="form-group">
                                            <input type="text" class="form-input" name="receiver-nama" id="receiver-nama" value="" placeholder="Nama">
                                        </div>

                                        <div class="form-group">
                                            <input type="email" class="form-input" id="receiver-email" value="" name="receiver-email" placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-input" value="" id="receiver-npwp" name="receiver-npwp" placeholder="NPWP (Opsional)">
                                        </div>

                                        <div class="form-group">
                                            <textarea name="receiver-alamat" id="receiver-alamat" name="receiver-alamat" class="form-input" rows="3" placeholder="Alamat"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!--.inner-section-->

                        <div class="inner-section" style="padding-bottom: 20px;margin-bottom: 20px;">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-invoice table-nobordered">
                                        <thead>
                                            <tr>
                                                <th class="deskripsi">Deskripsi</th>
                                                <th class="item">Item</th>
                                                <th class="harga">Harga</th>
                                                <th class="total">Total</th>
                                                <th class="aksi">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody data-repeater-list="table-item">
                                            <tr data-repeater-item id="kode-0">
                                                <td class="deskripsi" data-title="Deskripsi">
                                                    <input type="text" class="form-input" name="item-name" placeholder="Nama item" value="">
                                                    <input type="text" class="form-input" name="desc" placeholder="Keterangan" value="">
                                                </td>
                                                <td class="item" data-title="Item">
                                                    <input type="number" name="quantity" id="" class="form-input quantity" name="item-qty" id="item-qty"  value="1" placeholder="Item" min="1" value="">
                                                </td>
                                                <td class="harga" data-title="Harga">
                                                    <input type="text" name="harga" id="" class="form-input harga" placeholder="Harga" value="">
                                                </td>
                                                <td class="total" data-title="Total">
                                                    <input type="text" name="total_barang" id="" class="form-input total_barang" placeholder="Total" value="">
                                                </td>
                                
                                                <td class="aksi" data-title="Aksi">
                                                    <button type="button" data-repeater-create class="button button-unstyled"><i class="icon-add"></i> <span class="text-mobile">Tambah</span></button>
                                                    <button type="button" data-repeater-delete class="button button-unstyled"><i class="icon-X"></i> <span class="text-mobile">Hapus</span></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>  <!--.inner-section-->

                        <div class="inner-section" style="padding-bottom: 20px;margin-bottom: 20px;">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <button type="button" class="button button-secondary button-medium" data-repeater-create> <i class="icon-add"></i> <span>Tambah Baris</span></button>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <table class="table table-nobordered table-invoice-total">
                                        <tbody>
                                            <tr>
                                                <th>
                                                    <strong class="text-highlight">Subtotal</strong>
                                                </th>
                                                <td>
                                                    <input type="text" name="subtotal" value="" id="" class="form-input input-money" placeholder="Total" >
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    Tambah Diskon
                                                </th>
                                                <td>
                                                    <input type="text" value="" name="diskon" id="diskon" class="form-input input-money" placeholder="Diskon">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>
                                                    VAT
                                                </th>
                                                <td>
                                                    <input type="text" value="" name="vat" id="vat" class="form-input input-money" placeholder="VAT">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Dibayar</th>
                                                <td>
                                                      <input type="text" name="dibayar" id="" class="form-input input-money" placeholder="Total" value="">
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th><strong class="text-highlight">Total</strong></th>
                                                <td>
                                                    <input type="text" name="total" id="total" class="form-input total-harga input-money" placeholder="Total" value="" >
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>  <!--.inner-section-->

                        <div class="inner-section section-bank-rekening">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="bank-pilihan">Bank</label>
                                        <input type="text" class="form-input" name="Bank" value="">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="nomor-rekening">Nomor Rekening</label>
                                        <input type="text" name="nomor-rekening"  value="" id="" class="form-input" placeholder="Nomor rekening">
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <input type="text" name="catatan" id="catatan" value="" class="form-input" placeholder="Catatan">
                                    </div>
                                </div>
                                <?php /*
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="term">Terms</label>
                                        <input type="text" name="term" id="term" class="form-input" placeholder="Terms">
                                    </div>
                                </div>

                                */?>

                            </div>
                        </div>  <!--.inner-section-->

                        <?php if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                            <?php the_content(); ?>
                        <?php endwhile; endif;  ?>

                    </div>
                </section>
    
                <aside id="sidebar" class="col-12 col-lg-3">
                    <div class="side-item side-aksi">
                        <button class="button button-primary button-block" name="IG-download" formtarget="_blank">Download</button>
                        <button class="button button-secondary button-block" name="IG-preview" formtarget="_blank">Preview</button>
                    </div>
    
                    <div class="side-item">
                        <label for="template-invoice">Template</label>
                        <select name="template-invoice" class="form-input" id="template-invoice">
                            <option value="template-1">Invoice Template 1</option>
                            <option value="template-2">Invoice Template 2</option>
                        </select>
                    </div>
                </aside>
            </div>
        </form>
    </div> <!--.container-->
</main>




<?php get_footer(); ?>