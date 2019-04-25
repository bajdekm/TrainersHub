<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Reservations Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add New <i
                                class="fas fa-umbrella-beach fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Trainer</th>
                                <th>Discipline</th>
                                <th>Gym</th>
                                <th>Price</th>
                                <th>Is approved by user</th>
                                <th>Is approved by trener</th>
                                <th>Training start</th>
                                <th>Training stop</th>
                                <th>Was training realized</th>
                                <th>Modify</th>
                            </tr>
                            <tr v-for="reservation in reservations.data" :key="reservation.id">
                                <td>{{reservation.id}}</td>
                                <td>{{reservation.user.name}}</td>
                                <td>{{reservation.trainer.name}}</td>
                                <td v-if="reservation.discipline === undefined || reservation.discipline === null"></td>
                                <td v-if="reservation.discipline !== undefined && reservation.discipline !== null">{{reservation.discipline.name}}</td>
                                <td>{{reservation.gym.name}}</td>
                                <td>{{reservation.price}}</td>
                                <td v-if="reservation.isApprovedByUser === 1">
                                    <i class="fas fa-check"></i>
                                </td>
                                <td v-if="reservation.isApprovedByUser=== 0"></td>
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
                                    <a href="#" @click="editModal(reservation)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteReservation(reservation.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card footer">
                        <pagination :data="reservations" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add Reservation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateReservation() : createReservation()">
                        <div class="modal-body">
                        <div class="form-group">
                            <label >Name</label>
                            <input v-model="form.name" type="text" name="name"
                                   placeholder="Name"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label >Category</label>
                            <input v-model="form.category" type="text" name="category"
                                   placeholder="category"
                                   class="form-control" :class="{ 'is-invalid': form.errors.has('category') }">
                            <has-error :form="form" field="category"></has-error>
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
                reservations : {},
                options: [],
                roles: [],
                form: new Form({
                    id : '',
                    name : '',
                    category : '',
                    price : '',
                    description: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/reservation?page=' + page)
                    .then(response => {
                        this.reservations = response.data;
                    });
            },
            editModal(reservation) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(reservation);
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            loadReservations: function loadReservations() {
                console.log('!! Load Reservations: '+this._uid);
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/reservation").then(({ data }) => (
                        this.reservations = data,
                            console.log('Reservatorns: ',this.reservations)
                ));
                }
            },
            createReservation(){
                let _self = this;
                this.$Progress.start();
                this.form.post('api/reservation')
                    .then(() => {
                        Fire.$emit('ReservationsChange',_self._uid);
                        $('#addNew').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Reservation created successfully'
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {

                    });

            },
            updateReservation(){
                let _self = this;
                this.$Progress.start();
                this.form.put('api/reservation/' + this.form.id).then(function () {
                    // success
                    $('#addNew').modal('hide');
                    swal('Updated!', 'Information has been updated.', 'success');
                    _self.$Progress.finish();
                    Fire.$emit('ReservationsChange',_self._uid);
                }).catch(function () {
                    _self.$Progress.fail();
                });
            },
            deleteReservation(id){
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
                        this.form.delete('api/reservation/'+id).then(()=>{
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            Fire.$emit('ReservationsChange',_self._uid);
                        }).catch(()=> {
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            },
            findUsers(data) {
                // console.log('elo: ',data[0].discipline_trainer);
            }
        },
        created: function created() {
            console.log('Created');
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                let from = this.$parent.from;
                let to = this.$parent.to;
                let url = 'api/findReservation?q=' + query;
                if(from !== undefined && from !== null && to !== undefined && to !== null ) {
                    url = url+'&from='+from+'&to='+to;
                } else if( from !== undefined && from !== null ) {
                    url = url+'&from='+from;
                } else if( to !== undefined && to !== null) {
                    url = url+'&to='+to;
                }
                axios.get(url)
                    .then((data) => {
                        this.reservations = data.data
                    })
                    .catch(() => {
                    })
            });
            this.loadReservations();
            Fire.$on('ReservationsChange', (index) => {
                if(index.toString() === this._uid.toString()){
                    this.loadReservations();
                }
            });
        },
        destroyed() {
            DestroyedComponents.push(this._uid);
            console.log('!! Reservations destroyed: '+this._uid);
            Fire.$off('ReservationsChange',this._uid);
        }
    }
</script>

<style scoped>

</style>
