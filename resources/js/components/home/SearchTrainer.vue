<template>
    <div class="search" style="background-image: url('/img/forest-tree-dark.jpg');padding-bottom: 50px">
        <!--<section id="landing-search" class="d-flex">-->
        <div class="container">
            <p class="m-4">&nbsp;</p>
            <div class="card" style="background-color: rgba(255,255,255,0.9)!important;">
                <div class="card-header">
                    <div class="col-lg-12 py-1">
                        <h2 class="text-center">Najlepszy paintabll w okolicy!</h2>
                    </div>
                    <div class="col-lg-12 py-1">
                        <p class="text-center">Każdy z nas stawia przed sobą odmienne cele. Wybierz trenera, który
                            pomoże Ci osiągnąć Twoje!</p>
                    </div>
                    <button class="btn btn-outline-secondary" id="backToSearch" v-if="!isSearch"
                            @click.prevent="backToSearch">Wróć
                    </button>
                </div>
                <div class="card-body">
                    <div v-if="isSearch">
                        <div class="row">
                            <div class="col-3">
                                <h3 class="card-title p-1">
                                    W ofercie
                                </h3>
                                <div class="form-group">
                                    <div class="form-check" v-if="discipline.category == 'Paintball offer'"
                                         v-for="discipline in disciplines">
                                        <p-check class="p-icon p-round p-pulse" color="success" :checked="discipline.id == paramOffer"
                                                 @change="checkDiscipline(discipline.id)">{{discipline.name}}
                                        </p-check>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <!--<div v-if="availableCities">-->
                                    <label>Miasto</label>
                                    <v-select :options="citiesOptions" v-model="city" @change="cityChange"></v-select>
                                    <!--</div>-->
                                    <label>Województwo</label>
                                    <v-select :options="voivodeshipOptions" label="name" v-model="voivodeship"
                                              @change="voivodeshipChange"></v-select>
                                </div>
                                <button type="button" id="btn-search" @click.prevent="searchTrainer"
                                        class="btn btn-block btn-outline-secondary">
                                    Szukaj
                                </button>
                            </div>
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-4" v-for="trainer in trainers.data" :key="trainer.id">
                                        <!--<router-link class="nav-item" :to="{ name: 'trainerView',params: { id: '1' }}">-->
                                        <!--<router-link class="nav-item" to="/search-trainer/1">-->
                                        <!--<div class="card" style="cursor: pointer;">-->
                                        <div class="card" @click.prevent="openTrainerView(trainer.id)"
                                             style="cursor: pointer;">
                                            <img v-if="trainer.picture != null && trainer.picture != undefined"
                                                 class="card-img-top"
                                                 :src="'http://localhost:8000/img/trainer/'+trainer.picture"
                                                 style="height: 250px" alt="Card image cap">
                                            <img
                                                v-if="(trainer.picture == null || trainer.picture == undefined) && trainer.sex == 'woman'"
                                                class="card-img-top"
                                                src="http://localhost:8000/images/avatar_trainershub_woman.png"
                                                style="height: 250px" alt="Card image cap">
                                            <img
                                                v-if="(trainer.picture == null || trainer.picture == undefined) && trainer.sex == 'man'"
                                                class="card-img-top"
                                                src="http://localhost:8000/images/avatar_trainershub_man.png"
                                                style="height: 250px" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title mb-1">{{trainer.name}} {{trainer.surname}}</h5>
                                                <p class="mb-1" style="font-size: 12px">{{trainer.city}}</p>
                                                <p class="mb-1">
                                                    <font-awesome-icon
                                                        :icon="trainer.opinionsAverage >= 1 ? ['fas', 'star'] : ['far', 'star']"/>
                                                    <font-awesome-icon
                                                        :icon="trainer.opinionsAverage >= 2 ? ['fas', 'star'] : ['far', 'star']"/>
                                                    <font-awesome-icon
                                                        :icon="trainer.opinionsAverage >= 3 ? ['fas', 'star'] : ['far', 'star']"/>
                                                    <font-awesome-icon
                                                        :icon="trainer.opinionsAverage >= 4 ? ['fas', 'star'] : ['far', 'star']"/>
                                                    <font-awesome-icon
                                                        :icon="trainer.opinionsAverage >= 5 ? ['fas', 'star'] : ['far', 'star']"/>
                                                    <a>{{trainer.opinionsAverage}}</a>
                                                </p>
                                                <p class="mb-1"
                                                   v-if="trainer.opinionsSum !== null && trainer.opinionsSum !== undefined ">
                                                    <i class="fab fa-discourse mb-2"></i> Opinie ({{trainer.opinionsSum}})
                                                </p>
                                                <p class="mb-1"
                                                   v-if="trainer.opinionsSum === null || trainer.opinionsSum === undefined ">
                                                    <i class="fab fa-discourse mb-2"></i> Nie dodano jeszcze opinii
                                                </p>
                                                <p v-if="trainer.description == null" class="card-text"
                                                   style="font-size: 12px;height: 110px"></p>
                                                <p v-if="trainer.description !== null && trainer.description.length<170"
                                                   class="card-text" style="font-size: 12px;height: 110px">
                                                    {{trainer.description}}</p>
                                                <p v-if="trainer.description !== null && trainer.description.length>=170"
                                                   class="card-text" style="font-size: 12px;height: 110px">
                                                    {{trainer.description.substring(0,170)+"..."}}</p>
                                                <button type="button" id="btn-play" class="btn btn-block align-content-center"
                                                        @click.prevent="openTrainerView(trainer.id)">Graj!
                                                </button>
                                                <!--<router-link to="/search-trainer/1"> <a> Elllo</a></router-link>-->
                                            </div>
                                        </div>
                                        <!--</router-link>-->
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <pagination :data="trainers" @pagination-change-page="getResults"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                    <trainer-view v-if="!isSearch" :propTrainerId="trainerId"></trainer-view>

                </div>
                <!-- /.card-body -->
            </div>

        </div>
        <!--</section>-->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                paramCity: this.$route.params.paramCity,
                paramOffer: this.$route.params.paramOffer,
                paramVoivodeship: this.$route.params.paramVoivodeship,
                checkedDisciplines: [],
                disciplines : {},
                cities: [],
                voivodeship: null,
                city: null,
                currentCity: '',
                trainerId: '',
                cityHelpText: '',
                trainers: {},
                locations: [],
                isSearch: true,
                voivodeshipOptions: [],
                citiesOptions: [],
                form: new Form({
                    id : ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                let url;
                if(this.cities.includes(this.currentCity)) {
                    url = 'http://localhost:8000/api/searchTrainer?' +
                        'disciplines=' + this.checkedDisciplines +
                        '&city=' + this.currentCity+'&page='+page;
                } else {
                    url = 'http://localhost:8000/api/searchTrainer?' +
                        'disciplines=' + this.checkedDisciplines +
                        '&page='+page;
                }

                console.log('URL: ',url);
                axios.get(url)
                    .then(response => {
                        this.trainers = response.data;
                    });
            },
            retrieveDisciplines() {
                console.log('retrieveDisciplines ');
                    axios.get("api/welcomeDisciplines").then(({ data }) => (
                        this.disciplines = data));
            },
            retrieveCities() {
                console.log('retrieveCities ');
                let _self = this;
                    axios.get("api/cities").then(({ data }) => (
                        this.cities = data,
                    _self.prepareCities(data)));
            },
            searchTrainer(){
                let url;
                let isDisciplenesSelected = this.checkedDisciplines.length != 0;
                if(this.city != null && isDisciplenesSelected) {
                    url = 'http://localhost:8000/api/searchTrainer?' +
                        'disciplines=' + this.checkedDisciplines +
                        '&city=' + this.city;
                } else if(this.city != null && !isDisciplenesSelected) {
                    url = 'http://localhost:8000/api/searchTrainer?' +
                        '&city=' + this.city;
                } else if(this.city == null && this.voivodeship == null && isDisciplenesSelected) {
                    url = 'http://localhost:8000/api/searchTrainer?' +
                        'disciplines=' + this.checkedDisciplines;
                } else if(this.city == null && this.voivodeship != null && isDisciplenesSelected) {
                    url = 'http://localhost:8000/api/searchTrainer?' +
                        'disciplines=' + this.checkedDisciplines +
                        '&voivodeship=' + this.voivodeship;
                } else if(this.city == null && this.voivodeship != null && !isDisciplenesSelected) {
                    url = 'http://localhost:8000/api/searchTrainer?' +
                        'voivodeship=' + this.voivodeship;
                } else {
                    url = 'http://localhost:8000/api/searchTrainer';
                }


                axios.get(url).then(({data}) => (
                    this.trainers = data,
                        console.log('trainers: ',this.trainers)
                )).catch(()=>{
                    swal("Failed!", "There was something wrong.", "warning");
                });
            },
            checkDiscipline(id) {
                console.log('id: '+id);
                if(this.checkedDisciplines.includes(id)){
                    let indexToRemove = this.checkedDisciplines.indexOf(id);
                    this.checkedDisciplines.splice(indexToRemove,1);
                } else {
                    this.checkedDisciplines.push(id);
                }
            },
            openTrainerView(id) {
                // this.$router.replace({name: 'trainerView', params: { id: id } });
                this.trainerId = id;
                this.isSearch = false;
                window.scrollTo(0,0);

            },
            backToSearch() {
                // this.$router.replace({name: 'trainerView', params: { id: id } });
                this.isSearch = true;

            },
            setLocations(values, key){
                let locObj = new Object();
                locObj.name = key;
                locObj.cities = values;
                this.locations.push(locObj);
            },
            prepareCities(){
                let voivodeship2city = new Map();
                for (let i = 0; i < this.cities.length; i++) {
                    if(voivodeship2city.has(this.cities[i].voivodeship)){
                        let tmpCities = voivodeship2city.get(this.cities[i].voivodeship);
                        tmpCities.push(this.cities[i].name);
                        this.citiesOptions.push(this.cities[i].name);
                        voivodeship2city.set(this.cities[i].voivodeship,tmpCities);

                    } else {
                        voivodeship2city.set(this.cities[i].voivodeship,new Array(this.cities[i].name));
                        this.citiesOptions.push(this.cities[i].name);
                    }
                }

                voivodeship2city.forEach(this.setLocations);


            },
            prepareVoivodeship(){
                this.voivodeshipOptions = ['Dolnośląskie','Kujawsko-pomorskie','Lubelskie','Lubuskie','Łódzkie','Małopolskie',
                    'Mazowieckie','Opolskie','Podkarpackie','Podlaskie','Pomorskie','Śląskie','Świętokrzyskie',
                'Warmińsko-mazurskie','Wielkopolskie','Zachodniopomorskie'];
            },
            voivodeshipChange(){
                if(this.voivodeship != null){
                    this.city = null;
                }
            },
            cityChange(){
                if(this.city != null){
                    this.voivodeship = null;
                }
            }
        },
        computed: {
      /*      availableCities() {
                return this.voivodeship ? this.voivodeship.cities : false
            }*/
        },
        created: function created() {
            console.log('** SearchTrainerBox created: '+this._uid);
            this.city = this.paramCity;
            this.voivodeship = this.paramVoivodeship;
            this.retrieveDisciplines();
            this.checkDiscipline(this.paramOffer);
            this.prepareVoivodeship();
            this.retrieveCities();
            this.searchTrainer();
            this.currentCity = this.cityHelpText;
        }
    }
</script>

<style lang="scss">
    #landing-search {
        margin-top: 50px;
        background-image: url('/img/paintball-main.JPG');
        background-size: cover;
        background-repeat: no-repeat;
        width: 100%;
        height: 100vh;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column; }
    #search {
        background-image: url('/img/paintball-main.JPG');
        background-size: cover;
        background-repeat: no-repeat;
        width: 100%;
        /*height: 100vh;*/
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column; }
    #landing-search .container search{
        /*font-size: 100px;*/
    }
    #search .container .card .card-header {
        color: white;
        font-weight: 500;
        font-size: 3.5em; }
/*    #search .container .card .card-body .btn{
        background-color: #052617;
        color: white;}*/
    #backToSearch{
        background-color: #052617;
        color: white;
    }
    #backToSearch:hover{
        background-color: #260101;
        color: white;
    }
    #btn-play {
        background-color: #052617;
        color: white;
    }
    #btn-search {
        background-color: #8C1822;
        color: white;
    }
    #btn-search:hover {
        background-color: #260101;
        color: white;
    }
    @import '~pretty-checkbox/src/pretty-checkbox.scss';

    $fa-font-path : "~@fortawesome/fontawesome-free-webfonts/webfonts";
</style>
