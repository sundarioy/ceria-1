<template>
	<div class="container">
		<div class="row">
			<div class="presence-summary col-sm-3 ml-3">
				<div class="presence-summary-title">Akumulasi Kehadiran</div>
				<div class="presence-summary-percent">100%</div>
			</div>
			<div class="presence-summary col-sm-3 ml-3">
				<div class="presence-summary-title">Absensi</div>
				<div class="presence-summary-date">
					20 Januari 2021
				</div>
				<div class="presence-tap">
					<i class="fas fa-fingerprint"></i>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="container ">
				<div class="asmt-submission-table mt-5">
					<table class="">
						<thead>
							<tr>
								<th class="p-2">No</th>
								<th>Tanggal</th>
								<th>Status Kehadiran</th>
								<th>Lampiran</th>                
							</tr>
						</thead>
						<tbody>
							<tr class="pt-1" v-for="idx in 30">
								<td class="p-2">{{idx}}</td>
								<td>                  
									<span class="">{{idx}} Januari 2021</span>                  
								</td>
								<td>Hadir</td>      
								<td>
									<router-link :to="{name: 'detail-kehadiran'}">
										<div class="presence-detail-fa">
											<i class="fa fa-search"></i>
										</div>
									</router-link>
								</td>        
							</tr>         							      
						</tbody>
					</table>    
				</div>           
			</div>
		</div>
		<div class="row">
			<div class="footer-space"></div>
		</div>
	</div>
</template>

<script>

export default {
	data() {
		currentDate : new Date()
	},
}
</script>