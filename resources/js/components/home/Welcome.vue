<template>
    <div>
        <div id="loader" class="hide"><img src="images/icon/Spinner.gif" alt=""></div>
        <section id="landing-page" class="d-flex">
        <!--<section id="landing-page" class="d-flex" style="background-image:url('http://localhost:8000/img/sport-background.jpg')">-->
            <div class="container-fluid">
                <div class="row d-flex justify-content-center flex-column">
               <!--     <div class="text-on">
                        <h1>Znajdź paintball w Twojej okolicy</h1>
                        <p>Wypróbuj jeśli szukasz wspaniałej zabawy i dużej dawki adrenaliny!</p>
                    </div>-->
                    <div class="searcher container">
                        <h1>Znajdź paintball w Twojej okolicy</h1>
                        <p>Wypróbuj jeśli szukasz wspaniałej zabawy i dużej dawki adrenaliny!</p>
                            <div class="col-md-12 pr-0 text-center">
                                <div class="row justify-content-center my-2">
                                    <v-select placeholder="Wybierz miasto w ktorym chcesz zagrac" :options="citiesOptions" v-model="city"></v-select>

                                </div>
                                <div class="row justify-content-center my-2">
                                    <button class="btn btn-block btn-success" @click.prevent="goToSearchTrainer(city)">Szukaj</button>
                                </div>
                            </div>
                        <div class="catLinks">
                            <a @click.prevent="goToSearchTrainer('Warszawa',null)">Warszawa</a>
                            <a @click.prevent="goToSearchTrainer('Łódź',null)">Łódź</a>
                            <a @click.prevent="goToSearchTrainer('Poznań',null)">Poznań</a>
                            <a @click.prevent="goToSearchTrainer('Kraków',null)">Kraków</a>
                            <a @click.prevent="goToSearchTrainer('Gdańsk',null)">Gdańsk</a>
                            <a @click.prevent="goToSearchTrainer(null,null,'Wielkopolskie')">Wielkopolskie</a>
                            <a @click.prevent="goToSearchTrainer(null,null,'Mazowieckie')">Mazowieckie</a>
                            <a @click.prevent="goToSearchTrainer(null,null,'Łódzkie')">Łódzkie</a>
                            <a @click.prevent="goToSearchTrainer(null,null,'Pomorskie')">Pomorskie</a>
                            <a @click.prevent="goToSearchTrainer(null,null,'Małopolskie')">Małopolskie</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- Section to do / SECTION #3 -->
        <section id="whatToDo">
            <h2 class="main-header">Wybierz rodzaj zabawy</h2>
            <!--<div class="separate"><i class="material-icons">fitness_center</i></div>-->
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-8">
                        <a @click.prevent="goToSearchTrainer(null,10)" href="">
                            <div class="firstGridItem" >
                                <span>Gra na powietrzu</span>
                                <div class="mask"></div>
                            </div>
                        </a>
                        <div class="row mt-4">

                            <div class="col-xl-6">
                                <a @click.prevent="goToSearchTrainer(null,9)" href="">
                                    <div class="secondGriditem">
                                        <span>ASG</span>
                                        <div class="mask"></div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-xl-6">
                                <a @click.prevent="goToSearchTrainer(null,1)" href="">
                                    <div class="thirdGridItem">
                                        <span>Imprezy</span>
                                        <div class="mask"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <a @click.prevent="goToSearchTrainer(null,12)" href="">
                            <div class="fourthGridItem">
                                <span>Paintball laserowy</span>
                                <div class="mask"></div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-8"></div>
                </div>
            </div>

        </section>
        <!-- Something about us SECTION 5 -->
        <section id="know-us">
            <div class="container-fluid">
                <div class="row">
                    <div class="counters col-md-12">
                        <div class="container">
                            <div class="row justify-content-sm-between">
                                <div class="mobileOnly col-6">
                                    <div class="icon">
                                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    </div>
                                    <span class="count">
                                    8476<span class="inner"></span>
                                </span>
                                    <div class="description">
                                        Użytkowników
                                    </div>
                                </div>
                                <div class="mobileOnly col-6">
                                    <div class="icon">
                                        <i class="material-icons">fitness_center</i>
                                    </div>
                                    <span class="count">
                                    286
                                </span>
                                    <div class="description">
                                        aktywnych trenerów
                                    </div>
                                </div>
                                <div class="mobileOnly col-6">
                                    <div class="icon">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    </div>
                                    <span class="count">
                                    4416<span class="inner"></span>
                                </span>
                                    <div class="description">
                                        ocen
                                    </div>
                                </div>
                                <div class="mobileOnly col-6">
                                    <div class="icon">
                                        <i class="material-icons">favorite</i>
                                    </div>
                                    <span class="count">
                                    100<span class="inner">%</span>
                                </span>
                                    <div class="description">
                                        Jakości
                                    </div>
                                </div>
                                <div class="counter col-2 noneMob">
                                    <div class="icon">
                                        <i class="material-icons">favorite</i>
                                    </div>
                                    <span class="count">
                                    100<span class="inner">%</span>
                                </span>
                                    <div class="description">
                                        Jakości
                                    </div>
                                </div>
                                <div class="counter col-2 noneMob">
                                    <div class="icon">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    </div>
                                    <span class="count">
                                    4416<span class="inner"></span>
                                </span>
                                    <div class="description">
                                        ocen
                                    </div>
                                </div>
                                <div class="counter col-2 noneMob">
                                    <div class="icon">
                                        <i class="material-icons">fitness_center</i>
                                    </div>
                                    <span class="count">
                                    286<span class="inner"></span>
                                </span>
                                    <div class="description">
                                        Aktywnych trenerów
                                    </div>
                                </div>
                                <div class="counter col-2 noneMob">
                                    <div class="icon">
                                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                                    </div>
                                    <span class="count">
                                    8476<span class="inner"></span>
                                </span>
                                    <div class="description">
                                        Użytkowników
                                    </div>
                                </div>
                                <div class="counter col-2 noneMob">
                                    <div class="icon">
                                        <i class="fa fa-fire" aria-hidden="true"></i>
                                    </div>
                                    <span class="count">
                                    1+<span class="inner">mln</span>
                                </span>
                                    <div class="description">
                                        spalonych<br>kalroii
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import 'vue-cal/dist/vuecal.css'

    export default {
        data() {
            return {selectedEvent: {},
            showDialog: false,
            city: '',
            citiesOptions: [],
            cities: [],
            showLookup: false
            }
        },
        methods: {
            goToSearchTrainer(city,offerId,voivodeship){
                console.log('ellooo');
                // this.$router.replace({name: 'trainerView', params: { id: id } });
                // this.$router.go({name: 'trainerView', params: { id: id } });
                // this.$router.go('/');
                this.$router.push({name: 'searchTrainer', params: { paramCity: city,
                        paramOffer: offerId,
                        paramVoivodeship: voivodeship }
                });

            },
            retrieveCities() {
                console.log('retrieveCities ');
                let _self = this;
                axios.get("api/cities").then(({ data }) => (
                    this.cities = data,
                        _self.prepareCities(data)));
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

            },
        },
        created: function created() {
            console.log('** Welcome created: '+this._uid);
            this.retrieveCities();
        }
    }
