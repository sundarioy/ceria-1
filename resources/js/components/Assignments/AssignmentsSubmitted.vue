<template>
  <div class="container pl-5">
    <div class="row">
      <ul class="list-unstyled components border-1-555 assignment-menu" >
        <li class="nav-item">
          <router-link to="/tugas-open">
            <a href="#" class="nav-link">
              <i class="fas fa-list"></i>
              Belum Dikumpul
            </a>
          </router-link>
        </li>
        <li class="nav-item active">
          <router-link to="/tugas-closed">
            <a href="#" class="nav-link active">
              <i class="fas fa-tasks"></i>
              Sudah Dikumpul
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
              <th class="">No.</th>
              <th class="">Judul</th>
              <!-- <th class="">Pelajaran</th> -->
              <th class="">Tanggal Pengumpulan</th>
              <th class="">Nilai</th>
            </tr>
          </thead>
          <tbody>
            <tr class="pt-1" v-for="(asmts, index) in asmts" :key="asmts.id" v-if="asmts.isSubmitted">
              <td class="">{{ index+1 }}</td>
              <td class="">
                <router-link :to="{name: 'tugas-detail', params: { id: asmts.id }}">
                  {{ asmts.title}}
                </router-link>
              </td>
              <!-- <td class="">Matematika</td> -->
              <td class="">{{ asmts.due_date | moment("DD MMMM YYYY") }} pukul {{ asmts.due_date | moment("HH : mm") }} WIB</td>  
              <td></td>
            </tr>            
          </tbody>          
        </table>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      asmts: [],
      student: [],
      username:'',
      id_kelas:'',      
    }
  },
  created() {

    this.username = sessionStorage.getItem('username');

    let uri2 = 'https://ceriakan.id/api/child/'+this.username;
    axios.get(uri2).then(response => {
      this.student = response.data['data'];  
    });


    let uri = 'https://ceriakan.id/api/nis/'+this.username+'/kelas/'+this.student['id_kelas']+'/assignment';
    axios.get(uri).then(response => {
      this.asmts = response.data['data'];  
    });
  },
}
</script>
