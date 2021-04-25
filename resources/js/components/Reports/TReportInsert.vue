<template>
	<div class="container">
		<div class="row ml-2">
			<header class="amt-deatail-header">
				<router-link to="/daftar-rapor">
					<span class="path">Tambah Nilai </span>
				</router-link>
				>
				<router-link to="/daftar-rapor">
					<span class="path text-capitalize">{{dataClass.kelas}}</span>
				</router-link>
				>
				<router-link :to="{name: 'daftar-rapor-siswa', params: { id: dataStudent.nomor_induk }}">
					<span class="path text-capitalize">{{dataStudent.nama}}</span>
				</router-link>
				>
				<span class="path text-capitalize">1 Maret 2021</span>      
				<hr>
			</header>
		</div>
		<div class="row">
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
				<div class="row">
					<div class="container">
						<div class="report-table mt-3">
							<table>
								<thead>
									<tr>
										<th>No</th>								
										<th>Indikator</th>
										<th>Nilai</th>
									</tr>
								</thead>
								<tbody>
									<tr class="pt-1" v-for="(item, index) in list_indikator" :key="item" :value="item">
										<td>{{ index+1 }}</td>
										<td class="report-table-indikator">
											<p>{{ item }}</p>
										</td>
										<td class="pr-3 grade-field">
											<select class="custom-select">
												<option selected>-</option>
												<option value="1">BB</option>
												<option value="2">BM</option>
												<option value="3">MSH</option>
											</select>
										</td>
									</tr> 
									<tr class="bg-white" id="btnSubmit" hidden>
										<td></td>
										<td></td>
										<td class="float-right pr-3 pt-2">
											<button type="button" class="btn btn-primary" v-on:click="showIndikator">Submit</button>
										</td>
									</tr>     
								</tbody>
							</table>    
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
			dataClass:[],			
			dataStudent:[],
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

		// let uri = "https://ceriakan.id/api/submission/1/teacher/"+this.username+"/collected";
		// axios.get(uri).then((response) => {
		// 	this.subms = response.data['data'];        
		// });

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
        	document.getElementById("btnSubmit").removeAttribute("hidden");
        }, 
        submitIndikator: function(e) {
        	this.list_indikator.push(this.indikator);
        }
    }
}
</script>