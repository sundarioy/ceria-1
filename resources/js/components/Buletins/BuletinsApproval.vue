<template>
	<div class="container">
		<div class="row">
			<ul class="list-unstyled components assignment-menu" >				
				<li class="nav-item">
					<router-link to="/buletin-approval">
						<a href="#" class="nav-link">
							<i class="fas fa-tasks"></i>
							Butuh Persetujuan
							<span class="font-weight-bold">(3)</span>
						</a>
					</router-link>
				</li>
			</ul>     
		</div>		
		<div class="row">
			<div class="container ">
				<div class="asmt-submission-table mt-1 ml-1">
					<table class="">
						<thead>
							<tr>
								<th class="col-number">No</th>
								<th>Judul</th>
								<th>Author</th>
								<th>Tanggal Submit</th>     
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<tr class="pt-1" v-for="idx in 3">
								
								<td class="p-2">{{idx}}</td>
								<td>                  
									<router-link :to="{name: 'buletin-review', params: { id: idx}}">
										<span class="">Lorem Ipsum</span>           
									</router-link>
								</td>
								<td>Sundari</td>      
								<td>
									1 Maret 2021
								</td>
								<td>Pending Approval</td>

							</tr>   
						</tbody>
					</table>    
				</div>           
			</div>
		</div>
		<div class="row">
			<div class="footer-space"></div>
		</div>
	</div>
</template>