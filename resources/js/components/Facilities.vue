<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Facilities Table</h3>

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
                                <th>Name</th>
                                <th>Category</th>
                                <th>Modify</th>
                            </tr>
                            <tr v-for="facility in facilities.data" :key="facility.id">
                                <td>{{facility.id}}</td>
                                <td>{{facility.name}}</td>
                                <td>{{facility.category}}</td>
                                <td>
                                    <a href="#" @click="editModal(facility)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteFacility(facility.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card footer">
                        <pagination :data="facilities" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add Facility</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateFacility() : createFacility()">
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
                facilities : {},
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
                axios.get('api/facility?page=' + page)
                    .then(response => {
                        this.facilities = response.data;
                    });
            },
            editModal(facility) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(facility);
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            loadFacilities: function loadFacilities() {
                console.log('Load Facilities Start');
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/facility").then(({ data }) => (
                        this.facilities = data));
                }
            },
            createFacility(){
                this.$Progress.start();
                this.form.post('api/facility')
                    .then(() => {
                        Fire.$emit('AfterCreate');
                        $('#addNew').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Facility created successfully'
                        });
                        this.$Progress.finish();
                    })
                    .catch(() => {

                    });

            },
            updateFacility(){
                var _this = this;
                this.$Progress.start();
                this.form.put('api/facility/' + this.form.id).then(function () {
                    // success
                    $('#addNew').modal('hide');
                    swal('Updated!', 'Information has been updated.', 'success');
                    _this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                }).catch(function () {
                    _this.$Progress.fail();
                });
            },
            deleteFacility(id){
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
                        this.form.delete('api/facility/'+id).then(()=>{
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
            }
        },
        created: function created() {
            console.log('Created');
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findFacility?q=' + query)
                    .then((data) => {
                        this.facilities = data.data
                    })
                    .catch(() => {
                    })
            });
            this.loadFacilities();
            Fire.$on('AfterCreate',() => {
                this.loadFacilities();
            });
        }
    }
</script>

<style scoped>

</style>
