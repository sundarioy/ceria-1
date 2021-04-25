<template>    	
	<div class="container">
		<div class="asmt-submission-table mt-4">
			<table>
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>NIS</th>
						<th>File Pengumpulan</th>
						<th>Tanggal Pengumpulan</th>
						<th>Nilai</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr class="pt-1" v-for="(subms, index) in subms" :key="subms.id">
						<td>{{ index+1 }}</td>
						<td>
							<div class="row">
								<div class="table-student-thumbnail border-1-555"></div>
								<span class="mt-2 ml-2">{{ subms.nama }}</span>
							</div>
						</td>
						<td>{{ subms.nis }}</td>
						<td v-if="subms.file != 0"> 
							<div v-for="(prop, name) in subms.file">								
								<a v-bind:href="'https://ceriakan.id/storage/app/'+ prop.location">            
									{{ prop.title }} 
								</a>
							</div>
						</td>
						<td v-else>-</td>
						<td>{{ subms.date_created | moment("DD MMMM YYYY") }} {{ subms.date_created | moment("HH:mm") }}</td>
						<td>{{ subms.grade }}</td>
						<td>
							<a href="#" class="nav-link" data-toggle="modal" data-target="#myModal" v-on:click="getId(subms.nis, subms.nama, subms.id)">
								<i class="fas fa-pencil"></i>
							</a>
						</td>
					</tr>					
				</tbody>
			</table>    
		</div>		
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form method="POST" enctype="multipart/form-data" @submit.prevent="setGrade">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Penilaian {{ namaStudent }} - {{ idStudent }}</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">							
							<div class="form-group">
								<label for="inputAddress">Nilai</label>
								<select class="custom-select" v-model="selected" v-on:change="gradeChange">
									<option v-bind:value="{ name: 'BSH'}" value="BSH">BSH</option>
									<option v-bind:value="{ name: 'MB'}" value="MB">MB</option>
									<option v-bind:value="{ name: 'BB'}" value="BB">BB</option>
								</select>
							</div>
							<div class="form-group">
								<label for="inputAddress">Komentar Guru</label>             
								<textarea class="form-control" v-model="description"> </textarea>
							</div>  
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Input Nilai</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>

export default {
	data () {
		return {
			subms:[],
			idStudent : '',
			namaStudent : '',
			idAssignment : '',
			file:[],
			products: [
			{name: 'BSH'},
			{name: 'MB'},
			{name: 'BB'},
			],
			grade: null,
			username:'',
			selected: null,
			description: '',

		}
	}, 
	created() {

		this.username = sessionStorage.getItem('username');    		

		let uri = "https://ceriakan.id/api/submission/"+this.$route.params.id+"/teacher/"+this.username+"/collected";
		axios.get(uri).then((response) => {
			this.subms = response.data['data'];   
			this.file =  response.data['data'].file;  
		});
	},  
	methods : {
		getId(student, nama, submission) {
			this.idStudent = student;
			this.namaStudent = nama;
			this.idSubmission = submission;
		},
		gradeChange() {
			this.grade = this.selected.name;
			console.log(this.grade);
		},
		setGrade(e) {    	
			console.log('this');
			if (this.$data.selected != null ) {    		
				const config = {
					headers: { 'content-type': 'multipart/form-data','X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, }
				}
				let formData = new FormData();
				formData.append('id', this.idAssignment);  	
				formData.append('nis', this.idStudent);  	
				formData.append('nip', this.username);  	
				formData.append('grade', this.grade);  			
				formData.append('comments', this.description);

				this.$swal.fire({
					title: 'Success',
					text: "Nilai sudah disubmit",
					icon: 'success',
					timer: 1000
				})

				axios.post('https://ceriakan.id/api/submission/grade/', formData, config)
				.then(function (response) {
					currentObj.success = response.data.success;
					this.$router.push({name: 'tugas-create'});
				})
				.catch(function (error) {
					currentObj.output = error;
				});    

				return true;
			}      
			e.preventDefault();
		}
	},
}

</script>