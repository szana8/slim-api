<template>
    <v-layout row wrap>
        <team-form></team-form>

        <v-flex d-flex xs12 sm12 md12 xl12>
            <v-card class="mb-5">
                <v-card-title primary-title>
                    <div>
                        <h3 class="headline mb-0">Teams</h3>
                        Portfolio for Slim allows you to add Slim applications users as team members. You can also work with virtual users that are placeholders to play with what-if scenarios such as, adding a new hire to your team. In your plan you can create new teams and configure them by choosing their scheduling methodology and assigning them tasks. Teams can be plan-specific or shared across plans.
                    </div>
                    <v-spacer></v-spacer>
                    <v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
                </v-card-title>

                <team-table :search="search"></team-table>
            </v-card>

            <v-fab-transition>
                <v-btn color="primary" key="edit" dark fab fixed bottom right v-model="fab" v-on:click="openDialog">
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

            openDialog () {
                console.log('open');
                bus.$emit('openTeamForm');
            }

        }


    }
</script>