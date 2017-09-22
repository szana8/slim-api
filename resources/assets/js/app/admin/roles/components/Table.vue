<template>
    <div>
        <div class="col-md-12">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Roles</th>
                        <th>Description</th>
                        <th width="30%">Permissions</th>
                        <th width="30%">Teams</th>
                        <th width="150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="role in roles">
                        <td>{{ role.name }}</td>
                        <td>{{ role.description }}</td>
                        <td>
                            <i v-for="permission in role.permissions.data">{{ permission.display_name }}, </i>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">

                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>

</template>

<script>
    export default {

        data () {
            return {
                index: null,
                roles: null,
                //loading: false
            }
        },

        mounted () {
            window.bus.$emit('loading', true)

            axios.get('/api/v1/role').then((response) => {
                console.log(response.data.data)
                this.roles = response.data.data
                //this.loading = false
                window.bus.$emit('loading', false)
            })
        },

    }
</script>