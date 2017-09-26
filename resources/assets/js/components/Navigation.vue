<template>
    <div>
        <v-navigation-drawer  temporary
                              v-model="drawer"
                              light
                              overflow
                              absolute>
            <v-list class="pa-1">
                <v-list-tile avatar>
                    <v-list-tile-avatar>
                        <v-icon left>person</v-icon>
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title>Administrator</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
            <v-list class="pt-0" dense>
                <v-divider></v-divider>
                <v-list-tile avatar>
                    <v-list-tile-avatar>
                        <v-icon left>settings</v-icon>
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title>Settings</v-list-tile-title>
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
            ></v-text-field>

            <v-toolbar-items class="hidden-xs-only">

                <v-btn flat>
                    <v-icon>settings</v-icon>
                </v-btn>

                <v-btn flat>
                    <v-icon left>person</v-icon>
                    Administrator
                </v-btn>

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
                    { title: 'Home', icon: 'dashboard' },
                    { title: 'About', icon: 'question_answer' }
                ],
                right: null
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
                    this.$router.replace({ name: 'home' })
                })

            }

        }

    }
</script>