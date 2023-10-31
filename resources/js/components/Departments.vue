<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <h5 class="float-start text-light">Departments List</h5>
                    <button
                        class="btn btn-success float-end"
                        @click="createDepartment"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal"
                    >
                        New Department
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr class="table-success">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Director</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(department, index) in departments"
                                    :key="index"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ department.name }}</td>
                                    <td>{{ department.director_id }}</td>
                                    <td>
                                        <button
                                            class="btn btn-success mx-1"
                                            @click="editDepartment(department)"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button
                                            class="btn btn-danger mx-1"
                                            @click="
                                                deleteDepartment(department)
                                            "
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

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
                                        {{
                                            editMode
                                                ? "Edit Department"
                                                : "Create New Department"
                                        }}
                                    </h5>

                                    <button
                                        type="button"
                                        class="btn-close"
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
                                                        departmentsData.name
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
                                                        departmentsData.director_id
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
                                        @click="saveDepartment"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    >
                                        {{
                                            editMode ? "Save changes" : "store"
                                        }}
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
            editMode: "",
            departments: {},
            departmentsData: {
                id: "",
                name: "",
                director_id: "",
            },
        };
    },

    methods: {
        saveDepartment() {
            this.editMode ? this.updateDepartment() : this.store();
        },

        editDepartment(department) {
            this.departmentsData.id = department.id;
            this.departmentsData.director_id = department.director_id;
            this.departmentsData.name = department.name;
            this.editMode = true;
        },

        updateDepartment() {
            axios
                .post(
                    "/api/updateDepartment/" + this.departmentsData.id,
                    this.departmentsData
                )
                .then((response) => {
                    console.log(
                        response.data,
                        "we recived this reponse from update fun"
                    ); // Handle success
                })
                .catch((error) => {
                    if (error.response) {
                        console.log(
                            "Error Response Data:",
                            error.response.data
                        );
                        console.log(
                            "Error Response Status:",
                            error.response.status
                        );
                        console.log(
                            "Error Response Headers:",
                            error.response.headers
                        );
                    } else if (error.request) {
                        console.log("Error Request:", error.request);
                    } else {
                        console.log("Error Message:", error.message);
                    }
                });
            this.getDepartments();
        },

        deleteDepartment(department) {
            // this.departmentsData.id = department.id;
            axios
                .post("/api/deleteDepartment/" + department.id)
                .then((response) => {
                    console.log(
                        response.data,
                        "we recived this reponse from deleteDepartment fun"
                    ); // Handle success
                })
                .catch((error) => {
                    if (error.response) {
                        console.log(
                            "Error Response Data:",
                            error.response.data
                        );
                        console.log(
                            "Error Response Status:",
                            error.response.status
                        );
                        console.log(
                            "Error Response Headers:",
                            error.response.headers
                        );
                    } else if (error.request) {
                        console.log("Error Request:", error.request);
                    } else {
                        console.log("Error Message:", error.message);
                    }
                });
            this.getDepartments();
        },

        getDepartments() {
            axios
                .get("/api/getDepartments")
                .then((response) => {
                    this.departments = response.data;
                    console.log(response.data);
                })
                .catch((error) => {
                    if (error.response) {
                        console.log(
                            "Error Response Data:",
                            error.response.data
                        );
                        console.log(
                            "Error Response Status:",
                            error.response.status
                        );
                        console.log(
                            "Error Response Headers:",
                            error.response.headers
                        );
                    }
                });
        },
        createDepartment() {
            this.departmentsData.director_id = this.departmentsData.name = "";
            this.editMode = false;
        },

        store() {
            //axios.post("/api/storeDepartment", this.departmentsData);
            // im adding the below to test the error by axios api if any

            axios
                .post("/api/storeDepartment", this.departmentsData)
                .then((response) => {
                    console.log(
                        response.data,
                        "we recived this reponse from store fun"
                    ); // Handle success
                })
                .catch((error) => {
                    if (error.response) {
                        console.log(
                            "Error Response Data:",
                            error.response.data
                        );
                        console.log(
                            "Error Response Status:",
                            error.response.status
                        );
                        console.log(
                            "Error Response Headers:",
                            error.response.headers
                        );
                    } else if (error.request) {
                        console.log("Error Request:", error.request);
                    } else {
                        console.log("Error Message:", error.message);
                    }
                });

            console.log("store method START");
            console.log(this.departmentsData);
            console.log("store method END");
            this.getDepartments();
        },
    },

    mounted() {
        console.log("Mounted log");
        this.getDepartments();
    },
};
</script>
