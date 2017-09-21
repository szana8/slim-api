<template>
    <div>

        <nav class="navbar navbar-default navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <router-link :to="{ name: 'home' }" class="navbar-brand"><img src="/img/slim_logo_grayscale.png" style="height: 32px;margin-top:-5px;"></router-link>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->

                    <ul class="nav navbar-nav" v-if="user.authenticated">
                        <form class="navbar-form navbar-right">
                            <button type="button" class="btn btn-info">Create</button>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right" v-if="!user.authenticated">
                        <!-- Authentication Links -->
                        <li><router-link :to="{ name: 'login' }">Login</router-link></li>
                        <li><router-link :to="{ name: 'register' }">Register</router-link></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right" v-if="user.authenticated">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="glyphicon glyphicon-cog"></i>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Administrator</li>
                                <li><router-link :to="{ name: 'roles' }">Roles</router-link></li>
                                <li><router-link :to="{ name: 'permissions' }">Permissions</router-link></li>
                                <li><router-link :to="{ name: 'teams' }">Teams</router-link></li>
                                <li><router-link :to="{ name: 'teamRoles' }">Team Roles</router-link></li>
                            </ul>
                        </li>

                        <li><a href="#" v-text="user.data.name"></a></li>

                    </ul>

                    <form class="navbar-form navbar-right" v-if="user.authenticated">
                        <div class="form-group">
                            <input class="form-control" placeholder="Search">
                        </div>
                    </form>
                </div>
            </div>
        </nav>

    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {

        computed: mapGetters({
            user: 'auth/user'
        })

    }
</script>