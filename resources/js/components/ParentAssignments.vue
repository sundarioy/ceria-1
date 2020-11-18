<template>
	<div class="container pl-5">
		<div class="row">
			<ul class="list-unstyled components assignment-menu" >
				<li class="nav-item active">
					<a href="#" class="nav-link active">
						<i class="fas fa-list"></i>
						Belum Dikumpul
					</a>
				</li>
				<li class="nav-item">
					<router-link to="/tugas/closed">
						<a href="#" class="nav-link">
							<i class="fas fa-tasks"></i>
							Sudah Dikumpul
						</a>
					</router-link>

				</li>
			</ul>			
		</div>
		<div class="row">
			<div class="assinmnets-table mt-4">
				<table class="col-md-12">
					<thead>
						<tr>						
							<th class="col-md-1">No.</th>
							<th class="col-md-5">Judul</th>
							<th class="col-md-3">Pelajaran</th>
							<th class="col-md-3">Tanggal Pengumpulan</th>						
						</tr>										
					</thead>
					<tbody>
						<tr class="pt-1">
							<td>1.</td>
							<td>Penjumlahan Blangan</td>
							<td>Matematika</td>
							<td>10 Janurai 2020 10:00 WIB</td>
						</tr>
						<tr>
							<td>2.</td>
							<td>Mewarnai Gambar Ilustrasi</td>
							<td>Prakarya</td>
							<td>11 Janurai 2020 15:00 WIB</td>
						</tr>
						<tr>
							<td>3.</td>
							<td>Membuat video cerita</td>
							<td>Bahasa Indonesia</td>
							<td>12 Janurai 2020 17:00 WIB </td>
						</tr>	
					</tbody>
					
				</table>
			</div>
		</div>
	</div>
</template>