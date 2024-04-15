var app = new Vue({
    el: '#vueappsearch',
    data:{
        employee: [],
        search: {keyword: ''},
        noMember: false
    },
 
    mounted: function(){
        this.fetchemployee();
    },
 
    methods:{
        searchMonitor: function() {
            var keyword = app.toFormData(app.search);
            axios.post('action.php?action=search', keyword)
                .then(function(response){
                    app.employee = response.data.employee;
 
                    if(response.data.employee == ''){
                        app.noMember = true;
                    }
                    else{
                        app.noMember = false;
                    }
                });
        },
 
        fetchemployee: function(){
            axios.post('action.php')
                .then(function(response){
                    app.employee = response.data.employee;
                });
        },
 
        toFormData: function(obj){
            var form_data = new FormData();
            for(var key in obj){
                form_data.append(key, obj[key]);
            }
            return form_data;
        },
 
    }
});