<?php
require 'function.php';
?>
<!DOCTYPE html>
<head>
    <!-- Css -->
    <link rel="stylesheet" href="./dist/styles.css">
    <link rel="stylesheet" href="./dist/all.css">
	<link rel="stylesheet" href="./dist/menu.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <title>Ujian Akhir Semester</title>
</head>
<body>
	<!--Container -->
	<div class="mx-auto bg-grey-400">
		<!--Screen-->
		<div class="min-h-screen flex flex-col">
			<!--Header Section Starts Here-->
			<nav class = "menu">
				<label class = "judul">Toko Laris Manis</label>
				<ul>
					<li><a href = "index.php">Beranda</a></li>
					<li><a href = "index.php">Pilihan</a>
						<ul class = "dropdown">
							<li><a href = "index.php">Persediaan Barang</a></li>
							<li><a href = "masuk.php">Barang Masuk</a></li>
							<li><a href = "keluar.php">Barang Keluar</a></li>
						</ul>
					</li>
					<li><a href = "index.php">Media Sosial</a>
						<ul class = "dropdown">
							<li><a href = "https://www.facebook.com/" target='_blank'>Facebook</a></li>
							<li><a href = "https://telegram.org/" target='_blank'>Telegram</a></li>
							<li><a href = "https://www.whatsapp.com/" target='_blank'>WhatsApp</a></li>
							<li><a href = "https://instagram.com/" target='_blank'>Instagram</a></li>
						</ul>
					</li>
					<li><a href = "https://github.com/pelemlegi/ujian-akhir-semester-1.git" target='_blank'>Tentang</a></li>
				</ul>
			</nav>
			<!--/Header-->
			<div class="flex flex-1">
				<!--Main-->
				<main class="bg-white-300 flex-1 p-3 overflow-hidden">
					<div class="flex flex-col">
						<!-- Card Sextion Starts Here -->
						<div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">
							<!-- card -->
							<div class="rounded overflow-hidden shadow bg-white mx-2 w-full">
								<div class="px-6 py-2 border-b border-light-grey">
									<div class="font-bold text-xl">Barang Keluar</div>
									<div class="p-3">
									<button data-modal='centeredFormModal' class="modal-trigger bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Keluarkan Barang
									</button>
								</div>
								</div>
								<div class="table-responsive">
									<table class="table text-grey-darkest">
										<thead class="bg-grey-dark text-white text-normal">
										<tr>
											<th scope="col">Nomor</th>
											<th scope="col">Tanggal</th>
											<th scope="col">Nama Barang</th>
											<th scope="col">Jumlah</th>
											<th scope="col">Penerima</th>
										</tr>
										</thead>
										<tbody>
											<?php
												$ambilsemuadatastock = mysqli_query($conn,"select * from keluar k, stock s where s.idbarang = k.idbarang");
												$i = 1;
												while($data = mysqli_fetch_array($ambilsemuadatastock))
												{
													$tanggal = $data['tanggal'];
													$namabarang = $data['namabarang'];
													$qty = $data['qty'];
													$penerima = $data['penerima'];
											?>									
											<tr>
												<td><?=$i++;?></td>
												<td>
													<?php
														echo date('d ', strtotime($tanggal));
														$month = date('F', strtotime($tanggal));
														switch ($month)
														{
															case 'January':
																echo "Januari";
																break;
															case 'February':
																echo "Februari";
																break;
															case 'March':
																echo "Maret";
																break;
															case 'April':
																echo "April";
																break;
															case 'May':
																echo "Mei";
																break;
															case 'June':
																echo "Juni";
																break;
															case 'July':
																echo "Juli";
																break;
															case 'August':
																echo "Agustus";
																break;
															case 'September':
																echo "September";
																break;
															case 'Oktober':
																echo "Oktober";
																break;
															case 'November':
																echo "November";
																break;
															default:
																echo "Desember";
														}
														echo date(' Y', strtotime($tanggal));
														echo ", Pukul ";
														echo date('H.i', strtotime($tanggal));
														echo " WIB";  
													?>
												</td>
												<td><?=$namabarang;?></td>
												<td><?=$qty;?></td>
												<td><?=$penerima;?></td>
											</tr>
											<?php
												};									
											?>
										</tbody>
									</table>
								</div>
							</div>
							<!-- /card -->
						</div>
						<!-- /Cards Section Ends Here -->
					</div>
				</main>
				<!--/Main-->
			</div>
			<!--Footer-->
			<footer class="bg-grey-darkest text-white p-2">
				<div class="flex flex-1 mx-auto">C-2000018166-Muhammad Izza</div>
			</footer>
			<!--/footer-->
		</div>
	</div>
	<!-- Centered With a Form Modal -->
	<div id='centeredFormModal' class="modal-wrapper">
		<div class="overlay close-modal"></div>
		<div class="modal modal-centered">
			<div class="modal-content shadow-lg p-5">
				<div class="border-b p-2 pb-3 pt-0 mb-4">
					<div class="flex justify-between items-center">
						Keluarkan Barang
						<span class='close-modal cursor-pointer px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200'>
						<i class="fas fa-times text-gray-700"></i>
						</span>
					</div>
				</div>
				<!-- Modal content -->
				<form method = "post" id='form_id' class="w-full">
					<div class="flex flex-wrap -mx-3 mb-6">
						<div class="w-full px-3">
							<label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-password">
							Nama Barang
							</label>
							<select name = "barangnya" class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey">
								<?php
									$ambilsemuadatanya = mysqli_query($conn,"select * from stock");
									while($fetcharray = mysqli_fetch_array($ambilsemuadatanya)){
										$namabarangnya = $fetcharray['namabarang'];
										$idbarangnya = $fetcharray['idbarang'];
								?>								
								<option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>								
								<?php
									}
								?>
							</select>
						</div>
						<div class="w-full px-3">
							<label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-password">
							Jumlah
							</label>
							<input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-password" type = "number" name = "qty" placeholder = "Jumlah" required>
							</input>
						</div>
						<div class="w-full px-3">
							<label class="block uppercase tracking-wide text-grey-darker text-xs font-light mb-1" for="grid-password">
							Penerima
							</label>
							<input class="appearance-none block w-full bg-grey-200 text-grey-darker border border-grey-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-grey" id="grid-password" type = "text" name = "penerima" placeholder = "Penerima" required>
							</input>
						</div>
					</div>
					<div class="mt-5">
						<button class='bg-green-500 hover:bg-green-800 text-white font-bold py-2 px-4 rounded' name = "addbarangkeluar">
						Serahkan
						</button>
						<span class='close-modal cursor-pointer bg-red-200 hover:bg-red-500 text-red-900 font-bold py-2 px-4 rounded'>
						Tutup
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Centered With a Form Modal ends here -->
	<script src="./main.js"></script>
</body>
</html>