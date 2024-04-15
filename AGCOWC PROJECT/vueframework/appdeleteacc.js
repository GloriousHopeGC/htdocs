// app.js
new Vue({
    el: '#appdelete',
    methods: {
        confirmDelete() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Here you can place the code to delete the item or redirect to delete.php
                    window.location.href = 'delete.php';
                }
            });
        },
        deleteItem() {
            // Implement the delete logic here
            console.log('Item deleted!');
        }
    }
});
