<template>
    <div>
        <modal :show="show" @close="close">
          //The elements that we wanted to be shown or used.  
        </modal>
    </div>
</template>

<script>
    import TAsmtUpdateModal from './TAsmtUpdateModal.vue'

    export default {
        props: ['show'],
        components: { TAsmtUpdateModal },
        methods: {
            close: function() {
                this.$emit('close')
            }
        }
    }
    
</script>