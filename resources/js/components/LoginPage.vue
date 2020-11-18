<template>		
	<div id="login">
		<div class="container-fluid">
			<div class="row">
				<header class="col-md-12">
					<div class="col-md-3">
						<div class="login-header-image">
							<img src="../images/sun.png">
						</div>
					</div>
					<div class="col-sm-4"></div>
					<div class="col-md-5">
						<ul class="list-unstyled components" >
							<li class="nav-item">
								<a href="#" class="nav-link">								
									Beranda
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">								
									Buletin
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">								
									Tentang Kami
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link active">
									Masuk
								</a>
							</li>
						</ul>			
					</div>
				</header>			
			</div>
			<div class="row">
				<div class="container col-md-12">
					<div class="row mt-5 pt-5">
						<div class="login-box">		
							<div class="row">
								<div id="login-image" class="m-auto">
									<div class="student-image"></div>
								</div>
							</div>					
							<div class="row">
								<div id="login-form" class="m-auto pt-5">
									<form class="" action="/kelas" method="POST">
										<div class="row pt-3">
											<input type="text" name="username" placeholder="&#xf007; &emsp;&emsp; Username" >
										</div>
										<div class="row pt-2">
											<input type="password" name="password" placeholder="&#xf023; &emsp;&emsp; Password">
										</div>
										<div class="row pt-3">
											<input type="submit" name="submit" value="Masuk" class="btn-block">
										</div>
										<div class="row pt-4">
											<div class="float-left float-sm-left">
												<input type="checkbox" name="">
												<label class="login-addition">Ingat saya</label>
											</div>
											<div class="float-right float-sm-right pl-4">
												<a href="" class="login-addition">Lupa password?</a>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
</template>