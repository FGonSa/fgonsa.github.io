const app = Vue.createApp({
    data(){
        return {
            product: 'Calcetines',
            image: './assets/images/socks_green.jpg',
            description: "Par de calcetines suavecicos",
            url: 'http://www.google.com',
            stock: true,
            details: ['talla S', 'talla M', 'talla L', 'talla XL']
        }
    }
})
