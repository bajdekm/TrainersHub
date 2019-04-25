export default class Gate {


    constructor(authRole,userId) {
        this.authRole = authRole;
        this.userId = userId;
    }


    isAdmin() {
        if(this.authRole === null || this.authRole == undefined)
            return false;
        return this.authRole.includes('admin');
    }


    isUser(){
        if(this.authRole === null || this.authRole == undefined)
            return false;
        return this.authRole.includes('user');
    }

    isTrainer(){
        if(this.authRole === null || this.authRole == undefined)
            return false;
        return this.authRole.includes('trainer');
    }
    isTrainerOrUser() {
        if(this.authRole === null || this.authRole == undefined)
            return false;
        if(this.authRole.includes('user') || this.authRole.includes('trainer')){
            return true;
        }
    }
    isTrainerOrAdmin() {
        if(this.authRole === null || this.authRole == undefined)
            return false;
        if(this.authRole.includes('admin') || this.authRole.includes('trainer')){
            return true;
        }
    }
    isUserOrTrainerOrAdmin() {
        if(this.authRole === null || this.authRole == undefined)
            return false;
        if(this.authRole.includes('user') || this.authRole.includes('admin') || this.authRole.includes('trainer')){
            return true;
        }
    }
    isAdminOrAuthor(){
        if(this.authRole === null || this.authRole == undefined)
            return false;
        if(this.authRole.includes('admin') || this.authRole.includes('author')){
            return true;
        }
    }
    isAuthorOrUser() {
        if(this.authRole === null || this.authRole == undefined)
            return false;
        if(this.authRole.includes('user') || this.authRole.includes('author')){
            return true;
        }
    }
    getAuthUserId(){
        return this.userId;
    }

}
