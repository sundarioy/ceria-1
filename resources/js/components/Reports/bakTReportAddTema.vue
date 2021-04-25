<!-- TReportAddTema -->

<template>
  <div class="container" id="scrolling-element">
    <div class="row">
      <ul class="list-unstyled components class-menu">
        <div class="row ml-3">
          <li class="nav-item active">          
            <a href="#" class="nav-link" v-on:click="addData('1')">
              <i class="fas fa-plus"></i> Tambah Tema
            </a>
          </li>
          <li class="nav-item active">          
            <a href="#" class="nav-link" v-on:click="addData('0')">
              <i class="fas fa-plus"></i> Tambah Subtema
            </a>
          </li>       
        </div>
      </ul>     
    </div>
    <div class="row">
      <div class="container">
        <div class="report-table mt-2">
          <table class="col-md-10" id="dataTable">
            <thead>
              <tr>
                <th class="col-number">No</th>                
                <th class="report-table-col-shrink">Tema</th>
                <th>Subtema</th>
              </tr>
            </thead>
            <tbody>
              <tr class="tr-input-data" id="inputDataTema" hidden>
                <td class="report-table-indikator"><p class="text-center mt-0 mb-4"></p></td>
                <td>                  
                  <div class="col mt-0 mb-5">
                    <input type="text" name="tema" class="form-control" v-model="nama_tema">
                  </div>
                </td>
                <td class="pb-3">
                  <div class="col mt-3">
                    <input type="text" class="form-control" placeholder="Subtema" v-model="selected_subtema">
                  </div>
                  <div class="col">
                    <button type="button" class="btn btn-secondary mt-2 ml-2 float-right" v-on:click="cancelInput">Batal</button>
                    <button type="button" class="btn btn-primary mt-2 ml-2 float-right" v-on:click="submitDataTema">Tambah</button>
                  </div>                  
                </td>
              </tr>
              <tr class="tr-input-data" id="inputDataSubtema" hidden>
                <td class="report-table-indikator"><p class="text-center mt-0 mb-4"></p></td>
                <td>
                  <div class="col mt-0 mb-5">
                    <select class="custom-select" id="inputTema" @change="temaChange">
                      <option v-for="item in list_tema" :value="item">{{ item }}</option>
                    </select>
                  </div>
                </td>
                <td class="pb-3">
                  <div class="col mt-3">
                    <input type="text" class="form-control" placeholder="Subtema" v-model="selected_subtema">
                  </div>
                  <div class="col">
                    <button type="button" class="btn btn-secondary mt-2 ml-2 float-right" v-on:click="cancelInput">Batal</button>
                    <button type="button" class="btn btn-primary mt-2 ml-2 float-right" v-on:click="submitDataSubtema">Tambah</button>
                  </div>                  
                  
                </td>
              </tr>               
              <tr class="pt-1" v-for="(item, index) in items" :value="item">
                <td>{{ index+1 }}</td>
                <td class="report-table-indikator">
                  <p>{{ item.tema }}</p>
                </td>
                <td class="report-table-indikator">
                  <p>{{ item.subtema }}</p>
                </td>                
              </tr>             
            </tbody>
          </table>          
        </div>           
      </div>
    </div>    
    <!-- <div :is="currentComponent"></div> -->
    <!-- <tema-selection>
      <div class="col">
        <select class="custom-select" id="inputTema" @change="subtemaChange">
          <option v-for="item in items" :value="item">{{ item[0] }}</option>
        </select>
      </div>
    </tema-selection> -->
    <div class="row">
      <div class="footer-space"></div>
    </div>        
  </div>
</template>
<script>

import TemaList from "./TReportTemaList.vue";


export default {

  data () {
    return {      
      nama_tema:null,
      selected_tema:null,
      selected_subtema:null,
      list_tema: ['Diri Sendiri','Negaraku'],
      list_subtema:[null,'Identitas', 'Bagian Tubuh'],
      isTemaSelected: null,
      inputColumn: '',
      items: [
      {'tema':'Diri Sendiri','subtema':'Identitas'},
      {'tema':'Diri Sendiri','subtema':'Bagian Tubuh'},
      {'tema':'Negaraku','subtema':'Negaraku'},
      {'tema':'Negaraku','subtema':'Budaya'},
      {'tema':'Negaraku','subtema':'Lingkungan'},
      {'tema':'Diri Sendiri','subtema':'Identitas'},
      {'tema':'Diri Sendiri','subtema':'Bagian Tubuh'},
      {'tema':'Negaraku','subtema':'Negaraku'},
      {'tema':'Negaraku','subtema':'Budaya'},
      {'tema':'Negaraku','subtema':'Lingkungan'}
      ],
      currentComponent: null,
      componentsArray: ['comp-tema', 'TemaList'],
      temp: 'Sundari'
    }
  },  
  created() {

    this.username = sessionStorage.getItem('username');    

    let uri = "https://ceriakan.id/api/child/"+this.username;
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

  }, methods: {
    addData(val) {            

      if (val==1) {
        // this.inputColumn = '<div class="col"><input type="text" name="tema" class="form-control" v-model="nama_tema"></div>';
        // this.currentComponent = 'comp-tema';
        document.getElementById("inputDataTema").toggleAttribute("hidden");
        document.getElementById("inputDataSubtema").setAttribute("hidden","hidden");
        // document.getElementById("btnInputData").toggleAttribute("hidden");
      } else {
        // this.inputColumn = '<div class="col"><select class="custom-select" id="inputTema" @change="subtemaChange"><option v-for="item in items" :value="item">{ item[0] }</option></select></div>';
        // this.currentComponent = 'TemaList';
        document.getElementById("inputDataSubtema").toggleAttribute("hidden");
        document.getElementById("inputDataTema").setAttribute("hidden", "hidden");
        // document.getElementById("btnInputData").toggleAttribute("hidden");
      }     
    }, temaChange: function(e) {
      this.selected_tema = e.target.value;
    },
    submitDataTema: function(e) {     
      this.list_tema.push(this.nama_tema);
      this.items.unshift({tema: this.nama_tema, subtema: this.selected_subtema });      
    },
    submitDataSubtema: function(e) {      
      this.items.unshift({tema: this.selected_tema, subtema: this.selected_subtema });
    },
    cancelInput: function(e) {
      document.getElementById("inputDataTema").setAttribute("hidden","hidden");
      document.getElementById("inputDataSubtema").setAttribute("hidden","hidden");
    },
  }, components: {
    'comp-tema': {
      template: '<div class="col"><input type="text" name="tema" class="form-control" v-model="nama_tema"></div>'
    },
    TemaList 
  },
}

</script>

