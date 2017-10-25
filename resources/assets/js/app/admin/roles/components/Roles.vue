<template>
    <v-layout row justify-center>
        <role-form></role-form>

        <v-flex d-flex xs12 sm12 md12 xl12>
            <v-card>
                <v-card-title primary-title>
                    <div>
                        <h3 class="headline mb-0">Global Roles</h3>
                        <div>Slim enables you to allocate particular people to specific roles in your project. Roles are used when defining other settings, like notifications and permissions.</div>
                    </div>
                    <v-spacer></v-spacer>
                    <v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
                </v-card-title>

                <role-table :search="search"></role-table>
            </v-card>

            <v-fab-transition>
                <v-btn color="primary" key="edit" dark fab fixed bottom right v-model="fab" v-on:click="openRolesForm">
                    <v-icon>add</v-icon>
                </v-btn>
            </v-fab-transition>
        </v-flex>

    </v-layout>
</template>

<script>
    import { horizontal, search } from '../../common/components'
    import table from './Table.vue'

    export default {

        data () {

            return {
                search: null,
                fab: false,
                hidden: false,
                tabs: null
            }

        },

        methods: {

            setActiveClass (link) {
                return this.$route.name === link;
            },

            openRolesForm () {
                console.log('open');
                bus.$emit('openRolesForm');
            }

        }


    }
</script>