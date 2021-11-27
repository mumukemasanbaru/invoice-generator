jQuery(
	function($){
		$( document ).ready(
			function(){

				// simple repeater by yayan
				$(document).on('click','#repeaterku',function(){
			
					var hitung = $('.repeater-wrap').length;
					hitung = hitung +1;
					var newel = $('.repeater-wrap:last').clone();
					$(newel).insertAfter(".repeater-wrap:last");

					$('.penerima-label h1:last').empty().append('Penerima '+hitung+' <i class="icon-X" style="cursor:pointer; color: #2254FF; top:4px !important; right: 0px; font-size: 11px;">');
					// $(".repeater-wrap:last input").val("");
					$(".repeater-wrap:last .nama-penerima").attr("name",'data-penerima['+hitung+'][nama-penerima]');
					$(".repeater-wrap:last .alamat-penerima").attr("name",'data-penerima['+hitung+'][alamat-penerima]');
					$(".repeater-wrap:last .nomor-telepon-penerima").attr("name",'data-penerima['+hitung+'][nomor-telepon-penerima]');
					$(".repeater-wrap:last .kode-post-penerima").attr("name",'data-penerima['+hitung+'][kode-post-penerima]');



				});

				// simple remover by yayan
				$(document).on('click','.penerima-label .icon-X',function(){

					var numItems = $('.repeater-wrap').length

					if(numItems>1){

						$(this).closest('.repeater-wrap').remove();
					} else {
						alert('You cant delete the last element');
					}


				});
			}


		);

	
	}
);
