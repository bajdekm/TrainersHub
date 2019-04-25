<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white" style="background-image:url('http://localhost:8000/img/sport-background.jpg')">
                    <!--<div class="widget-user-header text-white">-->
                        <h3 class="widget-user-username">{{this.form.name}}</h3>
                        <h5 class="widget-user-desc">{{this.form.type}}</h5>
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
                            <li class="nav-item"><a class="nav-link" href="#disciplines" data-toggle="tab">Disciplines</a></li>
                            <li class="nav-item"><a class="nav-link" href="#reservations" data-toggle="tab">Reservations</a></li>
                            <li class="nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Gallery</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Preview Tab -->
                            <div class="tab-pane active show" id="preview">
                                    <strong><i class="fas fa-dumbbell fa-fw"></i> Name</strong>
                                    <p class="text-muted">
                                        {{this.trainer.name}}
                                    </p>
                                    <hr>
                                    <strong><i class="fas fa-envelope-square"></i> Surname</strong>
                                    <p class="text-muted">
                                        {{this.trainer.surname}}
                                    </p>
                                    <hr>
                                    <strong><i class="fas fa-envelope-square"></i> Description</strong>
                                    <p class="text-muted">
                                        {{this.trainer.description}}
                                    </p>
                                    <hr>
                                    <strong><i class="fas fa-building fa-fw"></i> Competences</strong>
                                    <p class="text-muted">
                                        {{this.trainer.competences}}
                                    </p>
                                    <hr>
                                    <strong><i class="fas fa-address-book"></i> Experiences</strong>
                                    <p class="text-muted">
                                        {{this.trainer.experiences}}
                                    </p>
                                    <hr>
                            </div>
                            <!-- Details Tab -->
                            <div class="tab-pane" id="edit">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input v-model="form.name" type="text" name="name"
                                               placeholder="Name" @change="formChange"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label >Surname</label>
                                        <input v-model="form.surname" type="text" name="surname"
                                               placeholder="Surname" @change="formChange"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('surname') }">
                                        <has-error :form="form" field="surname"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea v-model="form.description" name="description" id="description"
                                                  placeholder="Short description for user (Optional)" @change="formChange"
                                                  class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                        <has-error :form="form" field="description"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Competences</label>
                                        <textarea v-model="form.competences" name="competences" id="competences"
                                                  placeholder="Short competences for user (Optional)" @change="formChange"
                                                  class="form-control" :class="{ 'is-invalid': form.errors.has('competences') }"></textarea>
                                        <has-error :form="form" field="competences"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label>Experiences</label>
                                        <textarea v-model="form.experiences" name="experiences" id="experiences"
                                                  placeholder="Short experiences for user (Optional)" @change="formChange"
                                                  class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                        <has-error :form="form" field="experiences"></has-error>
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

                                    <div class="form-group">
                                        <label for="picture" class="col-sm-2 control-label">Profile picture</label>
                                        <div class="col-sm-12">
                                            <input type="file" @change="fileChange" name="picture" class="form-input">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="picture2" class="col-sm-2 control-label">Profile picture 2</label>
                                        <div class="col-sm-12">
                                            <input type="file" @change="fileChange2" name="picture2" class="form-input">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="picture3" class="col-sm-2 control-label">Profile picture 3</label>
                                        <div class="col-sm-12">
                                            <input type="file" @change="fileChange3" name="picture3" class="form-input">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-12">
                                            <button type="button" v-show="isUpdateDisabled" disabled @click.prevent="updateTrainer" class="btn btn-success">
                                                Update
                                            </button>
                                            <button type="button" v-show="!isUpdateDisabled" @click.prevent="updateTrainer" class="btn btn-success">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="disciplines">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Duration(min)</th>
                                        <th>Registered At</th>
                                        <th>Modify</th>
                                    </tr>
                                    <tr v-for="discipline in disciplines" :key="discipline.id">
                                        <td>{{discipline.id}}</td>
                                        <td>{{discipline.name}}</td>
                                        <td>{{discipline.category}}</td>
                                        <td>{{discipline.pivot.price}}</td>
                                        <td>{{discipline.pivot.minutesDuration}}</td>
                                        <td>{{discipline.created_at | myDate}}</td>
                                        <td>
                                            <a href="#" @click="editDiscipline(discipline.pivot.price,discipline.pivot.minutesDuration, discipline.id)">
                                                <i class="fa fa-edit blue"></i>
                                            </a>
                                            /
                                            <a href="#" @click="deleteDiscipline(discipline.id)">
                                                <i class="fa fa-trash red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td/>
                                        <td/>
                                        <td/>
                                        <td/>
                                        <td/>
                                        <td/>
                                        <td>
                                            <a href="#" @click.prevent="addDiscipline()">
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
                                        <th>User</th>
                                        <th>Approved by user</th>
                                        <th>Approved by me</th>
                                        <th>Training start</th>
                                        <th>Gym</th>
                                        <th>Was training realized</th>
                                        <th>Preview</th>
                                    </tr>
                                    <tr v-for="reservation in reservations" :key="reservation.id">
                                        <td>{{reservation.user.name}}</td>
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

                            <div class="tab-pane" id="gallery">


                                <div id="vue-gallery">
                                    <img class="image-gallery" v-for="(image, i) in images" :src="image" @click="onClickImage(i)">
                                    <vue-gallery-slideshow :images="images" :index="index" @close="index = null"></vue-gallery-slideshow>
                                </div>


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

        <!-- Modal price -->
        <div class="modal fade" id="priceModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label>Price</label>
                                <input v-model="price" type="number" name="price"
                                       placeholder="Price"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('price') }">
                                <has-error :form="form" field="price"></has-error>
                                <label>Duration</label>
                                <input v-model="minutesDuration" type="number" name="minutesDuration"
                                       placeholder="Minutes"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('minutesDuration') }">
                                <has-error :form="form" field="minutesDuration"></has-error>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-primary" @click="lookupBack">Back</button>-->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button v-show="isDisciplineEdit" type="button" class="btn btn-success" @click="attachNewDiscipline">Update</button>
                        <button v-show="!isDisciplineEdit" type="button" class="btn btn-success" @click="attachNewDiscipline">Save</button>
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
                isAdditionalUpdateDisabled: true,
                isDisciplineEdit: false,
                trainer: {},
                disciplineId: 0,
                counter: 0,
                price: 0,
                minutesDuration: 0,
                company: {},
                disciplines: {},
                reservations: {},
                images: [],
                index: null,
                form: new Form({
                    id : '',
                    name : '',
                    surname : '',
                    picture : '',
                    picture2 : '',
                    picture3 : '',
                    description : '',
                    competences: '',
                    experiences: '',
                    user:{},
                    user_id: '',
                    userName: ''
                })
            }
        },
        methods: {
            loadTrainer: function loadGyms() {
                if (this.$gate.isAdminOrAuthor()) {
                    let url = 'http://localhost:8000/api/trainer/'+this.id;
                    axios.get(url).then(({data}) => (
                        console.log('** trainer: ',data),
                            this.trainer = data,
                            this.fillForm()
                    ));
                }
            },
            fillForm() {
                let trainer = this.trainer;
                this.disciplines = trainer.disciplines;
                this.reservations = trainer.reservations;
                this.form.fill(trainer);
                this.initializePictures();
            },

            initializePictures(){
                let images = new Array();
                images.push(this.getProfilePicture());
                images.push(this.getProfilePicture2());
                images.push(this.getProfilePicture3());
                for (let i = 0; i < images.length; i++) {
                    if(images[i] !== null && images[i] !== undefined){
                        this.images.push(images[i]);
                    }
                }
            },
            updateTrainer() {
                var _this = this;
                this.$Progress.start();
                this.form.put('http://localhost:8000/api/trainer/' + this.id).then(function () {
                    swal('Updated!', 'Information has been updated.', 'success');
                    _this.$Progress.finish();
                    // success
                    _this.isUpdateDisabled = true;
                    Fire.$emit('TrainerChange');
                }).catch(function () {
                    _this.$Progress.fail();
                });

            },
            deleteDiscipline(id) {
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
                        let url = 'http://localhost:8000/api/detachDiscipline?disciplineId='+id+'&trainerId='+this.id;
                        axios.get(url).then(({data}) => (
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ),Fire.$emit('TrainerChange')
                        )).catch(()=>{
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })

            },
            addDiscipline() {
                this.showLookup = true;
                setTimeout(() => {
                    $('#lookupModal').modal('show');
                    Fire.$emit('lookupEvt', 'discipline','Trainer',this._uid);
                }, 350);
            },
            lookup(){
                this.showLookup = true;
                setTimeout(() => {
                    $('#lookupModal').modal('show');
                    Fire.$emit('lookupEvt', 'user','Trainer',this._uid);
                }, 350);
            },
            onLookupUserUpdate(id) {
                $('#lookupModal').modal('hide');
                this.showLookup = false;
                if(this.form.user_id !== id) {
                    this.isUpdateDisabled = false;
                    this.form.user_id = id;
                    this.setUserNameByCompanyId(id);
                }
            },
            onLookupDisciplineUpdate(id) {
                $('#lookupModal').modal('hide');
                setTimeout(() => {
                    $('#priceModal').modal('show');
                }, 350);
                this.showLookup = false;
                this.disciplineId = id;
            },
            doAfterDisciplineAdded(data) {
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
                Fire.$emit('TrainerChange');
            },
            setUserNameByCompanyId(id){
                axios.get('http://localhost:8000/api/user/'+id)
                    .then((data) => {
                        console.log('** setUserNameByCompanyId: name: ',data.data);
                        this.form.userName = data.data.name;
                    })
                    .catch(() => {
                    });
            },
            formChange() {
                this.isUpdateDisabled = false;
            },
            formChangeForAdditionalPictures() {
                this.isAdditionalUpdateDisabled = false;
            },
            attachNewDiscipline() {
                let _self = this;
                $('#priceModal').modal('hide');
                console.log('** attachNewDiscipline: ');
                let url = 'http://localhost:8000/api/attachDiscipline?' +
                    'disciplineId=' + this.disciplineId +
                    '&trainerId=' + this.id+'' +
                    '&price=' + this.price+
                    '&minutesDuration=' + this.minutesDuration;
                if(this.isDisciplineEdit) {
                    url = url + '&isEdit=true'
                } else {
                    url = url + '&isEdit=false'
                }
                axios.get(url).then(({data}) => (
                    _self.doAfterDisciplineAdded(data)
                )).catch(()=>{
                    swal("Failed!", "There was something wrong.", "warning");
                });
            },
            editDiscipline(price,minutesDuration,id) {
                this.isDisciplineEdit = true;
                this.price = price;
                this.minutesDuration = minutesDuration;
                this.disciplineId = id;
                $('#priceModal').modal('show');
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

            fileChange2(e) {
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
                    this.form.picture2 = reader.result;
                    this.formChange();
                };
                reader.readAsDataURL(file);
            },

            fileChange3(e) {
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
                    this.form.picture3 = reader.result;
                    this.formChange();
                };
                reader.readAsDataURL(file);
            },

            getProfilePicture() {
                if(this.form.picture !== null && this.form.picture !== undefined) {
                    let picture = (this.form.picture.length > 200) ? this.form.picture : "http://localhost:8000/img/trainer/"+ this.form.picture ;
                    return picture;
                }
                return null;
            },
            getProfilePicture2() {
                if(this.form.picture2 !== null && this.form.picture2 !== undefined) {
                    let picture = (this.form.picture2.length > 200) ? this.form.picture2 : "http://localhost:8000/img/trainer/"+ this.form.picture2 ;
                    return picture;
                }
                return null;
            },
            getProfilePicture3() {
                if(this.form.picture3 !== null && this.form.picture3 !== undefined) {
                    let picture = (this.form.picture2.length > 200) ? this.form.picture3 : "http://localhost:8000/img/trainer/"+ this.form.picture3 ;
                    return picture;
                }
                return null;
            },
            onClickImage(i) {
                this.index = i;
            }
        },
        created: function created() {
            console.log('** Trainer created: '+this._uid);
            this.loadTrainer();
            Fire.$on('TrainerChange', () => {
                this.loadTrainer();
            });
           Fire.$on('lookupEvtChosen', (id,componentName, index, apiName) => {
                if(index.toString() === this._uid.toString() && componentName !== undefined && componentName === 'Trainer'){
                    if(apiName === 'user') {
                        this.onLookupUserUpdate(id);
                    } else if(apiName === 'discipline') {
                        this.onLookupDisciplineUpdate(id);
                    }
                }
            });
        },
        beforeDestroy() {
            DestroyedComponents.push(this._uid);
            Fire.$off('TrainerChange');
            console.log('** Trainer destroyed: '+this._uid);
        }
    }
</script>
<style>
    .widget-user-header{
        background-position: center center;
        background-size: cover;
        height: 200px !important;
    }
    .widget-user .card-footer{
        padding: 0;
    }
    .image-gallery {
        width: 200px;
        height: 200px;
        background-size: cover;
        cursor: pointer;
        margin: 5px;
        border-radius: 3px;
        border: 1px solid lightgray;
        object-fit: contain;
    }
    /*Michałek to pała*/

</style>
