<template>
  <div class="container">   
    <div class="row">
      <div class="class-header">
        <div class="class-box-large">                   
        </div>          
        <div class="class-data ml-4 mt-5">
          <div class="class-name-large mt-3">{{dataClass.kelas}}</div>  
          <table class="mt-4">
            <tr>
              <td>Jumlah siswa</td>
              <td>&emsp;: {{ students.length }}</td>
            </tr>
            <tr>
              <td>Tahun Akademik</td>
              <td>&emsp;: {{ dataClass.thn_akademik }}</td>
            </tr>
            <tr>
              <td>Wali kelas</td>
              <td>&emsp;: {{dataTeacher.nama}} ({{teacherId}})</td>
            </tr>
          </table>          
        </div>
      </div>      
    </div>
    <div class="row">
      <div class="container ">
        <div class="asmt-submission-table mt-4">
          <table class="col-md-8">
            <thead>
              <tr>
                <th class="col-number">No</th>
                <th>Nama</th>
                <th>NIS</th>                
              </tr>
            </thead>
            <tbody>
              <tr class="pt-1" v-for="(students, index) in students" :key="students.id">
                <td>{{ index+1 }}</td>
                <td>
                  <div class="row ml-2">
                    <div class="table-student-thumbnail border-1-555"></div>
                    <span class="mt-2 ml-2">{{ students.nama }}</span>
                  </div>
                </td>
                <td>{{ students.nomor_induk }}</td>                
              </tr>         
            </tbody>
          </table>    
        </div>    
        <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form method="POST" enctype="multipart/form-data" @submit.prevent="setGrade">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Penilaian {{ namaStudent }} - {{ idStudent }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">              
                  <div class="form-group">
                    <label for="inputAddress">Nilai</label>
                    <select class="custom-select" v-model="selected" v-on:change="gradeChange">
                      <option v-bind:value="{ name: 'BSH'}" value="BSH">BSH</option>
                      <option v-bind:value="{ name: 'MB'}" value="MB">MB</option>
                      <option v-bind:value="{ name: 'BB'}" value="BB">BB</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputAddress">Komentar Guru</label>             
                    <textarea class="form-control" v-model="description"> </textarea>
                  </div>  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Input Nilai</button>
                </div>
              </form>
            </div>
          </div>
        </div> -->
      </div>
    </div>
    <div class="row">
      <div class="footer-space"></div>
    </div>
  </div>  
</template>

<script>

export default {
  data () {
    return {
      students:[],
      dataClass:[],
      count:0,
      dataTeacher:[],
      teacherId : '',
    }
  }, 
  created() {

    this.username = sessionStorage.getItem('username');    

    // let uri = "https://ceriakan.id/api/submission/1/teacher/"+this.username+"/collected";
    let uri = "https://ceriakan.id/api/kelas/"+this.$route.params.id;
    axios.get(uri).then((response) => {
      this.students = response.data['students'];        
    });

    let uri2 = "https://ceriakan.id/api/kelas/"+this.$route.params.id;
    axios.get(uri2).then((response) => {
      this.dataClass = response.data['data'];
      this.teacherId = response.data['data'].nomor_pegawai;      
      console.log(this.teacherId);

      let uri3 = "https://ceriakan.id/api/teacher/"+response.data['data'].nomor_pegawai;
      axios.get(uri3).then((response) => {
        this.dataTeacher = response.data['data'];
      });      


    });      
  },  
}

</script>
