<template>
    <div>
        <form>
            <div class="form-group">
                <label>Twoja ocena</label>
                <p class="mb-1">
                    <font-awesome-icon :style="{'font-size': '22px'}" :icon="rate < 1 ? ['far', 'star'] : ['fas', 'star']" @click="setRate(1)" />
                    <font-awesome-icon :style="{'font-size': '22px'}" :icon="rate < 2 ? ['far', 'star'] : ['fas', 'star']" @click="setRate(2)" />
                    <font-awesome-icon :style="{'font-size': '22px'}" :icon="rate < 3 ? ['far', 'star'] : ['fas', 'star']" @click="setRate(3)" />
                    <font-awesome-icon :style="{'font-size': '22px'}" :icon="rate < 4 ? ['far', 'star'] : ['fas', 'star']" @click="setRate(4)" />
                    <font-awesome-icon :style="{'font-size': '22px'}" :icon="rate < 5 ? ['far', 'star'] : ['fas', 'star']" @click="setRate(5)" />
                </p>

            </div>
            <div class="form-group">
                <label>Komentarz</label>
                <textarea v-model="form.comment" name="comment" id="comment"
                          class="form-control" rows="5" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                <has-error :form="form" field="comment"></has-error>
            </div>
            <button type="button" @click.prevent="createOpinion" class="btn btn-outline-secondary my-2 float-right">
                Dodaj opinie
            </button>
        </form>
        <div>
            Opinia będzie publicznie widoczna w internecie po akceptacji przez moderatora.
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                authUserId:'',
                editmode : false,
                opinions : {},
                options: [],
                rate: 0,
                form: new Form({
                    id : '',
                    comment : '',
                    approved : '',
                    trainer_id : '',
                    user_id : '',
                    approved : false,
                    rating : ''
                })
            }
        },
        props: ['trainerId','hasUserAddedOpinion'],
        methods: {
            createOpinion(){
                this.form.trainer_id = this.trainerId;
                this.form.user_id = this.authUserId;
                this.$Progress.start();
                this.form.post('http://localhost:8000/api/opinion')
                    .then(() => {
                        swal(
                            'Opinia dodana!',
                            'Opinia pojawi się w serwisie po zatwierdzeniu przez moderatora',
                            'success'
                        );
                        Fire.$emit('opinionAdded');
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        swal(
                            'Upsss',
                            'Coś poszło nie tak, spórbuj raz jeszcze',
                            'warning'
                        );
                    });
            },
            setRate(rate) {
                this.rate = rate;
                this.form.rating = rate;
            }
        },
        created: function created() {
            console.log('^^ AddOpinion created: '+this._uid);
            this.authUserId = this.$gate.getAuthUserId();
        },
        destroyed() {
            console.log('^^ AddOpinion destroyed: '+this._uid);
            DestroyedComponents.push(this._uid);
        }
    }
</script>

<style lang="scss">
    $fa-font-path : "~@fortawesome/fontawesome-free-webfonts/webfonts";
</style>
