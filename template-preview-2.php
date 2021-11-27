<main id="preview-pdf-2">
	<div class="container">
		<?php if (isset($_POST['ID-preview'])) : ?>
			<p>
		        <a href="<?php echo $target_url.$random_str.'.pdf'; ?>" download>
		        <button class="button button-primary button-block" style="width: 200px; margin-bottom: 20px;" name="IG-download" formtarget="_blank">Download</button>
		        </a>
				
			</p>
		<?php endif; ?>
	 	<div class="header-invoice">
			<div class="row">
	    		<div class="col-md-6" style='float: left; width: 45%'>
	    			<div class="title-invoice"><h2> Invoice </h2> </div>
	    			<div class="label-invoice"> Invoice  : </div>
	    			<?php echo $_POST['invoice-id']; ?> 
	    			<div class="label-invoice"> Tanggal </div>
	    			<?php echo $_POST['invoice-datecreated']; ?>
	    		</div>
	    		<div class="col-md-6" style='float: left; width: 45%; text-align: right;'>
	    			<div class="logo">
	    				<?php if(isset($url_file )&& !empty($url_file)) : ?>
	    				<img src="<?php echo $url_file; ?>" style="height: 93px;" >
	    				<?php else : ?>
	    				<img src="https://via.placeholder.com/150" style="height: 93px;">
	    				<?php endif; ?>
	    			</div>
	    		</div>
	    	</div>
		</div>

	    <div class="invoice-actor">
	    	<div class="row">
		    	<div class="col-md-6" style='float: left; width: 45%'>

			    	<div class="label-invoice"> Penerima Invoice </div>
	    			<p> <?php echo $_POST['receiver-nama']; ?> </p>
	    			<p> <?php echo $_POST['receiver-email']; ?> </p>
	    			<p> <?php echo $_POST['sender-npwp']; ?> </p>
	    			<p> <?php echo $_POST['sender-alamat']; ?> </p>
			    	<div class="label-invoice"> NPWP </div>
			    	<p> <?php echo $_POST['sender-npwp']; ?> </p>
		    	</div>
		    	<div class="col-md-6" style='float: left; width: 45%; text-align: right;'>
		   
			    	<div class="label-invoice"> Pengirim Invoice </div>
	    			<p> <?php echo $_POST['sender-nama']; ?> </p>
	    			<p> <?php echo $_POST['receiver-email']; ?> </p>
    				<p> <?php echo $_POST['receiver-npwp']; ?> </p>
	    			<p> <?php echo $_POST['receiver-alamat']; ?> </p>
			    	<div class="label-invoice"> NPWP </div>
	    			<p> <?php echo $_POST['receiver-npwp']; ?> </p>
		    	</div>
		    </div>
	    </div>
	    <div class="Invoice-table">
	    	<table class="table-nobordered" style="width: 90%;">
	    	<tr>
	    		<th style="width: 321px;"> Item </th>
	    		<th style="width: 107px;"> Harga </th>
	    		<th style="width: 107px;"> Qty </th>
	    		<th style="width: 107px;"> Harga </th>
	    	</tr>
	    	<?php if(isset($_POST['table-item']) && is_array($_POST['table-item'])) : ?>
	    		<?php foreach($_POST['table-item'] as $key) : ?>
	    			<tr>
	    				<td > <?php echo $key['item-name']; ?> </td>
	    				<td> <?php echo $key['harga']; ?> </td>
	    				<td> <?php echo $key['quantity']; ?> </td>
	    				<td> <?php echo $key['total_barang']; ?> </td>
	    			</tr>
	    			<tr>
	    				<td colspan="4"> <div class="label-invoice"> <?php echo $key['desc']; ?> </div> </td>
	    			</tr>
		    	<?php endforeach; ?>
		    	<tr>
		    		<td colspan="2"></td>
		    		<td colspan="2" class="" ></td>
		    	</tr>
		    	<tr>
		    		<td colspan="2"> </td>
		    		<td>Subtotal</td>
		    		<td><?php echo $_POST['subtotal']; ?> </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2"> </td>
		    		<td>Discount</td>
		    		<td><?php echo $_POST['diskon']; ?> </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2"> </td>
		    		<td>VAT</td>
		    		<td><?php echo $_POST['vat']; ?> </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2"> </td>
		    		<td> <div class="label-invoice"> Invoice Total </div></td>
		    		<td><?php echo $_POST['subtotal']; ?> </td>
		    	</tr>
		    	<tr>
		    		<td colspan="2"> </td>
		    		<td> Dibayar</td>
		    		<td><?php echo $_POST['dibayar']; ?> </td>
		    	</tr>
	    		<tr>
		    		<td colspan="2"></td>
		    		<td colspan="2" class="" ></td>
		    	</tr>
		    <?php endif; ?>
	    	</table>
	    </div>

	    <div class="invoice-footer" style="width:90%;">
	    	<div class="label-invoice"> Total </div>
    		<p class="garis"> </p>
	    	
    		<p style="text-align: right; font-weight: 600; font-size: 32px; line-height: 40px;"> <?php echo $_POST['total']; ?> </p>

    	


    		<div class="label-invoice"> Pembayaran </div>
    		<p> <?php echo $_POST['Bank']; ?>  <?php echo $_POST['nomor-rekening']; ?>  </p>
    		<p class="garis"> </p>
    		<div class="label-invoice">  <?php echo $_POST['catatan']; ?> </div>
	    </div>
    </div>
</main>