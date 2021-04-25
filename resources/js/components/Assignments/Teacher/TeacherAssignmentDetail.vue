<template>
  <div class="container">
    <header class="amt-deatail-header">
      <router-link to="/tugas-ungraded">
        <span class="path">Tugas Belum Dinilai</span>
      </router-link>
      >
      <span class="path">{{asmts.title}}</span>
      <hr>
    </header>
    <content class="amt-detail-content col-md-12">            
      <ul class="nav nav-tabs " id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail Tugas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pengumpulan</a>
        </li>
        <li class="nav-item">
          <!-- <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Diskusi</a> -->
        </li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <t-asmtDetail-pane></t-asmtDetail-pane>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <t-asmtSubmission-pane></t-asmtSubmission-pane>
        </div>
        <!-- <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
          <t-asmtForum-pane></t-asmtForum-pane>
        </div> -->
      </div>
      
    </content>
  </div>
</template>

<script>
export default {
  data(){
    return {
      asmts:[],
      usernme: '',
    }
  }, 
  created() {
    this.username = sessionStorage.getItem('username');    
    let uri = "https://ceriakan.id/api/teacher/"+this.username+"/assignment/"+this.$route.params.id;    
    axios.get(uri).then((response) => {
      this.asmts = response.data['data'];        
    });
  },  
}
</script>