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
                            <a route="#!" class="body-2 black--text">EDIT</a>
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
                        <v-list-tile v-for="(child, i) in item.children" :key="i" :to="child.route" exact>
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
                    <v-list-tile v-else :to="item.route" exact>
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
                        route: '/',
                    },
                    {
                        text: 'Settings',
                        icon: 'settings',
                        'icon-alt': 'settings',
                        model: false,
                        children: [
                            { text: 'Roles', icon: 'accessibility', route: '/roles'},
                            { text: 'Permissions', icon: 'accessible', route: '/permissions'},
                            { text: 'Teams', icon: 'supervisor_account', route: '/teams'},
                            { text: 'Teams Roles', icon: 'supervisor_account', route: '/team-roles'},
                        ]
                    },
                    {
                        text: 'Projects',
                        model: false,
                        icon: 'book',
                        route: '/projects',
                    },
                    {
                        text: 'Issues',
                        icon: 'assignment',
                        route: '/issues',
                    },
                    {
                        text: 'Workflows',
                        icon: 'timeline',
                        route: '/workflows',
                    },
                    {
                        text: 'Users',
                        icon: 'supervisor_account',
                        route: '/users',
                    },
                    {
                        text: 'Asset Management',
                        icon: 'web_asset',
                        route: '/asset-management',
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