<template>
    <div>
        <v-layout column>
            <v-flex xs12 sm4 offset-sm4>
                <v-card>

                    <v-card-title primary-title>
                        <h3 class="headline mb-0">Login</h3>
                    </v-card-title>

                    <v-card-text>
                        <v-form>
                            
                            <!-- Email field -->
                            <v-text-field label="Email" v-model="email" v-bind:class="{ 'input-group--error':  errors.email }"></v-text-field>
                            <div class="input-group__details" style="margin-top:-30px;color:red;" v-if="errors.email">
                                <div class="input-group__messages">
                                    <div class="input-group__error" v-text="errors.email[0]"/>
                                </div>
                            </div>

                            <!-- Password field -->
                            <v-text-field type="password" label="Password" v-model="password" v-bind:class="{ 'input-group--error':  errors.password }"></v-text-field>
                            <div class="input-group__details" style="margin-top:-30px;color:red;" v-if="errors.password">
                                <div class="input-group__messages">
                                    <div class="input-group__error" v-text="errors.password[0]"/>
                                </div>
                            </div>

                            <!-- End of fields -->
                        </v-form>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn primary class="white--text" @click.prevent="submit">Login</v-btn>
                    </v-card-actions>

                </v-card>
            </v-flex>
        </v-layout>

    </div>
</template>

<script>
    import {isEmpty} from 'lodash'
    import {mapActions} from 'vuex'
    import localforage from 'localforage'

    export default {

        data() {
            return {
                email: null,
                password: null,
                errors: [],
            }
        },

        methods: {

            ...mapActions({
                login: 'auth/login'
            }),

            submit: function () {
                window.bus.$emit('loading', true)

                this.login({

                    payload: {
                        email: this.email,
                        password: this.password
                    },
                    context: this

                }).then(() => {
                    window.bus.$emit('loading', false)

                    localforage.getItem('intended').then((name) => {
                        if (isEmpty(name)) {
                            this.$router.replace({name: 'home'})
                            return
                        }

                        this.$router.replace({name: name})
                    })

                }).catch((error) => {
                    console.log(error)
                })

            }

        }

    }
</script>