import Vue from 'vue'
import Vuex from 'vuex'
import auth from '../app/auth/vuex'
import roles from '../app/admin/roles/vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth: auth,
        roles: roles
    }
})