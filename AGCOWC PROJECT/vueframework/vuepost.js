var app = new Vue({
    el: '#vueregapp',
    data:{
        successMessage: "",
        errorMessage: "",
        errorTitle: "",
        errorPost: "",
        textareaHeight: 40,
        users: [],
        regDetails: { title: '', post: '', adminid: '', optionPublic: false, optionPrivate: false },
    },
  
    mounted: function(){
        this.regDetails.adminid = document.getElementById('admin-id').getAttribute('data-adminid');
        this.getAllUsers();
    },
  
    methods:{
        expandTextarea() {
            this.textareaHeight = (this.textareaHeight === 40) ? 120 : 40;
        },
        getAllUsers: function(){
            axios.get('post.php')
                .then(function(response){
                    if(response.data.error){
                        app.errorMessage = response.data.message;
                    }
                    else{
                        app.users = response.data.users;
                    }
                });
        },
  
        userPost: function () {
            var regForm = app.toFormData(app.regDetails);
            var postOptions = 0;
            if (app.regDetails.optionPublic && app.regDetails.optionPrivate) {
                postOptions = 3;
            } else if (app.regDetails.optionPublic) {
                postOptions = 1;
            } else if (app.regDetails.optionPrivate) {
                postOptions = 2;
            }
            regForm.append('option', postOptions);
            axios.post('post.php?post=register', regForm)
                .then(function (response) {
                    console.log(response);
                    if (response.data.error) {
                        if (response.data.title) {
                            app.errorTitle = response.data.message;
                            app.focusTitle();
                        }
                        if (response.data.post) {
                            app.errorPost = response.data.message;
                            app.focusPost();
                        }
        
                        app.clearMessage();
        
                        Swal.fire({
                            icon: 'error',
                            title: 'Post Failed',
                            text: 'Invalid Post or Empty.',
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        app.successMessage = response.data.message;
                        app.regDetails = { title: '', post: '', optionPublic: false, optionPrivate: false };
                        app.errorTitle = '';
                        app.errorPost = '';
                        app.getAllUsers();
        
                        // Show SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Post Successful',
                            text: response.data.message,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to success.php
                                window.location.href = 'success.php';
                            }
                        });
                    }
                });
        },
        
  
        focusTitle: function(){
            this.$refs.title.focus();
        },      
         
        focusPost: function(){
            this.$refs.email.focus();
        },
        focusPost: function(){
            this.$refs.optionPrivate.focus();
        },
        keymonitor: function(event) {
            if(event.key == "Enter"){
                app.userReg();
            }
        },
  
        toFormData: function(obj){
            var form_data = new FormData();
            for(var key in obj){
                form_data.append(key, obj[key]);
            }
            return form_data;
        },
  
        clearMessage: function(){
            app.errorMessage = 'error';
            app.successMessage = '';
        },
         
        deleteData: function(user_id){ 
            if(confirm("Are you sure you want to remove this data?")){ 
                axios.post('action.php?action=delete&id='+ user_id +'', {
                    action:'delete',
                }).then(function(response){
                    alert(response.data.message);
                    app.getAllUsers();
                });
            }
        }
    }
});
