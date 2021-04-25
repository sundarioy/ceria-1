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
              <th>Kelas</th>
              <th>Batas Pengumpulan</th>
              <th>Keterangan</th>
            </tr>                   
          </thead>
          <tbody>
            <tr class="pt-1 col-md-12" v-for="(asmts, index) in ungradedAssignments" :key="asmts.id"> <!-- v-if="asmts.isGrade === false" -->
              <td>{{ index+1 }}</td>
              <td>
                <router-link :to="{name: 'tugas-ungraded-detail', params: { id: asmts.id }}">{{ asmts.title }}</router-link>
              </td>              
              <td>{{ asmts.class }}</td>
              <td>{{ asmts.due_date | moment("DD MMMM YYYY") }} {{ asmts.due_date | moment("HH:mm") }} </td>
              <td v-if="asmts.isDue">Selesai</td>
              <td v-else>Pengumpulan</td>
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
      username: '',
      asmts: [],
      asmtsUngraded: [],
      
    }
  },
  computed: {
    sortedAssignments: function() {      
      return this.asmts.sort((a, b) => new Date(a.due_date) - new Date(b.due_date));
    },
    ungradedAssignments: function () {
      this.asmts.sort((a, b) => new Date(a.due_date) - new Date(b.due_date));
      return this.asmts.filter(c => c.isGrade === false);
    },
  },
  created() {
    this.username = sessionStorage.getItem('username');    
    let uri = "https://ceriakan.id/api/teacher/"+this.username+"/listassignment";
    axios.get(uri).then(response => {
      this.asmts = response.data['data'];
    });
  },
  methods: {    
  }
}
</script>