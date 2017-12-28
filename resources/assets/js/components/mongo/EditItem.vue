<template>
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">EDIT ITEM</div>
            
            <div class="panel-body">
                <form class="form-horizontal" @submit.prevent="onUpdate">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Name</label>
                        <div class="col-sm-10">
                            <input type="text" 
                                class="form-control" 
                                v-model="item.name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Age</label>
                        <div class="col-sm-10">
                            <input type="text" 
                                class="form-control" 
                                v-model="item.age">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Sex</label>
                        <div class="col-sm-10">                                    
                            <label class="radio-inline">
                                <input type="radio" v-model="item.sex" value="male">Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" v-model="item.sex" value="female">Female
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Skills</label>
                        <div class="col-sm-10">
                            <select class="form-control" v-model="item.skills" multiple="">
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
                            <input type="email" 
                                class="form-control" 
                                id="email" 
                                v-model="item.email">
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
</template>

<script>
    export default {
        props: ['item'],

        methods: {
            onUpdate() {
                axios.put(`/mongo/${this.item._id.$oid}/update`, this.item)
                     .then(response => this.$emit('updated', this.item));
            }
        }


    }
</script>
