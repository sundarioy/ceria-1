<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Ceria</title>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('bootstrap-4.3.1-dist/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('bootstrap-4.3.1-dist/css/bootstrap-grid.css') }}" rel="stylesheet">
	
	<!-- Font Awesome JS -->    
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body id="login">
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
		<div class="row" id="outer-login">
			<div class="container col-md-12" id="middle-login">
				<div class="row mt-5 pt-5">
					<div class="login-box">		
						<div class="row">
							<div id="login-image" class="m-auto">
								<div class="student-image"></div>
							</div>
						</div>					
						<div class="row">
							<div id="login-form" class="m-auto pt-5">
								<!-- <form method="POST" action="https://ceriakan.id/api/parent/login">  -->
									<!-- onsubmit="send(event,this)" -->
									<form action="https://ceriakan.id/api/parent/login" id="form-login">
										<div class="row pt-3">
											<input type="text" name="username" id="username" placeholder="&#xf007; &emsp;&emsp; Username" >
										</div>
										<div class="row pt-2">
											<input type="password" name="password" id="password" placeholder="&#xf023; &emsp;&emsp; Password">
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
	</body>
	</html>

	<script >
	//e.preventDefault();
	//const params = new URLSearchParams([...new FormData(e.target).entries()]);
  // fetch("/api/auth/login", {method:"POST", body:params})
  //fetch("https://ceriakan.id/api/parent/login", {method:"POST", body:params})
  //const response = await new Response(params).text();
  //console.log(response);



  // document.forms[0].onsubmit = async(e) => {
  // 	// e.preventDefault();
  // 	// const params = new URLSearchParams([...new FormData(e.target).entries()]);
  // 	// fetch("https://ceriakan.id/api/parent/login", {method:"POST", body:params})
  // 	// const response = await new Response(params).text();
  // 	// console.log(response);

  // 	// console.log(forms.username);

  // 	let formData = new FormData();
  // 	formData.append('username', forms.username);

  // 	fetch("https://ceriakan.id/api/parent/login",
  // 	{
  // 		body: formData,
  // 		method: "post"
  // 	});


  // }

  async function postFormDataAsJson({ url, formData }) {
  	const plainFormData = Object.fromEntries(formData.entries());
  	const formDataJsonString = JSON.stringify(plainFormData);

  	const fetchOptions = {
  		method: "POST",
  		headers: {
  			"Content-Type": "application/json",
  			Accept: "application/json",
  		},
  		body: formDataJsonString,
  	};

  	const response = await fetch(url, fetchOptions);

  	if (!response.ok) {
  		const errorMessage = await response.text();
  		throw new Error(errorMessage);
  	}

  	return response.json();
  }

  async function handleFormSubmit(event) {
  	event.preventDefault();

  	const form = event.currentTarget;
  	const url = form.action;

  	try {
  		const formData = new FormData(form);
  		const responseData = await postFormDataAsJson({ url, formData });

  		if (responseData['success']) {
  			window.location.replace("/tugas-open");

  		}

  	} catch (error) {
  		console.error(error);
  	}
  }

  const loginForm = document.getElementById("form-login");
  loginForm.addEventListener("submit", handleFormSubmit);


</script>