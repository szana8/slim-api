<template>
    <p>Role</p>
</template>

<script>
    export default {

        data () {
            return {
                index: null
            }
        },

        mounted () {
            axios.get('/api/v1/role').then((response) => {
                this.index = response.data.data
            })
        }

    }
</script>