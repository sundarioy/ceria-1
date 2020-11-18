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
            <a href="#" class="nav-link">
              <i class="fas fa-trash"></i>
              Hapus
            </a>
          </router-link>
        </li>
      </ul>

    </div>
    <div class="row mt-2">
      <div class="amt-main col-md-12">
        <h5>{{ asmts.title }}</h5>       
        <div class="amt-main-desc pt-3">
          Batas pengumpulan : {{ asmts.duedate }} pukul {{ asmts.duetime }} WIB
        </div>
        <div class="amt-main-desc pt-3">
          Kelas : {{ asmts.class }}
        </div>
        <div class="amt-main-desc pt-3">
          {{ asmts.description }}
        </div>
        <div class="amt-main-file mt-4">
          <a href="">
            <i class="fas fa-browser"></i>{{ asmts.file }}
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
    }
  }, 
  created() {

    let uri = "http://localhost:8000/api/asmt/asmtShow/"+this.$route.params.id;
    axios.get(uri).then((response) => {
      this.asmts = response.data;        
    });
  },  
}
</script>
