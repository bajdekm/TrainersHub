<template>
    <div class="container">
        <p class="m-4">&nbsp;</p>
        <div class="card">
            <div class="card-header">
                <div class="py-1" >
                    <h2 class="text-center">Wybierz jako kto chcesz się zarejestrować w serwisie TrainersHub</h2>
                </div>
            </div>
            <div class="card-body">
                <!--<div class="register-button shadow p-3 mb-3 bg-white rounded text-center ">Zarejestruj się jako użytkownik</div>-->
                <!--<div class="register-button shadow p-3 mb-3 bg-white rounded text-center ">Zarejestruj się jako trener</div>-->
                <button type="button" @click.prevent="goToRegisterUserForm" class="btn btn-block btn-outline-secondary">
                    Zarejestruj się jako użytkownik
                </button>
                <button type="button" @click.prevent="goToRegisterTrainerForm" class="btn btn-block btn-outline-secondary">
                    Zarejestruj się jako trener
                </button>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created: function created() {
            console.log('** Register role created: '+this._uid);
        },
        methods: {
            goToRegisterTrainerForm(){
                window.open('http://localhost:8000/register-trainer','_self');
            },
            goToRegisterUserForm(){
                window.open('http://localhost:8000/register','_self');
            }
        },
        destroyed() {
            DestroyedComponents.push(this._uid);
            console.log('** Register role destroyed: '+this._uid);
        }
    }
</script>

<style scoped>
    .btn{
        height: 50px;
        border-color: #011627;
        color: #011627;
    }
    .btn:hover{
        background-color: #011627;
        color: white;
    }

</style>
