<template>
    <div>
        <v-navigation-drawer persistent clipped app v-model="drawer" overflow :mini-variant.sync="mini">

            <v-toolbar flat class="transparent">
                <v-list class="pa-0">
                    <v-list-tile avatar>
                        <v-list-tile-avatar>
                            <v-icon dark>account_circle</v-icon>
                        </v-list-tile-avatar>
                        <v-list-tile-content>
                            <v-list-tile-title>{{ user.data.name }}</v-list-tile-title>
                            <v-list-tile-sub-title>{{ user.data.email }}</v-list-tile-sub-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-btn icon @click.native.stop="mini = !mini">
                                <v-icon>chevron_left</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                    </v-list-tile>
                </v-list>
            </v-toolbar>


            <v-list class="pt-0" dense>
                <v-divider></v-divider>
                <template v-for="(item, i) in items">
                    <v-layout row v-if="item.heading" align-center :key="i">
                        <v-flex xs6>
                            <v-subheader v-if="item.heading">
                                {{ item.heading }}
                            </v-subheader>
                        </v-flex>
                        <v-flex xs6 class="text-xs-center">
                            <a href="#!" class="body-2 black--text">EDIT</a>
                        </v-flex>
                    </v-layout>
                    <v-list-group v-else-if="item.children" v-model="item.model" no-action>
                        <v-list-tile slot="item">
                            <v-list-tile-action>
                                <v-icon>{{ item.model ? item.icon : item['icon-alt'] }}</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    {{ item.text }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile v-for="(child, i) in item.children" :key="i" @click.prevent="doAction(child.path)">
                            <v-list-tile-action v-if="child.icon">
                                <v-icon>{{ child.icon }}</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    {{ child.text }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list-group>
                    <v-list-tile v-else @click.prevent="doAction(item.path)">
                        <v-list-tile-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
            </v-list>
        </v-navigation-drawer>
    </div>
</template>

<script>

    import { mapGetters } from 'vuex'

    export default {

        data () {
            return {
                drawer: true,
                mini: false,
                items: [
                    {
                        text: 'Dashboard',
                        icon: 'dashboard',
                        path: 'home'
                    },
                    {
                        text: 'Settings',
                        icon: 'settings',
                        'icon-alt': 'settings',
                        path: 'home',
                        model: false,
                        children: [
                            { text: 'Roles', path: 'roles', icon: 'accessibility' },
                            { text: 'Permissions', path: 'home', icon: 'accessible'},
                            { text: 'Teams', path: 'home', icon: 'supervisor_account'},
                            { text: 'Teams Roles', path: 'home', icon: 'supervisor_account' },
                        ]
                    },
                    {
                        text: 'Projects',
                        path: 'home',
                        model: false,
                        icon: 'book'
                    },
                    {
                        text: 'Issues',
                        path: 'home',
                        icon: 'assignment'
                    },
                    {
                        text: 'Workflows',
                        path: 'home',
                        icon: 'timeline'
                    },
                    {
                        text: 'Users',
                        path: 'home',
                        icon: 'supervisor_account'
                    },
                    {
                        text: 'Asset Management',
                        path: 'home',
                        icon: 'web_asset'
                    },
                ],
            }
        },

        computed: mapGetters({
            user: 'auth/user'
        }),

        methods: {

            doAction: function (route_name) {
                console.log(route_name);
                this.$router.replace({ name:  route_name})
            }

        }

    }

</script>