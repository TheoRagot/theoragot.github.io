
var app = new Vue({
    el: '#blockComp',
    data: {
      nbx : 0 ,
      seen: true,
    },
    methods: {
      dev: function(){
        this.nbx = 0;
      },
      outils: function(){
        this.nbx = 3;
      },
      transverse: function(){
        this.nbx = 4;
      },
      design: function(){
        this.nbx = 1;
      }
    }
  })