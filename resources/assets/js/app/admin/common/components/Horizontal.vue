<template>
    <div>
        <v-flex xs12 sm2>
            <v-card :key="item.title" v-for="item in items">
                <v-toolbar class="primary white--text" dark>
                    <v-toolbar-side-icon></v-toolbar-side-icon>
                    <v-toolbar-title>{{ item.title }}</v-toolbar-title>
                </v-toolbar>
                <v-list>
                    <v-list-tile v-for="child in item.children" :key="child.title" @click="">
                        <v-list-tile-content>
                            <v-list-tile-title v-text="child.title"></v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-card>
        </v-flex>
    </div>
</template>

<script>
    export default {

        data () {

            return {
                drawer: null,
                items: [
                    {
                        title: 'Security',
                        children: [
                            {title: 'Roles', name: 'roles'},
                            {title: 'Permissions', name: 'permissions'},
                            {title: 'Teams', name: 'teams'},
                            {title: 'Team Roles', name: 'teamRoles'}
                        ]
                    },

                    {
                        title: 'User Management',
                        children: [
                            {title: 'User', name: 'user'},
                        ]
                    },

                    {
                        title: 'Settings',
                        children: [
                            {title: 'Settings', name: 'settings'},
                        ]
                    },

                ]
            }

        },

        methods: {

            setActiveClass (link) {
                return this.$route.name == link;
            },

            navigate (route) {
                this.$router.replace({ name: route })
            }

        }

    }
</script>