<template>
    <div>
        <div class="col-md-12">
            <v-data-table class="elevation-1">
                <template slot="items" slot-scope="props">
                    <td class="text-xs-right">Name</td>
                    <td class="text-xs-right">Description</td>
                </template>
            </v-data-table>
        </div>

    </div>

</template>


<script>
    export default {

        data () {
            return {
                index: null,
                items: [],
                //loading: false
                headers: [
                    { text: 'Name', value: 'name' },
                    { text: 'Description', value: 'description' },
                ]
            }
        },

        mounted () {
            window.bus.$emit('loading', true)

            axios.get('/api/v1/role').then((response) => {
                console.log(response.data.data)
                this.items = response.data.data
                //this.loading = false
                window.bus.$emit('loading', false)
            })
        },

    }
</script>