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
				<div class="student-image"></div>			
			</div>			
		</div>
		<div class="row">
			<div class="student-name">{{ student.nama }} </div>
		</div>
		<div class="row">
			<ul class="list-unstyled components">
				<li class="nav-item" v-bind:class = "(route == 'kelas')?'active':''">
					<router-link to="/kelas" v-on:click="setRoute('kelas',e)">
						<a href="#" class="nav-link" v-bind:class = "(route == 'kelas')?'active':''" v-on:click="setRoute('kelas',$event)">
							<i class="fas fa-chalkboard"></i>
							Kelas
						</a>
					</router-link>
				</li>
				<li class="nav-item " v-bind:class = "(route == 'tugas-open')?'active':''">
					<router-link :to="{ name: 'tugas-open' }">
						<a href="#" class="nav-link" v-bind:class = "(route == 'tugas-open')?'active':''" v-on:click="setRoute('tugas-open',$event)">
							<i class="fas fa-ballot-check"></i>
							Tugas
						</a>
					</router-link>
				</li>
				<li class="nav-item" v-bind:class = "(route == 'kehadiran')?'active':''">
					<router-link :to="{ name: 'kehadiran' }">
						<a href="#" class="nav-link" v-bind:class = "(route == 'kehadiran')?'active':''" v-on:click="setRoute('kehadiran',$event)">
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
				<li class="nav-item" v-bind:class = "(route == 'rapor')?'active':''">
					<router-link :to="{ name: 'rapor' }">
						<a href="#" class="nav-link" v-bind:class = "(route == 'rapor')?'active':''" v-on:click="setRoute('rapor',$event)">
							<i class="fas fa-file-certificate"></i>
							Rapor
						</a>
					</router-link>
				</li>
				<li class="nav-item" v-bind:class = "(route == 'daftar-buletin')?'active':''">
					<router-link :to="{ name: 'daftar-buletin' }">
						<a href="#" class="nav-link" v-bind:class = "(route == 'daftar-buletin')?'active':''" v-on:click="setRoute('daftar-buletin',$event)">
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
				<!-- <li class="nav-item">
					<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
						<i class="fas fa-home"></i>
						Home
					</a>
					<ul class="collapse list-unstyled" id="homeSubmenu">
						<li>
							<a href="#">Home 1</a>
						</li>
						<li>
							<a href="#">Home 2</a>
						</li>
						<li>
							<a href="#">Home 3</a>
						</li>
					</ul>
				</li> -->
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
			student: [],
			route:'tugas-open',
			role:'',
			username:'',
		}
	},
	created () {
		this.role = sessionStorage.getItem('role');
		this.username = sessionStorage.getItem('username');

		let uri = 'https://ceriakan.id/api/child/'+this.username;
		axios.get(uri).then(response => {
			this.student = response.data['data'];  
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