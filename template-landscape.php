<main id="preview-landscape">
	
	<div class="container">
        <form action="" method="POST" enctype="multipart/form-data" >
            <?php wp_nonce_field( 'LG-donwload-label', 'LG-nonce' ); ?>    
 
               
                <section id="main-section" class="col-12 col-lg-12">
                    <?php if( isset($_POST['LG-submit']) ) : ?>
                     <div class="judul-preview">
                        <p>Preview Label Pengiriman</p>
                    </div>
                    <?php endif; ?>

                    <div class="row" style="padding-left: 15px;">
                    <?php /*
                        <div class="col-12 col-lg-3 sidebar-kanan">
                            <div class="form-group">
                                <label for="layout">Layout</label>
                                <select name="layout" class="form-input" id="layout" disabled>
                                    <option value="potrait" <?php echo ($_POST['layout']=='potrait') ? 'selected' : ''; ?>>Potrait</option>
                                    <option value="landscape" <?php echo ($_POST['layout']=='landscape') ? 'selected' : ''; ?>>Landscape</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="format">Format</label>
                                <select name="format" class="form-input" id="format" disabled>
                                    <option value="A4" <?php echo ($_POST['format']=='A4') ? 'selected' : ''; ?>>A4</option>
                                    <option value="A5" <?php echo ($_POST['format']=='A5') ? 'selected' : ''; ?>>A5</option>
                                </select>
                            </div>
                            <h1 class="title-section">Setting</h1>
                            <div class="filter-wrap filter-category">
                                <div class="filter-body">
                                    <ul class="categories">
                                        <li>
                                            <div class="checkbox-wrap">
                                                <input type="checkbox" name="detail-order" value="1" id="detail-order">
                                                <label for="detail-order" class="label-wrap"> Detail Order 
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-wrap">
                                                <input type="checkbox" name="detail-pengirim" value="1" id="detail-pengirim">
                                                <label for="detail-pengirim" class="label-wrap"> Detail Pengirim 
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-wrap">
                                                <input type="checkbox" name="order-barcode" value="1" id="order-barcode">
                                                <label for="order-barcode" class="label-wrap"> Order Barcode
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-wrap">
                                                <input type="checkbox" name="" value="1" id="resi-barcode">
                                                <label for="resi-barcode" class="label-wrap"> Resi Barcode 
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="checkbox-wrap">
                                                <input type="checkbox" name="" value="1" id="logo-company">
                                                <label for="logo-company" class="label-wrap"> Logo Company 
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="text-align: center;">
                                    <button class="button button-primary" name="LG-submit-pdf" formtarget="_blank" style="width: 205px;">Download PDF</button>
                                </div>
                            </div>
                        </div> */ ?>
                        
                        <div class="col-12 col-lg-12" style="padding-left: 0px; width:100%;">
                            <div class="inner-wrap repeater">
                      
                                <?php if(is_array($_POST['data-penerima'])) : ?>
                                <?php foreach ($_POST['data-penerima'] as $key ) : ?>
                                    <div class="warper-box" style="">
                                    <div class="box-label" style="width: 100%;">
                                        <div class="row">
                                            <div class="col-12 col-lg-2" style="width: 16.66666667%; float: left; ">
                                                <div class="logo">
                                                    <?php if($url_file && !empty($url_file)) : ?>
                                                    <img src="<?php echo $url_file; ?>" style="width: 93px;  transform: rotate(-90deg);     margin-top: 40%;">
                                                    <?php else : ?>
                                                    <img src="https://via.placeholder.com/150" style="width: 93px;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4"  style="width: 33.33333333%; float: left; ">
                                                <div class="label-barcode"> Penerima </div>
                                                 <p>  <i class="icon-user"></i> <?php echo $key['nama-penerima']; ?></p>
                                                <p>  <i class="icon-phone"></i><?php echo $key['nomor-telepon-penerima']; ?></p>
                                                <p>  <i class="icon-map"></i><?php echo $key['alamat-penerima']; ?>, <?php echo $key['kode-post-penerima']; ?></p>
                                                <p> <strong>Item</strong> <?php echo $_POST['item-order']; ?> </p>
                                                 <?php 
                                                    $query_arg = add_query_arg( array(
                                                                    'barcode' => 1,
                                                                    'text' => $_POST['nomor-resi'],
                                                                ), site_url($wp->request) );
                                                     ?>

                                                    <img src="<?php echo $query_arg; ?>" style="width:100%">
                                                
                                            </div>

                                            <div class="col-12 col-lg-4" style="width: 33.33333333%; float: left; ">
                                                <div class="label-barcode"> Pengirim </div>
                                                <p>  <i class="icon-user"></i> <?php echo $_POST['nama-pengirim']; ?></p>
                                                <p>  <i class="icon-phone"></i><?php echo $_POST['nomor-telepon-pengirim']; ?></p>
                                                <p>  <i class="icon-map"></i><?php echo $_POST['alamat-pengirim']; ?>, <?php echo $_POST['kode-post-pengirim']; ?></p>

                                                 <?php 
                                                    $query_arg = add_query_arg( array(
                                                                    'barcode' => 1,
                                                                    'text' => $_POST['nomor-resi'],
                                                                ), site_url($wp->request) );
                                                     ?>

                                                    <img src="<?php echo $query_arg; ?>" style="width:100%">

                                            </div>

                                            <div class="col-12 col-lg-2"  style="width: 10.66666667%; float: right; ">
                                                 <?php 
                                                    $query_arg = add_query_arg( array(
                                                                    'barcode' => 1,
                                                                    'orientation' => 'vertical',
                                                                    'size'=>  33.85,
                                                                    'text' => $_POST['nomor-resi'],
                                                                ), site_url($wp->request) );
                                                     ?>

                                                    <img src="<?php echo $query_arg; ?>" style="" >
                                            </div>
                                        </div>
                                    </div>
                                    <pagebreak >
                                    </pagebreak>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
          
        </form>
    </div>

</main>