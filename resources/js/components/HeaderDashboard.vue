<template>	
	<div class="container col-md-12" id="header-wrapper">
		<div class="col-sm-9"></div>
		<div class="col-sm-3">			
			<ul class="list-unstyled components">
				<li>
					<a href="#">
						<div id="">
							<i class="fas fa-bell"></i> 
							<div id="notification">
								<span>2</span>
							</div>
						</div>
						
					</a>				
				</li>
				<li>
					<a href="#">
						<i class="fas fa-user"></i>
						{{ user.name }}
					</a>	
				</li>
			</ul>
		</div>		
	</div>		
</template>
<script>

// axios.defaults.headers.common = {'Authorization': `Bearer ${token}`};

export default {	

	data() {
		return {
			user: []
		}
	},
	created() {
		let uri = 'http://localhost:8000/api/getUserProfile';
		axios.get(uri).then(response => {
			this.user = response.data;

		});
	},
	methods: {
		
	}
}
</script>