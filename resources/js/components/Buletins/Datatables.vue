<template>
    <div>
        <bootstrap-4-datatable :columns="columns" :data="rows" :filter="filter" :per-page="perPage"></bootstrap-4-datatable>
        <bootstrap-4-datatable-pager v-model="page" type="abbreviated"></bootstrap-4-datatable-pager>
    </div>
</template>

<script>
export default {
    data() {
        return {
            columns: [{
                label: 'id_kelas',
                field: 'id_kelas'
            },
            {
                label: 'nomor_induk',
                field: 'nomor_induk'
            },
            {
                label: 'nik_parent',
                field: 'nik_parent'
            },
            {
                label: 'nama',
                field: 'nama'
            }
            ],
            rows: [],
            page: 1,
            filter:  'a',
            perPage: 12,
        }
    },
    methods: {
        showBlogs: function () {
            let uri = "https://ceriakan.id/api/kelas/1";
            axios.get(uri).then((response) => {
                this.rows = response.data['students'];
          });
        }
    },
    created: function () {
        this.showBlogs()
    }
}

</script>