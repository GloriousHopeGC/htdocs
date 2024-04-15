// app.js
new Vue({
    el: '#applog',
    methods: {
        confirmLogout() {
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
