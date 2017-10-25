<template>
    <div>
        <v-app>
            <navigation-drawer v-if="user.authenticated"></navigation-drawer>
            <navigation></navigation>
            <loader></loader>

            <main>
                <v-content>
                    <v-container fluid grid-list-md>
                        <v-layout row wrap justify-center align-center>
                            <router-view></router-view>
                        </v-layout>
                    </v-container>
                </v-content>
            </main>

            <v-footer></v-footer>

        </v-app>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {

        data () {

            return {

            }

        },

        computed: mapGetters({
            user: 'auth/user'
        }),

    }
</script>

