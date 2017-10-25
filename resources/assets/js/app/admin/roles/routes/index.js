import { Roles, RoleAssignment } from '../components'

export default [
    {
        path: '/roles',
        component: Roles,
        name: 'roles',
        meta: {
            needsAuth: true
        }
    },
    {
        path: '/roles/assignment/:id',
        component: RoleAssignment,
        name: 'role-assignment',
        meta: {
            needsAuth: true
        }
    },
]