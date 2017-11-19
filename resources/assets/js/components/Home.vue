<template>
    <div>
        <nav class="panel column is-offset-2 is-8">
            <p class="panel-heading">
                Vuejs phonebook
            </p>
            <div class="panel-block">
                <button class="button is-link is-outlined" @click="openAdd">
                    Add new
                </button>
            </div>
            <div class="panel-block">
                <p class="control has-icons-left">
                    <input class="input is-small" type="text" placeholder="search" v-model="searchQuery">
                    <span class="icon is-small is-left">
        <i class="fa fa-search"></i>
      </span>
                </p>
            </div>

            <a class="panel-block" v-for="(item,index) in tmp">
            <span class="column is-9">
                {{item.name}}
            </span>

                <span class="panel-icon column is-1">
              <i class="fa fa-trash hax-text-danger" @click="del(index,item.id)"></i>
            </span>
                <span class="panel-icon column is-1">
              <i class="fa fa-edit has-text-info" @click="openUpdate(index)"></i>
            </span>
                <span class="panel-icon column is-1">
              <i class="fa fa-eye has-text-primary" @click="openShow(index)"></i>
            </span>
            </a>
        </nav>
        <Add :openmodal="addActive" @closeRequest="close"></Add>
        <Show :openmodal="showActive" @closeRequest="close"></Show>
        <Update :openmodal="updateActive" @closeRequest="close"></Update>
    </div>

</template>
<script>
    let Add = require('./Add.vue')
    let Show = require('./Show.vue')
    let Update = require('./Update.vue')
    export default {
        components: {Add, Show, Update},
        data() {
            return {
                addActive: '',
                showActive: '',
                updateActive: '',
                lists: {},
                tmp: {},
                errors: {},
                searchQuery: '',
            }
        },
        watch: {
            searchQuery() {
                if (this.searchQuery.length > 0) {
                    this.tmp = this.lists.filter((item) => {
                        return Object.keys(item).some((key) => {
                            let string = String(item[key]);
                            return string.toLowerCase().indexOf(this.searchQuery.toLowerCase()) > -1;
                        });
                    })
                } else {
                    this.tmp = this.lists;
                }
            }
        },
        mounted() {
            axios.get('/getData', this.list)
                .then(response => {
                    this.lists = this.tmp = response.data

                })
                .catch(e => {
                    console.log(e);
                    this.errors = e.response.data.errors;
                })
        },
        methods: {
            openAdd() {
                this.addActive = 'is-active';
            },
            close() {
                this.addActive = '';
                this.showActive = '';
                this.updateActive = '';
            },
            openShow(index) {
                this.showActive = 'is-active';
                this.$children[1].list = this.tmp[index]
            },
            openUpdate(index) {
                this.updateActive = 'is-active';
                this.$children[2].list1 = this.tmp[index]
            },
            del(index, id) {

                if (confirm('Are your sure')) {
                    axios.delete(`/phonebook/${id}`, this.list)
                        .then(response => {
                            this.lists.splice(index, 1);
                        })
                        .catch(e => {
                            console.log(e);
                        })
                }

            }
        }
    }
</script>