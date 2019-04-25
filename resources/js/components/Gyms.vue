<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gyms Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add New <i
                                class="fas fa-dumbbell fa-fw"></i></button>
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
                                <th>Country</th>
                                <th>City</th>
                                <th>Company</th>
                                <th>Registered At</th>
                                <th>Modify</th>
                                <th>Preview</th>
                            </tr>
                            <tr v-for="gym in gyms.data" :key="gym.id">
                                <td>{{gym.id}}</td>
                                <td>{{gym.name}}</td>
                                <td>{{gym.email}}</td>
                                <td>{{gym.country}}</td>
                                <td>{{gym.city}}</td>
                                <td v-if="gym.company !== null">{{gym.company.name}}</td>
                                <td v-if="gym.company == null">N/A</td>
                                <td>{{gym.created_at | myDate}}</td>
                                <td>
                                    <a href="#" @click="editModal(gym)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteGym(gym.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                                <td>
                                   <a href="#" @click.prevent="preview(gym.id)">
                                        <i class="fas fa-dumbbell fa-fw"></i>
                                    </a>
                                    <!--<router-link v-bind:to="'/gym/'+gym.id" replace>Go</router-link>-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card footer">
                        <pagination :data="gyms" @pagination-change-page="getResults"></pagination>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>
        <div class="modal fade" id="addNew" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Edit New</h5>
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add Gym</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateGym() : createGym()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.name" type="text" name="name"
                                       placeholder="Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input v-model="form.email" type="email" name="email"
                                       placeholder="Email Address"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea v-model="form.description" name="description" id="description"
                                          placeholder="Short description for gym (Optional)"
                                          class="form-control"
                                          :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <label>country</label>
                                <input v-model="form.country" type="text" name="country"
                                       placeholder="Country"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('country') }">
                                <has-error :form="form" field="country"></has-error>
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <input v-model="form.city" type="text" name="city"
                                       placeholder="city"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('city') }">
                                <has-error :form="form" field="city"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Street</label>
                                <input v-model="form.street" type="text" name="street"
                                       placeholder="street"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('street') }">
                                <has-error :form="form" field="street"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Building Number</label>
                                <input v-model="form.buildingNumber" type="text" name="buildingNumber"
                                       placeholder="Building number"
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('buildingNumber') }">
                                <has-error :form="form" field="street"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input v-model="form.postalCode" type="text" name="postalCode"
                                       placeholder="postalCode"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('postalCode') }">
                                <has-error :form="form" field="postalCode"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Company</label>
                                <div class="input-group mb-5">
                                    <input v-if="form.companyName === undefined && form.company !== null"
                                           v-model="form.company.name" type="text"
                                           class="form-control" readonly
                                           placeholder="Company" name="company_id" aria-describedby="append">
                                    <input v-if="form.companyName !== undefined" v-model="form.companyName" type="text"
                                           class="form-control" readonly
                                           placeholder="Company" name="company_id" aria-describedby="append">
                                    <div class="input-group-append">
                                        <button v-if="form.company !== null" class="btn btn-success" type="button" @click="lookup">Change</button>
                                    </div>
                                    <button v-if="form.company === null" class="btn btn-success" type="button" @click="lookup">Set Company</button>
                                    <has-error :form="form" field="company_id"></has-error>
                                </div>
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

        <!-- Modal -->
        <div class="modal fade" id="lookupModal" tabindex="-1">
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
                            <button type="button" class="btn btn-primary" @click="lookupBack">Back</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                gyms: {},
                companies:{},
                options: [],
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    description: '',
                    country: '',
                    city: '',
                    street: '',
                    buildingNumber: '',
                    postalCode: '',
                    hasOwner: '',
                    company_id: '',
                    company: {},
                    companyName: '',
                    formattedAddress: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/gym?page=' + page)
                    .then(response => {
                        this.gyms = response.data;
                    });
            },
            editModal(gym) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(gym);
                console.log('FORM: ',this.form);
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            loadGym: function loadGym() {
                console.log('## Load Gym Start');
                if (this.$gate.isAdminOrAuthor()) {
                    axios.get("api/gym").then(({data}) => (
                        this.gyms = data));
                }
            },
            createGym() {
                let _self = this;
                this.$Progress.start();
                this.form.post('api/gym')
                    .then(() => {
                        Fire.$emit('GymsChange',_self._uid);
                        $('#addNew').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Gym created successfully'
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {

                    });

            },
            updateGym() {
                let _this = this;
                this.$Progress.start();
                this.form.put('api/gym/' + this.form.id).then(function () {
                    // success
                    $('#addNew').modal('hide');
                    swal('Updated!', 'Information has been updated.', 'success');
                    console.log('## in updated');
                    _this.$Progress.finish();
                    Fire.$emit('GymsChange',_this._uid);
                }).catch(function () {
                    _this.$Progress.fail();
                });
            },
            deleteGym(id) {
                let _self = this;
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
                        this.form.delete('api/gym/' + id).then(() => {
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            Fire.$emit('GymsChange',_self._uid);
                        }).catch(() => {
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            },
            lookup() {
                console.log('Lookup open');
                $('#addNew').modal('hide');
                setTimeout(() => {
                    $('#lookupModal').modal('show');
                }, 350);
                Fire.$emit('lookupEvt', 'company','Gyms',this._uid);

            },
            loadCompanies() {
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/company").then(({ data }) => (
                        this.companies = data));
                }
            },
            setCompanyNameByCompanyId(id){
                console.log('## gyms setCompanyNameByCompanyId');
                axios.get('http://localhost:8000/api/company/' + id)
                    .then((data) => {
                        this.form.companyName = data.data.name;
                    })
                    .catch(() => {
                    });
            },
            lookupBack(){
                $('#lookupModal').modal('hide');
                setTimeout(() => {
                    $('#addNew').modal('show');
                }, 350);
            },
            onLookupUpdate(id) {
                console.log('## gyms onLookupUpdate');
                this.lookupBack();
                this.form.company_id = id;
                this.setCompanyNameByCompanyId(id);
            },
            preview(id){
                // Fire.$emit('gymPreviewEvt', id);
                this.$router.replace({name: 'gym', params: { id: id } });
            }
        },
        created: function created() {
            console.log('## Gyms created: ',this._uid);
            Fire.$on('searching', () => {
                console.log('gyms search on');
                let query = this.$parent.search;
                axios.get('api/findGym?q=' + query)
                    .then((data) => {
                        this.gyms = data.data
                    })
                    .catch(() => {
                    })
            });
            Fire.$on('lookupEvtChosen', (id,componentName,index) => {
                if(index.toString() === this._uid.toString() && componentName !== undefined && componentName === 'Gyms'){
                    this.onLookupUpdate(id);
                }
            });
            this.loadGym();
            this.loadCompanies();
            Fire.$on('GymsChange', (index) => {
                    if(index.toString() === this._uid.toString()){
                        this.loadGym();
                    }
            });
        },
        destroyed() {
            DestroyedComponents.push(this._uid);
            console.log('## Gyms destroyed: '+this._uid);
            Fire.$off('lookupEvt', 'company','Gyms',this._uid);
            Fire.$off('GymChange',this._uid);
        }
    }
</script>

<style scoped>

</style>
