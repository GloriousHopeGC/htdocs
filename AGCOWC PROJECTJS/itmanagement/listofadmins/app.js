var app = new Vue({
    el: "#app",
    data: {
        fname: "",
        lname: "",
        number:"",
        email: "",
        username: "",
        password: "",
        records: [],
        edit_id: "",
        edit_fname: "",
        edit_lname: "",
        edit_number: "",
        edit_email: "",
        edit_username: "",
        edit_password: "",
    },
 
    methods: {
        showModal(id) {
            this.$refs[id].show();
        },
        hideModal(id) {
            this.$refs[id].hide();
        },
        maskPassword(password, limit) {
            return password.length > limit ? '*'.repeat(limit) + '...': '*'.repeat(password.length);
        },
        onSubmit() {
            if (this.fname !== "" && this.lname !== "") {
                var fd = new FormData();
 
                fd.append("fname", this.fname);
                fd.append("lname", this.lname);
                fd.append("number", this.number);
                fd.append("email", this.email);
                fd.append("username", this.username);
                fd.append("password", this.password);
 
                axios({
                    url: "insert.php",
                    method: "post",
                    data: fd,
                })
                    .then((res) => {
                        if (res.data.res == "success") {
                            app.makeToast("Success", "Record Added", "default");
 
                            this.fname = "";
                            this.lname = "";
                            this.number= "";
                            this.email = "";
                            this.username = "";
                            this.password= "";
 
                            app.hideModal("my-modal");
                            app.getRecords();
                        } else {
                            app.makeToast("Error", "Failed to add record. Please try again", "default");
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            } else {
                alert("All field are required");
            }
        },
 
        getRecords() {
            axios({
                url: "records.php",
                method: "get",
            })
                .then((res) => {
                    this.records = res.data.rows;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
 
        deleteRecord(id) {
            if (window.confirm("Delete this record")) {
                var fd = new FormData();
 
                fd.append("id", id);
 
                axios({
                    url: "delete.php",
                    method: "post",
                    data: fd,
                })
                    .then((res) => {
                        if (res.data.res == "success") {
                            app.makeToast("Success", "Record delete successfully", "default");
                            app.getRecords();
                        } else {
                            app.makeToast("Error", "Failed to delete record. Please try again", "default");
                        }
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        },
 
        editRecord(id) {
            var fd = new FormData();
 
            fd.append("id", id);
 
            axios({
                url: "edit.php",
                method: "post",
                data: fd,
            })
                .then((res) => {
                    if (res.data.res == "success") {
                        this.edit_id = res.data.row[0];
                        this.edit_fname = res.data.row[1];
                        this.edit_lname = res.data.row[2];
                        this.edit_number = res.data.row[3];
                        this.edit_email = res.data.row[4];
                        this.edit_username = res.data.row[5];
                        this.edit_password= res.data.row[6];
                        app.showModal("my-modal1");
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
 
        onUpdate() {
            if (
                this.edit_fname !== "" &&
                this.edit_lname !== "" &&
                this.edit_id !== ""
            ) {
                var fd = new FormData();
 
                fd.append("id", this.edit_id);
                fd.append("fname", this.edit_fname);
                fd.append("lname", this.edit_lname);
                fd.append("number", this.edit_number);
                fd.append("email", this.edit_email);
                fd.append("username", this.edit_username);
                fd.append("password", this.edit_password);
                axios({
                    url: "update.php",
                    method: "post",
                    data: fd,
                })
                    .then((res) => {
                        if (res.data.res == "success") {
                            app.makeToast("Sucess", "Record update successfully", "default");
 
                            this.edit_name = "";
                            this.edit_email = "";
                            this.edit_id = "";
 
                            app.hideModal("my-modal1");
                            app.getRecords();
                        }
                    })
                    .catch((err) => {
                        app.makeToast("Error", "Failed to update record", "default");
                    });
            } else {
                alert("All field are required");
            }
        },
 
        makeToast(vNodesTitle, vNodesMsg, variant) {
            this.$bvToast.toast([vNodesMsg], {
                title: [vNodesTitle],
                variant: variant,
                autoHideDelay: 1000,
                solid: true,
            });
        },
    },
 
    mounted: function () {
        this.getRecords();
    },
});