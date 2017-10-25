<template>
    <v-flex d-flex xs12 sm12 md12 xl12>
        <v-layout column>
            <v-flex xs12 sm4 offset-sm4>

                <v-toolbar color="grey lighten-4">
                    <v-toolbar-title>Register</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>

                <v-card>
                    <v-card-text>
                        <v-form v-model="valid">
                            
                             <!-- Name field -->
                            <v-text-field label="Name" v-model="name" required v-bind:class="{ 'input-group--error':  errors.name }"></v-text-field>
                            <div class="input-group__details" style="margin-top:-30px;color:red;" v-if="errors.name">
                                <div class="input-group__messages">
                                    <div class="input-group__error" v-text="errors.name[0]"/>
                                </div>
                            </div>

                            <!-- Email field -->
                            <v-text-field label="Email" v-model="email" required v-bind:class="{ 'input-group--error':  errors.email }"></v-text-field>
                            <div class="input-group__details" style="margin-top:-30px;color:red;" v-if="errors.email">
                                <div class="input-group__messages">
                                    <div class="input-group__error" v-text="errors.email[0]"/>
                                </div>
                            </div>

                            <!-- Password field -->
                            <v-text-field type="password" label="Password" required v-model="password" v-bind:class="{ 'input-group--error':  errors.password }"></v-text-field>
                            <div class="input-group__details" style="margin-top:-30px;color:red;" v-if="errors.password">
                                <div class="input-group__messages">
                                    <div class="input-group__error" v-text="errors.password[0]"/>
                                </div>
                            </div>

                            <v-checkbox
                                    v-model="checkbox"
                                    required
                            >
                                <div slot="label" @click.stop="checkbox = !checkbox">
                                    I accept the
                                    <a href="javascript:;" @click.stop="">user agreement</a>
                                </div>
                            </v-checkbox>

                        </v-form>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn @click.prevent="cancel">Cancel</v-btn>
                        <v-btn @click.prevent="submit">Register</v-btn>
                    </v-card-actions>

                </v-card>
            </v-flex>
        </v-layout>
    </v-flex>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {

        data () {

            return {
                valid: false,
                name: null,
                email: null,
                password: null,
                checkbox: false,
                errors: []
            }
            
        },

        computed: mapGetters({

            user: 'auth/user'

        }),

        methods: {

            ...mapActions({

                register: 'auth/register'

            }),

            submit: function () {
                window.bus.$emit('loading', true)
                this.register({

                    payload: {
                        name: this.name,
                        email: this.email,
                        password: this.password
                    },

                    context: this

                }).then((response) => {
                    window.bus.$emit('loading', false)
                   this.$router.replace({ name: 'home' })

                }).catch((error) => {
                    window.bus.$emit('loading', false)
                    console.log(error)

                })

            },

            cancel: function () {

                this.$router.replace({ name: 'login' })

            }

        }

    }
</script>