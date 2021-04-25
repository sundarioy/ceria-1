<template>
	<div class="container">				
		<div class="row">
			<h5 class="ml-3">Tambah Indikator</h5>		
			<div class="container mt-4">
				<div class="row">
					<div class="col-md-5">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="inputTema">Tema</label>
							</div>
							<select class="custom-select" id="inputTema" @change="temaChange">		
								<option v-for="tema in list_tema" :value="tema">{{ tema }}</option>
							</select>							
						</div>
					</div>
					<div class="col-md-5">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="inputSubtema">Subtema</label>
							</div>
							<select class="custom-select" id="inputSubtema" @change="subtemaChange">
								<option v-for="subtema in list_subtema" :value="subtema">{{ subtema }}</option>
							</select>							
						</div>
					</div>
					<div class="col-md-2">
						<div class="input-group mb-3">
							<button type="button" class="btn btn-primary" v-on:click="showIndikator">Pilih</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="container">
				<div class="report-table mt-3">
					<table>
						<thead>
							<tr>
								<th>No</th>								
								<th>Indikator</th>
							</tr>
						</thead>
						<tbody>
							<tr class="pt-1" v-for="(item, index) in list_indikator" :key="item" :value="item">
								<td>{{ index+1 }}</td>
								<td class="report-table-indikator">
									<p>{{ item }}</p>
								</td>
							</tr>      
						</tbody>
					</table>    
				</div>           
			</div>
		</div>
		<div class="row">     
			<!-- <router-link to="/tugas-create" class="float">
				<i class="fa fa-plus my-float"></i>
			</router-link> -->
			<a href="#" class="float" data-toggle="modal" data-target="#myModal" v-on:click="getId()">
				<i class="fa fa-plus my-float"></i>
			</a>
		</div>
		<div v-if="(selected_tema != null && selected_subtema != null ) " class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form method="POST" enctype="multipart/form-data" @submit.prevent="setGrade">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Tambah Indikator</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close" v-onclick="submitIndikator">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">	
							<div class="form-group">
								<label for="inputTema">Tema</label>             
								<input type="text" name="tema" class="form-control" v-model="selected_tema" disabled="disabled">
							</div>  						
							<div class="form-group">
								<label for="inputSubtema">Subtema</label>
								<input type="text" name="subtema" class="form-control" v-model="selected_subtema" disabled="disabled">
							</div>
							<div class="form-group">
								<label for="inputIndikator">Indikator</label>             
								<textarea class="form-control" v-model="indikator"> </textarea>
							</div>  
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Input Indikator</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div v-else class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">					
					<div class="modal-body">			
						<div class="row pl-3 text-center">
							<i class="fa fa-exclamation-circle fa-2x text-warning ml-2" aria-hidden="true"></i>
							<p class="ml-3 mt-1">Silahkan pilih tema dan subtema terlebih dahulu.</p>		
						</div>										
					</div>
				</div>
			</div>
		</div>
	</div>	
</template>
<script>
export default {
	data () {
		return {
			selected_tema:null,
			selected_subtema:null,
			list_tema: [null,'Diri Sendiri','Negaraku'],
			list_subtema:[null,'Identitas', 'Bagian Tubuh'],
			teacherId : '',
			username : '',
			list_indikator : [],
			indikator:'',
		}
	}, 
	created() {

		this.username = sessionStorage.getItem('username');    

		let uri = "https://ceriakan.id/api/submission/1/teacher/"+this.username+"/collected";
		axios.get(uri).then((response) => {
			this.subms = response.data['data'];        
		});

	},  
	methods: {
		temaChange: function(e) {
			switch (e.target.value) {
				case 'Diri Sendiri':
				this.list_subtema = [];
				this.list_subtema.push(null,'Identitas', 'Bagian Tubuh');
				break;
				case 'Negaraku':
				this.list_subtema = [];
				this.list_subtema.push(null,'Negaraku', 'Budaya')
				break;
				default:
				this.list_subtema = [];
				break;  
			}
			this.selected_tema = e.target.value;
        	// var name = e.target.options[e.target.options.selectedIndex].text;
        	// console.log(name);
        }, 
        subtemaChange: function(e) {
        	this.selected_subtema = e.target.value;
        },
        showIndikator: function(e) {
        	this.list_indikator = [];
        	this.list_indikator.push('Anak mampu mengucapkan kalimat Syahadat','Anak menempel huruf hijaiyyah “a na dengan lem','Anak menggambar muslim/muslimah  dengan crayon','Anak menyebutkan perbedaan bagian aurat muslim dan muslim','Anak menempel dan menyusun potongan bagian baju muslim/muslimah  puzzle yang sudah disediakan','Anak menunggu giliran dalam kegiatan');			
        }, 
        submitIndikator: function(e) {
        	this.list_indikator.push(this.indikator);
        }
    }
}
</script>