<template>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title>
                <span class="headline">{{ action }} Permission</span>
            </v-card-title>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout wrap>
                        <v-flex xs12>

                            <v-text-field label="Name" required v-model="name" v-bind:class="{ 'input-group--error':  errors.name }"></v-text-field>
                            <div class="input-group__details" style="margin-top:-30px;color:red;" v-if="errors.name">
                                <div class="input-group__messages">
                                    <div class="input-group__error" v-text="errors.name[0]"></div>
                                </div>
                            </div>

                        </v-flex>
                        <v-flex xs12>
                            <v-text-field label="Display Name" required v-model="display_name" v-bind:class="{ 'input-group--error':  errors.display_name }"></v-text-field>
                            <div class="input-group__details" style="margin-top:-30px;color:red;" v-if="errors.display_name">
                                <div class="input-group__messages">
                                    <div class="input-group__error" v-text="errors.display_name[0]"></div>
                                </div>
                            </div>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field multi-line label="Description" required v-model="description"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click.native="dialog = false">Close</v-btn>
                <v-btn color="blue darken-1" flat @click.native="submit">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {

        data() {

            return {
                dialog: false,
                action: 'Create',
                mode: "insert",
                name: null,
                display_name: null,
                description: null,
                id: null,
                errors: []
            }

        },

        mounted() {

            bus.$on('openPermissionForm', this.openForm);

        },

        methods: {

            ...mapActions({

                store: 'permission/store',
                update: 'permission/update'

            }),

            openForm: function (team) {
                if (team != null)
                {
                    this.action = "Update"
                    this.mode = "update"

                    this.name = team.name
                    this.display_name = team.display_name
                    this.description = team.description
                    this.id = team.id

                    this.dialog = true;
                }
                else
                {
                    this.action = "Create"
                    this.mode = "insert"
                    this.dialog = true;
                }

            },

            submit: function () {

                window.bus.$emit('loading', true)

                if (this.mode == "update")
                {
                    console.log(this.name);

                    this.update({
                        payload: {
                            name: this.name,
                            display_name: this.display_name,
                            description: this.description,
                            id: this.id
                        },
                        context: this
                    }).then((response) => {

                        window.bus.$emit('loading', false)
                        this.name = null
                        this.display_name = null
                        this.description = null
                        this.dialog = false

                        bus.$emit('refreshPermissionTable');
                    }).catch((error) => {
                        window.bus.$emit('loading', false)
                        console.log(error)
                    })
                }
                else if (this.mode == "insert")
                {
                    this.store({
                        payload: {
                            name: this.name,
                            display_name: this.display_name,
                            description: this.description
                        },
                        context: this
                    }).then((response) => {
                        window.bus.$emit('loading', false)
                        this.name = null
                        this.display_name = null
                        this.description = null
                        this.dialog = false
                        bus.$emit('refreshPermissionTable');
                    }).catch((error) => {
                        window.bus.$emit('loading', false)
                        console.log(error)
                    })
                }
            }

        },


    }

</script>