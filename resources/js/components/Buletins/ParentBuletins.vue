<template>
	<div class="container">				
		<div class="row">			
			<div class="buletin-wrapper" v-for="i in 5">
				<router-link :to="{name: 'buletin-detail', params: { id: i}}">
					<div class="buletin-box pr-3">
						<div class="col-md-12">
							<div class="buletin-thumbnail float-left col-md-3">
								<img :src="'/images/419.jpg'">
								<div class="class-middle">
									<div class="class-middle-text">Lihat buletin</div>
								</div>	
							</div>
							<div class="buletin-data float-right col-md-9">
								<div class="buletin-title">Lorem Ipsum Dolor Sit Amet {{ i }}</div>
								<div class="buletin-date">Dipost oleh Jasmine, 1 Maret 2020 10:00 WIB</div>	
								<div class="buletin-short line-clamp mt-3">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
								</div>	
							</div>
						</div>
					</div>
				</router-link>
			</div>							
		</div>
		<div class="row">
			<div class="footer-space"></div>
		</div>
		<div class="row">     
			<router-link to="/tambah-buletin" class="float">
				<i class="fa fa-plus my-float"></i>
			</router-link>
		</div>						
	</div>	
</template>