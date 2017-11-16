<template>
    <div class="modal" :class="openmodal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Update {{list.name}}</p>
                <button class="delete" aria-label="close" @click="close"></button>
            </header>
            <section class="modal-card-body">
                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input class="input" :class="{'is-danger': errors.name}" type="text" placeholder="Name" v-model="list.name">
                        <small v-if="errors.name" class="has-text-danger">{{ errors.name[0] }}</small>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Phone</label>
                    <div class="control">
                        <input class="input" type="number" placeholder="phone" v-model="list.phone">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="email" v-model="list.email">
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" @click="update">Update</button>
                <button class="button" @click="close">Cancel</button>
            </footer>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['openmodal'],

        data(){
            return {
                list: {
                    name: '',
                    phone: '',
                    email: '',
                },
                errors: {

                }
            }
        },
        methods: {
            close(){
                this.$emit('closeRequest')
            },
            update(){
                axios.put('/phonebook/'+this.list.id,this.list)
                    .then(response => {
                        // JSON responses are automatically parsed.
                        console.log(response.data);
                        this.close();
                        //this.posts = response.data

                    })
                    .catch(e => {
                        console.log(e);
                        this.errors = e.response.data.errors;
                    })

            }
        }
    }
</script>