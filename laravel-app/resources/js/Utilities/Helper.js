import { Role } from '@/Utilities/Constants.js';
import { constant } from 'lodash';

export function checkAllowActive(userRoles, action) {
  
    if (userRoles.length == 0) {
        return false;
    }

    //Check user has role view
    var resultFind = userRoles.find(item => item.role_id == Role.View);
    if (resultFind) {
        return false;
    }

    //Check user is admin
    var resultFindAdmin = userRoles.find(item => item.role_id == Role.Administrator);
    if (resultFindAdmin) {
        return true;
    }

    let active = false;
    let route_current = route().current();
    switch (route_current) {
        case 'foods.index':
            active = foodPage(userRoles, action)
            break;
        default:
            break;
    }

    return active;
}

//Page foods
const foodPage = (userRoles, action) => {
    var active = false;
    switch (action) {
        case 'Add_Food':
            var resultFind = userRoles.find(item => item.role_id == Role.Creator)
            if (resultFind)
                active = true;
            break;
        case 'Edit_Food':
            var resultFind = userRoles.find(item => item.role_id == Role.Editor)
            if (resultFind)
                active = true;
            break;
        case 'Delete_Food':
            var resultFind = userRoles.find(item => item.role_id == Role.Deleter)
            if (resultFind)
                active = true;
            break;
        default:
            break;
    }

    return active;
}