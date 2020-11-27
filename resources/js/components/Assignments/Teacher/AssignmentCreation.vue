<template>
  <div class="container">
    <header class="amt-deatail-header">
      <router-link to="/tugas-ungraded">
        <span class="path">Tugas</span>
      </router-link>
      >
      <span class="path">Tugas Baru</span>
      <hr>
    </header>
    <content class="amt-detail-content col-md-12">      
      <div class="container">
        <div class="row ml-4">
          <form method="POST" enctype="multipart/form-data" @submit.prevent="createAssignment">
            <div class="form-group">
              <label for="inputAddress">Judul Tugas</label>
              <input type="text" class="form-control" id="inputJudul" placeholder="" v-model="form.title" required="">
            </div>
            <div class="form-group">
              <label for="inputAddress">Deskripsi Tugas</label>             
              <textarea class="form-control" v-model="form.description"> </textarea>
            </div>  
            <div class="form-group">
              <label for="inputAddress">Batas Pengumpulan Tugas</label>
              <div class='input-group date' id='datetimepicker1'>
                <datepicker class="datetime" v-model="form.duedate" v-on:selected="setDueDate" format="dd MMMM yyyy" :disabledDates="disabledDates"></datepicker>
                <i class="far fa-calendar-alt  fa-7x"></i>                
                <vue-timepicker format="HH:mm" class="datetime ml-2" v-on:change="changeTimeHandler" v-model="form.duetime"></vue-timepicker>
                <i class="far fa-clock fa-7x"></i>
              </div>
            </div>
            
            <!-- <div class="form-group mt-4">
              <label for="inputAddress">Kelas</label>
              <select class="custom-select" v-model="selected" v-on:change="classChange">                
                <option v-bind:value="{ name: 'Kelinci'}" value="2">Kelinci</option>
                <option v-bind:value="{ name: 'Merak'}" value="3">Merak</option>
              </select>
            </div> -->
            <div class="form-group mt-4">
              <label for="inputAddress">Lampiran</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="validatedCustomFile" v-on:change="onFileChange">
                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
              </div>
            </div>
            <!--<div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity">
              </div>
              <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                  <option selected>Choose...</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip">
              </div>
            </div> -->
            <div class="form-group">
              <!-- <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                  Check me out
                </label>
              </div> -->

            </div>
            <button type="submit" class="btn btn-primary">Tambahkan Tugas</button>
          </form>
        </div>        
      </div>      
    </content>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import VueTimepicker from 'vue2-timepicker/src/vue-timepicker.vue';

var state = {
  disabledDates: {
    to: new Date(2020, 11, 5),
  }
}

export default {  
  components: {
    Datepicker,
    VueTimepicker
  },
  data(){
    return {
      model: {
        date: ''
      },
      form:{},
      errors: [],
      title: null,
      description: '',
      duedate: '', 
      duetime: '', 
      duetime: '',  
      selected: '',
      class:'',
      products: [
      {name: 'Kelinci'},
      {name: 'Merak'},
      ],
      teacher: '', 
      file: null, 
      disabledDates: {
        to: new Date(Date.now() - 8640000)
      }
    } 
  },
  created() {
    this.teacher = sessionStorage.getItem('username');
    console.log(this.teacher);
  },
  methods: {
    setDueDate(val) {
      // console.log(val.getFullYear()+'-'+val.getMonth()+'-'+val.getDate());
      this.duedate = val.getFullYear()+':'+val.getMonth()+':'+val.getDate();
    },
    changeTimeHandler(eventData) {
      this.duetime = eventData.data.HH+":"+eventData.data.mm+":00";
      // console.log(eventData.data.HH+":"+eventData.data.mm+":00");
      // console.log(this.duedate+' '+this.duetime);

    },
    classChange(dataClass) {
      this.class = this.selected.name;
      // console.log(this.selected.name);
    },
    onFileChange(e){
      console.log(e.target.files[0]);
      this.file = e.target.files[0];      
    },
    createAssignment(){

      if (this.$data.form.title != null ) {
        let currentObj = this;
        const config = {
          headers: { 'content-type': 'multipart/form-data','X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, }
        }
        let formData = new FormData();
        formData.append('lampiran', this.file);
        formData.append('title', this.form.title);
        formData.append('description', this.form.description);
        formData.append('due_date', this.duedate+' '+this.duetime);        
        formData.append('id_teacher', this.teacher);        
        formData.append('isVisible', 1);

        axios.post('https://ceriakan.id/api/assignment/store', formData, config)
        .then(function (response) {
          currentObj.success = response.data.success;
          // this.$router.push({name: 'tugas-create'});          
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

      e.target.reset();
      e.preventDefault();
      // this.$router.push({name: 'tugas-ungraded'});      

      window.location.href = 'http://localhost:8000/tugas-ungraded';
    }
  }
}
</script>