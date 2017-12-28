<template>
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Item Lists</div>

            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Skills</th>
                        <th>Email</th>
                        <th>&nbsp;</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items">
                            <td v-text="item._id.$oid"></td>
                            <td v-text="item.name"></td>
                            <td v-text="item.age"></td>
                            <td v-text="item.sex"></td>
                            <td v-text="item.skills"></td>
                            <td v-text="item.email"></td>
                            <td>
                                <button type="button" 
                                    class="btn btn-info btn-sm"
                                    @click="edit(item)">Edit</button>
                                |
                                <button type="button" 
                                    class="btn btn-danger btn-sm"
                                    @click="destroy(item)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/mongo/lists')
                 .then(response => this.items = response.data );
        },
        data() {
            return {
                items: []
            }
        },

        methods: {
            edit(item) {
                //console.log(item.skills.split(','))
                this.$emit('clicked', {
                    _id: item._id,
                    name: item.name,
                    age: item.age,
                    sex: item.sex,
                    skills: item.skills.split(','),
                    email: item.email
                });
            },

            destroy(item) {
                let index = this.items.indexOf(item);
                axios.delete(`/mongo/${item._id.$oid}/destroy`)
                     .then(response => this.items.splice(index, 1));
            }
        }


    }
</script>
