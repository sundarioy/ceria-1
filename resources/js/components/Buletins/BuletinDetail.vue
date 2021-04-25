<template>
	<div class="container mt-3">
		<div class="row ">
			<div class="buletin-data float-right col-md-12 p-4">
				<h4>Lorem Ipsum Dolor Sit Amet </h4>
				<div class="buletin-date">Dipost oleh Jasmine, 1 Maret 2020 10:00 WIB</div>	
				<div class="mt-4">
					<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
					<p class="text-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
				</div>	
			</div>
		</div>
		<div class="row">			
			<div class="buletin-image float-left col-md-2" v-for="i in images">
				<img :src="i.src" id="myImg" v-on:click="imageModal(i.id)">
			</div>
		</div>
		<div class="row">
			<div class="footer-space"></div>
		</div>		
		<div id="myModal" class="modal">
			<span class="close" v-on:click="modalClose">&times;</span>			
			<!-- <img class="modal-content" id="img01"> -->			
			<span class="img-prev" v-on:click="modalSwift(-1)">
				<i class="fa fa-angle-left fa-1x" aria-hidden="true"></i>
			</span>
			<img v-if="image" :key="image.id" :src="image.src" alt="image.alt" class="modal-content">
			<span class="img-next" v-on:click="modalSwift(1)">
				<i class="fa fa-angle-right fa-1x" aria-hidden="true"></i>
			</span>

			<div id="caption"></div>
		</div>
	</div>
</template>


<script>

export default {
	data () {
		return {
			index: 0,
			image: null,
			images: [{
				id: 1,
				src: "/images/419.jpg",
				alt: "Natural Grove Green Trees Path" 	
			},
			{
				id: 2,
				src: "/images/garcon.png",
				alt: "Natural Grove Green Trees Path" 	
			},
			{
				id: 3,
				src: "/images/guru.jpg",
				alt: "Natural Grove Green Trees Path" 	
			},
			{
				id: 4,
				src: "/images/sun.png",
				alt: "Natural Grove Green Trees Path" 	
			},
			],
		}
	},
	methods : {
		imageModal: function (e) {
			// console.log(this.images.length);

			// Get the modal
			var modal = document.getElementById("myModal");

			// Get the image and insert it inside the modal - use its "alt" text as a caption
			// var img = document.getElementById("myImg").getAttribute('src');			
			// var modalImg = document.getElementById("img01");
			// var captionText = document.getElementById("caption");

			this.image = this.images[e-1];
			this.index = (e-1) % this.images.length;

			modal.style.display = "block";
			// modalImg.src = this.src;
			// captionText.innerHTML = this.alt;

		}, 
		modalClose: function(e) {
			var modal = document.getElementById("myModal");
			modal.style.display = "none";	
		}, 
		modalSwift: function(e) {			
			var idx = this.index;
			if (idx == this.images.length-1 && e==1) {
				e = (idx * -1);
			} else if (idx == 0 && e == -1) {
				e = this.images.length-1;
			} 
			this.image = this.images[idx+e];
			this.index = idx+e;			
		}
	}
}

</script>