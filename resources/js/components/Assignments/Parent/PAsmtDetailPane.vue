<template>
	<div class="container">
		<div class="row">
			<div class="amt-main col-md-9">
				<h4>{{ asmts.title }}</h4>
				<i>Dipost oleh {{ asmts.teacher }} pada 8 Januari 2020 pukul 08:00 WIB</i>                  
				<div class="amt-main-desc mt-4">
					<p>{{ asmts.description }}</p>
				</div>
				<div class="amt-main-file">
					<a href="">
						<i class="fas fa-browser"></i>Panduan.pdf
					</a>
				</div>
			</div>
			<!-- <div v-if="subms === null" class="amt-submission col-md-3 pl-4"> -->
        <div class="amt-submission col-md-3 pl-4">
				<div class="label">Batas pengumpulan</div>
				<div class="value">{{ asmts.duedate }} pukul {{ asmts.duetime }} WIB</div>
				<div class="label">Waktu Tersisa</div>
				<div class="value time-left-info">{{ asmts.duedate | moment("from") }} </div>
				<form @submit="formSubmit" enctype="multipart/form-data">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="validatedCustomFile" required v-on:change="onFileChange">
						<label class="custom-file-label" for="validatedCustomFile" id="CustomFile">Pilih file...</label>
						<div class="invalid-feedback">Example invalid custom file feedback</div>
					</div>          
          <input type="submit" name="" value="Kumpulkan">
        </form>        
      </div>  
      <!-- <div class="amt-submission col-md-3 pl-4" v-else>
        <div class="label">Dikumpulkan pada</div>
        <div class="value">{{ subms[0].updated_at | moment("DD MMMM YYYY") }}</div>
        <a href="" class="mt-3">
          <i class="fas fa-browser"></i>  {{ subms[0].file }}
        </a>  
        <div class="amt-grade mt-4">
          <p>Nilai</p>
          <div class="grading"></div>
        </div>
      </div>   -->
    </div> 
  </div>

</template>
<script>
import bsCustomFileInput from 'bs-custom-file-input';

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
    }
  },
  created() {

    // let uri = "http://localhost:8000/api/asmt/asmtShow/"+this.$route.params.id;
    let uri = "https://ceriakan.id/api/nis/10001/kelas/1/assignment/1";
    axios.get(uri).then((response) => {
      this.asmts = response.data;        
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
    },
    formSubmit(e) {
      e.preventDefault();
      let currentObj = this;
      const config = {
        headers: { 'content-type': 'multipart/form-data','X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, }
      }
      let formData = new FormData();
      formData.append('file', this.file);
      formData.append('asmt_id', this.asmt_id);
      formData.append('student_id', this.student_id);

      this.$swal.fire({
        title: 'Success',
        text: "Tugas berhasil dikumpulkan!",
        icon: 'success',
        timer: 3000
      })
      axios.post('http://localhost:8000/api/asmt/asmtSubmit', formData, config)
      .then(function (response) {
        currentObj.success = response.data.success;
      })
      .catch(function (error) {
        currentObj.output = error;
      });      

      return true;
    }    
  }
}
</script>
