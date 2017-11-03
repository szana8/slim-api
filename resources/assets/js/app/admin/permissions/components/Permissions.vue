<template>
    <v-layout row wrap>
        <permission-form></permission-form>

        <v-flex d-flex xs12 sm12 md12 xl12>
            <v-card class="mb-5">
                <v-card-title primary-title>
                    <div>
                        <h3 class="headline mb-0">Permissions</h3>
                       Permission schemes allow you to create a set of permissions an apply this set of permissions to any project.<br />
                        All permissions within a scheme will apply to all projects that are associated with that scheme.
                    </div>
                    <v-spacer></v-spacer>
                    <v-text-field append-icon="search" label="Search" single-line hide-details v-model="search"></v-text-field>
                </v-card-title>

                <permission-table :search="search"></permission-table>
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
                bus.$emit('openPermissionForm');
            }

        }


    }
</script>