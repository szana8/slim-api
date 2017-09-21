import auth from './auth/routes'
import home from './home/routes'
import roles from './admin/roles/routes'
import permissions from './admin/permissions/routes'
import teams from './admin/teams/routes'
import teamRoles from './admin/team-roles/routes'

export default [
    ...home,
    ...auth,
    ...roles,
    ...permissions,
    ...teams,
    ...teamRoles
]