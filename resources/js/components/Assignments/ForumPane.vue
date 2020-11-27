<template>
	<div class="container" id="forum-wrapper">
		<div class="row" id="forumMessages">
			<div class="container mt-3">
				<div class="messages-user">
					<div class="messages-user-name">Rafly</div>
					<div class="messages-user-body">Apa Halo kabar semua?</div>
					<div class="messages-user-time">10:00</div>
				</div>
				<div class="messages-user">
					<div class="messages-user-name">Rafly</div>
					<div class="messages-user-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
					<div class="messages-user-time">10:00</div>
				</div>
				<div class="messages-user">
					<div class="messages-user-name">Rafly</div>
					<div class="messages-user-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
					<div class="messages-user-time">10:00</div>
				</div>
				<div class="messages-user">
					<div class="messages-user-name">Rafly</div>
					<div class="messages-user-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
					<div class="messages-user-time">10:00</div>
				</div>
				<div class="messages-user">
					<div class="messages-user-name">Rafly</div>
					<div class="messages-user-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
					<div class="messages-user-time">10:00</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 row" id="forumTextArea">			
			<form method="POST" @submit.prevent="sendMessage">
				<div class="form-group">					
					<textarea class="form-control input" v-model="message"></textarea>
				</div>  
				<div class="message-submit">					
					<button class="btn">
						<i class="fas fa-arrow-right fa-2x"></i>
					</button>
					
				</div>
			</form>
			
		</div>
	</div>
</template>

<script>

export default {

	data () {
		return {
			username:'',
			forumMsg: [],
		}
	},
	created () {

		this.username = sessionStorage.getItem('username');

	},
	methods : {
		sendMessage(e) {
			if (this.$data.message != null ) {
				let currentObj = this;		
				const config = {
					headers: { 'content-type': 'multipart/form-data','X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, }
				}		
				let formData = new FormData();
				formData.append('message', this.message);
				formData.append('id_kelas', this.$route.params.class);
				formData.append('id_tugas', this.$route.params.id);
				formData.append('username', this.username);        
				formData.append('nama', this.username); 				

				axios.post('https://ceriakan.id/api/discussion/store', formData, config)
				.then(function (response) {
					currentObj.success = response.data.success;

					this.$router.push({name: 'tugas-ungraded'});
				})
				.catch(function (error) {
					currentObj.output = error;
				});  

				this.$swal.fire({
					title: 'Success',
					text: "Tugas created successfully",
					icon: 'success',
					timer: 1000
				});

				return true;
			} 

			this.message
			e.target.reset();
			e.preventDefault();



		} 
	}


}

</script>