<template>
    <div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add new Test</h3>
                <div class="card-tools">
                    <a href="{{ route('test.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Test</a>
                </div>
            </div>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror"  required placeholder="Название">

                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
            </span>

                </div>
                <div class="form-group">
                    <label for="name">Module type</label>
                    <select  v-model="selectedModel"   @change="getModelRecords()" name="testable_type"  id="testable_type" class="form-control select2" data-placeholder="Выберите Модуль" style="width: 100%;">
                        <option value="modules">Module</option>
                        <option value="courses">Course</option>
                    </select>

                    <span class="invalid-feedback" role="alert">
                <strong></strong>
            </span>

                </div>
                <div class="form-group">
                    <label for="testable_id">Module</label>
                    <select name="testable_id" id="testable_id" class="form-control select2" style="width: 100%;">
                        <option v-for="record in modelRecords" :value="record.id">{{ record.name }}</option>
                    </select>

                    <span class="invalid-feedback" role="alert">
                <strong></strong>
            </span>

                </div>

                <button class="btn btn-primary"  type="submit">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "test",
    data() {
        return {
            selectedModel: '',
            modelRecords: []
        }
    },

    methods: {
        getModelRecords() {
            axios.get('/get-model-records', {
                params: {
                    testable_type: this.selectedModel
                }
            }).then(response => {
                this.modelRecords = response.data;
            }).catch(error => {
                console.log(error);
            });
        }
    }
}



</script>

<style scoped>

</style>
