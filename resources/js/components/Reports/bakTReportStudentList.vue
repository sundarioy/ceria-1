<template>
	<div class="container">		
		<!-- <div class="row">
			<h5 class="ml-3">Isi Nilai Siswa</h5>		
		</div> -->
		<div class="row ml-1">
			<header class="amt-deatail-header">
				<router-link to="/daftar-rapor">
					<span class="path">Tambah Nilai </span>
				</router-link>
				>
				<span class="path text-capitalize">{{ selectedClass }}</span>
				<hr>
			</header>
		</div>
		<div class="row ml-3 mt-3">
			<div class="class-wrapper mr-4" v-for="(listClass, index) in listClass" :key="listClass.id" v-on:click="selectClass(listClass.id, listClass.kelas)">
				<div class="class-box-small" :id="'class-box' + index">
					<img :src="'/images/419.jpg'">
					<div class="class-middle-small" :id="'class-box-check' + index" hidden>
						<div class="class-middle-text-small">
							<i class="fa fa-check"></i>
						</div>
					</div>	
				</div>	
				<div class="class-name-small pt-4 mt-5">{{listClass.kelas}}</div>
			</div>			
		</div>	
		<div class="row ml-2">
			<div class="report-table mt-5">
				<table class="col-md-8" id="studentsTable" hidden>
					<thead>						
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>NIS</th>                
							<th>Aksi</th>                
						</tr>
					</thead>
					<tbody>
						<tr class="pt-1" v-for="(student, index) in list_siswa" :key="student.id">
							<td class="col-number">{{ index+1 }}</td>
							<td>
								<div class="row">
									<div class="table-student-thumbnail border-1-555 ml-3"></div>
									<span class="mt-2 ml-2">{{ student.nama }}</span>
								</div>
							</td>
							<td>{{ student.nomor_induk }}</td>
							<td>
								<router-link :to="{name: 'daftar-rapor-siswa', params: { id: student.nomor_induk }}">
									<a href="#" class="nav-link">
										<i class="fas fa-search text-dark"></i>
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
			listClass:[],			
			list_siswa:[],	
			currentYear : new Date().getFullYear(),
			selectedBox : null,
			selectedClass : '',
			classId: null,
		}
	}, 
	created() {

		this.username = sessionStorage.getItem('username');	

		let uri = "https://ceriakan.id/api/kelas/teacher/"+this.username;
		axios.get(uri).then((response) => {
			this.listClass = response.data['data'];			
		});

		// this.getTeacher();

	},  
	methods : {
		getTeacher: function(){
			axios.get('https://ceriakan.id/api/teacher')
			.then(function (response) {
				this.listTeachers = response.data['data'];
			}.bind(this));

		}, 		
		selectClass: function(val, nama) {
			var elBox = "class-box"+(val-1);
			var elCheck = "class-box-check"+(val-1);
			document.getElementById(elBox).classList.toggle("cb-small-selected");
			document.getElementById(elCheck).toggleAttribute("hidden");
			document.getElementById("studentsTable").removeAttribute("hidden");
			
			let id=val;

			let uri = "https://ceriakan.id/api/kelas/"+id;
			// let uri = "https://ceriakan.id/api/child";
			axios.get(uri).then((response) => {
				this.list_siswa = response.data['students'];
				// console.log(response.data['data'].students);
			});
			
			for (var i = this.listClass.length - 1; i >= 0; i--) {
				if(i == (val-1)) {
					continue;
				}
				elBox = "class-box"+i;
				elCheck = "class-box-check"+i;
				document.getElementById(elBox).classList.remove("cb-small-selected");
				document.getElementById(elCheck).setAttribute("hidden","hidden");
			}

			this.selectedClass = nama;	

		}, 

	},
}

</script>