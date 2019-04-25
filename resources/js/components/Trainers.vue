<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Trainers Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="calculateOpinions">Calculate Opinions</button>
                            <button class="btn btn-success" @click="newModal">Add New <i
                                class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Description</th>
                                <th>Competences</th>
                                <th>Company</th>
                                <th>Owner</th>
                                <th>Modify/Delete</th>
                                <th>Preview</th>
                            </tr>
                            <tr v-for="trainer in trainers.data" :key="trainer.id">
                                <td>{{trainer.id}}</td>
                                <td>{{trainer.name}}</td>
                                <td>{{trainer.surname}}</td>
                                <td>{{trainer.description}}</td>
                                <td>{{trainer.competences}}</td>
                                <td v-if="trainer.company !== null">{{trainer.company.name}}</td>
                                <td v-if="trainer.company == null">N/A</td>
                                <td>{{trainer.user.name}}</td>
                                <td>
                                    <a href="#" @click="editModal(trainer)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteTrainer(trainer.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" @click.prevent="preview(trainer.id)">
                                        <i class="fas fa-user fa-fw"></i>
                                    </a>
                                    <!--<router-link v-bind:to="'/gym/'+gym.id" replace>Go</router-link>-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card footer">
                        <pagination :data="trainers" @pagination-change-page="getResults"></pagination>
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
                    <form @submit.prevent="editmode ? updateTrainer() : createTrainer()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input v-model="form.name" type="text" name="name"
                                       placeholder="Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <label >Surname</label>
                                <input v-model="form.surname" type="text" name="surname"
                                       placeholder="Surname"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('surname') }">
                                <has-error :form="form" field="surname"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea v-model="form.description" name="description" id="description"
                                          placeholder="Short description for user (Optional)"
                                          class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Competences</label>
                                <textarea v-model="form.competences" name="competences" id="competences"
                                          placeholder="Short competences for user (Optional)"
                                          class="form-control" :class="{ 'is-invalid': form.errors.has('competences') }"></textarea>
                                <has-error :form="form" field="competences"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Experiences</label>
                                <textarea v-model="form.experiences" name="experiences" id="experiences"
                                          placeholder="Short experiences for user (Optional)"
                                          class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                <has-error :form="form" field="experiences"></has-error>
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
                trainers : {},
                form: new Form({
                    id : '',
                    name : '',
                    surname : '',
                    description : '',
                    competences: '',
                    experiences: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/trainer?page=' + page)
                    .then(response => {
                        this.trainers = response.data;
                    });
            },
            editModal(trainer) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(trainer);
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            loadTrainers: function loadTrainers() {
                console.log('Load Trainers Start');
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/trainer").then(({ data }) => (
                        this.trainers = data));
                }
            },
            createTrainer(){
                this.$Progress.start();
                this.form.post('api/trainer')
                    .then(() => {
                        Fire.$emit('TrainersChange');
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
            updateTrainer(){
                var _this = this;
                this.$Progress.start();
                this.form.put('api/trainer/' + this.form.id).then(function () {
                    // success
                    $('#addNew').modal('hide');
                    swal('Updated!', 'Information has been updated.', 'success');
                    _this.$Progress.finish();
                    Fire.$emit('TrainersChange');
                }).catch(function () {
                    _this.$Progress.fail();
                });
            },
            deleteTrainer(id){
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
                        this.form.delete('api/trainer/'+id).then(()=>{
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            Fire.$emit('TrainersChange');
                        }).catch(()=> {
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            },
            preview(id){
                this.$router.replace({name: 'trainer', params: { id: id } });
            },
            calculateOpinions(){
                let url = 'http://localhost:8000/api/calculateOpinionsFields';
                axios.get(url).then(({data}) => (
                    console.log('** calculateOpinions: ',data)
                ));
            }
        },
        created: function created() {
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findTrainer?q=' + query)
                    .then((data) => {
                        this.trainers = data.data
                    })
                    .catch(() => {
                    })
            });
            this.loadTrainers();
            Fire.$on('TrainersChange',() => {
                this.loadTrainers();
            });
        }
    }
</script>

<style scoped>

</style>
