<template>
	<div class="container pl-5">
		<div class="row">
			<ul class="list-unstyled components class-menu">
				<li class="nav-item active">					
					<a href="#" class="nav-link" data-toggle="modal" data-target="#myModal" v-on:click="">
						<i class="fas fa-plus"></i> Tambah Kelas
					</a>
				</li>				
			</ul>			
		</div>
		<div class="row">
			<div class="class-wrapper mr-5" v-for="(listClass, index) in listClass" :key="listClass.id">
				<router-link :to="{name: 'detail-kelas', params: { id: listClass.id }}">
					<div class="class-box">							
						<img :src="'/images/419.jpg'">
						<div class="class-middle">
							<div class="class-middle-text">Lihat Kelas</div>
						</div>	
					</div>		
					<div class="class-name mt-3">{{listClass.kelas}}</div>					
				</router-link>
			</div>			
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form method="POST" enctype="multipart/form-data" @submit.prevent="createClass">
						<div class="modal-body">							
							<div class="form-group">
								<label for="inputAddress">Nama Kelas</label>             
								<input type="text" class="form-control" name="">
							</div>  
							<div class="form-group">
								<label for="inputAddress">Wali Kelas</label>
								<select class="custom-select" v-model='teacher'>
									<option value='0' selected="selected">Pilih guru</option>
									<option v-for='data in listTeachers' :value='data.id'>{{ data.nama }} ({{data.nomor_pegawai}})</option>
								</select>
							</div>
							<div class="form-group">
								<label for="inputAddress">Tahun Akademik</label>
								<input type="text" class="form-control" name="" :value="currentYear">
							</div>  
							<div class="form-group">
								<label for="inputAddress">Deskripsi Kelas</label>
								<textarea class="form-control" v-model="description"> </textarea>
							</div>  							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Buat Kelas</button>
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
			listClass:[],			
			listTeachers:[],	
			currentYear : new Date().getFullYear(),
		}
	}, 
	created() {

		this.username = sessionStorage.getItem('username');

		let uri = "https://ceriakan.id/api/kelas/teacher/"+this.username;
		axios.get(uri).then((response) => {
			this.listClass = response.data['data'];
		});

		this.getTeacher();
	},  
	methods : {
		getTeacher: function(){
			axios.get('https://ceriakan.id/api/teacher')
			.then(function (response) {
				this.listTeachers = response.data['data'];
			}.bind(this));

		},

	},
}

</script>