<template>
  <div class="container pl-5">
    <div class="row">
      <ul class="list-unstyled components assignment-menu" >
        <li class="nav-item active">
          <router-link to="/tugas-ungraded">
            <a href="#" class="nav-link active">
              <i class="fas fa-list"></i>
              Belum Dinilai
            </a>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/tugas-graded">
            <a href="#" class="nav-link">
              <i class="fas fa-tasks"></i>
              Sudah Dinilai
            </a>
          </router-link>
        </li>
      </ul>     
    </div>
    <div class="row">
      <div class="assinmnets-table mt-4">
        <table class="col-md-12">
          <thead>
            <tr>
              <th>No.</th>
              <th>Judul</th>
              <th>Pelajaran</th>
              <th>Kelas</th>
              <th>Batas Pengumpulan</th>
              <th>Keterangan</th>
            </tr>                   
          </thead>
          <tbody>
            <tr class="pt-1 col-md-12" v-for="(asmts, index) in asmts" :key="asmts.id">              
              <td>{{ index+1 }}</td>
              <td>
                <router-link :to="{name: 'tugas-ungraded-detail', params: { id: asmts.id }}">{{ asmts.title }}</router-link>
              </td>
              <td>Matematika</td>
              <td>{{ asmts.class }}</td>
              <td>{{ asmts.duedate }} {{ asmts.duetime }} WIB</td>
              <td>Selesai</td>
            </tr>
          </tbody>          
        </table>
      </div>
    </div>
    <div class="row">     
      <router-link to="/tugas-create" class="float">
        <i class="fa fa-plus my-float"></i>
      </router-link>      
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      asmts: [],
      username: '',
    }
  },
  created() {
    this.username = sessionStorage.getItem('username');
    // let uri = 'http://localhost:8000/api/asmt';
    let uri = 'https://ceriakan.id/api/teacher/'+this.username+'/assignment';
    axios.get(uri).then(response => {
      this.asmts = response.data['data'];
    });
  },
  methods: {    
  }
}
</script>