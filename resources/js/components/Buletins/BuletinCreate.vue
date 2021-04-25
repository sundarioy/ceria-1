<template>
	<div class="container">
		<div class="col-md-10 mt-4">
			<form>
				<div class="form-group">
					<label for="exampleFormControlInput1">Judul Buletin</label>
					<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
				</div>						
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Isi</label>					
					<div id="editor">
						<p>Hello World!</p>
						<p>Some initial <strong>bold</strong> text</p>
						<p><br></p>
					</div>					
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Lampiran</label>					
					<div id="drag-drop-area"></div>
				</div>
			</form>
		</div>
	</div>
</template>

