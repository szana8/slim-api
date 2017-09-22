<template>
    <div class="col-md-3">

        <h4>Security</h4>
        <div class="list-group">
            <router-link :to="{ name: 'roles' }" class="list-group-item" v-bind:class="{ 'active': setActiveClass('roles') }">Roles</router-link>
            <router-link :to="{ name: 'permissions' }" class="list-group-item">Permissions</router-link>
            <router-link :to="{ name: 'teams' }" class="list-group-item">Teams</router-link>
            <router-link :to="{ name: 'team-roles' }" class="list-group-item">Team Roles</router-link>
        </div>

        <h4>User Management</h4>
        <div class="list-group">
            <a href="#" class="list-group-item">User</a>
        </div>

        <h4>Settings</h4>
        <div class="list-group">
            <a href="#" class="list-group-item">Settings</a>
        </div>

    </div>
</template>

<script>
    export default {

        methods: {

            setActiveClass (link) {
                return this.$route.name == link;
            }

        }

    }
</script>