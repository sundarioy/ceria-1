<template>
	<div class="container pl-5">
		<div class="row">
			<ul class="list-unstyled components assignment-menu" >
				<li class="nav-item">
					<router-link to="/tugas-ungraded">
						<a href="#" class="nav-link">
							<i class="fas fa-list"></i>
							Belum Dinilai
						</a>
					</router-link>
				</li>
				<li class="nav-item active">
					<router-link to="/tugas-graded">
						<a href="#" class="nav-link active">
							<i class="fas fa-tasks"></i>
							Sudah Dinilai
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
							<th>No.</th>
							<th>Judul</th>
							<th>Pelajaran</th>
							<th>Kelas</th>
							<th>Batas Pengumpulan</th>
							<th>Keterangan</th>
						</tr>										
					</thead>
					<tbody>
						<tr class="pt-1">
							<td>1.</td>
							<td>
								<router-link to="/tugas-done-detail">Pancasila</router-link>
							</td>
							<td>PKN</td>
							<td>Kelinci</td>
							<td>9 Januari 2020 10:00 WIB</td>
							<td>Selesai</td>
						</tr>
						<tr>
							<td>2.</td>
							<td>Menulis Huruf Sambung</td>
							<td>Bahasa Indonesia</td>
							<td>Kelinci</td>
							<td>8 Januari 2020 15:00 WIB</td>
							<td>Selesai</td>
						</tr>
						<tr>
							<td>3.</td>
							<td>Penjumlahan dan Pengurangan</td>
							<td>Matematika</td>
							<td>Kelinci</td>
							<td>8 Januari 2020 17:00 WIB </td>							
							<td>Selesai</td>
						</tr>	
					</tbody>
					
				</table>
			</div>
		</div>
		<div class="row">			
			<router-link to="/tugas-create" class="float">
				<i class="fa fa-plus my-float"></i>
			</router-link>			
		</div>
	</div>
</template>
