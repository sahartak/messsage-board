const app = new Vue({
  el: '#app',
  data: {
    messages: []
  },


  methods: {
    getMessages() {
      let response = fetch('/board/?action=messages').then((response) => {
        return response.json();
      }).then((data) => {
        this.messages = data;
        setTimeout(() => {
          this.getMessages()
        }, 1000);
      });
    }
  },
  mounted() {
    this.getMessages()
  }
})