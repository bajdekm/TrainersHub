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

            <div class="container-fluid">

                <div class="row">


                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active show" href="#preview" data-toggle="tab">Preview</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#edit" data-toggle="tab">Edit</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#facilities" data-toggle="tab">Facilities</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#reservations" data-toggle="tab">Reservations</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="preview">
                                            <div class="col-md-4">
                                                <strong><i class="fas fa-dumbbell fa-fw"></i> Gym Name</strong>
                                                <p class="text-muted">
                                                    {{this.gym.name}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-envelope-square"></i> Email</strong>
                                                <p class="text-muted">
                                                    {{this.gym.email}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-envelope-square"></i> Description</strong>
                                                <p class="text-muted">
                                                    {{this.gym.description}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-building fa-fw"></i> Owner</strong>
                                                <p v-if="company !== undefined && company !== null" class="text-muted">
                                                    {{this.company.name}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-address-book"></i> Country</strong>
                                                <p class="text-muted">
                                                    {{this.gym.country}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-address-book"></i> City</strong>
                                                <p class="text-muted">
                                                    {{this.gym.city}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-address-book"></i> Street</strong>
                                                <p class="text-muted">
                                                    {{this.gym.street}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-address-book"></i> Building number</strong>
                                                <p class="text-muted">
                                                    {{this.gym.buildingNumber}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-address-book"></i> Postal code</strong>
                                                <p class="text-muted">
                                                    {{this.gym.postalCode}}
                                                </p>
                                                <hr>
                                            </div>
                                        <!-- Preview Tab -->


                                        </div>
                                        <!-- Details Tab -->
                                        <div class="tab-pane" id="edit">
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input v-model="form.name" @change="formChange" type="text" name="name"
                                                           placeholder="Name"
                                                           class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                                    <has-error :form="form" field="name"></has-error>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input v-model="form.email" @change="formChange" type="email" name="email"
                                                           placeholder="Email Address"
                                                           class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                                    <has-error :form="form" field="email"></has-error>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea v-model="form.description" @change="formChange" name="description" id="description"
                                                              placeholder="Short description for gym (Optional)"
                                                              class="form-control"
                                                              :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                                    <has-error :form="form" field="description"></has-error>
                                                </div>
                                                <div class="form-group">
                                                    <label>country</label>
                                                    <input v-model="form.country" @change="formChange" type="text" name="country"
                                                           placeholder="surname"
                                                           class="form-control" :class="{ 'is-invalid': form.errors.has('country') }">
                                                    <has-error :form="form" field="country"></has-error>
                                                </div>
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input v-model="form.city" @change="formChange" type="text" name="city"
                                                           placeholder="city"
                                                           class="form-control" :class="{ 'is-invalid': form.errors.has('city') }">
                                                    <has-error :form="form" field="city"></has-error>
                                                </div>
                                                <div class="form-group">
                                                    <label>Street</label>
                                                    <input v-model="form.street" @change="formChange" type="text" name="street"
                                                           placeholder="street"
                                                           class="form-control" :class="{ 'is-invalid': form.errors.has('street') }">
                                                    <has-error :form="form" field="street"></has-error>
                                                </div>
                                                <div class="form-group">
                                                    <label>BuildingNumber</label>
                                                    <input v-model="form.buildingNumber" @change="formChange" type="number" name="buildingNumber"
                                                           placeholder="buildingNumber"
                                                           class="form-control"
                                                           :class="{ 'is-invalid': form.errors.has('buildingNumber') }">
                                                    <has-error :form="form" field="street"></has-error>
                                                </div>
                                                <div class="form-group">
                                                    <label>Postal Code</label>
                                                    <input v-model="form.postalCode" @change="formChange" type="text" name="postalCode"
                                                           placeholder="postalCode"
                                                           class="form-control" :class="{ 'is-invalid': form.errors.has('postalCode') }">
                                                    <has-error :form="form" field="postalCode"></has-error>
                                                </div>
                                               <div class="form-group">
                                                    <label>Company owner</label>
                                                    <div class="input-group mb-5">
                                                        <input v-if="form.companyName === undefined && form.company !== null"
                                                               v-model="form.company.name" type="text"
                                                               class="form-control" readonly
                                                               placeholder="Company" name="company_id" aria-describedby="append">
                                                        <input v-if="form.companyName !== undefined" v-model="form.companyName" type="text"
                                                               class="form-control" readonly
                                                               placeholder="Company" name="company_id" aria-describedby="append">
                                                        <div class="input-group-append">
                                                            <button v-if="form.company !== undefined && form.company !== null"
                                                                    class="btn btn-success" type="button" @click.prevent="lookup">Change</button>
                                                            <button v-if="form.company === undefined || form.company === null"
                                                                    class="btn btn-success" type="button" @click.prevent="lookup">Set company owner</button>
                                                        </div>
                                                        <has-error :form="form" field="company_id"></has-error>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="picture" class="col-sm-2 control-label">Company picture</label>
                                                    <div class="col-sm-12">
                                                        <input type="file" @change="fileChange" name="picture" class="form-input">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-12">
                                                        <button type="button" v-show="isUpdateDisabled" disabled @click.prevent="updateGym" class="btn btn-success">
                                                            Update
                                                        </button>
                                                        <button type="button" v-show="!isUpdateDisabled" @click.prevent="updateGym" class="btn btn-success">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane" id="facilities">
                                            <table class="table table-hover">
                                                <tbody>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Category</th>
                                                    <th></th>
                                                </tr>
                                                <tr v-for="facility in facilities" :key="facility.id">
                                                    <td>{{facility.id}}</td>
                                                    <td>{{facility.name}}</td>
                                                    <td>{{facility.category}}</td>
                                                    <td>
                                                        <a href="#" @click.prevent="deleteFacility(facility.id)">
                                                        <!--<a href="#">-->
                                                            <i class="fa fa-trash red"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td/>
                                                    <td/>
                                                    <td/>
                                                    <td>
                                                        <a href="#" @click.prevent="addFacility()">
                                                            <!--<a href="#">-->
                                                            <i class="fas fa-plus-square"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="reservations">
                                            <table class="table table-hover">
                                                <tbody>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Is approved by user</th>
                                                    <th>Is approved by trener</th>
                                                    <th>Training start</th>
                                                    <th>Training stop</th>
                                                    <th>Was training realized</th>
                                                    <th>Preview</th>
                                                </tr>
                                                <tr v-for="reservation in reservations" :key="reservation.id">
                                                    <td>{{reservation.id}}</td>
                                                    <td v-if="reservation.isApprovedByUser === 1">
                                                        <i class="fas fa-check"></i>
                                                    </td>
                                                    <td v-if="reservation.isApprovedByUser === 0"></td>
                                                    <td v-if="reservation.isApprovedByTrainer === 1">
                                                        <i class="fas fa-check"></i>
                                                    </td>
                                                    <td v-if="reservation.isApprovedByTrainer === 0"></td>
                                                    <td>{{reservation.trainingStart | myDateTime}}</td>
                                                    <td>{{reservation.trainingEnd | myDateTime}}</td>
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
                                </div><!-- /.card-body -->
                                    </div>

                        </div>
                                <!-- /.tab-content -->

                        <div class="col-md-4">


                            <GmapMap
                            :center=this.center
                            :zoom=this.zoom
                            map-type-id="terrain"
                            style="width: 350px; height: 650px"
                            >

                            <GmapMarker
                            :key="index"
                            v-for="(m, index) in markers"
                            :position="m.position"
                            :clickable="true"
                            :draggable="true"
                            :marker="marker"
                            @click="center=m.position"
                            />
                            </GmapMap>


                        </div>
                        <!-- /.nav-tabs-custom -->


                </div>


            </div>
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
                gym: {},
                counter: 0,
                company: {},
                facilities: {},
                reservations: {},
                zoom: 15,
                center: {},
                markers: [],
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
                    picture: '',
                    company_id: '',
                    company: {},
                    companyName: ''
                })
            }
        },
        methods: {
            loadGym: function loadGyms() {
                console.log('** Load gym: '+this.id);
                if (this.$gate.isAdminOrAuthor()) {
                    let url = 'http://localhost:8000/api/gym/'+this.id;
                    axios.get(url).then(({data}) => (
                        console.log('** gym: ',data),
                        this.gym = data,
                        this.fillForm(),
                        this.initializeMap(data)
                    ));
                }
            },
            initializeMap($data){
                let center = new Object();
                center.lat = parseFloat($data.latitude);
                center.lng = parseFloat($data.longitude);

                let mark = new Object();
                mark.name= 'gym';
                mark.position= {lat: center.lat, lng: center.lng};

                this.markers.push(mark);

                this.center = center;
            },
            fillForm() {
                let gym = this.gym;
                this.company = gym.company;
                this.facilities = gym.facilities;
                console.log('** reservations: ',gym.reservations);
                this.reservations = gym.reservations;
                this.form.fill(gym);
            },
            updateGym() {
                var _this = this;
                this.$Progress.start();
                this.form.put('http://localhost:8000/api/gym/' + this.id).then(function () {
                    swal('Updated!', 'Information has been updated.', 'success');
                    _this.$Progress.finish();
                    // success
                    _this.isUpdateDisabled = true;
                    Fire.$emit('GymChange');
                }).catch(function () {
                    _this.$Progress.fail();
                });

            },
            deleteFacility(id) {
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
                        let url = 'http://localhost:8000/api/detachFacility?facilityId='+id+'&gymId='+this.id;
                        axios.get(url).then(({data}) => (
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ),Fire.$emit('GymChange')
                        )).catch(()=>{
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })

            },
            addFacility() {
                this.showLookup = true;
                setTimeout(() => {
                    $('#lookupModal').modal('show');
                    Fire.$emit('lookupEvt', 'facility','Gym',this._uid);
                }, 350);
            },
            lookup(){
                this.showLookup = true;
                setTimeout(() => {
                    $('#lookupModal').modal('show');
                    Fire.$emit('lookupEvt', 'company','Gym',this._uid);
                }, 350);
            },
            onLookupCompanyUpdate(id) {
                $('#lookupModal').modal('hide');
                this.showLookup = false;
                if(this.form.company_id !== id) {
                    this.isUpdateDisabled = false;
                    this.form.company_id = id;
                    this.setCompanyNameByCompanyId(id);
                }
            },
            onLookupFacilityUpdate(id) {
                $('#lookupModal').modal('hide');
                this.showLookup = false;
                let _self = this;
                console.log('** onLookupFacilityUpdate: '+id);
                let url = 'http://localhost:8000/api/attachFacility?facilityId='+id+'&gymId='+this.id;
                axios.get(url).then(({data}) => (
                    _self.doAfterFacilityAdded(data)
                )).catch(()=>{
                    swal("Failed!", "There was something wrong.", "warning");
                });
            },
            doAfterFacilityAdded(data) {
                if(data.message !== null && data.message !== undefined){
                    swal(
                        'Exist!',
                         data.message,
                        'warning'
                    );
                } else {
                    swal(
                        'Added!',
                        'New facility has been added.',
                        'success'
                    );
                }
                Fire.$emit('GymChange');
            },
            setCompanyNameByCompanyId(id){
                axios.get('http://localhost:8000/api/company/'+id)
                    .then((data) => {
                        console.log('** setCompanyNameByCompanyId: name: ',data.data);
                        this.form.companyName = data.data.name;
                    })
                    .catch(() => {
                    });
            },
            formChange() {
                this.isUpdateDisabled = false;
            },
            getProfilePicture() {
                if(this.form.picture !== null && this.form.picture !== undefined) {
                    let picture = (this.form.picture.length > 200) ? this.form.picture : "http://localhost:8000/img/gym/"+ this.form.picture ;
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
            console.log('** Gym created: '+this._uid);
            this.loadGym();
            Fire.$on('GymChange', () => {
                this.loadGym();
            });
            Fire.$on('lookupEvtChosen', (id,componentName, index, apiName) => {
                if(index.toString() === this._uid.toString() && componentName !== undefined && componentName === 'Gym'){
                    if(apiName === 'company') {
                        this.onLookupCompanyUpdate(id);
                    } else if(apiName === 'facility') {
                        this.onLookupFacilityUpdate(id);
                    }
                }
            });
        },
        beforeDestroy() {
            DestroyedComponents.push(this._uid);
            Fire.$off('GymChange');
            console.log('** Gym destroyed: '+this._uid);
        }
    }
</script>

<style scoped>
    body{
        margin-top:20px;
        background: #2dc3e8;
    }

    @-webkit-keyframes wave {
        5% {
            opacity: .6;
        }
        27% {
            -webkit-transform: scale(1.8);
            opacity: 0;
        }
        100% {
            opacity: 0;
        }
    }
    @-moz-keyframes wave {
        5% {
            opacity: .6;
        }
        27% {
            -moz-transform: scale(1.8);
            opacity: 0;
        }
        100% {
            opacity: 0;
        }
    }
    @-o-keyframes wave {
        5% {
            opacity: .6;
        }
        27% {
            -o-transform: scale(1.8);
            opacity: 0;
        }
        100% {
            opacity: 0;
        }
    }
    @keyframes wave {
        5% {
            opacity: .6;
        }
        27% {
            -webkit-transform: scale(1.8);
            -moz-transform: scale(1.8);
            -ms-transform: scale(1.8);
            transform: scale(1.8);
            opacity: 0;
        }
        100% {
            opacity: 0;
        }
    }

    .wave.in {
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -o-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
    }

    .wave.in:after {
        content: "";
        top: 3px;
        left: 5px;
        position: absolute;
        width: 50px;
        height: 50px;
        background-image: 8121991;
        background-image: -webkit-radial-gradient(center center, farthest-side circle, rgba(26, 175, 93, 0) 70%, #f5f5f5 100%);
        background-image: -moz-radial-gradient(center center, farthest-side circle, rgba(26, 175, 93, 0) 70%, #f5f5f5 100%);
        background-image: -o-radial-gradient(center center, farthest-side circle, rgba(26, 175, 93, 0) 70%, #f5f5f5 100%);
        background-image: radial-gradient(center center, farthest-side circle, rgba(26, 175, 93, 0) 70%, #f5f5f5 100%);
        border: 4px solid #fff;
        -webkit-animation: wave 3s 1s infinite linear;
        -moz-animation: wave 3s 1s infinite linear;
        -o-animation: wave 3s 1s infinite linear;
        animation: wave 3s 1s infinite linear;
        zoom: 1;
        filter: alpha(opacity=0);
        -webkit-opacity: 0;
        -moz-opacity: 0;
        opacity: 0;
        -webkit-border-radius: 50%;
        -webkit-background-clip: padding-box;
        -moz-border-radius: 50%;
        -moz-background-clip: padding;
        border-radius: 50%;
        background-clip: padding-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .bd-danger{

    }
</style>
