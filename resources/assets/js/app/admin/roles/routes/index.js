import { Roles } from '../components'

export default [
    {
        path: '/roles',
        component: Roles,
        name: 'roles',
        meta: {
            needsAuth: true
        }
    }
]