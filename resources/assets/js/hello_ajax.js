require('./bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#hello_ajax',
    data: {
        message: ""
    },
    methods: {
        showMessage1: function () {
            let url = "/ajax/hello_ajax_message";
            axios.get(url).then((res) => {
                this.message = res.data.message1;
            });
        },
        showMessage2: async function () {
            let url = "/ajax/hello_ajax_message";
            let res = await axios.get(url);
            this.message = res.data.message2;
        }
    }
});
