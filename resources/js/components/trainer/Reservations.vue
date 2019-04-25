<template>
    <div class="container">
        <p class="m-4">&nbsp;</p>
        <div class="card">
            <div class="card-header">
                <div class="col-lg-12 py-1" >
                    <h2 class="text-center">Panel z rezerwacjami</h2>
                </div>
            </div>
            <div class="card-body">
                <div id="sub-header" class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active show" href="#all-reservations" data-toggle="tab">Wszystkie</a></li>
                        <li class="nav-item"><a class="nav-link" href="#avaiability" data-toggle="tab">Twoja dostępność</a></li>

                    </ul>
                </div><!-- /.card-header -->

                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="all-reservations">
           <!--                 <div class="row justify-content-center">
                                <div class="col-11">
                                    <div class="row border-bottom mb-1">
                                        <div class="col text-center">Podopieczny</div>
                                        <div class="col text-center">Rodzaj treningu</div>
                                        <div class="col text-center">Cena</div>
                                        <div class="col text-center">Czas treningu (min)</div>
                                        <div class="col text-center">Siłownia</div>
                                        <div class="col text-center">Potwierdzenie podopiecznego</div>
                                        <div class="col text-center">Potwierdzenie Twoje</div>
                                        <div class="col text-center">Data rozpoczęcia</div>
                                        <div class="col text-center">Status</div>
                                        <div class="col text-center">Zarządzaj</div>
                                    </div>
                                    <div v-for="reservation in reservations.data" class="row border-bottom mb-1">
                                        <div class="col my-auto text-center">{{reservation.user.name | upText}}</div>
                                        <div v-if="reservation.discipline_trainer === undefined || reservation.discipline_trainer === null" class="col text-center"></div>
                                        <div v-if="reservation.discipline_trainer !== undefined && reservation.discipline_trainer !== null" class="col text-center">{{reservation.discipline_trainer.discipline.name | upText}}</div>
                                        <div v-if="reservation.discipline_trainer === undefined || reservation.discipline_trainer === null" class="col text-center"></div>
                                        <div v-if="reservation.discipline_trainer !== undefined && reservation.discipline_trainer !== null" class="col text-center">{{reservation.discipline_trainer.price}} zł</div>
                                        <div v-if="reservation.discipline_trainer === undefined || reservation.discipline_trainer === null" class="col text-center"></div>
                                        <div v-if="reservation.discipline_trainer !== undefined && reservation.discipline_trainer !== null" class="col text-center">{{reservation.discipline_trainer.minutesDuration}}</div>
                                        <div v-if="reservation.gym === undefined || reservation.gym === null" class="col text-center"></div>
                                        <div v-if="reservation.gym !== undefined && reservation.gym !== null" class="col text-center">{{reservation.gym.name | upText}}</div>
                                        <div v-if="reservation.isApprovedByUser === 1" class="col text-center"><i class="fas fa-check green"></i></div>
                                        <div v-if="reservation.isApprovedByUser === 0" class="col text-center"><i class="fas fa-times red"></i></div>
                                        <div v-if="reservation.isApprovedByTrainer === 1" class="col text-center"><i class="fas fa-check green"></i></div>
                                        <div v-if="reservation.isApprovedByTrainer === 0" class="col text-center"><i class="fas fa-times red"></i></div>
                                        <div class="col text-center">{{reservation.trainingStart | myDateTime}}</div>
                                        <div class="col text-center">Potwierdzona</div>
                                        <div class="col text-center" @click="manageReservation" style="cursor: pointer"><i class="fas fa-tasks"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <pagination :data="reservations" @pagination-change-page="getResults"></pagination>
                            </div>-->
                        <p>Dostępne już w krótce!</p>
                        </div>
                        <div class="tab-pane" id="avaiability">
<!--                            <div> &lt;!&ndash; Start hide on screens smaller than lg&ndash;&gt;
                                <div class="row justify-content-center border-bottom">
                                    <div class="col text-center">Rodzaj treningu</div>
                                    <div class="col text-center">Cena</div>
                                    <div class="col text-center">Czas trwania</div>
                                    <div class="col text-center">Zarządzaj</div>
                                </div>

                                <div class="row justify-content-center my-1">
                                </div>

                                <div class="row justify-content-center">
                                </div>
                            </div>-->
                            <p>Dostępne już w krótce!</p>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card-footer">
            </div>
            <!-- /.card-body -->
        </div>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                authUserId:'',
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
                console.log('elo results');
                let url = 'http://localhost:8000/api/showTrainerReservations?userId='+this.authUserId+'&page=';
                axios.get(url + page)
                    .then(response => {
                        this.reservations = response.data;
                    });
            },
            loadReservations: function loadReservations() {
                console.log('!! Load Reservations: '+this._uid);
                if(this.$gate.isTrainerOrUser()){
                    let url = 'http://localhost:8000/api/showTrainerReservations?userId='+this.authUserId;
                    axios.get(url).then(({ data }) => (
                        this.reservations = data,
                            console.log('Reservations: ',this.reservations)
                    ));
                }
            },
            manageReservation(){
                console.log('manageReservation');
            }

        },
        created: function created() {
            console.log('Created trainer/Reservations');
            // this.authUserId = this.$gate.getAuthUserId();
            // this.loadReservations();
        },
        destroyed() {
            DestroyedComponents.push(this._uid);
            console.log('!! trainer/Reservations destroyed: '+this._uid);
            Fire.$off('ReservationsChange',this._uid);
        }
    }
</script>

<style scoped>
#sub-header{
    background-color: rgba(1, 22, 39, 0.85);
}
.card-header{
    background-color: white;
}
</style>
