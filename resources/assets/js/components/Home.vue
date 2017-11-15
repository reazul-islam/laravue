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
                    <input class="input is-small" type="text" placeholder="search">
                    <span class="icon is-small is-left">
        <i class="fa fa-search"></i>
      </span>
                </p>
            </div>

            <a class="panel-block">
            <span class="column is-9">
                Marksheet
            </span>

                <span class="panel-icon column is-1">
              <i class="fa fa-trash hax-text-danger"></i>
            </span>
                <span class="panel-icon column is-1">
              <i class="fa fa-edit has-text-info"></i>
            </span>
                <span class="panel-icon column is-1">
              <i class="fa fa-eye has-text-primary"></i>
            </span>
            </a>
        </nav>
        <Add :openmodal="addActive" @closeRequest="close"></Add>
    </div>

</template>
<script>
    let Add = require('./Add.vue')
    export default {
        components: {Add},
        data(){
            return {
                addActive : ''
            }
        },
        methods: {
            openAdd(){
                this.addActive = 'is-active';
            },
            close(){
                this.addActive='';
            }
        }
    }
</script>