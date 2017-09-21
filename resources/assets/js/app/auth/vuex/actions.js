export const register = ({ dispatch }, { payload, context }) => {
    return axios.post('api/v1/auth/signup', payload).then((response) => {
        console.log(response)
    }).catch((error) => {
        context.errors = error.response.data.errors
    })
}

export const login = ({ dispatch }, { payload, context }) => {
    return axios.post('api/v1/auth/signin', payload).then((response) => {
       dispatch('setToken').then(() => {
           console.log('fetch User')
       })
    }).catch((error) => {
        context.errors = error.response.data
    })
}

export const setToken = ({commit, dispatch}, token) => {
    commit('setToken', token)
}