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
                    <!--<div class="widget-user-header text-white">-->
                        <h3 class="widget-user-username">{{this.company.name}}</h3>
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
                            <li class="nav-item"><a class="nav-link" href="#gyms" data-toggle="tab">Gyms</a></li>
                            <li class="nav-item"><a class="nav-link" href="#trainers" data-toggle="tab">Trainers</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Preview Tab -->
                            <div class="tab-pane active show" id="preview">
                                <strong><i class="fas fa-dumbbell fa-fw"></i> Name</strong>
                                <p class="text-muted">
                                    {{this.company.name}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-envelope-square"></i> Description</strong>
                                <p class="text-muted">
                                    {{this.company.description}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-address-book"></i> Country</strong>
                                <p class="text-muted">
                                    {{this.company.country}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-address-book"></i> City</strong>
                                <p class="text-muted">
                                    {{this.company.city}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-address-book"></i> Street</strong>
                                <p class="text-muted">
                                    {{this.company.street}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-address-book"></i> Building number</strong>
                                <p class="text-muted">
                                    {{this.company.buildingNumber}}
                                </p>
                                <hr>
                                <strong><i class="fas fa-address-book"></i> Postal code</strong>
                                <p class="text-muted">
                                    {{this.company.postalCode}}
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
                                            <label >Description</label>
                                            <textarea v-model="form.description" name="description" id="description"
                                                      placeholder="Short description for Company (Optional)" @change="formChange"
                                                      class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                            <has-error :form="form" field="description"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label >Country</label>
                                            <input v-model="form.country" type="text" name="country"
                                                   placeholder="country" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('country') }">
                                            <has-error :form="form" field="country"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label >City</label>
                                            <input v-model="form.city" type="text" name="city"
                                                   placeholder="city" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('city') }">
                                            <has-error :form="form" field="city"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label >Street</label>
                                            <input v-model="form.street" type="text" name="street"
                                                   placeholder="street" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('street') }">
                                            <has-error :form="form" field="street"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label >BuildingNumber</label>
                                            <input v-model="form.buildingNumber" type="number" name="buildingNumber"
                                                   placeholder="buildingNumber" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('buildingNumber') }">
                                            <has-error :form="form" field="street"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label >Postal Code</label>
                                            <input v-model="form.postalCode" type="text" name="postalCode"
                                                   placeholder="postalCode" @change="formChange"
                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('postalCode') }">
                                            <has-error :form="form" field="postalCode"></has-error>
                                        </div>
                                        <div class="form-group">
                                            <label>Linked user</label>
                                            <div class="input-group mb-5">
                                                <input v-if="form.userName === undefined && form.user !== null"
                                                       v-model="form.user.name" type="text"
                                                       class="form-control" readonly
                                                       placeholder="Company" name="user_id" aria-describedby="append">
                                                <input v-if="form.userName !== undefined" v-model="form.userName" type="text"
                                                       class="form-control" readonly
                                                       placeholder="Company" name="user_id" aria-describedby="append">
                                                <div class="input-group-append">
                                                    <button v-if="form.user !== undefined && form.user !== null"
                                                            class="btn btn-success" type="button" @click.prevent="lookup">Change</button>
                                                    <button v-if="form.user === undefined || form.user === null"
                                                            class="btn btn-success" type="button" @click.prevent="lookup">Link user</button>
                                                </div>
                                                <has-error :form="form" field="user_id"></has-error>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="picture" class="col-sm-2 control-label">Company picture</label>
                                        <div class="col-sm-12">
                                            <input type="file" @change="fileChange" name="picture" class="form-input">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-12">
                                                <button type="button" v-show="isUpdateDisabled" disabled @click.prevent="updateCompany" class="btn btn-success">
                                                    Update
                                                </button>
                                                <button type="button" v-show="!isUpdateDisabled" @click.prevent="updateCompany" class="btn btn-success">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>

                            <div class="tab-pane" id="gyms">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Modify</th>
                                    </tr>
                                    <tr v-for="gym in gyms" :key="gym.id">
                                        <td><a href="#" @click.prevent="previewGym(gym.id)" style="color: black">
                                            {{gym.name}}
                                        </a></td>
                                        <td>{{gym.email}}</td>
                                        <td>{{gym.country}}</td>
                                        <td>{{gym.city}}</td>
                                        <td>
                                            <a href="#" @click.prevent="previewGym(gym.id)">
                                                <i class="fas fa-dumbbell fa-fw"></i>
                                            </a>
                                            /
                                            <a href="#" @click="deleteGym(gym.id)">
                                                <i class="fa fa-trash red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="trainers">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Description</th>
                                        <th>Competences</th>
                                        <th>Preview</th>
                                    </tr>
                                    <tr v-for="trainer in trainers" :key="trainer.id">
                                        <td><a href="#" @click.prevent="previewTrainer(trainer.id)" style="color: black">
                                            {{trainer.name}}
                                        </a></td>
                                        <td>{{trainer.surname}}</td>
                                        <td>{{trainer.description}}</td>
                                        <td>{{trainer.competences}}</td>
                                        <td>
                                            <a href="#" @click.prevent="previewTrainer(trainer.id)">
                                                <i class="fas fa-user fa-fw"></i>
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
                isGymEdit: false,
                trainer: {},
                company: {},
                gyms: {},
                trainers: {},
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
                    user_id: '',
                    userName: '',
                    user: {},
                    picture: ''
                })
            }
        },
        methods: {
            loadCompany: function loadGyms() {
                console.log('** Load company: '+this.id);
                if (this.$gate.isAdminOrAuthor()) {
                    let url = 'http://localhost:8000/api/company/'+this.id;
                    axios.get(url).then(({data}) => (
                        console.log('** company: ',data),
                            this.company = data,
                            this.fillForm()));
                }
            },
            fillForm() {
                let company = this.company;
                this.user = company.user;
                this.gyms = company.gyms;
                this.trainers = company.trainers;
                this.form.fill(company);
            },
            updateCompany() {
                var _this = this;
                this.$Progress.start();
                this.form.put('http://localhost:8000/api/company/' + this.id).then(function () {
                    swal('Updated!', 'Information has been updated.', 'success');
                    _this.$Progress.finish();
                    // success
                    _this.isUpdateDisabled = true;
                    Fire.$emit('CompanyChange');
                }).catch(function () {
                    _this.$Progress.fail();
                });

            },
            deleteGym(id) {
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
                        this.form.delete('http://localhost:8000/api/gym/' + id).then(() => {
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                        }).catch(() => {
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })

            },
            lookup(){
                this.showLookup = true;
                setTimeout(() => {
                    $('#lookupModal').modal('show');
                    Fire.$emit('lookupEvt', 'user','Company',this._uid);
                }, 350);
            },
            onLookupUserUpdate(id) {
                $('#lookupModal').modal('hide');
                this.showLookup = false;
                if(this.form.user_id !== id) {
                    this.isUpdateDisabled = false;
                    this.form.user_id = id;
                    this.setUserNameById(id);
                }
            },
            setUserNameById(id){
                axios.get('http://localhost:8000/api/user/'+id)
                    .then((data) => {
                        console.log('** setUserNameById: name: ',data.data);
                        this.form.userName = data.data.name;
                    })
                    .catch(() => {
                    });
            },
            formChange() {
                this.isUpdateDisabled = false;
            },
            previewGym(id) {
                this.$router.replace({name: 'gym', params: { id: id } });
            },
            previewTrainer(id) {
                this.$router.replace({name: 'trainer', params: { id: id } });
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
            },
            getProfilePicture() {
                if(this.form.picture !== null && this.form.picture !== undefined) {
                    let picture = (this.form.picture.length > 200) ? this.form.picture : "http://localhost:8000/img/company/"+ this.form.picture ;
                    return picture;
                }
            }
        },
        created: function created() {
            console.log('** Company created: '+this._uid);
            this.loadCompany();
            Fire.$on('CompanyChange', () => {
                this.loadCompany();
            });
            Fire.$on('lookupEvtChosen', (id,componentName, index, apiName) => {
                if(index.toString() === this._uid.toString() && componentName !== undefined && componentName === 'Company'){
                    if(apiName === 'user') {
                        this.onLookupUserUpdate(id);
                    }
                }
            });
        },
        beforeDestroy() {
            DestroyedComponents.push(this._uid);
            Fire.$off('CompanyChange');
            console.log('** Company destroyed: '+this._uid);
        }
    }
</script>

<style scoped>

</style>
