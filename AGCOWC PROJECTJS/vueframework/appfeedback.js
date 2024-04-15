new Vue({
    el: '#feedback',
    data: {
        textareaHeight: 40, // Initial height of the textarea
    },
    methods: {
        expandTextarea() {
            // Adjust the height as needed when the textarea is clicked
            this.textareaHeight = 120; // You can set this to the desired expanded height
        },
    },
});
