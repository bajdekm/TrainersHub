<template>
    <div>
        <div ref="testDiv"></div>
        <div class="row">
            <div class="col-lg-3 col-sm-12 hidden-xs-down d-none d-lg-block"> <!--for lg size start-->
                <img v-if="trainer.picture != null && trainer.picture != undefined" class="img-thumbnail p-0" :src="'http://localhost:8000/img/trainer/'+trainer.picture" style="height: 250px;width: 250px; border: none" alt="Card image cap">
                <img v-if="(trainer.picture == null || trainer.picture == undefined) && trainer.sex == 'woman'" class="img-thumbnail p-0" src="http://localhost:8000/images/avatar_trainershub_woman.png" style="height: 250px;width: 250px; border: none" alt="Card image cap">
                <img v-if="(trainer.picture == null || trainer.picture == undefined) && trainer.sex == 'man'" class="img-thumbnail p-0" src="http://localhost:8000/images/avatar_trainershub_man.png" style="height: 250px;width: 250px; border: none" alt="Card image cap">
                <h5 class="card-title my-1">{{trainer.name}} {{trainer.surname}}</h5>
                <p class="mb-1">
                    <font-awesome-icon :icon="trainer.opinionsAverage >= 1 ? ['fas', 'star'] : ['far', 'star']" />
                    <font-awesome-icon :icon="trainer.opinionsAverage >= 2 ? ['fas', 'star'] : ['far', 'star']" />
                    <font-awesome-icon :icon="trainer.opinionsAverage >= 3 ? ['fas', 'star'] : ['far', 'star']" />
                    <font-awesome-icon :icon="trainer.opinionsAverage >= 4 ? ['fas', 'star'] : ['far', 'star']" />
                    <font-awesome-icon :icon="trainer.opinionsAverage >= 5 ? ['fas', 'star'] : ['far', 'star']" />
                    <a>{{trainer.opinionsAverage}}</a>
                </p>
                <!--<p class="mb-1" @click="goToOpinionTab" style="cursor: pointer"><i class="fab fa-discourse mb-2"></i> Opinie ({{opinionsSum}})</p>-->
                <p class="mb-1" v-if="trainer.opinionsSum !== null && trainer.opinionsSum !== undefined " @click="goToOpinionTab" id="opinionSum">
                    <i class="fab fa-discourse mb-2"></i> Opinie ({{trainer.opinionsSum}})
                </p>
                <p class="mb-1" v-if="trainer.opinionsSum === null || trainer.opinionsSum === undefined ">
                    <i class="fab fa-discourse mb-2"></i> Nie dodano jeszcze opinii
                </p>
                <div v-if="trainer.city != null">
                    <strong>Miasto</strong>
                    <p class="mb-1 ml-1">{{trainer.city}}</p>
                </div>
                <div v-if="trainer.phone != null">
                    <strong>Telefon</strong>
                    <p class="mb-1 ml-1"> {{trainer.phone}}</p>
                </div>
                <strong>Email</strong>
                <p class="mb-1 ml-1"> {{trainer.email}}</p>
                <strong>Social media</strong>
                <p class="mb-1" >
                <div v-if="hasSocialMedia" class="social-media">
                    <i v-if="trainer.instagramProfile !== null && trainer.instagramProfile !== undefined" class="fab fa-instagram fa-3x" @click="redirectTo('instagram')"></i>
                    <i v-if="trainer.facebookProfile !== null && trainer.facebookProfile !== undefined" class="fab fa-facebook fa-3x" @click="redirectTo('facebook')"></i>
                    <i v-if="trainer.snapchatProfile !== null && trainer.snapchatProfile !== undefined" class="fab fa-snapchat-square fa-3x" @click="redirectTo('snapchat')"></i>
                </div>
                <div v-if="!hasSocialMedia" class="social-media">Brak informacji</div>
                </p>
                <strong>Strona</strong>
                <p v-if="trainer.website !== null && trainer.website !== undefined" class="mv-1 ml-1"><a href="" style="color: black" @click="redirectTo('website')">{{trainer.website}}</a></p>
                <p v-if="trainer.website === null || trainer.website === undefined" class="mv-1 ml-1"><a href="" style="color: black">Brak informacji</a></p>
            </div>  <!--for lg size stop-->
                <div class="col-5 d-lg-none">  <!--for lower than lg size start-->
                    <img class="card-img-top" :src="'http://localhost:8000/img/trainer/'+trainer.picture" style="height: 125px;width: 125px" alt="Card image cap">
                    <h5 class="card-title mb-1">{{trainer.name}} {{trainer.surname}}</h5>
                    <p class="mb-1">
                        <font-awesome-icon :icon="trainer.opinionsAverage >= 1 ? ['fas', 'star'] : ['far', 'star']" />
                        <font-awesome-icon :icon="trainer.opinionsAverage >= 2 ? ['fas', 'star'] : ['far', 'star']" />
                        <font-awesome-icon :icon="trainer.opinionsAverage >= 3 ? ['fas', 'star'] : ['far', 'star']" />
                        <font-awesome-icon :icon="trainer.opinionsAverage >= 4 ? ['fas', 'star'] : ['far', 'star']" />
                        <font-awesome-icon :icon="trainer.opinionsAverage >= 5 ? ['fas', 'star'] : ['far', 'star']" />
                        <a>{{trainer.opinionsAverage}}</a>
                    </p>
                    <p class="mb-1" v-if="trainer.opinionsSum !== null || trainer.opinionsSum !== undefined " @click="goToOpinionTab" id="opinionSum">
                        <i class="fab fa-discourse mb-2"></i> Opinie ({{trainer.opinionsSum}})
                    </p>
                    <p class="mb-1" v-if="trainer.opinionsSum === null || trainer.opinionsSum === undefined ">
                        <i class="fab fa-discourse mb-2"></i> Nie dodano jeszcze opinii
                    </p>                        </div>
                <div class="col-7 d-lg-none">
                    <strong>Adres</strong>
                    <p class="mb-1">{{trainer.street}}, {{trainer.postalCode}}, {{trainer.city}}</p>
                    <strong>Telefon</strong>
                    <p class="mb-1">{{trainer.phone}}</p>
                    <strong>Email</strong>
                    <p class="mb-1">{{trainer.email}}</p>
                    <strong>Social media</strong>
                    <p class="mb-1" >
                    <div v-if="hasSocialMedia" class="social-media">
                        <i v-if="trainer.instagramProfile !== null && trainer.instagramProfile !== undefined" class="fab fa-instagram fa-3x" @click="redirectTo('instagram')"></i>
                        <i v-if="trainer.facebookProfile !== null && trainer.facebookProfile !== undefined" class="fab fa-facebook fa-3x" @click="redirectTo('facebook')"></i>
                        <i v-if="trainer.snapchatProfile !== null && trainer.snapchatProfile !== undefined" class="fab fa-snapchat-square fa-3x" @click="redirectTo('snapchat')"></i>
                    </div>
                    <div v-if="!hasSocialMedia" class="social-media">Brak informacji</div>
                    </p>
                    <strong>Strona</strong>
                    <p v-if="trainer.website !== null && trainer.website !== undefined" class="mv-1"><a href="" style="color: black" @click="redirectTo('website')">{{trainer.website}}</a></p>
                    <p v-if="trainer.website === null || trainer.website === undefined" class="mv-1"><a href="" style="color: black">Brak informacji</a></p>
                </div><!--for lower than lg size stop-->
            <div class="col-lg-9 col-sm-12">
                <div class="card">
                    <div class="card-header p-2" style="background-color: white">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a v-if="navText == textAboutMe" class="nav-link active show" href="#about" data-toggle="tab" @click="navItemClick(textAboutMe)">{{this.textAboutMe}}</a>
                                <a v-if="navText !== textAboutMe" class="nav-link" href="#about" data-toggle="tab" @click="navItemClick(textAboutMe)">O mnie</a>
                            </li>
                            <li class="nav-item">
                                <a v-if="navText == textPrices" class="nav-link active show" href="#prices" data-toggle="tab" @click="navItemClick(textPrices)">{{this.textPrices}}</a>
                                <a v-if="navText !== textPrices" class="nav-link" href="#prices" data-toggle="tab" @click="navItemClick(textPrices)">{{this.textPrices}}</a>
                            </li>
                            <li class="nav-item">
                                <a v-if="navText == textPhotos" class="nav-link active show" href="#photos" data-toggle="tab" @click="navItemClick(textPhotos)">{{this.textPhotos}}</a>
                                <a v-if="navText !== textPhotos" class="nav-link" href="#photos" data-toggle="tab" @click="navItemClick(textPhotos)">{{this.textPhotos}}</a>
                            </li>
                            <li class="nav-item">
                                <a v-if="navText == textOpinion" class="nav-link active show" href="#opinion" data-toggle="tab" @click="navItemClick(textOpinion)">{{this.textOpinion}}</a>
                                <a v-if="navText !== textOpinion" class="nav-link" href="#opinion" data-toggle="tab" @click="navItemClick(textOpinion)">{{this.textOpinion}}</a>
                            </li>
                            <li class="nav-item">
                                <a v-if="navText == textOffer" class="nav-link active show" href="#offer" data-toggle="tab" @click="navItemClick(textOffer)">{{this.textOffer}}</a>
                                <a v-if="navText !== textOffer" class="nav-link" href="#offer" data-toggle="tab" @click="navItemClick(textOffer)">{{this.textOffer}}</a>
                            </li>
                      <!--      <li class="nav-item">
                                <a v-if="navText == textGyms" class="nav-link active show" href="#gyms" data-toggle="tab" @click="navItemClick(textGyms)">{{this.textGyms}}</a>
                                <a v-if="navText !== textGyms" class="nav-link" href="#gyms" data-toggle="tab" @click="navItemClick(textGyms)">{{this.textGyms}}</a>
                            </li>-->
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Preview Tab -->
                            <div class="tab-pane active show" id="about">
                                <strong>O sobie</strong>
                                <p class="ml-1">{{trainer.description}}</p>
                                <strong>Doświadczenie</strong>
                                <p class="ml-1">{{trainer.experiences}}</p>
                            </div>


                            <div id="not-logged-user">
                                <b-modal ref="not-logged-modal" hide-footer title="Aby wysłać wiadomość zaloguj się lub użyj poniższego formularza">
                                    <div class="d-block text-center">
                                    </div>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputName" class="col control-label">Imię i Nazwisko</label>
                                            <div class="col-sm-12">
                                                <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Imię">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col control-label">Email</label>
                                            <div class="col-sm-12">
                                                <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDate" class="col control-label">Data</label>
                                            <div class="col-sm-12">
                                                <input type="date" v-model="form.date" class="form-control" id="inputDate" placeholder="Data">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputStopDate" class="col control-label">Czas rozpoczęcia</label>
                                            <div class="col-sm-12">
                                                <input type="time" v-model="form.startTime" class="form-control" id="inputStopDate" placeholder="Data rozpoczęcia">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputTime" class="col control-label">Czas zakończania</label>
                                            <div class="col-sm-12">
                                                <input type="time" v-model="form.stopTime" class="form-control" id="inputTime" placeholder="Czas zakończania">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputExperience" class="col control-label">Wiadomość</label>
                                            <div class="col-sm-12">
                                                <textarea v-model="form.message" class="form-control" id="inputExperience" placeholder="Wiadomość"></textarea>
                                            </div>
                                        </div>
                                        <b-button class="mt-3" variant="outline-success" block @click="sendForm">Wyślij</b-button>
                                        <b-button class="mt-3" variant="outline-danger" block @click="hideModal">Anuluj</b-button>
                                    </form>
                                </b-modal>
                            </div>

                            <div id="logged-user">
                                <b-modal ref="logged-modal" hide-footer title="Użyj poniższego formularza do kontaktu">
                                    <div class="d-block text-center">
                                    </div>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputDate" class="col control-label">Data</label>
                                            <div class="col-sm-12">
                                                <input type="date" v-model="form.date" class="form-control" id="inputDate2" placeholder="Data">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputStopDate" class="col control-label">Czas rozpoczęcia</label>
                                            <div class="col-sm-12">
                                                <input type="time" v-model="form.startTime" class="form-control" id="inputStopDate2" placeholder="Data rozpoczęcia">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputTime" class="col control-label">Czas zakończania</label>
                                            <div class="col-sm-12">
                                                <input type="time" v-model="form.stopTime" class="form-control" id="inputTime2" placeholder="Czas zakończania">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputExperience" class="col control-label">Wiadomość</label>
                                            <div class="col-sm-12">
                                                <textarea v-model="form.message" class="form-control" id="inputExperience2" placeholder="Wiadomość"></textarea>
                                            </div>
                                        </div>
                                        <b-button class="mt-3" variant="outline-success" block @click="sendForm">Wyślij</b-button>
                                        <b-button class="mt-3" variant="outline-danger" block @click="hideModal">Anuluj</b-button>
                                    </form>
                                </b-modal>
                            </div>





                                    <!-- Details Tab -->
                                    <div class="tab-pane" id="prices">
                                        <div v-if="hasPrices && discipline.category == 'Paintball pricing'" v-for="discipline in trainer.disciplines" class="row h-100 mb-1">
                                            <div class="col-lg-5 my-auto text-center">{{discipline.name | upText}}</div>
                                            <div class="col-lg-2 my-auto text-center">{{discipline.pivot.hoursDuration}} h</div>
                                            <div class="col-lg-2 my-auto text-center">{{discipline.pivot.price}},00 zł</div>
                                            <div class="col-lg-3">

                                                <div v-if="authUserId != null">
                                                    <button type="button" @click.prevent="showModal" class="btn btn-block btn-outline-secondary">
                                                        Rezerwuj
                                                    </button>

                                                </div>
                                                <div v-else>
                                                    <button type="button" @click.prevent="loginRedirect" class="btn btn-block btn-outline-secondary">
                                                        Rezerwuj
                                                    </button>
                                                </div>


                                            </div>
                                        </div>
                                        <div v-if="!hasPrices">
                                            <p>Cennik nie został jeszcze uzupełniony przez trenera</p>
                                        </div>
                                    </div>

                            <div class="tab-pane" id="photos">
                                <div id="vue-gallery">
                                    <div v-if="images !== null">
                                        <img class="image-gallery" v-for="(image, i) in images" :src="image" @click="onClickImage(i)">
                                        <vue-gallery-slideshow :images="images" :index="index" @close="index = null"></vue-gallery-slideshow>
                                    </div>
                                    <div v-if="!images.length">
                                        Zdjęcia nie zostały jeszcze dodane przez trenera
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="offer">
                                <p>Eloo</p>
                                <trainer-offer v-if="inOfferTab" :trainerDisciplines="trainer.disciplines"></trainer-offer>
                            </div>
                            <div class="tab-pane" id="opinion">
                                <!--<div v-if="!hasUserAddedOpinion && isUserOpinionApproved == 1" class="row">-->
                                <div class="row">
                                    <div class="col-12">
                                        <button v-if="isUserOpinionApproved == 0 && hasUserAddedOpinion == false && !$gate.isTrainer()" type="button" @click="addOpinion" class="btn btn-outline-secondary my-2 float-right">
                                            Dodaj opinie
                                        </button>
                                        <p v-if="isUserOpinionApproved == 0 && hasUserAddedOpinion == true">Twoja opinia oczekuje na akceptacje moderatora</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div v-if="trainer.opinionsSum !== null || trainer.opinionsSum !== undefined " v-for="opinion in approvedOpinions" class="border-top">
                                            <div>
                                                <!--<div class="d-flex justify-content-between bd-highlight d-sm-none"> ukrywa od sm w zwyz-->
                                                <!--<div class="d-flex justify-content-between bd-highlight d-sm-inline d-md-none"> pokazuje od md w dol-->
                                                <div class="d-flex justify-content-between bd-highlight">
                                                    <p v-if="opinion.user.id == authUserId" class="p-2 bd-highlight">
                                                        <a style="font-weight: 900; text-decoration: underline">{{opinion.user.name}} {{opinion.user.surname}}</a> <a style="font-size: 12px">({{opinion.user.created_at | myDate}})</a>
                                                    </p>
                                                    <p v-if="opinion.user.id != authUserId" class="p-2 bd-highlight">
                                                        <a>{{opinion.user.name}} {{opinion.user.surname}}</a> <a style="font-size: 12px">({{opinion.user.created_at | myDate}})</a>
                                                    </p>

                                                    <p class="p-2 bd-highlight d-block">
                                                        <i v-if="opinion.rating >= 1" class="fas fa-star"></i>
                                                        <i v-if="opinion.rating >= 2" class="fas fa-star"></i>
                                                        <i v-if="opinion.rating >= 3" class="fas fa-star"></i>
                                                        <i v-if="opinion.rating >= 4" class="fas fa-star"></i>
                                                        <i v-if="opinion.rating >= 5" class="fas fa-star"></i>
                                                    </p>
                                                </div>
                                                <div class="d-flex justify-content-start border-bottom">
                                                    <p class="pl-2 mb-4 bd-highlight" style="font-size: 13px">{{opinion.comment}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div v-if="trainer.opinionsSum === null || trainer.opinionsSum === undefined ">
                                            Nie dodano jeszcze opinii
                                        </div>
                                        </div>
                                </div>


                            </div>
                            <div class="tab-pane" id="gyms">
                                <p>Gyms</p>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <div class="card-footer p-2" style="background-color: white">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a v-if="navText == textAboutMe" class="nav-link active show" href="#about" data-toggle="tab" @click="navItemClick(textAboutMe)">{{this.textAboutMe}}</a>
                                <a v-if="navText !== textAboutMe" class="nav-link" href="#about" data-toggle="tab" @click="navItemClick(textAboutMe)">{{this.textAboutMe}}</a>
                            </li>
                            <li class="nav-item">
                                <a v-if="navText == textPrices" class="nav-link active show" href="#prices" data-toggle="tab" @click="navItemClick(textPrices)">{{this.textPrices}}</a>
                                <a v-if="navText !== textPrices" class="nav-link" href="#prices" data-toggle="tab" @click="navItemClick(textPrices)">{{this.textPrices}}</a>
                            </li>
                            <li class="nav-item">
                                <a v-if="navText == textPhotos" class="nav-link active show" href="#photos" data-toggle="tab" @click="navItemClick(textPhotos)">{{this.textPhotos}}</a>
                                <a v-if="navText !== textPhotos" class="nav-link" href="#photos" data-toggle="tab" @click="navItemClick(textPhotos)">{{this.textPhotos}}</a>
                            </li>
                            <li class="nav-item">
                                <a v-if="navText == textOpinion" ref="opinionTab" class="nav-link active show" href="#opinion" data-toggle="tab" @click="navItemClick(textOpinion)">{{this.textOpinion}}</a>
                                <a v-if="navText !== textOpinion" ref="opinionTab" class="nav-link" href="#opinion" data-toggle="tab" @click="navItemClick(textOpinion)">{{this.textOpinion}}</a>
                            </li>
                            <li class="nav-item">
                                <a v-if="navText == textOffer" class="nav-link active show" href="#offer" data-toggle="tab" @click="navItemClick(textOffer)">{{this.textOffer}}</a>
                                <a v-if="navText !== textOffer" class="nav-link" href="#offer" data-toggle="tab" @click="navItemClick(textOffer)">{{this.textOffer}}</a>
                            </li>
                     <!--       <li class="nav-item">
                                <a v-if="navText == textGyms" class="nav-link active show" href="#gyms" data-toggle="tab" @click="navItemClick(textGyms)">{{this.textGyms}}</a>
                                <a v-if="navText !== textGyms" class="nav-link" href="#gyms" data-toggle="tab" @click="navItemClick(textGyms)">{{this.textGyms}}</a>
                            </li>-->
                        </ul>
                    </div>
                    <!-- /.tab-content -->
        </div>

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
                        <add-opinion :trainerId="trainer.id" :hasUserAddedOpinion="hasUserAddedOpinion"></add-opinion>
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
                id: this.$route.params.id,
                authUserId: '',
                showLookup: false,
                isUserOpinionApproved: 0,
                trainer: {},
                navText: 'O mnie',
                textAboutMe: 'O mnie',
                textPrices: 'Cennik',
                textOpinion: 'Opinie',
                textOffer: 'Oferta',
                textPhotos: 'Zdjęcia',
                textGyms: 'Siłownie',
                opinionsSum: 0,
                opinionsAverage: 0.0,
                profileOpinion: false,
                hasUserAddedOpinion: false,
                hasSocialMedia: false,
                hasDisciplines: false,
                hasPrices: false,
                inOfferTab: false,
                images: [],
                approvedOpinions: [],
                imagesPath: 'http://localhost:8000/img/trainer/',
                index: null,
                form: new Form({
                    name : '',
                    date : '',
                    startTime : '',
                    stopTime : '',
                    message : '',
                    email : ''
                })
            }
        },
        props: ['propTrainerId'],
        methods: {
            loadTrainer: function loadGyms() {
                let trainerId = this.id;
                if(this.propTrainerId != null){
                    console.log('prop nie null');
                    trainerId = this.propTrainerId;
                }
                console.log('** Load trainer: '+trainerId);
                let _self = this;
                let url = 'http://localhost:8000/api/viewTrainer/?trainer='+trainerId;
                axios.get(url).then(({data}) => (
                    console.log('** trainer: ',data),
                        this.trainer = data,
                        _self.initialization()
                ));
            },
            initialization(){
                this.opinionsCalculate();
                this.initializePictures();
                this.initializeSocialMedia();
                this.initializePrices();
                if(this.trainer.disciplines.length != 0){
                    this.hasDisciplines = true;
                }
            },
            navItemClick(text) {
                window.scrollTo(0,0);
                this.navText = text;
                if(text == this.textOffer){
                    this.inOfferTab = true;
                }
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
                }
                window.open(url, '_blank');
            },
            goToOpinionTab($event) {
                const elem = this.$refs.opinionTab;
                elem.click();
            },
            createReservation() {
                    this.showModal();
            },
            opinionsCalculate() {
                let opinions = this.trainer.opinions;
                let it = opinions.values();
                let entry;
                let ratingSum = 0;
                while (!(entry = it.next()).done) {
                    if(entry.value.approved == true) {
                        this.approvedOpinions.push(entry.value);
                    }

                    if(this.authUserId == entry.value.user_id){
                        this.hasUserAddedOpinion = true;
                        this.isUserOpinionApproved = entry.value.approved;
                    }
                }
                console.log('isUserOpinionApproved: '+this.isUserOpinionApproved);
            },
            initializePictures() {
                if(this.trainer.picture !== null && this.trainer.picture !== undefined) {
                    this.images[0] = this.imagesPath+this.trainer.picture;
                }
                if(this.trainer.picture2 !== null && this.trainer.picture2 !== undefined) {
                    this.images[1] = this.imagesPath+this.trainer.picture2;
                }
                if(this.trainer.picture3 !== null && this.trainer.picture3 !== undefined) {
                    this.images[2] = this.imagesPath+this.trainer.picture3;
                }
            },
            initializeSocialMedia(){
                if(this.trainer.instagramProfile !== null && this.trainer.instagramProfile !== undefined) {
                    this.hasSocialMedia = true;
                    return;
                } else if(this.trainer.facebookProfile !== null && this.trainer.facebookProfile !== undefined) {
                    this.hasSocialMedia = true;
                    return;
                } else if(this.trainer.snapchatProfile !== null && this.trainer.snapchatProfile !== undefined) {
                    this.hasSocialMedia = true;
                    return;
                }
            },
            initializePrices() {
                if(this.trainer.disciplines == null){
                    return;
                }
                for (let discipline of this.trainer.disciplines) {
                    console.log('disc: ',discipline.category);
                    if(discipline.category == 'Paintball pricing') {
                        this.hasPrices = true;
                        return;
                    }
                }
            },
            onClickImage(i) {
                this.index = i;
            },
            addOpinion() {
                console.log('add opp');
                this.showLookup = true;
                setTimeout(() => {
                    $('#lookupModal').modal('show');
                }, 350);
            },
            doAfrerOpinionAdded(){
                $('#lookupModal').modal('hide');
                this.loadTrainer();
            },

            showModal() {

                if( this.authUserId != undefined || this.authUserId != null ){
                    this.$refs['logged-modal'].show()
                }
                else{
                    this.$refs['not-logged-modal'].show()
                }
            },
            loginRedirect(){
                window.open("/login");
            },
            hideModal() {
                this.$refs['logged-modal'].hide()
                this.$refs['not-logged-modal'].hide()
            },
            sendForm(){

                if( this.authUserId != undefined || this.authUserId != null ){
                    this.doPOSTForLoggedUser();
                }
                else{
                    this.doPOSTForNotLoggedUser();
                }

            },
            doPOSTForNotLoggedUser(){
                if( this.validateEmail( this.form.email ) && this.checkDates() ){

                    axios.post('/api/send-public-email', {
                        type: 'nlg',
                        name: this.form.name,
                        startTime: this.form.startTime,
                        stopTime: this.form.stopTime,
                        date: this.form.date,
                        email: this.form.email,
                        message: this.form.message
                    })
                        .then(function (response) {
                            swal('Success!', 'Wiadomośc została wysłana', 'success');

                        })
                        .catch(function (error) {
                            console.log('## error %O',error);
                        });
                }
                console.log('@@ form sent ' + this.form.email);
                this.hideModal();
            },
            doPOSTForLoggedUser(){

                if( this.checkDates() ){

                    axios.post('/api/send-public-email', {
                        type: 'lg',
                        id: this.authUserId,
                        name: this.form.name,
                        startTime: this.form.startTime,
                        stopTime: this.form.stopTime,
                        date: this.form.date,
                        email: this.form.email,
                        message: this.form.message
                    })
                        .then(function (response) {
                            swal('Success!', 'Wiadomośc została wysłana', 'success');

                        })
                        .catch(function (error) {
                            console.log('## error %O',error);
                        });
                }
                this.hideModal();
            },
            validateEmail( email ){
                let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                let result = re.test(String(email).toLowerCase());
                if( !result ){
                    swal('Error!', 'Email nie jest poprawny', 'error');
                }
                return result;
            },
            checkDates(){
                let dtStart = new Date("1/1/2011 " + this.form.startTime);
                let dtEnd = new Date("1/1/2011 " + this.form.stopTime);
                let difference_in_milliseconds = dtEnd - dtStart;

                if( difference_in_milliseconds < 0 ){
                    swal('Error!', 'Data zakończenia wcześniejsza niż rozpoczęcia', 'error');
                }

                return difference_in_milliseconds > 0;
            }

        },
        created: function created() {
            console.log('** TrainerView created: '+this._uid);
            // this.$router.history.updateRoute({ path: '/search-trainer/trainer/1' });
            console.log('TrainerView router: ',this.$router);
            this.loadTrainer();
            this.authUserId = this.$gate.getAuthUserId();
            Fire.$on('opinionAdded', () => {
                this.doAfrerOpinionAdded();
            });
        }
    }
</script>

<style scoped>
    .nav-link.active {
        background-color: #260101;
        color: white;
    }
    .nav-link {
        color: black;
    }
    .social-media{
        cursor: pointer;
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
    #opinionSum {
        cursor: pointer;
    }
    .page-item.active .page-link{
        background-color: #8C1822;
        color: white;
    }
    .page-item.pagination-page-nav{
        color: #8C1822;
    }

</style>
