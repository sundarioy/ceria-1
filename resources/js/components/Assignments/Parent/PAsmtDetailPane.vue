<template>
	<div class="container">
		<div class="row">
			<div class="amt-main col-md-8">
				<h4>{{ asmts.title }}</h4>
				<i>Tugas ditambahkan pada {{ asmts.date_created | moment("DD MMMM YYYY") }} pukul {{ asmts.date_created | moment("HH:mm") }} WIB</i>                  
				<div class="amt-main-desc mt-4">
					<p>{{ asmts.description }}</p>          
				</div>
				<div class="amt-main-file" v-if="asmts.teacher_file.length">
          <a v-bind:href="'https://ceriakan.id/'+ asmts.teacher_file[0].location +'/'+ asmts.teacher_file[0].title">
						<i class="fas fa-browser"></i>{{asmts.teacher_file[0].title}}
					</a>
				</div>
			</div>
			<!-- <div v-if="subms === null" class="amt-submission col-md-3 pl-4"> -->
        <div class="amt-submission col-md-4 pl-4" v-if="!asmts.isSumitted">
          <div class="label">Batas pengumpulan</div>
          <div class="value">{{ asmts.due_date | moment("DD MMMM YYYY") }} pukul {{ asmts.due_date | moment("HH:mm") }} WIB</div>
          <div class="label">Waktu Tersisa</div>
          <div class="value time-left-info">{{ asmts.due_date | moment("from") }} </div>
          <form @submit="formSubmit" enctype="multipart/form-data">
           <div class="custom-file">
            <input type="file" class="custom-file-input" required v-on:change="onFileChange">
            <label class="custom-file-label" for="validatedCustomFile" id="CustomFile">Pilih file...</label>
            <div class="invalid-feedback">Example invalid custom file feedback</div>
          </div>          
          <input type="submit" name="" value="Kumpulkan">
        </form>        
      </div>  
      <div class="amt-submission col-md-4 pl-4" v-else>
        <div class="label">Dikumpulkan pada</div>
        <div class="value">{{ asmts.date_updated | moment("DD MMMM YYYY") }} pukul {{ asmts.date_updated | moment("HH:mm") }} WIB</div>
        <a href="" class="mt-3">
          <i class="fas fa-browser"></i>  {{ asmts.sudent_file }}
        </a>  
        <div class="amt-grade mt-4">
          <!-- <p>{{asmts.}}</p> -->
          <div class="grading"></div>
        </div>
      </div>  
    </div> 
  </div>

</template>
<script>

import bsCustomFileInput from 'bs-custom-file-input'

$(document).ready(function () {
  bsCustomFileInput.init()
});


export default {

  data(){
    return {
      asmts:[],
      subms:[],
      file: null,
      description: '',
      student_id: '',
      asmt_id: '',
      username:'',
      student:[],
      deskripsi:'',
    }
  },
  created() {
    this.username = sessionStorage.getItem('username');
    this.deskripsi = this.username;

    let uri2 = 'https://ceriakan.id/api/child/'+this.username;
    axios.get(uri2).then((response) => {
      this.student = response.data;        
    }); 

    // let uri = "http://localhost:8000/api/asmt/asmtShow/"+this.$route.params.id;
    let uri = "https://ceriakan.id/api/nis/"+this.username+"/kelas/"+this.$route.params.class+"/assignment/"+this.$route.params.id;
    axios.get(uri).then((response) => {
      this.asmts = response.data['data'];  
    });

    // let uri2 = "http://localhost:8000/api/asmt/asmtStudentSubms/"+this.$route.params.id;
    // axios.get(uri2).then((response) => {
    //   this.subms = response.data;        
    // });

  },  
  methods: {
    onFileChange(e){
      console.log(e.target.files[0]);
      this.file = e.target.files[0];
      this.asmt_id = this.$route.params.id;
      this.student_id = 1;                  
      $(this).next('.custom-file-label').html(e.target.files[0].name);
    },
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;
      const config = {
        headers: { 'content-type': 'multipart/form-data','X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, }
      }
      let formData = new FormData();
      formData.append('file', this.file);
      formData.append('nis', this.username);
      formData.append('id_assignment', this.$route.params.id);      
      formData.append('id_kelas', this.$route.params.class);      
      formData.append('title', this.asmts.title);
      formData.append('description', this.deskripsi);
      formData.append('user_update', this.username);

      this.$swal.fire({
        title: 'Success',
        text: "Tugas berhasil dikumpulkan!",
        icon: 'success',
        timer: 3000
      })      
      axios.post('https://ceriakan.id/api/submission/store', formData, config)
      // axios.post('http://localhost:8000/api/asmt/asmtSubmit', formData, config)
      .then(function (response) {
        currentObj.success = response.data.success;
      })
      .catch(function (error) {
        currentObj.output = error;
      });      

      return true;
    }, 

  }
}
</script>
