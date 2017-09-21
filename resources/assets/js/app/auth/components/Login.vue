<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" @submit.prevent="submit">

                        <div class="alert alert-danger" v-if="errors.error">
                            {{ errors.error }}
                        </div>

                        <div class="form-group" v-bind:class="{ 'has-error': errors.email }">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" v-model="email" autofocus>

                                <span class="help-block" v-if="errors.email">
                                        {{ errors.email[0] }}
                                    </span>
                            </div>
                        </div>

                        <div class="form-group" v-bind:class="{ 'has-error': errors.password }">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="password">

                                <span class="help-block" v-if="errors.password">
                                        {{ errors.password[0] }}
                                    </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    import localforage from 'localforage'
    export default {

        data () {
            return {
                email: null,
                password: null,
                errors: []
            }
        },

        methods: {

            ...mapActions({
                login: 'auth/login'
            }),

            submit: function () {

                this.login({
                    payload: {
                        email: this.email,
                        password: this.password
                    },
                    context: this
                }).then(() => {
                    localforage.getItem('intended').then((name) => {
                        this.$router.replace({ name: name })
                    }).catch(() => {
                        this.$router.replace({ name: 'home' })
                    })
                })

            }

        }

    }
</script>