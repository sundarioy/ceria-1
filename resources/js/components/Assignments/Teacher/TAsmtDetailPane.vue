<template>      
  <div class="container">
    <div class="row mt-3">
      <ul class="list-unstyled assignment-menu">
        <li class="nav-item">
          <router-link to="">
            <a href="#" class="nav-link">
              <i class="fas fa-pencil"></i>
              Ubah
            </a>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="">
            <a href="" class="nav-link" v-on:click="deleteAsmt">
              <i class="fas fa-trash"></i>
              Hapus
            </a>
          </router-link>
        </li>
      </ul>

    </div>
    <div class="row mt-2">
      <div class="amt-main col-md-12 mt-4">
        <div class="amt-detail-title">
          <h4>{{ asmts.title }}</h4>
          <i>Tugas ditambahkan pada {{ asmts.date_created | moment("DD MMMM YYYY") }} pukul {{ asmts.date_created | moment("HH:mm") }} WIB</i>                
        </div>
        <div class="amt-main-desc pt-3">
          Batas pengumpulan : {{ asmts.due_date | moment("DD MMMM YYYY") }} pukul {{ asmts.due_date | moment("HH:mm") }} WIB
        </div>
        <!-- <div class="amt-main-desc pt-3">
          Kelas : {{ asmts.class }}
        </div> -->
        <div class="amt-main-desc pt-3">
          {{ asmts.description }}
        </div>
        <div class="amt-main-file mt-4" v-if="asmts.teacher_file[0] != null">
          <a v-bind:href="'https://ceriakan.id/storage/app/'+ asmts.teacher_file[0].location">            
            <i class="fas fa-browser"></i>{{asmts.teacher_file[0].title}}
          </a>
        </div>
      </div>          
    </div>        
  </div>      
</template>

<script>

export default {
  data(){
    return {
      asmts:[],
      username:'',
    }
  }, 
  created() {
    this.username = sessionStorage.getItem('username');    
    let uri = "https://ceriakan.id/api/teacher/"+this.username+"/assignment/"+this.$route.params.id;    
    axios.get(uri).then((response) => {
      this.asmts = response.data['data'];        
    });
  },
  methods : {
    deleteAsmt()
    {
      this.$swal.fire({
        title: 'Apakah anda yakin?',
        text: "Tugas tidak akan ditampilkan kembali setelah dihapus.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.value) {
          this.$swal.fire({
            title: 'Success!',
            text: 'Tugas berhasil dihapus',
            icon: 'success',
            timer: 1000
          });
          let uri = 'https://ceriakan.id./assignment/'+this.$route.params.id+'/delete';          
          this.axios.delete(uri).then(response => {            
          });
          console.log("Deleted assignment with id ..." +id);
        }
      })
    }
  }, 
}
</script>
