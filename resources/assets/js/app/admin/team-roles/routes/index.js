import { TeamRoles } from '../components'

export default [
    {
        path: '/team-roles',
        component: TeamRoles,
        name: 'teamRoles',
        meta: {
            needsAuth: true
        }
    }
]