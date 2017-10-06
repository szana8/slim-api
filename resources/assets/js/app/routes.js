import auth from './auth/routes'
import home from './home/routes'
import error from './errors/routes'
import teams from './admin/teams/routes'
import roles from './admin/roles/routes'
import teamRoles from './admin/team-roles/routes'
import permissions from './admin/permissions/routes'

export default [
    ...home,
    ...auth,
    ...roles,
    ...permissions,
    ...teams,
    ...teamRoles,
    ...error,
]