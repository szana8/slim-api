<template>
    <v-data-table
            :headers="headers"
            :items="items"
            :loading="loading"
            select-all
            class="elevation-1"
    >
        <template slot="headers" slot-scope="props">
            <tr>
                <th>

                </th>
                <th v-for="header in props.headers" :key="header.text" class="text-xs-right">
                    {{ header.text }}
                </th>
            </tr>
        </template>
        <template slot="items" slot-scope="props">
            <v-checkbox v-model="permission[props.item.id]"></v-checkbox>
            <td class="text-xs-right">{{ props.item.name }}</td>
            <td class="text-xs-right">{{ props.item.display_name }}</td>
            <td class="text-xs-right">{{ props.item.description }}</td>
        </template>
        <template slot="pageText" slot-scope="{ pageStart, pageStop }">
            From {{ pageStart }} to {{ pageStop }}
        </template>
    </v-data-table>
</template>

<script>

    export default {

        data () {
            return {
                permission: [],
                totalItems: 0,
                items: [],
                loading: true,
                pagination: {},
                headers: [
                    {text: 'Name', value: 'name', align: 'left'},
                    {text: 'Display Name', value: 'display_name'},
                    {text: 'Description', value: 'description'},
                ]
            }
        },

        mounted () {
            this.getPermissions();
        },

        methods: {

            getPermissions: function () {
                axios.get('/api/v1/permission/').then((response) => {
                    this.loading = false
                    this.items = response.data.data;
                }).catch((error) => {
                    context.errors = error.response.data.errors
                    reject(error)
                })
            },

            toggleAll () {
                if (this.permission.length) this.permission = []
                else this.permission = this.items.slice()
            },

            changeSort (column) {
                if (this.pagination.sortBy === column) {
                    this.pagination.descending = !this.pagination.descending
                } else {
                    this.pagination.sortBy = column
                    this.pagination.descending = false
                }
            }

        }

    }

</script>