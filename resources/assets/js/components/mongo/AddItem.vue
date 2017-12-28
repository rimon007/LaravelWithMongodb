<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Item</div>

                    <div class="panel-body">
                        <form class="form-horizontal" @submit.prevent="onSubmit">
                            <div class="form-group">
                                <label class="control-label col-sm-2">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="form.name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Age</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" v-model="form.age">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Sex</label>
                                <div class="col-sm-10">                                    
                                    <label class="radio-inline">
                                        <input type="radio" v-model="form.sex" value="male">Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" v-model="form.sex" value="female">Female
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Skills</label>
                                <div class="col-sm-10">
                                    <select class="form-control" v-model="form.skills" multiple="">
                                        <option>Laravel</option>
                                        <option>Vue</option>
                                        <option>React</option>
                                        <option>Angular</option>
                                        <option>Javascript</option>
                                        <option>Java</option>
                                        <option>PHP</option>
                                        <option>MySQL</option>
                                        <option>Redis</option>
                                        <option>MongoDB</option>
                                        <option>Socket.io</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" v-model="form.email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="pwd" v-model="form.password">
                                </div>
                            </div>
                            <div class="form-group">        
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <display-item @clicked="editItemAdd"></display-item>

            <edit-item v-if="isObjectNotEmpty" :item="editItem" @updated="updated"></edit-item>
        </div>
    </div>
</template>

<script>
    import DisplayItem from './DisplayItem.vue';
    import EditItem from './EditItem.vue';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                form: {
                    name: '',
                    age: '',
                    sex: '',
                    skills: [],
                    email: '',
                    password: ''
                },
                editItem: {}
            }
        },

        computed: {
            isObjectNotEmpty() {
                if(_.isEmpty(this.editItem))
                    return false;
                return true;
            }
        },

        components: {
            DisplayItem,
            EditItem
        },
        methods: {
            onSubmit() {
                axios.post('/mongo/store', this.form)
                     .then(response => console.log(response));
            },

            editItemAdd(item) {
                this.editItem = item;
            },

            updated(item) {
                /*let items = this.items;
                let index = items.forEach(function (val) { return val._id.$oid; }).indexOf(item._id.$oid);
                this.items[index] = item;*/
                this.editItem = {};
            }
        }

    }
</script>
