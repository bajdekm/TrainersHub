<template>
    <div>
        <div v-if="currentTrainerDisciplines && currentTrainerDisciplines.includes(discipline.id)"
             v-for="discipline in disciplines" :key="discipline.id">
            <p-check :checked="currentTrainerDisciplines.includes(discipline.id)" class="p-icon p-round p-pulse"
                     color="success">{{discipline.name}}</p-check>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                authUserId:'',
                isDisabled : true,
                disciplines : {},
                currentTrainerDisciplines : {},
                disciplineSingle : {}
            }
        },
        props: ['trainerDisciplines'],
        methods: {
            initialize(){
                this.prepareTrainerDisciplines(this.trainerDisciplines,true);
                this.retreiveDisciplines();
                this.authUserId = this.$gate.getAuthUserId();
            },
            retreiveDisciplines() {
                let url = 'http://localhost:8000/api/retrievePaintballOffer?' +
                    'category=paintball offer';
                axios.get(url).then(({data}) => (
                    console.log('data trainer offer: ',data.data),
                    this.disciplines = data.data
                )).catch(()=>{
                    swal("Failed!", "There was something wrong.", "warning");
                });
            },
            prepareTrainerDisciplines(trainerDisciplines,isOnInit) {
                if(isOnInit){
                    this.currentTrainerDisciplines = new Array();
                    this.disciplinesAttached = new Array();
                    for (let i = 0; i < this.trainerDisciplines.length; i++) {
                        this.currentTrainerDisciplines.push(trainerDisciplines[i].id);
                        this.disciplinesAttached.push(trainerDisciplines[i].id);
                    }
                } else {
                    this.disciplinesAttached = new Array();
                    for (let i = 0; i < this.currentTrainerDisciplines.length; i++) {
                        this.disciplinesAttached.push(this.currentTrainerDisciplines[i]);
                    }
                }
            },
            disciplineChange(id){
                if(this.currentTrainerDisciplines.includes(id)){
                    let indexToRemove = this.currentTrainerDisciplines.indexOf(id);
                    this.currentTrainerDisciplines.splice(indexToRemove,1);
                } else {
                    this.currentTrainerDisciplines.push(id);
                }

                if(this.isDisabled){
                    this.isDisabled = false;
                }

            }
        },
        created: function created() {
            console.log('^^ TrainerOffer created: '+this._uid);
            this.initialize();
            Fire.$on('OfferSelectionChangeEvt', (index) => {
                console.log('evt on');
                if(index.toString() === this._uid.toString()){
                    console.log('in evt change');
                    this.prepareTrainerDisciplines(false);
                }
            });
        },
        destroyed() {
            console.log('^^ TrainerOffer destroyed: '+this._uid);
            DestroyedComponents.push(this._uid);
        }
    }
</script>

<style lang="scss">
    @import '~pretty-checkbox/src/pretty-checkbox.scss';

    $fa-font-path : "~@fortawesome/fontawesome-free-webfonts/webfonts";
</style>
