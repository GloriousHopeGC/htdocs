var app = new Vue({
    el: '#vueapplogin',
    data:{
        successMessage: "",
        errorMessage: "",
        logDetails: {username: '', password: ''},
    },
 
    methods:{
        keymonitor: function(event) {
            if(event.key == "Enter"){
                app.checkLogin();
            }
        },
 
        checkLogin: function(){
            var logForm = app.toFormData(app.logDetails);
            axios.post('login.php', logForm)
                .then(function(response){
                    if(response.data.error){
                        app.errorMessage = response.data.message;
                        setTimeout(function(){
                            window.location.href="success.php";
                        },2000);
                        Swal.fire({
                            icon: 'error',
                            title: 'Admin Does Not Exist',
                            text: response.data.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                    else{
                        app.successMessage = response.data.message;
                        app.logDetails = {username: '', password:''};
                        setTimeout(function(){
                            window.location.href="success.php";
                        },2000);
                        // Show SweetAlert for success
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.data.message,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
        },
 
        toFormData: function(obj){
            var form_data = new FormData();
            for(var key in obj){
                form_data.append(key, obj[key]);
            }
            return form_data;
        },
 
        clearMessage: function(){
            app.errorMessage = '';
            app.successMessage = '';
        },
        
        confirmLogout: function() {
            Swal.fire({
                title: 'Logout',
                text: 'Are you sure you want to log out?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log me out!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "logout.php"; // Redirect to logout page if confirmed
                }
            });
        }
    }
});
