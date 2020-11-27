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
						<td>20200101{{ subms.nama }}</td>
						<td>{{ subms.file }}</td>
						<td>9 Januari 2020 10:24</td>
						<td>90</td>
						<td>
							<a href="#" class="nav-link" data-toggle="modal" data-target="#myModal" v-on:click="getId(subms.id_student, subms.nama, subms.id_assignment)">
								<i class="fas fa-pencil"></i>								
							</a>
						</td>
					</tr>					
				</tbody>
			</table>    
		</div>
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Penilaian {{ namaStudent }}</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>						
					</div>
					<div class="modal-body">
						<form @submit.prevent="setGrade">
							<div class="form-group">
								<label for="inputAddress">Nilai</label>
								<select class="custom-select" v-model="selected" v-on:change="gradeChange">
									<option v-bind:value="{ name: 'BSH'}">BSH</option>
									<option v-bind:value="{ name: 'MB'}">MB</option>
									<option v-bind:value="{ name: 'BB'}">MB</option>
								</select>
							</div>
							<div class="form-group">
								<label for="inputAddress">Komentar</label>
								<textarea class="form-control" v-model="form.comments"> </textarea>
							</div>
							<button type="submit" class="btn btn-primary">Submit Nilai</button>
						</form>
					</div>
					<!-- <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div> -->
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
			products: [
			{name: 'BSH'},
			{name: 'MB'},
			{name: 'BB'},
			],
			grade: null,
			username:'',
		}
	}, 
	created() {
    this.username = sessionStorage.getItem('username');
    // let uri = "http://localhost:8000/api/asmt/asmtSubmission/"+;
    let uri = "https://ceriakan.id/api/submission/"+this.$route.params.id+"/teacher/"+this.username+"/collected";
    axios.get(uri).then((response) => {
    	this.subms = response.data['data'];        
    });
  },  
  methods : {
  	getId(student, nama, assignment) {
  		this.idStudent = student;
  		this.namaStudent = nama;
  		this.idAssignment = assignment;
  	},
  	classChange(data) {
  		this.grade = this.selected.name;
      // console.log(this.selected.name);
    },
    setGrade() {
    	if (this.$data.form.grade != null ) {

    		let formData = new FormData();
    		formData.append('grade', this.class);  			
    		formData.append('comments', this.form.comments);

    		this.$swal.fire({
    			title: 'Success',
    			text: "Nilai sudah disubmit",
    			icon: 'success',
    			timer: 1000
    		})

    		axios.post('http://localhost:8000/api/asmt/gradeSubmit/'+subms.id, formData, config)
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