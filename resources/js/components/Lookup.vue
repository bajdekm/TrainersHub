<template>
    <div>
        <!-- SEARCH FORM -->
        <div class="input-group">
            <input v-model="query" class="form-control" type="search" @keyup="search"
                   placeholder="Szukaj" aria-label="Search" aria-describedby="append">
            <div class="input-group-append">
                <div class="input-group-append">
                    <button class="btn btn-success" type="button" @click="search"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover justify-content-center">
                    <tbody>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Select</th>
                    </tr>
                    <tr v-for="record in records.data" :key="record.id">
                        <td class="text-center">{{record.name}}</td>
                        <td class="text-center">
                            <button class="btn btn-outline-success" @click="choose(record.id)">Wybierz</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card footer">
                <pagination :data="records" @pagination-change-page="getResults"></pagination>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        data() {
            return {
                records : {},
                query: '',
                name: '',
                componentName: '',
                calledByIndex: '',
                calledByIndexes: []
            }
        },
        methods: {
            choose(id) {
                if(DestroyedComponents.indexOf(this._uid) == -1){
                    Fire.$emit('lookupEvtChosen', id, this.componentName,this.calledByIndex, this.name);
                    if (id !== undefined && id !== null) {
                        Fire.$off('lookupEvtChosen', id, this.componentName,this.calledByIndex, this.name);
                    } else {
                        Fire.$off('lookupEvtChosen', '', this.componentName,this.calledByIndex, this.name);
                    }
                }
                // this.destroyEvents();
            },
            loadRecords(name,componentName,index) {
                this.name = name;
                if(this.$gate.isUserOrTrainerOrAdmin()){
                    let uri = 'http://localhost:8000/api/'+name;
                    console.log('^^ uri: '+uri);
                    axios.get(uri).then(({ data }) => (
                        this.records = data));
                }
            },
            getResults(page = 1) {
                let uri = 'http://localhost:8000/api/'+this.name+'?page=';
                axios.get(uri + page)
                    .then(response => {
                        this.records = response.data;
                    });
            },
            search: _.debounce(() => {
                Fire.$emit('searchLookup');
            },1000),
            doSearch() {
                axios.get('http://localhost:8000/api/findCompany?q=' + this.query)
                    .then((data) => {
                        this.records = data.data
                    })
                    .catch(() => {
                    })
            }
        },
        created: function created() {
            console.log('^^ Lookup created: '+this._uid);
            if(DestroyedComponents.indexOf(this._uid) == -1){
                Fire.$on('lookupEvt', (data, componentName,index) => {
                    this.componentName = componentName;
                    this.calledByIndex = index;
                    if(DestroyedComponents.indexOf(this._uid) == -1) {
                        this.loadRecords(data, componentName, index);
                    }
                });
                Fire.$on('searchLookup', () => {
                    this.doSearch();
                });
            }
        },
        destroyed() {
            console.log('^^ Lookup destroyed: '+this._uid);
            DestroyedComponents.push(this._uid);
        }
    }
</script>

<style scoped>

</style>
