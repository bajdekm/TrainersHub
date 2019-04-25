<style scoped>

</style>
<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="col-lg-12 py-1" >
                    <h2 class="text-center">Twój profil</h2>
                </div>
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active show" href="#edit-data" data-toggle="tab">Zmień Dane</a></li>
                            <li class="nav-item"><a class="nav-link" href="#change-password" data-toggle="tab">Zmień Hasło</a></li>
                            <li class="nav-item"><a class="nav-link" href="#delete-account" data-toggle="tab">Usuń Konto</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="edit-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 personal-info">
                                            <h3>Personal info</h3>
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">First name:</label>
                                                    <div class="col-md-8">
                                                        <input type="text" v-model="form.name" class="form-control" id="inputFirstName" placeholder="First Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Last name:</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" v-model="form.surname" class="form-control" id="inputSurname" placeholder="Surname" :class="{ 'is-invalid': form.errors.has('surname') }">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Email:</label>
                                                    <div class="col-lg-8">
                                                        <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email" :class="{ 'is-invalid': form.errors.has('email') }">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Birthdate:</label>
                                                    <div class="col-lg-8">
                                                        <input type="date" v-model="form.birthdate" class="form-control" id="inputBirthdate" placeholder="Birthdate" :class="{ 'is-invalid': form.errors.has('birthdate') }">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Country:</label>
                                                    <div class="col-lg-8">
                                                        <input type="text" v-model="form.country" class="form-control" id="inputCountry" placeholder="Country" :class="{ 'is-invalid': form.errors.has('country') }">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">City:</label>
                                                    <div class="col-md-8">
                                                        <input type="text" v-model="form.city" class="form-control" id="inputCity" placeholder="City" :class="{ 'is-invalid': form.errors.has('city') }">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"></label>
                                                    <div class="col-md-8">
                                                        <input type="button" class="btn btn-primary" value="Save Changes" @click.prevent="updateUser">
                                                        <span></span>
                                                        <input type="reset" class="btn btn-default" value="Cancel">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="change-password">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 personal-info">
                                            <h3>Profil użytkownika</h3>
                                            <form class="form-horizontal" role="form">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Stare Hasło:</label>
                                                    <div class="col-md-8">
                                                        <input type="password" v-model="form.password" class="form-control" id="oldPassword" ref="oldpassword" placeholder="Old Password" :class="{ 'is-invalid': form.errors.has('password') }">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Nowe Hasło:</label>
                                                    <div class="col-md-8">
                                                        <input type="password" v-model="form.newpassword" class="form-control" id="inputPassword" ref="password" placeholder="Password" :class="{ 'is-invalid': form.errors.has('password') }">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Potwierdź Hasło:</label>
                                                    <div class="col-md-8">
                                                        <input type="password" class="form-control" id="inputPasswordAgain" ref="password2" placeholder="Reapeat Password" :class="{ 'is-invalid': form.errors.has('password') }">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"></label>
                                                    <div class="col-md-8">
                                                        <input type="button" class="btn btn-primary" value="Zmień Hasło" @click.prevent="changePassword">
                                                        <span></span>
                                                        <input type="reset" class="btn btn-default" value="Anuluj">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="delete-account">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 personal-info">
                                            <h3>Usuwanie konta</h3>
                                            <form class="form-horizontal" role="form">
                                                <p>Usunięcie konta jest nieodwracalne. Rozpoczętej operacji nie można cofnąć</p>

                                                <div class="col-md-8">
                                                    <input type="password" v-model="password" class="form-control" id="passwordConfirmation" ref="passwordConfirmation" placeholder="Wpisz hasło dla potwierdzenia">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"></label>
                                                    <div class="col-md-8">
                                                        <input type="button" class="btn btn-primary" value="Usuń Konto" @click.prevent="deleteUser" :disabled=isDisabled>
                                                        <span></span>
                                                        <input type="reset" class="btn btn-default" value="Anuluj">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</template>
<script>
    export default {
        name: "Profile",
        data(){
            return {
                authUserId: '',
                user: {},
                trainer: {},
                password: '',
                roles: {},
                form: new Form({
                    id: '',
                    login: '',
                    password : '',
                    newpassword : '',
                    name : '',
                    surname: '',
                    email: '',
                    birthdate: '',
                    country: '',
                    city: ''
                })
            }
        },
        created: function created(){
            console.log('Profile created: '+this._uid);
            this.authUserId = this.$gate.getAuthUserId();
            this.retrieveUser();
        },
        computed: {
            isDisabled(){
                return this.password.length < 5;
            }
        },
        beforeDestroy(){
            DestroyedComponents.push(this._uid);
            Fire.$off('UserChange');
        },
        methods: {
            retrieveUser() {
                console.log('retrieveUser');
                if (this.$gate.isUser() || this.$gate.isAdmin()) {
                    console.log('in');
                    let url = 'http://localhost:8000/api/user-profile?id='+this.authUserId;
                    axios.get(url).then(({data}) => (
                        this.user = data,
                        console.log('profile: ',data),
                        this.fillForm()
                    ));
                }
            },
            fillForm(){
                let user = this.user;
                this.roles = user.roles;
                this.trainer = user.trainer;
                this.form.fill(user);
            },
            updateUser(){
                var _this = this;
                this.$Progress.start();
                this.form.put('http://localhost:8000/api/user-profile/' + this.authUserId).then(function () {
                    swal('Updated!', 'Information has been updated.', 'success');
                    _this.$Progress.finish();
                    Fire.$emit('UserChange');
                }).catch(function () {
                    _this.$Progress.fail();
                });
            },
            removeUser(){
                var _this = this;
                window.open('/user-remove/' + this.user.id ,'_self');
            },
            deleteUser() {

                swal({
                    title: 'Na pewno chcesz to zrobić?',
                    text: "Tej operacji nie da się cofnąć!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tak,usuń!'
                }).then((result) => {
                    if (result.value) {
                        axios.post('/api/user-profile-check-password', {
                            id: this.authUserId,
                            password: this.password
                        })
                            .then(function (response) {
                                if('ok' == response.data.message ){
                                swal('Success!', 'Konto usunięte, za chwilę nastąpi wylogowanie', 'success');
                                    setTimeout(function () {
                                       window.open('http://localhost:8000/user-logout/' ,'_self');
                                    }, 4000);

                                } else if ('ko' == response.data.message){
                                    swal('Error!', 'Hasło się nie zgadza', 'error');
                                }
                            })
                            .catch(function (error) {
                                console.log('## error %O',error);
                            });
                    }
                })

            },

            changePassword(){
                var _this = this;
                if ( (this.$refs.password.value == null || this.$refs.password.value == undefined
                    && (this.$refs.oldpassword == null || this.$refs.oldpassword != this.$refs.password))
                    || (this.$refs.password.value != this.$refs.password2.value) ){
                    swal('Warning!', 'Sprawdź czy podane hasła są takie same', 'warning');
                } else {
                    axios.post('/api/user-profile-password', {
                        id: this.authUserId,
                        newpassword: this.form.newpassword,
                        password: this.form.password
                    })
                        .then(function (response) {
                            if('Password does not match' == response.data.message ){
                                swal('Error!', 'Hasła nie pasują do siebie', 'error');
                            } else{
                                swal('Success!', 'Hasło zaktualizowane', 'success');
                            }
                        })
                        .catch(function (error) {
                            console.log('## error %O',error);
                        });
                }
            }
        }
    }
</script>
