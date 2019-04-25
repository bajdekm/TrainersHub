<template>
    <div>
        <div v-if="currentTrainerDisciplines"
             v-for="discipline in disciplines" :key="discipline.id">
            <p-check :checked="currentTrainerDisciplines.includes(discipline.id)" class="p-icon p-round p-pulse"
                     @change="disciplineChange(discipline.id)" color="success">{{discipline.name}}</p-check>
        </div>
        <button type="button" :disabled="isDisabled" @click.prevent="saveDisciplines" class="btn btn-block btn-success">
            Zapisz
        </button>
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
                disciplinesAttached : {},
                disciplinesToAttach : {},
                disciplinesToDetach : {},
                disciplineSingle : {},
                selectOptions : [],
                options: []
            }
        },
        props: ['trainerId','trainerDisciplines'],
        methods: {
            initialize(){
                this.prepareTrainerDisciplines(this.trainerDisciplines,true);
                this.retreiveDisciplines();
                this.setSelectOptions();
                this.authUserId = this.$gate.getAuthUserId();
            },
            retreiveDisciplines() {
                // let categories = ['Paintball offer','Paintball offer quantity'];
                let url = 'http://localhost:8000/api/retrieveDisciplinesByCategory?' +
                    'category=paintball offer';
                axios.get(url).then(({data}) => (
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
            },
            saveDisciplines(){
                let _self = this;
                this.disciplinesToAttach = new Array();
                this.disciplinesToDetach = new Array();
                for (let i = 0; i < this.currentTrainerDisciplines.length; i++) {
                    if(!this.disciplinesAttached.includes(this.currentTrainerDisciplines[i])){
                        this.disciplinesToAttach.push(this.currentTrainerDisciplines[i]);
                    }
                }
                for (let i = 0; i < this.disciplinesAttached.length; i++) {
                    if(!this.currentTrainerDisciplines.includes(this.disciplinesAttached[i])) {
                        this.disciplinesToDetach.push(this.disciplinesAttached[i]);
                    }
                }

                let url = 'http://localhost:8000/api/attachDiscipline?' +
                'disciplinesToAttachIds=' + this.disciplinesToAttach +
                '&disciplinesToDetachIds=' + this.disciplinesToDetach+
                '&trainerId=' + this.trainerId;

                  axios.get(url).then(({data}) => (
                        _self.doAfterSave(data)
                 )).catch(()=>{
                     swal("Failed!", "There was something wrong.", "warning")
                  });
            },
            doAfterSave(data){
                console.log('resp: ',data);
                Fire.$emit('OfferSelectionChangeEvt',this._uid);
                Fire.$emit('TrainerProfileSetupChange');
                swal('Sukces!', 'Twoja oferta została uaktualniona!', 'success');
                this.isDisabled = true;

            },
            setSelectOptions(){
                for (let i = 1; i <= 50; i++) {
                    let optionTime = new Object();
                    optionTime.id = i;
                    optionTime.label = i;
                    this.selectOptions.push(optionTime);
                }
            }
        },
        created: function created() {
            console.log('^^ OfferSelection created: '+this._uid);
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
            console.log('^^ OfferSelection destroyed: '+this._uid);
            DestroyedComponents.push(this._uid);
        }
    }
</script>

<style lang="scss">
    @import '~pretty-checkbox/src/pretty-checkbox.scss';

    $fa-font-path : "~@fortawesome/fontawesome-free-webfonts/webfonts";
</style>
