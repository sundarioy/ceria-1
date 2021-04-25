<template>
	<div class="container">
		<div class="row ml-1">
			<header class="amt-deatail-header">
				<router-link to="/daftar-kehadiran">
					<span class="path">Daftar Kehadiran Siswa </span>
				</router-link>								
				>
				<span class="path text-capitalize">{{ dataStudent.nama }}</span>
				<hr>
			</header>
		</div>
		<div class="row">
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
		<div class="row">
			<div class="col-md-10">
				<div class="asmt-submission-table mt-3">
					<table class="">
						<thead>
							<tr>
								<th class="col-number">No</th>
								<th>Tanggal</th>
								<th>Status Khadiran</th>
								<th>Lampiran</th>
							</tr>
						</thead>
						<tbody>
							<tr class="pt-1" v-for="data in 30">
								<td>{{ data }}</td>								
								<td>                  
									{{data}} Januari 2021
								</td>
								<td>Hadir</td>
								<td></td>
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
