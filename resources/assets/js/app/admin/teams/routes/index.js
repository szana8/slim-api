import { Teams } from '../components'

export default [
    {
        path: '/teams',
        component: Teams,
        name: 'teams',
        meta: {
            needsAuth: true
        }
    }
]