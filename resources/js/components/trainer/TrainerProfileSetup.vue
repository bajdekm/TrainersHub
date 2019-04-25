<template>
    <div class="container">
        <p class="m-4">&nbsp;</p>
        <div class="card">
            <div class="card-header">
                <div class="col-lg-12 py-1" >
                    <h2 class="text-center">Twój profil</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12">
                        <img v-if="trainer.picture != null && trainer.picture != undefined" class="img-thumbnail p-0" :src="'http://localhost:8000/img/trainer/'+trainer.picture" style="height: 250px;width: 250px; border: none" alt="Card image cap">
                        <img v-if="(trainer.picture == null || trainer.picture == undefined) && trainer.sex == 'woman'" class="img-thumbnail p-0" src="http://localhost:8000/images/avatar_trainershub_woman.png" style="height: 250px;width: 250px; border: none" alt="Card image cap">
                        <img v-if="(trainer.picture == null || trainer.picture == undefined) && trainer.sex == 'man'" class="img-thumbnail p-0" src="http://localhost:8000/images/avatar_trainershub_man.png" style="height: 250px;width: 250px; border: none" alt="Card image cap">
                        <h5 class="card-title my-1">{{trainer.name}} {{trainer.surname}}</h5>
                        <p class="mb-1">
                            <i v-if="opinionsAverage >= 1" class="fas fa-star"></i>
                            <i v-if="opinionsAverage >= 2" class="fas fa-star"></i>
                            <i v-if="opinionsAverage >= 3" class="fas fa-star"></i>
                            <i v-if="opinionsAverage >= 4" class="fas fa-star"></i>
                            <i v-if="opinionsAverage >= 5" class="fas fa-star"></i>
                            <a v-if="opinionsAverage >= 1">{{opinionsAverage}}</a></p>
                        <p class="mb-1 ml-1" style="cursor: pointer"><i class="fab fa-discourse mb-2"></i> Opinie ({{opinionsSum}})</p>
                        <div v-if="trainer.city != null">
                            <strong>Miasto</strong>
                            <p class="mb-1 ml-1">{{trainer.city}}</p>
                        </div>
                        <div v-if="trainer.phone != null">
                            <strong>Telefon</strong>
                            <p class="mb-1 ml-1">{{trainer.phone}}</p>
                        </div>
                        <strong>Email</strong>
                        <p class="mb-1 ml-1">{{trainer.email}}</p>
                        <div v-if="trainer.website != null">
                            <strong>Strona</strong>
                            <p class="mb-1 ml-1"><a href="" style="color: black" @click="redirectTo('website')">{{trainer.website}}</a></p>
                        </div>
                        <strong>Social media</strong>
                        <p class="mb-1" >
                        <div class="social-media">
                            <i v-if="trainer.instagramProfile != null" class="fab fa-instagram fa-3x" @click="redirectTo('instagram')"></i>
                            <i v-if="trainer.facebookProfile != null" class="fab fa-facebook fa-3x" @click="redirectTo('facebook')"></i>
                            <i v-if="trainer.snapchatProfile != null" class="fab fa-snapchat-square fa-3x" @click="redirectTo('snapchat')"></i>
                        </div>
                        </p>

                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active show" href="#edit" data-toggle="tab">Edycja</a></li>
                                    <li class="nav-item"><a ref="offer" class="nav-link" href="#offer" @click="offerClick" data-toggle="tab">Moja oferta</a></li>
                                    <li class="nav-item"><a ref="offer" class="nav-link" href="#disciplines" data-toggle="tab">Cennik</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Zdjęcia</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#change-password" data-toggle="tab">Zmień hasło</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#delete-account" data-toggle="tab">Usuń konto</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#calendar" data-toggle="tab">Kalendarz</a></li>

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <!-- Preview Tab -->
                                    <!-- Details Tab -->
                                    <div class="tab-pane active show" id="edit">
                                        <form class="form-horizontal">
                                            <div class="form-row justify-content-between">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Imię</label>
                                                        <input v-model="form.name" type="text" name="name" @change="formChange" readonly
                                                               class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                                        <has-error :form="form" field="name"></has-error>
                                                    </div>
                                                    <div class="form-group">
                                                        <label >Nazwisko</label>
                                                        <input v-model="form.surname" type="text" name="surname" @change="formChange" readonly
                                                               class="form-control" :class="{ 'is-invalid': form.errors.has('surname') }">
                                                        <has-error :form="form" field="surname"></has-error>
                                                    </div>
                                                    <div class="form-group">
                                                        <label >Telefon</label>
                                                        <input v-model="form.phone" type="text" name="phone" @change="formChange"
                                                               class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                                                        <has-error :form="form" field="phone"></has-error>
                                                    </div>
                                                    <div class="form-group">
                                                        <label >Instagram</label>
                                                        <input v-model="form.instagramProfile" placeholder="https://www.instagram.com/twoj_profil" type="text" name="instagramProfile" @change="formChange"
                                                               class="form-control" :class="{ 'is-invalid': form.errors.has('instagramProfile') }">
                                                        <has-error :form="form" field="instagramProfile"></has-error>
                                                    </div>

                                                </div>
                                                <div class="col-6">

                                                    <div class="form-group">
                                                        <label >Email</label>
                                                        <input v-model="form.email" type="text" name="email" @change="formChange" readonly
                                                               class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                                        <has-error :form="form" field="email"></has-error>
                                                    </div>
                                         <!--           <div class="form-group">
                                                        <label >Miasto</label>
                                                        <input v-model="form.city" type="text" name="city" @change="formChange"
                                                               class="form-control" :class="{ 'is-invalid': form.errors.has('city') }">
                                                        <has-error :form="form" field="surname"></has-error>
                                                    </div>-->

                                                    <div class="form-group">
                                                        <label >Miasto</label>
                                                        <div class="autocomplete">
                                                            <input v-model="form.city" id="city" type="text" name="city" ref="city" @change="formChange"
                                                                   class="form-control" :class="{ 'is-invalid': form.errors.has('city') }" >
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label >Facebook</label>
                                                        <input v-model="form.facebookProfile" placeholder="https://www.facebook.com/twoj_profil" type="text" name="facebookProfile" @change="formChange"
                                                               class="form-control" :class="{ 'is-invalid': form.errors.has('facebookProfile') }">
                                                        <has-error :form="form" field="facebookProfile"></has-error>
                                                    </div>
                                                    <div class="form-group">
                                                        <label >Snapchat</label>
                                                        <input v-model="form.snapchatProfile" placeholder="nazwa użytkownika" type="text" name="snapchatProfile" @change="formChange"
                                                               class="form-control" :class="{ 'is-invalid': form.errors.has('snapchatProfile') }">
                                                        <has-error :form="form" field="snapchatProfile"></has-error>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label >Strona internetowa</label>
                                                <input v-model="form.website" placeholder="www.twoja-strona.pl" type="text" name="website" @change="formChange"
                                                       class="form-control" :class="{ 'is-invalid': form.errors.has('website') }">
                                                <has-error :form="form" field="website"></has-error>
                                            </div>
                                            <div class="form-group">
                                                <label>O sobie</label>
                                                <textarea v-model="form.description" name="description" id="description" @change="formChange"
                                                          class="form-control" rows="5" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                                <has-error :form="form" field="description"></has-error>
                                            </div>
                                            <div class="form-group">
                                                <label>Doświadczenie</label>
                                                <textarea v-model="form.experiences" name="experiences" id="experiences" @change="formChange"
                                                          class="form-control" rows="5" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                                <has-error :form="form" field="experiences"></has-error>
                                            </div>

                                            <div class="form-group">
                                                <button type="button" :disabled="isUpdateDisabled" @click.prevent="updateTrainer('profile')" class="btn btn-block btn-success">
                                                    Zapisz
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="offer">
                                        <offer-selection v-if="inOfferTab" :trainerId="trainer.id" :trainerDisciplines="disciplines"></offer-selection>
                                    </div>

                                    <div class="tab-pane" id="disciplines">

                                        <div class="d-none d-lg-block"> <!-- Start hide on screens smaller than lg-->
                                            <div class="row justify-content-center border-bottom">
                                                <div class="col-lg-3 text-center">Pakiet</div>
                                                <div class="col-lg-3 text-center">Cena od osoby</div>
                                                <div class="col-lg-3 text-center">Czas trwania</div>
                                                <div class="col-lg-3 text-center">Zarządzaj</div>
                                            </div>

                                            <div class="row justify-content-center my-1" v-if="discipline.category == 'Paintball pricing'"  v-for="discipline in disciplines" :key="discipline.id">
                                                <div class="col-lg-3 text-center">{{discipline.name}}</div>
                                                <div class="col-lg-3 text-center">{{discipline.pivot.price}} zł</div>
                                                <div class="col-lg-3 text-center">{{discipline.pivot.hoursDuration}} h</div>
                                                <div class="col-lg-3 text-center">

                                                    <a href="#" @click="editDiscipline(discipline.pivot.price,discipline.pivot.hoursDuration, discipline.id)">
                                                        <i class="fa fa-edit blue"></i>
                                                    </a>
                                                    /
                                                    <a href="#" @click="deleteDiscipline(discipline.id)">
                                                        <i class="fa fa-trash red"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-lg-3 text-center"></div>
                                                <div class="col-lg-3 text-center"></div>
                                                <div class="col-lg-3 text-center"></div>
                                                <div class="col-lg-3 text-center">
                                                    <button type="button" @click.prevent="addDiscipline" class="btn btn-block btn-success">
                                                        Dodaj
                                                    </button>
                                                </div>
                                            </div>

                                        </div><!-- Stop hide on screens smaller than lg-->

                                        <div class="d-lg-none"> <!-- start hide on screens wider than lg-->
                                            <div class="row justify-content-center border-bottom" v-if="discipline.category == 'Paintball pricing'" v-for="discipline in disciplines" :key="discipline.id">
                                                <div class="col-lg-3 text-center">{{discipline.name}}</div>
                                                <div class="col-lg-3 text-center">{{discipline.pivot.price}} zł</div>
                                                <div class="col-lg-3 text-center">{{discipline.pivot.hoursDuration}} min</div>
                                                <div class="col-lg-3 text-center">

                                                    <a href="#" @click="editDiscipline(discipline.pivot.price,discipline.pivot.hoursDuration, discipline.id)">
                                                        <i class="fa fa-edit blue"></i>
                                                    </a>
                                                    /
                                                    <a href="#" @click="deleteDiscipline(discipline.id)">
                                                        <i class="fa fa-trash red"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-lg-3 text-center"></div>
                                                <div class="col-lg-3 text-center"></div>
                                                <div class="col-lg-3 text-center"></div>
                                                <div class="col-lg-3 text-center">
                                                    <a href="#" @click.prevent="addDiscipline()">
                                                        <!--<a href="#">-->
                                                        <i class="fas fa-plus-square"></i>
                                                    </a>
                                                    <!--<button type="button" @click.prevent="addDiscipline" class="btn btn-block btn-success">
                                                        Dodaj
                                                    </button>-->
                                                </div>
                                            </div>
                                        </div> <!-- stop hide on screens wider than lg-->

                                    </div>

                                    <div class="tab-pane" id="gallery">
                                        <div class="row">
                                            <div class="col">
                                                <form>
                                                    <div v-if="form.picture === null" class="form-group">
                                                        <label for="picture">Dodaj zdjęcie profilowe</label>
                                                        <div class="col-sm-12">
                                                            <input id="picture" type="file" @change="fileChange" name="picture" class="form-input">
                                                        </div>
                                                    </div>

                                                    <div v-if="form.picture !== null" class="form-group">
                                                        <label for="picture">Zmień zdjęcie profilowe</label>
                                                        <div class="col-sm-12">
                                                            <input id="picture" type="file" @change="fileChange" name="picture" class="form-input">
                                                        </div>
                                                    </div>

                                                    <div v-if="form.picture2 === null" class="form-group" >
                                                        <label for="picture2" >Dodaj zdjęcie 2</label>
                                                        <div class="col-sm-12">
                                                            <input id="picture2" type="file" :disabled="this.isPicture2Disabled" @change="fileChange2" name="picture2" class="form-input">
                                                        </div>
                                                    </div>

                                                    <div v-if="form.picture2 !== null" class="form-group" >
                                                        <label for="picture2" >Zmień zdjęcie 2</label>
                                                        <div class="col-sm-12">
                                                            <input id="picture2" type="file" :disabled="this.isPicture2Disabled" @change="fileChange2" name="picture2" class="form-input">
                                                        </div>
                                                    </div>

                                                    <div v-if="form.picture3 === null" class="form-group">
                                                        <label for="picture3" >Dodaj zdjęcie 3</label>
                                                        <div class="col-sm-12">
                                                            <input id="picture3" type="file" :disabled="this.isPicture3Disabled" @change="fileChange3" name="picture3" class="form-input">
                                                        </div>
                                                    </div>

                                                    <div v-if="form.picture3 !== null" class="form-group">
                                                        <label for="picture3" >Zmień zdjęcie 3</label>
                                                        <div class="col-sm-12">
                                                            <input id="picture3" type="file" :disabled="this.isPicture3Disabled" @change="fileChange3" name="picture3" class="form-input">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="button" :disabled="isUpdateDisabled" @click.prevent="updateTrainer('gallery')" class="btn btn-block btn-success">
                                                            Zapisz
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col">
                                                <div v-if="form.picture !== null" class="form-group">
                                                    <label for="picture">Usuń zdjęcie profilowe</label>
                                                    <div class="col-sm-12">
                                                        <input id="picture-delete" type="checkbox" v-model="form.isPictureDelete" @change="formChange" name="picture" class="form-input">
                                                    </div>
                                                </div>
                                                <div v-if="form.picture2 !== null" class="form-group">
                                                    <label for="picture">Usuń zdjęcie 2</label>
                                                    <div class="col-sm-12">
                                                        <input id="picture-delete2" type="checkbox" v-model="form.isPictureDelete2" @change="formChange" name="picture" class="form-input">
                                                    </div>
                                                </div>
                                                <div v-if="form.picture3 !== null" class="form-group">
                                                    <label for="picture">Usuń zdjęcie 3</label>
                                                    <div class="col-sm-12">
                                                        <input id="picture-delete3" type="checkbox" v-model="form.isPictureDelete3" @change="formChange" name="picture" class="form-input">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div id="vue-gallery">
                                                    <img class="image-gallery" v-for="(image, i) in images" :src="image" @click="onClickImage(i)">
                                                    <vue-gallery-slideshow :images="images" :index="index" @close="index = null" ></vue-gallery-slideshow>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="change-password">
                                        <div class="col-md-12 personal-info">

                                            <form class="form-horizontal" role="form">

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Stare Hasło:</label>
                                                    <div class="col-md-8">
                                                        <input type="password" v-model="formPassword.password" class="form-control" id="oldPassword" ref="oldpassword" :class="{ 'is-invalid': form.errors.has('password') }">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Nowe Hasło:</label>
                                                    <div class="col-md-8">
                                                        <input type="password" v-model="formPassword.newpassword" class="form-control" id="inputPassword" ref="password" :class="{ 'is-invalid': form.errors.has('password') }">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Potwierdź Hasło:</label>
                                                    <div class="col-md-8">
                                                        <input type="password" class="form-control" id="inputPasswordAgain" ref="password2" :class="{ 'is-invalid': form.errors.has('password') }">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"></label>
                                                    <div class="col-md-8">
                                                        <input type="button" class="btn btn-success" value="Zmień Hasło" @click.prevent="changePassword" :disabled=isDisabledChangePassword>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="delete-account">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 personal-info">
                                                    <h3>Usuwanie konta</h3>
                                                    <form class="form-horizontal" role="form">
                                                        <p>Usunięcie konta jest nieodwracalne. Rozpoczętej operacji nie można cofnąć</p>

                                                        <div class="col-md-8">
                                                            <input type="password" v-model="password" class="form-control" id="passwordConfirmation" ref="passwordConfirmation" placeholder="Wpisz hasło dla potwierdzenia">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label"></label>
                                                            <div class="col-md-8">
                                                                <input type="button" class="btn btn-primary" value="Usuń Konto" @click.prevent="deleteUser" :disabled=isDisabledAccountDelete>
                                                                <span></span>
                                                                <input type="reset" class="btn btn-default" value="Anuluj">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="calendar">
                                        <calendar></calendar>
                                    </div>

                                    </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>

                </div>

            </div>
            <div class="card-footer">
            </div>
            <!-- /.card-body -->
        </div>
        <!--lookup modal-->
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
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
                                <label>Cena (zł)</label>
                                <v-select v-model="price" :options="optionsPrice"></v-select>
                                <label>Czas gry (h)</label>
                                <v-select v-model="hoursDuration" :options="optionsTime"></v-select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-primary" @click="lookupBack">Back</button>-->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                        <button v-show="isDisciplineEdit" type="button" class="btn btn-success" @click="attachNewDiscipline">Zapisz</button>
                        <button v-show="!isDisciplineEdit" type="button" class="btn btn-success" @click="attachNewDiscipline">Zapisz</button>
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
                authUserId:'',
                editmode : false,
                showLookup: false,
                isUpdateDisabled: true,
                inOfferTab: false,
                isAdditionalUpdateDisabled: true,
                isDisciplineEdit: false,
                isPicture2Disabled: true,
                isPicture3Disabled: true,
                trainer: {},
                optionsPrice: [],
                optionsTime: [],
                password: '',
                disciplineId: 0,
                counter: 0,
                price: '',
                minPrice: 30,
                maxPrice: 120,
                hoursDuration: '',
                company: {},
                disciplines: {},
                reservations: {},
                images: [],
                index: null,
                opinionsSum: 0,
                opinionsAverage: 0.0,
                form: new Form({
                    id : '',
                    name : '',
                    surname : '',
                    picture : '',
                    picture2 : '',
                    picture3 : '',
                    isPictureDelete: false,
                    isPictureDelete2: false,
                    isPictureDelete3: false,
                    description : '',
                    competences: '',
                    experiences: '',
                    user:{},
                    user_id: '',
                    userName: '',
                    postalCode: '',
                    city: '',
                    street: '',
                    email: '',
                    phone: '',
                    flatNumber: '',
                    website: '',
                    buildingNumber: '',
                    instagramProfile: '',
                    facebookProfile: '',
                    snapchatProfile: ''
                }),
                formPassword: new Form({
                    id : '',
                    newpassword: '',
                    password: ''
                })
            }
        },
        methods: {
            loadProfile: function loadReservations() {
                console.log('!! Load Trainer profile: '+this._uid);
                let _self = this;
                if(this.$gate.isTrainerOrUser()){
                    let url = 'http://localhost:8000/api/retrieveTrainerByUserId?userId='+this.authUserId;
                    axios.get(url).then(({ data }) => (
                        _self.initializeData(data)
                    ));
                }
            },
            initializeData(data) {
                this.trainer = data,
                console.log('Trainer: ',this.trainer),
                console.log('this.authUserId: ',this.authUserId),
                this.disciplines = this.trainer.disciplines,
                this.form.fill(data);
                this.initializePictures();
                this.setPriceOptions();
                this.setTimeOptions();
            },
            manageReservation(){
                console.log('manageReservation');
            },
            formChange() {
                this.isUpdateDisabled = false;
            },
            updateTrainer(context) {
                if(context === 'gallery'){
                    if(this.form.picture === null || this.form.picture === undefined){
                        swal("Failed!", "Dodaj najpierw zdjęcie profilowe!", "warning");
                        return null;
                    }
                }
                var _this = this;



                if(this.form.isPictureDelete ||this.form.isPictureDelete2 || this.form.isPictureDelete3 ) {
                    swal({
                        title: 'Jesteś pewien?',
                        text: "Zdjęcia zostaną usunięte",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Usuń!'
                    }).then((result) => {
                        // Send request to the server
                        if (result.value) {
                            this.$Progress.start();
                            this.form.put('http://localhost:8000/api/trainer/' + this.trainer.id).then(function () {
                                swal('Usunięto!', 'Zdjęcia zostały usunięte.', 'success');
                                _this.$Progress.finish();
                                // success
                                _this.isUpdateDisabled = true;
                                Fire.$emit('TrainerProfileSetupChange');
                            }).catch(function () {
                                _this.$Progress.fail();
                            });
                        }
                    })
                } else {
                    this.form.city = this.$refs.city.value;
                    this.$Progress.start();
                    this.form.put('http://localhost:8000/api/trainer/' + this.trainer.id).then(function (response) {
                        swal(response.data.title, response.data.message, response.data.status);
                        _this.$Progress.finish();
                        // success
                        _this.isUpdateDisabled = true;
                        Fire.$emit('TrainerProfileSetupChange');
                    }).catch(function () {
                        _this.$Progress.fail();
                    });
                }

            },
            addDiscipline() {
                this.showLookup = true;
                setTimeout(() => {
                    $('#lookupModal').modal('show');
                    Fire.$emit('lookupEvt', 'retrievePaintballPricingDisciplines','TrainerProfileSetup',this._uid);
                }, 350);
            },
            doAfterDisciplineAdded(data) {
                if(data.message !== null && data.message !== undefined){
                    swal(
                        'Uwaga!',
                        data.message,
                        'warning'
                    );
                } else {
                    swal(
                        'Sukces!',
                        'Nowy pakiet został dodany!',
                        'success'
                    );
                }
                Fire.$emit('TrainerProfileSetupChange');
            },
            attachNewDiscipline() {
                let _self = this;
                $('#priceModal').modal('hide');
                console.log('** attachNewDiscipline: ');
                let url = 'http://localhost:8000/api/attachDiscipline?' +
                    'disciplineId=' + this.disciplineId +
                    '&trainerId=' + this.trainer.id+'' +
                    '&price=' + this.price.label+
                    '&hoursDuration=' + this.hoursDuration.label;
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
            onLookupDisciplineUpdate(id) {
                $('#lookupModal').modal('hide');
                setTimeout(() => {
                    $('#priceModal').modal('show');
                }, 350);
                this.showLookup = false;
                this.disciplineId = id;
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
                        let url = 'http://localhost:8000/api/detachDiscipline?disciplineId='+id+'&trainerId='+this.trainer.id;
                        axios.get(url).then(({data}) => (
                            swal(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ),Fire.$emit('TrainerProfileSetupChange')
                        )).catch(()=>{
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })

            },
            editDiscipline(price,hoursDuration,id) {
                this.isDisciplineEdit = true;
                this.price = price;
                this.hoursDuration = hoursDuration;
                this.disciplineId = id;
                $('#priceModal').modal('show');
            },
            setHoursDuration(hoursDuration) {
                this.hoursDuration = hoursDuration;
            },
            setPrice(price) {
                this.price = price;
            },
            onClickImage(i) {
                this.index = i;
            },
            initializePictures(){
                let images = new Array();
                this.images = new Array();
                images.push(this.getPicture(this.form.picture));
                images.push(this.getPicture(this.form.picture2));
                images.push(this.getPicture(this.form.picture3));
                for (let i = 0; i < images.length; i++) {
                    if(images[i] !== null && images[i] !== undefined){
                        this.images.push(images[i]);
                    }
                }
                if(this.images !== null && this.images !== undefined) {
                    if(this.images.length === 1){
                        this.isPicture2Disabled = false;
                    }
                    if (this.images.length === 2 || this.images.length === 3){
                        this.isPicture3Disabled = false;

                    }
                }
            },
            getPicture(formPicture){
                if(formPicture !== null && formPicture !== undefined) {
                    let picture = (formPicture.length > 200) ? formPicture : "http://localhost:8000/img/trainer/"+ formPicture ;
                    this.isPicture2Disabled = false;
                    return picture;
                }
                return null;
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
                    this.isPicture2Disabled = false;
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
                    this.isPicture3Disabled = false;
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
            openTrainerView(id) {
                console.log('elllo trainer view');
                this.$router.replace({name: 'trainerView', params: { id: id } });

            },
            opinionsCalculate() {
                let opinions = this.trainer.opinions;
                if(opinions != null && opinions !== undefined) {
                    this.opinionsSum = opinions.length;

                }
                let it = opinions.values();
                let entry;
                let ratingSum = 0;
                while (!(entry = it.next()).done) {
                    ratingSum += entry.value.rating;
                }
                let avrage = ratingSum/this.opinionsSum;
                this.opinionsAverage = Math.round(avrage * 100) / 100;
            },
            redirectTo(socialMedia) {
                let url;
                if(socialMedia == 'instagram') {
                    url = this.trainer.instagramProfile;
                } else if (socialMedia == 'facebook') {
                    url = this.trainer.facebookProfile;
                } else if (socialMedia == 'snapchat') {
                    url = 'https://snapchat.com/add/'+this.trainer.snapchatProfile;
                } else if(socialMedia == 'website'){
                    url = this.trainer.website;
                    if (!url.match(/^https?:\/\//i)) {
                        url = 'http://' + url;
                    }
                }
                window.open(url, '_blank');

            },
            changePassword(){

                if ( (this.$refs.password.value == null || this.$refs.password.value == undefined
                    && (this.$refs.oldpassword == null || this.$refs.oldpassword != this.$refs.password))
                    || (this.$refs.password.value != this.$refs.password2.value) ){
                    swal('Warning!', 'Hasła nie są identyczne, upewnij się że wpisałeś to samo hasło w obu polach', 'warning');
                } else {

                    axios.post('/api/user-profile-password', {
                        id: this.authUserId,
                        newpassword: this.formPassword.newpassword,
                        password: this.formPassword.password
                    })
                        .then(function (response) {
                            if('Password does not match' == response.data.message ){
                                swal('Error!', 'Password does not match', 'error');
                            } else{
                                swal('Success!', 'Twoje hasło zostało zmienione', 'success');
                            }
                        })
                        .catch(function (error) {
                            console.log('## error %O',error);
                        });

                }

            },
            deleteUser() {

                swal({
                    title: 'Na pewno chcesz to zrobić?',
                    text: "Tej operacji nie da się cofnąć!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tak,usuń!'
                }).then((result) => {
                    if (result.value) {
                        axios.post('/api/user-profile-check-password', {
                            id: this.authUserId,
                            password: this.password
                        })
                            .then(function (response) {
                                if('ok' == response.data.message ){
                                    swal('Success!', 'Konto usunięte, za chwilę nastąpi wylogowanie', 'success');
                                    setTimeout(function () {
                                        window.open('http://localhost:8000/user-logout/' ,'_self');
                                    }, 4000);

                                } else if ('ko' == response.data.message){
                                    swal('Error!', 'Hasło się nie zgadza', 'error');
                                }
                            })
                            .catch(function (error) {
                                console.log('## error %O',error);
                            });
                    }
                })

            },
            offerClick() {
                if(this.inOfferTab == false){
                    this.inOfferTab = true;
                }
            },
            setPriceOptions(){
                for (let i = this.minPrice; i <= this.maxPrice; i+=5) {
                    let optionPrice = new Object();
                    optionPrice.id = i;
                    optionPrice.label = i;
                    this.optionsPrice.push(optionPrice);
                }
            },
            setTimeOptions(){
                for (let i = 1; i <= 5; i+=0.5) {
                    let optionTime = new Object();
                    optionTime.id = i;
                    optionTime.label = i;
                    this.optionsTime.push(optionTime);
                }
            }

        },
        created: function created() {
            console.log('Created trainer/TrainerProfileSetup');
            this.authUserId = this.$gate.getAuthUserId();
            this.loadProfile();
            Fire.$on('TrainerProfileSetupChange', () => {
                console.log('in TrainerProfileSetupChangeEVT');
                this.loadProfile();
            });
            Fire.$on('lookupEvtChosen', (id,componentName, index, apiName) => {
                if(index.toString() === this._uid.toString() && componentName !== undefined && componentName === 'TrainerProfileSetup'){
                    if(apiName === 'retrievePaintballPricingDisciplines') {
                        this.onLookupDisciplineUpdate(id);
                    }
                }
            });
        },
        destroyed() {
            DestroyedComponents.push(this._uid);
            Fire.$off('TrainerProfileSetupChange');
            console.log('!! trainer/TrainerProfileSetup: '+this._uid);
        },
        computed: {
            isDisabledAccountDelete(){
                return this.password.length < 5;
            },
            isDisabledChangePassword(){
                if(this.formPassword.password.length < 5 && this.formPassword.newpassword.length < 5){
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

</script>

<style scoped>
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
    i{
        cursor: pointer;
    }
</style>
