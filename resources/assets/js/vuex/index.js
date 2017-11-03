import Vue from 'vue'
import Vuex from 'vuex'
import auth from '../app/auth/vuex'
import roles from '../app/admin/roles/vuex'
import team from '../app/admin/teams/vuex'
import permission from '../app/admin/permissions/vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth: auth,
        roles: roles,
        team: team,
        permission: permission
    }
})