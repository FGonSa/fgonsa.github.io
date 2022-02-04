const app = Vue.createApp({
    data(){
        return {
            cesta: 0,
            product: 'Calcetines',
            image: './assets/images/socks_green.jpg',
            description: "Par de calcetines suavecicos",
            url: 'http://www.google.com',
            stock: true,
            details: ['talla S', 'talla M', 'talla L', 'talla XL']
        }
    },
    methods: {
        addCesta(){
            this.cesta +=1
        },
        restarCesta(){
            if(this.cesta >0){
                this.cesta -=1
            }
        }
    }
})
