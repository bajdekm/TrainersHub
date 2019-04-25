<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add New <i
                                class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Registered At</th>
                                <th>Modify</th>
                                <th>Preview</th>
                            </tr>
                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td v-if="user.roles.length === 0">N/A</td>
                                <td v-if="user.roles.length !== 0">{{user.roles[0].name | upText}}</td>
                                <td>{{user.created_at | myDate}}</td>
                                <td>
                                    <a href="#" @click="editModal(user)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteUser(user.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" @click.prevent="preview(user.id)">
                                        <i class="fas fa-user fa-fw"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card footer">
                        <pagination :data="users" @pagination-change-page="getResults"></pagination>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Edit New</h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                        <div class="form-group">
                            <label >Name</label>
                            <input v-model="form.name" type="text" name="name"
                                   placeholder="Name"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                            <div class="form-group">
                            <label >Surname</label>
                            <input v-model="form.surname" type="text" name="surname"
                                   placeholder="surname"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('surname') }">
                            <has-error :form="form" field="surname"></has-error>
                        </div>
                        <div class="form-group">
                            <label >Login</label>
                            <input v-model="form.login" type="text" name="login"
                                   placeholder="Login"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('login') }">
                            <has-error :form="form" field="login"></has-error>
                        </div>
                        <div class="form-group">
                            <label >Email</label>
                            <input v-model="form.email" type="email" name="email"
                                   placeholder="Email Address"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                            <div class="form-group">
                                <label >Birthdate</label>
                                <input v-model="form.birthdate" type="date" name="birthdate"
                                       placeholder="birthdate"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('birthdate') }">
                                <has-error :form="form" field="birthdate"></has-error>
                            </div>
                            <!--TODO: Move roles to single select on user without relation to roles in DB-->
<!--                        <div>
                            <label class="typo__label">Roles</label>
                            <multiselect v-model="form.roles" :options="options" :multiple="true"
                                         :close-on-select="false" :clear-on-select="false" :preserve-search="false"
                                         placeholder="Pick some" label="name" track-by="name"
                                         :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, isOpen }">
                                    <span class="multiselect__single" v-if="form.roles.length &amp;&amp; !isOpen">{{ form.roles.length }} options selected</span>
                                </template>
                            </multiselect>
                            <pre class="language-json">
                                <option v-for="option in form.roles" :key="option" :value="option.name" v-text="option.name" />
                            </pre>
                        </div>-->
                        <div class="form-group">
                            <label >Password</label>
                            <input v-model="form.password" type="password" name="password" id="password"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                        </div>
                            <div class="form-group">
                            <label >Description</label>
                            <textarea v-model="form.description" name="description" id="description"
                                  placeholder="Short description for user (Optional)"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                            <div class="form-group">
                            <label >Competences</label>
                            <textarea v-model="form.competences" name="competences" id="competences"
                                  placeholder="Short competences for user (Optional)"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('competences') }"></textarea>
                                <has-error :form="form" field="competences"></has-error>
                            </div>

                    </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editmode : false,
                users : {},
                options: [],
                roles: [],
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
                    picture: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            editModal(user) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            loadUsers: function loadUsers() {
                console.log('Load Users Start');
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/user").then(({ data }) => (
                        console.log('Users data: ',data),
                        this.users = data));
                }
            },
            loadRoles: function loadUsers() {
                console.log('Load Roles Start');
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/roles").then(({ data }) => (
                        this.options = data
                    ));
                }
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user')
                    .then(() => {
                        Fire.$emit('AfterCreate');
                        $('#addNew').modal('hide');
                        toast({
                            type: 'success',
                            title: 'User created successfully'
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {

                    });

            },
            updateUser(){
                var _this = this;
                this.$Progress.start();
                this.form.put('api/user/' + this.form.id).then(function () {
                    // success
                    $('#addNew').modal('hide');
                    swal('Updated!', 'Information has been updated.', 'success');
                    _this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                }).catch(function () {
                    _this.$Progress.fail();
                });
            },
            deleteUser(id){
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
                        this.form.delete('api/user/'+id).then(()=>{
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            Fire.$emit('AfterCreate');
                        }).catch(()=> {
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            },
            preview(id){
                this.$router.replace({name: 'user', params: { id: id } });
            }
        },
        created: function created() {
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findUser?q=' + query)
                    .then((data) => {
                        this.users = data.data
                    })
                    .catch(() => {
                    })
            });
            this.loadUsers();
            // this.loadRoles();
            Fire.$on('AfterCreate',() => {
                this.loadUsers();
                // this.loadRoles();
            });
        }
    }
</script>

<style scoped>

</style>
