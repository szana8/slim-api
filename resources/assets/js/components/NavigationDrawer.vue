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
    </div>
</template>

<script>

    export default {

        props: {

            items: null,
            user: null

        },

        data () {

            return {

                drawer: null

            }

        },

        mounted () {

            window.bus.$on('toggleDrawer', this.toggleDrawer);

        },

        methods: {

            toggleDrawer () {

                this.drawer = !this.drawer;

            }

        }

    }

</script>