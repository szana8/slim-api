<template>
    <v-data-table
            :headers="headers"
            :items="items"
            :search="search"
            :loading="loading"
            class="elevation-1"
    >
        <template slot="items" slot-scope="props">
            <td>{{ props.item.name }}</td>
            <td class="text-xs-right">{{ props.item.display_name }}</td>
            <td class="text-xs-right">{{ props.item.description }}</td>
            <td class="text-xs-right">
                <v-btn flat icon color="primary" v-on:click="assignPermission(props.item.id)">
                    <v-icon>list</v-icon>
                </v-btn>
                <v-btn flat icon color="primary">
                    <v-icon>edit</v-icon>
                </v-btn>
                <v-btn flat icon color="error" v-on:click="destroy(props.item.id)">
                    <v-icon>delete</v-icon>
                </v-btn>
            </td>
        </template>
        <template slot="pageText" slot-scope="{ pageStart, pageStop }">
            From {{ pageStart }} to {{ pageStop }}
        </template>
    </v-data-table>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {

        props: ['search'],

        data() {
            return {
                totalItems: 0,
                roles: [],
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

        watch: {

            pagination: {
                handler() {
                    this.getDataFromApi()
                        .then(data => {
                            this.items = data.items
                            this.totalItems = data.total
                        })
                },
                deep: true
            }
        },

        mounted() {

            this.getData();

            bus.$on('refreshRoleTable', this.getData);

        },
        methods: {

            ...mapActions({

                destroy: 'roles/destroy',

            }),

            getData: function () {

                this.getDataFromApi().then(data => {
                    this.items = data.items
                    this.totalItems = data.total
                })

            },


            getDataFromApi: function () {
                this.loading = true
                return new Promise((resolve, reject) => {
                    const {sortBy, descending, page, rowsPerPage} = this.pagination

                    this.getRoles().then(() => {
                        let items = this.roles;
                        const total = items.length

                        if (this.pagination.sortBy) {
                            items = items.sort((a, b) => {
                                const sortA = a[sortBy]
                                const sortB = b[sortBy]

                                if (descending) {
                                    if (sortA < sortB) return 1
                                    if (sortA > sortB) return -1
                                    return 0
                                } else {
                                    if (sortA < sortB) return -1
                                    if (sortA > sortB) return 1
                                    return 0
                                }
                            })
                        }

                        if (rowsPerPage > 0) {
                            items = items.slice((page - 1) * rowsPerPage, page * rowsPerPage)
                        }

                        setTimeout(() => {
                            this.loading = false
                            resolve({
                                items,
                                total
                            })
                        }, 1000)
                    })


                })
            },

            getRoles: function () {
                return new Promise((resolve, reject) => {
                    axios.get('/api/v1/role').then((response) => {
                        console.log(response.data.data);
                        this.roles = response.data.data;
                        resolve()
                    });
                });
            },

            destroy: function (role) {

                axios.delete('/api/v1/role/' + role).then((response) => {
                    bus.$emit('refreshRoleTable');
                }).catch((error) => {
                    context.errors = error.response.data.errors
                    reject(error)
                })

            },

            assignPermission: function (role) {
                this.$router.replace({ name: 'role-assignment', params: { id: role } })
            }
        }
    }

</script>