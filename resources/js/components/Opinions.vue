<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Opinions Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Trainer Name</th>
                                <th>User Name</th>
                                <th>Approved</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Registered At</th>
                                <th>Modify</th>
                            </tr>
                            <tr v-for="opinion in opinions.data" :key="opinion.id">
                                <td>{{opinion.id}}</td>
                                <td>{{opinion.trainer.name}}</td>
                                <td>{{opinion.user.name}}</td>
                                <td v-if="opinion.approved === 0"></td>
                                <td v-if="opinion.approved === 1">
                                    <i class="fas fa-check"></i>
                                </td>
                                <td>{{opinion.rating}}</td>
                                <td>{{opinion.comment}}</td>
                                <td>{{opinion.created_at | myDate}}</td>
                                <td>
                                    <a href="#" @click="editModal(opinion)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteOpinion(opinion.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card footer">
                        <pagination :data="opinions" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" id="addNewLabel">Edit New</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateOpinion()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label >Approved</label>
                                <input v-model="form.approved" type="checkbox" name="approved"
                                       placeholder="approved"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('approved') }">
                                <has-error :form="form" field="category"></has-error>
                            </div>
                            <div class="form-group">
                                <label >Rating</label>
                                <input v-model="form.rating" type="number" name="rating"
                                       placeholder="rating"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('rating') }">
                                <has-error :form="form" field="rating"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
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
                opinions : {},
                options: [],
                roles: [],
                form: new Form({
                    id : '',
                    approved : '',
                    rating : ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/opinion?page=' + page)
                    .then(response => {
                        this.opinions = response.data;
                    });
            },
            editModal(opinion) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(opinion);
            },
            loadOpinions: function loadOpinions() {
                console.log('Load loadOpinions Start');
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("http://localhost:8000/api/opinion").then(({ data }) => (
                        this.opinions = data));
                }
            },
            updateOpinion(){
                var _this = this;
                this.$Progress.start();
                this.form.put('api/opinion/' + this.form.id).then(function () {
                    // success
                    $('#addNew').modal('hide');
                    swal('Updated!', 'Information has been updated.', 'success');
                    _this.$Progress.finish();
                    Fire.$emit('OpinionsChange');
                }).catch(function () {
                    _this.$Progress.fail();
                });
            },
            deleteOpinion(id){
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
                        this.form.delete('api/opinion/'+id).then(()=>{
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            Fire.$emit('OpinionsChange');
                        }).catch(()=> {
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            }
        },
        created: function created() {
            console.log('Created Opinions');
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findOpinion?q=' + query)
                    .then((data) => {
                        this.opinions = data.data
                    })
                    .catch(() => {
                    })
            });
            this.loadOpinions();
            Fire.$on('OpinionsChange',() => {
                this.loadOpinions();
            });
        }
    }
</script>

<style scoped>

</style>
