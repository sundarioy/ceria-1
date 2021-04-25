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
        <div class="">
          <div class="row col-md-12">
            <input class="input form-control" type="text" v-model="search" placeholder="Cari..."
            @input="resetPagination()" style="width: 250px;">  
            <div class="control float-right">
              <div class="select">
                <select v-model="length" @change="resetPagination()" class="form-control ml-2">
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="asmt-submission-table mt-2">
          <table class="col-md-10" id="dataTable">
            <thead>
              <tr>
                <th class="col-number">No</th>                
                <th v-for="column in columns" :key="column.name" @click="sortBy(column.name)" :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                  style="cursor:pointer;">                    
                  {{column.label}}
                </th>
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
                    <button type="button" class="btn btn-secondary mt-2 ml-2 float-right" v-on:click="cancelInput">Tutup</button>
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
                    <button type="button" class="btn btn-secondary mt-2 ml-2 float-right" v-on:click="cancelInput">Tutup</button>
                    <button type="button" class="btn btn-primary mt-2 ml-2 float-right" v-on:click="submitDataSubtema">Tambah</button>
                  </div>                  
                  
                </td>
              </tr>               
              <tr v-for="(item, index) in paginateditems" :key="item.id">
                <td>{{ index+pagination.from }}</td>
                <td>{{ item.tema }}</td>
                <td>{{ item.subtema }}</td>                
              </tr>
            </tbody>
          </table>          
        </div>  
        <div class="mt-3 col-md-10">
          <nav class="pagination" v-if="!tableShow.showdata">
            <span class="page-stats mr-2">{{pagination.from}} - {{pagination.to}} dari {{pagination.total}}</span>
            <div class="mr-2 text-white">
              <a v-if="pagination.prevPageUrl" class="btn btn-sm btn-secondary pagination-previous" @click="--pagination.currentPage"> 
                <i class="fa fa-angle-left font-weight-bold" aria-hidden="true"></i> Prev 
              </a>
              <a class="btn btn-sm btn-secondary pagination-previous text-white" v-else disabled> 
                <i class="fa fa-angle-left font-weight-bold" aria-hidden="true"></i> Prev 
              </a>
            </div>
            <div class="text-white">
              <a v-if="pagination.nextPageUrl" class="btn btn-sm pagination-next" @click="++pagination.currentPage"> 
                Next <i class="fa fa-angle-right font-weight-bold" aria-hidden="true"></i>
              </a>
              <a class="btn btn-sm btn-secondary pagination-next" v-else disabled> 
                Next <i class="fa fa-angle-right font-weight-bold" aria-hidden="true"></i>
              </a>
            </div>            
          </nav>
          <nav class="pagination" v-else>
            <span class="page-stats mr-2">
              {{pagination.from}} - {{pagination.to}} dari {{filteredItems.length}}
              <span v-if="`filteredItems.length < pagination.total`"></span>
            </span>
            <div class="mr-2 text-white">
              <a v-if="pagination.prevPage" class="btn btn-sm btn-secondary pagination-previous" @click="--pagination.currentPage"> 
                <i class="fa fa-angle-left font-weight-bold" aria-hidden="true"></i> Prev 
              </a>
              <a class="btn btn-sm pagination-previous btn-secondary" v-else disabled> 
                <i class="fa fa-angle-left font-weight-bold" aria-hidden="true"></i> Prev 
              </a>
            </div>
            <div class="text-white">
              <a v-if="pagination.nextPage" class="btn btn-sm btn-secondary pagination-next" @click="++pagination.currentPage"> 
                Next <i class="fa fa-angle-right font-weight-bold" aria-hidden="true"></i>
              </a>
              <a class="btn btn-sm btn-secondary pagination-next"  v-else disabled> 
                Next <i class="fa fa-angle-right font-weight-bold" aria-hidden="true"></i>
              </a>
            </div>
          </nav>
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
   this.getitems();
   Fire.$on('reloaditems', () => {
    this.getitems();
  })
 },
 data() {
  let sortOrders = {};
  let columns = [
  {label: 'Tema', name: 'tema' },
  {label: 'Subtema', name: 'subtema'},
  ];
  columns.forEach((column) => {
    sortOrders[column.name] = -1;
  });
  return {
    nama_tema:null,
    selected_tema:null,
    selected_subtema:null,
    list_tema: ['Diri Sendiri','Negaraku'],
    list_subtema:[null,'Identitas', 'Bagian Tubuh'],
    isTemaSelected: null,
    username: '',
    items: [
    {'tema':'Diri Sendiri','subtema':'Identitas'},
    {'tema':'Diri Sendiri','subtema':'Bagian Tubuh'},
    {'tema':'Negaraku','subtema':'Negaraku'},
    {'tema':'Negaraku','subtema':'Budaya'},
    {'tema':'Negaraku','subtema':'Lingkungan'},
    {'tema':'Diri Sendiri','subtema':'Identitas'},
    {'tema':'Diri Sendiri','subtema':'Bagian Tubuh'},      
    {'tema':'Negaraku','subtema':'Budaya'},
    {'tema':'Negaraku','subtema':'Indonesia'}
    ],
    columns: columns,
    sortKey: 'tema',
    sortOrders: sortOrders,
    length: 10,
    search: '',
    tableShow: {
      showdata: true,
    },
    pagination: {
      currentPage: 1,
      total: '',
      nextPage: '',
      prevPage: '',
      from: '',
      to: ''
    },
  }
},
methods: {
  deleteUser(id) {
    axios.delete(`/items/${id}/delete`).then(() => {
      Fire.$emit('reloaditems')
      swal(
        'Success!',
        'User deleted',
        'success'
        )
    }).catch(() => {
      swal('Failed', 'There was something wrong', 'warning');
    });
  },
  getitems() {
      // let uri = "https://ceriakan.id/api/child";      
      // axios.get(uri, {params: this.tableShow})
      // .then(response => {
      //   console.log('The data: ', response.data)
      //   this.items = response.data['data'];
      //   this.pagination.total = this.items.length;
      // })
      // .catch(errors => {
      //   console.log(errors);
      // });
      this.items;
    },
    paginate(array, length, pageNumber) {
      this.pagination.from = array.length ? ((pageNumber - 1) * length) + 1 : ' ';
      this.pagination.to = pageNumber * length > array.length ? array.length : pageNumber * length;
      this.pagination.prevPage = pageNumber > 1 ? pageNumber : '';
      this.pagination.nextPage = array.length > this.pagination.to ? pageNumber + 1 : '';
      return array.slice((pageNumber - 1) * length, pageNumber * length);
    },
    resetPagination() {
      this.pagination.currentPage = 1;
      this.pagination.prevPage = '';
      this.pagination.nextPage = '';
    },
    sortBy(key) {
      this.resetPagination();
      this.sortKey = key;
      this.sortOrders[key] = this.sortOrders[key] * -1;
    },
    getIndex(array, key, value) {
      return array.findIndex(i => i[key] == value)
    },
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
  },
  computed: {
    filteredItems() {
      let items = this.items;
      if (this.search) {
        items = items.filter((row) => {
          return Object.keys(row).some((key) => {
            return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
          })
        });
      }
      let sortKey = this.sortKey;
      let order = this.sortOrders[sortKey] || 1;
      if (sortKey) {
        items = items.slice().sort((a, b) => {
          let index = this.getIndex(this.columns, 'name', sortKey);
          a = String(a[sortKey]).toLowerCase();
          b = String(b[sortKey]).toLowerCase();
          if (this.columns[index].type && this.columns[index].type === 'date') {
            return (a === b ? 0 : new Date(a).getTime() > new Date(b).getTime() ? 1 : -1) * order;
          } else if (this.columns[index].type && this.columns[index].type === 'number') {
            return (+a === +b ? 0 : +a > +b ? 1 : -1) * order;
          } else {
            return (a === b ? 0 : a > b ? 1 : -1) * order;
          }
        });
      }
      return items;
    },
    paginateditems() {
      return this.paginate(this.filteredItems, this.length, this.pagination.currentPage);
    }
  }
};
</script>