<template>	
	<div class="container col-md-12" id="header-wrapper">
		<div class="col-sm-9"></div>
		<div class="col-sm-3">						
			<div class="row">
				<div id="">
					<i class="fas fa-bell"></i> 
					<div id="notification">
						<span>2</span>
					</div>
				</div>
				<div class="dropdown ml-4">
					<button class="dropbtn dropdown-toggle">{{username}}</button>
					<div class="dropdown-content">
						<a href="#" v-on:click="logout()">Logout</a>
					</div>
				</div>
			</div>
		</div>		
	</div>		
</template>
<script>

export default {	

	data() {
		return {
			user: [], 
			username : '' ,
		}
	},
	created() {

		this.username = sessionStorage.getItem('username');

		// let uri = 'http://localhost:8000/api/getUserProfile';
		// axios.get(uri).then(response => {
		// 	this.user = response.data;

		// });
	},
	methods: {
		logout() {
			sessionStorage.clear();
			window.location.replace("/home");	
		}
	}
}

</script>