<template>
	<div class="page">
		<div class="container col-xl-12">
			<div class="row wrapper">
				<div id="sidebar" class="col-xl-2">
					<sidebar></sidebar>	
				</div>
				<div id="content" class="col-xl-10">					
					<nav class="navbar navbar-expand-lg navbar-light ">
						<div class="container-fluid">
							<header-dash></header-dash>
						</div>
					</nav>
					<router-view></router-view>
				</div>
			</div>
		</div>		
	</div>	
</template>