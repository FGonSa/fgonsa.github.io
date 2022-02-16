const app = Vue.createApp({
    data() {
        return {
            cesta: 0,
            product: 'Calcetines',
            marca: 'Politècnics',
            image: './assets/images/socks_green.jpg',
            description: "Par de calcetines suavecicos",
            url: 'http://www.google.com',
            stock: true,
            details: ['talla S', 'talla M', 'talla L', 'talla XL'],
            variants: [
                {id: 2234, color: 'green', image: './assets/images/socks_green.jpg', cantidad: 50}, 
                {id: 2235, color: 'blue', image: './assets/images/socks_blue.jpg', cantidad: 0},
            ],
            selectedVariant: 0,
        }
    },
    methods: {
        addCesta() {
            this.cesta += 1
        },
        restarCesta() {
            if (this.cesta > 0) {
                this.cesta -= 1
            }
        },
        cambiarStock() {
            if (this.stock) {
                this.stock = false
            } else {
                this.stock = true
            }
        },
        updateVariant(index){
            this.selectedVariant = index;
        }
    },
    computed: {
        titulo(){
            return this.product + ' '+ this.marca
        },
        imagen(){
            return this.variants[this.selectedVariant].image
        },
        enStock(){
            return this.variants[this.selectedVariant].cantidad
        },
    }
})