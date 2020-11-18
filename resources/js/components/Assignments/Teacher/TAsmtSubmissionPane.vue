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
							<a href="#" class="nav-link" data-toggle="modal" data-target="#myModal">
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
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<!-- <h4 class="modal-title">Modal Header</h4> -->
					</div>
					<div class="modal-body">
						<form @submit.prevent="createAssignment">
							<div class="form-group">
								<label for="inputAddress">Nilai</label>
								<input type="number" class="form-control">
							</div>
							<div class="form-group">
								<label for="inputAddress">Komentar</label>
								<textarea class="form-control"> </textarea>
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
		}
	}, 
	created() {
    // let uri = "http://localhost:8000/api/asmt/asmtSubmission/"+this.$route.params.id;
    let uri = "http://localhost:8000/api/asmt/asmtSubmission/"+this.$route.params.id;
    axios.get(uri).then((response) => {
    	this.subms = response.data;        
    });
  },  
}


const Modal = {
	template : `
	<div class="modal" :class="{ 'is-active': active }">
	<div class="modal-background"></div>
	<div class="modal-content">
	<div class="box">
	<div class="content">
	<h1 class="title" v-text="modal.name"></h1>
	</div>
	</div>
	</div>
	<button @click.prevent="active = false" class="modal-close is-large" aria-label="close"></button>
	</div>`
};

</script>