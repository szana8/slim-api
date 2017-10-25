<template>
    <v-toolbar color="grey lighten-4" app clipped-left fixed>
        <v-toolbar-side-icon @click.stop="drawer = !drawer" class="hidden-sm-and-up"></v-toolbar-side-icon>
        <v-toolbar-title style="width: 300px" class="ml-0 pl-3"><img src="img/slim_logo.png"
                                                                     style="filter: grayscale(1); height: 30px;"/>
        </v-toolbar-title>

        <v-text-field solo prepend-icon="search" placeholder="Search" v-if="user.authenticated"></v-text-field>

        <v-spacer></v-spacer>
        <v-toolbar-items class="hidden-xs-only">

            <v-menu offset-y bottom right v-if="user.authenticated">
                <v-btn flat slot="activator">
                    <v-avatar class="teal">
                            <span class="white--text headline">
                                 {{ user.data.name.charAt(0) }}
                            </span>
                    </v-avatar>

                </v-btn>
                <v-list>
                    <v-list-tile v-for="(item,i) in list" :key="i" @click.prevent="doAction(item.path)">
                        <v-list-tile-action v-if="item.icon">
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>{{ item.text }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-divider></v-divider>
                    <v-list-tile @click.prevent="signout">
                        <v-list-tile-action>
                            <v-icon>keyboard_tab</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Logout</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-menu>

        </v-toolbar-items>
    </v-toolbar>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {

        data() {
            return {
                drawer: null,
                items: [
                    {icon: null, title: 'Sign up', needsAuth: false, link: 'register'},
                    {icon: null, title: 'Sign in', needsAuth: false, link: 'login'},
                ],
                right: null,
                list: [
                    {icon: 'perm_identity', text: 'Profile', path: '/'},
                    {icon: 'settings', text: 'Settings', path: '/'},
                ]
            }
        },

        computed: mapGetters({
            user: 'auth/user'
        }),

        methods: {

            ...mapActions({
                logout: 'auth/logout'
            }),

            signout() {
                this.logout().then(() => {

                    this.$router.replace({name: 'login'})
                })

            },

            doAction: function (route_name) {
                this.$router.replace({name: route_name})
            }

        }

    }
</script>