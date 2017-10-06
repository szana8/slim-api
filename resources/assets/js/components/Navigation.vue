<template>
    <div>
        <v-navigation-drawer temporary v-model="drawer" light overflow absolute>
            <v-list class="pa-1">

                <v-list-tile v-for="item in items" v-if="item.needsAuth === user.authenticated" :key="item.title">
                    <v-list-tile-avatar>
                        <v-icon left>{{ item.icon }}</v-icon>
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

            </v-list>

        </v-navigation-drawer>

        <v-toolbar dark class="primary">
            <v-toolbar-side-icon @click.stop="drawer = !drawer" class="hidden-sm-and-up"></v-toolbar-side-icon>
            <v-toolbar-title>Slim</v-toolbar-title>
            <v-spacer></v-spacer>

            <v-text-field
                    label="Search..."
                    single-line
                    append-icon="search"
                    dark
                    hide-details
                    class="hidden-xs-only"
                    v-if="user.authenticated"
            ></v-text-field>

            <v-toolbar-items class="hidden-xs-only">


                <v-menu offset-y bottom right v-if="user.authenticated" :key="item.title" v-for="item in items">
                    <v-btn flat slot="activator" v-if="item.needsAuth === user.authenticated">
                        <v-icon left>{{ item.icon }}</v-icon>
                        {{ item.title }}
                    </v-btn>
                    <v-list v-if="item.children">
                        <v-list-tile :key="child.title" v-for="child in item.children" @click.prevent="navigate(child.name)">
                            <v-list-tile-title>{{ child.title }}</v-list-tile-title>
                        </v-list-tile>
                    </v-list>
                </v-menu>

                <v-menu offset-y bottom right v-if="user.authenticated">
                    <v-btn flat slot="activator">
                        <v-avatar class="info">
                            <span class="white--text headline">{{ user.data.name.charAt(0) }}</span>
                        </v-avatar>
                    </v-btn>
                    <v-list>
                        <v-list-tile @click.prevent="signout">
                            <v-list-tile-title>Logout</v-list-tile-title>
                        </v-list-tile>
                    </v-list>
                </v-menu>

            </v-toolbar-items>
        </v-toolbar>

    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {

        data () {
            return {
                drawer: null,
                items: [
                    {
                        icon: 'settings',
                        title: 'Settings',
                        needsAuth: true ,
                        children: [
                            {
                                icon: '',
                                title: 'Roles',
                                needsAuth: true,
                                name: 'roles'
                            },

                            {
                                icon: '',
                                title: 'Permissions',
                                needsAuth: true,
                                name: 'permissions'
                            },

                            {
                                icon: '',
                                title: 'Teams',
                                needsAuth: true,
                                name: 'teams'
                            },

                            {
                                icon: '',
                                title: 'Team Roles',
                                needsAuth: true,
                                name: 'teamRoles'
                            }
                        ]
                    },
                    { icon: 'face', title: 'Sign up', needsAuth: false, link: 'register' },
                    { icon: 'lock_open', title: 'Sign in', needsAuth: false, link: 'login' },
                ],
                right: null,
            }
        },

        computed: mapGetters({
            user: 'auth/user'
        }),

        methods: {

            ...mapActions({
                logout: 'auth/logout'
            }),

            signout () {
                this.logout().then(() => {
                    this.$router.replace({ name: 'login' })
                })

            },

            navigate (route) {
                this.$router.replace({ name: route })
            }

        }

    }
</script>