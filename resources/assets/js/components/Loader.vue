<template>
    <div class="loader" v-if="loading"></div>
</template>

<script>

    export default {

        data () {
            return {
                loading: false
            }
        },

        mounted () {
            window.bus.$on('loading', (loadingOrNot) => {
                this.loading = loadingOrNot
            })
        }

    }

</script>