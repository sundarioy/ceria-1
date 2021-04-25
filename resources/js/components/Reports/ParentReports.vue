<template>
	<div class="container">
		<div class="row ml-1">
			<header class="amt-deatail-header">
				<router-link to="/rapor">
					<span class="path">Rapor Siswa </span>
				</router-link>
				>				
				<hr>
			</header>
		</div>
		<div class="row ml-2">
			<div class="report-table mt-2">
				<table class="col-md-6" id="studentsTable">
					<thead>						
						<tr>
							<th>No</th>
							<th>Tanggal</th>							
							<th>Aksi</th>                
						</tr>
					</thead>
					<tbody>
						<tr class="pt-1" v-for="(subms, index) in 10">
							<td class="col-number">{{ index+1 }}</td>
							<td>
								Senin, 1 Maret 2021
							</td>							
							<td>
								<router-link :to="{name: 'rapor-detail', params: { id: 1 }}">
									<a href="#" class="nav-link">
										<i class="fas fa-search text-secondary"></i>
									</a>
								</router-link>  
							</td> 
							
						</tr>         
					</tbody>
				</table>    
			</div>           
		</div>		
		<div class="row">
			<div class="footer-space"></div>
		</div>	
	</div>
</template>


<script>

export default {
	data () {
		return {			
			dataClass:[],			
			dataStudent:[],			
			dataParent:[],	
			parentId:'',
			classId:'',
		}
	}, 
	created() {

		this.username = sessionStorage.getItem('username');    

		let uri = "https://ceriakan.id/api/child/"+this.$route.params.id;
		axios.get(uri).then((response) => {
			this.dataStudent = response.data['data'];
			this.parentId = response.data['data'].nik_parent;
			this.classId = response.data['data'].id_kelas;

			let uri2 = "https://ceriakan.id/api/parent/"+this.parentId;
			axios.get(uri2).then((response) => {
				this.dataParent = response.data['data'];			
			});

			let uri3 = "https://ceriakan.id/api/kelas/"+this.classId;
			axios.get(uri3).then((response) => {
				this.dataClass = response.data['data'];			
			});

		});

		

	},  
}

</script>
