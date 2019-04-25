<style>
    .widget-user-header{
        background-position: center center;
        background-size: cover;
        height: 200px !important;
    }
    .widget-user .card-footer{
        padding: 0;
    }

</style>
<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background-image:url('http://localhost:8000/img/sport-background.jpg')">
                        <h3 class="widget-user-username">{{this.form.name}}</h3>
                        <!--<h5 class="widget-user-desc">{{this.form.type}}</h5>-->
                    </div>
                    <div class="widget-user-image">
                        <img v-if="this.form.picture !== null && this.form.picture !== undefined" class="img-circle" :src="getProfilePicture()" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>

            <!-- tab -->

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active show" href="#preview" data-toggle="tab">Preview</a></li>
                            <li class="nav-item"><a class="nav-link" href="#edit" data-toggle="tab">Edit</a></li>
                            <li class="nav-item"><a class="nav-link" href="#roles" data-toggle="tab">Roles</a></li>
                            <li class="nav-item"><a class="nav-link" href="#reservations" data-toggle="tab">Reservations</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Preview Tab -->
                            <div class="tab-pane active show" id="preview">
                                <strong><i class="fas fa-dumbbell fa-fw"></i> Name</strong>
                                <p class="text-muted">
                                    {{this.user.name}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-envelope-square"></i> Surname</strong>
                                <p class="text-muted">
                                    {{this.user.surname}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-envelope-square"></i> Login</strong>
                                <p class="text-muted">
                                    {{this.user.login}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-user-circle"></i> Site</strong>
                                <p class="text-muted">
                                    {{this.user.site}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-envelope-square"></i> Email</strong>
                                <p class="text-muted">
                                    {{this.user.email}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-envelope-square"></i> Register origin</strong>
                                <p class="text-muted">
                                    {{this.user.register_origin}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-envelope-square"></i> Birthdate</strong>
                                <p class="text-muted">
                                    {{this.user.birthdate}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-envelope-square"></i> Description</strong>
                                <p class="text-muted">
                                    {{this.user.description}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-building fa-fw"></i> Competences</strong>
                                <p class="text-muted">
                                    {{this.user.competences}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-envelope-open"></i> Mail Verified at</strong>
                                <p class="text-muted">
                                    {{this.user.email_verified_at}}
                                </p>
                                <hr>
                            </div>
                            <!-- Details Tab -->
                            <div class="tab-pane" id="edit">
                                <form class="form-horizontal">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label >Name</label>
                                            <input v-model="form.name" type="text" name="name"
                                                   placeholder="Name" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label >Surname</label>
                                            <input v-model="form.surname" type="text" name="surname"
                                                   placeholder="surname" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('surname') }">
                                            <has-error :form="form" field="surname"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label >Login</label>
                                            <input v-model="form.login" type="text" name="login"
                                                   placeholder="Login" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('login') }">
                                            <has-error :form="form" field="login"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label >Site</label>
                                            <input v-model="form.site" type="text" name="site"
                                                   placeholder="Site" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('site') }">
                                            <has-error :form="form" field="site"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label >Register origin</label>
                                            <input v-model="form.register_origin" type="text" name="register_origin"
                                                   placeholder="Register origin" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('register_origin') }">
                                            <has-error :form="form" field="register_origin"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label >Email</label>
                                            <input v-model="form.email" type="email" name="email"
                                                   placeholder="Email Address" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label >Birthdate</label>
                                            <input v-model="form.birthdate" type="date" name="birthdate"
                                                   placeholder="birthdate" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('birthdate') }">
                                            <has-error :form="form" field="birthdate"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="picture" class="col-sm-2 control-label">Company picture</label>
                                        <div class="col-sm-12">
                                            <input type="file" @change="fileChange" name="picture" class="form-input">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" v-show="isUpdateDisabled" disabled @click.prevent="updateUser" class="btn btn-success">
                                            Update
                                        </button>
                                        <button type="button" v-show="!isUpdateDisabled" @click.prevent="updateUser" class="btn btn-success">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="roles">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Delete</th>
                                    </tr>
                                    <tr v-for="role in roles" :key="role.id">
                                        <td>{{role.name}}</td>
                                        <td>
                                            <a href="#" @click="deleteRole(role.id)">
                                                <i class="fa fa-trash red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#" @click.prevent="addRole()">
                                            Add new role
                                        </a></td>
                                        <td>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="reservations">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th>Trainer</th>
                                        <th>Approved by me</th>
                                        <th>Approved by trainer</th>
                                        <th>Training start</th>
                                        <th>Gym</th>
                                        <th>Was training realized</th>
                                        <th>Preview</th>
                                    </tr>
                                    <tr v-for="reservation in reservations" :key="reservation.id">
                                        <td>{{reservation.trainer.name}}</td>
                                        <td v-if="reservation.isApprovedByUser === 1">
                                            <i class="fas fa-check"></i>
                                        </td>
                                        <td v-if="reservation.isApprovedByUser === 0"></td>
                                        <td v-if="reservation.isApprovedByTrainer === 1">
                                            <i class="fas fa-check"></i>
                                        </td>
                                        <td v-if="reservation.isApprovedByTrainer === 0"></td>
                                        <td>{{reservation.trainingStart | myDateTime}}</td>
                                        <td>{{reservation.gym.name}}</td>
                                        <td v-if="reservation.wasTrainingRealized === 1">
                                            <i class="fas fa-check"></i>
                                        </td>
                                        <td v-if="reservation.wasTrainingRealized === 0"></td>
                                        <td>
                                            <a href="#">
                                                Go
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- Modal lookup -->
        <div v-if="showLookup" class="modal fade" id="lookupModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <lookup></lookup>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-primary" @click="lookupBack">Back</button>-->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- end tabs -->
    </div>
</template>

<script>

    export default {
        data() {
            return {
                id: this.$route.params.id,
                showLookup: false,
                isUpdateDisabled: true,
                isDisciplineEdit: false,
                user: {},
                disciplineId: 0,
                counter: 0,
                price: 0,
                company: {},
                trainer: {},
                roles: {},
                gyms: {},
                reservations: {},
                form: new Form({
                    id : '',
                    name : '',
                    surname : '',
                    login : '',
                    site : '',
                    register_origin : '',
                    email: '',
                    birthdate: '',
                    password: '',
                    roles: {},
                    description: '',
                    competences: '',
                    picture: ''
                })
            }
        },
        methods: {
            loadUser: function loadGyms() {
                console.log('** Load User: '+this.id);
                if (this.$gate.isAdminOrAuthor()) {
                    let url = 'http://localhost:8000/api/user/'+this.id;
                    axios.get(url).then(({data}) => (
                        console.log('** user: ',data),
                            this.user = data,
                            this.fillForm()));
                }
            },
            fillForm() {
                let user = this.user;
                this.roles = user.roles;
                this.reservations = user.reservations;
                this.form.fill(user);
            },
            updateUser() {
                var _this = this;
                this.$Progress.start();
                this.form.put('http://localhost:8000/api/user/' + this.id).then(function () {
                    swal('Updated!', 'Information has been updated.', 'success');
                    _this.$Progress.finish();
                    // success
                    _this.isUpdateDisabled = true;
                    Fire.$emit('UserChange');
                }).catch(function () {
                    _this.$Progress.fail();
                });

            },
            deleteRole(id) {
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        let url = 'http://localhost:8000/api/detachRole?roleId='+id+'&userId='+this.id;
                        axios.get(url).then(({data}) => (
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ),Fire.$emit('UserChange')
                        )).catch(()=>{
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })

            },
            addRole() {
                this.showLookup = true;
                setTimeout(() => {
                    $('#lookupModal').modal('show');
                    Fire.$emit('lookupEvt', 'role','User',this._uid);
                }, 350);
            },
            onLookupRoleUpdate(id) {
                $('#lookupModal').modal('hide');
                this.showLookup = false;
                let _self = this;
                console.log('** onLookupRoleUpdate: '+id);
                let url = 'http://localhost:8000/api/attachRole?roleId='+id+'&userId='+this.id;
                axios.get(url).then(({data}) => (
                    _self.doAfterRoleAdded(data)
                )).catch(()=>{
                    swal("Failed!", "There was something wrong.", "warning");
                });
            },
            doAfterRoleAdded(data) {
                if(data.message !== null && data.message !== undefined){
                    swal(
                        'Exist!',
                        data.message,
                        'warning'
                    );
                } else {
                    swal(
                        'Added!',
                        'New role has been added.',
                        'success'
                    );
                }
                Fire.$emit('UserChange');
            },
            formChange() {
                this.isUpdateDisabled = false;
            },
            getProfilePicture(){
                if(this.form.picture !== null && this.form.picture !== undefined) {
                    let picture = (this.form.picture.length > 200) ? this.form.picture : "http://localhost:8000/img/profile/"+ this.form.picture ;
                    return picture;
                }
            },
            fileChange(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    });
                    return false;
                }
                reader.onloadend = (file) => {
                    this.form.picture = reader.result;
                    this.formChange();
                };
                reader.readAsDataURL(file);
            }
        },
        created: function created() {
            console.log('** User created: '+this._uid);
            this.loadUser();
            Fire.$on('UserChange', () => {
                this.loadUser();
            });
            Fire.$on('lookupEvtChosen', (id,componentName, index, apiName) => {
                if(index.toString() === this._uid.toString() && componentName !== undefined && componentName === 'User'){
                    if(apiName === 'role') {
                        this.onLookupRoleUpdate(id);
                    } else if(apiName === 'discipline') {
                        this.onLookupDisciplineUpdate(id);
                    }
                }
            });
        },
        beforeDestroy() {
            DestroyedComponents.push(this._uid);
            Fire.$off('UserChange');
            console.log('** User destroyed: '+this._uid);
        }
    }
</script>

<style scoped>

</style>
