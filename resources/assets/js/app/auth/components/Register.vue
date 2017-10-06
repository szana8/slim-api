<template>
    <div>
        <v-layout column>
            <v-flex xs12 sm6 offset-sm3>
                <v-card>
                     <v-card-title primary-title>
                        <h3 class="headline mb-0">Register</h3>
                    </v-card-title>

                    <v-card-text>
                        <v-form>
                            
                             <!-- Name field -->
                            <v-text-field label="Name" v-model="name" v-bind:class="{ 'input-group--error':  errors.name }"></v-text-field>
                            <div class="input-group__details" style="margin-top:-30px;color:red;" v-if="errors.name">
                                <div class="input-group__messages">
                                    <div class="input-group__error" v-text="errors.name[0]"/>
                                </div>
                            </div>

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
    import { mapGetters, mapActions } from 'vuex'

    export default {

        data () {

            return {
                name: null,
                email: null,
                password: null,
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
                
                this.register({

                    payload: {
                        name: this.name,
                        email: this.email,
                        password: this.password
                    },

                    context: this

                }).then((response) => {

                   this.$router.replace({ name: 'home' })

                }).catch((error) => {

                    console.log(error)

                })

            }

        }

    }
</script>