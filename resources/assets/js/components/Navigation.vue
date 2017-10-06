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

                <v-btn flat v-for="item in items" :key="item.title" v-if="item.needsAuth === user.authenticated" :to="item.link">
                    <v-icon left>{{ item.icon }}</v-icon>
                    {{ item.title }}
                </v-btn>

                <v-menu bottom right v-if="user.authenticated">
                    <v-btn flat slot="activator">
                        <v-icon left>person</v-icon>
                        {{ user.data.name }}
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
                    { icon: 'settings', title: 'Settings', needsAuth: true },
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

            }

        }

    }
</script>