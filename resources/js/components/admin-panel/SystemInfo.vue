<template>
    <div id="wrapper-system-info">
            <div class="row">
                <div class="col">
                    <div class="card fixed_card">
                        <div class="card-body">
                            <h5 class="card-title">Użytkownicy: {{ this.usersInfo.total }}</h5>
                            <p class="card-text">Mężczyźni: {{ this.usersInfo.males }}</p>
                            <p class="card-text">Kobiety: {{ this.usersInfo.females }}</p>
                            <p class="card-text">Dzisiaj: {{ this.usersInfo.today }}</p>
                            <p class="card-text">Ostatnie 7 dni: {{ this.usersInfo.lastWeek }}</p>
                            <p class="card-text">Ostatni miesiąc: {{ this.usersInfo.lastMonth }}</p>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card fixed_card">
                        <div class="card-body">
                            <h5 class="card-title">Trenerzy: {{ this.trainersInfo.total }}</h5>
                            <p class="card-text">Mężczyźni: {{ this.trainersInfo.males }}</p>
                            <p class="card-text">Kobiety: {{ this.trainersInfo.females }}</p>
                            <p class="card-text">Dzisiaj: {{ this.trainersInfo.today }}</p>
                            <p class="card-text">Ostatnie 7 dni: {{ this.trainersInfo.lastWeek }}</p>
                            <p class="card-text">Ostatni miesiąc: {{ this.trainersInfo.lastMonth }}</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card fixed_card">
                        <div class="card-body">
                            <h5 class="card-title">Rezerwacje: {{ this.reservationsInfo.total }}</h5>
                            <p class="card-text">Dzisiaj: {{ this.reservationsInfo.today }}</p>
                            <p class="card-text">Ostatnie 7 dni: {{ this.reservationsInfo.lastWeek }}</p>
                            <p class="card-text">Ostatni miesiąc: {{ this.reservationsInfo.lastMonth }}</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card fixed_card">
                        <div class="card-body">
                            <h5 class="card-title">Wiadomości: {{ this.messagesInfo.total }}</h5>
                            <p class="card-text">Dzisiaj: {{ this.messagesInfo.today }}</p>
                            <p class="card-text">Ostatnie 7 dni: {{ this.messagesInfo.lastWeek }}</p>
                            <p class="card-text">Ostatni miesiąc: {{ this.messagesInfo.lastMonth }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card fixed_card">
                        <div class="card-body">
                            <h5 class="card-title">Wysycenie serwera</h5>
                            <h2>cooming soon !</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ostatni użytkownicy</h5>

                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Imie</th>
                                    <th>Nazwisko</th>
                                    <th>Status</th>
                                </tr>
                                <tr v-for="user in onlineInfo.data" :key="user.id">
                                    <td>{{user.id}}</td>
                                    <td>{{user.name}}</td>
                                    <td>{{user.surname}}</td>
                                    <td>online</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card footer">
                            <pagination :data="onlineInfo" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</template>

<script>
    export default {
        name: "SystemInfo",
        data(){
            return{
                infoEntities: [],
                usersInfo: {},
                trainersInfo: {},
                reservationsInfo: {},
                messagesInfo: {},
                onlineInfo: {}

            }
        },
        created: function created(){
            console.log('## component initialized properly!');
            this.retrieveServerInfo();
            this.loadOnlineUsers();
        },

        methods: {


            getResults(page = 1) {
                console.log('getResults');
                axios.get('http://localhost:8000/api/onlineuser?page=' + page)
                    .then(response => {
                        this.onlineInfo = response.data;
                    });
            },

            loadOnlineUsers: function loadOnlineUsers() {
                console.log('Load Users Start');
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/onlineuser").then(({ data }) => (
                        console.log('Users data: ',data),
                            this.onlineInfo = data));
                }
            },

            getAllOnlineUsers() {


                console.log('@@ kurwaaaa');
                axios.get('http://localhost:8000/api/onlineuser')
                    .then(response => {
                        console.log('@@>> response ' , response );
                    });
            },
            retrieveServerInfo(){

                let url = 'http://localhost:8000/api/server-info';
                axios.get(url).then(({data}) => (
                    this.infoEntities = data,
                    data.forEach(
                        element => {
                            this.delegateInformation(element);
                        }
                    )
                ));

            },
            delegateInformation( data ){

                if( data != null && data != undefined ){
                    if( data.type == 'user' ){
                        this.usersInfo = data;
                    }
                    else if(data.type == 'trainer'){
                        this.trainersInfo = data;
                    }
                    else if(data.type == 'reservation'){
                        this.reservationsInfo = data;
                    }
                    else if(data.type == 'message'){
                        this.messagesInfo = data;
                    }
                }
            }

        }
    }

</script>

<style scoped>

    .fixed_card{
        height: 250px;
    }

    .padding_card{
        padding-top: 25px;
    }

</style>