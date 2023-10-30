<template>
    <h1>Departments</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <button
                        class="btn btn-success"
                        @click="createDepartment"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                    >
                        new department
                    </button>

                    <!-- Modal -->
                    <div
                        class="modal fade"
                        id="exampleModal"
                        tabindex="-1"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5
                                        class="modal-title"
                                        id="exampleModalLabel"
                                    >
                                        Create new department
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        @click="closeModal"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    name="name"
                                                    v-model="
                                                        departmetnsData.name
                                                    "
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="director_id"
                                                    >Director</label
                                                >
                                                <select
                                                    name="director_id"
                                                    class="form-control"
                                                    v-model="
                                                        departmetnsData.director_id
                                                    "
                                                >
                                                    <option value="" selected>
                                                        Select a person
                                                    </option>
                                                    <option value="1">
                                                        IT Director
                                                    </option>
                                                    <option value="2">
                                                        HR Director
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                    >
                                        Close
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-success"
                                        @click="store"
                                    >
                                        Save changes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            departmetnsData: {
                name: "",
                director_id: "",
            },
        };
    },

    methods: {
        createDepartment() {
            // alert("hi");
            // $('#exampleModal').modal('show');
            this.showModal = true;
        },

        closeModal() {
            this.showModal = false;
        },
        store() {
            console.log("store method START");
            console.log(this.departmetnsData);
            console.log("store method END");
        },
    },

    mounted() {
        console.log("Mounted log");
    },
};
</script>
