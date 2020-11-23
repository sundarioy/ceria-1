<template>
  <div class="container">
    <header class="amt-deatail-header">
      <router-link to="/tugas-ungraded">
        <span class="path">Tugas Belum Dinilai</span>
      </router-link>
      >
      <span class="path">Penjumlahan Bilangan</span>
      <hr>
    </header>
    <content class="amt-detail-content col-md-12">      
      <div class="amt-detail-title">
        <h4>{{ asmts.title }}</h4>
        <i>Dibuat oleh {{ asmts.teacher }} pada 8 Januari 2020 pukul 08:00 WIB</i>      
      </div>
      <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail Tugas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pengumpulan</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Diskusi</a>
        </li> -->
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <t-asmtDetail-pane></t-asmtDetail-pane>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <t-asmtSubmission-pane></t-asmtSubmission-pane>
        </div>
        <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
          <t-asmtForum-pane></t-asmtForum-pane>
        </div>
      </div>

      
    </content>
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

</script>