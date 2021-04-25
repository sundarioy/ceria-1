<template>
  <div class="container">
    <!-- <div class="row">
      <div class="presence-summary col-sm-3 ml-3">
        <div class="presence-summary-title">Akumulasi Kehadiran</div>
        <div class="presence-summary-percent">100%</div>
      </div>
    </div> -->
    <div class="row ml-1">
      <header class="amt-deatail-header">
        <router-link to="/daftar-kehadiran">
          <span class="path">Daftar Kehadiran Siswa </span>
        </router-link>                
        <hr>
      </header>
    </div>
    <div class="row">
      <div class="col-md-10">
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
        <div class="report-table mt-1">
          <table class="">
            <thead>
              <tr>
                <th class="col-number">No</th>
                <th v-for="column in columns" :key="column.name" @click="sortBy(column.name)" :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                  style="width: 40%; cursor:pointer;">                    
                  {{column.label}}
                </th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(user, index) in paginatedUsers" :key="user.id">
                <td>{{ index+pagination.from }}</td>
                <td>
                  <div class="row ml-2">
                    <div class="table-student-thumbnail border-1-555"></div>
                    <span class="mt-2 ml-2">{{ user.nama }}</span>
                  </div>
                </td>
                <td>{{user.nomor_induk}}</td>
                <td>100%</td>
                <td>                  
                  <router-link :to="{name: 'detail-kehadiran', params: { id: user.nomor_induk }}">
                    <div class="presence-detail-fa">
                      <i class="fa fa-search text-dark"></i>
                    </div>
                  </router-link>
                </td>
              </tr>
            </tbody>
          </table>    
        </div>     
        <div class="mt-3">
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
              {{pagination.from}} - {{pagination.to}} dari {{filteredUsers.length}}
              <span v-if="`filteredUsers.length < pagination.total`"></span>
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
    this.getUsers();
    Fire.$on('reloadUsers', () => {
      this.getUsers();
    })
  },
  data() {
    let sortOrders = {};
    let columns = [
    {label: 'Nama', name: 'nama' },
    {label: 'NIS', name: 'nomor_induk'},
    {label: 'Kehadiran', name: 'nik_parent'},
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      users: [],
      columns: columns,
      sortKey: 'nomor_induk',
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
      axios.delete(`/users/${id}/delete`).then(() => {
        Fire.$emit('reloadUsers')
        swal(
          'Success!',
          'User deleted',
          'success'
          )
      }).catch(() => {
        swal('Failed', 'There was something wrong', 'warning');
      });
    },
    getUsers() {
      let uri = "https://ceriakan.id/api/child";      
      axios.get(uri, {params: this.tableShow})
      .then(response => {
        console.log('The data: ', response.data)
        this.users = response.data['data'];
        this.pagination.total = this.users.length;
      })
      .catch(errors => {
        console.log(errors);
      });
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
  },
  computed: {
    filteredUsers() {
      let users = this.users;
      if (this.search) {
        users = users.filter((row) => {
          return Object.keys(row).some((key) => {
            return String(row[key]).toLowerCase().indexOf(this.search.toLowerCase()) > -1;
          })
        });
      }
      let sortKey = this.sortKey;
      let order = this.sortOrders[sortKey] || 1;
      if (sortKey) {
        users = users.slice().sort((a, b) => {
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
      return users;
    },
    paginatedUsers() {
      return this.paginate(this.filteredUsers, this.length, this.pagination.currentPage);
    }
  }
};
</script>