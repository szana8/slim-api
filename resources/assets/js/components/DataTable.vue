<template>
    <div class="panel panel-default">
        <div class="panel-heading">{{ table.name }}</div>

        <div class="panel-body">
            <table class="table stripped">
                <thead>
                    <tr>
                        <th v-for="column in tableColumns">
                            {{ column.name }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="record in response">
                        <td v-for="column in tableColumns">
                            {{ record[column.column] }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script type="text/javascript">
    
    export default {
        props: ['tableName', 'tableClass', 'tableColumns', 'endPoint'],

        data () {
            return {
                table: {
                    name: this.tableName,
                    class: this.tableClass
                },
                response: []
            }
        },

        mounted () {
            window.bus.$emit('loading', true)

            axios.get(this.endPoint.name).then((response) => {
                //console.log(response.data.data)
                this.response = response.data.data
                //this.loading = false
                window.bus.$emit('loading', false)
            })
        },

        methods: {

            loadTableData () {

            }

        }

    }

</script>