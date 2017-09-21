import { Permissions } from '../components'

export default [
    {
        path: '/permissions',
        component: Permissions,
        name: 'permissions',
        meta: {
            needsAuth: true
        }
    }
]