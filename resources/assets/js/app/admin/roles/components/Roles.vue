<template>
    <div>
        <div class="col-md-9 col-md-offset-3">
            <div class="page-header">
                <h1>Global Roles</h1>
                <footer>Slim enables you to allocate particular people to specific roles in your project. Roles are used when defining other settings, like notifications and permissions.</footer>
            </div>
        </div>

        <horizontal></horizontal>

        <!-- End horizontal menu -->
        <div class="col-md-9">

            <search></search>

            <!-- Roles list -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="container-fluid">
                        <data-table :end-point="{name: 'api/v1/role'}" :table-columns="[{name: 'Name', column: 'name'}, {name: 'Description', column: 'description'}]" :table-class="{name: 'table table-stripped'}" table-name="Roles"></data-table>
                    </div>
                </div>
            </div>
            <!-- End role list -->

        </div>

    </div>
</template>

<script>
    import { horizontal, search } from '../../common/components'


    export default {

        methods: {

            setActiveClass (link) {
                return this.$route.name === link;
            }

        }

    }
</script>