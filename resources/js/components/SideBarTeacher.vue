<template>
	<div id="sidebar-wrapper">
		<div class="row">
			<div class="sidebar-header">
				<div id="sidebarCollapse">
					<i class="fas fa-bars"></i>
					<span>CERIA</span>
				</div>
			</div>
		</div>
		<div class="row mt-1">
			<div class="student-image-bg">
				<div class="teacher-image"></div>			
			</div>			
		</div>
		<div class="row">
			<div class="student-name">{{teacher.nama}}</div>
		</div>
		<div class="row">
			<ul class="list-unstyled components">
				<li class="nav-item" v-bind:class = "(route == 'daftar-kelas')?'active':''">
					<router-link :to="{ name: 'daftar-kelas' }">
						<a href="#" class="nav-link" v-bind:class = "(route == 'daftar-kelas')?'active':''" v-on:click="setRoute('daftar-kelas',$event)">
							<i class="fas fa-chalkboard"></i>
							Kelas
						</a>
					</router-link>
				</li>
				<li class="nav-item " v-bind:class = "(route == 'tugas-ungraded')?'active':''">
					<router-link :to="{ name: 'tugas-ungraded' }">
						<a href="#" class="nav-link" v-bind:class = "(route == 'tugas-ungraded')?'active':''" v-on:click="setRoute('tugas-ungraded',$event)">
							<i class="fas fa-ballot-check"></i>
							Tugas
						</a>
					</router-link>
				</li>
				<li class="nav-item" v-bind:class = "(route == 'daftar-kehadiran')?'active':''">
					<router-link :to="{ name: 'daftar-kehadiran' }">
						<a href="#" class="nav-link" v-bind:class = "(route == 'daftar-kehadiran')?'active':''" v-on:click="setRoute('daftar-kehadiran',$event)">
							<i class="fas fa-clipboard-check"></i>
							Kehadiran
						</a>
					</router-link>
				</li>
				<!-- <li class="nav-item" v-bind:class = "(route == 'prestasi')?'active':''">
					<router-link :to="{ name: 'prestasi' }">
						<a href="#" class="nav-link" v-bind:class = "(route == 'prestasi')?'active':''" v-on:click="setRoute('prestasi',$event)">
							<i class="fas fa-file-certificate"></i>
							Prestasi
						</a>
					</router-link>
				</li> -->
				<li class="nav-item" v-bind:class = "(route == 'buletin')?'active':''">
					<router-link :to="{ name: 'buletin' }">
						<a href="#" class="nav-link" v-bind:class = "(route == 'buletin')?'active':''" v-on:click="setRoute('buletin',$event)">
							<i class="fas fa-browser"></i>
							Buletin
						</a>
					</router-link>
				</li>
				<li class="nav-item" v-bind:class = "(route == 'pengingat')?'active':''">
					<router-link :to="{ name: 'pengingat' }">
						<a href="#" class="nav-link" v-bind:class = "(route == 'pengingat')?'active':''" v-on:click="setRoute('pengingat',$event)">
							<i class="fas fa-alarm-clock"></i>
							Pengingat
						</a>
					</router-link>
				</li>
				<li class="nav-item">
					<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
						<i class="fas fa-file-certificate"></i>
						Rapor
					</a>
					<ul class="collapse list-unstyled" id="homeSubmenu">
						<li>
							<router-link :to="{ name: 'tambah-tema' }">
								<a href="#" class="nav-link pt-1 pb-1" v-bind:class = "(route == 'tambah-tema')?'active':''" v-on:click="setRoute('tambah-tema',$event)">
									Tambah Tema
								</a>
							</router-link>
						</li>
						<li>
							<router-link :to="{ name: 'tambah-indikator' }">
								<a href="#" class="nav-link pt-1 pb-1" v-bind:class = "(route == 'tambah-indikator')?'active':''" v-on:click="setRoute('tambah-indikator',$event)">
									Tambah Indikator
								</a>
							</router-link>
						</li>
						<li>
							<router-link :to="{ name: 'daftar-rapor' }">
								<a href="#" class="nav-link pt-1 pb-1" v-bind:class = "(route == 'daftar-rapor')?'active':''" v-on:click="setRoute('daftar-rapor',$event)">
									Isi Nilai Siswa
								</a>
							</router-link>
						</li>						
					</ul>
				</li>
			</ul>
		</div>
	</div>
</template>
<script type="text/javascript">
$(document).ready(function () {

	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('minimize');
	});

});

export default {
	data() {
		return {
			teacher: [],
			route:'tugas-ungraded',
			role:'',
			usernam: '',
		}
	},
	created () {
		this.role = sessionStorage.getItem('role');
		this.username = sessionStorage.getItem('username');

		let uri = 'https://ceriakan.id/api/teacher/'+this.username;
		axios.get(uri).then(response => {
			this.teacher = response.data['data'];
		});

	}, methods: {
		setRoute(val, event) {
			// this.route = val;
			event.preventDefault;
			this.route = val;
			// console.log(this.route);
		}
	}
}

</script>