</script>

<style lang="scss">
    .custom-toggler.navbar-toggler {
        border-color: rgb(239,255,233);
    }
    .custom-toggler .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgb(239,255,233)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
    }
    #main-body{
        background-image: url("/public/img/paintball-main.JPG");
        background-size: cover;
    }
    #bg-transparent{
        border: none;
        padding: unset;
    }

    body {
        font-family: 'Poppins', sans-serif;
        font-size: 92%;
        height: 100%;
        background: #F0F0F0;
        position: relative; }
    body #loader {
        width: 100%;
        height: 100vh;
        position: fixed;
        background: #F0F0F0;
        z-index: 99999;
        display: flex;
        justify-content: center;
        align-items: center; }
    body #loader img {
        width: 90px; }

    blockquote {
        font-size: 1.1em;
        font-style: italic; }

    body::-webkit-scrollbar {
        width: 10px; }

    body::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3); }

    body::-webkit-scrollbar-thumb {
        background-color: #272727;
        outline: 1px solid #151515; }

    #popupInfo {
        position: absolute;
        top: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.91);
        z-index: 99999;
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
        padding: 50px 0; }
    #popupInfo .content {
        padding: 20px;
        color: white;
        width: 80%;
        font-weight: 100; }
    #popupInfo .content li {
        font-size: 0.9em; }
    #popupInfo #closePopUp {
        position: absolute;
        right: 40px;
        top: 40px;
        font-size: 2em;
        cursor: pointer;
        color: white; }
    #popupInfo #closePopUp:hover {
        color: rgba(255, 255, 255, 0.82); }
    #popupInfo .btn-correct {
        position: relative;
        text-align: right;
        border: none;
        background: #44b0ff;
        padding: 15px 10px;
        font-size: 0.9em;
        transition: all .2s;
        cursor: pointer;
        color: white;
        font-weight: 100;
        letter-spacing: 1px;
        width: 150px;
        margin-top: 15px; }
    #popupInfo .btn-correct:before {
        content: "\f00c";
        font-family: FontAwesome;
        position: absolute;
        left: -15px;
        top: 0;
        width: 50px;
        height: 100%;
        background: #00212F;
        display: flex;
        justify-content: center;
        align-items: center; }
    #popupInfo .btn-correct:hover {
        background: #44ff99;
        color: white; }

    #navi {
        position: absolute;
        width: 100%;
        height: 50px;
        z-index: 998 !important; }
    #navi .navbar {
        background: transparent;
        border-bottom: 1px solid #767676;
        box-shadow: none;
        padding: none !important; }
    #navi .navbar img {
        max-height: 70px;
        position: relative;
        right: -30px; }
    #navi .navbar .navbar-nav .nav-item .nav-link {
        font-weight: 400;
        color: #f4f4f4;
        text-transform: uppercase; }
    #navi .active {
        position: relative; }
    #navi .active:after {
        content: '';
        width: 100%;
        height: 1.5px;
        background: white;
        display: block;
        position: absolute;
        bottom: -25px; }
    #navi .btnpx {
        border: none;
        background: #32b8c7;
        font-size: 0.8em;
        padding: 5px 25px;
        color: white;
        font-weight: 400;
        height: 50%;
        transition: all .2s; }
    #navi .btnpx:hover {
        background: #FEF751;
        color: #5a5a5a; }
    #navi .btnBlue {
        border: 4px solid #32b8c7 !important;
        background: #32b8c7;
        color: white !important; }
    #navi .kids {
        font-size: 1.5em;
        position: relative;
        top: -8px;
        left: -5px;
        text-transform: none !important;
        font-weight: 700 !important;
        letter-spacing: 3px; }
    #navi .kids .k {
        display: inline-block;
        color: #ff3131 !important;
        transform: rotate(-10deg) !important; }
    #navi .kids .i {
        display: inline-block;
        color: #ffe731 !important;
        transform: rotate(-10deg) !important; }
    #navi .kids .s {
        display: inline-block;
        color: #3178ff !important;
        transform: rotate(10deg) !important; }

    #landing-page {
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
    #landing-page .container-fluid{
        margin-bottom: 200px;
    }
    #landing-page .text-on {
        /*background-color: rgba(0,0,0,0.4);*/
        text-align: center;
    }
    #landing-page .text-on #timer {
        color: white;
        font-weight: 500;
        font-size: 3em; }
    #landing-page .text-on #timer span {
        font-size: 0.5em;
        font-weight: 100;
        margin-right: 10px; }
    #landing-page .text-on .start {
        color: white;
        font-weight: 500;
        font-size: 3.5em;
        font-size: 2em; }
    #landing-page .text-on h1 {
        color: white;
        font-weight: 500;
        font-size: 3.5em; }
    #landing-page .text-on p {
        color: white;
        font-size: 1.2em;
        font-weight: 400; }
    #landing-page .searcher {
        /*background: rgba(255, 255, 255, 0.1);*/
        background-color: rgba(81,89,98,0.35);
        text-align: center;
        color: white;
        padding: 25px;
        margin-top: 10px;
        align-items: center !important;
        justify-content: center !important;
    }
    #landing-page .searcher .form-control {
        padding: unset;
        padding-left: 10px;
        width: 40%;
    }
    #landing-page .searcher .dropdown {
        padding: unset;
        background-color: white;
        width: 40%;
        height: 40px;
    }
    #landing-page .searcher .dropdown .dropdown-toggle{
        height: 40px;
    }
    #landing-page .searcher form {
        width: 100%; }
    #landing-page .searcher .md-form {
        overflow: hidden; }
    #landing-page .searcher .md-form label.active {
        transform: translateY(-60%) !important; }
    #landing-page .searcher .mainFrom {
        /*background: white;*/
        border-radius: 5px;
        /*padding-right: 0;*/
        overflow: hidden;
        /*min-height: 71px;*/
    }
    #landing-page .searcher .mainFrom .fa {
        position: absolute;
        font-size: 2em;
        color: #151515;
        top: 20%;
        left: 0; }
    #landing-page .searcher .btn-mobile {
        display: none !important; }
    #landing-page .searcher .newIpt {
        position: absolute;
        background: white;
        right: -1000px;
        border-radius: 5px;
        width: 100%;
        z-index: 5;
        display: block;
        transition: all .4s; }
    #landing-page .searcher .newIpt form {
        width: 100% !important; }
    #landing-page .searcher .newIpt .fa-user,
    #landing-page .searcher .newIpt .fa-user-o {
        font-size: 1.5em;
        left: -10px; }
    #landing-page .searcher .newIpt .fa-user {
        left: -7px !important; }
    #landing-page .searcher .newIpt .mainBtn99 {
        position: absolute;
        font-size: 0.8em !important;
        right: 0;
        top: 0;
        color: #151515 !important;
        height: 100%;
        width: 30%;
        background: #FEF751;
        margin: 0;
        transition: all .5s;
        display: block; }
    #landing-page .searcher .newIpt .mainBtn99:hover {
        background: #151515;
        border: 2px solid transparent;
        color: #151515 !important; }
    #landing-page .searcher .newIpt .mainBtn99:hover .fa {
        color: white;
        left: 45%;
        animation-name: animate;
        animation-duration: 1s;
        animation-delay: 0.5s;
        animation-iteration-count: infinite; }
    #landing-page .searcher .mainBtn {
        /*position: absolute;*/
        font-size: 0.9em !important;
        margin-top: 10px;
        margin-bottom: 10px;
        border: none;
        top: 0;
        right: 90px;
        color: #FFFFFF !important;
        height: 100%;
        width: 30%;
        background: #011627;
        margin: 0;
        transition: all .5s;
        z-index: 2;
        display: block; }
    #landing-page .searcher .btn {
        background: #052617;
        height: 40px;
        border: none;
        padding: unset;
        width: 40%;
        font-size: 0.9em !important;
    }

    #landing-page .searcher .btn:hover {
        height: 40px;
        color: white;
        background: #515958;
        width: 40%;
        /*border: 2px solid #260101;*/
        padding: unset;
        font-size: 0.9em !important;
    }
    @keyframes animate {
        0% {
            top: 30%;
            left: 45%; }
        50% {
            top: 10%;
            left: 50%; }
        100% {
            top: 30%;
            left: 45%; } }
    #landing-page .searcher .mainBtn .fa {
        color: #151515;
        top: 30%;
        left: 15px;
        transition: all .5s; }
    #landing-page .searcher .mainBtn:hover {
        background: #052617;
        border: 2px solid transparent;
        color: #FFFFFF !important;
        right: 80px;
        width: 32%;
    }
    #landing-page .searcher .mainBtn:hover .fa {
        /*color: white;*/
        /*left: 45%;*/
        /*animation-name: animate;*/
        /*animation-duration: 1s;*/
        /*animation-delay: 0.5s;*/
        /*animation-iteration-count: infinite; */
    }
    #landing-page .searcher .mainBtn2 {
        position: absolute;
        font-size: 0.8em !important;
        right: 0;
        margin-right: 25px;
        color: #151515 !important;
        height: 100%;
        width: 98px;
        background: #e8e24e;
        margin: 0;
        box-shadow: inset 0px 0px 15px 0px rgba(0, 0, 0, 0.2) !important;
        border: none !important;
        border-top-right-radius: 5px !important;
        border-bottom-right-radius: 5px !important;
        z-index: 1;
        display: block; }
    #landing-page .searcher .mainBtn2 .fa {
        position: relative !important;
        left: 0px !important;
        font-size: 1.8em !important; }
    #landing-page .searcher .catLinks {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        position: relative; }
    #landing-page .searcher .catLinks .moved {
        position: absolute;
        bottom: -18px;
        right: 20px;
        font-size: 0.9em;
        border: 2px solid white;
        padding: 5px 25px; }
    #landing-page .searcher .catLinks a {
        cursor: pointer;
        color: #e2e2e2; }
    #landing-page .searcher .catLinks a i {
        font-size: 1.1em;
        position: relative;
        transition: all .4s; }
    #landing-page .searcher .catLinks a:hover {
        color: white; }
    #landing-page .searcher .catLinks a:hover i {
        transform: rotate(360deg); }

    @keyframes rotate {
        0% {
            transform: rotate(0deg); }
        100% {
            transform: rotate(360deg); } }
    #showcase {
        padding-top: 100px; }
    #showcase:hover .separate .material-icons {
        color: #151515;
        animation-name: rotate;
        animation-duration: 2s;
        animation-iteration-count: infinite; }
    #showcase .margTop {
        margin-top: 70px; }
    #showcase .col-md-6,
    #showcase .col-md-3 {
        padding: 0 !important; }
    #showcase .col-12 {
        cursor: pointer; }
    #showcase .col-12:hover .step .number {
        color: #FEF751;
        font-size: 10em;
        top: -115px;
        right: -45px; }
    #showcase .col-12:hover .step .numberR {
        color: #FEF751;
        font-size: 10em;
        top: -115px;
        left: -55px; }
    #showcase .step {
        position: relative;
        z-index: 1;
        display: block; }
    #showcase .step .number {
        position: absolute;
        font-size: 8em;
        font-family: 'Bebas Neue';
        color: #e5e5e5;
        z-index: 0;
        display: block;
        right: -30px;
        top: -95px;
        transition: all .3s; }
    #showcase .step .numberR {
        position: absolute;
        font-size: 8em;
        font-family: 'Bebas Neue';
        color: #e5e5e5;
        z-index: 0;
        display: block;
        left: -30px;
        top: -95px;
        transition: all .3s; }
    #showcase .step img {
        width: 55px;
        z-index: 1;
        display: block;
        position: relative; }
    #showcase .step h3 {
        color: #313131;
        font-weight: 500;
        font-size: 1.38em;
        z-index: 1;
        display: block;
        position: relative;
        margin-top: 15px; }
    #showcase .step p {
        font-size: 0.9em;
        color: #838383;
        font-weight: 500;
        z-index: 1;
        display: block;
        position: relative;
        padding-bottom: 10px; }
    #showcase .step .aligntxt-right {
        text-align: right; }
    #showcase .step .align-right {
        position: relative;
        height: 64px;
        min-height: 64px; }
    #showcase .step .align-right img {
        position: absolute;
        right: 0; }

    #whatToDo {
        background-color: white }
    #whatToDo:hover .separate .material-icons {
        color: #151515;
        animation-name: rotate;
        animation-duration: 2s;
        animation-iteration-count: infinite; }
    #whatToDo span {
        font-family: 'Bebas Neue';
        color: #f0f0f0;
        font-size: 2em;
        z-index: 1;
        transition: all .2s;
        position: relative;
        top: 0; }
    #whatToDo .firstGridItem,
    #whatToDo .secondGriditem,
    #whatToDo .thirdGridItem,
    #whatToDo .fourthGridItem {
        position: relative;
        transition: all .2s;
        cursor: pointer; }
    #whatToDo .firstGridItem .mask,
    #whatToDo .secondGriditem .mask,
    #whatToDo .thirdGridItem .mask,
    #whatToDo .fourthGridItem .mask {
        box-shadow: inset -10px -10px 200px 101px rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 0;
        transition: all .2s; }
    #whatToDo .firstGridItem:hover,
    #whatToDo .secondGriditem:hover,
    #whatToDo .thirdGridItem:hover,
    #whatToDo .fourthGridItem:hover {
        background-position: left; }
    #whatToDo .firstGridItem:hover .mask,
    #whatToDo .secondGriditem:hover .mask,
    #whatToDo .thirdGridItem:hover .mask,
    #whatToDo .fourthGridItem:hover .mask {
        box-shadow: inset -10px -10px 200px 0px black; }
    #whatToDo .firstGridItem:hover span,
    #whatToDo .secondGriditem:hover span,
    #whatToDo .thirdGridItem:hover span,
    #whatToDo .fourthGridItem:hover span {
        position: relative;
        top: 100px; }
    #whatToDo .firstGridItem {
        background-image: url('/img/outdoor.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center; }
    #whatToDo .secondGriditem {
        background-image: url('/img/asg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center; }
    #whatToDo .thirdGridItem {
        background-image: url('/img/party.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: center; }
    #whatToDo .fourthGridItem {
        background-image: url('/img/laser.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: right;
        width: 100%;
        height: 625px;
        display: flex;
        justify-content: center;
        align-items: center; }
    #whatToDo .mainbtn {
        width: 100%;
        background: none;
        padding: 20px 0;
        border: none;
        text-transform: uppercase;
        font-weight: 500;
        border: 2px solid #FEF751;
        border-radius: 5px;
        box-shadow: 0px 0px 21px 0px rgba(114, 114, 114, 0.3);
        cursor: pointer;
        transition: all .2s; }
    #whatToDo .mainbtn .fa {
        font-size: 1.3em;
        margin-left: 5px; }
    #whatToDo .mainbtn:hover {
        background: #FEF751; }

    #know-us {
        background: #242424;
        position: relative;
        margin-top: 100px;
        margin-bottom: 100px;}
    #know-us .mobileOnly {
        display: none; }
    #know-us .mobileOnly .count {
        font-size: 4em;
        font-weight: 100;
        line-height: 65px; }
    #know-us .mobileOnly .count .inner {
        font-size: 50%; }
    #know-us .mobileOnly .material-icons,
    #know-us .mobileOnly .fa {
        color: #FEF751;
        font-size: 5em;
        margin-bottom: 10px; }
    #know-us .mobileOnly .fa {
        margin-bottom: 10px; }
    #know-us .mobileOnly .description {
        text-transform: uppercase;
        font-size: 0.85em;
        font-weight: 700;
        text-align: center; }
    #know-us .header {
        padding-top: 250px; }
    #know-us .header h2 {
        color: white;
        display: block;
        font-family: 'Source Code Pro', monospace;
        font-weight: 500;
        font-size: 2.5em; }
    #know-us .header p {
        color: white; }
    #know-us .counters {
        color: white;
        /*background-image: url(../images/fitnesps.png);*/
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        height: 60vh; }
    #know-us .counters .container {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center; }
    #know-us .counters .counter {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        flex-direction: column; }
    #know-us .counters .counter .count {
        font-size: 4em;
        font-weight: 100;
        line-height: 65px; }
    #know-us .counters .counter .count .inner {
        font-size: 50%; }
    #know-us .counters .counter .material-icons,
    #know-us .counters .counter .fa {
        color: #FEF751;
        font-size: 5em;
        margin-bottom: 10px; }
    #know-us .counters .counter .fa {
        margin-bottom: 10px; }
    #know-us .counters .counter .description {
        text-transform: uppercase;
        font-size: 0.85em;
        font-weight: 700;
        text-align: center; }
    #know-us .btn-show {
        margin-top: 30px; }
    #know-us .btn-show .btn {
        font-size: 1em !important; }
    #know-us .btn-show .btn:hover {
        background: #FBDA45; }

    #forum {
        margin-top: 100px; }
    #forum .btnpx {
        padding: 10px 50px;
        text-transform: uppercase;
        font-weight: 100;
        border: 2px solid white;
        transition: all .2s; }
    #forum .btnpx:hover {
        border: 2px solid #151515;
        color: #151515;
        background: none;
        font-weight: 300; }
    #forum .bg-yellowpx {
        background: #FEF751;
        color: #151515;
        font-weight: 300; }
    #forum .bg-blackpx {
        background: #151515;
        color: white; }
    #forum:hover .separate .material-icons {
        color: #151515;
        animation-name: rotate;
        animation-duration: 2s;
        animation-iteration-count: infinite; }
    #forum .questions {
        width: 100%; }
    #forum .questions h2 {
        text-transform: uppercase;
        font-size: 1.2em;
        font-weight: 700;
        margin-left: 50px; }
    #forum .questions .questionBox {
        border: 1px solid grey;
        border-left: none;
        border-right: none;
        border-radius: 50px;
        margin: 35px 90px;
        padding: 10px 10px 20px 10px;
        position: relative; }
    #forum .questions .questionBox .topic span {
        font-size: 1.1em;
        font-weight: 500;
        margin-left: 20px;
        color: #151515; }
    #forum .questions .questionBox #ansBtn {
        position: absolute;
        right: 45px;
        top: 15px;
        background: #151515;
        border: 1px solid white;
        font-size: 0.7em;
        color: white;
        text-transform: uppercase;
        font-weight: 500;
        padding: 5px 25px; }
    #forum .questions .questionBox #ansBtn i {
        margin-right: 20px; }
    #forum .questions .questionBox .head {
        margin-left: 20px;
        position: relative;
        top: -5px; }
    #forum .questions .questionBox .head .by {
        font-size: 0.9em;
        font-weight: 100;
        color: #151515; }
    #forum .questions .questionBox .head .nick {
        font-size: 0.95em;
        font-weight: 400;
        color: #151515; }
    #forum .questions .questionBox .head .date {
        color: #151515;
        font-size: 0.9em; }
    #forum .questions .questionBox .content {
        margin: 10px 40px;
        overflow-y: hidden;
        overflow-x: hidden;
        text-overflow: ellipsis; }
    #forum .questions .questionBox .content span {
        font-size: 0.95em;
        color: #585858;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow-y: hidden; }
    #forum .questions .questionBox .content .more {
        color: #0062ff;
        position: relative;
        top: 0;
        left: 5px;
        font-size: 0.9em; }
    #forum .questions .questionBox .answers {
        margin: 0 40px;
        margin-right: 10px;
        font-size: 0.95em;
        font-weight: 300;
        color: #0062ff; }
    #forum .questions .questionBox .lastAns {
        margin-left: 40px;
        max-width: 500px;
        max-height: 100px;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis;
        background: white;
        font-size: 0.85em;
        padding: 10px; }
    #forum .questions .questionBox .lastAns .personal {
        font-weight: 500;
        color: black; }
    #forum .questions .questionBox .lastAns .date {
        color: black;
        font-size: 0.85em;
        margin-bottom: 10px; }
    #forum .questions .questionBox .aligner {
        display: flex; }
    #forum .questions .questionBox .aligner .imgBox {
        display: inline-block;
        margin-right: 2px;
        width: 40px;
        min-height: 40px;
        height: 40px; }
    #forum .questions .questionBox .aligner .imgBox img {
        height: 40px; }
    #forum .questions .btns {
        margin-top: 50px; }

    #blog {
        margin-top: 100px; }
    #blog .btnBlogPx {
        cursor: pointer;
        border: none;
        background: #32b8c7;
        font-size: 1em;
        padding: 5px 25px;
        color: white;
        font-weight: 400;
        margin-top: 20px;
        transition: all .2s; }
    #blog .btnBlogPx:hover {
        background: #FEF751;
        color: #5a5a5a; }
    #blog .tekst_na_glowna {
        margin-top: 40px;
        background: white;
        padding: 50px; }
    #blog:hover .separate .material-icons {
        color: #151515;
        animation-name: rotate;
        animation-duration: 2s;
        animation-iteration-count: infinite; }
    #blog .blogList {
        margin-top: 50px; }
    #blog .blogList .blog {
        background: #FFFFFF;
        padding: 15px;
        box-shadow: 0px 0px 21px 0px rgba(114, 114, 114, 0.2);
        height: 380px; }
    #blog .blogList .blog .img {
        max-height: 210px;
        overflow: hidden; }
    #blog .blogList .blog .info {
        display: flex;
        justify-content: space-between;
        font-weight: 500;
        font-size: 0.9em;
        color: #767676;
        padding: 10px; }
    #blog .blogList .blog .title {
        padding: 0 10px;
        color: #5a5a5a;
        font-weight: 500;
        font-size: 1.1em; }
    #blog .blogList .blog .content {
        font-size: 0.9em;
        font-weight: 400;
        color: #767676;
        padding: 10px; }
    #blog .blogList .blog .showMore {
        padding: 10px 0; }
    #blog .blogList .blog .showMore a {
        background: #151515;
        padding: 5px 10px;
        color: white;
        border: 1px solid transparent;
        border-radius: 5px;
        font-size: 0.8em;
        position: absolute;
        bottom: 10px; }
    #blog .blogList .blog .showMore a:hover {
        background: none;
        border: 1px solid #151515;
        padding: 5px 10px;
        color: #151515; }

    .md-form label {
        color: #151515;
        padding: 0 25px;
        font-size: 1em;
        font-weight: 400; }

    .md-form {
        padding: 0 25px;
        width: 100%; }

    .form-inline .form-control {
        width: 50%; }

    .a-border {
        border: 4px solid #011627;
        transition: all .3s; }
    .a-border:hover {
        background: #011627;
        color: #151515 !important; }

    .separate {
        position: relative;
        font-size: 1.2em;
        text-align: center;
        margin: -5px 0; }
    .separate:after {
        content: '';
        width: 100px;
        height: 1px;
        background-color: #a7a7a7;
        display: block;
        position: absolute;
        left: 0;
        right: 150px;
        margin: auto;
        top: 50%; }
    .separate:before {
        content: '';
        width: 100px;
        height: 1px;
        background-color: #a7a7a7;
        display: block;
        position: absolute;
        left: 150px;
        right: 0;
        margin: auto;
        top: 50%; }
    .separate .material-icons {
        color: #a7a7a7;
        width: 1.5%; }

    .separate-txt {
        width: 40%;
        text-align: center;
        margin: 0 auto;
        font-family: "Raleway", sans-serif;
        color: #6d6d6d;
        font-weight: 500;
        font-size: 0.9em; }

    .sep-white:after {
        background: white; }
    .sep-white:before {
        background: white; }

    .main-header {
        margin-left: 0px;
        font-size: 3em;
        text-align: center;
        font-family: 'Bebas Neue';
        position: relative; }
    .main-header i {
        position: absolute;
        top: -10px;
        font-size: 0.4em;
        margin-left: 15px;
        cursor: pointer; }
    .main-header .hint {
        display: none;
        position: absolute;
        margin-left: 40px;
        font-family: "Raleway", sans-serif;
        font-size: 0.3em;
        text-align: left;
        max-width: 200px;
        background: white;
        padding: 10px;
        border: 1px solid black;
        border-radius: 10px;
        font-weight: 500; }

    .aligner {
        margin-top: 35px; }

    .brdTrickLeft {
        width: 100px;
        height: 100px;
        border: 2px solid #FBDA45;
        border-right: none;
        border-top: none;
        position: absolute;
        left: -2px;
        bottom: -2px;
        z-index: 0; }

    .brdTrickRight {
        width: 150px;
        height: 200px;
        border: 2px solid #FBDA45;
        border-left: none;
        border-bottom: none;
        position: absolute;
        right: -2px;
        top: -2px;
        z-index: 0; }

    .accent-color {
        color: #FBDA45; }

    .color-black {
        background: #212121 !important; }

    #livesearch {
        background: white;
        position: absolute;
        width: 96%;
        height: auto;
        z-index: 2;
        max-height: 400px;
        overflow: hidden; }
    #livesearch a {
        padding: 10px 20px !important;
        display: block !important;
        margin: 0; }
    #livesearch a:hover {
        background: #FBDA45;
        color: white; }

    .profileAva {
        background-repeat: no-repeat;
        background-size: cover;
        width: 80px;
        height: 80px;
        position: absolute;
        display: block;
        left: -90px;
        top: -10px;
        z-index: 1; }

    .alignStats {
        position: relative; }

    .selected {
        background: #FEF751 !important;
        color: black !important; }

    .hello {
        color: #f4f4f4;
        position: relative;
        top: 8px;
        left: -10px;
        margin-left: 20px; }

    #headerNew {
        background: #fefefe;
        padding: 50px 0;
        padding-top: 120px;
        z-index: 8;
        position: relative; }
    #headerNew h1 {
        font-family: 'Bebas Neue';
        color: #767676;
        text-align: center; }
    #headerNew .navigator {
        display: flex;
        justify-content: center;
        align-items: center; }
    #headerNew .navigator a {
        color: #767676; }
    #headerNew .navigator a:hover {
        color: #151515; }
    #headerNew .navigator .fa {
        margin: 0 15px; }

    .hide {
        display: none !important; }

    .position {
        right: -15px !important;
        display: block !important; }

    .show {
        display: block !important; }

    .whiteLink {
        color: white;
        text-decoration: underline; }

    @media screen and (max-width: 768px) {
        #navi .navbar {
            padding: 5px 0px !important; }
        #navi .navbar-toggler-icon {
            /*background-image: url(../images/icon/menu.png) !important;*/
            background-size: cover !important;
            background-repeat: no-repeat; }
        #navi img {
            max-width: 180px !important;
            right: 0 !important; }
        #navi .navbar-collapse {
            background: #272727;
            padding: 10px 5px;
            width: 100%;
            flex-direction: column;
            align-items: center;
            justify-content: center; }
        #navi .navbar-collapse .btn {
            width: 97.5%;
            margin-bottom: 10px !important; }
        #navi .navbar-collapse ul {
            margin: 0px !important; }
        #navi .navbar-collapse ul li a {
            text-align: center; }
        #navi button {
            margin: 0 !important;
            margin-left: 5px !important; }
        #navi .hello {
            display: none !important; }

        #landing-page .text-on {
            padding: 10px; }
        #landing-page .text-on #timer {
            font-size: 2em !important; }
        #landing-page .text-on h1 {
            margin-top: 40px;
            font-size: 1.5em !important; }
        #landing-page .text-on p {
            font-size: 80%; }
        #landing-page .searcher {
            padding: 0 !important; }
        #landing-page .searcher .mainFrom {
            border-radius: 0px !important;
            min-height: unset; }
        #landing-page .searcher .col-md-12 {
            padding-left: 0 !important; }
        #landing-page .searcher .pr-0 {
            padding-right: 15px !important; }
        #landing-page .searcher .fa-map-marker {
            display: none !important; }
        #landing-page .searcher .btn-desktop {
            display: none !important; }
        #landing-page .searcher .search {
            right: 26px !important;
            top: 1px !important; }
        #landing-page .searcher label {
            padding: 0 !important;
            font-size: 0.8em !important; }
        #landing-page .searcher input {
            margin-bottom: 0 !important; }
        #landing-page .searcher .mainBtn2 {
            position: absolute !important;
            right: -10.5px !important;
            box-shadow: none !important; }
        #landing-page .searcher .mainBtn2 .fa {
            color: #575757 !important; }
        #landing-page .searcher .newIpt {
            position: relative !important;
            display: none; }
        #landing-page .searcher .newIpt .fa-user,
        #landing-page .searcher .newIpt .fa-user-o {
            display: none !important; }
        #landing-page .searcher .newIpt .col-md-4 {
            padding: 0 !important; }
        #landing-page .searcher .newIpt .form-control {
            width: 86% !important; }
        #landing-page .searcher .newIpt #form3 {
            margin-bottom: 5px !important; }
        #landing-page .searcher .newIpt .search2 {
            right: 33px;
            bottom: 7px;
            top: unset; }
        #landing-page .searcher .md-form {
            margin-bottom: 0 !important;
            padding: 0 !important; }
        #landing-page .searcher .btn-mobile {
            display: block !important;
            position: absolute;
            right: 0;
            top: 0;
            font-size: 0.7em;
            border: none;
            height: 50px;
            width: 50px;
            background: rgba(255, 255, 255, 0); }
        #landing-page .searcher .fa-map-marker {
            top: 12px !important; }
        #landing-page .searcher .mainBtn {
            /*position: relative !important;*/
            font-size: 0.9em !important;
            margin-bottom: 10px;
            margin-top: 10px;
            right: 18px !important;
            color: #151515 !important;
            height: 100%;
            width: 100% !important;
            background: #FEF751;
            margin: 0;
            transition: all .5s;
            display: block; }
        #landing-page .searcher .mainBtn99 {
            position: relative !important;
            width: 90% !important; }
        #landing-page .searcher .catLinks {
            display: block !important;
            padding-bottom: 30px;
            font-size: 0.8em;
            font-weight: 500;
            text-transform: lowercase;
            text-decoration: underline; }
        #landing-page .searcher .catLinks i {
            display: none !important; }
        #landing-page .searcher .catLinks a {
            margin-right: 5px; }
        #landing-page .searcher .catLinks .moved {
            bottom: 5px; }

        #showcase {
            padding-top: 50px; }
        #showcase .widget {
            display: none; }
        #showcase .aligntxt-right {
            text-align: center !important; }
        #showcase .align-right {
            height: 38px !important; }
        #showcase .align-right img {
            position: relative !important; }
        #showcase .widgetContent {
            text-align: center; }
        #showcase .number {
            right: 0px !important; }
        #showcase .number,
        #showcase .numberR {
            font-size: 6em !important;
            left: 40% !important;
            top: -75px !important; }
        #showcase .icon {
            display: flex;
            justify-content: center;
            align-items: center; }
        #showcase h3 {
            font-size: 1.1em !important; }

        #whatToDo .secondGriditem,
        #whatToDo .thirdGridItem {
            margin-bottom: 20px; }
        #whatToDo .fourthGridItem {
            max-height: 270px !important; }

        #blog .blogList {
            display: flex;
            justify-content: center;
            align-items: center; }
        #blog .blogList .row {
            width: 100% !important; }
        #blog .blogList .blog {
            margin-top: 10px; }

        #forum .main-header i {
            font-size: 0.6em; }
        #forum .main-header .hint {
            left: 40px;
            z-index: 2;
            font-size: 0.4em; }
        #forum #ansBtn span {
            display: none; }
        #forum #ansBtn i {
            margin-right: 0px !important; }
        #forum .questions h2 {
            display: none; }
        #forum .questions .questionBox {
            margin: 15px 0px; }
        #forum .questions .questionBox .aligner {
            display: block;
            padding: 0px 10px; }
        #forum .questions .questionBox .aligner .imgBox {
            margin-left: -2px; }
        #forum .btns {
            display: flex;
            flex-direction: column; }
        #forum .btns a {
            min-width: 100%;
            margin-bottom: 5px;
            text-align: center; }

        #know-us .noneMob {
            display: none !important; }
        #know-us .mobileOnly {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0 auto; }
        #know-us .mobileOnly .fa {
            font-size: 3em;
            margin-top: 15px; }
        #know-us .mobileOnly .count {
            font-size: 3em; }

        .main-header {
            font-size: 2em; } }

</style>
