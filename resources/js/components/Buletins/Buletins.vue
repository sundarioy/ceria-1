<template>
  <div class="container">   
    <div class="row">
      <ul class="list-unstyled components assignment-menu" >        
        <li class="nav-item">
          <router-link to="/buletin-approval">
            <a href="#" class="nav-link">
              <i class="fas fa-tasks"></i>
              Butuh Persetujuan
              <span class="font-weight-bold">(3)</span>
            </a>
          </router-link>
        </li>
      </ul>     
    </div>    
    <div class="row">     
      <div class="buletin-wrapper" v-for="i in 5">
        <router-link :to="{name: 'buletin-detail', params: { id: i}}">
          <div class="buletin-box pr-3">
            <div class="col-md-12">
              <div class="buletin-thumbnail float-left col-md-3">
                <img :src="'/images/419.jpg'">
                <div class="class-middle">
                  <div class="class-middle-text">Lihat buletin</div>
                </div>  
              </div>
              <div class="buletin-data float-right col-md-9">
                <div class="buletin-title">Lorem Ipsum Dolor Sit Amet {{ i }}</div>
                <div class="buletin-date">Dipost oleh Jasmine, 1 Maret 2020 10:00 WIB</div> 
                <div class="buletin-short line-clamp mt-3">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                </div>  
              </div>
            </div>
          </div>
        </router-link>
      </div>              
    </div>
    <div class="row">
      <div class="footer-space"></div>
    </div>
    <div class="row">     
      <router-link to="/tambah-buletin" class="float">
        <i class="fa fa-plus my-float"></i>
      </router-link>
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