<template>
	<div class="container">
		<div class="row ml-1">
			<header class="amt-deatail-header">
				<router-link to="/daftar-rapor">
					<span class="path">Tambah Nilai </span>
				</router-link>
				>
				<router-link to="/daftar-rapor">
					<span class="path text-capitalize">{{dataClass.kelas}}</span>
				</router-link>
				>
				<span class="path text-capitalize">{{dataStudent.nama}}</span>
				<hr>
			</header>
		</div>
		<div class="row">
			<!-- <h5 class="ml-3">Isi Nilai Siswa</h5>		 -->
			<div class="class-header ml-3">
				<div class="class-box-large">                   
				</div>          
				<div class="class-data ml-4 mt-5">
					<div class="class-name-large mt-3">{{dataStudent.nama}}</div>  
					<table class="mt-4">
						<tr>
							<td>NIS</td>
							<td>&emsp;: {{dataStudent.nomor_induk}}</td>
						</tr>
						<tr>
							<td>Kelas</td>
							<td>&emsp;: {{dataClass.kelas}}</td>
						</tr>
						<tr>
							<td>Orangtua/Wali</td>
							<td>&emsp;: {{dataParent.nama}}</td>
						</tr>
					</table>          
				</div>
			</div>      
		</div>
		<div class="row ml-2">
			<div class="report-table mt-3">
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
								<router-link :to="{name: 'detail-rapor', params: { id: dataStudent.nomor_induk, date : 1 }}">
									<a href="#" class="nav-link" data-toggle="modal" data-target="#myModal" v-on:click="getId(subms.nis, subms.nama, subms.id)">
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
			<router-link :to="{name: 'tambah-rapor', params: { id: dataStudent.nomor_induk, date : 1 }}">
				<a href="#" class="float" v-on:click="getId()">
					<i class="fa fa-plus my-float"></i>
				</a>
			</router-link>
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
