<template>

    <div class="container">
        <p class="m-4">&nbsp;</p>
        <div class="card">
            <div class="card-header">
                <div class="col-lg-12 py-1" >
                    <h2 class="text-center">Skontaktuj się z nami</h2>
                </div>
                <div class="col-lg-12 py-1" >
                    <p class="text-center">Administratorem danych osobowych jest Arkadiusz Szuba z siedzibą w Równe, 38-451 Wietrzno 97. Państwa dane osobowe przetwarzane będą w celu i w zakresie niezbędnym do odpowiedzi na pytania zadane poprzez niniejszy formularz lub poprzez email. Użytkownikom przysługują następujące prawa: prawo żądania dostępu do swoich danych, prawo do ich sprostowania, prawo do usunięcia danych, prawo do ograniczenia przetwarzania, prawo do sprzeciwu oraz prawo do przenoszenia danych. Więcej informacji na temat przetwarzania Państwa danych osobowych, w tym przysługujących Państwu uprawnień, znajdziecie Państwo w naszej Polityce Prywatności.</p>
                </div>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="name">Imię</label>
                        <input type="text" class="form-control" id="name" v-model="form.name" placeholder="imię">
                    </div>
                    <div class="form-group">
                        <label for="email">Adres Email</label>
                        <input type="email" class="form-control" id="email" v-model="form.email" placeholder="name@example.com">
                    </div>

                    <div class="form-group">
                        <label for="content">Treść</label>
                        <textarea class="form-control" id="content" rows="3" v-model="form.content" placeholder="Twoja treść tutaj"></textarea>
                    </div>

                    <button type="button" class="btn btn-primary" @click="sendForm">Wyślij</button>
                </form>

            </div>
            <div class="card-footer">
            </div>
            <!-- /.card-body -->
        </div>

    </div>

</template>

<script>
    export default {
        name: "Contact",
        data(){
            return{
                form: new Form({
                    name: '',
                    email: '',
                    content: ''
                })
            }
        },
        created() {
            console.log('@@ component mounted');
            console.log('Contact router: ',this.$router);

        },
        methods: {
            sendForm(){
                if(this.validateEmail( this.form.email )){
                    axios.post('/api/contact', {
                        name: this.form.name,
                        email: this.form.email,
                        content: this.form.content
                    })
                    .then(function (response) {
                        if('ko' == response.data.message ){
                            swal('Error!', 'Coś poszło nie tak. Email nie został wysłany', 'error');
                        } else{
                            swal('Success!', 'Email został wysłany', 'success');
                        }
                    })
                    .catch(function (error) {
                        console.log('## error %O',error);
                    });
                }
                else{
                    swal('Error!', 'Wprowadź poprawny adres email', 'error');
                }
            },
            validateEmail( email ){

                console.log('@@ hello vem ' + email);

                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                console.log('@@ even if  ' , re.test(String(email).toLowerCase()) );
                return re.test(String(email).toLowerCase());
            }
        }
    }
</script>

<style scoped>

</style>
