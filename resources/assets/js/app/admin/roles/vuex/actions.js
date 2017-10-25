import { isEmpty } from 'lodash'


export const store = ({ dispatch }, { payload, context }) => {

    return new Promise((resolve, reject) => {
        axios.post('/api/v1/role', payload).then((response) => {
            resolve(response)
        }).catch((error) => {
            context.errors = error.response.data.errors
            reject(error)
        })
    })

}

export const destroy = ({ dispatch }, { payload, context }) => {

    return new Promise((resolve, reject) => {
        axios.delete('/api/v1/role/' + payload.id).then((response) => {
            resolve(response)
        }).catch((error) => {
            context.errors = error.response.data.errors
            reject(error)
        })
    })

}