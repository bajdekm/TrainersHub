<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Companies Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add New <i
                                class="fas fa-building fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Owner</th>
                                <th>Registered At</th>
                                <th>Modify</th>
                            </tr>
                            <tr v-for="company in companies.data" :key="company.id">
                                <td>{{company.id}}</td>
                                <td>{{company.name}}</td>
                                <td>{{company.country}}</td>
                                <td>{{company.city}}</td>
                                <td v-if="company.user !== null">{{company.user.name}}</td>
                                <td v-if="company.user === null">N/A</td>
                                <td>{{company.created_at | myDate}}</td>
                                <td>
                                    <a href="#" @click="editModal(company)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteCompany(company.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" @click.prevent="preview(company.id)">
                                        <i class="fas fa-user fa-fw"></i>
                                    </a>
                                    <!--<router-link v-bind:to="'/gym/'+gym.id" replace>Go</router-link>-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card footer">
                        <pagination :data="companies" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add Company</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateCompany() : createCompany()">
                        <div class="modal-body">
                        <div class="form-group">
                            <label >Name</label>
                            <input v-model="form.name" type="text" name="name"
                                   placeholder="Name"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                            <div class="form-group">
                            <label >Description</label>
                            <textarea v-model="form.description" name="description" id="description"
                                      placeholder="Short description for Company (Optional)"
                                      class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                            <has-error :form="form" field="description"></has-error>
                        </div>
                        <div class="form-group">
                            <label >Country</label>
                            <input v-model="form.country" type="text" name="country"
                                   placeholder="country"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('country') }">
                            <has-error :form="form" field="country"></has-error>
                        </div>
                        <div class="form-group">
                            <label >City</label>
                            <input v-model="form.city" type="text" name="city"
                                   placeholder="city"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('city') }">
                            <has-error :form="form" field="city"></has-error>
                        </div>
                        <div class="form-group">
                            <label >Street</label>
                            <input v-model="form.street" type="text" name="street"
                                   placeholder="street"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('street') }">
                            <has-error :form="form" field="street"></has-error>
                        </div>
                        <div class="form-group">
                            <label >BuildingNumber</label>
                            <input v-model="form.buildingNumber" type="number" name="buildingNumber"
                                   placeholder="buildingNumber"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('buildingNumber') }">
                            <has-error :form="form" field="street"></has-error>
                        </div>
                        <div class="form-group">
                            <label >Postal Code</label>
                            <input v-model="form.postalCode" type="text" name="postalCode"
                                   placeholder="postalCode"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('postalCode') }">
                            <has-error :form="form" field="postalCode"></has-error>
                        </div>
                        <div class="form-group">
                            <label >User Id</label>
                            <input v-model="form.user_id" type="text" name="user_id"
                                   placeholder="user id"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }">
                            <has-error :form="form" field="user_id"></has-error>
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
                companies : {},
                options: [],
                roles: [],
                form: new Form({
                    id : '',
                    name : '',
                    description : '',
                    photo : '',
                    country: '',
                    city: '',
                    street: '',
                    buildingNumber: '',
                    postalCode: '',
                    user_id: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/company?page=' + page)
                    .then(response => {
                        this.companies = response.data;
                    });
            },
            editModal(company) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(company);
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            loadCompanies: function loadCompanies() {
                console.log('Load Companies Start');
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/company").then(({ data }) => (
                        this.companies = data));
                }
            },
            createCompany(){
                this.$Progress.start();
                this.form.post('api/company')
                    .then(() => {
                        Fire.$emit('AfterCreate');
                        $('#addNew').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Company created successfully'
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {

                    });

            },
            updateCompany(){
                var _this = this;
                this.$Progress.start();
                this.form.put('api/company/' + this.form.id).then(function () {
                    // success
                    $('#addNew').modal('hide');
                    swal('Updated!', 'Information has been updated.', 'success');
                    _this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                }).catch(function () {
                    _this.$Progress.fail();
                });
            },
            deleteCompany(id){
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
                        this.form.delete('api/company/'+id).then(()=>{
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
                this.$router.replace({name: 'company', params: { id: id } });
            }
        },
        created: function created() {
            console.log('Created');
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findCompany?q=' + query)
                    .then((data) => {
                        this.companies = data.data
                    })
                    .catch(() => {
                    })
            });
            this.loadCompanies();
            Fire.$on('AfterCreate',() => {
                this.loadCompanies();
            });
        }
    }
</script>

<style scoped>

</style>
