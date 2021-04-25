<template>
  <div class="container">
    <div class="row ml-1">
      <header class="amt-deatail-header">
        <router-link to="/daftar-rapor">
          <span class="path">Tambah Nilai </span>
        </router-link>
        >
        <router-link to="/daftar-rapor">
          <span class="path text-capitalize">{{dataClass.kelas}}</span>
        </router-link>
        >
        <router-link :to="{name: 'daftar-rapor-siswa', params: { id: dataStudent.nomor_induk }}">
          <span class="path text-capitalize">{{dataStudent.nama}}</span>
        </router-link>
        >
        <span class="path text-capitalize">1 Maret 2021</span>      
        <hr>
      </header>
    </div>
    <div class="row">
      <div class="class-header ml-3">
        <div class="class-box-large">                   
        </div>          
        <div class="class-data ml-4 mt-5">
          <div class="class-name-large mt-3">{{dataStudent.nama}}</div>  
          <table class="mt-4">
            <tr>
              <td>NIS</td>
              <td>&emsp;: {{dataStudent.nomor_induk}}</td>
            </tr>
            <tr>
              <td>Kelas</td>
              <td>&emsp;: {{dataClass.kelas}}</td>
            </tr>
            <tr>
              <td>Orangtua/Wali</td>
              <td>&emsp;: {{dataParent.nama}}</td>
            </tr>
          </table>          
        </div>
      </div>      
    </div>
    <div class="row">
      <div class="container ">
        <div class="report-table mt-3">
          <table>
            <thead>
              <tr>
                <th>No</th>
                <!-- <th class="report-table-col-shrink">Semester/<br />Minggu</th> -->
                <th class="report-table-col-shrink">Tema/<br />Subtema</th>
                <th>Indikator</th>
                <th>Predikat</th>
              </tr>
            </thead>
            <tbody>
              <tr class="pt-1">
                <td>1</td>                
                <!-- <td>I/1</td>                 -->
                <td>DIRI SENDIRI / IDENTITAS</td>
                <td class="report-table-indikator">
                  <p>Anak mampu mengucapkan kalimat Syahadat</p>
                </td>
                <td>MB</td>
              </tr>      
              <tr class="pt-1">
                <td>2</td>                
                <!-- <td>I/1</td> -->                
                <td>DIRI SENDIRI / IDENTITAS</td>
                <td class="report-table-indikator">
                  <p>Anak menempel huruf   hijaiyyah “a na dengan lem</p>
                </td>
                <td>MB</td>
              </tr>      
              <tr class="pt-1">
                <td>3</td>                
                <!-- <td>I/1</td> -->                
                <td>DIRI SENDIRI / IDENTITAS</td>
                <td class="report-table-indikator">
                  <p>Anak menggambar muslim/muslimah  dengan crayon</p>
                </td>
                <td>MB</td>
              </tr>      
              <tr class="pt-1">
                <td>4</td>                
                <!-- <td>I/1</td> -->                
                <td>DIRI SENDIRI / IDENTITAS</td>
                <td class="report-table-indikator">
                  <p>Anak menyebutkan perbedaan  bagian aurat muslim dan muslim</p>
                </td>
                <td>MB</td>
              </tr>      
              <tr class="pt-1">
                <td>5</td>                
                <!-- <td>I/1</td> -->                
                <td>DIRI SENDIRI / IDENTITAS</td>
                <td class="report-table-indikator">
                  <p>Anak menempel dan menyusun potongan bagian  baju muslim/muslimah puzzle yang sudah disediakan </p>
                </td>
                <td>MB</td>
              </tr>      
              <tr class="pt-1">
                <td>6</td>                
                <!-- <td>I/1</td> -->                
                <td>DIRI SENDIRI / IDENTITAS</td>
                <td class="report-table-indikator">
                  <p>Anak menunggu giliran dalam kegiatan</p>
                </td>
                <td>MB</td>
              </tr>      
            </tbody>
          </table>    
        </div>           
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
      dataClass:[],     
      dataStudent:[],     
      dataParent:[],  
      parentId:'',
      classId:'',
    }
  }, 
  created() {

    this.username = sessionStorage.getItem('username');    

    let uri = "https://ceriakan.id/api/child/"+this.$route.params.id;
    axios.get(uri).then((response) => {
      this.dataStudent = response.data['data'];
      this.parentId = response.data['data'].nik_parent;
      this.classId = response.data['data'].id_kelas;

      let uri2 = "https://ceriakan.id/api/parent/"+this.parentId;
      axios.get(uri2).then((response) => {
        this.dataParent = response.data['data'];      
      });

      let uri3 = "https://ceriakan.id/api/kelas/"+this.classId;
      axios.get(uri3).then((response) => {
        this.dataClass = response.data['data'];     
      });

    });

  },  
}

</script>